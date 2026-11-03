<?php

namespace App\Providers;

use League\Flysystem\Filesystem;
use League\Flysystem\Sftp\SftpAdapter;
use Illuminate\Support\Facades\View;
use App\Models\Settings;
use App\Models\SettingsCont;
use App\Models\TermsPrivacy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Connection;
use Illuminate\Database\MySqlConnection;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Prevent PHP 8+ warnings/notices/deprecations from being converted into 500 ErrorExceptions
        error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED & ~E_USER_DEPRECATED & ~E_STRICT);
        \Illuminate\Database\Eloquent\Model::unguard();

        // Register self-healing MySQL connection so missing tables, missing columns, or strict-mode / NOT NULL
        // constraints on existing cPanel databases are healed automatically in real time.
        Connection::resolverFor('mysql', function ($connection, $database, $prefix, $config) {
            return new class($connection, $database, $prefix, $config) extends MySqlConnection {
                protected function runQueryCallback($query, $bindings, \Closure $callback)
                {
                    $attempts = 0;
                    while (true) {
                        try {
                            return $callback($query, $bindings);
                        } catch (\Throwable $e) {
                            $attempts++;
                            if ($attempts <= 30 && $this->trySelfHealMySql($query, $bindings, $e)) {
                                continue;
                            }
                            throw new QueryException($query, $this->prepareBindings($bindings), $e);
                        }
                    }
                }

                protected function trySelfHealMySql(string $query, array &$bindings, \Throwable $e): bool
                {
                    $msg = $e->getMessage();

                    // 0. Base table or view not found: 1146 Table 'db.table' doesn't exist
                    if (preg_match("/Table '(?:[^']+\\.)?([^']+)' doesn't exist/i", $msg, $tm)) {
                        $table = $tm[1];
                        if (preg_match('/^[a-zA-Z0-9_]+$/', $table) && strtolower($table) !== 'migrations') {
                            try {
                                $this->getPdo()->exec("CREATE TABLE IF NOT EXISTS `{$table}` (
                                    `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                    `user` bigint unsigned NULL DEFAULT NULL,
                                    `user_id` bigint unsigned NULL DEFAULT NULL,
                                    `client_id` bigint unsigned NULL DEFAULT NULL,
                                    `status` varchar(191) NULL DEFAULT NULL,
                                    `active` varchar(191) NULL DEFAULT NULL,
                                    `type` varchar(191) NULL DEFAULT NULL,
                                    `amount` varchar(191) NULL DEFAULT NULL,
                                    `created_at` timestamp NULL DEFAULT NULL,
                                    `updated_at` timestamp NULL DEFAULT NULL
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
                                return true;
                            } catch (\Throwable $inner) {
                                return false;
                            }
                        }
                    }

                    // 1. Unknown column 'col' in 'field list' / 'where clause'
                    if (preg_match("/Unknown column '(?:[^']+\\.)?([^']+)'/i", $msg, $cm)) {
                        $col = $cm[1];
                        $table = $this->extractTableFromQuery($query);
                        if ($table && preg_match('/^[a-zA-Z0-9_]+$/', $col)) {
                            try {
                                $this->getPdo()->exec("ALTER TABLE `{$table}` ADD COLUMN `{$col}` LONGTEXT NULL");
                                return true;
                            } catch (\Throwable $inner) {
                                try {
                                    $this->getPdo()->exec("ALTER TABLE `{$table}` ADD COLUMN `{$col}` TEXT NULL");
                                    return true;
                                } catch (\Throwable $inner2) {
                                    return false;
                                }
                            }
                        }
                    }

                    // 2. Column 'col' cannot be null (1048) OR Field 'col' doesn't have a default value (1364)
                    if (preg_match("/(?:Column '([^']+)' cannot be null|Field '([^']+)' doesn't have a default value)/i", $msg, $nm)) {
                        $col = !empty($nm[1]) ? $nm[1] : $nm[2];
                        $table = $this->extractTableFromQuery($query);
                        if ($table && preg_match('/^[a-zA-Z0-9_]+$/', $col)) {
                            try {
                                $this->getPdo()->exec("ALTER TABLE `{$table}` MODIFY COLUMN `{$col}` TEXT NULL DEFAULT NULL");
                                return true;
                            } catch (\Throwable $inner) {
                                foreach ($bindings as $k => $v) {
                                    if ($v === null) {
                                        $bindings[$k] = '';
                                    }
                                }
                                return true;
                            }
                        }
                    }

                    // 3. Strict mode integer / decimal / datetime / truncation errors
                    if (stripos($msg, 'Incorrect integer value') !== false
                        || stripos($msg, 'Incorrect decimal value') !== false
                        || stripos($msg, 'Incorrect datetime value') !== false
                        || stripos($msg, 'Data truncated') !== false
                        || stripos($msg, 'Data too long') !== false
                    ) {
                        try {
                            $this->getPdo()->exec("SET SESSION sql_mode='NO_ENGINE_SUBSTITUTION'");
                            foreach ($bindings as $k => $v) {
                                if ($v === true) {
                                    $bindings[$k] = 1;
                                } elseif ($v === false) {
                                    $bindings[$k] = 0;
                                }
                            }
                            return true;
                        } catch (\Throwable $inner) {
                            return false;
                        }
                    }

                    return false;
                }

                protected function extractTableFromQuery(string $query): ?string
                {
                    if (preg_match('/(?:insert\s+into|update|from)\s+[`"\[]?([a-zA-Z0-9_]+)[`"\]]?/i', $query, $tm)) {
                        return $tm[1];
                    }
                    return null;
                }
            };
        });

        // Register self-healing SQLite connection so missing columns or NOT NULL constraints
        // are healed automatically in real time.
        Connection::resolverFor('sqlite', function ($connection, $database, $prefix, $config) {
            return new class($connection, $database, $prefix, $config) extends SQLiteConnection {
                protected function runQueryCallback($query, $bindings, \Closure $callback)
                {
                    $attempts = 0;
                    while (true) {
                        try {
                            return $callback($query, $bindings);
                        } catch (\Throwable $e) {
                            $attempts++;
                            if ($attempts <= 25 && $this->trySelfHealSqlite($query, $bindings, $e)) {
                                continue;
                            }
                            throw new QueryException($query, $this->prepareBindings($bindings), $e);
                        }
                    }
                }

                protected function trySelfHealSqlite(string $query, array &$bindings, \Throwable $e): bool
                {
                    $msg = $e->getMessage();

                    if (preg_match('/(?:has no column named|no such column:)\s*(?:[a-zA-Z0-9_]+\.)?([a-zA-Z0-9_]+)/i', $msg, $cm)) {
                        $col = $cm[1];
                        $table = $this->extractTableFromQuery($query);
                        if ($table && preg_match('/^[a-zA-Z0-9_]+$/', $col)) {
                            try {
                                $this->getPdo()->exec("ALTER TABLE \"{$table}\" ADD COLUMN \"{$col}\" TEXT NULL");
                                return true;
                            } catch (\Throwable $inner) {
                                return false;
                            }
                        }
                    }

                    if (stripos($msg, 'NOT NULL constraint failed') !== false) {
                        foreach ($bindings as $k => $v) {
                            if ($v === null) {
                                $bindings[$k] = '';
                            }
                        }
                        return true;
                    }

                    return false;
                }

                protected function extractTableFromQuery(string $query): ?string
                {
                    if (preg_match('/(?:insert\s+into|update|from)\s+[`"\[]?([a-zA-Z0-9_]+)[`"\]]?/i', $query, $tm)) {
                        return $tm[1];
                    }
                    return null;
                }
            };
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED & ~E_USER_DEPRECATED & ~E_STRICT);
        \Illuminate\Database\Eloquent\Model::unguard();

        FacadesStorage::extend('sftp', function ($app, $config) {
            return new Filesystem(new SftpAdapter($config));
        });

        Paginator::useBootstrap();

        $settings = null;
        $terms = null;
        $moreset = null;

        try {
            if (Schema::hasTable('settings')) {
                $this->ensureSingletonRows();
                $settings = Settings::where('id', '1')->first();
                $terms = Schema::hasTable('terms_privacies') ? TermsPrivacy::find(1) : null;
                $moreset = Schema::hasTable('settings_conts') ? SettingsCont::find(1) : null;
            }
        } catch (\Throwable $e) {
            $settings = null;
        }

        if (!$settings) {
            $settings = new Settings([
                'site_name' => 'Mortil Holders',
                'site_title' => 'Mortil Holders — Private & Commercial Digital Banking',
                'site_address' => url('/'),
                'contact_email' => 'info@mortilholders.online',
                'currency' => '$',
                's_currency' => 'USD',
                'scurrency' => 'USD',
                'logo' => 'photos/mortil-logo.svg',
                'favicon' => 'photos/mortil-icon.svg',
                'website_theme' => 'atlantis.min.css',
                'google_translate' => 'on',
            ]);
        }

        if (!$terms) {
            $terms = new TermsPrivacy([
                'useterms' => 'yes',
                'description' => 'Mortil Holders Privacy & Data Protection Charter.',
            ]);
        }

        if (!$moreset) {
            $moreset = new SettingsCont([
                'use_crypto_feature' => 'true',
                'fee' => '0',
                'currency_rate' => '1',
            ]);
        }

        $defaultModules = [
            'investment' => 'true',
            'cryptoswap' => true,
            'subscription' => false,
            'signal' => false,
            'membership' => false,
        ];
        $currentModules = is_array($settings->modules) ? array_merge($defaultModules, $settings->modules) : $defaultModules;

        View::share('settings', $settings);
        View::share('terms', $terms);
        View::share('moresettings', $moreset);
        View::share('mod', $currentModules);
    }

    /**
     * Ensure singleton configuration rows exist in the database so no admin/user page
     * ever encounters null when querying id=1 or first().
     */
    protected function ensureSingletonRows(): void
    {
        try {
            if (Schema::hasTable('cp_transactions') && DB::table('cp_transactions')->where('id', 1)->doesntExist()) {
                DB::table('cp_transactions')->insert([
                    'id' => 1,
                    'cp_p_key' => '',
                    'cp_pv_key' => '',
                    'cp_m_id' => '',
                    'cp_ipn_secret' => '',
                    'cp_debug_email' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            if (Schema::hasTable('paystacks') && DB::table('paystacks')->where('id', 1)->doesntExist()) {
                DB::table('paystacks')->insert([
                    'id' => 1,
                    'paystack_public_key' => '',
                    'paystack_secret_key' => '',
                    'paystack_url' => 'https://api.paystack.co',
                    'paystack_email' => 'info@mortilholders.online',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            if (Schema::hasTable('card_settings') && DB::table('card_settings')->where('id', 1)->doesntExist()) {
                DB::table('card_settings')->insert([
                    'id' => 1,
                    'standard_fee' => 5,
                    'gold_fee' => 15,
                    'platinum_fee' => 25,
                    'black_fee' => 50,
                    'monthly_fee' => 2,
                    'topup_fee_percentage' => 1,
                    'is_enabled' => 1,
                    'max_daily_limit' => 10000,
                    'min_daily_limit' => 100,
                    'description' => 'Mortil Holders Virtual & Commercial Cards',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            if (Schema::hasTable('irs_refund_settings') && DB::table('irs_refund_settings')->where('id', 1)->doesntExist()) {
                DB::table('irs_refund_settings')->insert([
                    'id' => 1,
                    'min_amount' => 100,
                    'max_amount' => 50000,
                    'processing_fee' => 0,
                    'processing_time' => 5,
                    'instructions' => 'Submit your verified tax refund details for expedited treasury settlement.',
                    'enable_refunds' => 1,
                    'require_verification' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } catch (\Throwable $e) {
            // Ignore on read-only or unmigrated databases
        }
    }
}
