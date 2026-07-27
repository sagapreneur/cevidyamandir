<form class="toolbar" method="get" action="<?= admin_url('forms') ?>">
  <div class="filters">
    <input class="input" name="q" placeholder="Search name/email/subject…" value="<?= e($q) ?>">
    <select class="select" name="type" onchange="this.form.submit()">
      <option value="">All forms</option>
      <?php foreach ($types as $t): ?>
        <option value="<?= e($t) ?>" <?= $type === $t ? 'selected' : '' ?>><?= e(ucfirst($t)) ?></option>
      <?php endforeach; ?>
    </select>
    <button class="btn light sm" type="submit">Filter</button>
  </div>
  <a class="btn accent sm" href="<?= admin_url('forms/export') . ($type ? '?type=' . urlencode($type) : '') ?>">⬇ Export CSV</a>
</form>

<div class="card" style="overflow-x:auto">
<?php if (empty($rows)): ?>
  <div class="card__body"><p class="muted">No submissions found.</p></div>
<?php else: ?>
  <table class="table">
    <thead><tr><th>Type</th><th>Name</th><th>Email</th><th>Subject</th><th>Date</th><th></th></tr></thead>
    <tbody>
    <?php foreach ($rows as $r): ?>
      <tr style="<?= $r['is_read'] ? '' : 'font-weight:600' ?>">
        <td><span class="badge soft"><?= e($r['form_type']) ?></span></td>
        <td><?= e($r['name']) ?></td>
        <td class="muted"><?= e($r['email']) ?></td>
        <td><?= e(str_excerpt((string) $r['subject'], 6)) ?></td>
        <td class="muted" style="white-space:nowrap"><?= e($r['created_at']) ?></td>
        <td style="white-space:nowrap;text-align:right">
          <a class="btn sm light" href="<?= admin_url('forms/view/' . $r['id']) ?>">View</a>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
</div>
