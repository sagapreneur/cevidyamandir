<?php
/** NOTICES — A4 notice-image carousel (CMS-driven, admin manages slides). */
use App\Core\View;

echo View::render('site/partials/banner', [
    'title' => $page['banner_title'] ?: $page['title'],
    'image' => $page['banner_image'] ?: '',
    'pageTitle' => $page['title'],
]);
$notices = $notices ?? [];
$imgUrl = static function (array $n): string {
    $v = trim((string) ($n['image'] ?? '')) ?: trim((string) ($n['attachment'] ?? ''));
    return $v !== '' ? media_url($v) : '';
};
?>
<section class="section">
  <div class="container-edu">
    <div class="section-head">
      <span class="home-eyebrow mx-auto">Stay Informed</span>
      <h2 class="t-h2">Notices &amp; Circulars</h2>
      <p class="t-body">The latest notices from Channawar's e Vidya Mandir. Use the arrows to browse and tap a notice to view it full size.</p>
    </div>

    <?php if (empty($notices)): ?>
      <div class="mx-auto max-w-lg text-center">
        <div class="ph-frame shadow-card mx-auto" style="max-width:420px;aspect-ratio:210/297">
          <?= placeholder_box('No notices published yet', 'A4', 'fa-file-lines') ?>
        </div>
      </div>
    <?php else: ?>
      <div class="notice-carousel" data-notice-carousel>
        <div class="notice-carousel__viewport">
          <div class="notice-carousel__track">
            <?php foreach ($notices as $n): $u = $imgUrl($n); ?>
              <figure class="notice-slide">
                <div class="notice-slide__frame ph-frame"<?= $u ? ' role="button" tabindex="0" data-notice-zoom="' . e($u) . '"' : '' ?>>
                  <?= cms_image($n['image'] ?? ($n['attachment'] ?? ''), $n['title'], 'A4 · 794×1123', '', 'fa-file-lines') ?>
                  <?php if ($u): ?><span class="notice-slide__zoom"><i class="fa-solid fa-magnifying-glass-plus" aria-hidden="true"></i></span><?php endif; ?>
                </div>
                <figcaption class="notice-slide__cap"><?= e($n['title']) ?></figcaption>
                <?php if ($u): ?>
                  <a class="btn-outline btn-sm mt-3" href="<?= e($u) ?>" target="_blank" rel="noopener" download><i class="fa-solid fa-download" aria-hidden="true"></i> Download</a>
                <?php endif; ?>
              </figure>
            <?php endforeach; ?>
          </div>
        </div>
        <?php if (count($notices) > 1): ?>
          <button class="notice-carousel__arrow prev" type="button" aria-label="Previous notice"><i class="fa-solid fa-chevron-left" aria-hidden="true"></i></button>
          <button class="notice-carousel__arrow next" type="button" aria-label="Next notice"><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></button>
          <div class="notice-carousel__dots" role="tablist" aria-label="Notice navigation"></div>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- Notice lightbox -->
<div class="notice-lightbox" data-notice-lightbox aria-hidden="true">
  <button class="notice-lightbox__close" data-notice-lightbox-close aria-label="Close"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>
  <img src="" alt="Notice" />
</div>
