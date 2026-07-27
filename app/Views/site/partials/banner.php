<?php
/** @var string $title @var string $image @var string $pageTitle */
// Use a local placeholder when no banner image is set (offline-safe).
$bannerBg = (empty($image) || strpos($image, 'unsplash.com') !== false)
    ? placeholder('banner')
    : media_url($image, 'banner');
?>
<section class="hero-banner" data-cms="banner">
  <img class="hero-banner__bg" src="<?= e($bannerBg) ?>" alt="" fetchpriority="high" />
  <span class="hero-banner__overlay"></span>
  <div class="container-edu hero-banner__content">
    <h1 class="hero-banner__title" data-reveal><?= e($title) ?></h1>
    <?php if (!empty($subtitle)): ?><p class="hero-banner__subtitle" data-reveal><?= e($subtitle) ?></p><?php endif; ?>
    <nav class="breadcrumb" aria-label="Breadcrumb" data-reveal>
      <a href="index.html">Home</a><span class="sep">&raquo;</span><?php if (!empty($parent['label'])): ?><a href="<?= e($parent['url'] ?? '#') ?>"><?= e($parent['label']) ?></a><span class="sep">&raquo;</span><?php endif; ?><span class="current"><?= e($pageTitle) ?></span>
    </nav>
  </div>
  <span class="hero-deco"><svg width="70" height="70" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="7" cy="17" r="3" stroke="currentColor" stroke-width="1.4"/><path d="M11 13 20 4m0 0h-6m6 0v6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
  <div class="hero-wave"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><path fill="#ffffff" d="M0 60V22c180 34 360 34 540 8S900-8 1080 2s300 30 360 34v24H0Z"/></svg></div>
</section>
