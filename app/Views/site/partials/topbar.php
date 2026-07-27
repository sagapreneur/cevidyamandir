<?php use App\Models\Setting;
$email = Setting::get('contact_email', 'cevidyamandir@gmail.com');
$phone = Setting::get('contact_phone', '+91 8551061975');
$phoneHref = Setting::get('contact_phone_href', '+918551061975');
$annLead = Setting::get('announcement_lead', 'Admissions Open for Session 2026-27');
$annStrong = Setting::get('announcement_strong', 'Nursery to Class IX');
?>
<div class="topbar">
  <div class="container-edu">
    <div class="topbar-inner">
      <div class="topbar-meta">
        <a class="item" href="mailto:<?= e($email) ?>">
          <i class="fa-solid fa-envelope" aria-hidden="true"></i>
          <span><?= e($email) ?></span>
        </a>
        <a class="item" href="tel:<?= e($phoneHref) ?>">
          <i class="fa-solid fa-phone" aria-hidden="true"></i>
          <span><?= e($phone) ?></span>
        </a>
      </div>
      <p class="topbar-promo"><?= e($annLead) ?> &mdash; <strong><?= e($annStrong) ?></strong></p>
    </div>
  </div>
</div>
