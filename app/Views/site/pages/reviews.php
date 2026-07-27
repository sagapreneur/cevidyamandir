<?php
use App\Core\View;
echo View::render('site/partials/banner', [
    'title' => $page['banner_title'] ?: $page['title'],
    'image' => $page['banner_image'] ?: '',
    'pageTitle' => $page['title'],
]);
$avg = 0; $n = count($reviews);
if ($n) { foreach ($reviews as $r) { $avg += (int) $r['rating']; } $avg = round($avg / $n, 1); }
?>
<section class="section">
  <div class="container-edu">
    <div class="grid items-center gap-8 rounded-xl bg-surface-soft p-8 sm:grid-cols-3 lg:p-12" data-reveal>
      <div class="text-center sm:border-r sm:border-border"><div class="stat-number"><?= e((string) ($avg ?: '5.0')) ?></div><div class="rating justify-center">★★★★★</div><p class="t-small">Average rating</p></div>
      <div class="text-center sm:border-r sm:border-border"><div class="stat-number" data-count="<?= (int) $n ?>" data-suffix="+">0</div><p class="t-small">Verified reviews</p></div>
      <div class="text-center"><div class="stat-number" data-count="96" data-suffix="%">0</div><p class="t-small">Would recommend</p></div>
    </div>

    <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3" data-reveal-stagger="90">
      <?php if (empty($reviews)): ?>
        <p class="t-body">No reviews yet.</p>
      <?php else: foreach ($reviews as $r):
          $stars = str_repeat('★', (int) $r['rating']) . str_repeat('☆', 5 - (int) $r['rating']);
          $avatar = $r['avatar'] ? upload_url($r['avatar']) : placeholder('avatar'); ?>
        <div class="testimonial" data-reveal>
          <div class="rating"><?= e($stars) ?></div>
          <p class="testimonial-quote"><?= e($r['review']) ?></p>
          <div class="testimonial-author">
            <img class="testimonial-avatar" src="<?= e($avatar) ?>" alt="" loading="lazy" decoding="async" />
            <div><p class="testimonial-name"><?= e($r['name']) ?></p><p class="testimonial-role"><?= e($r['designation']) ?></p></div>
          </div>
        </div>
      <?php endforeach; endif; ?>
    </div>

    <div class="mt-12 text-center"><a href="contact.html" class="btn-primary">Share your experience</a></div>
  </div>
</section>
