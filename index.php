<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED & ~E_NOTICE & ~E_WARNING);
if (function_exists('ini_set')) {
    @ini_set('display_errors', '0');
}

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Self-Healing cPanel Bootstrap (Preserves Existing .env, DB & Uploaded Logos)
|--------------------------------------------------------------------------
*/

try {
    $basePath = __DIR__;

    // 1. Create .env from .env.example ONLY if .env does not already exist
    $envFile = $basePath . '/.env';
    $envExample = $basePath . '/.env.example';
    if (!file_exists($envFile) && file_exists($envExample)) {
        @copy($envExample, $envFile);
    }

    // 2. Ensure storage and bootstrap/cache directories exist with cPanel-safe 0755 permissions
    $requiredDirs = [
        $basePath . '/storage/app/public',
        $basePath . '/storage/app/public/photos',
        $basePath . '/storage/framework/views',
        $basePath . '/storage/framework/cache/data',
        $basePath . '/storage/framework/sessions',
        $basePath . '/storage/logs',
        $basePath . '/bootstrap/cache',
    ];
    foreach ($requiredDirs as $dir) {
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
    }

    // 3. Flush stale compiled Blade views & route cache once after update (without glob)
    $flushMarker = $basePath . '/storage/framework/.avatar_fix_v4';
    if (is_dir($basePath . '/storage/framework') && !file_exists($flushMarker) && function_exists('scandir')) {
        $viewsDir = $basePath . '/storage/framework/views';
        if (is_dir($viewsDir) && is_writable($viewsDir)) {
            $entries = @scandir($viewsDir);
            if (is_array($entries)) {
                foreach ($entries as $entry) {
                    if ($entry !== '.' && $entry !== '..' && substr($entry, -4) === '.php') {
                        @unlink($viewsDir . '/' . $entry);
                    }
                }
            }
        }

        $cacheDir = $basePath . '/bootstrap/cache';
        if (is_dir($cacheDir) && is_writable($cacheDir)) {
            $entries = @scandir($cacheDir);
            if (is_array($entries)) {
                foreach ($entries as $entry) {
                    if (strpos($entry, 'routes') === 0 && substr($entry, -4) === '.php') {
                        @unlink($cacheDir . '/' . $entry);
                    }
                }
            }
        }

        @file_put_contents($flushMarker, '1');
    }

    // 4. Safe environment helper (works even when putenv is in disable_functions)
    $safeSetEnv = function ($key, $val) {
        if (function_exists('putenv')) {
            @putenv($key . '=' . $val);
        }
        $_ENV[$key] = $val;
        $_SERVER[$key] = $val;
    };

    $proto = isset($_SERVER['HTTP_X_FORWARDED_PROTO'])
        ? $_SERVER['HTTP_X_FORWARDED_PROTO']
        : ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http');
    if ($proto === 'https') {
        $_SERVER['HTTPS'] = 'on';
    }
    if (!empty($_SERVER['HTTP_HOST'])) {
        $safeSetEnv('APP_URL', $proto . '://' . $_SERVER['HTTP_HOST']);
    }

    // 5. Verify MySQL connectivity (preserving all existing tables/data) or fall back to SQLite
    $envVars = [];
    if (file_exists($envFile)) {
        $lines = @file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (is_array($lines)) {
            foreach ($lines as $line) {
                $line = trim($line);
                if ($line === '' || $line[0] === '#' || strpos($line, '=') === false) {
                    continue;
                }
                $parts = explode('=', $line, 2);
                $k = trim($parts[0]);
                $v = trim($parts[1]);
                if ((substr($v, 0, 1) === '"' && substr($v, -1) === '"') || (substr($v, 0, 1) === "'" && substr($v, -1) === "'")) {
                    $v = substr($v, 1, -1);
                }
                $envVars[$k] = $v;
            }
        }
    }

    $envGet = function ($key, $default) use ($envVars) {
        if (isset($envVars[$key])) {
            return $envVars[$key];
        }
        if (function_exists('getenv')) {
            $g = @getenv($key);
            if ($g !== false && $g !== '') {
                return $g;
            }
        }
        return $default;
    };

    $dbConn = $envGet('DB_CONNECTION', 'mysql');
    if ($dbConn === 'mysql') {
        $dbHost = $envGet('DB_HOST', '127.0.0.1');
        $dbPort = $envGet('DB_PORT', '3306') ?: '3306';
        $dbName = $envGet('DB_DATABASE', '');
        $dbUser = $envGet('DB_USERNAME', '');
        $dbPass = $envGet('DB_PASSWORD', '');

        $mysqlConnected = false;
        $workingHost = $dbHost;
        $hostsToTry = array_unique([$dbHost, ($dbHost === '127.0.0.1' ? 'localhost' : '127.0.0.1')]);

        if ($dbName !== '' && $dbUser !== '' && extension_loaded('pdo_mysql')) {
            foreach ($hostsToTry as $tryHost) {
                try {
                    $dsn = "mysql:host={$tryHost};port={$dbPort};dbname={$dbName};charset=utf8mb4";
                    $pdo = new PDO($dsn, $dbUser, $dbPass, [
                        PDO::ATTR_TIMEOUT => 3,
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    ]);
                    $workingHost = $tryHost;
                    $mysqlConnected = true;

                    // Import initial SQL ONLY if database has zero settings table (never overwrites edited text/logo)
                    $check = $pdo->query("SHOW TABLES LIKE 'settings'");
                    if ($check && $check->rowCount() === 0) {
                        $sqlDumpPath = $basePath . '/database/mortil_holders_mysql.sql';
                        if (file_exists($sqlDumpPath)) {
                            $sqlContent = @file_get_contents($sqlDumpPath);
                            if ($sqlContent) {
                                $pdo->exec($sqlContent);
                            }
                        }
                    }
                    $pdo = null;
                    break;
                } catch (\Throwable $e) {
                    $mysqlConnected = false;
                }
            }
        }

        if ($mysqlConnected) {
            if ($workingHost !== $dbHost) {
                $safeSetEnv('DB_HOST', $workingHost);
            }
        } else {
            // Preserve existing storage/database.sqlite if present; only copy seed if database.sqlite is missing
            $seedSqlite = $basePath . '/storage/vercel-seed.sqlite';
            $runtimeSqlite = $basePath . '/storage/database.sqlite';
            if ((!file_exists($runtimeSqlite) || @filesize($runtimeSqlite) === 0) && file_exists($seedSqlite)) {
                @copy($seedSqlite, $runtimeSqlite);
            }
            if (file_exists($runtimeSqlite)) {
                $safeSetEnv('DB_CONNECTION', 'sqlite');
                $safeSetEnv('DB_DATABASE', $runtimeSqlite);
            }
        }
    }
} catch (\Throwable $e) {
    // Continue normal Laravel boot
}

if (file_exists(__DIR__ . '/storage/framework/maintenance.php')) {
    require __DIR__ . '/storage/framework/maintenance.php';
}

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = tap($kernel->handle(
    $request = Request::capture()
))->send();

$kernel->terminate($request, $response);
