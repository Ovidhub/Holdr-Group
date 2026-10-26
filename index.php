<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', '0');

define('LARAVEL_START', microtime(true));

$basePath = __DIR__;

// 1. If .env is missing (e.g. hidden dotfile skipped during upload), copy .env.example to .env
$envFile = $basePath . '/.env';
$envExample = $basePath . '/.env.example';
if (!file_exists($envFile) && file_exists($envExample)) {
    @copy($envExample, $envFile);
}

// 2. Ensure storage and bootstrap/cache directories exist
$requiredDirs = [
    $basePath . '/storage/app/public',
    $basePath . '/storage/framework/views',
    $basePath . '/storage/framework/cache/data',
    $basePath . '/storage/framework/sessions',
    $basePath . '/storage/logs',
    $basePath . '/bootstrap/cache',
];
foreach ($requiredDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0775, true);
    }
}

// 3. Parse .env key-values to verify MySQL connectivity or fall back gracefully to SQLite
$envVars = [];
if (file_exists($envFile)) {
    $lines = @file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#' || strpos($line, '=') === false) {
            continue;
        }
        [$k, $v] = explode('=', $line, 2);
        $k = trim($k);
        $v = trim($v);
        if ((substr($v, 0, 1) === '"' && substr($v, -1) === '"') || (substr($v, 0, 1) === "'" && substr($v, -1) === "'")) {
            $v = substr($v, 1, -1);
        }
        $envVars[$k] = $v;
    }
}

$setEnvVar = static function (string $key, string $val): void {
    putenv("$key=$val");
    $_ENV[$key] = $val;
    $_SERVER[$key] = $val;
};

// Auto-detect current URL scheme and host so APP_URL always matches the live domain (e.g. auth.orynvest.online)
$proto = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http');
if ($proto === 'https') {
    $_SERVER['HTTPS'] = 'on';
}
if (!empty($_SERVER['HTTP_HOST'])) {
    $setEnvVar('APP_URL', $proto . '://' . $_SERVER['HTTP_HOST']);
}

$dbConn = $envVars['DB_CONNECTION'] ?? getenv('DB_CONNECTION') ?: 'mysql';
if ($dbConn === 'mysql') {
    $dbHost = $envVars['DB_HOST'] ?? getenv('DB_HOST') ?: '127.0.0.1';
    $dbPort = $envVars['DB_PORT'] ?? getenv('DB_PORT') ?: '3306';
    $dbName = $envVars['DB_DATABASE'] ?? getenv('DB_DATABASE') ?: '';
    $dbUser = $envVars['DB_USERNAME'] ?? getenv('DB_USERNAME') ?: '';
    $dbPass = $envVars['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?: '';

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

                // Check if `settings` table exists; if not, auto-import database/mortil_holders_mysql.sql
                $check = $pdo->query("SHOW TABLES LIKE 'settings'");
                if ($check && $check->rowCount() === 0) {
                    $sqlDumpPath = $basePath . '/database/mortil_holders_mysql.sql';
                    if (file_exists($sqlDumpPath)) {
                        $sqlContent = file_get_contents($sqlDumpPath);
                        $pdo->exec($sqlContent);
                    }
                }
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
        // Fallback to pre-seeded SQLite database so the site works immediately without 500 errors
        $seedSqlite = $basePath . '/storage/vercel-seed.sqlite';
        $runtimeSqlite = $basePath . '/storage/database.sqlite';
        if (!is_writable($basePath . '/storage')) {
            $runtimeSqlite = rtrim(sys_get_temp_dir(), '/\\') . '/mortil-database.sqlite';
        }
        if ((!file_exists($runtimeSqlite) || filesize($runtimeSqlite) === 0) && file_exists($seedSqlite)) {
            @copy($seedSqlite, $runtimeSqlite);
        }
        if (file_exists($runtimeSqlite)) {
            $setEnvVar('DB_CONNECTION', 'sqlite');
            $setEnvVar('DB_DATABASE', $runtimeSqlite);
        }
    }
}

if (file_exists($basePath . '/storage/framework/maintenance.php')) {
    require $basePath . '/storage/framework/maintenance.php';
}

require $basePath . '/vendor/autoload.php';

$app = require_once $basePath . '/bootstrap/app.php';

// If storage/framework/views is not writable on shared hosting, use system temp directory
if (!is_writable($basePath . '/storage/framework/views')) {
    $tmpStorage = rtrim(sys_get_temp_dir(), '/\\') . '/mortil_storage';
    foreach (['/app/public', '/framework/views', '/framework/cache/data', '/framework/sessions', '/logs'] as $sub) {
        if (!is_dir($tmpStorage . $sub)) {
            @mkdir($tmpStorage . $sub, 0775, true);
        }
    }
    $app->useStoragePath($tmpStorage);
}

$kernel = $app->make(Kernel::class);

$response = tap($kernel->handle(
    $request = Request::capture()
))->send();

$kernel->terminate($request, $response);
