<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', '0');

$basePath = dirname(__DIR__);

// Serve static assets directly when running under PHP built-in server (`php -S`)
$uriPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
if ($uriPath !== '/' && $uriPath !== '/index.php' && $uriPath !== '/api/index.php') {
    $candidate = realpath($basePath . '/' . ltrim($uriPath, '/'));
    if (
        $candidate &&
        strpos($candidate, $basePath) === 0 &&
        is_file($candidate) &&
        pathinfo($candidate, PATHINFO_EXTENSION) !== 'php'
    ) {
        return false;
    }
}

define('LARAVEL_START', microtime(true));

// Ensure writable runtime directories in /tmp for serverless environment
$tmpStorage = '/tmp/storage';
$runtimeDirs = [
    $tmpStorage . '/app/public',
    $tmpStorage . '/bootstrap/cache',
    $tmpStorage . '/framework/views',
    $tmpStorage . '/framework/cache/data',
    $tmpStorage . '/framework/sessions',
    $tmpStorage . '/logs',
    '/tmp/bootstrap/cache',
];
foreach ($runtimeDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0775, true);
    }
}

$prebuiltLivewireManifest = $basePath . '/bootstrap/cache/livewire-components.php';
$runtimeLivewireManifest = '/tmp/bootstrap/cache/livewire-components.php';
if (file_exists($prebuiltLivewireManifest) && !file_exists($runtimeLivewireManifest)) {
    @copy($prebuiltLivewireManifest, $runtimeLivewireManifest);
}

$setDefaultEnv = static function (string $key, string $value): void {
    $current = getenv($key);
    if ($current === false || $current === '') {
        putenv("$key=$value");
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
};

// Detect host / scheme from proxy headers
$proto = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http');
if ($proto === 'https') {
    $_SERVER['HTTPS'] = 'on';
}
$host = $_SERVER['HTTP_X_FORWARDED_HOST'] ?? $_SERVER['HTTP_HOST'] ?? 'localhost';
$setDefaultEnv('APP_URL', $proto . '://' . $host);

$setDefaultEnv('APP_NAME', 'Mortil Holders');
$setDefaultEnv('APP_ENV', 'production');
$setDefaultEnv('APP_DEBUG', 'false');
$setDefaultEnv('APP_KEY', 'base64:6Cu/ozj4gPtIjmXjr8EdVnGFNsdRqZfHfVjQkmTlg4Y=');
$setDefaultEnv('VIEW_COMPILED_PATH', $tmpStorage . '/framework/views');
$setDefaultEnv('SSR_TEMP_PATH', '/tmp');
$setDefaultEnv('APP_SERVICES_CACHE', '/tmp/bootstrap/cache/services.php');
$setDefaultEnv('APP_PACKAGES_CACHE', '/tmp/bootstrap/cache/packages.php');
$setDefaultEnv('APP_CONFIG_CACHE', '/tmp/bootstrap/cache/config.php');
$setDefaultEnv('APP_ROUTES_CACHE', '/tmp/bootstrap/cache/routes.php');
$setDefaultEnv('APP_EVENTS_CACHE', '/tmp/bootstrap/cache/events.php');
$setDefaultEnv('LIVEWIRE_MANIFEST_PATH', '/tmp/bootstrap/cache/livewire-components.php');
$setDefaultEnv('CACHE_DRIVER', 'file');
$setDefaultEnv('SESSION_DRIVER', 'cookie');
$setDefaultEnv('SESSION_LIFETIME', '1440');
$setDefaultEnv('LOG_CHANNEL', 'stderr');
$setDefaultEnv('MAIL_MAILER', 'log');

// Use pre-seeded SQLite database in /tmp when no external DB_HOST is configured
$dbHost = getenv('DB_HOST');
$dbUrl = getenv('DATABASE_URL');
if (($dbHost === false || $dbHost === '' || $dbHost === '127.0.0.1') && ($dbUrl === false || $dbUrl === '')) {
    $runtimeSqlite = '/tmp/database-v7.sqlite';
    $seedSqlite = $basePath . '/storage/vercel-seed.sqlite';
    if (!file_exists($runtimeSqlite) || filesize($runtimeSqlite) === 0) {
        if (file_exists($seedSqlite)) {
            @copy($seedSqlite, $runtimeSqlite);
        } else {
            @touch($runtimeSqlite);
        }
    }
    putenv('DB_CONNECTION=sqlite');
    $_ENV['DB_CONNECTION'] = 'sqlite';
    $_SERVER['DB_CONNECTION'] = 'sqlite';
    putenv('DB_DATABASE=' . $runtimeSqlite);
    $_ENV['DB_DATABASE'] = $runtimeSqlite;
    $_SERVER['DB_DATABASE'] = $runtimeSqlite;
}

// Normalize script paths so Symfony Request::capture() resolves the root URL properly
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = $basePath . '/index.php';
$_SERVER['PHP_SELF'] = '/index.php';

require $basePath . '/vendor/autoload.php';

$app = require $basePath . '/bootstrap/app.php';
$app->useStoragePath($tmpStorage);

$kernel = $app->make(Kernel::class);

$response = tap($kernel->handle(
    $request = Request::capture()
))->send();

$kernel->terminate($request, $response);
