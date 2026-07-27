<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Generic active-record-ish base model.
 * Subclasses set $table (without prefix) and optionally $softDelete.
 */
abstract class Model
{
    protected string $table;
    protected bool $softDelete = false;
    protected Database $db;

    public function __construct()
    {
        $this->db = Database::instance();
    }

    protected function t(): string
    {
        return DB_PREFIX . $this->table;
    }

    private function notDeleted(string $where = ''): string
    {
        if (!$this->softDelete) return $where;
        $clause = 'deleted_at IS NULL';
        return $where === '' ? "WHERE {$clause}" : "{$where} AND {$clause}";
    }

    public function find(int $id): ?array
    {
        return $this->db->first(
            "SELECT * FROM {$this->t()} " . $this->notDeleted('WHERE id = ?'),
            [$id]
        );
    }

    public function all(string $orderBy = 'id DESC', ?int $limit = null): array
    {
        $sql = "SELECT * FROM {$this->t()} " . $this->notDeleted() . " ORDER BY {$orderBy}";
        if ($limit !== null) $sql .= " LIMIT " . (int) $limit;
        return $this->db->all($sql);
    }

    public function where(string $column, $value, string $orderBy = 'id DESC'): array
    {
        return $this->db->all(
            "SELECT * FROM {$this->t()} " . $this->notDeleted("WHERE {$column} = ?") . " ORDER BY {$orderBy}",
            [$value]
        );
    }

    public function count(string $where = '', array $params = []): int
    {
        $sql = "SELECT COUNT(*) FROM {$this->t()} " . $this->notDeleted($where);
        return (int) $this->db->scalar($sql, $params);
    }

    public function create(array $data): int
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $cols = array_keys($data);
        $place = implode(',', array_fill(0, count($cols), '?'));
        $this->db->run(
            "INSERT INTO {$this->t()} (" . implode(',', $cols) . ") VALUES ({$place})",
            array_values($data)
        );
        return (int) $this->db->lastId();
    }

    public function update(int $id, array $data): void
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $set = implode(',', array_map(fn($c) => "{$c} = ?", array_keys($data)));
        $params = array_values($data);
        $params[] = $id;
        $this->db->run("UPDATE {$this->t()} SET {$set} WHERE id = ?", $params);
    }

    public function delete(int $id): void
    {
        if ($this->softDelete) {
            $this->db->run("UPDATE {$this->t()} SET deleted_at = NOW() WHERE id = ?", [$id]);
        } else {
            $this->db->run("DELETE FROM {$this->t()} WHERE id = ?", [$id]);
        }
    }
}
