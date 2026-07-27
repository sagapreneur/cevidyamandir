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
    // Production: never display errors to visitors, but log them for diagnostics.
    error_reporting(E_ALL);
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');
    $__logDir = dirname(__DIR__) . '/storage/logs';
    if (is_dir($__logDir) && is_writable($__logDir)) {
        ini_set('error_log', $__logDir . '/php-error.log');
    }
}

// ---- Paths -------------------------------------------------------
define('ROOT_PATH', dirname(__DIR__));               // project root (= public_html)
define('APP_PATH', ROOT_PATH . '/app');
define('CONFIG_PATH', ROOT_PATH . '/config');
define('STORAGE_PATH', ROOT_PATH . '/storage');
define('UPLOAD_PATH', STORAGE_PATH . '/uploads');
define('LOG_PATH', STORAGE_PATH . '/logs');
define('VIEW_PATH', APP_PATH . '/Views');

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
