<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Lightweight file cache for read-heavy queries (nav, home data…).
 * Stored under storage/cache. Safe to clear anytime.
 */
final class Cache
{
    private static function dir(): string
    {
        $d = STORAGE_PATH . '/cache';
        if (!is_dir($d)) @mkdir($d, 0755, true);
        return $d;
    }

    /** Return cached value or compute+store it. TTL in seconds. */
    public static function remember(string $key, int $ttl, callable $callback)
    {
        // Caching disabled in development for easier iteration.
        if (APP_ENV === 'development' || $ttl <= 0) {
            return $callback();
        }
        $file = self::dir() . '/' . md5($key) . '.cache';
        if (is_file($file) && (time() - filemtime($file)) < $ttl) {
            $data = @unserialize((string) file_get_contents($file));
            if ($data !== false) return $data;
        }
        $value = $callback();
        @file_put_contents($file, serialize($value), LOCK_EX);
        return $value;
    }

    /** Remove all cached entries (call after content edits). */
    public static function flush(): void
    {
        foreach (glob(self::dir() . '/*.cache') ?: [] as $f) {
            @unlink($f);
        }
    }
}
