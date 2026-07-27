<?php
declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;
use PDOStatement;

/**
 * Thin PDO wrapper (singleton). All queries use prepared statements.
 */
final class Database
{
    private static ?Database $instance = null;
    private ?PDO $pdo = null;

    private function __construct()
    {
        // Connection is established lazily on first pdo() call so that a single
        // shared connection is reused per request (avoids hitting the host's
        // max_user_connections limit, which would otherwise flip the site to
        // the static fallback intermittently).
    }

    public static function instance(): self
    {
        return self::$instance ??= new self();
    }

    /** Lazily open (once) and return the shared PDO connection. Retries once on transient failure. */
    public function pdo(): PDO
    {
        if ($this->pdo instanceof PDO) {
            return $this->pdo;
        }

        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=%s', DB_HOST, defined('DB_PORT') ? DB_PORT : '3306', DB_NAME, DB_CHARSET);
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_TIMEOUT            => 5,
        ];

        $attempt = 0;
        while (true) {
            try {
                $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
                return $this->pdo;
            } catch (PDOException $e) {
                // Retry once after a short pause to ride over a transient
                // connection-limit spike on shared hosting.
                if (++$attempt >= 2) {
                    throw $e;
                }
                usleep(250000); // 250ms
            }
        }
    }

    /** Run a prepared statement and return the PDOStatement. */
    public function run(string $sql, array $params = []): PDOStatement
    {
        $stmt = $this->pdo()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    /** Fetch a single row (or null). */
    public function first(string $sql, array $params = []): ?array
    {
        $row = $this->run($sql, $params)->fetch();
        return $row === false ? null : $row;
    }

    /** Fetch all rows. */
    public function all(string $sql, array $params = []): array
    {
        return $this->run($sql, $params)->fetchAll();
    }

    /** Fetch a single scalar value. */
    public function scalar(string $sql, array $params = [])
    {
        return $this->run($sql, $params)->fetchColumn();
    }

    public function lastId(): string
    {
        return $this->pdo()->lastInsertId();
    }

    public function beginTransaction(): void { $this->pdo()->beginTransaction(); }
    public function commit(): void { $this->pdo()->commit(); }
    public function rollBack(): void { if ($this->pdo()->inTransaction()) $this->pdo()->rollBack(); }
}
