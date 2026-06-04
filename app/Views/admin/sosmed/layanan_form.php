<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php $isEdit = !empty($row); ?>
<div class="zp-card p-4" style="max-width:620px">
  <form method="post" action="<?= site_url('admin/sosmed/layanan/save'.($isEdit ? '/'.$row['id'] : '')) ?>">
    <?= csrf_field() ?>
    <div class="mb-3">
      <label class="form-label">Platform</label>
      <select name="platform_id" class="form-select" required>
        <option value="">— Pilih Platform —</option>
        <?php foreach ($platforms as $p): ?>
          <option value="<?= $p['id'] ?>" <?= (old('platform_id', $row['platform_id'] ?? '') == $p['id']) ? 'selected' : '' ?>><?= esc($p['nama']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Nama Layanan</label>
      <input type="text" name="nama" class="form-control" value="<?= esc(old('nama', $row['nama'] ?? '')) ?>" placeholder="contoh: Followers" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Slug <span class="text-muted-2">(opsional)</span></label>
      <input type="text" name="slug" class="form-control" value="<?= esc(old('slug', $row['slug'] ?? '')) ?>" placeholder="followers">
    </div>
    <div class="row g-3">
      <div class="col-6">
        <label class="form-label">Min Order</label>
        <input type="number" name="min_order" class="form-control" value="<?= esc(old('min_order', $row['min_order'] ?? 100)) ?>" min="1" required>
      </div>
      <div class="col-6">
        <label class="form-label">Max Order</label>
        <input type="number" name="max_order" class="form-control" value="<?= esc(old('max_order', $row['max_order'] ?? 1000)) ?>" min="1" required>
      </div>
    </div>
    <div class="form-check form-switch my-4">
      <input class="form-check-input" type="checkbox" name="is_active" id="aktif" value="1" <?= (!$isEdit || $row['is_active']) ? 'checked' : '' ?>>
      <label class="form-check-label" for="aktif">Aktif</label>
    </div>
    <button type="submit" class="btn btn-accent">Simpan</button>
    <a href="<?= site_url('admin/sosmed/layanan') ?>" class="btn btn-outline-accent">Batal</a>
  </form>
</div>

<?= $this->endSection() ?>