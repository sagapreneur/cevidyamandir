<?php
use App\Core\Csrf;
use App\Models\Setting;

$siteName = Setting::get('site_name', "Channawar's e Vidya Mandir");
$metaTitle = $page['meta_title'] ?: $page['title'];
$metaDesc  = $page['meta_description'] ?: Setting::get('seo_description', '');
$ogImage   = $page['og_image'] ?: (Setting::get('seo_og_image') ?: asset('images/logo.jpg'));
$canonical = $page['canonical'] ?: (BASE_URL . '/' . ($slug === 'index' ? '' : $slug . '.html'));
$primary   = Setting::get('primary_color', '#5b3aee');
$accent    = Setting::get('accent_color', '#f8bc24');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="theme-color" content="<?= e($primary) ?>" />
  <meta name="csrf" content="<?= e(Csrf::token()) ?>" />

  <title><?= e($metaTitle) ?> — <?= e($siteName) ?></title>
  <meta name="description" content="<?= e($metaDesc) ?>" />
  <?php if ($page['meta_keywords']): ?><meta name="keywords" content="<?= e($page['meta_keywords']) ?>" /><?php endif; ?>
  <link rel="canonical" href="<?= e($canonical) ?>" />

  <link rel="icon" type="image/png" href="<?= e(Setting::get('favicon') ?: asset('images/favicon.png')) ?>" />
  <link rel="apple-touch-icon" href="<?= asset('images/apple-touch-icon.png') ?>" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?= asset('vendor/fontawesome/css/all.min.css') ?>" />
  <link rel="stylesheet" href="<?= asset_ver('css/edutics.css') ?>" />

  <meta property="og:site_name" content="<?= e($siteName) ?>" />
  <meta property="og:title" content="<?= e($metaTitle) ?> — <?= e($siteName) ?>" />
  <meta property="og:description" content="<?= e($metaDesc) ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="<?= e($canonical) ?>" />
  <meta property="og:image" content="<?= e($ogImage) ?>" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= e($metaTitle) ?>" />
  <meta name="twitter:image" content="<?= e($ogImage) ?>" />

  <?php
  // Structured data (schema.org) — emitted on every public page.
  $orgPhone   = Setting::get('contact_phone', '+91 8551061975');
  $orgEmail   = Setting::get('contact_email', 'cevidyamandir@gmail.com');
  $orgStreet  = Setting::get('address_street', 'Arvi Road, near Vyanktesh Polytechnic');
  $orgCity    = Setting::get('address_city', 'Wardha');
  $orgRegion  = Setting::get('address_region', 'Maharashtra');
  $orgZip     = Setting::get('address_postal', '442001');
  $orgSame    = array_values(array_filter([
      Setting::get('social_instagram'), Setting::get('social_facebook'), Setting::get('social_youtube'),
  ]));
  $ld = [
      '@context' => 'https://schema.org',
      '@type' => 'EducationalOrganization',
      'name' => $siteName,
      'url' => BASE_URL,
      'logo' => Setting::get('logo') ?: asset('images/logo.jpg'),
      'description' => $metaDesc,
      'email' => $orgEmail,
      'telephone' => $orgPhone,
      'address' => [
          '@type' => 'PostalAddress',
          'streetAddress' => $orgStreet,
          'addressLocality' => $orgCity,
          'addressRegion' => $orgRegion,
          'postalCode' => $orgZip,
          'addressCountry' => 'IN',
      ],
  ];
  if ($orgSame) { $ld['sameAs'] = $orgSame; }
  ?>
  <script type="application/ld+json"><?= json_encode($ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>

  <?php $animOn = Setting::get('anim_enabled', '1') !== '0'; ?>
  <style>:root{--color-primary:<?= e($primary) ?>;--color-accent:<?= e($accent) ?>}<?php if (!$animOn): ?>[data-reveal]{opacity:1!important;transform:none!important;transition:none!important}<?php endif; ?></style>
  <?= Setting::get('analytics_head', '') // trusted admin input ?>
</head>
<body data-page="<?= e($slug) ?>" data-anim="<?= $animOn ? 'on' : 'off' ?>">
  <?= Setting::get('analytics_body', '') ?>
  <a href="#main" class="skip-link">Skip to content</a>

  <?php include VIEW_PATH . '/site/partials/topbar.php'; ?>
  <?php include VIEW_PATH . '/site/partials/header.php'; ?>

  <main id="main">
<?= $bodyContent ?>
  </main>

  <?php include VIEW_PATH . '/site/partials/footer.php'; ?>
  <?php include VIEW_PATH . '/site/partials/back-to-top.php'; ?>
  <?php include VIEW_PATH . '/site/partials/scripts.php'; ?>
</body>
</html>
