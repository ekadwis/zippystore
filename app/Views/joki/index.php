<?= $this->include('template/header') ?>

<header class="section text-center" style="padding-top:140px">
  <div class="container">
    <h1 class="fw-bold reveal">Joki <span class="text-grad">Tugas</span></h1>
    <p class="text-muted-2 reveal mx-auto" style="max-width:640px">
      Tugas numpuk? Deadline mepet? Isi form di bawah, langsung terhubung ke admin kami via WhatsApp.
    </p>
  </div>
</header>

<section class="section pt-0">
  <div class="container">
    <div class="row g-4">

      <!-- FORM -->
      <div class="col-12 col-lg-7">
        <div class="zp-card p-4 p-md-5 joki-form reveal">
          <h2 class="h5 mb-4">📝 Form Pemesanan Joki</h2>

          <div class="mb-3">
            <label>Nama Tugas</label>
            <input type="text" id="namaTugas" class="form-control" placeholder="contoh: Makalah Sejarah Indonesia">
          </div>
          <div class="mb-3">
            <label>Deadline</label>
            <input type="text" id="deadline" class="form-control" placeholder="contoh: 25 Juni 2026, jam 23.59">
          </div>
          <div class="mb-3">
            <label>Detail Tugas</label>
            <textarea id="detail" class="form-control" rows="4" placeholder="Jelaskan tugasnya: jumlah halaman, format, mata kuliah, dll."></textarea>
          </div>
          <div class="mb-4">
            <label>Catatan <span class="text-muted-2">(opsional)</span></label>
            <textarea id="catatan" class="form-control" rows="2" placeholder="Permintaan khusus, referensi, dll."></textarea>
          </div>

          <button class="btn btn-accent w-100 py-2" id="btnKirim">💬 Kirim ke WhatsApp</button>
          <div class="alert alert-danger mt-3" id="formError" style="display:none"></div>
        </div>
      </div>

      <!-- KETENTUAN -->
      <div class="col-12 col-lg-5">
        <div class="zp-card p-4 p-md-5 h-100 reveal">
          <h2 class="h5 mb-3">📌 Ketentuan Layanan</h2>
          <ul class="ketentuan-list">
            <?php foreach ($ketentuan as $k): ?>
              <li><span class="k-ico">✓</span><span><?= esc($k) ?></span></li>
            <?php endforeach; ?>
          </ul>
          <div class="mt-4 p-3" style="background:rgba(99,102,241,.08);border:1px solid var(--accent);border-radius:12px">
            <p class="small text-muted-2 mb-0">
              💡 Dengan mengirim form ini, kamu dianggap telah membaca &amp; menyetujui ketentuan di atas.
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<?= $this->include('template/footer') ?>

<script>
  const WA_NUMBER = '<?= $waNumber ?>';

  document.getElementById('btnKirim').addEventListener('click', () => {
    const namaTugas = document.getElementById('namaTugas').value.trim();
    const deadline  = document.getElementById('deadline').value.trim();
    const detail    = document.getElementById('detail').value.trim();
    const catatan   = document.getElementById('catatan').value.trim();
    const errBox    = document.getElementById('formError');

    // Validasi minimal
    if (!namaTugas || !deadline || !detail) {
      errBox.textContent = 'Nama Tugas, Deadline, dan Detail Tugas wajib diisi ya.';
      errBox.style.display = 'block';
      return;
    }
    errBox.style.display = 'none';

    // Susun pesan terformat
    const pesan =
      `*FORM JOKI TUGAS - ZIPPY STORE*%0A%0A` +
      `*Nama Tugas:* ${encodeURIComponent(namaTugas)}%0A` +
      `*Deadline:* ${encodeURIComponent(deadline)}%0A` +
      `*Detail Tugas:* ${encodeURIComponent(detail)}%0A` +
      `*Catatan:* ${encodeURIComponent(catatan || '-')}%0A%0A` +
      `Halo admin, saya mau pesan joki tugas dengan detail di atas. Mohon info fee-nya ya. Terima kasih!`;

    window.open(`https://wa.me/${WA_NUMBER}?text=${pesan}`, '_blank');
  });
</script>