<?php use App\Core\Csrf; ?>
<div class="grid cols-2" style="align-items:start">
  <div class="card"><div class="card__body">
    <h3 style="margin-top:0">Upload File</h3>
    <form method="post" action="<?= admin_url('media/upload') ?>" enctype="multipart/form-data">
      <?= Csrf::field() ?>
      <div class="field"><label>File</label><input class="input" type="file" name="file" required accept="image/*,.pdf,.svg,.ico"></div>
      <div class="field"><label>Title</label><input class="input" name="title"></div>
      <div class="field"><label>Alt Text</label><input class="input" name="alt_text"></div>
      <div class="field"><label>Caption</label><input class="input" name="caption"></div>
      <div class="field"><label>Category</label><input class="input" name="category" placeholder="e.g. hero, gallery, logo"></div>
      <button class="btn" type="submit">Upload</button>
      <p class="hint">Allowed: JPG, PNG, GIF, WebP, SVG, ICO, PDF — max 10 MB.</p>
    </form>
  </div></div>

  <div>
    <form class="toolbar" method="get" action="<?= admin_url('media') ?>">
      <div class="filters">
        <input class="input" name="q" placeholder="Search…" value="<?= e($q) ?>">
        <select class="select" name="type" onchange="this.form.submit()">
          <option value="">All types</option>
          <?php foreach (['jpg','png','webp','svg','pdf','ico','gif'] as $t): ?>
            <option value="<?= $t ?>" <?= $type === $t ? 'selected' : '' ?>><?= strtoupper($t) ?></option>
          <?php endforeach; ?>
        </select>
        <button class="btn light sm" type="submit">Filter</button>
      </div>
    </form>

    <?php if (empty($items)): ?>
      <div class="card"><div class="card__body"><p class="muted">No media yet.</p></div></div>
    <?php else: ?>
      <div class="media-grid">
        <?php foreach ($items as $it): ?>
          <div class="media-item">
            <div class="ph">
              <?php if (in_array($it['file_type'], ['jpg','jpeg','png','webp','gif','svg','ico'], true)): ?>
                <img src="<?= e(upload_url($it['file_path'])) ?>" alt="<?= e($it['alt_text']) ?>">
              <?php else: ?>
                <span style="font-size:36px">📄</span>
              <?php endif; ?>
            </div>
            <div class="meta">
              <div class="t" title="<?= e($it['title']) ?>"><?= e($it['title'] ?: basename($it['file_path'])) ?></div>
              <div class="muted"><?= strtoupper((string) $it['file_type']) ?> · <?= round(((int) $it['file_size']) / 1024) ?>KB</div>
              <div style="display:flex;gap:6px;margin-top:8px">
                <a class="btn sm light" href="<?= e(upload_url($it['file_path'])) ?>" target="_blank">Open</a>
                <form method="post" action="<?= admin_url('media/delete/' . $it['id']) ?>" data-confirm="Delete this file?">
                  <?= Csrf::field() ?><button class="btn sm danger" type="submit">✕</button>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
