<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED & ~E_NOTICE & ~E_WARNING);
if (function_exists('ini_set')) {
    @ini_set('display_errors', '0');
}

define('LARAVEL_START', microtime(true));

$basePath = __DIR__;

try {
    // 1. If .env is missing (e.g. fresh folder upload), create from .env.example without overwriting an existing .env
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

    // Restore default fallback logo/icon only if not already present (never overwrites user-customized files)
    foreach (['mortil-logo.svg', 'mortil-icon.svg'] as $defAsset) {
        $targetAsset = $basePath . '/storage/app/public/photos/' . $defAsset;
        $defaultAsset = $basePath . '/storage/app/public/photos/.defaults/' . $defAsset;
        if (!file_exists($targetAsset) && file_exists($defaultAsset)) {
            @copy($defaultAsset, $targetAsset);
        }
    }

    // 3. Flush stale compiled Blade views & cached route map once after deploying this update
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

    // 4. Parse .env key-values to verify MySQL connectivity or fall back gracefully to existing/seed SQLite
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

    $setEnvVar = function ($key, $val) {
        if (function_exists('putenv')) {
            @putenv($key . '=' . $val);
        }
        $_ENV[$key] = $val;
        $_SERVER[$key] = $val;
    };

    // Auto-detect current URL scheme and host so APP_URL always matches the live domain
    $proto = isset($_SERVER['HTTP_X_FORWARDED_PROTO'])
        ? $_SERVER['HTTP_X_FORWARDED_PROTO']
        : ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http');
    if ($proto === 'https') {
        $_SERVER['HTTPS'] = 'on';
    }
    if (!empty($_SERVER['HTTP_HOST'])) {
        $setEnvVar('APP_URL', $proto . '://' . $_SERVER['HTTP_HOST']);
    }

    $envGet = function ($key, $default) use ($envVars) {
        if (isset($envVars[$key])) {
            return $envVars[$key];
        }
        if (function_exists('getenv')) {
            $val = @getenv($key);
            if ($val !== false && $val !== '') {
                return $val;
            }
        }
        return $default;
    };

    $dbConn = $envGet('DB_CONNECTION', 'mysql') ?: 'mysql';
    if ($dbConn === 'mysql') {
        $dbHost = $envGet('DB_HOST', '127.0.0.1') ?: '127.0.0.1';
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

                    // Only import initial SQL if the database has no `settings` table yet (never overwrites existing data)
                    $check = $pdo->query("SHOW TABLES LIKE 'settings'");
                    if ($check && $check->rowCount() === 0) {
                        $sqlDumpPath = $basePath . '/database/mortil_holders_mysql.sql';
                        if (file_exists($sqlDumpPath)) {
                            $sqlContent = @file_get_contents($sqlDumpPath);
                            if ($sqlContent !== false && $sqlContent !== '') {
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
                $setEnvVar('DB_HOST', $workingHost);
            }
        } else {
            // Fallback to existing storage/database.sqlite (preserving any prior edits) or seed SQLite
            $seedSqlite = $basePath . '/storage/vercel-seed.sqlite';
            $runtimeSqlite = $basePath . '/storage/database.sqlite';
            if (!file_exists($runtimeSqlite) && !is_writable($basePath . '/storage') && function_exists('sys_get_temp_dir')) {
                try {
                    $tmpDir = @sys_get_temp_dir();
                    if ($tmpDir && @is_writable($tmpDir)) {
                        $runtimeSqlite = rtrim($tmpDir, '/\\') . '/mortil-database.sqlite';
                    }
                } catch (\Throwable $e) {
                    // Keep storage path
                }
            }
            if ((!file_exists($runtimeSqlite) || @filesize($runtimeSqlite) === 0) && file_exists($seedSqlite)) {
                @copy($seedSqlite, $runtimeSqlite);
            }
            if (file_exists($runtimeSqlite)) {
                $setEnvVar('DB_CONNECTION', 'sqlite');
                $setEnvVar('DB_DATABASE', $runtimeSqlite);
            }
        }
    }
} catch (\Throwable $e) {
    // Continue normal Laravel boot
}

if (file_exists($basePath . '/storage/framework/maintenance.php')) {
    require $basePath . '/storage/framework/maintenance.php';
}

require $basePath . '/vendor/autoload.php';

$app = require_once $basePath . '/bootstrap/app.php';

try {
    if (!is_writable($basePath . '/storage/framework/views') && function_exists('sys_get_temp_dir')) {
        $tmpDir = @sys_get_temp_dir();
        if ($tmpDir && @is_writable($tmpDir)) {
            $tmpStorage = rtrim($tmpDir, '/\\') . '/mortil_storage';
            foreach (['/app/public', '/app/public/photos', '/framework/views', '/framework/cache/data', '/framework/sessions', '/logs'] as $sub) {
                if (!is_dir($tmpStorage . $sub)) {
                    @mkdir($tmpStorage . $sub, 0755, true);
                }
            }
            $app->useStoragePath($tmpStorage);
        }
    }
} catch (\Throwable $e) {
    // Use default storage path
}

$kernel = $app->make(Kernel::class);

$response = tap($kernel->handle(
    $request = Request::capture()
))->send();

$kernel->terminate($request, $response);
