<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

/**
 * Concrete model bound to any table at runtime — powers the generic
 * CRUD engine so every content module shares one codebase.
 */
final class GenericModel extends Model
{
    public function __construct(string $table, bool $softDelete = false)
    {
        $this->table = $table;
        $this->softDelete = $softDelete;
        parent::__construct();
    }

    public function tableName(): string
    {
        return $this->t();
    }
}
