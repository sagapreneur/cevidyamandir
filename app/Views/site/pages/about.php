<?php
/**
 * ABOUT US — premium school storytelling page.
 * Consistent with the homepage design system. Images are CMS-ready via
 * Block::field('about', <key>, 'image') so they can be edited in the admin.
 */
use App\Core\View;
use App\Models\Block;

echo View::render('site/partials/banner', [
    'title' => $page['banner_title'] ?: $page['title'],
    'image' => $page['banner_image'] ?: '',
    'pageTitle' => $page['title'],
]);

$intro = Block::get('about', 'intro', [
    'eyebrow' => 'About the school', 'title' => "About Channawar's e Vidya Mandir",
    'body' => '',
]);
$mv = [
    'mission' => Block::get('about', 'mission', ['title' => 'Mission', 'body' => 'To provide an inclusive, joyful and rigorous education that empowers every student to become a confident, compassionate and capable citizen.']),
    'vision'  => Block::get('about', 'vision', ['title' => 'Vision', 'body' => 'To be a centre of learning excellence where tradition meets innovation and every child discovers their fullest potential.']),
    'values'  => Block::get('about', 'values', ['title' => 'Core Values', 'body' => 'Integrity, curiosity, respect, resilience and community — the values woven into everything we teach and do.']),
];
$pic = static fn($v, $f) => $v === '' || $v === null ? $f : (preg_match('#^https?://#', (string) $v) ? $v : upload_url($v));
?>

<!-- ============ SECTION 1 · ABOUT THE SCHOOL ============ -->
<section class="section">
  <div class="container-edu grid items-center gap-12 lg:grid-cols-2">
    <div class="relative" data-reveal="right">
      <div class="ph-frame shadow-card" style="aspect-ratio:4/3">
        <?= cms_image(Block::field('about', 'intro', 'image', ''), 'About School Image', '720×540', '', 'fa-school') ?>
      </div>
      <div class="absolute -bottom-6 -right-6 hidden rounded-lg bg-primary p-5 text-white shadow-lift sm:block">
        <div class="text-3xl font-bold">15+</div>
        <p class="text-white/80 text-sm">Years of trust</p>
      </div>
    </div>
    <div data-reveal="left">
      <span class="home-eyebrow"><?= e($intro['eyebrow']) ?></span>
      <h2 class="t-h2 mt-3 mb-4"><?= e($intro['title']) ?></h2>
      <?php if (!empty($intro['body'])): ?>
        <?= $intro['body'] // CMS HTML ?>
      <?php else: ?>
        <p class="t-body mb-4">Channawar's e Vidya Mandir is a <strong>CBSE-affiliated</strong> school in Wardha offering complete schooling from <strong>Nursery to Class X</strong>. Across our <strong>three branches</strong> in Wardha, Yelakeli and Seloo, we give academics the highest priority while nurturing character, creativity and confidence in every child.</p>
        <p class="t-body mb-4">Our modern infrastructure — smart classrooms, science and computer labs, a well-stocked library and safe transport — creates an environment where learning is joyful and meaningful. We believe in <strong>holistic education</strong> that balances academic excellence with sports, arts and life skills.</p>
        <p class="t-body">From co-curricular activities to values-based learning, every day at CeVM is designed to help students grow into responsible, globally aware citizens.</p>
      <?php endif; ?>
      <div class="mt-7 flex flex-wrap gap-4">
        <a href="admissions.html" class="btn-primary"><i class="fa-solid fa-paper-plane" aria-hidden="true"></i> Start Admission</a>
        <a href="programs.html" class="btn-outline">Explore Academics</a>
      </div>
    </div>
  </div>

  <div class="container-edu about-stats">
    <div class="grid grid-cols-2 gap-5 lg:grid-cols-4" data-reveal-stagger="90">
      <?php
      $stats = [
          ['fa-user-graduate', 4500, '+', 'Students'],
          ['fa-chalkboard-user', 120, '+', 'Teachers'],
          ['fa-award', 15, '+', 'Years of Excellence'],
          ['fa-location-dot', 3, '', 'Campuses'],
      ];
      foreach ($stats as $s): ?>
        <div class="stat-card" data-reveal>
          <span class="stat-card__icon"><i class="fa-solid <?= e($s[0]) ?>" aria-hidden="true"></i></span>
          <div class="stat-number" data-count="<?= (int) $s[1] ?>" data-suffix="<?= e($s[2]) ?>">0</div>
          <p class="stat-label"><?= e($s[3]) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ SECTION 2 · OUR JOURNEY ============ -->
