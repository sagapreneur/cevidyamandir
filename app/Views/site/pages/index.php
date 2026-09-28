<?php
/**
 * HOMEPAGE — Channawar's e Vidya Mandir (CBSE, Nursery–Class X)
 * Every section is CMS-ready: text via Block::get(), lists from DB tables,
 * and images via cms_image() which shows a labeled placeholder until an
 * image is uploaded — so images can be swapped later without layout changes.
 */
use App\Models\Block;

$slides = $slides ?? [];
$statistics = $statistics ?? [];
$programs = $programs ?? [];
$testimonials = $testimonials ?? [];
$notices = $notices ?? [];
$gallery = $gallery ?? [];

// Default 3 hero slides (used until the CMS "Hero Slider" has entries)
if (!$slides) {
    $slides = [
        ['eyebrow' => "Welcome to Channawar's e Vidya Mandir", 'title' => 'A Brighter Future Starts Here', 'subtitle' => 'A safe, joyful and value-driven CBSE school in Wardha nurturing every child to learn, grow and lead.', 'primary_label' => 'Apply for Admission', 'primary_url' => 'admissions.html', 'secondary_label' => 'Watch Campus Tour', 'secondary_url' => 'https://www.youtube.com/watch?v=Gk0DNK-Fd-A', 'image' => 'campus.jpg', '_ph' => 'Hero Image 01 · 1920×900'],
        ['eyebrow' => 'Smart Classrooms · Experiential Learning', 'title' => 'Where Curiosity Meets Academic Excellence', 'subtitle' => 'Smart classrooms, well-equipped labs and dedicated teachers who make learning meaningful and fun.', 'primary_label' => 'Why Choose Us', 'primary_url' => '#why', 'secondary_label' => 'View Facilities', 'secondary_url' => '#facilities', 'image' => 'classroom.jpg', '_ph' => 'Hero Image 02 · 1920×900'],
        ['eyebrow' => 'Sports · Activities · Personality Development', 'title' => 'Learning That Goes Beyond the Classroom', 'subtitle' => 'From sports and science to music and social awareness — we shape confident, well-rounded children through co-curricular excellence.', 'primary_label' => 'Our Achievements', 'primary_url' => '#achievements', 'secondary_label' => 'Visit Gallery', 'secondary_url' => 'gallery.html', 'image' => 'development.jpg', '_ph' => 'Hero Image 03 · 1920×900'],
    ];
}
$pic = static fn($v, $f) => ($v !== '' && $v !== null) ? (preg_match('#^https?://#', (string) $v) ? $v : upload_url($v)) : $f;
?>

<!-- ============================ HERO SLIDER ============================ -->
<section class="hero-slider" data-hero-slider data-autoplay="6500" aria-label="Featured highlights">
  <?php foreach ($slides as $i => $s): ?>
    <div class="hero-slide<?= $i === 0 ? ' is-active' : '' ?>">
      <div class="hero-slide__bg">
        <?php if (!empty($s['image'])): ?>
          <img src="<?= e($pic($s['image'], '')) ?>" alt="" <?= $i === 0 ? 'fetchpriority="high"' : 'loading="lazy"' ?> />
        <?php else: ?>
          <?= placeholder_box($s['_ph'] ?? 'Hero Image · 1920×900', '', '🏫') ?>
        <?php endif; ?>
      </div>
      <span class="hero-slide__overlay"></span>
      <div class="container-edu">
        <div class="hero-slide__content">
          <?php if (!empty($s['eyebrow'])): ?><span class="hero-eyebrow"><?= e($s['eyebrow']) ?></span><?php endif; ?>
          <h1 class="hero-slide__title"><?= e($s['title']) ?></h1>
          <p class="hero-slide__sub"><?= e($s['subtitle']) ?></p>
          <div class="mt-2 flex flex-wrap gap-4">
            <?php if (!empty($s['primary_label'])): ?><a href="<?= e($s['primary_url'] ?: 'admissions.html') ?>" class="btn-red btn-lg"><?= e($s['primary_label']) ?></a><?php endif; ?>
            <?php if (!empty($s['secondary_label'])): $extSec = (bool) preg_match('#^https?://#', (string) ($s['secondary_url'] ?? '')); ?><a href="<?= e($s['secondary_url'] ?: '#') ?>" class="btn-outline btn-lg border-white text-white hover:bg-white hover:text-primary"<?= $extSec ? ' target="_blank" rel="noopener"' : '' ?>><?= e($s['secondary_label']) ?></a><?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <button class="hero-arrow prev" type="button" aria-label="Previous slide">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 6l-6 6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
  </button>
  <button class="hero-arrow next" type="button" aria-label="Next slide">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
  </button>
  <div class="hero-dots" role="tablist" aria-label="Slide navigation"></div>
