<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Database;

final class ActivityController extends Controller
{
    public function index(): void
    {
        $rows = Database::instance()->all(
            'SELECT a.*, u.name AS user_name FROM ' . DB_PREFIX . 'activity_log a
             LEFT JOIN ' . DB_PREFIX . 'users u ON u.id = a.user_id
             ORDER BY a.created_at DESC LIMIT 300'
        );
        $this->view('admin/activity', [
            'title' => 'Activity Log',
            'rows' => $rows,
        ], 'admin/layout');
    }
}
