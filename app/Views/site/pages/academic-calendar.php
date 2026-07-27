<?php
/**
 * ACADEMIC CALENDAR — premium A4-landscape calendar viewer (CMS-ready).
 * Slides come from the `calendar_pages` table (admin-managed later).
 */
use App\Core\View;

echo View::render('site/partials/banner', [
    'title' => 'Academic Calendar',
    'subtitle' => "Stay informed about the academic year with our official school calendar. Browse each month's schedule, holidays, examinations and important academic activities.",
    'image' => $page['banner_image'] ?: '',
    'pageTitle' => $page['title'] ?: 'Academic Calendar',
    'parent' => ['label' => 'Academics', 'url' => 'programs.html'],
]);

$calendarPages = $calendarPages ?? [];
$total = count($calendarPages);
$imgUrl = static function (array $c): string {
    $v = trim((string) ($c['image'] ?? ''));
    return $v !== '' ? media_url($v) : '';
};
?>

<!-- INTRO -->
<section class="section !pb-0">
  <div class="container-edu">
    <div class="cal-intro" data-reveal>
      <span class="cal-intro__icon"><i class="fa-regular fa-calendar-days" aria-hidden="true"></i></span>
      <div>
        <span class="home-eyebrow">Academic Session Calendar</span>
        <h2 class="t-h3 mt-2 mb-2">Your Complete Guide to the School Year</h2>
        <p class="t-body">The Academic Calendar provides students and parents with a complete overview of the school year's important dates, holidays, examinations, activities and academic schedule.</p>
      </div>
    </div>
  </div>
</section>

<!-- CALENDAR VIEWER -->
<section class="section">
  <div class="container-edu">
    <?php if ($total === 0): ?>
      <div class="ph-frame shadow-card mx-auto" style="max-width:900px;aspect-ratio:297/210">
        <?= placeholder_box('Calendar coming soon', 'A4 Landscape', 'fa-calendar-days') ?>
      </div>
    <?php else: ?>
      <div class="cal-viewer" data-cal-viewer data-total="<?= (int) $total ?>">
        <!-- Month / page indicator -->
        <p class="cal-viewer__indicator" data-cal-title><?= e($calendarPages[0]['title']) ?></p>

        <div class="cal-viewer__stage">
          <button class="cal-arrow prev" type="button" data-cal-prev aria-label="Previous calendar page"><i class="fa-solid fa-chevron-left" aria-hidden="true"></i></button>

          <div class="cal-viewer__viewport">
            <div class="cal-viewer__track" data-cal-track>
              <?php foreach ($calendarPages as $i => $c): $u = $imgUrl($c); ?>
                <figure class="cal-slide" data-cal-slide data-title="<?= e($c['title']) ?>" data-src="<?= e($u) ?>">
                  <div class="cal-slide__frame ph-frame"<?= $u ? ' role="button" tabindex="0" data-cal-zoom' : '' ?>>
                    <?= cms_image($c['image'] ?? '', $c['title'], 'A4 Landscape · 1123×794', '', 'fa-calendar-days') ?>
                    <?php if ($u): ?><span class="cal-slide__zoom"><i class="fa-solid fa-magnifying-glass-plus" aria-hidden="true"></i></span><?php endif; ?>
                  </div>
                </figure>
              <?php endforeach; ?>
            </div>
          </div>

          <button class="cal-arrow next" type="button" data-cal-next aria-label="Next calendar page"><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></button>
        </div>

        <!-- Controls: prev · counter · next -->
        <div class="cal-viewer__controls">
          <button class="btn-outline btn-sm" type="button" data-cal-prev><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Previous</button>
          <span class="cal-viewer__counter"><span data-cal-current>01</span> / <?= sprintf('%02d', $total) ?></span>
          <button class="btn-outline btn-sm" type="button" data-cal-next>Next <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></button>
        </div>

        <?php if ($total > 1): ?>
          <div class="cal-viewer__dots" data-cal-dots role="tablist" aria-label="Calendar pages"></div>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- Full-screen lightbox -->
<div class="cal-lightbox" data-cal-lightbox aria-hidden="true">
  <button class="cal-lightbox__close" data-cal-lightbox-close aria-label="Close"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>
  <button class="cal-lightbox__arrow prev" data-cal-prev aria-label="Previous"><i class="fa-solid fa-chevron-left" aria-hidden="true"></i></button>
  <img src="" alt="Academic calendar page" data-cal-lightbox-img />
  <button class="cal-lightbox__arrow next" data-cal-next aria-label="Next"><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></button>
</div>
