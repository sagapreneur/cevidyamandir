<?php use App\Core\Csrf; ?>
<form method="post" action="<?= admin_url('settings') ?>" enctype="multipart/form-data">
  <?= Csrf::field() ?>
  <div class="card"><div class="card__body">
  <?php foreach ($schema as $group => $fields): ?>
    <div class="group-title"><?= e(ucfirst($group)) ?></div>
    <?php foreach ($fields as $key => $def):
        $value = $values[$key] ?? ''; $type = $def['type']; ?>
      <div class="field">
        <label for="s_<?= e($key) ?>"><?= e($def['label']) ?></label>
        <?php if ($type === 'textarea'): ?>
          <textarea class="textarea<?= str_contains($key, 'analytics') ? ' code' : '' ?>" id="s_<?= e($key) ?>" name="<?= e($key) ?>"><?= e((string) $value) ?></textarea>
        <?php elseif ($type === 'image'): ?>
          <?php if ($value): ?><img class="thumb" style="width:80px;height:80px;margin-bottom:8px" src="<?= e($value) ?>" alt=""><?php endif; ?>
          <input class="input" type="file" name="<?= e($key) ?>" accept="image/*">
        <?php elseif ($type === 'color'): ?>
          <input type="color" id="s_<?= e($key) ?>" name="<?= e($key) ?>" value="<?= e($value ?: '#5b3aee') ?>" style="height:44px;width:80px;border:1px solid var(--line);border-radius:8px">
        <?php else: ?>
          <input class="input" type="<?= $type === 'email' ? 'email' : 'text' ?>" id="s_<?= e($key) ?>" name="<?= e($key) ?>" value="<?= e((string) $value) ?>">
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  <?php endforeach; ?>
  <div class="form-actions"><button class="btn" type="submit">Save Settings</button></div>
  </div></div>
</form>
