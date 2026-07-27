<?php use App\Core\Csrf; use App\Models\Setting; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sign in — CMS</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= asset('admin/admin.css') ?>">
</head>
<body>
<div class="auth">
  <div class="box">
    <img class="logo" src="<?= e(Setting::get('logo') ?: asset('images/logo.jpg')) ?>" alt="Logo">
    <h1>Welcome back</h1>
    <p class="sub">Sign in to the Channawar's e Vidya Mandir CMS.</p>

    <?php if (!empty($errors['email'])): ?>
      <div class="flash error"><?= e($errors['email']) ?></div>
    <?php endif; ?>

    <form method="post" action="<?= admin_url('login') ?>">
      <?= Csrf::field() ?>
      <div class="field">
        <label for="email">Username or Email</label>
        <input class="input" type="text" id="email" name="email" value="<?= e($_POST['email'] ?? '') ?>" placeholder="admin" required autofocus>
      </div>
      <div class="field">
        <label for="password">Password</label>
        <input class="input" type="password" id="password" name="password" required>
      </div>
      <button class="btn" style="width:100%" type="submit">Sign in</button>
    </form>
    <p style="margin-top:16px;text-align:center;font-size:14px">
      <a href="<?= admin_url('forgot') ?>">Forgot your password?</a>
    </p>
  </div>
</div>
</body>
</html>
