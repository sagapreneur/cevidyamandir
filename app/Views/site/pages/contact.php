<?php
use App\Core\View;
use App\Models\Setting;
use App\Models\Block;
echo View::render('site/partials/banner', [
    'title' => $page['banner_title'] ?: $page['title'],
    'image' => $page['banner_image'] ?: '',
    'pageTitle' => $page['title'],
]);
$phone = Setting::get('contact_phone', '+91 8551061975');
$email = Setting::get('contact_email', 'cevidyamandir@gmail.com');
$address = Setting::get('contact_address', 'Arvi Road, near Vyanktesh Polytechnic, Wardha, Maharashtra 442001');
$hours = Setting::get('contact_hours', 'Mon – Sat · 8:00 AM – 4:00 PM');
$phoneHref = Setting::get('contact_phone_href', '+918551061975');
$map = Setting::get('google_map', 'https://www.google.com/maps?q=Channawar%27s+e+Vidya+Mandir%2C+Arvi+Road%2C+Wardha%2C+Maharashtra+442001&output=embed');
$social = array_filter([
    'Instagram' => Setting::get('social_instagram'),
    'Facebook'  => Setting::get('social_facebook'),
    'YouTube'   => Setting::get('social_youtube'),
]);
$intro = Block::get('contact', 'intro', [
    'eyebrow' => 'Get in touch', 'title' => 'Ready to Get Started?',
    'body' => 'Have a question about admissions, curriculum or a campus visit? Send us a message and our team will get back to you shortly.',
]);
?>
<section class="section">
  <div class="container-edu grid items-start gap-12 lg:grid-cols-2">
    <div class="overflow-hidden rounded-xl shadow-card" data-reveal="right">
      <div class="bg-grad-primary p-8 text-white sm:p-10">
        <div class="flex flex-col gap-7">
          <div class="flex items-center gap-4">
            <span class="icon-circle h-14 w-14 bg-white/15 text-xl"><i class="fa-solid fa-phone" aria-hidden="true"></i></span>
            <div><p class="text-white/70 text-sm">Call Us</p><p class="text-xl font-semibold"><a href="tel:<?= e($phoneHref) ?>" class="text-white"><?= e($phone) ?></a></p></div>
          </div>
          <div class="divider !bg-white/15"></div>
          <div class="flex items-center gap-4">
            <span class="icon-circle h-14 w-14 bg-white/15 text-xl"><i class="fa-solid fa-envelope" aria-hidden="true"></i></span>
            <div><p class="text-white/70 text-sm">Write to us</p><p class="text-xl font-semibold"><a href="mailto:<?= e($email) ?>" class="text-white"><?= e($email) ?></a></p></div>
          </div>
          <div class="divider !bg-white/15"></div>
          <div class="flex items-start gap-4">
            <span class="icon-circle h-14 w-14 bg-white/15 text-xl"><i class="fa-solid fa-location-dot" aria-hidden="true"></i></span>
            <div><p class="text-white/70 text-sm">Location</p><p class="text-xl font-semibold leading-snug"><?= e($address) ?></p></div>
          </div>
          <div class="divider !bg-white/15"></div>
          <div class="flex items-start gap-4">
            <span class="icon-circle h-14 w-14 bg-white/15 text-xl"><i class="fa-regular fa-clock" aria-hidden="true"></i></span>
            <div>
              <p class="text-white/70 text-sm">Office Hours</p>
              <p class="text-xl font-semibold leading-snug">Monday &ndash; Saturday</p>
              <p class="text-white/85">8:00 AM &ndash; 4:00 PM</p>
              <p class="text-white/60 text-sm">Closed on Sunday</p>
            </div>
          </div>
          <?php if ($social): $sIcons = ['Instagram' => 'fa-instagram', 'Facebook' => 'fa-facebook-f', 'YouTube' => 'fa-youtube']; ?>
          <div class="divider !bg-white/15"></div>
          <div class="footer-social [&_a]:bg-white/15 [&_a]:text-white">
            <span class="text-white/70 text-sm mr-1">Follow us</span>
            <?php foreach ($social as $label => $url): ?>
              <a href="<?= e($url) ?>" target="_blank" rel="noopener noreferrer" aria-label="<?= e($label) ?>"><i class="fa-brands <?= e($sIcons[$label] ?? 'fa-link') ?>" aria-hidden="true"></i></a>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div data-reveal="left">
      <span class="home-eyebrow"><?= e($intro['eyebrow']) ?></span>
      <h2 class="t-h2 mt-3 mb-3"><?= e($intro['title']) ?></h2>
      <p class="t-body mb-8"><?= e($intro['body']) ?></p>
      <form class="flex flex-col gap-5" data-form-type="contact" novalidate>
        <div class="grid gap-5 sm:grid-cols-2">
          <div class="form-group"><label class="form-label" for="c-name">Your Name <span class="req">*</span></label><input class="input" id="c-name" name="name" placeholder="Your name" required /></div>
          <div class="form-group"><label class="form-label" for="c-email">Your Email <span class="req">*</span></label><input class="input" id="c-email" name="email" type="email" placeholder="you@example.com" required /></div>
        </div>
        <div class="grid gap-5 sm:grid-cols-2">
          <div class="form-group"><label class="form-label" for="c-phone">Phone</label><input class="input" id="c-phone" name="phone" type="tel" placeholder="+91" /></div>
          <div class="form-group"><label class="form-label" for="c-subject">Subject</label><select class="select" id="c-subject" name="subject"><option>Admission enquiry</option><option>Campus visit</option><option>General question</option></select></div>
        </div>
        <div class="form-group"><label class="form-label" for="c-msg">Your Message <span class="req">*</span></label><textarea class="textarea" id="c-msg" name="message" placeholder="How can we help?" required></textarea></div>
        <button class="btn-primary self-start" type="submit">Send Message <i class="fa-solid fa-paper-plane" aria-hidden="true"></i></button>
      </form>
    </div>
  </div>
