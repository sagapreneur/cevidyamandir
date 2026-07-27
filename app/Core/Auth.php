<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Authentication + role gate for the admin panel.
 * Roles: admin (full), editor (content only).
 */
final class Auth
{
    private const KEY = 'auth_user';

    public static function attempt(string $email, string $password): bool
    {
        $db = Database::instance();
        // Accept full email, the username part before @, or the display name.
        $user = $db->first(
            'SELECT * FROM ' . DB_PREFIX . 'users
             WHERE (email = ? OR name = ? OR SUBSTRING_INDEX(email, "@", 1) = ?)
               AND is_active = 1 AND deleted_at IS NULL LIMIT 1',
            [$email, $email, $email]
        );
        if (!$user || !password_verify($password, $user['password'])) {
            return false;
        }
        // Rehash if algorithm changed
        if (password_needs_rehash($user['password'], PASSWORD_DEFAULT)) {
            $db->run('UPDATE ' . DB_PREFIX . 'users SET password = ? WHERE id = ?',
                [password_hash($password, PASSWORD_DEFAULT), $user['id']]);
        }
        Session::regenerate();
        unset($user['password']);
        Session::set(self::KEY, $user);
        $db->run('UPDATE ' . DB_PREFIX . 'users SET last_login_at = NOW() WHERE id = ?', [$user['id']]);
        return true;
    }

    public static function check(): bool
    {
        return Session::get(self::KEY) !== null;
    }

    public static function user(): ?array
    {
        return Session::get(self::KEY);
    }

    public static function id(): ?int
    {
        return self::user()['id'] ?? null;
    }

    public static function role(): string
    {
        return self::user()['role'] ?? 'guest';
    }

    public static function is(string $role): bool
    {
        return self::role() === $role;
    }

    public static function logout(): void
    {
        Session::forget(self::KEY);
        Session::regenerate();
    }

    /** Redirect to login if not authenticated. */
    public static function requireLogin(): void
    {
        if (!self::check()) {
            Session::set('_intended', $_SERVER['REQUEST_URI'] ?? admin_url());
            redirect(admin_url('login'));
        }
    }

    public static function requireRole(string $role): void
    {
        self::requireLogin();
        if ($role === 'admin' && !self::is('admin')) {
            http_response_code(403);
            die('You do not have permission to access this area.');
        }
    }

    /** Refresh cached user data from DB. */
    public static function refresh(): void
    {
        if (!self::check()) return;
        $user = Database::instance()->first(
            'SELECT * FROM ' . DB_PREFIX . 'users WHERE id = ? LIMIT 1', [self::id()]
        );
        if ($user) {
            unset($user['password']);
            Session::set(self::KEY, $user);
        }
    }
}
