<?php
/**
 * Premium executive "Desk" layout — shared by President's & Principal's Desk.
 * Expects: $leader (array|null), $page, $eyebrow, $defaults
 * Optional: $openingQuote, $openingQuoteAttr, $highlightLabel, $highlightText
 *
 * CONTENT RULE: the message body ($bio) is rendered verbatim — never rewritten.
 * Only the visual presentation (layout, typography, spacing, icons) is enhanced.
 */
use App\Core\View;
use App\Models\Setting;

$pic = static fn($v, $f) => $v === '' || $v === null ? $f : (preg_match('#^https?://#', (string) $v) ? $v : upload_url($v));
$L = $leader ?? [];
$name = $L['name'] ?? ($defaults['name'] ?? '');
$role = $L['role'] ?? ($defaults['role'] ?? '');
$photo = $pic($L['photo'] ?? '', $defaults['photo'] ?? placeholder('portrait'));
$hasPhoto = !empty($L['photo']) || !empty($defaults['photo_is_real']);
$quote = $L['quote'] ?? ($defaults['quote'] ?? '');
$bio = $L['bio'] ?? ($defaults['bio'] ?? '');
$signature = $L['signature'] ?? '';
$heading = $defaults['heading'] ?? 'A Message';
$sections = $sections ?? ($defaults['sections'] ?? null); // [['icon','heading','body'], ...] verbatim
$openingQuote = $openingQuote ?? $quote;
$openingQuoteAttr = $openingQuoteAttr ?? $name;
$highlightLabel = $highlightLabel ?? 'Our Mission';
$highlightText = $highlightText ?? '';
$highlightIcon = $highlightIcon ?? ($defaults['highlightIcon'] ?? 'fa-bullseye');
$siteName = Setting::get('site_name', "Channawar's e Vidya Mandir");
$logo = Setting::get('logo') ?: asset('images/logo.jpg');
$socials = array_filter(array_map('trim', explode(',', (string) ($L['socials'] ?? ''))));
$leadIcons = ['fa-facebook-f', 'fa-linkedin-in', 'fa-x-twitter'];

echo View::render('site/partials/banner', [
    'title' => $page['banner_title'] ?: $page['title'],
    'image' => $page['banner_image'] ?: '',
    'pageTitle' => $page['title'],
    'parent' => ['label' => 'About', 'url' => 'about.html'],
]);
?>

<!-- ============ OPENING QUOTE ============ -->
<?php if ($openingQuote): ?>
<section class="section !pb-0">
  <div class="container-edu">
    <blockquote class="desk-quote" data-reveal>
      <i class="fa-solid fa-quote-left desk-quote__mark" aria-hidden="true"></i>
      <p class="desk-quote__text"><?= e($openingQuote) ?></p>
      <?php if ($openingQuoteAttr): ?><cite class="desk-quote__cite"><?= e($openingQuoteAttr) ?></cite><?php endif; ?>
    </blockquote>
  </div>
</section>
<?php endif; ?>