</section>

<section class="section !pt-0">
  <div class="container-edu">
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4" data-reveal-stagger="80">
      <a href="tel:<?= e($phoneHref) ?>" class="info-card" data-reveal>
        <span class="info-card__icon"><i class="fa-solid fa-phone" aria-hidden="true"></i></span>
        <p class="info-card__label">Call Us</p>
        <p class="info-card__value"><?= e($phone) ?></p>
      </a>
      <a href="mailto:<?= e($email) ?>" class="info-card" data-reveal>
        <span class="info-card__icon"><i class="fa-solid fa-envelope" aria-hidden="true"></i></span>
        <p class="info-card__label">Email Us</p>
        <p class="info-card__value break-all"><?= e($email) ?></p>
      </a>
      <div class="info-card" data-reveal>
        <span class="info-card__icon"><i class="fa-solid fa-location-dot" aria-hidden="true"></i></span>
        <p class="info-card__label">Visit Us</p>
        <p class="info-card__value">Wardha, Maharashtra</p>
      </div>
      <div class="info-card" data-reveal>
        <span class="info-card__icon"><i class="fa-regular fa-clock" aria-hidden="true"></i></span>
        <p class="info-card__label">Office Hours</p>
        <p class="info-card__value">Monday &ndash; Saturday<br><span class="info-card__sub">8:00 AM &ndash; 4:00 PM</span></p>
      </div>
    </div>
  </div>
</section>

<!-- OFFICIAL SCHOOL VIDEO -->
<section class="section !pt-0">
  <div class="container-edu">
    <div class="section-head">
      <span class="home-eyebrow mx-auto">Watch</span>
      <h2 class="t-h2">Take a Tour of Our School</h2>
    </div>
    <div class="video-frame mx-auto" data-reveal>
      <iframe src="https://www.youtube.com/embed/Gk0DNK-Fd-A?si=PL7SnQj78i4_NELy" title="Channawar's e Vidya Mandir — school video" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
  </div>
</section>

<!-- MAP -->
<section class="section !pt-0">
  <div class="container-edu">
    <div class="ph-frame shadow-card" data-reveal>
      <iframe title="School location map" class="h-[420px] w-full" style="border:0" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="<?= e($map) ?>"></iframe>
    </div>
  </div>
</section>