<section class="section section-soft about-decor">
  <span class="about-deco about-deco--1"><i class="fa-solid fa-graduation-cap" aria-hidden="true"></i></span>
  <div class="container-edu">
    <div class="section-head">
      <span class="home-eyebrow mx-auto">Our Story</span>
      <h2 class="t-h2">Our Journey</h2>
      <p class="t-body">Milestones that shaped Channawar's e Vidya Mandir into the school it is today.</p>
    </div>
    <div class="journey" data-reveal-stagger="90">
      <?php
      $journey = [
          ['fa-flag', 'Foundation', 'A vision to build a school where every child is valued and inspired to learn.'],
          ['fa-certificate', 'CBSE Affiliation', 'Recognised affiliation bringing a structured, concept-driven curriculum.'],
          ['fa-building', 'Campus Expansion', 'Growing facilities and spaces to support holistic development.'],
          ['fa-chalkboard', 'Smart Classrooms', 'Interactive boards and modern teaching aids across classrooms.'],
          ['fa-laptop-code', 'Digital Learning', 'Technology-enabled, activity-based learning for every stage.'],
          ['fa-location-dot', 'Three Branches', 'Serving families across Wardha, Yelakeli and Seloo.'],
      ];
      foreach ($journey as $i => $j): ?>
        <div class="journey-step" data-reveal>
          <span class="journey-step__dot"><i class="fa-solid <?= e($j[0]) ?>" aria-hidden="true"></i></span>
          <div class="journey-step__card">
            <span class="journey-step__num">Step <?= $i + 1 ?></span>
            <h3 class="t-h4 mt-1 mb-1"><?= e($j[1]) ?></h3>
            <p class="t-small"><?= e($j[2]) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ SECTION 3 · MISSION · VISION · VALUES ============ -->
<section class="section">
  <div class="container-edu">
    <div class="section-head">
      <span class="home-eyebrow mx-auto">What Drives Us</span>
      <h2 class="t-h2">Mission, Vision &amp; Core Values</h2>
      <p class="t-body">The beliefs that guide everything we do at Channawar's e Vidya Mandir.</p>
    </div>
    <div class="grid gap-6 md:grid-cols-3" data-reveal-stagger="100">
      <?php
      $mvvCards = [
          ['fa-bullseye', $mv['mission']['title'], $mv['mission']['body']],
          ['fa-eye', $mv['vision']['title'], $mv['vision']['body']],
          ['fa-heart', $mv['values']['title'], $mv['values']['body']],
      ];
      foreach ($mvvCards as $card): ?>
        <article class="mvv-card" data-reveal>
          <span class="mvv-card__icon"><i class="fa-solid <?= e($card[0]) ?>" aria-hidden="true"></i></span>
          <h3 class="t-h4 mb-2"><?= e($card[1]) ?></h3>
          <p class="t-body"><?= e($card[2]) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ SECTION 4 · WHY PARENTS CHOOSE US ============ -->
<section class="section section-soft">
  <div class="container-edu">
    <div class="section-head">
      <span class="home-eyebrow mx-auto">Why Choose Us</span>
      <h2 class="t-h2">Why Parents Choose Channawar's e Vidya Mandir</h2>
    </div>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3" data-reveal-stagger="80">
      <?php
      $why = [
          ['fa-graduation-cap', 'CBSE Curriculum', 'A structured, concept-driven curriculum from Nursery to Class X.'],
          ['fa-chalkboard', 'Smart Classrooms', 'Interactive, technology-enabled classrooms that make learning engaging.'],
          ['fa-chalkboard-user', 'Experienced Faculty', 'Qualified, caring mentors focused on every child\'s growth.'],
          ['fa-shield-halved', 'Safe Campus', 'CCTV surveillance, health care and safe GPS-enabled transport.'],
          ['fa-futbol', 'Co-curricular Activities', 'Sports, arts, music and clubs for well-rounded development.'],
          ['fa-user-check', 'Individual Student Attention', 'Personal attention that helps every learner reach their potential.'],
      ];
      foreach ($why as $w): ?>
        <div class="feature-tile" data-reveal>
          <span class="fi"><i class="fa-solid <?= e($w[0]) ?>" aria-hidden="true"></i></span>
          <div><h3 class="t-h4 mb-1"><?= e($w[1]) ?></h3><p class="t-small"><?= e($w[2]) ?></p></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ SECTION 5 · LEARNING ENVIRONMENT ============ -->
<section class="section">
  <div class="container-edu grid items-center gap-12 lg:grid-cols-2">
    <div data-reveal="right">
      <span class="home-eyebrow">Learning Environment</span>
      <h2 class="t-h2 mt-3 mb-4">A Classroom Built Around the Child</h2>
      <p class="t-body mb-5">Our classrooms are lively, technology-enabled spaces where children learn by doing. We blend strong academics with creativity and collaboration so every concept truly sticks.</p>
      <ul class="feature-list">
        <li>Interactive learning with smart boards and digital content</li>
        <li>Activity-based education that makes concepts memorable</li>
        <li>Technology-enabled classrooms across all stages</li>
        <li>Child-centric teaching with individual attention</li>
      </ul>
    </div>
    <div class="ph-frame shadow-card" style="aspect-ratio:4/3" data-reveal="left">
      <?= cms_image(Block::field('about', 'learning', 'image', ''), 'Smart Classroom Image', '720×540', '', 'fa-chalkboard') ?>
    </div>
  </div>
</section>

