<?php use App\Core\Csrf; use App\Core\Flash; use App\Models\Setting; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Forgot password — CMS</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= asset('admin/admin.css') ?>">
</head>
<body>
<div class="auth">
  <div class="box">
    <img class="logo" src="<?= e(Setting::get('logo') ?: asset('images/logo.jpg')) ?>" alt="Logo">
    <?php foreach (Flash::pull() as $f): ?>
      <div class="flash <?= e($f['type']) ?>"><?= e($f['message']) ?></div>
    <?php endforeach; ?>
    <?php if (!empty($errors['password'])): ?>
      <div class="flash error"><?= e($errors['password']) ?></div>
    <?php endif; ?>

    <?php if ($mode === 'reset'): ?>
      <h1>Set a new password</h1>
      <p class="sub">Choose a strong password (min 8 characters).</p>
      <form method="post" action="<?= admin_url('forgot') ?>?token=<?= e($token) ?>">
        <?= Csrf::field() ?>
        <div class="field"><label>New password</label><input class="input" type="password" name="password" required></div>
        <div class="field"><label>Confirm password</label><input class="input" type="password" name="password_confirm" required></div>
        <button class="btn" style="width:100%" type="submit">Update password</button>
      </form>
    <?php else: ?>
      <h1>Forgot password</h1>
      <p class="sub">Enter your email and we'll generate a reset link.</p>
      <?php if (!empty($devLink)): ?>
        <div class="flash info" style="word-break:break-all">Reset link: <a href="<?= e($devLink) ?>"><?= e($devLink) ?></a></div>
      <?php endif; ?>
      <form method="post" action="<?= admin_url('forgot') ?>">
        <?= Csrf::field() ?>
        <div class="field"><label>Email</label><input class="input" type="email" name="email" required></div>
        <button class="btn" style="width:100%" type="submit">Send reset link</button>
      </form>
    <?php endif; ?>
    <p style="margin-top:16px;text-align:center;font-size:14px"><a href="<?= admin_url('login') ?>">Back to sign in</a></p>
  </div>
</div>
</body>
</html>
