<?php
use App\Core\Csrf;

// Map field name → type so we can render cells nicely.
$types = [];
foreach ($module['fields'] as $f) { $types[$f['name']] = $f['type'] ?? 'text'; }
$boolCols = ['is_active', 'is_published', 'is_featured', 'is_pinned', 'is_approved'];
?>
<div class="toolbar">
  <p class="muted"><?= count($rows) ?> <?= e(strtolower($module['label'])) ?></p>
  <a class="btn" href="<?= admin_url('module/' . $moduleKey . '/create') ?>">+ New <?= e($module['singular']) ?></a>
</div>

<div class="card" style="overflow-x:auto">
<?php if (empty($rows)): ?>
  <div class="card__body"><p class="muted">No records yet. Click “New <?= e($module['singular']) ?>” to add one.</p></div>
<?php else: ?>
  <table class="table">
    <thead>
      <tr>
        <?php foreach ($module['listColumns'] as $col => $label): ?>
          <th><?= e($label) ?></th>
        <?php endforeach; ?>
        <th style="text-align:right">Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($rows as $r): ?>
      <tr>
        <?php foreach ($module['listColumns'] as $col => $label):
          $type = $types[$col] ?? 'text';
          $val = $r[$col] ?? ''; ?>
          <td>
            <?php if (in_array($col, $boolCols, true)): ?>
              <span class="badge <?= $val ? 'on' : 'off' ?>"><?= $val ? 'Yes' : 'No' ?></span>
            <?php elseif ($type === 'image' && $val): ?>
              <img class="thumb" src="<?= e(upload_url($val)) ?>" alt="">
            <?php else: ?>
              <?= e(str_excerpt((string) $val, 10)) ?>
            <?php endif; ?>
          </td>
        <?php endforeach; ?>
        <td style="text-align:right;white-space:nowrap">
          <a class="btn sm light" href="<?= admin_url('module/' . $moduleKey . '/edit/' . $r['id']) ?>">Edit</a>
          <form method="post" action="<?= admin_url('module/' . $moduleKey . '/delete/' . $r['id']) ?>" style="display:inline" data-confirm="Delete this <?= e(strtolower($module['singular'])) ?>?">
            <?= Csrf::field() ?>
            <button class="btn sm danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
</div>
