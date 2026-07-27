<?php
/**
 * CURRICULUM & DOCUMENTS — premium CMS-ready Document Centre.
 * Documents come from the `documents` table (admin-managed later).
 * Grouped by category, with parent sub-groups for nested documents.
 */
use App\Core\View;

echo View::render('site/partials/banner', [
    'title' => 'Curriculum & Documents',
    'subtitle' => 'Access all official school documents, CBSE records, curriculum information, certificates, reports and important downloads.',
    'image' => $page['banner_image'] ?: '',
    'pageTitle' => $page['title'] ?: 'Curriculum & Documents',
    'parent' => ['label' => 'Academics', 'url' => 'programs.html'],
]);

$documents = $documents ?? [];

// Category metadata: key => [section title, icon, pill label, badge]
$cats = [
    'academic'       => ['Academic Documents', 'fa-book-open', 'Academic', 'Academic'],
    'students'       => ['Student Records', 'fa-user-graduate', 'Students', 'Student Record'],
    'teachers'       => ['Teacher Information', 'fa-chalkboard-user', 'Teachers', 'Teacher Info'],
    'administration' => ['School Administration', 'fa-building-columns', 'Administration', 'Administration'],
    'infrastructure' => ['Infrastructure', 'fa-building', 'Infrastructure', 'Infrastructure'],
    'safety'         => ['Safety Certificates', 'fa-shield-halved', 'Safety', 'Safety'],
    'cbse'           => ['CBSE Mandatory Disclosure', 'fa-certificate', 'CBSE', 'CBSE'],
    'pta'            => ['PTA Documents', 'fa-people-roof', 'PTA', 'PTA'],
];

// Group documents by category, then by parent (null last)
$grouped = [];
foreach ($documents as $d) {
    $grouped[$d['category']][$d['parent'] ?: '__none'][] = $d;
}

$fmtDate = static fn($d) => $d ? date('d M Y', strtotime((string) $d)) : '';
$docUrl  = static fn($d) => !empty($d['file']) ? media_url($d['file']) : '#';
?>

<!-- INTRO -->
<section class="section">
  <div class="container-edu">
    <div class="doc-intro" data-reveal>
      <span class="doc-intro__icon"><i class="fa-solid fa-graduation-cap" aria-hidden="true"></i></span>
      <div>
        <span class="home-eyebrow">Curriculum Information</span>
        <h2 class="t-h3 mt-2 mb-2">A Digital Library of Official School Documents</h2>
        <p class="t-body">Channawar's e Vidya Mandir follows the curriculum and syllabus prescribed by CBSE. This page provides access to important academic records, curriculum documents, certificates, reports and statutory disclosures.</p>
      </div>
    </div>

    <!-- SEARCH -->
    <div class="doc-search" data-reveal>
      <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
      <input type="search" data-doc-search placeholder="Search documents by title, category or keyword…" aria-label="Search documents" />
    </div>

    <!-- FILTER PILLS -->
    <div class="doc-filters" data-doc-filters data-reveal>
      <button class="chip is-active" data-doc-filter="all" type="button">All</button>
      <?php foreach ($cats as $key => $meta): if (empty($grouped[$key])) continue; ?>
        <button class="chip" data-doc-filter="<?= e($key) ?>" type="button"><?= e($meta[2]) ?></button>
      <?php endforeach; ?>
    </div>

    <!-- NO RESULTS -->
    <p class="doc-empty" data-doc-empty hidden>No documents match your search.</p>

    <!-- CATEGORY ACCORDIONS -->
    <div class="doc-cats mt-8">
      <?php foreach ($cats as $key => $meta):
          if (empty($grouped[$key])) continue;
          $groups = $grouped[$key];
          // order: named parent groups first (as inserted), then ungrouped
          $none = $groups['__none'] ?? [];
          unset($groups['__none']);
          ?>
        <div class="doc-cat accordion" data-accordion data-cat="<?= e($key) ?>" data-reveal>
          <div class="accordion-item is-open">
            <button class="accordion-trigger doc-cat__trigger" aria-expanded="true">
              <span class="doc-cat__label"><span class="doc-cat__icon"><i class="fa-solid <?= e($meta[1]) ?>" aria-hidden="true"></i></span> <?= e($meta[0]) ?></span>
              <span class="accordion-icon">+</span>
            </button>
            <div class="accordion-panel"><div><div class="accordion-content !px-0">

              <?php
              // Render a set of doc cards
              $renderCards = static function (array $items) use ($meta, $fmtDate, $docUrl) {
                  foreach ($items as $d):
                      $url = $docUrl($d);
                      $date = $fmtDate($d['doc_date'] ?? null); ?>
                  <article class="doc-card" data-doc
                           data-title="<?= e(strtolower($d['title'])) ?>"
                           data-cat="<?= e($d['category']) ?>"
                           data-keywords="<?= e(strtolower(($d['parent'] ?? '') . ' ' . $meta[3] . ' ' . ($d['description'] ?? ''))) ?>">
                    <span class="doc-card__icon"><i class="fa-solid fa-file-pdf" aria-hidden="true"></i></span>
                    <div class="doc-card__body">
                      <span class="doc-card__badge"><?= e($meta[3]) ?> Document</span>
                      <h4 class="doc-card__title"><?= e($d['title']) ?></h4>
                      <?php if (!empty($d['description'])): ?><p class="doc-card__desc"><?= e($d['description']) ?></p><?php endif; ?>
                      <?php if ($date): ?><p class="doc-card__meta"><i class="fa-regular fa-clock" aria-hidden="true"></i> Updated: <?= e($date) ?></p><?php endif; ?>
                    </div>
                    <a class="btn-outline btn-sm doc-card__btn" href="<?= e($url) ?>" <?= $url !== '#' ? 'target="_blank" rel="noopener"' : 'aria-disabled="true"' ?>><i class="fa-solid fa-eye" aria-hidden="true"></i> View</a>
                  </article>
              <?php endforeach;
              };
              ?>

              <?php foreach ($groups as $parent => $items): ?>
                <div class="doc-subgroup">
                  <p class="doc-subgroup__title"><i class="fa-solid fa-folder-open" aria-hidden="true"></i> <?= e($parent) ?></p>
                  <div class="doc-grid"><?php $renderCards($items); ?></div>
                </div>
              <?php endforeach; ?>

              <?php if ($none): ?>
                <div class="doc-grid"><?php $renderCards($none); ?></div>
              <?php endif; ?>

            </div></div></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
