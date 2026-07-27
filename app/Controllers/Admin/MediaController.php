<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Upload;
use App\Core\Auth;
use App\Core\Flash;
use App\Core\ActivityLog;

/** Centralised media library. */
final class MediaController extends Controller
{
    public function index(): void
    {
        $db = Database::instance();
        $type = trim((string) $this->input('type', ''));
        $q = trim((string) $this->input('q', ''));

        $sql = 'SELECT * FROM ' . DB_PREFIX . 'media WHERE 1=1';
        $params = [];
        if ($type !== '') { $sql .= ' AND file_type = ?'; $params[] = $type; }
        if ($q !== '') { $sql .= ' AND (title LIKE ? OR alt_text LIKE ?)'; $params[] = "%$q%"; $params[] = "%$q%"; }
        $sql .= ' ORDER BY created_at DESC LIMIT 200';

        $this->view('admin/media/index', [
            'title' => 'Media Library',
            'items' => $db->all($sql, $params),
            'type' => $type,
            'q' => $q,
        ], 'admin/layout');
    }

    public function upload(): void
    {
        if (!$this->isPost()) redirect(admin_url('media'));

        $error = null;
        $result = isset($_FILES['file']) ? Upload::handle($_FILES['file'], $error) : null;
        if (!$result) {
            Flash::error($error ?? 'No file selected.');
            redirect(admin_url('media'));
        }

        Database::instance()->run(
            'INSERT INTO ' . DB_PREFIX . 'media (title, alt_text, caption, description, category, file_path, file_type, mime, file_size, uploaded_by, created_at)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())',
            [
                trim((string) ($_POST['title'] ?? basename($result['path']))),
                trim((string) ($_POST['alt_text'] ?? '')),
                trim((string) ($_POST['caption'] ?? '')),
                trim((string) ($_POST['description'] ?? '')),
                trim((string) ($_POST['category'] ?? '')),
                $result['path'],
                $result['ext'],
                $result['mime'],
                $result['size'],
                Auth::id(),
            ]
        );
        ActivityLog::record('upload', 'media', null, $result['path']);
        Flash::success('File uploaded.');
        redirect(admin_url('media'));
    }

    public function delete(int $id): void
    {
        $db = Database::instance();
        $row = $db->first('SELECT * FROM ' . DB_PREFIX . 'media WHERE id = ?', [$id]);
        if ($row) {
            $path = UPLOAD_PATH . '/' . $row['file_path'];
            if (is_file($path)) @unlink($path);
            $db->run('DELETE FROM ' . DB_PREFIX . 'media WHERE id = ?', [$id]);
            ActivityLog::record('delete', 'media', $id, $row['file_path']);
            Flash::success('File deleted.');
        }
        redirect(admin_url('media'));
    }
}
