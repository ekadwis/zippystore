<?= $this->include('template/header') ?>

<header class="section text-center" style="padding-top:140px;padding-bottom:40px">
  <div class="container">
    <div class="d-inline-flex align-items-center gap-2 mb-3 reveal">
      <span class="badge-joki">HERO SERVICE ZIPPY STORE</span>
      <span class="badge-trust">EST. 2019</span>
    </div>
    <h1 class="fw-bold reveal">
      Asistensi &amp; Joki <span class="text-grad-amber">Tugas Profesional</span>
    </h1>
    <p class="text-muted-2 reveal mx-auto" style="max-width:680px">
      Pendampingan pengerjaan tugas akademik &amp; proyek profesional oleh tim spesialis. Skema pengerjaan transparan, biaya fleksibel sesuai brief, dan dilindungi garansi revisi minor 1–2 kali gratis.
    </p>
  </div>
</header>

<!-- CAKUPAN BIDANG HIGHLIGHT (CHUNKY POP TILES) -->
<section class="pt-0 pb-4">
  <div class="container">
    <div class="row g-3">
      <div class="col-6 col-md-3 reveal">
        <div class="zp-card p-3 text-center" style="background:#fffbeb">
          <div style="font-size:28px;margin-bottom:6px">💻</div>
          <h6 class="mb-1 fw-bold" style="font-size:14.5px">IT &amp; Coding</h6>
          <p class="text-muted-2 mb-0" style="font-size:12.5px">Web, debug, skripsi IT</p>
        </div>
      </div>
      <div class="col-6 col-md-3 reveal">
        <div class="zp-card p-3 text-center" style="background:#fffbeb">
          <div style="font-size:28px;margin-bottom:6px">📊</div>
          <h6 class="mb-1 fw-bold" style="font-size:14.5px">Olah Data</h6>
          <p class="text-muted-2 mb-0" style="font-size:12.5px">Excel &amp; Google Sheets</p>
        </div>
      </div>
      <div class="col-6 col-md-3 reveal">
        <div class="zp-card p-3 text-center" style="background:#fffbeb">
          <div style="font-size:28px;margin-bottom:6px">📄</div>
          <h6 class="mb-1 fw-bold" style="font-size:14.5px">Administrasi</h6>
          <p class="text-muted-2 mb-0" style="font-size:12.5px">CV ATS &amp; surat resmi</p>
        </div>
      </div>
      <div class="col-6 col-md-3 reveal">
        <div class="zp-card p-3 text-center" style="background:#fffbeb">
          <div style="font-size:28px;margin-bottom:6px">📚</div>
          <h6 class="mb-1 fw-bold" style="font-size:14.5px">Tugas Akademik</h6>
          <p class="text-muted-2 mb-0" style="font-size:12.5px">Makalah, esai, tugas kuliah</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MAIN SECTION: ORDER SLIP FORM & KETENTUAN -->
