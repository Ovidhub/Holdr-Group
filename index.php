<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Safe Directory, Cache & Optional SQLite Fallback Bootstrap (cPanel-safe)
|--------------------------------------------------------------------------
| Uses no disabled functions (no ini_set, glob, sys_get_temp_dir, or
| unguarded putenv) so strict CloudLinux / LiteSpeed / suPHP hosts never
| throw pre-boot fatal errors.
*/

try {
    $basePath = __DIR__;

    // 1. Ensure .env exists if only .env.example was uploaded
    $envFile = $basePath . '/.env';
    $envExample = $basePath . '/.env.example';
    if (!file_exists($envFile) && file_exists($envExample)) {
        @copy($envExample, $envFile);
    }

    // 2. Ensure storage/app/public/photos exists with cPanel-safe 0755 permissions
    $photosDir = $basePath . '/storage/app/public/photos';
    if (!is_dir($photosDir)) {
        @mkdir($photosDir, 0755, true);
    }

    // 3. Flush stale compiled Blade views & cached route map once after update
    $flushMarker = $basePath . '/storage/framework/.avatar_fix_v3';
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

    // 4. Preserve SQLite fallback ONLY if storage/database.sqlite (or seed) exists AND .env has unconfigured root credentials
    $runtimeSqlite = $basePath . '/storage/database.sqlite';
    $seedSqlite = $basePath . '/storage/vercel-seed.sqlite';
    if (file_exists($runtimeSqlite) || file_exists($seedSqlite)) {
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

        $dbConn = isset($envVars['DB_CONNECTION']) ? $envVars['DB_CONNECTION'] : 'mysql';
        $dbUser = isset($envVars['DB_USERNAME']) ? $envVars['DB_USERNAME'] : '';
        $dbPass = isset($envVars['DB_PASSWORD']) ? $envVars['DB_PASSWORD'] : '';

        if ($dbConn === 'mysql' && ($dbUser === '' || ($dbUser === 'root' && $dbPass === ''))) {
            if ((!file_exists($runtimeSqlite) || @filesize($runtimeSqlite) === 0) && file_exists($seedSqlite)) {
                @copy($seedSqlite, $runtimeSqlite);
            }
            if (file_exists($runtimeSqlite)) {
                if (function_exists('putenv')) {
                    @putenv('DB_CONNECTION=sqlite');
                    @putenv('DB_DATABASE=' . $runtimeSqlite);
                }
                $_ENV['DB_CONNECTION'] = 'sqlite';
                $_SERVER['DB_CONNECTION'] = 'sqlite';
                $_ENV['DB_DATABASE'] = $runtimeSqlite;
                $_SERVER['DB_DATABASE'] = $runtimeSqlite;
            }
        }
    }
} catch (\Throwable $e) {
    // Continue normal Laravel boot
}

/*
|--------------------------------------------------------------------------
| Check If Application Is Under Maintenance
|--------------------------------------------------------------------------
*/

if (file_exists(__DIR__ . '/storage/framework/maintenance.php')) {
    require __DIR__ . '/storage/framework/maintenance.php';
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
*/

require __DIR__ . '/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
*/

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = tap($kernel->handle(
    $request = Request::capture()
))->send();

$kernel->terminate($request, $response);