</section>

<!-- ============================ TRUST STRIP ============================ -->
<section class="border-b border-border bg-white">
  <div class="container-edu grid grid-cols-2 gap-6 py-8 md:grid-cols-4" data-reveal-stagger="80">
    <div class="flex items-center gap-3" data-reveal><span class="grid h-11 w-11 place-items-center rounded-md bg-primary/10 text-primary text-lg"><i class="fa-solid fa-graduation-cap" aria-hidden="true"></i></span><div><p class="font-bold text-ink leading-tight">CBSE Affiliated</p><p class="t-small">No. 1130539</p></div></div>
    <div class="flex items-center gap-3" data-reveal><span class="grid h-11 w-11 place-items-center rounded-md bg-primary/10 text-primary text-lg"><i class="fa-solid fa-book-open" aria-hidden="true"></i></span><div><p class="font-bold text-ink leading-tight">Nursery to Class X</p><p class="t-small">Complete schooling</p></div></div>
    <div class="flex items-center gap-3" data-reveal><span class="grid h-11 w-11 place-items-center rounded-md bg-primary/10 text-primary text-lg"><i class="fa-solid fa-location-dot" aria-hidden="true"></i></span><div><p class="font-bold text-ink leading-tight">Three Branches</p><p class="t-small">Wardha · Yelakeli · Seloo</p></div></div>
    <div class="flex items-center gap-3" data-reveal><span class="grid h-11 w-11 place-items-center rounded-md bg-primary/10 text-primary text-lg"><i class="fa-solid fa-bus" aria-hidden="true"></i></span><div><p class="font-bold text-ink leading-tight">Bus Transport</p><p class="t-small">Safe &amp; on-time</p></div></div>
  </div>
</section>

<!-- ============================ ABOUT SCHOOL ============================ -->
<section class="section">
  <div class="container-edu grid items-center gap-12 lg:grid-cols-2">
    <div class="relative" data-reveal="right">
      <div class="ph-frame shadow-card" style="aspect-ratio:4/3">
        <?= cms_image(Block::field('index', 'about', 'image', ''), 'About Image', '720×540') ?>
      </div>
      <div class="absolute -bottom-6 -right-6 hidden rounded-lg bg-primary p-5 text-white shadow-lift sm:block">
        <div class="text-3xl font-bold">15+</div>
        <p class="text-white/80 text-sm">Years of trust</p>
      </div>
    </div>
    <div data-reveal="left">
      <span class="home-eyebrow">About Our School</span>
      <h2 class="t-h2 mt-3 mb-4"><?= e(Block::field('index', 'about', 'title', 'A CBSE School Dedicated to Excellence')) ?></h2>
      <p class="t-body mb-4"><?= e(Block::field('index', 'about', 'body', "From our pre-primary branches to Class X, Channawar's e Vidya Mandir gives academics the highest priority while shaping character, creativity and confidence in every child across Wardha, Yelakeli and Seloo.")) ?></p>
      <ul class="feature-list mb-6">
        <li>CBSE curriculum with concept clarity &amp; experiential learning</li>
        <li>Cyclic tests, MCQs &amp; remedial classes for steady progress</li>
        <li>Career guidance &amp; counselling for senior classes</li>
        <li>Eco-clubs, assembly &amp; social-awareness activities</li>
      </ul>
      <div class="flex flex-wrap gap-4">
        <a href="about.html" class="btn-primary">About the School</a>
        <a href="admissions.html" class="btn-outline">Admission Process</a>
      </div>
    </div>
  </div>
</section>