<section class="section pt-3">
  <div class="container">
    <div class="row g-4">

      <!-- FORM PEMESANAN FORMAT ORDER SLIP -->
      <div class="col-12 col-lg-7">
        <div class="ticket-slip ticket-joki reveal">
          <div class="ticket-header">
            <div>
              <span class="badge-joki">ORDER SLIP RESMI</span>
            </div>
            <span class="ticket-id">FORM #ZP-BRIEF</span>
          </div>

          <div class="ticket-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h2 class="h5 mb-0 fw-bold">📝 Form Konsultasi &amp; Brief Tugas</h2>
              <span class="badge-trust" style="font-size:11.5px">⚡ Respons &lt; 24 Jam</span>
            </div>

            <div class="mb-3">
              <label class="form-label" for="kategoriTugas">Kategori Bidang Tugas</label>
              <select id="kategoriTugas" class="form-select">
                <option value="">— Pilih Kategori Bidang —</option>
                <?php foreach ($kategoriList as $kat): ?>
                  <option value="<?= esc($kat) ?>"><?= esc($kat) ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label" for="namaTugas">Judul / Topik Tugas</label>
              <input type="text" id="namaTugas" class="form-control" placeholder="Contoh: Pembuatan Website E-Commerce Laravel / Analisis Pivot Excel">
            </div>

            <div class="mb-3">
              <label class="form-label" for="deadline">Target Deadline</label>
              <input type="text" id="deadline" class="form-control" placeholder="Contoh: 28 Oktober 2026, Pukul 20:00 WIB">
              <div class="form-text text-muted-2 small">Sampaikan jika deadline mendesak (rush order).</div>
            </div>

            <div class="mb-3">
              <label class="form-label" for="detail">Rincian Brief &amp; Ketentuan</label>
              <textarea id="detail" class="form-control" rows="4" placeholder="Jelaskan kebutuhanmu secara detail: bahasa pemrograman / rumus / format file / jumlah halaman / software yang digunakan."></textarea>
            </div>

            <div class="mb-4">
              <label class="form-label" for="catatan">Catatan Tambahan &amp; Lampiran File <span class="text-muted-subtle">(Opsional)</span></label>
              <textarea id="catatan" class="form-control" rows="2" placeholder="Tautan Google Drive materi / permintaan referensi khusus / pedoman dosen atau instansi."></textarea>
            </div>

            <button class="btn btn-accent w-100 py-3 d-flex align-items-center justify-content-center gap-2" id="btnKirim" style="background:var(--accent-joki);font-size:15px">
              <span>💬 Kirim Brief &amp; Hitung Biaya via WhatsApp</span>
            </button>
            <div class="alert alert-danger mt-3" id="formError" style="display:none;font-size:13.5px;border:2px solid #18181b;box-shadow:2px 2px 0px #18181b"></div>
          </div>
        </div>
      </div>

      <!-- KETENTUAN & SOP KUALITAS -->
      <div class="col-12 col-lg-5">
        <div class="ticket-slip reveal" style="border-top:none">
          <div class="ticket-header" style="background:#fef3c7">
            <div>
              <span class="badge-trust" style="background:#fff">SOP LAYANAN</span>
            </div>
            <span class="ticket-id">GARANSI AKTIF</span>
          </div>

          <div class="ticket-body p-4">
            <div class="d-flex align-items-center gap-2 mb-3">
              <span style="font-size:24px">🛡️</span>
              <h2 class="h5 mb-0 fw-bold">SOP &amp; Ketentuan Asistensi</h2>
            </div>
            <p class="text-muted-2 small mb-4">
              Komitmen kami menjaga kualitas pengerjaan dan keamanan privasi klien sejak 2019:
            </p>

            <ul class="ketentuan-list">
              <?php foreach ($ketentuan as $k): ?>
                <li>
                  <span class="k-ico">✓</span>
                  <span><?= esc($k) ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>

          <div class="ticket-perforated">
            <div class="ticket-notch-left"></div>
            <div class="ticket-notch-right"></div>
            <div class="d-flex align-items-start gap-2">
              <span style="font-size:20px">💡</span>
              <p class="small text-muted-2 mb-0" style="line-height:1.5">
                <strong>Alur Transparan:</strong> Kirim brief &rarr; Estimasi biaya &rarr; DP min. 50% via QRIS &rarr; Pengerjaan &rarr; Penyerahan file &amp; hak revisi 1–2 kali gratis.
              </p>
            </div>
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
    const kategori  = document.getElementById('kategoriTugas').value.trim();
    const namaTugas = document.getElementById('namaTugas').value.trim();
    const deadline  = document.getElementById('deadline').value.trim();
    const detail    = document.getElementById('detail').value.trim();
    const catatan   = document.getElementById('catatan').value.trim();
    const errBox    = document.getElementById('formError');

    // Validasi input
    if (!namaTugas || !deadline || !detail) {
      errBox.textContent = 'Harap isi Kategori, Nama Tugas, Deadline, dan Detail Brief tugas kamu ya.';
      errBox.style.display = 'block';
      return;
    }
    errBox.style.display = 'none';

    // Format pesan ramah dan profesional sesuai identitas.md
    const pesan =
      `*BRIEF ASISTENSI & JOKI TUGAS — ZIPPY STORE*%0A%0A` +
      `*Kategori:* ${encodeURIComponent(kategori || 'Umum')}%0A` +
      `*Nama/Topik Tugas:* ${encodeURIComponent(namaTugas)}%0A` +
      `*Deadline:* ${encodeURIComponent(deadline)}%0A` +
      `*Detail Brief:* ${encodeURIComponent(detail)}%0A` +
      `*Catatan/Lampiran:* ${encodeURIComponent(catatan || '-')}%0A%0A` +
      `Halo admin Zippy Store, saya ingin konsultasi pengerjaan tugas dengan brief di atas. Mohon info estimasi biaya dan durasi pengerjaannya ya. Terima kasih!`;

    window.open(`https://wa.me/${WA_NUMBER}?text=${pesan}`, '_blank');
  });
</script>