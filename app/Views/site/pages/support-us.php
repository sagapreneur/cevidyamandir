<?php
/** SUPPORT US — generic premium support page (no donation amounts). */
use App\Core\View;
use App\Models\Setting;

echo View::render('site/partials/banner', [
    'title' => $page['banner_title'] ?: $page['title'],
    'image' => $page['banner_image'] ?: '',
    'pageTitle' => $page['title'],
]);
$email = Setting::get('contact_email', 'cevidyamandir@gmail.com');
?>
<section class="section">
  <div class="container-edu">
    <div class="section-head">
      <span class="home-eyebrow mx-auto">Support Us</span>
      <h2 class="t-h2">Help Us Shape Brighter Futures</h2>
      <p class="t-body">Your support helps us give every child access to quality education, modern facilities and enriching experiences.</p>
    </div>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3" data-reveal-stagger="90">
      <?php
      $areas = [
          ['fa-school', 'School Development', 'Strengthen the foundations that help our school grow and serve more families.'],
          ['fa-graduation-cap', 'Scholarship Support', 'Enable deserving students to continue their education without barriers.'],
          ['fa-book-open', 'Library Development', 'Expand our collection of books and quiet spaces for reading and study.'],
          ['fa-futbol', 'Sports Development', 'Support playgrounds, equipment and coaching for healthy, active students.'],
          ['fa-laptop', 'Technology Development', 'Bring smart classrooms and digital tools to more learners.'],
          ['fa-building', 'Infrastructure Support', 'Help build safe, modern and inspiring learning environments.'],
      ];
      foreach ($areas as $a): ?>
        <article class="engage-card" data-reveal>
          <span class="engage-card__icon"><i class="fa-solid <?= e($a[0]) ?>" aria-hidden="true"></i></span>
          <h3 class="t-h4 mb-2"><?= e($a[1]) ?></h3>
          <p class="t-small"><?= e($a[2]) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section !pt-0">
  <div class="container-edu">
    <div class="relative overflow-hidden rounded-xl bg-grad-ink px-6 py-14 text-center text-white lg:px-16" data-reveal>
      <div class="relative z-10 mx-auto max-w-2xl">
        <span class="hero-eyebrow mx-auto">Partner With Us</span>
        <h2 class="t-h2 !text-white mt-4 mb-3">Contact Us to Support Our Initiatives</h2>
        <p class="text-white/85 mb-8">We would be glad to discuss how you can contribute to our students and school. Reach out to our team to learn more.</p>
        <div class="flex flex-wrap justify-center gap-4">
          <a href="contact.html" class="btn-red btn-lg"><i class="fa-solid fa-phone" aria-hidden="true"></i> Contact Us</a>
          <a href="mailto:<?= e($email) ?>" class="btn-outline btn-lg border-white text-white hover:bg-white hover:text-primary"><i class="fa-solid fa-envelope" aria-hidden="true"></i> Email Us</a>
        </div>
      </div>
    </div>
  </div>
</section>
