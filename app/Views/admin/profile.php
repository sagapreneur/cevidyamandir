<?php use App\Core\Csrf; ?>
<div class="grid cols-2" style="align-items:start">
  <div class="card"><div class="card__body">
    <h3 style="margin-top:0">Profile</h3>
    <form method="post" action="<?= admin_url('profile') ?>">
      <?= Csrf::field() ?>
      <div class="field"><label>Name</label><input class="input" name="name" value="<?= e($user['name'] ?? '') ?>" required></div>
      <div class="field"><label>Email</label><input class="input" type="email" name="email" value="<?= e($user['email'] ?? '') ?>" required></div>
      <div class="field"><label>Role</label><input class="input" value="<?= e($user['role'] ?? '') ?>" disabled></div>
      <button class="btn" type="submit">Save Profile</button>
    </form>
  </div></div>
  <div class="card"><div class="card__body">
    <h3 style="margin-top:0">Change Password</h3>
    <form method="post" action="<?= admin_url('password') ?>">
      <?= Csrf::field() ?>
      <div class="field"><label>Current Password</label><input class="input" type="password" name="current_password" required></div>
      <div class="field"><label>New Password</label><input class="input" type="password" name="new_password" required></div>
      <div class="field"><label>Confirm New Password</label><input class="input" type="password" name="confirm_password" required></div>
      <button class="btn" type="submit">Update Password</button>
    </form>
  </div></div>
</div>
