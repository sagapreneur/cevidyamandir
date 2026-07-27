<?php
/**
 * ============================================================
 * Database credentials
 * ------------------------------------------------------------
 * Credentials are loaded from the project .env file (NOT committed
 * to source control). If .env is missing, safe local XAMPP defaults
 * are used so development keeps working. Copy .env.example to .env
 * and fill in the production values on the server.
 * ============================================================
 */

declare(strict_types=1);

// ---- Minimal .env loader (no external dependency) ----
if (!function_exists('env_value')) {
    function env_value(string $key, string $default = ''): string
    {
        static $env = null;
        if ($env === null) {
            $env = [];
            $file = ROOT_PATH . '/.env';
            if (is_file($file)) {
                foreach (file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
                    $line = trim($line);
                    if ($line === '' || $line[0] === '#' || !str_contains($line, '=')) {
                        continue;
                    }
                    [$k, $v] = explode('=', $line, 2);
                    $k = trim($k);
                    $v = trim($v);
                    if (strlen($v) >= 2 && ($v[0] === '"' || $v[0] === "'") && $v[strlen($v) - 1] === $v[0]) {
                        $v = substr($v, 1, -1);
                    }
                    $env[$k] = $v;
                }
            }
        }
        if (array_key_exists($key, $env)) {
            return $env[$key];
        }
        $sys = getenv($key);
        return $sys !== false ? $sys : $default;
    }
}

// ---- Database connection (values come from .env; fallbacks are local dev only) ----
define('DB_HOST', env_value('DB_HOST', '127.0.0.1'));
define('DB_PORT', env_value('DB_PORT', '3307'));   // Production (Hostinger): typically 3306
define('DB_NAME', env_value('DB_NAME', 'cevm_cms'));
define('DB_USER', env_value('DB_USER', 'root'));
define('DB_PASS', env_value('DB_PASS', ''));
define('DB_CHARSET', env_value('DB_CHARSET', 'utf8mb4'));

// Table prefix (keep default unless sharing a database)
define('DB_PREFIX', env_value('DB_PREFIX', 'cevm_'));
