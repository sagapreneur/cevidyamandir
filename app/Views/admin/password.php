<?php use App\Core\Csrf; ?>
<div class="card" style="max-width:520px"><div class="card__body">
  <h3 style="margin-top:0">Change Password</h3>
  <form method="post" action="<?= admin_url('password') ?>">
    <?= Csrf::field() ?>
    <div class="field"><label>Current Password</label><input class="input" type="password" name="current_password" required></div>
    <div class="field"><label>New Password</label><input class="input" type="password" name="new_password" required></div>
    <div class="field"><label>Confirm New Password</label><input class="input" type="password" name="confirm_password" required></div>
    <button class="btn" type="submit">Update Password</button>
    <a class="btn light" href="<?= admin_url('profile') ?>">Back to profile</a>
  </form>
</div></div>
