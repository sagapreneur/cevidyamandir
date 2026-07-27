<?php
use App\Core\View;
use App\Models\Block;
$pic = static fn($v, $f) => $v === '' || $v === null ? $f : (preg_match('#^https?://#', (string) $v) ? $v : upload_url($v));
echo View::render('site/partials/banner', [
    'title' => $page['banner_title'] ?: $page['title'],
    'image' => $page['banner_image'] ?: '',
    'pageTitle' => $page['title'],
]);
?>
<section class="section">
  <div class="container-edu">
    <div class="section-head">
      <span class="eyebrow"><?= e(Block::field('programs', 'intro', 'eyebrow', 'Learning journey')) ?></span>
      <h2 class="t-h2"><?= e(Block::field('programs', 'intro', 'title', 'Programs For Every Stage')) ?></h2>
      <p class="t-body"><?= e(Block::field('programs', 'intro', 'subtitle', 'A carefully designed progression that grows with your child.')) ?></p>
    </div>
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3" data-reveal-stagger="90">
      <?php foreach (($programs ?? []) as $prog): ?>
        <article class="card card-hover card-blog" data-reveal>
          <div class="card-image">
            <?= cms_image($prog['image'] ?? '', ($prog['title'] ?? 'Program') . ' Image', '440×300') ?>
            <?php if ($prog['badge']): ?><span class="card-badge badge-accent"><?= e($prog['badge']) ?></span><?php endif; ?>
          </div>
          <div class="card-body">
            <h3 class="t-h4 mb-2"><?= e($prog['title']) ?></h3>
            <p class="t-small mb-4"><?= e($prog['excerpt']) ?></p>
            <a href="<?= e($prog['link_url'] ?: 'curriculum.html') ?>" class="btn-link">View curriculum →</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section-soft">
  <div class="container-edu">
    <div class="cta-band">
      <h2 class="t-h2 !text-white"><?= e(Block::field('programs', 'cta', 'title', 'Not Sure Which Program Fits?')) ?></h2>
      <p class="mt-3 text-white/85"><?= e(Block::field('programs', 'cta', 'subtitle', 'Our admissions team will help you find the right stage for your child.')) ?></p>
      <div class="mt-6 flex justify-center gap-4"><a href="admissions.html" class="btn-accent">Apply now</a><a href="contact.html" class="btn-outline border-white text-white hover:bg-white hover:text-primary">Ask a question</a></div>
    </div>
  </div>
</section>
