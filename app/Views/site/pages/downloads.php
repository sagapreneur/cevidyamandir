<?php
use App\Core\View;
echo View::render('site/partials/banner', [
    'title' => $page['banner_title'] ?: $page['title'],
    'image' => $page['banner_image'] ?: '',
    'pageTitle' => $page['title'],
]);

/** Human-readable file size (from bytes) with a graceful placeholder. */
$fmtSize = static function ($bytes): string {
    $bytes = (int) $bytes;
    if ($bytes <= 0) return '—';
    $units = ['B', 'KB', 'MB', 'GB'];
    $i = (int) floor(log($bytes, 1024));
    $i = max(0, min($i, count($units) - 1));
    return round($bytes / (1024 ** $i), $i ? 1 : 0) . ' ' . $units[$i];
};
?>
<section class="section">
  <div class="container-edu">
    <div class="section-head">
      <span class="eyebrow">Resources</span>
      <h2 class="t-h2">Downloads &amp; Forms</h2>
      <p class="t-body">Prospectus, forms, circulars and calendars — all the documents you need, in one place.</p>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3" data-reveal-stagger="70">
      <?php if (empty($downloads)): ?>
        <p class="t-body">No downloads available yet.</p>
      <?php else: foreach ($downloads as $d):
          $href = $d['file'] ? base_url('download?id=' . $d['id']) : '#';
          $size = $fmtSize($d['file_size'] ?? 0);
          $category = trim((string) ($d['category'] ?? '')) ?: 'Document'; ?>
        <article class="doc-card" data-reveal>
          <div class="doc-card__top">
            <span class="doc-card__icon"><?php $ic = trim((string) ($d['icon'] ?? '')); ?><?= $ic !== '' ? e($ic) : '<i class="fa-solid fa-file-lines" aria-hidden="true"></i>' ?></span>
            <div class="min-w-0">
              <span class="doc-card__cat"><?= e($category) ?></span>
              <h3 class="t-h4 mt-2 mb-1"><?= e($d['title']) ?><?php if (!empty($d['is_featured'])): ?> <span class="badge-accent align-middle">Featured</span><?php endif; ?></h3>
              <?php if (!empty($d['description'])): ?><p class="t-small"><?= e($d['description']) ?></p><?php endif; ?>
            </div>
          </div>
          <div class="doc-card__meta">
            <span class="doc-card__size">
              <?= e($size) ?><?php if ((int) ($d['download_count'] ?? 0) > 0): ?> · <?= (int) $d['download_count'] ?> downloads<?php endif; ?>
            </span>
            <a href="<?= e($href) ?>" class="btn-primary btn-sm" <?= $d['file'] ? 'target="_blank" rel="noopener"' : 'aria-disabled="true"' ?>>
              <i class="fa-solid fa-download" aria-hidden="true"></i>
              Download
            </a>
          </div>
        </article>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>
