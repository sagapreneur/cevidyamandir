<?php
declare(strict_types=1);

namespace App\Core;

/**
 * CSRF protection — synchroniser-token pattern.
 */
final class Csrf
{
    public static function token(): string
    {
        if (empty($_SESSION[CSRF_TOKEN_NAME])) {
            $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
        }
        return $_SESSION[CSRF_TOKEN_NAME];
    }

    /** Hidden input for forms. */
    public static function field(): string
    {
        return '<input type="hidden" name="' . CSRF_TOKEN_NAME . '" value="' . self::token() . '">';
    }

    public static function verify(?string $token): bool
    {
        $stored = $_SESSION[CSRF_TOKEN_NAME] ?? '';
        return is_string($token) && $stored !== '' && hash_equals($stored, $token);
    }

    /** Abort the request if the POST token is missing/invalid. */
    public static function check(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST[CSRF_TOKEN_NAME] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? null);
            if (!self::verify($token)) {
                http_response_code(419);
                die('Session expired or invalid request token. Please go back and try again.');
            }
        }
    }
}
