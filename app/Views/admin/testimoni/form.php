<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php
  $isEdit = !empty($row);
  $gambarVal = old('gambar', $row['gambar'] ?? '');
  // untuk input datetime-local butuh format Y-m-d\TH:i
  $tglVal = old('tanggal', !empty($row['tanggal']) ? date('Y-m-d\TH:i', strtotime($row['tanggal'])) : date('Y-m-d\TH:i'));
?>

<div class="row g-4">
  <!-- Form -->
  <div class="col-12 col-lg-7">
    <div class="zp-card p-4">
      <form method="post" action="<?= site_url('admin/testimoni/save'.($isEdit ? '/'.$row['id'] : '')) ?>">
        <?= csrf_field() ?>

        <div class="mb-3">
          <label class="form-label">Nama Customer</label>
          <input type="text" name="nama" class="form-control" value="<?= esc(old('nama', $row['nama'] ?? '')) ?>" placeholder="contoh: Rangga" required>
        </div>

        <div class="mb-3">
          <label class="form-label">URL Gambar <span class="text-muted-2">(dari postimg / cloudinary / imgbb)</span></label>
          <input type="url" name="gambar" id="gambarInput" class="form-control" value="<?= esc($gambarVal) ?>" placeholder="https://i.postimg.cc/xxxx/foto.jpg" required>
          <div class="form-text text-muted-2">Tempel URL lengkap foto. Foto sebaiknya portrait (rasio 9:16, seperti screenshot HP).</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Teks Testimoni <span class="text-muted-2">(opsional, untuk catatan internal)</span></label>
          <textarea name="isi" class="form-control" rows="2" placeholder="Opsional..."><?= esc(old('isi', $row['isi'] ?? '')) ?></textarea>
          <div class="form-text text-muted-2">Catatan: di halaman publik hanya foto yang ditampilkan, teks ini tidak tampil.</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Tanggal</label>
          <input type="datetime-local" name="tanggal" class="form-control" value="<?= esc($tglVal) ?>">
        </div>

        <div class="form-check form-switch mb-4">
          <input class="form-check-input" type="checkbox" name="is_active" id="aktif" value="1" <?= (!$isEdit || $row['is_active']) ? 'checked' : '' ?>>
          <label class="form-check-label" for="aktif">Tampilkan di website</label>
        </div>

        <button type="submit" class="btn btn-accent">Simpan</button>
        <a href="<?= site_url('admin/testimoni') ?>" class="btn btn-outline-accent">Batal</a>
      </form>
    </div>
  </div>

  <!-- Preview -->
  <div class="col-12 col-lg-5">
    <div class="zp-card p-4 text-center">
      <div class="text-muted-2 small mb-3">Preview Foto</div>
      <div style="aspect-ratio:9/16;max-width:240px;margin:0 auto;border-radius:12px;overflow:hidden;border:1px solid var(--zp-border);background:var(--zp-bg)">
        <img id="preview" src="<?= esc($gambarVal ?: '') ?>" alt="Preview"
             style="width:100%;height:100%;object-fit:cover;<?= $gambarVal ? '' : 'display:none' ?>">
        <div id="previewEmpty" class="d-flex align-items-center justify-content-center h-100 text-muted-2 small p-3" <?= $gambarVal ? 'style="display:none"' : '' ?>>
          Preview muncul di sini setelah URL diisi
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  const inp = document.getElementById('gambarInput');
  const prev = document.getElementById('preview');
  const empty = document.getElementById('previewEmpty');

  function updatePreview() {
    const url = inp.value.trim();
    if (url) {
      prev.src = url;
      prev.style.display = 'block';
      empty.style.display = 'none';
    } else {
      prev.style.display = 'none';
      empty.style.display = 'flex';
    }
  }
  inp.addEventListener('input', updatePreview);
  // kalau gambar gagal dimuat
  prev.addEventListener('error', () => {
    prev.style.display = 'none';
    empty.style.display = 'flex';
    empty.textContent = 'Gambar gagal dimuat. Cek URL-nya.';
  });
</script>
<?= $this->endSection() ?>