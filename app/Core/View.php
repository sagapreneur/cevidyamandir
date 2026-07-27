<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Tiny view renderer. Views are plain PHP files under app/Views.
 * A view may set $layout by returning content into a layout wrapper.
 */
final class View
{
    /**
     * Render a view and return its HTML.
     * @param string $view  dot/slash path relative to Views (e.g. 'admin/dashboard')
     */
    public static function render(string $view, array $data = [], ?string $layout = null): string
    {
        $content = self::capture($view, $data);
        if ($layout !== null) {
            $data['content'] = $content;
            return self::capture($layout, $data);
        }
        return $content;
    }

    public static function output(string $view, array $data = [], ?string $layout = null): void
    {
        echo self::render($view, $data, $layout);
    }

    private static function capture(string $view, array $data): string
    {
        $file = VIEW_PATH . '/' . str_replace('.', '/', $view) . '.php';
        if (!is_file($file)) {
            throw new \RuntimeException("View not found: {$view}");
        }
        extract($data, EXTR_SKIP);
        ob_start();
        include $file;
        return (string) ob_get_clean();
    }
}
