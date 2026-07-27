<?php
use App\Core\Auth;
use App\Core\Flash;
use App\Models\Setting;

$modules = require APP_PATH . '/modules.php';
$groups = [];
foreach ($modules as $key => $m) {
    if (!empty($m['adminOnly']) && !Auth::is('admin')) continue;
    $groups[$m['group']][$key] = $m;
}
$uri = $_SERVER['REQUEST_URI'] ?? '';
$logo = Setting::get('logo') ?: asset('images/logo.jpg');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($title ?? 'Admin') ?> — CMS</title>
<link rel="icon" href="<?= e(Setting::get('favicon') ?: asset('images/favicon.png')) ?>">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= asset('admin/admin.css') ?>">
</head>
<body>
<div class="admin">
  <aside class="sidebar">
    <div class="sidebar__brand">
      <img src="<?= e($logo) ?>" alt="Logo">
      <span>CMS</span>
    </div>
    <a class="item <?= str_contains($uri, '/dashboard') ? 'active' : '' ?>" href="<?= admin_url('dashboard') ?>">▦ Dashboard</a>

    <?php foreach ($groups as $groupName => $mods): ?>
      <div class="nav-group"><?= e($groupName) ?></div>
      <?php foreach ($mods as $key => $m): ?>
        <a class="item <?= str_contains($uri, 'module/' . $key) ? 'active' : '' ?>" href="<?= admin_url('module/' . $key) ?>">
          <?= e($m['label']) ?>
        </a>
      <?php endforeach; ?>
    <?php endforeach; ?>

    <div class="nav-group">Communication</div>
    <a class="item <?= str_contains($uri, '/forms') ? 'active' : '' ?>" href="<?= admin_url('forms') ?>">✉ Form Submissions</a>
    <a class="item <?= str_contains($uri, '/media') ? 'active' : '' ?>" href="<?= admin_url('media') ?>">🖼 Media Library</a>

    <div class="nav-group">System</div>
    <?php if (Auth::is('admin')): ?>
      <a class="item <?= str_contains($uri, '/settings') ? 'active' : '' ?>" href="<?= admin_url('settings') ?>">⚙ Settings</a>
    <?php endif; ?>
    <a class="item <?= str_contains($uri, '/activity') ? 'active' : '' ?>" href="<?= admin_url('activity') ?>">🕑 Activity Log</a>
    <a class="item" href="<?= base_url() ?>" target="_blank">↗ View Website</a>
  </aside>
  <div class="backdrop"></div>

  <div class="main">
    <header class="topbar">
      <div style="display:flex;align-items:center;gap:12px">
        <button class="burger" data-burger aria-label="Menu">☰</button>
        <h1><?= e($title ?? '') ?></h1>
      </div>
      <div class="right">
        <a class="muted" href="<?= admin_url('profile') ?>"><?= e(Auth::user()['name'] ?? '') ?></a>
        <a class="btn light sm" href="<?= admin_url('logout') ?>">Logout</a>
      </div>
    </header>

    <main class="content">
      <?php foreach (Flash::pull() as $f): ?>
        <div class="flash <?= e($f['type']) ?>"><?= e($f['message']) ?></div>
      <?php endforeach; ?>
      <?= $content ?>
    </main>
  </div>
</div>
<script src="<?= asset('admin/admin.js') ?>"></script>
</body>
</html>
