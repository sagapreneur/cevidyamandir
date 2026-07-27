<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

/**
 * Reads editable navigation from the DB and shapes it for rendering.
 */
final class Navigation
{
    /** Primary menu: top-level items each with children / mega columns. */
    public static function primary(): array
    {
        $db = Database::instance();
        $tops = $db->all(
            'SELECT * FROM ' . DB_PREFIX . "navigation
             WHERE menu = 'primary' AND parent_id IS NULL AND is_active = 1
             ORDER BY sort_order ASC, id ASC"
        );
        foreach ($tops as &$t) {
            $children = $db->all(
                'SELECT * FROM ' . DB_PREFIX . 'navigation
                 WHERE parent_id = ? AND is_active = 1 ORDER BY sort_order ASC, id ASC',
                [$t['id']]
            );
            $t['children'] = $children;
            if ((int) $t['is_mega'] === 1) {
                $cols = [];
                foreach ($children as $c) {
                    $cols[$c['mega_group'] ?: 'More'][] = $c;
                }
                $t['mega'] = $cols;
            }
        }
        return $tops;
    }

    /** Footer columns: each parent is a column title, children are links. */
    public static function footerColumns(): array
    {
        $db = Database::instance();
        $cols = $db->all(
            'SELECT * FROM ' . DB_PREFIX . "navigation
             WHERE menu = 'footer' AND parent_id IS NULL AND is_active = 1
             ORDER BY sort_order ASC, id ASC"
        );
        foreach ($cols as &$c) {
            $c['children'] = $db->all(
                'SELECT * FROM ' . DB_PREFIX . 'navigation
                 WHERE parent_id = ? AND is_active = 1 ORDER BY sort_order ASC, id ASC',
                [$c['id']]
            );
        }
        return $cols;
    }
}
