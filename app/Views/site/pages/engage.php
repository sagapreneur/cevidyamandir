<?php
/** ENGAGE WITH US — premium engagement cards. */
use App\Core\View;

echo View::render('site/partials/banner', [
    'title' => $page['banner_title'] ?: $page['title'],
    'image' => $page['banner_image'] ?: '',
    'pageTitle' => $page['title'],
]);
?>
<section class="section">
  <div class="container-edu">
    <div class="section-head">
      <span class="home-eyebrow mx-auto">Get Involved</span>
      <h2 class="t-h2">Engage With Our School Community</h2>
      <p class="t-body">There are many ways to be part of the Channawar's e Vidya Mandir family.</p>
    </div>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3" data-reveal-stagger="90">
      <?php
      $cards = [
          ['fa-people-roof', 'Parent Community', 'Join our active PTA and partner with teachers to support your child\'s journey.', 'contact.html', 'Join In'],
          ['fa-user-group', 'Alumni Network', 'Reconnect with your alma mater, mentor students and stay part of our story.', 'contact.html', 'Reconnect'],
          ['fa-microphone-lines', 'Guest Talks', 'Share your expertise with our students through talks and workshops.', 'contact.html', 'Volunteer'],
          ['fa-handshake', 'Partnerships', 'Collaborate with us on educational, cultural and community initiatives.', 'contact.html', 'Partner With Us'],
          ['fa-hand-holding-heart', 'Support Us', 'Contribute to scholarships, facilities and programmes that help every child.', 'support-us.html', 'Support'],
          ['fa-briefcase', 'Careers', 'Build a rewarding career with a school that values its educators and staff.', 'careers.html', 'View Roles'],
      ];
      foreach ($cards as $c): ?>
        <article class="engage-card" data-reveal>
          <span class="engage-card__icon"><i class="fa-solid <?= e($c[0]) ?>" aria-hidden="true"></i></span>
          <h3 class="t-h4 mb-2"><?= e($c[1]) ?></h3>
          <p class="t-small mb-5"><?= e($c[2]) ?></p>
          <a href="<?= e($c[3]) ?>" class="btn-link mt-auto"><?= e($c[4]) ?> <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
