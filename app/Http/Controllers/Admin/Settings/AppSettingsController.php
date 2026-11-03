<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\SettingsCont;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Storage;

class AppSettingsController extends Controller
{
    /**
     * Safely update a row in a settings table, automatically adding any missing columns first
     * so existing MySQL/SQLite installations never throw a 500 "Unknown column" error.
     */
    protected function safeTableUpdate(string $tableName, string $modelClass, array $data): void
    {
        try {
            $existingCols = array_map('strtolower', Schema::getColumnListing($tableName));
            $missingCols = [];
            foreach (array_keys($data) as $col) {
                if (!in_array(strtolower($col), $existingCols, true)) {
                    $missingCols[] = $col;
                }
            }
            if (!empty($missingCols)) {
                Schema::table($tableName, function (Blueprint $table) use ($missingCols) {
                    foreach ($missingCols as $col) {
                        $table->text($col)->nullable();
                    }
                });
                $existingCols = array_map('strtolower', Schema::getColumnListing($tableName));
            }

            $filtered = [];
            foreach ($data as $col => $val) {
                if (in_array(strtolower($col), $existingCols, true)) {
                    $filtered[$col] = $val;
                }
            }

            if (!empty($filtered)) {
                $modelClass::where('id', 1)->update($filtered);
            }
        } catch (\Throwable $e) {
            // Fallback: filter strictly to existing columns
            $existingCols = array_map('strtolower', Schema::getColumnListing($tableName));
            $filtered = [];
            foreach ($data as $col => $val) {
                if (in_array(strtolower($col), $existingCols, true)) {
                    $filtered[$col] = $val;
                }
            }
            if (!empty($filtered)) {
                $modelClass::where('id', 1)->update($filtered);
            }
        }
    }

    // Return view
    public function appsettingshow()
    {
        $live_timezones = timezone_identifiers_list();
        include 'currencies.php';
        return view('admin.Settings.AppSettings.show', [
            'title' => 'Website information settings',
            'timezones' => $live_timezones,
            'currencies' => $currencies,
            'timezone' => config('app.timezone'),
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }

    // for front end content management
    function RandomStringGenerator($n)
    {
        $generated_string = "";
        $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $len = strlen($domain);
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, $len - 1);
            $generated_string = $generated_string . $domain[$index];
        }
        return $generated_string;
    }

    // updatertransfercodes
    public function updatertransfercodes(Request $request)
    {
        $this->safeTableUpdate('settings', Settings::class, [
            'code1' => $request->code1,
            'code2' => $request->code2,
            'code3' => $request->code3,
            'code1status' => $request->code1status ?? 0,
            'code2status' => $request->code2status ?? 0,
            'code3status' => $request->code3status ?? 0,
            'code1message' => $request->code1message,
            'code2message' => $request->code2message,
            'code3message' => $request->code3message,
            'otp' => $request->otp ?? 0,
        ]);

        return redirect()->back()->with('success', 'Settings Saved successfully');
    }

    // update website information
    public function updatewebinfo(Request $request)
    {
        $this->validate($request, [
            'logo' => 'nullable|mimes:jpg,jpeg,png,svg,webp,gif,ico|max:5120',
            'favicon' => 'nullable|mimes:jpg,jpeg,png,svg,webp,gif,ico|max:5120',
        ]);

        $settings = Settings::where('id', '=', '1')->first();

        $path = $settings ? $settings->logo : 'photos/mortil-logo.svg';
        if ($request->hasfile('logo')) {
            $file = $request->file('logo');
            try {
                if ($settings && !empty($settings->logo)) {
                    @Storage::disk('public')->delete($settings->logo);
                }
                $stored = $file->store('photos', 'public');
                if ($stored) {
                    $path = $stored;
                }
            } catch (\Throwable $e) {
                // Keep existing path if storage is read-only
            }
        }

        $pathfav = $settings ? $settings->favicon : 'photos/mortil-icon.svg';
        if ($request->hasfile('favicon')) {
            $favfile = $request->file('favicon');
            try {
                if ($settings && !empty($settings->favicon)) {
                    @Storage::disk('public')->delete($settings->favicon);
                }
                $storedFav = $favfile->store('photos', 'public');
                if ($storedFav) {
                    $pathfav = $storedFav;
                }
            } catch (\Throwable $e) {
                // Keep existing path if storage is read-only
            }
        }

        $this->safeTableUpdate('settings', Settings::class, [
            'newupdate' => $request['update'] ?? ($settings->newupdate ?? null),
            'site_name' => $request['site_name'],
            'description' => $request['description'] ?? ($settings->description ?? null),
            'keywords' => $request['keywords'],
            'timezone' => $request['timezone'] ?? 'UTC',
            'site_title' => $request['site_title'],
            'install_type' => $request['install_type'] ?? 'Main-Domain',
            'logo' => $path,
            'merchant_key' => $request->merchant_key,
            'favicon' => $pathfav,
            'tawk_to' => !empty($request['tawk_to']) ? strip_tags((string) $request['tawk_to']) : ($settings->tawk_to ?? null),
            'site_address' => $request['site_address'],
            'welcome_message' => $request->welcome_message,
            'whatsapp' => $request->whatsapp,
            'tido' => $request->tido,
            'address' => $request->address,
            'sms' => $request->sms ?? '0',
        ]);

        if ($request->has('purchase_code')) {
            $this->safeTableUpdate('settings_conts', SettingsCont::class, [
                'purchase_code' => $request->purchase_code,
            ]);
        }

        return redirect()->back()->with('success', 'Settings Saved successfully');
    }

