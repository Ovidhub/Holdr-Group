<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('site_name')->nullable();
            $table->text('description')->nullable();
            $table->string('currency')->nullable();
            $table->string('scurrency')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('eth_address')->nullable();
            $table->string('btc_address')->nullable();
            $table->string('ltc_address')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('location')->nullable();
            $table->string('s_s_k')->nullable();
            $table->string('s_p_k')->nullable();
            $table->string('pp_cs')->nullable();
            $table->string('pp_ci')->nullable();
            $table->string('keywords')->nullable();
            $table->string('site_title')->nullable();
            $table->string('site_address')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('website_theme')->default('purpose.css')->nullable();
            $table->string('trade_mode')->nullable();
            $table->string('weekend_trade')->nullable();
            $table->string('google_translate')->nullable();
            $table->string('captcha')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('referral_commission')->nullable();
            $table->string('referral_commission1')->nullable();
            $table->string('referral_commission2')->nullable();
            $table->string('referral_commission3')->nullable();
            $table->string('referral_commission4')->nullable();
            $table->string('referral_commission5')->nullable();
            $table->string('signup_bonus')->nullable();
            $table->string('files_key')->nullable();
            $table->text('tawk_to')->nullable();
            $table->string('enable_2fa')->default('no');
            $table->string('enable_kyc')->default('no');
            $table->string('enable_with')->nullable();
            $table->string('enable_verification')->default('true');
            $table->string('withdrawal_option')->default('auto');
            $table->string('dashboard_option')->nullable();
            $table->string('site_preference')->nullable();
            $table->string('enable_annoc')->nullable();
            $table->string('commission_type')->nullable();
            $table->string('commission_fee')->nullable();
            $table->string('monthlyfee')->nullable();
            $table->string('quarterlyfee')->nullable();
            $table->string('yearlyfee')->nullable();
            $table->string('newupdate')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('emailfrom')->nullable();
            $table->string('emailfromname')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('tido')->nullable();
            $table->string('s_currency')->default('USD');
            $table->text('modules')->nullable();
            $table->boolean('return_capital')->default(false);
            $table->boolean('should_cancel_plan')->default(false);
            $table->boolean('use_transfer')->default(true);
            $table->integer('otp')->default(0);
            $table->integer('code1status')->default(0);
            $table->integer('code2status')->default(0);
            $table->integer('code3status')->default(0);
            $table->string('code1')->nullable();
            $table->string('code2')->nullable();
            $table->string('code3')->nullable();
            $table->text('code1message')->nullable();
            $table->text('code2message')->nullable();
            $table->text('code3message')->nullable();
            $table->string('timezone')->nullable();
            $table->string('install_type')->nullable();
            $table->string('merchant_key')->nullable();
            $table->text('welcome_message')->nullable();
            $table->string('sms')->nullable();
            $table->string('enable_kyc_registration')->default('no')->nullable();
            $table->string('enable_social_login')->default('no')->nullable();
            $table->string('redirect_url')->nullable();
            $table->string('mail_server')->nullable();
            $table->string('smtp_host')->nullable();
            $table->string('smtp_port')->nullable();
            $table->string('smtp_encrypt')->nullable();
            $table->string('smtp_user')->nullable();
            $table->string('smtp_password')->nullable();
            $table->string('google_id')->nullable();
            $table->string('google_secret')->nullable();
            $table->string('google_redirect')->nullable();
            $table->string('capt_secret')->nullable();
            $table->string('capt_sitekey')->nullable();
            $table->string('deposit_option')->nullable();
            $table->string('auto_merchant_option')->nullable();
            $table->string('deduction_option')->nullable();
            $table->string('credit_card_provider')->nullable();
            $table->string('subscription_service')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
