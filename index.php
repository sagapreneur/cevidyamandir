<?php
/**
 * ============================================================
 * PUBLIC FRONT CONTROLLER
 * All page requests (via .htaccess) route here. Renders pages
 * from the CMS database using the approved Phase-3 markup.
 * ============================================================
 */

declare(strict_types=1);

require_once __DIR__ . '/config/config.php';

use App\Core\Session;
use App\Core\Csrf;
use App\Controllers\Site\PageController;

// If the CMS database isn't ready yet, serve the static build as a fallback.
if (!cms_installed()) {
    $slug = preg_replace('/[^a-z0-9\-]/', '', (string) ($_GET['page'] ?? 'index')) ?: 'index';
    $static = __DIR__ . '/' . $slug . '.html';
    readfile(is_file($static) ? $static : __DIR__ . '/index.html');
    exit;
}

Session::start();

$page = (string) ($_GET['page'] ?? 'index');
$page = preg_replace('/[^a-z0-9\-]/', '', $page) ?: 'index';

$controller = new PageController();

// Public form submission endpoint (progressive-enhanced by forms.js)
if ($page === 'submit') {
    Csrf::check();
    $controller->submit();
    exit;
}

// Download counter endpoint: /download?id=N
if ($page === 'download') {
    $controller->download((int) ($_GET['id'] ?? 0));
    exit;
}

try {
    ob_start();
    $controller->show($page);
    $html = (string) ob_get_clean();
    echo APP_ENV === 'production' ? minify_html($html) : $html;
} catch (\Throwable $e) {
    if (ob_get_level() > 0) { ob_end_clean(); }
    if (APP_ENV === 'development') {
        http_response_code(500);
        echo '<pre>' . e($e->getMessage()) . "\n" . e($e->getTraceAsString()) . '</pre>';
    } else {
        http_response_code(500);
        $controller->show('404');
    }
}
