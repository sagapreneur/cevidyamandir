<?php
use App\Models\Setting;
use App\Models\Navigation;

$logo = Setting::get('logo') ?: asset('images/logo.jpg');
$siteName = Setting::get('site_name', "Channawar's e Vidya Mandir");
$primary = Navigation::primary();
$activeKey = $slug ?? '';
// map slug → nav key for active state
$keyForSlug = static function (string $slug): string {
    $map = [
        'index' => 'home', 'about' => 'about', 'president-desk' => 'about', 'principal-desk' => 'about',
        'programs' => 'academics', 'curriculum' => 'academics', 'academic-calendar' => 'academics', 'fees-structure' => 'academics',
        'admissions' => 'admissions', 'notices' => 'media', 'gallery' => 'media', 'downloads' => 'media', 'reviews' => 'media',
        'engage' => 'engage', 'careers' => 'engage', 'intern-volunteer' => 'engage', 'support-us' => 'engage',
        'contact' => 'contact', 'locate-us' => 'contact', 'bonafide' => 'contact',
    ];
    return $map[$slug] ?? '';
};
$active = $keyForSlug($activeKey);
?>
<header class="site-header">
  <div class="container-edu">
    <nav class="navbar" aria-label="Primary">
      <a href="index.html" class="navbar-brand" aria-label="<?= e($siteName) ?> — home">
        <img src="<?= e($logo) ?>" alt="<?= e($siteName) ?> logo" width="176" height="44" decoding="async" loading="eager" fetchpriority="high" />
      </a>

      <ul class="nav-menu list-none">
        <?php foreach ($primary as $item):
            $cur = ($item['nav_key'] && $item['nav_key'] === $active) ? ' aria-current="page"' : ''; ?>
          <?php if (!empty($item['mega'])): ?>
            <li class="nav-item">
              <a href="<?= e($item['url']) ?>" class="nav-link" data-nav="<?= e($item['nav_key']) ?>"<?= $cur ?>><?= e($item['label']) ?> <span class="nav-caret">▾</span></a>
              <div class="nav-mega"><div class="nav-mega-grid">
                <?php foreach ($item['mega'] as $groupTitle => $links): ?>
                  <div><p class="nav-mega-title"><?= e($groupTitle) ?></p>
                    <?php foreach ($links as $l): ?><a href="<?= e($l['url']) ?>"><?= e($l['label']) ?></a><?php endforeach; ?>
                  </div>
                <?php endforeach; ?>
              </div></div>
            </li>
          <?php elseif (!empty($item['children'])): ?>
            <li class="nav-item">
              <a href="<?= e($item['url']) ?>" class="nav-link" data-nav="<?= e($item['nav_key']) ?>"<?= $cur ?>><?= e($item['label']) ?> <span class="nav-caret">▾</span></a>
              <div class="nav-dropdown">
                <?php foreach ($item['children'] as $c): ?><a href="<?= e($c['url']) ?>"><?= e($c['label']) ?></a><?php endforeach; ?>
              </div>
            </li>
          <?php else: ?>
            <li class="nav-item"><a href="<?= e($item['url']) ?>" class="nav-link" data-nav="<?= e($item['nav_key']) ?>"<?= $cur ?>><?= e($item['label']) ?></a></li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>

      <div class="nav-actions">
        <a href="admissions.html" class="btn-red btn-sm hidden sm:inline-flex">Apply Now</a>
        <button class="nav-toggle" data-menu-open aria-controls="mobileDrawer" aria-expanded="false" aria-label="Open menu">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        </button>
      </div>
    </nav>
  </div>
</header>

<div class="mobile-backdrop" data-menu-close></div>
<aside id="mobileDrawer" class="mobile-drawer" aria-label="Mobile navigation">
  <div class="mb-6 flex items-center justify-between">
    <img src="<?= e($logo) ?>" alt="<?= e($siteName) ?>" class="h-10 w-auto object-contain" width="176" height="44" decoding="async" />
    <button class="btn-icon" data-menu-close aria-label="Close menu">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 6l12 12M18 6 6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
    </button>
  </div>
  <div class="accordion" data-accordion data-single>
    <?php foreach ($primary as $item):
        $kids = !empty($item['mega']) ? array_merge(...array_values($item['mega'])) : ($item['children'] ?? []);
        if (empty($kids)): ?>
        <a href="<?= e($item['url']) ?>" class="nav-link"><?= e($item['label']) ?></a>
      <?php else: ?>
        <div class="accordion-item">
          <button class="accordion-trigger !py-3 !px-0" aria-expanded="false"><?= e($item['label']) ?> <span class="accordion-icon">+</span></button>
          <div class="accordion-panel"><div><div class="accordion-content !px-0 flex flex-col">
            <?php foreach ($kids as $c): ?><a href="<?= e($c['url']) ?>" class="nav-link !py-2"><?= e($c['label']) ?></a><?php endforeach; ?>
          </div></div></div>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
  <a href="admissions.html" class="btn-red btn-block mt-6">Apply Now</a>
</aside>
