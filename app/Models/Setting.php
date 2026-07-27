<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

/**
 * Key/value settings store (drives header, footer, colours, SEO, etc.).
 * Values are cached per-request.
 */
final class Setting
{
    private static ?array $cache = null;

    private static function load(): array
    {
        if (self::$cache === null) {
            self::$cache = [];
            $rows = Database::instance()->all(
                'SELECT setting_key, setting_value FROM ' . DB_PREFIX . 'settings'
            );
            foreach ($rows as $r) {
                self::$cache[$r['setting_key']] = $r['setting_value'];
            }
        }
        return self::$cache;
    }

    public static function get(string $key, ?string $default = null): ?string
    {
        $all = self::load();
        return $all[$key] ?? $default;
    }

    /** Decode a JSON-typed setting into an array. */
    public static function json(string $key, array $default = []): array
    {
        $raw = self::get($key);
        if (!$raw) return $default;
        $decoded = json_decode($raw, true);
        return is_array($decoded) ? $decoded : $default;
    }

    public static function all(): array
    {
        return self::load();
    }

    public static function set(string $key, string $value, string $group = 'general', string $type = 'text'): void
    {
        Database::instance()->run(
            'INSERT INTO ' . DB_PREFIX . 'settings (setting_key, setting_value, setting_group, setting_type, updated_at)
             VALUES (?, ?, ?, ?, NOW())
             ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value), updated_at = NOW()',
            [$key, $value, $group, $type]
        );
        self::$cache = null;
    }
}
