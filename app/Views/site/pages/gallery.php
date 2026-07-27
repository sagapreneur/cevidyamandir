<?php
use App\Core\View;
echo View::render('site/partials/banner', [
    'title' => $page['banner_title'] ?: $page['title'],
    'image' => $page['banner_image'] ?: '',
    'pageTitle' => $page['title'],
]);
// distinct categories for filter chips
$cats = [];
foreach ($images as $im) { if ($im['category']) $cats[$im['category']] = true; }
?>
<section class="section">
  <div class="container-edu">
    <div class="gallery-filters" data-gallery-filters>
      <button class="chip is-active" data-filter="all">All</button>
      <?php foreach (array_keys($cats) as $c): ?>
        <button class="chip" data-filter="<?= e(strtolower($c)) ?>"><?= e(ucfirst($c)) ?></button>
      <?php endforeach; ?>
    </div>

    <div class="gallery-grid" data-gallery>
      <?php if (empty($images)): ?>
        <p class="t-body">No gallery images yet.</p>
      <?php else: foreach ($images as $im): ?>
        <figure class="gallery-item" data-category="<?= e(strtolower($im['category'] ?? '')) ?>" data-reveal>
          <img src="<?= e(media_url($im['image'], 'landscape')) ?>" alt="<?= e($im['title']) ?>" loading="lazy" decoding="async" />
          <div class="gallery-overlay"><span class="zoom"><i class="fa-solid fa-expand" aria-hidden="true"></i></span></div>
        </figure>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>
