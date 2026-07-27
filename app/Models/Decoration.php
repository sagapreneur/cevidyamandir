<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

/**
 * CMS-managed floating decorations (blobs, circles, waves…).
 * Renders the same markup/classes used in the approved design.
 */
final class Decoration
{
    public static function forSection(string $section): array
    {
        return Database::instance()->all(
            'SELECT * FROM ' . DB_PREFIX . 'decorations WHERE section = ? AND is_active = 1 ORDER BY sort_order ASC',
            [$section]
        );
    }

    /**
     * Render the decorations for a section as HTML spans.
     * @param string $fallback markup used when no decorations are configured.
     */
    public static function render(string $section, string $fallback = ''): string
    {
        $rows = self::forSection($section);
        if (!$rows) return $fallback;

        $out = '';
        foreach ($rows as $d) {
            $color = preg_replace('/[^a-z0-9\/\-]/', '', (string) $d['color']) ?: 'primary';
            $pos = e((string) $d['position']);
            $size = e((string) $d['size'] ?: 'h-72 w-72');
            $opacity = max(0, min(100, (int) $d['opacity']));
            $anim = preg_replace('/[^a-z\-]/', '', (string) $d['animation']);
            $animClass = $anim && $anim !== 'none' ? ' animate-' . $anim : '';
            if ($d['image']) {
                $out .= '<img src="' . e(upload_url($d['image'])) . '" alt="" aria-hidden="true" class="pointer-events-none absolute ' . $pos . ' ' . $size . $animClass . '" style="opacity:' . ($opacity / 100) . '" />';
            } else {
                $shapeClass = $d['shape'] === 'circle' ? 'rounded-full' : 'rounded-full blur-3xl';
                $out .= '<span aria-hidden="true" class="hero-blob pointer-events-none absolute ' . $pos . ' ' . $size . ' bg-' . e($color) . $animClass . '" style="opacity:' . ($opacity / 100) . '"></span>';
            }
        }
        return $out;
    }
}
