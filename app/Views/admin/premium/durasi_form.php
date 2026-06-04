<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php $isEdit = !empty($row); ?>
<div class="zp-card p-4" style="max-width:560px">
  <form method="post" action="<?= site_url('admin/premium/durasi/save'.($isEdit ? '/'.$row['id'] : '')) ?>">
    <?= csrf_field() ?>
    <div class="mb-3">
      <label class="form-label">Produk</label>
      <select name="produk_id" class="form-select" required>
        <option value="">— Pilih Produk —</option>
        <?php foreach ($produks as $p): ?>
          <option value="<?= $p['id'] ?>" <?= (old('produk_id', $row['produk_id'] ?? '') == $p['id']) ? 'selected' : '' ?>><?= esc($p['nama']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Label Durasi</label>
      <input type="text" name="label" class="form-control" value="<?= esc(old('label', $row['label'] ?? '')) ?>" placeholder="contoh: 1 Bulan" required>
    </div>
    <div class="row g-3">
      <div class="col-6">
        <label class="form-label">Durasi (hari) <span class="text-muted-2">untuk urutan</span></label>
        <input type="number" name="durasi_hari" class="form-control" value="<?= esc(old('durasi_hari', $row['durasi_hari'] ?? '')) ?>" min="1" placeholder="30" required>
      </div>
      <div class="col-6">
        <label class="form-label">Harga (Rp)</label>
        <input type="number" name="harga" class="form-control" value="<?= esc(old('harga', $row['harga'] ?? '')) ?>" min="0" placeholder="45000" required>
      </div>
    </div>
    <div class="form-check form-switch my-4">
      <input class="form-check-input" type="checkbox" name="is_active" id="aktif" value="1" <?= (!$isEdit || $row['is_active']) ? 'checked' : '' ?>>
      <label class="form-check-label" for="aktif">Aktif</label>
    </div>
    <button type="submit" class="btn btn-accent">Simpan</button>
    <a href="<?= site_url('admin/premium/durasi') ?>" class="btn btn-outline-accent">Batal</a>
  </form>
</div>

<?= $this->endSection() ?>