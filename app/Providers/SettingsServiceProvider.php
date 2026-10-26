<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Mail;
use App\Models\Settings;
use App\Models\Paystack;
use App\Models\SettingsCont;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            if (!Schema::hasTable('settings')) {
                return;
            }

            $settings = Settings::where('id', '1')->first();
            $paystack = Schema::hasTable('paystacks') ? Paystack::where('id', '1')->first() : null;
            $settings2 = Schema::hasTable('settings_conts') ? SettingsCont::find(1) : null;
        } catch (\Throwable $e) {
            return;
        }

        if (is_null($settings)) {
            return;
        }

        if ($settings->install_type == 'Sub-Folder' && !empty($settings->site_address)) {
            $urls = explode('/', $settings->site_address);
            $assetUrl = '/' . end($urls);
        } else {
            $assetUrl = null;
        }

        // Validate timezone before applying
        $timezone = !empty($settings->timezone) && in_array($settings->timezone, timezone_identifiers_list(), true)
            ? $settings->timezone
            : 'UTC';

        // Use SMTP only when host & user are actually configured; otherwise use 'log' so
        // Mail::to()->send() never fails with a 500 Swift_TransportException.
        $mailDriver = 'log';
        if ($settings->mail_server === 'smtp' && !empty($settings->smtp_host) && !empty($settings->smtp_user)) {
            $mailDriver = 'smtp';
        } elseif ($settings->mail_server === 'sendmail' && @is_executable('/usr/sbin/sendmail')) {
            $mailDriver = 'sendmail';
        }

        config([
            'captcha.secret' => $settings->capt_secret,
            'captcha.sitekey' => $settings->capt_sitekey,
            'services.google.client_id' => $settings->google_id,
            'services.google.client_secret' => $settings->google_secret,
            'services.google.redirect' => $settings->google_redirect,
            'mail.mailers.smtp.host' => $settings->smtp_host,
            'mail.mailers.smtp.port' => $settings->smtp_port,
            'mail.mailers.smtp.encryption' => $settings->smtp_encrypt,
            'mail.mailers.smtp.username' => $settings->smtp_user,
            'mail.mailers.smtp.password' => $settings->smtp_password,
            'mail.default' => $mailDriver,
            'mail.from.address' => $settings->emailfrom ?: 'info@mortilholders.online',
            'mail.from.name' => $settings->emailfromname ?: 'Mortil Holders',
            'app.timezone' => $timezone,
            'app.name' => $settings->site_name ?: 'Mortil Holders',
            'app.url' => $settings->site_address ?: config('app.url'),
            'paystack.publicKey' => optional($paystack)->paystack_public_key,
            'paystack.secretKey' => optional($paystack)->paystack_secret_key,
            'paystack.paymentUrl' => optional($paystack)->paystack_url,
            'paystack.merchantEmail' => optional($paystack)->paystack_email,
            'livewire.asset_url' => $assetUrl,
            'flutterwave.publicKey' => optional($settings2)->flw_public_key,
            'flutterwave.secretKey' => optional($settings2)->flw_secret_key,
            'flutterwave.secretHash' => optional($settings2)->flw_secret_hash,
            'services.telegram-bot-api.token' => optional($settings2)->telegram_bot_api,
        ]);

        // Wrap Swift_Mailer so that even if an external SMTP/sendmail transport fails at runtime,
        // Mail::to()->send() degrades gracefully instead of crashing the request with a 500 error.
        try {
            $swift = Mail::getSwiftMailer();
            if ($swift) {
                $transport = $swift->getTransport();
                Mail::setSwiftMailer(new class($transport) extends \Swift_Mailer {
                    public function send(\Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
                    {
                        try {
                            return parent::send($message, $failedRecipients);
                        } catch (\Throwable $e) {
                            return 0;
                        }
                    }
                });
            }
        } catch (\Throwable $e) {
            // Ignore if mailer is not initialized
        }
    }
}
