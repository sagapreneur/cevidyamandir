<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

/**
 * Editable content blocks (section headings, intros, images).
 * Every block falls back to a sensible default so the UI never breaks.
 */
final class Block
{
    private static array $cache = [];

    /** Fetch all blocks for a page, keyed by block_key. */
    public static function forPage(string $page): array
    {
        if (!isset(self::$cache[$page])) {
            $rows = Database::instance()->all(
                'SELECT * FROM ' . DB_PREFIX . 'content_blocks WHERE page = ? AND is_active = 1 ORDER BY sort_order ASC',
                [$page]
            );
            $map = [];
            foreach ($rows as $r) { $map[$r['block_key']] = $r; }
            self::$cache[$page] = $map;
        }
        return self::$cache[$page];
    }

    /** Get one block (or an empty template). */
    public static function get(string $page, string $key, array $defaults = []): array
    {
        $blocks = self::forPage($page);
        $block = $blocks[$key] ?? [];
        return array_merge([
            'eyebrow' => '', 'title' => '', 'subtitle' => '', 'body' => '',
            'image' => '', 'link_label' => '', 'link_url' => '', 'extra' => '',
        ], $defaults, array_filter($block, fn($v) => $v !== null && $v !== ''));
    }

    /** Convenience: field value with default. */
    public static function field(string $page, string $key, string $field, string $default = ''): string
    {
        $b = self::get($page, $key);
        return ($b[$field] ?? '') !== '' ? (string) $b[$field] : $default;
    }
}
