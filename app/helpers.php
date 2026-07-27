<?php
/**
 * Global helper functions (procedural, always available).
 */

declare(strict_types=1);

if (!function_exists('e')) {
    /** Escape any scalar for safe HTML output. */
    function e($value): string
    {
        return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

if (!function_exists('base_url')) {
    function base_url(string $path = ''): string
    {
        return BASE_URL . ($path !== '' ? '/' . ltrim($path, '/') : '');
    }
}

if (!function_exists('admin_url')) {
    function admin_url(string $path = ''): string
    {
        return ADMIN_URL . ($path !== '' ? '/' . ltrim($path, '/') : '');
    }
}

if (!function_exists('asset_ver')) {
    /** Asset URL with a cache-busting ?v=<filemtime> so long-lived caches refresh on change. */
    function asset_ver(string $path): string
    {
        $full = ROOT_PATH . '/assets/' . ltrim($path, '/');
        $v = is_file($full) ? (string) filemtime($full) : '1';
        return asset($path) . '?v=' . $v;
    }
}

if (!function_exists('asset')) {
    function asset(string $path): string
    {
        return BASE_URL . '/assets/' . ltrim($path, '/');
    }
}

if (!function_exists('upload_url')) {
    function upload_url(?string $file): string
    {
        if (!$file) return '';
        if (preg_match('#^https?://#', $file)) return $file;
        return UPLOAD_URL . '/' . ltrim($file, '/');
    }
}

if (!function_exists('redirect')) {
    function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }
}

if (!function_exists('old')) {
    /** Repopulate form fields after a validation error. */
    function old(string $key, $default = '')
    {
        return $_SESSION['_old'][$key] ?? $default;
    }
}

if (!function_exists('slugify')) {
    function slugify(string $text): string
    {
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        return trim($text, '-');
    }
}

if (!function_exists('str_excerpt')) {
    function str_excerpt(string $text, int $words = 22): string
    {
        $text = trim(strip_tags($text));
        $parts = preg_split('/\s+/', $text);
        if (count($parts) <= $words) return $text;
        return implode(' ', array_slice($parts, 0, $words)) . '…';
    }
}

if (!function_exists('config_view')) {
    /** Load a JSON config file as an array (used for seeding/fallbacks). */
    function config_view(string $name): array
    {
        $file = CONFIG_PATH . '/' . $name . '.json';
        if (!is_file($file)) return [];
        return json_decode((string) file_get_contents($file), true) ?: [];
    }
}

if (!function_exists('minify_html')) {
    /**
     * Conservative HTML minifier — collapses runs of whitespace to a single
     * space (preserving single spaces between inline elements) and protects
     * <pre>, <textarea>, <script> and <style> blocks.
     */
    function minify_html(string $html): string
    {
        $store = [];
        $html = preg_replace_callback(
            '#<(pre|textarea|script|style)\b[^>]*>.*?</\1>#is',
            static function ($m) use (&$store) {
                $key = "\x01" . count($store) . "\x01";
                $store[$key] = $m[0];
                return $key;
            },
            $html
        );
        // collapse whitespace runs; drop whitespace directly between tags
        $html = preg_replace('/>\s+</', '> <', $html);
        $html = preg_replace('/\s{2,}/', ' ', $html);
        $html = str_replace(array_keys($store), array_values($store), $html);
        return trim($html);
    }
}

if (!function_exists('placeholder')) {
    /** Local branded placeholder image (works offline, no broken icons). */
    function placeholder(string $type = 'landscape'): string
    {
        $allowed = ['landscape', 'portrait', 'avatar', 'square', 'banner'];
        if (!in_array($type, $allowed, true)) $type = 'landscape';
        return BASE_URL . '/assets/images/placeholders/' . $type . '.svg';
    }
}

if (!function_exists('media_url')) {
    /**
     * Resolve an image field to a usable URL, falling back to a local
     * placeholder when empty. Accepts absolute URLs or upload paths.
     */
    function media_url(?string $value, string $type = 'landscape'): string
    {
        $value = trim((string) $value);
        if ($value === '') return placeholder($type);
        if (preg_match('#^https?://#', $value)) return $value;
        return upload_url($value);
    }
}

if (!function_exists('cms_installed')) {
    /** True when the database is reachable and the CMS tables exist. */
    function cms_installed(): bool
    {
        static $ok = null;
        if ($ok !== null) return $ok;

        // Once we have confirmed the CMS is installed we remember it with a flag
        // file for a short window. This (1) avoids a DB round-trip on every request
        // and (2) — crucially — prevents a transient DB hiccup under load from
        // regressing the whole site to the outdated static fallback.
        $flag = STORAGE_PATH . '/cache/.cms_ready';
        if (is_file($flag) && (time() - (int) @filemtime($flag)) < 300) {
            return $ok = true;
        }

        try {
            // Reuse the shared singleton connection (one connection per request)
            // instead of opening a second PDO — this avoids exhausting the host's
            // max_user_connections limit, which caused intermittent fallbacks.
            $pdo = \App\Core\Database::instance()->pdo();
            $pdo->query('SELECT 1 FROM `' . DB_PREFIX . 'settings` LIMIT 1');
            @touch($flag);
            return $ok = true;
        } catch (\Throwable $e) {
            // If the CMS was known-installed recently, trust that rather than
            // showing the demo: let the request proceed (the front controller
            // handles any query error gracefully) instead of serving stale content.
            if (is_file($flag)) {
                return $ok = true;
            }
            return $ok = false;
        }
    }
}

if (!function_exists('image_ratio_label')) {
    /** Return a clean aspect-ratio label (e.g. "16:9") or '' if not tidy. */
    function image_ratio_label(int $w, int $h): string
    {
        if ($w < 1 || $h < 1) return '';
        $a = $w; $b = $h;
        while ($b) { [$a, $b] = [$b, $a % $b]; }
        $g = max(1, $a);
        $rw = $w / $g; $rh = $h / $g;
        return max($rw, $rh) <= 21 ? ((int) $rw . ':' . (int) $rh) : '';
    }
}

if (!function_exists('placeholder_box')) {
    /**
     * Premium "Awaiting Image" placeholder that reserves the final image space
     * (CMS-ready). Shows the image name, recommended size and aspect ratio so it
     * can be replaced through the admin panel without editing code.
     * $dims example: "1920×900" → also derives "16:9".
     */
    function placeholder_box(string $label, string $dims = '', string $icon = 'fa-image'): string
    {
        $cls = (is_string($icon) && strncmp($icon, 'fa-', 3) === 0) ? $icon : 'fa-image';
        $ratio = '';
        if ($dims !== '' && preg_match('/(\d{2,4})\s*[×xX]\s*(\d{2,4})/u', $dims, $m)) {
            $ratio = image_ratio_label((int) $m[1], (int) $m[2]);
        }
        $meta = trim($dims) . ($ratio !== '' && stripos($dims, ':') === false ? '  ·  ' . $ratio : '');
        return '<div class="ph-box">'
            . '<span class="ph-ico"><i class="fa-solid ' . e($cls) . '" aria-hidden="true"></i></span>'
            . '<span class="ph-tag">Awaiting Image</span>'
            . '<span class="ph-label">' . e($label) . '</span>'
            . ($meta !== '' ? '<span class="ph-dims">' . e($meta) . '</span>' : '')
            . '</div>';
    }
}

if (!function_exists('cms_image')) {
    /**
     * Render a CMS image if present, otherwise a labeled placeholder that
     * keeps the exact layout. Wrap the call in a fixed-ratio `.ph-frame`.
     */
    function cms_image(?string $value, string $label, string $dims = '', string $imgClass = '', string $icon = 'fa-image'): string
    {
        $value = trim((string) $value);
        if ($value !== '') {
            return '<img src="' . e(media_url($value)) . '" alt="' . e($label) . '"'
                . ($imgClass !== '' ? ' class="' . e($imgClass) . '"' : '')
                . ' loading="lazy" decoding="async" />';
        }
        return placeholder_box($label, $dims, $icon);
    }
}
