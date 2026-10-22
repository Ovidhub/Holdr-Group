<?php

/**
 * Build-time preparation script executed by vercel-php (`composer run vercel`).
 *
 * 1. Prunes unused AWS SDK service models so the Lambda stays well under 250 MB.
 * 2. Ensures Laravel storage/cache directories exist.
 * 3. Pre-builds and seeds `storage/vercel-seed.sqlite` so the app works immediately
 *    on Vercel (copied to `/tmp/database.sqlite` on cold start when no external
 *    MySQL database is configured).
 */

error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', '0');

$basePath = dirname(__DIR__);

// 1. Prune unused AWS SDK service definitions (keeps S3 + core files, saves ~28 MB)
$awsDataDir = $basePath . '/vendor/aws/aws-sdk-php/src/data';
if (is_dir($awsDataDir)) {
    $keep = ['s3', 'sts', 'iam', 'kms'];
    foreach (scandir($awsDataDir) as $entry) {
        if ($entry === '.' || $entry === '..') {
            continue;
        }
        $fullPath = $awsDataDir . '/' . $entry;
        if (is_dir($fullPath) && !in_array($entry, $keep, true)) {
            $it = new RecursiveDirectoryIterator($fullPath, RecursiveDirectoryIterator::SKIP_DOTS);
            $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
            foreach ($files as $file) {
                $file->isDir() ? @rmdir($file->getRealPath()) : @unlink($file->getRealPath());
            }
            @rmdir($fullPath);
        }
    }
}

// 2. Ensure required directories exist
$dirs = [
    $basePath . '/storage/app/public',
    $basePath . '/storage/framework/views',
    $basePath . '/storage/framework/cache/data',
    $basePath . '/storage/framework/sessions',
    $basePath . '/storage/logs',
    $basePath . '/bootstrap/cache',
];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0775, true);
    }
}

// 3. Build and seed `storage/vercel-seed.sqlite`
$sqlitePath = $basePath . '/storage/vercel-seed.sqlite';
if (file_exists($sqlitePath)) {
    @unlink($sqlitePath);
}
touch($sqlitePath);

$envDefaults = [
    'APP_NAME' => 'Mortil Holders',
    'APP_ENV' => 'production',
    'APP_DEBUG' => 'false',
    'APP_KEY' => 'base64:6Cu/ozj4gPtIjmXjr8EdVnGFNsdRqZfHfVjQkmTlg4Y=',
    'DB_CONNECTION' => 'sqlite',
    'DB_DATABASE' => $sqlitePath,
    'CACHE_DRIVER' => 'array',
    'SESSION_DRIVER' => 'array',
    'LOG_CHANNEL' => 'stderr',
];
foreach ($envDefaults as $key => $val) {
    putenv("$key=$val");
    $_ENV[$key] = $val;
    $_SERVER[$key] = $val;
}

require $basePath . '/vendor/autoload.php';
$app = require $basePath . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$app['config']->set('database.default', 'sqlite');
$app['config']->set('database.connections.sqlite.database', $sqlitePath);

Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
Illuminate\Support\Facades\Artisan::call('livewire:discover');

$now = now();

Illuminate\Support\Facades\DB::table('settings')->updateOrInsert(['id' => 1], [
    'site_name' => 'Mortil Holders',
    'site_title' => 'Mortil Holders — Private & Commercial Digital Banking',
    'site_address' => 'https://mortilholders.online',
    'contact_email' => 'info@mortilholders.online',
    'emailfrom' => 'info@mortilholders.online',
    'emailfromname' => 'Mortil Holders',
    'description' => 'Mortil Holders delivers institutional-grade private and commercial digital banking, instant multi-currency settlement, and bespoke lending across 100+ jurisdictions.',
    'keywords' => 'Mortil Holders, private banking, commercial treasury, multi-currency accounts, digital banking',
    'address' => '301 East Water Street, Charlottesville, VA 22904, United States',
    'currency' => '$',
    'scurrency' => 'USD',
    's_currency' => 'USD',
    'logo' => 'photos/mortil-logo.svg',
    'favicon' => 'photos/mortil-icon.svg',
    'website_theme' => 'atlantis.min.css',
    'google_translate' => 'on',
    'trade_mode' => 'on',
    'weekend_trade' => 'on',
    'enable_2fa' => 'no',
    'enable_kyc' => 'no',
    'enable_with' => 'true',
    'enable_verification' => 'false',
    'withdrawal_option' => 'auto',
    'captcha' => 'false',
    'use_transfer' => 1,
    'created_at' => $now,
    'updated_at' => $now,
]);

Illuminate\Support\Facades\DB::table('appearance_settings')->updateOrInsert(['id' => 1], [
    'primary_color' => '#C41E3A',
    'primary_color_dark' => '#881337',
    'primary_color_light' => '#FB7185',
    'secondary_color' => '#9F1239',
    'secondary_color_dark' => '#4C0519',
    'secondary_color_light' => '#FDA4AF',
    'text_color' => '#111827',
    'bg_color' => '#f9fafb',
    'sidebar_bg_color' => '#1E050D',
    'sidebar_text_color' => '#ffffff',
    'card_bg_color' => '#ffffff',
    'use_gradient' => 1,
    'gradient_direction' => 'to right',
    'custom_css' => null,
    'disable_animations' => 0,
    'notes' => 'Cherry brand theme',
    'created_at' => $now,
    'updated_at' => $now,
]);

Illuminate\Support\Facades\DB::table('terms_privacies')->updateOrInsert(['id' => 1], [
    'useterms' => 'yes',
    'description' => '<h4>Mortil Holders Privacy &amp; Data Protection Charter</h4><p>Mortil Holders safeguards client records, multi-currency account credentials, and transaction telemetry under bank-grade cryptographic controls and strict regulatory governance.</p><p>We process verified personal and corporate data solely to provision custodial accounts, execute domestic and cross-border settlements, issue payment cards, and underwrite credit facilities. Client data is never sold or shared with unauthorized third parties.</p>',
    'created_at' => $now,
    'updated_at' => $now,
]);

Illuminate\Support\Facades\DB::table('settings_conts')->updateOrInsert(['id' => 1], [
    'use_crypto_feature' => 1,
    'created_at' => $now,
    'updated_at' => $now,
]);

(new Database\Seeders\PageContentSeeder())->run();

Illuminate\Support\Facades\DB::table('admins')->updateOrInsert(['id' => 1], [
    'firstName' => 'Super',
    'lastName' => 'Admin',
    'email' => 'admin@mortilholders.online',
    'password' => Illuminate\Support\Facades\Hash::make('password'),
    'dashboard_style' => 'light',
    'status' => 'active',
    'type' => 'Super Admin',
    'created_at' => $now,
    'updated_at' => $now,
]);

Illuminate\Support\Facades\DB::table('users')->updateOrInsert(['id' => 1], [
    'name' => 'Demo User',
    'username' => 'demouser',
    'email' => 'user@mortilholders.online',
    'email_verified_at' => $now,
    'password' => Illuminate\Support\Facades\Hash::make('password'),
    'status' => 'active',
    'account_bal' => 25000,
    'bonus' => 500,
    'roi' => 1200,
    'ref_bonus' => 100,
    'account_verify' => 'Verified',
    'pin' => '1234',
    'pinstatus' => 0,
    'usernumber' => '84920174632',
    'created_at' => $now,
    'updated_at' => $now,
]);

echo "Vercel build preparation completed. Seeded SQLite size: " . filesize($sqlitePath) . " bytes.\n";
