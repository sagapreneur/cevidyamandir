<?php use App\Core\Csrf; ?>
<div class="toolbar">
  <a class="muted" href="<?= admin_url('forms') ?>">← Back to submissions</a>
  <form method="post" action="<?= admin_url('forms/delete/' . $row['id']) ?>" data-confirm="Delete this submission?">
    <?= Csrf::field() ?><button class="btn sm danger" type="submit">Delete</button>
  </form>
</div>

<div class="card"><div class="card__body">
  <p><span class="badge soft"><?= e($row['form_type']) ?></span> <span class="muted"><?= e($row['created_at']) ?> · <?= e($row['ip_address']) ?></span></p>
  <table class="table" style="margin-top:12px">
    <tbody>
      <?php if ($row['name']): ?><tr><th style="width:180px">Name</th><td><?= e($row['name']) ?></td></tr><?php endif; ?>
      <?php if ($row['email']): ?><tr><th>Email</th><td><a href="mailto:<?= e($row['email']) ?>"><?= e($row['email']) ?></a></td></tr><?php endif; ?>
      <?php if ($row['phone']): ?><tr><th>Phone</th><td><?= e($row['phone']) ?></td></tr><?php endif; ?>
      <?php if ($row['subject']): ?><tr><th>Subject</th><td><?= e($row['subject']) ?></td></tr><?php endif; ?>
      <?php foreach ($payload as $k => $v): if (in_array($k, ['name','email','phone','subject','_csrf','form_type'], true)) continue; ?>
        <tr><th><?= e(ucfirst(str_replace('_', ' ', (string) $k))) ?></th><td><?= nl2br(e(is_array($v) ? implode(', ', $v) : (string) $v)) ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div></div>
