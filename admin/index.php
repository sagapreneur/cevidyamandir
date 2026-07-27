<?php
/**
 * ============================================================
 * ADMIN FRONT CONTROLLER
 * All /admin/* requests route here (see admin/.htaccess).
 * ============================================================
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/config/config.php';

use App\Core\Session;
use App\Core\Csrf;
use App\Core\Auth;
use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\CrudController;
use App\Controllers\Admin\MediaController;
use App\Controllers\Admin\SettingsController;
use App\Controllers\Admin\FormsController;
use App\Controllers\Admin\ProfileController;
use App\Controllers\Admin\ActivityController;

Session::start();
Csrf::check(); // validates POST token on every write

// ---- Resolve the route relative to the /admin base ----
$adminBase = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/'); // e.g. /admin
$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
$route = '/' . ltrim(substr($uri, strlen($adminBase)), '/');
$route = rtrim($route, '/');
if ($route === '') {
    $route = '/dashboard';
}

// ---- Public routes (no auth) ----
if ($route === '/login') {
    (new AuthController())->login();
    exit;
}
if ($route === '/forgot') {
    (new AuthController())->forgot();
    exit;
}

// ---- Everything else requires authentication ----
Auth::requireLogin();
Auth::refresh();

try {
    switch (true) {
        case $route === '/dashboard':
            (new DashboardController())->index();
            break;

        case $route === '/logout':
            (new AuthController())->logout();
            break;

        case $route === '/profile':
            (new ProfileController())->index();
            break;

        case $route === '/password':
            (new ProfileController())->password();
            break;

        case $route === '/settings':
            (new SettingsController())->index();
            break;

        case $route === '/media':
            (new MediaController())->index();
            break;
        case $route === '/media/upload':
            (new MediaController())->upload();
            break;
        case preg_match('#^/media/delete/(\d+)$#', $route, $m) === 1:
            (new MediaController())->delete((int) $m[1]);
            break;

        case $route === '/forms':
            (new FormsController())->index();
            break;
        case $route === '/forms/export':
            (new FormsController())->export();
            break;
        case preg_match('#^/forms/view/(\d+)$#', $route, $m) === 1:
            (new FormsController())->view((int) $m[1]);
            break;
        case preg_match('#^/forms/delete/(\d+)$#', $route, $m) === 1:
            (new FormsController())->delete((int) $m[1]);
            break;

        case $route === '/activity':
            (new ActivityController())->index();
            break;

        // ---- Generic CRUD modules ----
        case preg_match('#^/module/([a-z_]+)/create$#', $route, $m) === 1:
            (new CrudController($m[1]))->create();
            break;
        case preg_match('#^/module/([a-z_]+)/edit/(\d+)$#', $route, $m) === 1:
            (new CrudController($m[1]))->edit((int) $m[2]);
            break;
        case preg_match('#^/module/([a-z_]+)/delete/(\d+)$#', $route, $m) === 1:
            (new CrudController($m[1]))->destroy((int) $m[2]);
            break;
        case preg_match('#^/module/([a-z_]+)$#', $route, $m) === 1:
            (new CrudController($m[1]))->index();
            break;

        default:
            http_response_code(404);
            echo 'Admin page not found.';
    }
} catch (\Throwable $e) {
    if (APP_ENV === 'development') {
        http_response_code(500);
        echo '<pre>' . e($e->getMessage()) . "\n" . e($e->getTraceAsString()) . '</pre>';
    } else {
        http_response_code(500);
        echo 'An error occurred.';
    }
}
