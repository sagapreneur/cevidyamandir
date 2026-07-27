<?php
/**
 * Branch Locations — 3-column pre-footer section (CMS-ready).
 * Single source of truth for branch data across the site.
 * Yelakeli / Main Branch is always first.
 */
$branches = [
    [
        'tag'    => 'Main Branch',
        'name'   => "Channawar's e Vidya Mandir",
        'address'=> 'Arvi Road, near Vyanktesh Polytechnic, Wardha, Maharashtra 442001',
        'classes'=> 'Nursery to Std. X',
        'phone'  => '+91 8551061975',
        'tel'    => '+918551061975',
        'email'  => 'cevidyamandir@gmail.com',
        'map'    => 'https://www.google.com/maps?q=' . rawurlencode('Arvi Road, near Vyanktesh Polytechnic, Wardha, Maharashtra 442001') . '&output=embed',
        'dir'    => 'https://maps.app.goo.gl/ceoxEVxVBoEvhWZq7',
    ],
    [
        'tag'    => 'Wardha Branch',
        'name'   => "Channawar's e Vidya Mandir",
        'address'=> 'Varco World, Sewagram Road, Wardha, Maharashtra 442001',
        'classes'=> 'Nursery · Junior KG · Senior KG',
        'phone'  => '+91 8551061975',
        'tel'    => '+918551061975',
        'email'  => 'cevidyamandir@gmail.com',
        'map'    => 'https://www.google.com/maps?q=' . rawurlencode('Varco World, Sewagram Road, Wardha, Maharashtra 442001') . '&output=embed',
        'dir'    => 'https://maps.app.goo.gl/evvZVaZ779GsAPBp7',
    ],
    [
        'tag'    => 'Seloo Branch',
        'name'   => "Channawar's e Vidya Mandir",
        'address'=> 'Near Raskunj, Infront of Seloo Bus Stand, Baid Mohta Complex, Seloo, Wardha',
        'classes'=> 'Nursery · Junior KG · Senior KG',
        'phone'  => '+91 8530739610',
        'tel'    => '+918530739610',
        'email'  => 'cevidyamandir@gmail.com',
        'map'    => 'https://www.google.com/maps?q=' . rawurlencode('Baid Mohta Complex, Seloo, Wardha, Maharashtra') . '&output=embed',
        'dir'    => 'https://maps.app.goo.gl/yPDkwPivDAEe1oi87',
    ],
];
?>
<section class="section section-soft" id="branches" aria-labelledby="branches-title">
  <div class="container-edu">
    <div class="section-head">
      <span class="home-eyebrow mx-auto">Visit Us</span>
      <h2 class="t-h2" id="branches-title">Our Branch Locations</h2>
      <p class="t-body">Three campuses across Wardha, with the Main Branch offering complete schooling from Nursery to Class&nbsp;X.</p>
    </div>

    <div class="branch-grid" data-reveal-stagger="90">
      <?php foreach ($branches as $b): ?>
        <article class="branch-card" data-reveal>
          <div class="branch-card__map">
            <iframe title="Map — <?= e($b['tag']) ?>" src="<?= e($b['map']) ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
          </div>
          <div class="branch-card__body">
            <span class="branch-card__tag"><i class="fa-solid fa-location-dot" aria-hidden="true"></i> <?= e($b['tag']) ?></span>
            <h3 class="t-h4 mt-2 mb-3"><?= e($b['name']) ?></h3>
            <ul class="branch-meta">
              <li><i class="fa-solid fa-map-location-dot" aria-hidden="true"></i><span><?= e($b['address']) ?></span></li>
              <li><i class="fa-solid fa-graduation-cap" aria-hidden="true"></i><span><?= e($b['classes']) ?></span></li>
              <li><i class="fa-solid fa-phone" aria-hidden="true"></i><a href="tel:<?= e($b['tel']) ?>"><?= e($b['phone']) ?></a></li>
              <li><i class="fa-solid fa-envelope" aria-hidden="true"></i><a href="mailto:<?= e($b['email']) ?>"><?= e($b['email']) ?></a></li>
            </ul>
            <div class="branch-card__actions">
              <a href="tel:<?= e($b['tel']) ?>" class="btn-primary btn-sm"><i class="fa-solid fa-phone" aria-hidden="true"></i> Call Now</a>
              <a href="<?= e($b['dir']) ?>" class="btn-outline btn-sm" target="_blank" rel="noopener noreferrer"><i class="fa-solid fa-diamond-turn-right" aria-hidden="true"></i> Get Directions</a>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
