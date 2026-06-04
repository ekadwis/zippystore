<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<form method="post" action="<?= site_url('admin/pengaturan/save') ?>">
  <?= csrf_field() ?>
  <div class="row g-4">

    <!-- Info Toko -->
    <div class="col-12 col-lg-6">
      <div class="zp-card p-4 h-100">
        <h2 class="h6 mb-3">🏪 Info Toko</h2>
        <div class="mb-3">
          <label class="form-label">Nama Toko</label>
          <input type="text" name="nama_toko" class="form-control" value="<?= esc(old('nama_toko', $row['nama_toko'] ?? '')) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Deskripsi Singkat</label>
          <textarea name="deskripsi" class="form-control" rows="2"><?= esc(old('deskripsi', $row['deskripsi'] ?? '')) ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="<?= esc(old('email', $row['email'] ?? '')) ?>" placeholder="admin@zippystore.com">
        </div>
        <div class="mb-0">
          <label class="form-label">Alamat <span class="text-muted-2">(opsional)</span></label>
          <textarea name="alamat" class="form-control" rows="2"><?= esc(old('alamat', $row['alamat'] ?? '')) ?></textarea>
        </div>
      </div>
    </div>

    <!-- Kontak & Sosmed -->
    <div class="col-12 col-lg-6">
      <div class="zp-card p-4 h-100">
        <h2 class="h6 mb-3">📞 Kontak &amp; Sosial Media</h2>
        <div class="mb-3">
          <label class="form-label">Nomor WhatsApp</label>
          <input type="text" name="no_wa" class="form-control" value="<?= esc(old('no_wa', $row['no_wa'] ?? '')) ?>" placeholder="085177838705">
          <div class="form-text text-muted-2">Boleh format 0857... atau 6285..., otomatis dirapikan saat dipakai.</div>
        </div>
        <div class="mb-3">
          <label class="form-label">Link Instagram</label>
          <input type="url" name="ig_link" class="form-control" value="<?= esc(old('ig_link', $row['ig_link'] ?? '')) ?>" placeholder="https://instagram.com/zippy_store">
        </div>
        <div class="mb-3">
          <label class="form-label">Link Telegram</label>
          <input type="url" name="tele_link" class="form-control" value="<?= esc(old('tele_link', $row['tele_link'] ?? '')) ?>" placeholder="https://t.me/klddies">
        </div>
        <div class="mb-0">
          <label class="form-label">Link Twitter</label>
          <input type="url" name="twitter_link" class="form-control" value="<?= esc(old('twitter_link', $row['twitter_link'] ?? '')) ?>" placeholder="https://twitter.com/zippy_store">
        </div>
      </div>
    </div>

    <!-- Logo & Favicon -->
    <div class="col-12">
      <div class="zp-card p-4">
        <h2 class="h6 mb-3">🖼️ Logo &amp; Favicon <span class="text-muted-2 small">(URL gambar online)</span></h2>
        <div class="row g-3">
          <div class="col-12 col-md-6">
            <label class="form-label">URL Logo</label>
            <input type="url" name="logo" class="form-control" value="<?= esc(old('logo', $row['logo'] ?? '')) ?>" placeholder="https://i.postimg.cc/.../logo.png">
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label">URL Favicon</label>
            <input type="url" name="favicon" class="form-control" value="<?= esc(old('favicon', $row['favicon'] ?? '')) ?>" placeholder="https://i.postimg.cc/.../favicon.png">
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="mt-4">
    <button type="submit" class="btn btn-accent px-4">💾 Simpan Pengaturan</button>
  </div>
</form>

<?= $this->endSection() ?>