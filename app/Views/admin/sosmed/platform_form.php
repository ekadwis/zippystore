<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php $isEdit = !empty($row); ?>
<div class="zp-card p-4" style="max-width:560px">
  <form method="post" action="<?= site_url('admin/sosmed/platform/save'.($isEdit ? '/'.$row['id'] : '')) ?>">
    <?= csrf_field() ?>
    <div class="mb-3">
      <label class="form-label">Nama Platform</label>
      <input type="text" name="nama" class="form-control" value="<?= esc(old('nama', $row['nama'] ?? '')) ?>" placeholder="contoh: TikTok" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Slug <span class="text-muted-2">(opsional, otomatis dari nama)</span></label>
      <input type="text" name="slug" class="form-control" value="<?= esc(old('slug', $row['slug'] ?? '')) ?>" placeholder="contoh: tiktok">
    </div>
    <div class="mb-3">
      <label class="form-label">Icon <span class="text-muted-2">(emoji / path, opsional)</span></label>
      <input type="text" name="icon" class="form-control" value="<?= esc(old('icon', $row['icon'] ?? '')) ?>" placeholder="🎵">
    </div>
    <div class="form-check form-switch mb-4">
      <input class="form-check-input" type="checkbox" name="is_active" id="aktif" value="1" <?= (!$isEdit || $row['is_active']) ? 'checked' : '' ?>>
      <label class="form-check-label" for="aktif">Aktif</label>
    </div>
    <button type="submit" class="btn btn-accent">Simpan</button>
    <a href="<?= site_url('admin/sosmed/platform') ?>" class="btn btn-outline-accent">Batal</a>
  </form>
</div>

<?= $this->endSection() ?>