<!-- ============ SECTION 7 · LEADERSHIP ============ -->
<section class="section">
  <div class="container-edu">
    <div class="section-head">
      <span class="home-eyebrow mx-auto">Leadership</span>
      <h2 class="t-h2">Guided By Experienced Leaders</h2>
    </div>
    <?php
    $leaders = !empty($board) ? $board : [];
    if (!$leaders) {
        $leaders = [
            ['name' => 'Prof. Mr. Dinesh Ji Channawar', 'role' => 'President', 'photo' => 'president.jpg'],
            ['name' => 'Ms. Apurva Pande', 'role' => 'Principal', 'photo' => 'principal.jpg'],
        ];
    }
    $leadDesc = [
        'president' => 'A guiding force behind our mission to nurture responsible, compassionate and globally aware citizens.',
        'principal' => 'Committed to a child-centric, harmonious education that develops the hand, head and heart.',
    ];
    ?>
    <div class="grid gap-8 md:grid-cols-2" data-reveal-stagger="100">
      <?php foreach ($leaders as $m):
          $isPres = stripos($m['role'], 'president') !== false;
          $link = $isPres ? 'president-desk.html' : (stripos($m['role'], 'principal') !== false ? 'principal-desk.html' : '#');
          $desc = $isPres ? $leadDesc['president'] : $leadDesc['principal'];
          $ph = $pic($m['photo'] ?? '', placeholder('portrait')); ?>
        <article class="leader-card" data-reveal>
          <div class="leader-card__photo"><img src="<?= e($ph) ?>" alt="<?= e($m['name']) ?>, <?= e($m['role']) ?>" loading="lazy" decoding="async" /></div>
          <div class="leader-card__body">
            <h3 class="t-h3 mb-1"><?= e($m['name']) ?></h3>
            <p class="leader-card__role"><?= e($m['role']) ?></p>
            <p class="t-small my-3"><?= e($desc) ?></p>
            <a href="<?= e($link) ?>" class="btn-outline btn-sm">Read Message <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ SECTION 8 · THREE CAMPUSES (reuses shared branch data) ============ -->
<?php include VIEW_PATH . '/site/partials/branches.php'; ?>

<!-- ============ SECTION 9 · EDUCATIONAL FACILITIES ============ -->
<section class="section">
  <div class="container-edu grid items-center gap-12 lg:grid-cols-2">
    <div class="ph-frame shadow-card" style="aspect-ratio:4/3" data-reveal="right">
      <?= cms_image(Block::field('about', 'facilities', 'image', ''), 'Campus Facilities Image', '720×540', '', 'fa-building') ?>
    </div>
    <div data-reveal="left">
      <span class="home-eyebrow">Our Campus</span>
      <h2 class="t-h2 mt-3 mb-6">Modern Educational Facilities</h2>
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <?php
        $facilities = [
            ['fa-chalkboard', 'Smart Classrooms', 'Interactive boards & digital content'],
            ['fa-flask', 'Science Labs', 'Hands-on experiments & discovery'],
            ['fa-computer', 'Computer Lab', 'Digital literacy from an early age'],
            ['fa-book', 'Library', 'A well-stocked reading collection'],
            ['fa-futbol', 'Sports Facilities', 'Playground, games & fitness'],
            ['fa-bus', 'Transport', 'Safe, GPS-enabled school buses'],
            ['fa-video', 'CCTV Surveillance', 'Round-the-clock campus safety'],
            ['fa-music', 'Music & Dance Room', 'Space for rhythm & expression'],
            ['fa-palette', 'Art & Craft Room', 'Creativity, colour & imagination'],
        ];
        foreach ($facilities as $f): ?>
          <div class="fac-item" data-reveal>
            <span class="fac-item__icon"><i class="fa-solid <?= e($f[0]) ?>" aria-hidden="true"></i></span>
            <div><p class="font-semibold text-ink leading-tight"><?= e($f[1]) ?></p><p class="t-small"><?= e($f[2]) ?></p></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ SECTION 10 · CTA ============ -->
<section class="section !pt-0">
  <div class="container-edu">
    <div class="about-cta" data-reveal>
      <div class="about-cta__bg ph-frame"><?= cms_image(Block::field('about', 'cta', 'image', ''), 'Students / Campus Banner', '1920×600', '', 'fa-users') ?></div>
      <span class="about-cta__overlay"></span>
      <div class="about-cta__content">
        <span class="hero-eyebrow mx-auto">Admissions Open</span>
        <h2 class="t-h2 !text-white mt-4 mb-3">Join the Channawar's e Vidya Mandir Family</h2>
        <p class="text-white/85 mb-8 mx-auto max-w-xl">Give your child a safe, joyful and value-driven CBSE education. Limited seats — apply early.</p>
        <div class="flex flex-wrap justify-center gap-4">
          <a href="admissions.html" class="btn-red btn-lg"><i class="fa-solid fa-paper-plane" aria-hidden="true"></i> Apply for Admission</a>
          <a href="contact.html" class="btn-outline btn-lg border-white text-white hover:bg-white hover:text-primary"><i class="fa-solid fa-envelope" aria-hidden="true"></i> Contact Us</a>
        </div>
      </div>
    </div>
  </div>
</section>
