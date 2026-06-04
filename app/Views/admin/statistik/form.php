<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php $isEdit = !empty($row); ?>
<div class="zp-card p-4" style="max-width:520px">
  <form method="post" action="<?= site_url('admin/statistik/save'.($isEdit ? '/'.$row['id'] : '')) ?>">
    <?= csrf_field() ?>
    <div class="mb-3">
      <label class="form-label">Icon <span class="text-muted-2">(emoji)</span></label>
      <input type="text" name="icon" class="form-control" value="<?= esc(old('icon', $row['icon'] ?? '')) ?>" placeholder="📦">
    </div>
    <div class="mb-3">
      <label class="form-label">Angka</label>
      <input type="text" name="angka" class="form-control" value="<?= esc(old('angka', $row['angka'] ?? '')) ?>" placeholder="5.000+ atau 24 Jam" required>
      <div class="form-text text-muted-2">Bebas teks: "5.000+", "24 Jam", "4", dll.</div>
    </div>
    <div class="mb-3">
      <label class="form-label">Label</label>
      <input type="text" name="label" class="form-control" value="<?= esc(old('label', $row['label'] ?? '')) ?>" placeholder="Pesanan Selesai" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Urutan</label>
      <input type="number" name="urutan" class="form-control" value="<?= esc(old('urutan', $row['urutan'] ?? 0)) ?>" min="0">
    </div>
    <div class="form-check form-switch mb-4">
      <input class="form-check-input" type="checkbox" name="is_active" id="aktif" value="1" <?= (!$isEdit || $row['is_active']) ? 'checked' : '' ?>>
      <label class="form-check-label" for="aktif">Tampilkan</label>
    </div>
    <button type="submit" class="btn btn-accent">Simpan</button>
    <a href="<?= site_url('admin/statistik') ?>" class="btn btn-outline-accent">Batal</a>
  </form>
</div>

<?= $this->endSection() ?>