<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php $isEdit = !empty($row); ?>
<div class="zp-card p-4" style="max-width:560px">
  <form method="post" action="<?= site_url('admin/sosmed/paket/save'.($isEdit ? '/'.$row['id'] : '')) ?>">
    <?= csrf_field() ?>
    <div class="mb-3">
      <label class="form-label">Layanan</label>
      <select name="layanan_id" class="form-select" required>
        <option value="">— Pilih Layanan —</option>
        <?php foreach ($layanans as $l): ?>
          <option value="<?= $l['id'] ?>" <?= (old('layanan_id', $row['layanan_id'] ?? '') == $l['id']) ? 'selected' : '' ?>>
            <?= esc($l['platform_nama'].' — '.$l['nama']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="row g-3">
      <div class="col-6">
        <label class="form-label">Jumlah</label>
        <input type="number" name="jumlah" class="form-control" value="<?= esc(old('jumlah', $row['jumlah'] ?? '')) ?>" min="1" placeholder="1000" required>
      </div>
      <div class="col-6">
        <label class="form-label">Harga (Rp)</label>
        <input type="number" name="harga" class="form-control" value="<?= esc(old('harga', $row['harga'] ?? '')) ?>" min="0" placeholder="75000" required>
      </div>
    </div>
    <div class="form-check form-switch my-4">
      <input class="form-check-input" type="checkbox" name="is_active" id="aktif" value="1" <?= (!$isEdit || $row['is_active']) ? 'checked' : '' ?>>
      <label class="form-check-label" for="aktif">Aktif</label>
    </div>
    <button type="submit" class="btn btn-accent">Simpan</button>
    <a href="<?= site_url('admin/sosmed/paket') ?>" class="btn btn-outline-accent">Batal</a>
  </form>
</div>

<?= $this->endSection() ?>