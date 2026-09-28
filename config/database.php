<?php
/**
 * ============================================================
 * Database credentials
 * ------------------------------------------------------------
 * Values are read from the .env file (see .env.example) when
 * present, otherwise these safe defaults are used.
 *
 *  • XAMPP (local): host 127.0.0.1, user root, empty password.
 *    NOTE: if XAMPP MySQL runs on a non-standard port (e.g. 3307
 *    because another MySQL/MariaDB uses 3306), set DB_PORT in .env.
 *  • Hostinger: set DB_* in .env (host localhost, port 3306).
 * ============================================================
 */

declare(strict_types=1);

define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'cevm_cms');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') !== false ? getenv('DB_PASS') : '');
define('DB_CHARSET', getenv('DB_CHARSET') ?: 'utf8mb4');

// Table prefix (keep default unless sharing a database)
define('DB_PREFIX', getenv('DB_PREFIX') ?: 'cevm_');