<!-- ============================ ACADEMIC JOURNEY ============================ -->
<section class="section section-soft" id="academics">
  <div class="container-edu">
    <div class="section-head">
      <span class="home-eyebrow mx-auto">Academic Journey</span>
      <h2 class="t-h2">A Continuous Path from Nursery to Class X</h2>
      <p class="t-body">A carefully structured CBSE journey that grows with your child at every stage.</p>
    </div>
    <?php
    $stages = $programs ? array_slice($programs, 0, 4) : [
        ['title' => 'Pre-Primary', 'badge' => 'Nursery – Sr. KG', 'excerpt' => 'Play-based early learning that builds curiosity, language and confidence.', 'link_url' => 'programs.html', 'image' => ''],
        ['title' => 'Primary School', 'badge' => 'Class I – V', 'excerpt' => 'Strong literacy, numeracy and concept clarity through activity-led classrooms.', 'link_url' => 'programs.html', 'image' => ''],
        ['title' => 'Middle School', 'badge' => 'Class VI – VIII', 'excerpt' => 'Inquiry-driven learning across science, maths, languages and computers.', 'link_url' => 'programs.html', 'image' => ''],
        ['title' => 'Secondary', 'badge' => 'Class IX – X', 'excerpt' => 'Focused CBSE board preparation with mentoring and career guidance.', 'link_url' => 'programs.html', 'image' => ''],
    ];
    $phLabels = ['Pre-Primary Image', 'Primary Image', 'Middle School Image', 'Secondary Image'];
    ?>
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4" data-reveal-stagger="90">
      <?php foreach ($stages as $i => $st): ?>
        <article class="journey-card" data-reveal>
          <div class="ph-frame"><?= cms_image($st['image'] ?? '', $phLabels[$i] ?? 'Stage Image', '440×330') ?></div>
          <span class="journey-card__tag"><?= e($st['badge'] ?? '') ?></span>
          <div class="journey-card__body">
            <h3 class="t-h4 mb-2"><?= e($st['title']) ?></h3>
            <p class="t-small mb-4"><?= e($st['excerpt'] ?? '') ?></p>
            <a href="<?= e($st['link_url'] ?? 'programs.html') ?>" class="btn-link">Learn more →</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================ WHY PARENTS CHOOSE US ============================ -->
<section class="section" id="why">
  <div class="container-edu">
    <div class="section-head">
      <span class="home-eyebrow mx-auto">Why Choose Us</span>
      <h2 class="t-h2">Why Parents Choose Channawar's e Vidya Mandir</h2>
      <p class="t-body">A nurturing environment where academics, values and care come together.</p>
    </div>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3" data-reveal-stagger="80">
      <?php
      $why = [
          ['<i class="fa-solid fa-shield-heart" aria-hidden="true"></i>', 'Safe & Caring Environment', 'A secure, child-friendly campus with CCTV, health care and fire safety.'],
          ['<i class="fa-solid fa-chalkboard-user" aria-hidden="true"></i>', 'Experienced Teachers', 'Qualified, caring mentors who focus on every child’s overall development.'],
          ['<i class="fa-solid fa-puzzle-piece" aria-hidden="true"></i>', 'Play-Way Learning', 'Activity-based, joyful learning that makes concepts stick.'],
          ['<i class="fa-solid fa-desktop" aria-hidden="true"></i>', 'Smart Classrooms', 'Modern teaching aids, science, maths and computer labs.'],
          ['<i class="fa-solid fa-comments" aria-hidden="true"></i>', 'Confidence Building', 'Special focus on language, creativity and communication.'],
          ['<i class="fa-solid fa-seedling" aria-hidden="true"></i>', 'Values & Life Skills', 'Eco-clubs, social awareness and life-skills for future success.'],
      ];
      foreach ($why as $w): ?>
        <div class="feature-tile" data-reveal>
          <span class="fi"><?= $w[0] ?></span>
          <div><h3 class="t-h4 mb-1"><?= e($w[1]) ?></h3><p class="t-small"><?= e($w[2]) ?></p></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================ STATISTICS ============================ -->
