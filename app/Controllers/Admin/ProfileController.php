<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Flash;
use App\Core\Database;
use App\Core\Validator;
use App\Core\ActivityLog;

final class ProfileController extends Controller
{
    public function index(): void
    {
        $db = Database::instance();
        if ($this->isPost()) {
            $name = trim((string) $this->input('name'));
            $email = trim((string) $this->input('email'));
            $v = new Validator(['name' => $name, 'email' => $email]);
            if (!$v->validate(['name' => 'required', 'email' => 'required|email'])) {
                Flash::error('Please check the form.');
            } else {
                $db->run('UPDATE ' . DB_PREFIX . 'users SET name = ?, email = ?, updated_at = NOW() WHERE id = ?',
                    [$name, $email, Auth::id()]);
                Auth::refresh();
                ActivityLog::record('update', 'user', Auth::id(), 'Profile updated');
                Flash::success('Profile updated.');
            }
            redirect(admin_url('profile'));
        }

        $this->view('admin/profile', [
            'title' => 'My Profile',
            'user' => Auth::user(),
        ], 'admin/layout');
    }

    public function password(): void
    {
        if ($this->isPost()) {
            $db = Database::instance();
            $current = (string) $this->input('current_password');
            $new = (string) $this->input('new_password');
            $confirm = (string) $this->input('confirm_password');

            $user = $db->first('SELECT * FROM ' . DB_PREFIX . 'users WHERE id = ?', [Auth::id()]);
            if (!$user || !password_verify($current, $user['password'])) {
                Flash::error('Current password is incorrect.');
            } elseif (strlen($new) < 8) {
                Flash::error('New password must be at least 8 characters.');
            } elseif ($new !== $confirm) {
                Flash::error('New passwords do not match.');
            } else {
                $db->run('UPDATE ' . DB_PREFIX . 'users SET password = ?, updated_at = NOW() WHERE id = ?',
                    [password_hash($new, PASSWORD_DEFAULT), Auth::id()]);
                ActivityLog::record('update', 'user', Auth::id(), 'Password changed');
                Flash::success('Password changed.');
            }
            redirect(admin_url('password'));
        }

        $this->view('admin/password', ['title' => 'Change Password'], 'admin/layout');
    }
}
