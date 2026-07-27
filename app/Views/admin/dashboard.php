<div class="grid stats">
  <?php foreach ($stats as $label => $value): ?>
    <div class="stat">
      <div class="n"><?= (int) $value ?></div>
      <div class="l"><?= e($label) ?></div>
    </div>
  <?php endforeach; ?>
</div>

<div class="grid cols-2" style="margin-top:22px">
  <div class="card"><div class="card__body">
    <h3 style="margin-top:0">Recent Form Messages</h3>
    <?php if (empty($recentForms)): ?>
      <p class="muted">No submissions yet.</p>
    <?php else: ?>
      <table class="table">
        <thead><tr><th>Type</th><th>Name</th><th>Date</th><th></th></tr></thead>
        <tbody>
        <?php foreach ($recentForms as $f): ?>
          <tr>
            <td><span class="badge soft"><?= e($f['form_type']) ?></span></td>
            <td><?= e($f['name']) ?></td>
            <td class="muted"><?= e($f['created_at']) ?></td>
            <td><a class="btn sm light" href="<?= admin_url('forms/view/' . $f['id']) ?>">View</a></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div></div>

  <div class="card"><div class="card__body">
    <h3 style="margin-top:0">Recent Activity</h3>
    <?php if (empty($recentActivity)): ?>
      <p class="muted">No activity recorded.</p>
    <?php else: ?>
      <table class="table">
        <tbody>
        <?php foreach ($recentActivity as $a): ?>
          <tr>
            <td><strong><?= e($a['user_name'] ?? 'System') ?></strong> <span class="muted"><?= e($a['action']) ?></span> <?= e($a['entity']) ?></td>
            <td class="muted" style="white-space:nowrap"><?= e($a['created_at']) ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div></div>
</div>