<?php if ($statistics): ?>
<section class="section section-ink relative overflow-hidden">
  <div class="container-edu relative z-10">
    <div class="stats-grid" data-reveal-stagger="100">
      <?php foreach ($statistics as $s): ?>
        <div class="stat" data-reveal>
          <?php if (!empty($s['icon'])): ?><div class="stat-icon"><i class="fa-solid <?= e($s['icon']) ?>" aria-hidden="true"></i></div><?php endif; ?>
          <div class="stat-number" data-count="<?= (int) $s['value'] ?>" data-suffix="<?= e($s['suffix']) ?>">0</div>
          <p class="stat-label"><?= e($s['label']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============================ CAMPUS FACILITIES ============================ -->
<section class="section" id="facilities">
  <div class="container-edu">
    <div class="section-head">
      <span class="home-eyebrow mx-auto">Our Campus</span>
      <h2 class="t-h2">Modern Facilities for Holistic Growth</h2>
    </div>
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4" data-reveal-stagger="70">
      <?php
      $facilities = [
          ['<i class="fa-solid fa-school" aria-hidden="true"></i>', 'Smart Classrooms'], ['<i class="fa-solid fa-flask" aria-hidden="true"></i>', 'Science Labs'], ['<i class="fa-solid fa-computer" aria-hidden="true"></i>', 'Computer Lab'], ['<i class="fa-solid fa-book" aria-hidden="true"></i>', 'Library'],
          ['<i class="fa-solid fa-futbol" aria-hidden="true"></i>', 'Play Ground'], ['<i class="fa-solid fa-bus" aria-hidden="true"></i>', 'Transport'], ['<i class="fa-solid fa-droplet" aria-hidden="true"></i>', 'RO Water'], ['<i class="fa-solid fa-briefcase-medical" aria-hidden="true"></i>', 'Health Care'],
      ];
      foreach ($facilities as $f): ?>
        <div class="rounded-lg bg-white p-6 text-center shadow-sm ring-1 ring-border transition-all duration-300 hover:-translate-y-1 hover:shadow-card" data-reveal>
          <span class="mx-auto mb-3 grid h-14 w-14 place-items-center rounded-full bg-primary/8 text-primary text-2xl"><?= $f[0] ?></span>
          <p class="font-semibold text-ink"><?= e($f[1]) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================ AWARDS & RECOGNITION ============================ -->
<section class="section section-soft" id="awards">
  <div class="container-edu">
    <div class="section-head">
      <span class="home-eyebrow mx-auto">Recognition</span>
      <h2 class="t-h2">Awards &amp; Recognition</h2>
      <p class="t-body">Proud milestones that reflect our commitment to quality education.</p>
    </div>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3" data-reveal-stagger="90">
      <?php
      $awards = [
          ['2025', 'India K-12 Awards, Bengaluru', 'Recognised for providing affordable and quality education.'],
          ['2025', 'Swami Vivekanand National Award', 'Honoured for excellence in education.'],
          ['2024', 'MIMAMSA School Award, Nagpur', 'Most Culturally Progressive School.'],
      ];
      foreach ($awards as $a): ?>
        <article class="award-card" data-reveal>
          <span class="award-card__badge"><i class="fa-solid fa-trophy" aria-hidden="true"></i></span>
          <p class="text-sm font-semibold text-accent-600 mb-1"><?= e($a[0]) ?></p>
          <h3 class="t-h4 mb-2"><?= e($a[1]) ?></h3>
          <p class="t-small"><?= e($a[2]) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================ STUDENT ACHIEVEMENTS ============================ -->
<section class="section" id="achievements">
  <div class="container-edu">
    <div class="section-head">
      <span class="home-eyebrow mx-auto">Our Shining Stars</span>
      <h2 class="t-h2">Student Achievements</h2>
      <p class="t-body">Celebrating our students who make the school proud.</p>
    </div>
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4" data-reveal-stagger="80">
      <?php
      $achievers = [
          ['Std X Toppers 2025-26', '100% Result · Shining Stars', 'achievements/std-x-toppers-2025-26.png'],
          ['Pride of Our School', 'Selected to IIT & BITS', 'achievements/pride-of-our-school.png'],
          ['National Abacus Olympiad', '5th Rank · Level 1A', 'achievements/national-abacus-olympiad.png'],
          ['District Swimming', '1st Place · Freestyle', 'achievements/district-swimming.png'],
      ];
      foreach ($achievers as $ac): ?>
        <article class="achieve-card" data-reveal>
          <div class="ph-frame"><?= cms_image($ac[2] ?? '', $ac[0] . ' — Achievement Poster', '400×520') ?></div>
          <div class="achieve-card__meta">
            <span class="text-accent-600 text-lg">★</span>
            <div><p class="font-semibold text-ink leading-tight text-[15px]"><?= e($ac[0]) ?></p><p class="t-small"><?= e($ac[1]) ?></p></div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================ GALLERY PREVIEW ============================ -->
<section class="section section-soft">
  <div class="container-edu">
    <div class="section-head">
      <span class="home-eyebrow mx-auto">Campus Life</span>
      <h2 class="t-h2">Moments From Our Campus</h2>
    </div>
    <div class="grid grid-cols-2 gap-4 md:grid-cols-3" data-reveal-stagger="70">
      <?php
      $galleryItems = $gallery ?: array_fill(0, 6, ['image' => '', 'title' => 'Gallery Image']);
      $galleryItems = array_slice($galleryItems, 0, 6);
      foreach ($galleryItems as $i => $g):
          $wide = ($i === 0) ? ' md:col-span-2 md:row-span-2' : ''; ?>
        <figure class="ph-frame group<?= $wide ?>" style="aspect-ratio:<?= $i === 0 ? '4/3' : '4/3' ?>" data-reveal>
          <?= cms_image($g['image'] ?? '', $g['title'] ?? 'Gallery Image', '600×450') ?>
          <span class="absolute inset-0 grid place-items-center bg-ink/50 opacity-0 transition-opacity duration-300 group-hover:opacity-100"><span class="grid h-11 w-11 place-items-center rounded-full bg-white text-primary"><i class="fa-solid fa-expand" aria-hidden="true"></i></span></span>
        </figure>
      <?php endforeach; ?>
    </div>
    <div class="mt-10 text-center"><a href="gallery.html" class="btn-outline">View Full Gallery</a></div>
  </div>
</section>

<!-- ============================ PARENT TESTIMONIALS ============================ -->
<?php if ($testimonials): ?>
<section class="section">
  <div class="container-edu">
    <div class="section-head">
      <span class="home-eyebrow mx-auto">Parent Voices</span>
      <h2 class="t-h2">What Parents Say About Us</h2>
    </div>
    <div class="slider mx-auto max-w-3xl" data-slider data-autoplay="6000">
      <div class="slider-track">
        <?php foreach ($testimonials as $t):
            $stars = str_repeat('★', (int) $t['rating']);
            $av = !empty($t['avatar']) ? $pic($t['avatar'], '') : ''; ?>
          <div class="slider-slide px-2">
            <div class="testimonial">
              <div class="rating"><?= $stars ?></div>
              <p class="testimonial-quote"><?= e($t['quote']) ?></p>
              <div class="testimonial-author">
                <?php if ($av): ?>
                  <img class="testimonial-avatar" src="<?= e($av) ?>" alt="" loading="lazy" />
                <?php else: ?>
                  <span class="testimonial-avatar grid place-items-center bg-primary/10 text-primary font-bold"><?= e(strtoupper(substr($t['name'], 0, 1))) ?></span>
                <?php endif; ?>
                <div><p class="testimonial-name"><?= e($t['name']) ?></p><p class="testimonial-role"><?= e($t['role']) ?></p></div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="slider-dots"></div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============================ ADMISSION CTA ============================ -->
<section class="section">
  <div class="container-edu">
    <div class="relative overflow-hidden rounded-xl bg-grad-ink px-6 py-14 text-center text-white lg:px-16">
      <div class="relative z-10 mx-auto max-w-2xl">
        <span class="hero-eyebrow mx-auto">Admissions Open · Session 2026-27</span>
        <h2 class="t-h2 !text-white mt-4 mb-3">Give Your Child the Gift of a Great Beginning</h2>
        <p class="text-white/85 mb-8">Admissions are open for Nursery to Class IX. Limited seats — apply early to secure your child’s place.</p>
        <div class="flex flex-wrap justify-center gap-4">
          <a href="admissions.html" class="btn-red btn-lg">Apply Now</a>
          <a href="contact.html" class="btn-outline btn-lg border-white text-white hover:bg-white hover:text-primary">Contact Us</a>
          <a href="downloads.html" class="btn-outline btn-lg border-white/50 text-white hover:bg-white hover:text-primary">Download Brochure</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================ LATEST NEWS ============================ -->
<?php if ($notices): ?>
<section class="section section-soft">
  <div class="container-edu">
    <div class="section-head">
      <span class="home-eyebrow mx-auto">Latest Updates</span>
      <h2 class="t-h2">News &amp; Announcements</h2>
    </div>
    <div class="grid gap-6 md:grid-cols-3" data-reveal-stagger="100">
      <?php foreach (array_slice($notices, 0, 3) as $n):
          $d = $n['publish_date'] ? date('d', strtotime($n['publish_date'])) : '--';
          $mo = $n['publish_date'] ? date('M', strtotime($n['publish_date'])) : ''; ?>
        <article class="overflow-hidden rounded-lg bg-white shadow-card ring-1 ring-border transition-all duration-instant hover:-translate-y-1.5 hover:shadow-card-hover" data-reveal>
          <div class="ph-frame" style="aspect-ratio:16/10">
            <?php if (!empty($n['image'])): ?>
              <img src="<?= e(media_url($n['image'])) ?>" alt="<?= e($n['title']) ?>" loading="lazy" decoding="async" style="width:100%;height:100%;object-fit:cover;" />
            <?php else: ?>
              <span class="ph-box" style="display:grid;place-items:center;background:rgba(28,63,148,.06);color:var(--color-primary);font-size:2.75rem"><i class="fa-regular fa-newspaper" aria-hidden="true"></i></span>
            <?php endif; ?>
            <span class="absolute left-4 bottom-4 z-10 rounded-sm bg-secondary px-3 py-1.5 text-center leading-none text-white"><strong class="block text-lg"><?= e($d) ?></strong><span class="text-xs"><?= e($mo) ?></span></span>
          </div>
          <div class="p-6">
            <div class="mb-2 text-sm font-semibold text-secondary"><?= e($n['category'] ?: 'Notice') ?></div>
            <h3 class="t-h4 mb-2"><?= e($n['title']) ?></h3>
            <p class="t-small mb-4"><?= e(str_excerpt((string) $n['excerpt'], 16)) ?></p>
            <a href="notices.html" class="btn-link">Read more →</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============================ AFFILIATIONS & PARTNERS ============================ -->
<section class="section trust-section">
  <div class="container-edu">
    <div class="section-head">
      <span class="home-eyebrow mx-auto">Affiliations</span>
      <h2 class="t-h2">Affiliations &amp; Recognitions</h2>
    </div>
    <?php
    // CMS-ready: each item supports title, subtitle, svg icon, url (optional), featured, sort order, publish state.
    $affiliations = [
        ['svg' => 'cbse-affiliation.svg',  'title' => 'CBSE Affiliation',            'desc' => 'Affiliated Curriculum',     'url' => ''],
        ['svg' => 'affiliation-number.svg','title' => 'Affiliation No. 1130539',      'desc' => 'Officially Recognised',     'url' => ''],
        ['svg' => 'india-k12-award.svg',   'title' => 'India K–12 Awards',            'desc' => 'National Recognition',      'url' => ''],
        ['svg' => 'swami-vivekanand.svg',  'title' => 'Swami Vivekanand Recognition', 'desc' => 'Values & Wisdom',           'url' => ''],
        ['svg' => 'mimamsa.svg',           'title' => 'MIMAMSA',                      'desc' => 'Academic Excellence',       'url' => ''],
        ['svg' => 'abacus-olympiad.svg',   'title' => 'Abacus Olympiad',             'desc' => 'Mathematical Excellence',   'url' => ''],
    ];
    ?>
    <div class="trust-grid" data-reveal-stagger="80">
      <?php foreach ($affiliations as $a): $hasUrl = !empty($a['url']); ?>
        <<?= $hasUrl ? 'a' : 'div' ?> class="trust-card" data-reveal<?= $hasUrl ? ' href="' . e($a['url']) . '" target="_blank" rel="noopener"' : '' ?>>
          <span class="trust-card__icon"><img src="<?= e(asset('images/recognitions/' . $a['svg'])) ?>" alt="<?= e($a['title']) ?> icon" width="72" height="72" loading="lazy" decoding="async" /></span>
          <h3 class="trust-card__title"><?= e($a['title']) ?></h3>
          <?php if (!empty($a['desc'])): ?><p class="trust-card__desc"><?= e($a['desc']) ?></p><?php endif; ?>
        </<?= $hasUrl ? 'a' : 'div' ?>>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================ BRANCH LOCATIONS ============================ -->
<?php include VIEW_PATH . '/site/partials/branches.php'; ?>
