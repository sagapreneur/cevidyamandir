<?php
/** ADMISSIONS — premium, CMS-consistent. Grades: Nursery to Class 10 only. */
use App\Core\View;

echo View::render('site/partials/banner', [
    'title' => $page['banner_title'] ?: $page['title'],
    'image' => $page['banner_image'] ?: '',
    'pageTitle' => $page['title'],
]);

// Single source of truth for admissible classes (Nursery → Class 10)
$grades = ['Nursery', 'Jr KG', 'Sr KG', 'Class 1', 'Class 2', 'Class 3', 'Class 4', 'Class 5', 'Class 6', 'Class 7', 'Class 8', 'Class 9', 'Class 10'];
?>

<!-- PROCESS -->
<section class="section">
  <div class="container-edu">
    <div class="section-head">
      <span class="home-eyebrow mx-auto">How to Apply</span>
      <h2 class="t-h2">A Simple 4-Step Admission Process</h2>
      <p class="t-body">Admissions are open for Nursery to Class 10 — apply early as seats are limited.</p>
    </div>
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4" data-reveal-stagger="100">
      <?php
      $steps = [
          ['fa-pen-to-square', 'Enquire', 'Submit the enquiry form or visit our campus.'],
          ['fa-file-lines', 'Apply', 'Complete the application with the required documents.'],
          ['fa-comments', 'Interaction', 'A friendly interaction with the child and parents.'],
          ['fa-circle-check', 'Confirm', 'Receive your offer and complete enrolment.'],
      ];
      foreach ($steps as $i => $s): ?>
        <div class="step-card" data-reveal>
          <span class="step-card__num"><?= $i + 1 ?></span>
          <span class="step-card__icon"><i class="fa-solid <?= e($s[0]) ?>" aria-hidden="true"></i></span>
          <h3 class="t-h4 mb-1"><?= e($s[1]) ?></h3>
          <p class="t-small"><?= e($s[2]) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- REQUIREMENTS + FORM -->
<section class="section section-soft">
  <div class="container-edu grid items-start gap-12 lg:grid-cols-2">
    <div data-reveal="right">
      <span class="home-eyebrow">Requirements</span>
      <h2 class="t-h2 mt-3 mb-5">What You'll Need</h2>
      <ul class="feature-list mb-8">
        <li>Completed application form</li>
        <li>Birth certificate (copy)</li>
        <li>Previous school report card / transfer certificate</li>
        <li>Passport-size photographs</li>
        <li>Address and ID proof of parents</li>
      </ul>
      <div class="card card-body flex items-center justify-between gap-4">
        <div><p class="font-semibold text-ink">Fee structure <?= date('Y') ?>-<?= substr((string)(date('Y') + 1), 2) ?></p><p class="t-small">Transparent, all-inclusive fees.</p></div>
        <a href="fees-structure.html" class="btn-outline btn-sm">View Fees</a>
      </div>
    </div>

    <div class="card card-body !p-8" data-reveal="left">
      <h3 class="t-h3 mb-6">Admission Enquiry</h3>
      <form class="flex flex-col gap-5" data-form-type="admission" novalidate>
        <div class="grid gap-5 sm:grid-cols-2">
          <div class="form-group"><label class="form-label" for="a-child">Child's Name <span class="req">*</span></label><input class="input" id="a-child" name="child_name" required placeholder="Full name" /></div>
          <div class="form-group"><label class="form-label" for="a-grade">Class Applying For <span class="req">*</span></label>
            <select class="select" id="a-grade" name="grade" required>
              <option value="" disabled selected>Select a class</option>
              <?php foreach ($grades as $g): ?><option value="<?= e($g) ?>"><?= e($g) ?></option><?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="grid gap-5 sm:grid-cols-2">
          <div class="form-group"><label class="form-label" for="a-parent">Parent's Name <span class="req">*</span></label><input class="input" id="a-parent" name="name" required placeholder="Full name" /></div>
          <div class="form-group"><label class="form-label" for="a-phone">Phone <span class="req">*</span></label><input class="input" id="a-phone" name="phone" type="tel" required placeholder="+91" /></div>
        </div>
        <div class="form-group"><label class="form-label" for="a-email">Email</label><input class="input" id="a-email" name="email" type="email" placeholder="you@example.com" /></div>
        <div class="form-group"><label class="form-label" for="a-msg">Message</label><textarea class="textarea" id="a-msg" name="message" placeholder="Anything you'd like us to know"></textarea></div>
        <label class="checkbox"><input type="checkbox" required /> I agree to be contacted by the school regarding this enquiry.</label>
        <button class="btn-primary btn-block" type="submit"><i class="fa-solid fa-paper-plane" aria-hidden="true"></i> Submit Enquiry</button>
      </form>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="section">
  <div class="container-edu">
    <div class="section-head">
      <span class="home-eyebrow mx-auto">Good to Know</span>
      <h2 class="t-h2">Admission FAQs</h2>
    </div>
    <div class="accordion mx-auto max-w-3xl" data-accordion data-single>
      <?php
      $faqs = [
          ['When does admission open?', 'Admissions for the ' . date('Y') . '-' . substr((string)(date('Y') + 1), 2) . ' session are currently open for Nursery to Class 10. Early applications are encouraged as seats are limited.'],
          ['Is there an entrance test?', 'For most classes we hold a friendly interaction rather than a formal test. Senior classes may include a short assessment.'],
          ['Can I visit the campus first?', 'Absolutely. Book a guided campus tour through our contact page and our team will host you.'],
      ];
      foreach ($faqs as $i => $f): ?>
        <div class="accordion-item<?= $i === 0 ? ' is-open' : '' ?>">
          <button class="accordion-trigger" aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>"><?= e($f[0]) ?> <span class="accordion-icon">+</span></button>
          <div class="accordion-panel"><div><div class="accordion-content"><?= e($f[1]) ?></div></div></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