    public function updatepreference(Request $request)
    {
        $settings = Settings::where('id', '=', '1')->first();
        $return_capital = ($request->return_capital == 'true' || $request->return_capital == '1') ? 1 : 0;
        $cancel_plan = ($request->should_cancel_plan == 'true' || $request->should_cancel_plan == '1') ? 1 : 0;

        $updateData = [
            'contact_email' => $request['contact_email'] ?? optional($settings)->contact_email,
            'currency' => $request['currency'] ?? optional($settings)->currency ?? '$',
            's_currency' => $request['s_currency'] ?? optional($settings)->s_currency ?? 'USD',
            'scurrency' => $request['s_currency'] ?? optional($settings)->scurrency ?? 'USD',
            'weekend_trade' => $request['weekend_trade'] ?? optional($settings)->weekend_trade ?? 'on',
            'location' => $request['location'] ?? optional($settings)->location,
            'trade_mode' => $request['trade_mode'] ?? optional($settings)->trade_mode ?? 'on',
            'enable_verification' => $request['enail_verify'] ?? optional($settings)->enable_verification ?? 'false',
            'google_translate' => $request['googlet'] ?? optional($settings)->google_translate ?? 'on',
            'enable_kyc' => $request['enable_kyc'] ?? optional($settings)->enable_kyc ?? 'no',
            'enable_kyc_registration' => $request['enable_kyc_registration'] ?? optional($settings)->enable_kyc_registration ?? 'no',
            'captcha' => $request['captcha'] ?? optional($settings)->captcha ?? 'false',
            'enable_with' => $request['withdraw'] ?? optional($settings)->enable_with ?? 'true',
            'return_capital' => $return_capital,
            'enable_social_login' => $request['social'] ?? optional($settings)->enable_social_login ?? 'no',
            'enable_annoc' => $request['annouc'] ?? optional($settings)->enable_annoc ?? 'off',
            'redirect_url' => $request->redirect_url,
            'should_cancel_plan' => $cancel_plan,
        ];

        $this->safeTableUpdate('settings', Settings::class, $updateData);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['status' => 200, 'success' => 'Settings Saved successfully']);
        }
        return redirect()->back()->with('success', 'Settings Saved successfully');
    }

    // Update email preference
    public function updateemail(Request $request)
    {
        $this->safeTableUpdate('settings', Settings::class, [
            'mail_server' => $request['server'],
            'emailfrom' => $request['emailfrom'],
            'emailfromname' => $request['emailfromname'],
            'smtp_host' => $request['smtp_host'],
            'smtp_port' => $request['smtp_port'],
            'smtp_encrypt' => $request['smtp_encrypt'],
            'smtp_user' => $request['smtp_user'],
            'smtp_password' => $request['smtp_password'],
            'google_id' => $request['google_id'],
            'google_secret' => $request['google_secret'],
            'google_redirect' => $request['google_redirect'],
            'capt_secret' => $request['capt_secret'],
            'capt_sitekey' => $request['capt_sitekey'],
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['status' => 200, 'success' => 'Settings Saved successfully']);
        }
        return redirect()->back()->with('success', 'Settings Saved successfully');
    }
}
