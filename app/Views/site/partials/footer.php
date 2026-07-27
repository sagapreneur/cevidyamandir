<?php
use App\Models\Setting;
use App\Models\Navigation;

$logo = Setting::get('logo') ?: asset('images/logo.jpg');
$siteName = Setting::get('site_name', "Channawar's e Vidya Mandir");
$cols = Navigation::footerColumns();

// Font Awesome brand icon class per social network
$icons = [
    'instagram' => '<i class="fa-brands fa-instagram" aria-hidden="true"></i>',
    'facebook'  => '<i class="fa-brands fa-facebook-f" aria-hidden="true"></i>',
    'youtube'   => '<i class="fa-brands fa-youtube" aria-hidden="true"></i>',
];
$socialLinks = [
    'Instagram' => Setting::get('social_instagram'),
    'Facebook' => Setting::get('social_facebook'),
    'YouTube' => Setting::get('social_youtube'),
];
$socialLinks = array_filter($socialLinks);
?>
<footer class="site-footer">
  <div class="container-edu">
    <div class="footer-top">
      <div class="lg:col-span-4">
        <a href="index.html" class="mb-5 inline-flex rounded-sm bg-white p-2.5 shadow-sm">
          <img src="<?= e($logo) ?>" alt="<?= e($siteName) ?>" class="h-10 w-auto object-contain" width="176" height="44" loading="lazy" decoding="async" />
        </a>
        <p class="mb-5 text-white/70"><?= e(Setting::get('footer_blurb', "A CBSE school in Wardha nurturing every child from Nursery to Class X.")) ?></p>
        <p class="mb-3 flex items-start gap-3 text-white/80"><span class="icon-circle h-8 w-8 bg-white/10 shrink-0"><i class="fa-solid fa-location-dot" aria-hidden="true"></i></span> <?= e(Setting::get('contact_address', 'Arvi Road, near Vyanktesh Polytechnic, Wardha, Maharashtra 442001')) ?></p>
        <p class="mb-2 flex items-center gap-3 text-white/80"><span class="icon-circle h-8 w-8 bg-white/10 shrink-0"><i class="fa-solid fa-phone" aria-hidden="true"></i></span> <a href="tel:<?= e(Setting::get('contact_phone_href', '+918551061975')) ?>" class="text-white/80 hover:text-white"><?= e(Setting::get('contact_phone', '+91 8551061975')) ?></a></p>
        <p class="flex items-center gap-3 text-white/80"><span class="icon-circle h-8 w-8 bg-white/10 shrink-0"><i class="fa-solid fa-envelope" aria-hidden="true"></i></span> <a href="mailto:<?= e(Setting::get('contact_email', 'cevidyamandir@gmail.com')) ?>" class="text-white/80 hover:text-white"><?= e(Setting::get('contact_email', 'cevidyamandir@gmail.com')) ?></a></p>
      </div>

      <?php foreach ($cols as $col): ?>
        <div class="lg:col-span-2">
          <h3 class="footer-col-title"><?= e($col['label']) ?></h3>
          <nav class="footer-links" aria-label="Footer <?= e(strtolower($col['label'])) ?> links">
            <?php foreach ($col['children'] as $l): ?><a href="<?= e($l['url']) ?>"><?= e($l['label']) ?></a><?php endforeach; ?>
          </nav>
        </div>
      <?php endforeach; ?>

      <div class="lg:col-span-4">
        <h3 class="footer-col-title">Newsletter</h3>
        <p class="mb-4 text-white/70"><?= e(Setting::get('newsletter_blurb', 'Subscribe for admission updates, events and circulars.')) ?></p>
        <form class="newsletter" data-form data-form-type="newsletter">
          <input type="email" name="email" placeholder="Enter your email" aria-label="Email address" required />
          <button class="btn-red btn-sm" type="submit" aria-label="Subscribe">
            <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
          </button>
        </form>
        <?php if ($socialLinks): ?>
        <div class="footer-social mt-6">
          <span class="text-white/60 text-sm mr-1">Follow us</span>
          <?php foreach ($socialLinks as $label => $url): ?>
            <a href="<?= e($url) ?>" target="_blank" rel="noopener noreferrer" aria-label="<?= e($siteName . ' on ' . $label) ?>"><?= $icons[strtolower($label)] ?? '' ?></a>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; <?= e(Setting::get('copyright_year', '2026')) ?> <?= e($siteName) ?>. All rights reserved.</p>
      <nav class="flex items-center gap-6" aria-label="Legal">
        <a href="#" class="hover:text-white">Terms &amp; Conditions</a>
        <a href="#" class="hover:text-white">Privacy Policy</a>
      </nav>
    </div>
  </div>
</footer>
