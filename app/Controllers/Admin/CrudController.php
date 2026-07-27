<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Flash;
use App\Core\Validator;
use App\Core\Upload;
use App\Core\Database;
use App\Core\ActivityLog;
use App\Core\Cache;
use App\Models\GenericModel;

/**
 * Generic CRUD controller driven by app/modules.php definitions.
 * Handles list / create / edit / delete + uploads + validation
 * for every content module without bespoke code.
 */
final class CrudController extends Controller
{
    private array $module;
    private string $key;
    private GenericModel $model;

    public function __construct(string $key)
    {
        $modules = require APP_PATH . '/modules.php';
        if (!isset($modules[$key])) {
            http_response_code(404);
            die('Unknown module.');
        }
        $this->key = $key;
        $this->module = $modules[$key];

        if (!empty($this->module['adminOnly']) && !Auth::is('admin')) {
            http_response_code(403);
            die('Administrators only.');
        }

        $this->model = new GenericModel($this->module['table'], !empty($this->module['softDelete']));
    }

    public function index(): void
    {
        $rows = $this->model->all($this->module['orderBy'] ?? 'id DESC');
        $this->view('admin/crud/list', [
            'title' => $this->module['label'],
            'moduleKey' => $this->key,
            'module' => $this->module,
            'rows' => $rows,
        ], 'admin/layout');
    }

    public function create(): void
    {
        if ($this->isPost()) {
            $this->save(null);
            return;
        }
        $this->renderForm(null);
    }

    public function edit(int $id): void
    {
        $row = $this->model->find($id);
        if (!$row) { Flash::error('Record not found.'); redirect($this->base()); }
        if ($this->isPost()) {
            $this->save($row);
            return;
        }
        $this->renderForm($row);
    }

    public function destroy(int $id): void
    {
        $this->model->delete($id);
        ActivityLog::record('delete', $this->module['table'], $id, $this->module['singular'] . ' deleted');
        Cache::flush();
        Flash::success($this->module['singular'] . ' deleted.');
        redirect($this->base());
    }

    /* ---------------- internals ---------------- */

    private function base(): string
    {
        return admin_url('module/' . $this->key);
    }

    private function renderForm(?array $row): void
    {
        $this->view('admin/crud/form', [
            'title' => ($row ? 'Edit ' : 'New ') . $this->module['singular'],
            'moduleKey' => $this->key,
            'module' => $this->module,
            'row' => $row,
            'options' => $this->resolveOptions(),
            'errors' => [],
        ], 'admin/layout');
    }

    /** Resolve dynamic <select> option lists (optionsFrom). */
    private function resolveOptions(): array
    {
        $out = [];
        foreach ($this->module['fields'] as $f) {
            if (($f['type'] ?? '') === 'select' && isset($f['optionsFrom'])) {
                $cfg = $f['optionsFrom'];
                $rows = Database::instance()->all(
                    'SELECT ' . $cfg['value'] . ' AS v, ' . $cfg['label'] . ' AS l FROM '
                    . DB_PREFIX . $cfg['table'] . ' ORDER BY l ASC'
                );
                $out[$f['name']] = $rows;
            }
        }
        return $out;
    }

    private function save(?array $existing): void
    {
        $data = [];
        $rules = [];
        $uploadError = null;

        foreach ($this->module['fields'] as $f) {
            $name = $f['name'];
            $type = $f['type'] ?? 'text';

            if (!empty($f['rules'])) {
                $rules[$name] = $f['rules'];
            }

            switch ($type) {
                case 'checkbox':
                    $data[$name] = isset($_POST[$name]) ? 1 : 0;
                    break;

                case 'image':
                case 'file':
                    $uploaded = isset($_FILES[$name]) ? Upload::handle($_FILES[$name], $uploadError) : null;
                    if ($uploaded) {
                        $data[$name] = $uploaded['path'];
                        $this->registerMedia($uploaded);
                    } elseif ($existing) {
                        $data[$name] = $existing[$name] ?? null; // keep current
                    } else {
                        $data[$name] = $_POST[$name . '_existing'] ?? null;
                    }
                    break;

                case 'password':
                    // handled after validation
                    break;

                case 'number':
                case 'order':
                    $raw = $_POST[$name] ?? '';
                    $data[$name] = $raw !== '' ? (int) $raw : 0;
                    break;

                default:
                    $data[$name] = trim((string) ($_POST[$name] ?? ''));
            }
        }

        // Validation
        $v = new Validator(array_merge($_POST, $data));
        $ok = empty($rules) || $v->validate($rules);
        $errors = $v->errors();

        // Password rules (users)
        $isUser = $this->module['table'] === 'users';
        if ($isUser) {
            $pwd = (string) ($_POST['password'] ?? '');
            if (!$existing && strlen($pwd) < 8) {
                $errors['password'] = 'Password must be at least 8 characters.';
                $ok = false;
            }
            if ($pwd !== '') {
                if (strlen($pwd) < 8) { $errors['password'] = 'Password must be at least 8 characters.'; $ok = false; }
                else { $data['password'] = password_hash($pwd, PASSWORD_DEFAULT); }
            }
            // unique email
            $emailExists = Database::instance()->first(
                'SELECT id FROM ' . DB_PREFIX . 'users WHERE email = ? AND id <> ? LIMIT 1',
                [$data['email'] ?? '', $existing['id'] ?? 0]
            );
            if ($emailExists) { $errors['email'] = 'That email is already in use.'; $ok = false; }
        }

        if ($uploadError) { $errors['_upload'] = $uploadError; $ok = false; }

        if (!$ok) {
            $_SESSION['_old'] = $_POST;
            $this->view('admin/crud/form', [
                'title' => ($existing ? 'Edit ' : 'New ') . $this->module['singular'],
                'moduleKey' => $this->key,
                'module' => $this->module,
                'row' => $existing ? array_merge($existing, $data) : $data,
                'options' => $this->resolveOptions(),
                'errors' => $errors,
            ], 'admin/layout');
            return;
        }

        unset($_SESSION['_old']);

        // Auto-slug for pages
        if ($this->module['table'] === 'pages' && !empty($data['slug'])) {
            $data['slug'] = slugify($data['slug']);
        }

        if ($existing) {
            $this->model->update((int) $existing['id'], $data);
            ActivityLog::record('update', $this->module['table'], (int) $existing['id'], $this->module['singular'] . ' updated');
            Flash::success($this->module['singular'] . ' updated.');
        } else {
            $newId = $this->model->create($data);
            ActivityLog::record('create', $this->module['table'], $newId, $this->module['singular'] . ' created');
            Flash::success($this->module['singular'] . ' created.');
        }
        Cache::flush();
        redirect($this->base());
    }

    private function registerMedia(array $uploaded): void
    {
        try {
            Database::instance()->run(
                'INSERT INTO ' . DB_PREFIX . 'media (title, file_path, file_type, mime, file_size, uploaded_by, created_at)
                 VALUES (?, ?, ?, ?, ?, ?, NOW())',
                [
                    basename($uploaded['path']),
                    $uploaded['path'],
                    $uploaded['ext'],
                    $uploaded['mime'],
                    $uploaded['size'],
                    Auth::id(),
                ]
            );
        } catch (\Throwable $e) {}
    }
}
