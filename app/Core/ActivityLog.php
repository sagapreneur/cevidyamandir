<?php
declare(strict_types=1);

namespace App\Core;

/** Records admin actions for the Activity Log. */
final class ActivityLog
{
    public static function record(string $action, string $entity = '', ?int $entityId = null, string $detail = ''): void
    {
        try {
            Database::instance()->run(
                'INSERT INTO ' . DB_PREFIX . 'activity_log (user_id, action, entity, entity_id, detail, ip_address, created_at)
                 VALUES (?, ?, ?, ?, ?, ?, NOW())',
                [
                    Auth::id(),
                    $action,
                    $entity,
                    $entityId,
                    $detail,
                    $_SERVER['REMOTE_ADDR'] ?? '',
                ]
            );
        } catch (\Throwable $e) {
            // never break the app because of logging
        }
    }
}
