<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Database;

final class DashboardController extends Controller
{
    public function index(): void
    {
        $db = Database::instance();
        $p = DB_PREFIX;

        $count = static function (Database $db, string $table, string $where = '') {
            $sql = "SELECT COUNT(*) FROM {$table}" . ($where ? " WHERE {$where}" : '');
            try { return (int) $db->scalar($sql); } catch (\Throwable $e) { return 0; }
        };

        $stats = [
            'Pages'          => $count($db, "{$p}pages", 'deleted_at IS NULL'),
            'Notices'        => $count($db, "{$p}notices", 'deleted_at IS NULL'),
            'Downloads'      => $count($db, "{$p}downloads", 'deleted_at IS NULL'),
            'Gallery Images' => $count($db, "{$p}gallery_images", 'deleted_at IS NULL'),
            'Reviews'        => $count($db, "{$p}reviews", 'deleted_at IS NULL'),
            'Media Files'    => $count($db, "{$p}media"),
            'Form Messages'  => $count($db, "{$p}form_submissions"),
            'Unread Messages'=> $count($db, "{$p}form_submissions", 'is_read = 0'),
        ];

        $recentForms = [];
        $recentActivity = [];
        try {
            $recentForms = $db->all("SELECT * FROM {$p}form_submissions ORDER BY created_at DESC LIMIT 6");
            $recentActivity = $db->all(
                "SELECT a.*, u.name AS user_name FROM {$p}activity_log a
                 LEFT JOIN {$p}users u ON u.id = a.user_id
                 ORDER BY a.created_at DESC LIMIT 8"
            );
        } catch (\Throwable $e) {}

        $this->view('admin/dashboard', [
            'title' => 'Dashboard',
            'stats' => $stats,
            'recentForms' => $recentForms,
            'recentActivity' => $recentActivity,
        ], 'admin/layout');
    }
}