<!-- ============ MESSAGE ============ -->
<section class="section desk-section">
  <span class="desk-deco desk-deco--1"><i class="fa-solid fa-graduation-cap" aria-hidden="true"></i></span>
  <span class="desk-deco desk-deco--2"><i class="fa-solid fa-book-open" aria-hidden="true"></i></span>
  <div class="container-edu desk-grid">

    <!-- Portrait card — right column on desktop, shown first on mobile -->
    <aside class="desk-grid__aside" data-reveal="right">
      <figure class="portrait-card">
        <i class="fa-solid fa-quote-right portrait-card__quote" aria-hidden="true"></i>
        <img class="portrait-card__watermark" src="<?= e($logo) ?>" alt="" aria-hidden="true" loading="lazy" />
        <div class="portrait-card__img">
          <img src="<?= e($photo) ?>" alt="<?= e($name) ?>, <?= e($role) ?>" width="390" height="480" loading="lazy" decoding="async" />
        </div>
        <figcaption class="portrait-card__body">
          <span class="portrait-card__divider" aria-hidden="true"></span>
          <h2 class="portrait-card__name"><?= e($name) ?></h2>
          <p class="portrait-card__role"><?= e($role) ?></p>
          <p class="portrait-card__school"><?= e($siteName) ?></p>
          <?php if ($socials): ?>
          <div class="footer-social mt-4 justify-center [&_a]:bg-primary/10 [&_a]:text-primary">
            <?php foreach ($socials as $i => $u): ?>
              <a href="<?= e($u) ?>" target="_blank" rel="noopener noreferrer" aria-label="Social link"><i class="fa-brands <?= e($leadIcons[$i] ?? 'fa-link') ?>" aria-hidden="true"></i></a>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </figcaption>
      </figure>
    </aside>

    <!-- LEFT: message content -->
    <div class="desk-grid__content" data-reveal="left">
      <span class="home-eyebrow"><?= e($eyebrow) ?></span>
      <h2 class="t-h2 mt-3 mb-6"><?= e($heading) ?></h2>

      <?php
      // Reusable highlight strip markup
      $renderHighlight = static function () use ($highlightText, $highlightLabel, $highlightIcon) {
          if (!$highlightText) return; ?>
        <div class="highlight-strip" data-reveal>
          <span class="highlight-strip__icon"><i class="fa-solid <?= e($highlightIcon) ?>" aria-hidden="true"></i></span>
          <div>
            <p class="highlight-strip__label"><?= e($highlightLabel) ?></p>
            <p class="highlight-strip__text"><?= e($highlightText) ?></p>
          </div>
        </div>
      <?php };
      ?>

      <?php if (is_array($sections) && $sections): ?>
        <div class="desk-body">
          <?php foreach ($sections as $i => $sec): ?>
            <div class="desk-block" data-reveal>
              <h3 class="desk-block__title">
                <span class="desk-block__icon"><i class="fa-solid <?= e($sec['icon'] ?? 'fa-circle-dot') ?>" aria-hidden="true"></i></span>
                <?= e($sec['heading'] ?? '') ?>
              </h3>
              <?= $sec['body'] /* verbatim — content preserved exactly */ ?>
            </div>
            <?php if ($i === 0) { $renderHighlight(); } ?>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="desk-body">
          <?= $bio /* verbatim — HTML content preserved exactly */ ?>
        </div>
        <?php $renderHighlight(); ?>
      <?php endif; ?>

      <!-- Signature -->
      <div class="desk-signature" data-reveal>
        <span class="desk-signature__thumb">
          <img src="<?= e($photo) ?>" alt="" aria-hidden="true" loading="lazy" />
        </span>
        <div>
          <?php if ($signature): ?><img src="<?= e($pic($signature, '')) ?>" alt="Signature" class="desk-signature__mark" loading="lazy" /><?php endif; ?>
          <p class="desk-signature__name"><?= e($name) ?></p>
          <p class="desk-signature__role"><?= e($role) ?> · <?= e($siteName) ?></p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ CTA ============ -->
<section class="section !pt-0">
  <div class="container-edu">
    <div class="relative overflow-hidden rounded-xl bg-grad-ink px-6 py-14 text-center text-white lg:px-16" data-reveal>
      <div class="relative z-10 mx-auto max-w-2xl">
        <h2 class="t-h2 !text-white mb-3">Become Part of Our Learning Journey</h2>
        <p class="text-white/85 mb-8">Join a school that puts every child’s growth, values and confidence first.</p>
        <div class="flex flex-wrap justify-center gap-4">
          <a href="admissions.html" class="btn-red btn-lg"><i class="fa-solid fa-paper-plane" aria-hidden="true"></i> Apply for Admission</a>
          <a href="contact.html" class="btn-outline btn-lg border-white text-white hover:bg-white hover:text-primary"><i class="fa-solid fa-envelope" aria-hidden="true"></i> Contact Us</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ RELATED LINKS ============ -->
<section class="section section-soft">
  <div class="container-edu">
    <div class="grid gap-6 md:grid-cols-3" data-reveal-stagger="90">
      <?php
      $related = [
          ['about.html', 'fa-school', 'About School', 'Our story, mission, vision and the values that guide us.'],
          ['admissions.html', 'fa-user-plus', 'Admissions', 'A simple, welcoming admission process for every family.'],
          ['contact.html', 'fa-location-dot', 'Contact School', 'Reach our team, plan a visit or ask a quick question.'],
      ];
      foreach ($related as $r): ?>
        <a href="<?= e($r[0]) ?>" class="related-card" data-reveal>
          <span class="related-card__icon"><i class="fa-solid <?= e($r[1]) ?>" aria-hidden="true"></i></span>
          <h3 class="t-h4 mb-1"><?= e($r[2]) ?></h3>
          <p class="t-small mb-3"><?= e($r[3]) ?></p>
          <span class="btn-link">Explore <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
