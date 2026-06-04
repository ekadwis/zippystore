<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php $isEdit = !empty($row); ?>
<div class="zp-card p-4" style="max-width:560px">
  <form method="post" action="<?= site_url('admin/client/save'.($isEdit ? '/'.$row['id'] : '')) ?>">
    <?= csrf_field() ?>
    <div class="mb-3">
      <label class="form-label">Nama Client / Project</label>
      <input type="text" name="nama" class="form-control" value="<?= esc(old('nama', $row['nama'] ?? '')) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">URL Logo <span class="text-muted-2">(opsional)</span></label>
      <input type="url" name="logo" class="form-control" value="<?= esc(old('logo', $row['logo'] ?? '')) ?>" placeholder="https://i.postimg.cc/.../logo.png">
    </div>
    <div class="mb-3">
      <label class="form-label">Deskripsi <span class="text-muted-2">(opsional)</span></label>
      <textarea name="deskripsi" class="form-control" rows="2"><?= esc(old('deskripsi', $row['deskripsi'] ?? '')) ?></textarea>
    </div>
    <div class="form-check form-switch mb-4">
      <input class="form-check-input" type="checkbox" name="is_active" id="aktif" value="1" <?= (!$isEdit || $row['is_active']) ? 'checked' : '' ?>>
      <label class="form-check-label" for="aktif">Tampilkan</label>
    </div>
    <button type="submit" class="btn btn-accent">Simpan</button>
    <a href="<?= site_url('admin/client') ?>" class="btn btn-outline-accent">Batal</a>
  </form>
</div>

<?= $this->endSection() ?>