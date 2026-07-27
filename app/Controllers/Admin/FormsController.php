<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Flash;

/** Form submissions: list, filter, view, export CSV, delete. */
final class FormsController extends Controller
{
    public function index(): void
    {
        $db = Database::instance();
        $type = trim((string) $this->input('type', ''));
        $q = trim((string) $this->input('q', ''));

        $sql = 'SELECT * FROM ' . DB_PREFIX . 'form_submissions WHERE 1=1';
        $params = [];
        if ($type !== '') { $sql .= ' AND form_type = ?'; $params[] = $type; }
        if ($q !== '') { $sql .= ' AND (name LIKE ? OR email LIKE ? OR subject LIKE ?)'; array_push($params, "%$q%", "%$q%", "%$q%"); }
        $sql .= ' ORDER BY created_at DESC LIMIT 500';

        $types = $db->all('SELECT DISTINCT form_type FROM ' . DB_PREFIX . 'form_submissions ORDER BY form_type');

        $this->view('admin/forms/index', [
            'title' => 'Form Submissions',
            'rows' => $db->all($sql, $params),
            'types' => array_column($types, 'form_type'),
            'type' => $type,
            'q' => $q,
        ], 'admin/layout');
    }

    public function view(int $id): void
    {
        $db = Database::instance();
        $row = $db->first('SELECT * FROM ' . DB_PREFIX . 'form_submissions WHERE id = ?', [$id]);
        if (!$row) { Flash::error('Submission not found.'); redirect(admin_url('forms')); }
        $db->run('UPDATE ' . DB_PREFIX . 'form_submissions SET is_read = 1 WHERE id = ?', [$id]);

        $this->view('admin/forms/view', [
            'title' => 'Submission #' . $id,
            'row' => $row,
            'payload' => json_decode((string) $row['payload'], true) ?: [],
        ], 'admin/layout');
    }

    public function delete(int $id): void
    {
        Database::instance()->run('DELETE FROM ' . DB_PREFIX . 'form_submissions WHERE id = ?', [$id]);
        Flash::success('Submission deleted.');
        redirect(admin_url('forms'));
    }

    public function export(): void
    {
        $db = Database::instance();
        $type = trim((string) $this->input('type', ''));
        $sql = 'SELECT * FROM ' . DB_PREFIX . 'form_submissions';
        $params = [];
        if ($type !== '') { $sql .= ' WHERE form_type = ?'; $params[] = $type; }
        $sql .= ' ORDER BY created_at DESC';
        $rows = $db->all($sql, $params);

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="submissions-' . date('Y-m-d') . '.csv"');
        $out = fopen('php://output', 'w');
        fputcsv($out, ['ID', 'Type', 'Name', 'Email', 'Phone', 'Subject', 'Details', 'IP', 'Date']);
        foreach ($rows as $r) {
            fputcsv($out, [
                $r['id'], $r['form_type'], $r['name'], $r['email'], $r['phone'],
                $r['subject'], $r['payload'], $r['ip_address'], $r['created_at'],
            ]);
        }
        fclose($out);
        exit;
    }
}
