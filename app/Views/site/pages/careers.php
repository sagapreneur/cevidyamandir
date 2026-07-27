<?php
/** CAREERS — CMS-driven. Positions load from the job_openings table (admin-managed). */
use App\Core\View;

echo View::render('site/partials/banner', [
    'title' => $page['banner_title'] ?: $page['title'],
    'image' => $page['banner_image'] ?: '',
    'pageTitle' => $page['title'],
]);
$positions = $positions ?? [];
?>
<section class="section">
  <div class="container-edu grid items-start gap-12 lg:grid-cols-2">
    <div data-reveal="right">
      <span class="home-eyebrow">Work With Us</span>
      <h2 class="t-h2 mt-3 mb-4">Build Your Career at Channawar's e Vidya Mandir</h2>
      <p class="t-body mb-6">We are always looking for passionate, dedicated people who want to make a difference in children's lives. Join a supportive team that values growth, care and excellence.</p>
      <ul class="feature-list">
        <li>A collaborative, values-driven work culture</li>
        <li>Ongoing training and professional development</li>
        <li>Modern, well-equipped campus facilities</li>
        <li>Opportunities to grow with a respected institution</li>
      </ul>
    </div>

    <div class="card card-body !p-8" data-reveal="left">
      <h3 class="t-h3 mb-6">Apply Now</h3>
      <form class="flex flex-col gap-5" data-form-type="career" novalidate>
        <div class="grid gap-5 sm:grid-cols-2">
          <div class="form-group"><label class="form-label" for="j-name">Your Name <span class="req">*</span></label><input class="input" id="j-name" name="name" required placeholder="Full name" /></div>
          <div class="form-group"><label class="form-label" for="j-phone">Phone <span class="req">*</span></label><input class="input" id="j-phone" name="phone" type="tel" required placeholder="+91" /></div>
        </div>
        <div class="form-group"><label class="form-label" for="j-email">Email <span class="req">*</span></label><input class="input" id="j-email" name="email" type="email" required placeholder="you@example.com" /></div>
        <div class="form-group">
          <label class="form-label" for="j-position">Position</label>
          <?php if ($positions): ?>
            <select class="select" id="j-position" name="position">
              <?php foreach ($positions as $p): ?>
                <option value="<?= e($p['title']) ?>"><?= e($p['title']) ?><?= !empty($p['department']) ? ' — ' . e($p['department']) : '' ?></option>
              <?php endforeach; ?>
            </select>
          <?php else: ?>
            <select class="select" id="j-position" name="position" disabled>
              <option>No positions currently available</option>
            </select>
            <p class="t-small mt-2">There are no open positions right now. You may still share your details and we'll keep them on file.</p>
          <?php endif; ?>
        </div>
        <div class="form-group"><label class="form-label" for="j-msg">Message</label><textarea class="textarea" id="j-msg" name="message" placeholder="Tell us about yourself and attach a link to your résumé"></textarea></div>
        <button class="btn-primary btn-block" type="submit"><i class="fa-solid fa-paper-plane" aria-hidden="true"></i> Submit Application</button>
      </form>
    </div>
  </div>
</section>
