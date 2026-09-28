<?php
/**
 * ============================================================
 * C. E. Vidya Mandir CMS — application configuration
 * ------------------------------------------------------------
 * Central runtime config. Loaded by every entry point
 * (index.php, admin/index.php, install.php).
 * ============================================================
 */

declare(strict_types=1);

// ---- Environment -------------------------------------------------
// Auto-detects localhost (XAMPP) → development (errors visible);
// any real domain (Hostinger) → production (errors hidden).
$__host = $_SERVER['HTTP_HOST'] ?? '';
define(
    'APP_ENV',
    preg_match('/^(localhost|127\.0\.0\.1|\[::1\]|.*\.test|.*\.local)(:\d+)?$/i', $__host)
        ? 'development'
        : 'production'
);

if (APP_ENV === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');

    // Friendly fallback page for uncaught errors (no blank screens in production).
    $renderFatal = static function (): void {
        if (headers_sent()) return;
        http_response_code(500);
        echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8">'
            . '<meta name="viewport" content="width=device-width, initial-scale=1">'
            . '<title>Temporarily unavailable</title>'
            . '<style>body{font-family:Poppins,system-ui,sans-serif;background:#f3f6fc;color:#14213d;'
            . 'display:grid;place-items:center;min-height:100vh;margin:0;text-align:center}'
            . '.b{max-width:460px;padding:40px}.b h1{font-size:22px;margin:0 0 10px}'
            . '.b p{color:#5b6576}a{color:#1c3f94}</style></head><body><div class="b">'
            . '<h1>We&rsquo;ll be right back</h1><p>The page is temporarily unavailable. '
            . 'Please try again in a moment.</p><p><a href="./">Return to homepage</a></p>'
            . '</div></body></html>';
    };
    set_exception_handler(static function ($e) use ($renderFatal) { $renderFatal(); });
    register_shutdown_function(static function () use ($renderFatal) {
        $err = error_get_last();
        if ($err && in_array($err['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)) {
            $renderFatal();
        }
    });
}

// ---- Paths -------------------------------------------------------
define('ROOT_PATH', dirname(__DIR__));               // project root (= public_html)
define('APP_PATH', ROOT_PATH . '/app');
define('CONFIG_PATH', ROOT_PATH . '/config');
define('STORAGE_PATH', ROOT_PATH . '/storage');
define('UPLOAD_PATH', STORAGE_PATH . '/uploads');
define('LOG_PATH', STORAGE_PATH . '/logs');
define('VIEW_PATH', APP_PATH . '/Views');

// ---- Load .env (KEY=VALUE) into the environment, if present ------
(static function (): void {
    $file = ROOT_PATH . '/.env';
    if (!is_file($file)) {
        return;
    }
    foreach (file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#') {
            continue;
        }
        [$key, $value] = array_pad(explode('=', $line, 2), 2, '');
        $key = trim($key);
        $value = trim($value);
        // strip surrounding quotes
        if (strlen($value) >= 2 && ($value[0] === '"' || $value[0] === "'")) {
            $value = substr($value, 1, -1);
        }
        if ($key !== '' && getenv($key) === false) {
            putenv("{$key}={$value}");
            $_ENV[$key] = $value;
        }
    }
})();

// ---- Base URL (auto-detected, works in root or sub-folder) -------
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host   = $_SERVER['HTTP_HOST'] ?? 'localhost';
// directory the app lives in relative to the docroot
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
// admin scripts live in /admin — strip it so BASE_URL is the site root
$scriptDir = preg_replace('#/admin$#', '', $scriptDir);
$scriptDir = rtrim($scriptDir, '/');
define('BASE_PATH', $scriptDir === '' ? '' : $scriptDir);      // e.g. '' or '/subdir'
define('BASE_URL', $scheme . '://' . $host . BASE_PATH);
define('ADMIN_URL', BASE_URL . '/admin');
define('UPLOAD_URL', BASE_URL . '/storage/uploads');

// ---- Security ----------------------------------------------------
define('CSRF_TOKEN_NAME', '_csrf');
define('SESSION_NAME', 'CEVMSESS');
define('PASSWORD_RESET_TTL', 3600);          // 1 hour
define('MAX_UPLOAD_BYTES', 10 * 1024 * 1024); // 10 MB
define('ALLOWED_UPLOAD_EXT', [
    'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'ico', 'pdf',
]);
define('ALLOWED_UPLOAD_MIME', [
    'image/jpeg', 'image/png', 'image/gif', 'image/webp',
    'image/svg+xml', 'image/x-icon', 'image/vnd.microsoft.icon',
    'application/pdf',
]);

// ---- Load database credentials ----------------------------------
require_once CONFIG_PATH . '/database.php';

// ---- PSR-4-ish autoloader (no Composer needed) ------------------
spl_autoload_register(static function (string $class): void {
    // App\Core\Database -> app/Core/Database.php
    if (strncmp($class, 'App\\', 4) !== 0) {
        return;
    }
    $relative = str_replace('\\', '/', substr($class, 4));
    $file = APP_PATH . '/' . $relative . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});

// ---- Shared helpers ---------------------------------------------
require_once APP_PATH . '/helpers.php';
