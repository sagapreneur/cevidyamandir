<?php
declare(strict_types=1);

namespace App\Core;

/** One-request flash messages. */
final class Flash
{
    public static function set(string $type, string $message): void
    {
        $_SESSION['_flash'][] = ['type' => $type, 'message' => $message];
    }

    public static function success(string $m): void { self::set('success', $m); }
    public static function error(string $m): void { self::set('error', $m); }
    public static function info(string $m): void { self::set('info', $m); }

    /** @return array<int,array{type:string,message:string}> */
    public static function pull(): array
    {
        $items = $_SESSION['_flash'] ?? [];
        unset($_SESSION['_flash']);
        return $items;
    }
}
