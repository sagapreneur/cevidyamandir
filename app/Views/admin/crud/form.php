<?php
use App\Core\Csrf;

$val = static function (string $name, $default = '') use ($row) {
    return $row[$name] ?? $default;
};
$currentGroup = null;
?>
<div class="toolbar">
  <a class="muted" href="<?= admin_url('module/' . $moduleKey) ?>">← Back to <?= e($module['label']) ?></a>
</div>

<?php if (!empty($errors['_upload'])): ?><div class="flash error"><?= e($errors['_upload']) ?></div><?php endif; ?>

<div class="card"><div class="card__body">
<form method="post" enctype="multipart/form-data"
      action="<?= admin_url('module/' . $moduleKey . ($row && !empty($row['id']) ? '/edit/' . $row['id'] : '/create')) ?>">
  <?= Csrf::field() ?>

  <?php foreach ($module['fields'] as $f):
      $name = $f['name'];
      $type = $f['type'] ?? 'text';
      $label = $f['label'] ?? ucfirst($name);
      $group = $f['group'] ?? 'Content';
      $value = $val($name, $f['default'] ?? '');
      if ($group !== $currentGroup) { $currentGroup = $group; echo '<div class="group-title">' . e($group) . '</div>'; }
  ?>
    <div class="field">
      <?php if ($type !== 'checkbox'): ?><label for="f_<?= e($name) ?>"><?= e($label) ?></label><?php endif; ?>

      <?php if ($type === 'textarea'): ?>
        <textarea class="textarea" id="f_<?= e($name) ?>" name="<?= e($name) ?>"><?= e((string) $value) ?></textarea>

      <?php elseif ($type === 'richtext'): ?>
        <textarea class="textarea code" id="f_<?= e($name) ?>" name="<?= e($name) ?>" rows="<?= (int) ($f['rows'] ?? 12) ?>"><?= e((string) $value) ?></textarea>
        <p class="hint">HTML is allowed. Uses the site's design-system classes.</p>

      <?php elseif ($type === 'select'):
          $opts = $f['options'] ?? null; ?>
        <select class="select" id="f_<?= e($name) ?>" name="<?= e($name) ?>">
          <option value="">— select —</option>
          <?php if ($opts): foreach ($opts as $o): ?>
            <option value="<?= e($o) ?>" <?= ((string) $value === (string) $o) ? 'selected' : '' ?>><?= e($o) ?></option>
          <?php endforeach; elseif (!empty($options[$name])): foreach ($options[$name] as $o): ?>
            <option value="<?= e((string) $o['v']) ?>" <?= ((string) $value === (string) $o['v']) ? 'selected' : '' ?>><?= e((string) $o['l']) ?></option>
          <?php endforeach; endif; ?>
        </select>

      <?php elseif ($type === 'checkbox'): ?>
        <label class="toggle"><input type="checkbox" name="<?= e($name) ?>" value="1" <?= $value ? 'checked' : '' ?>> <?= e($label) ?></label>

      <?php elseif ($type === 'image' || $type === 'file'): ?>
        <?php if ($value): ?>
          <?php if ($type === 'image'): ?>
            <img id="prev_<?= e($name) ?>" class="thumb" style="width:90px;height:90px;margin-bottom:8px" src="<?= e(upload_url((string) $value)) ?>" alt="">
          <?php else: ?>
            <p class="hint">Current: <a href="<?= e(upload_url((string) $value)) ?>" target="_blank"><?= e(basename((string) $value)) ?></a></p>
          <?php endif; ?>
        <?php else: ?>
          <img id="prev_<?= e($name) ?>" class="thumb" style="width:90px;height:90px;margin-bottom:8px;display:none" alt="">
        <?php endif; ?>
        <input class="input" type="file" id="f_<?= e($name) ?>" name="<?= e($name) ?>" data-preview="prev_<?= e($name) ?>"
               accept="<?= $type === 'image' ? 'image/*' : '.pdf,image/*' ?>">
        <input type="hidden" name="<?= e($name) ?>_existing" value="<?= e((string) $value) ?>">

      <?php elseif ($type === 'color'): ?>
        <input type="color" id="f_<?= e($name) ?>" name="<?= e($name) ?>" value="<?= e($value ?: '#5b3aee') ?>" style="height:44px;width:80px;border:1px solid var(--line);border-radius:8px">

      <?php elseif ($type === 'password'): ?>
        <input class="input" type="password" id="f_<?= e($name) ?>" name="<?= e($name) ?>" autocomplete="new-password">

      <?php else:
          $inputType = in_array($type, ['email','url','number','date','datetime','order'], true)
              ? ($type === 'order' ? 'number' : ($type === 'datetime' ? 'datetime-local' : $type))
              : 'text'; ?>
        <input class="input" type="<?= e($inputType) ?>" id="f_<?= e($name) ?>" name="<?= e($name) ?>" value="<?= e((string) $value) ?>">
      <?php endif; ?>

      <?php if (!empty($f['hint'])): ?><p class="hint"><?= e($f['hint']) ?></p><?php endif; ?>
      <?php if (!empty($errors[$name])): ?><p class="err"><?= e($errors[$name]) ?></p><?php endif; ?>
    </div>
  <?php endforeach; ?>

  <div class="form-actions">
    <button class="btn" type="submit">Save</button>
    <a class="btn light" href="<?= admin_url('module/' . $moduleKey) ?>">Cancel</a>
  </div>
</form>
</div></div>
