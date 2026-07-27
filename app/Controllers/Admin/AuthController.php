<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Core\Flash;
use App\Core\Validator;
use App\Core\Database;
use App\Core\ActivityLog;

final class AuthController extends Controller
{
    public function login(): void
    {
        if (Auth::check()) {
            redirect(admin_url('dashboard'));
        }

        $errors = [];
        if ($this->isPost()) {
            $email = trim((string) $this->input('email'));
            $password = (string) $this->input('password');

            $v = new Validator(['email' => $email, 'password' => $password]);
            if (!$v->validate(['email' => 'required', 'password' => 'required'])) {
                $errors = $v->errors();
            } elseif (Auth::attempt($email, $password)) {
                ActivityLog::record('login', 'user', Auth::id(), 'Signed in');
                $intended = Session::get('_intended', admin_url('dashboard'));
                Session::forget('_intended');
                redirect($intended);
            } else {
                $errors['email'] = 'Invalid email or password.';
            }
        }

        $this->view('admin/login', [
            'title' => 'Sign in',
            'errors' => $errors,
        ]);
    }

    public function logout(): void
    {
        ActivityLog::record('logout', 'user', Auth::id(), 'Signed out');
        Auth::logout();
        Session::destroy();
        redirect(admin_url('login'));
    }

    /** Handles both "request reset" and "set new password" (token in query). */
    public function forgot(): void
    {
        $db = Database::instance();
        $token = (string) ($_GET['token'] ?? '');
        $errors = [];
        $mode = $token !== '' ? 'reset' : 'request';

        if ($this->isPost() && $mode === 'request') {
            $email = trim((string) $this->input('email'));
            $user = $db->first('SELECT id FROM ' . DB_PREFIX . 'users WHERE email = ? AND deleted_at IS NULL', [$email]);
            if ($user) {
                $t = bin2hex(random_bytes(32));
                $db->run('UPDATE ' . DB_PREFIX . 'users SET reset_token = ?, reset_expires = ? WHERE id = ?',
                    [$t, date('Y-m-d H:i:s', time() + PASSWORD_RESET_TTL), $user['id']]);
                $link = admin_url('forgot') . '?token=' . $t;
                // Attempt email; shared hosting mail() may be limited.
                @mail($email, 'Password reset', "Reset your password: {$link}");
                Session::set('_reset_link_dev', $link); // shown to help during setup
            }
            Flash::info('If that email exists, a reset link has been generated.');
            redirect(admin_url('forgot'));
        }

        if ($this->isPost() && $mode === 'reset') {
            $password = (string) $this->input('password');
            $confirm = (string) $this->input('password_confirm');
            $row = $db->first('SELECT id FROM ' . DB_PREFIX . 'users WHERE reset_token = ? AND reset_expires > NOW()', [$token]);
            if (!$row) {
                $errors['password'] = 'This reset link is invalid or has expired.';
            } elseif (strlen($password) < 8) {
                $errors['password'] = 'Password must be at least 8 characters.';
            } elseif ($password !== $confirm) {
                $errors['password'] = 'Passwords do not match.';
            } else {
                $db->run('UPDATE ' . DB_PREFIX . 'users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE id = ?',
                    [password_hash($password, PASSWORD_DEFAULT), $row['id']]);
                Flash::success('Password updated. You can now sign in.');
                redirect(admin_url('login'));
            }
        }

        $this->view('admin/forgot', [
            'title' => 'Forgot password',
            'mode' => $mode,
            'token' => $token,
            'errors' => $errors,
            'devLink' => Session::get('_reset_link_dev'),
        ]);
    }
}
