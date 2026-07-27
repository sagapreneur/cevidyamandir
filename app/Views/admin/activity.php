<div class="card" style="overflow-x:auto">
<?php if (empty($rows)): ?>
  <div class="card__body"><p class="muted">No activity recorded yet.</p></div>
<?php else: ?>
  <table class="table">
    <thead><tr><th>User</th><th>Action</th><th>Entity</th><th>Detail</th><th>IP</th><th>When</th></tr></thead>
    <tbody>
    <?php foreach ($rows as $a): ?>
      <tr>
        <td><?= e($a['user_name'] ?? 'System') ?></td>
        <td><span class="badge soft"><?= e($a['action']) ?></span></td>
        <td><?= e($a['entity']) ?><?= $a['entity_id'] ? ' #' . (int) $a['entity_id'] : '' ?></td>
        <td class="muted"><?= e($a['detail']) ?></td>
        <td class="muted"><?= e($a['ip_address']) ?></td>
        <td class="muted" style="white-space:nowrap"><?= e($a['created_at']) ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
</div>
