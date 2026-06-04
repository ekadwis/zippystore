<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php
  $isEdit = !empty($row);
  $validVal = old('valid_until', !empty($row['valid_until']) ? date('Y-m-d\TH:i', strtotime($row['valid_until'])) : '');
?>
<div class="zp-card p-4" style="max-width:560px">
  <form method="post" action="<?= site_url('admin/promo/save'.($isEdit ? '/'.$row['id'] : '')) ?>">
    <?= csrf_field() ?>
    <div class="mb-3">
      <label class="form-label">Kode Voucher</label>
      <input type="text" name="kode" class="form-control text-uppercase" value="<?= esc(old('kode', $row['kode'] ?? '')) ?>" placeholder="HEMAT20" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Diskon (%)</label>
      <input type="number" name="diskon" class="form-control" value="<?= esc(old('diskon', $row['diskon'] ?? '')) ?>" min="0" max="100" placeholder="20" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Deskripsi <span class="text-muted-2">(opsional)</span></label>
      <textarea name="deskripsi" class="form-control" rows="2"><?= esc(old('deskripsi', $row['deskripsi'] ?? '')) ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Berlaku Sampai <span class="text-muted-2">(opsional)</span></label>
      <input type="datetime-local" name="valid_until" class="form-control" value="<?= esc($validVal) ?>">
    </div>
    <div class="form-check form-switch mb-4">
      <input class="form-check-input" type="checkbox" name="is_active" id="aktif" value="1" <?= (!$isEdit || $row['is_active']) ? 'checked' : '' ?>>
      <label class="form-check-label" for="aktif">Aktif</label>
    </div>
    <button type="submit" class="btn btn-accent">Simpan</button>
    <a href="<?= site_url('admin/promo') ?>" class="btn btn-outline-accent">Batal</a>
  </form>
</div>

<?= $this->endSection() ?>