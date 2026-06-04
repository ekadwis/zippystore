<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php $isEdit = !empty($row); ?>
<div class="zp-card p-4" style="max-width:520px">
  <form method="post" action="<?= site_url('admin/otp/save'.($isEdit ? '/'.$row['id'] : '')) ?>">
    <?= csrf_field() ?>
    <div class="mb-3">
      <label class="form-label">Nama Layanan</label>
      <input type="text" name="nama" class="form-control" value="<?= esc(old('nama', $row['nama'] ?? '')) ?>" placeholder="contoh: WhatsApp" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Harga (Rp)</label>
      <input type="number" name="harga" class="form-control" value="<?= esc(old('harga', $row['harga'] ?? '')) ?>" min="0" placeholder="15000" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Icon <span class="text-muted-2">(emoji, opsional)</span></label>
      <input type="text" name="icon" class="form-control" value="<?= esc(old('icon', $row['icon'] ?? '')) ?>" placeholder="💬">
    </div>
    <div class="form-check form-switch mb-4">
      <input class="form-check-input" type="checkbox" name="is_active" id="aktif" value="1" <?= (!$isEdit || $row['is_active']) ? 'checked' : '' ?>>
      <label class="form-check-label" for="aktif">Tampilkan di website</label>
    </div>
    <button type="submit" class="btn btn-accent">Simpan</button>
    <a href="<?= site_url('admin/otp') ?>" class="btn btn-outline-accent">Batal</a>
  </form>
</div>

<?= $this->endSection() ?>