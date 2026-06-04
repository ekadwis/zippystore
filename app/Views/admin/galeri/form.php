<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php
  $isEdit  = !empty($row);
  $fileVal = old('file', $row['file'] ?? '');
  $katVal  = old('kategori', $row['kategori'] ?? '');
  $katLabel = ['surat'=>'Surat','tugas'=>'Tugas','premium'=>'Premium','sosmed'=>'Sosmed'];
?>

<div class="row g-4">
  <div class="col-12 col-lg-7">
    <div class="zp-card p-4">
      <form method="post" action="<?= site_url('admin/galeri/save'.($isEdit ? '/'.$row['id'] : '')) ?>">
        <?= csrf_field() ?>

        <div class="mb-3">
          <label class="form-label">Nama / Judul Gambar</label>
          <input type="text" name="nama" class="form-control" value="<?= esc(old('nama', $row['nama'] ?? '')) ?>" placeholder="contoh: Surat Sehat" required>
          <div class="form-text text-muted-2">Tulisan ini muncul di bawah foto di halaman galeri (mis. Surat Sehat, Invoice, Portfolio).</div>
        </div>

        <div class="mb-3">
          <label class="form-label">URL Gambar <span class="text-muted-2">(postimg / cloudinary / imgbb)</span></label>
          <input type="url" name="file" id="fileInput" class="form-control" value="<?= esc($fileVal) ?>" placeholder="https://i.postimg.cc/xxxx/gambar.jpg" required>
          <div class="form-text text-muted-2">Boleh portrait atau landscape — ukuran asli tetap dipertahankan di galeri.</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Kategori</label>
          <select name="kategori" class="form-select" required>
            <option value="">— Pilih Kategori —</option>
            <?php foreach ($kategoriList as $k): ?>
              <option value="<?= $k ?>" <?= $katVal === $k ? 'selected' : '' ?>><?= $katLabel[$k] ?? ucfirst($k) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-check form-switch mb-4">
          <input class="form-check-input" type="checkbox" name="is_active" id="aktif" value="1" <?= (!$isEdit || $row['is_active']) ? 'checked' : '' ?>>
          <label class="form-check-label" for="aktif">Tampilkan di galeri</label>
        </div>

        <button type="submit" class="btn btn-accent">Simpan</button>
        <a href="<?= site_url('admin/galeri') ?>" class="btn btn-outline-accent">Batal</a>
      </form>
    </div>
  </div>

  <!-- Preview -->
  <div class="col-12 col-lg-5">
    <div class="zp-card p-4 text-center">
      <div class="text-muted-2 small mb-3">Preview Gambar</div>
      <div style="border-radius:12px;overflow:hidden;border:1px solid var(--zp-border);background:var(--zp-bg);min-height:160px" class="d-flex align-items-center justify-content-center">
        <img id="preview" src="<?= esc($fileVal ?: '') ?>" alt="Preview"
             style="width:100%;max-height:360px;object-fit:contain;<?= $fileVal ? '' : 'display:none' ?>">
        <div id="previewEmpty" class="text-muted-2 small p-4" <?= $fileVal ? 'style="display:none"' : '' ?>>
          Preview muncul setelah URL diisi
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  const inp = document.getElementById('fileInput');
  const prev = document.getElementById('preview');
  const empty = document.getElementById('previewEmpty');

  function updatePreview() {
    const url = inp.value.trim();
    if (url) { prev.src = url; prev.style.display = 'block'; empty.style.display = 'none'; }
    else { prev.style.display = 'none'; empty.style.display = 'block'; }
  }
  inp.addEventListener('input', updatePreview);
  prev.addEventListener('error', () => {
    prev.style.display = 'none'; empty.style.display = 'block';
    empty.textContent = 'Gambar gagal dimuat. Cek URL-nya.';
  });
</script>
<?= $this->endSection() ?>