<?= $this->include('template/header') ?>

<?php
  $set = $pengaturan ?? [];
  $waNumber = !empty($set['no_wa']) ? preg_replace('/[^0-9]/', '', $set['no_wa']) : '6285177838705';
  $wa  = 'https://wa.me/' . $waNumber;
?>

<header class="section text-center" style="padding-top:140px;padding-bottom:40px">
  <div class="container">
    <div class="d-inline-flex align-items-center gap-2 mb-3 reveal">
      <span class="badge-trust">PROFIL RESMI BISNIS</span>
      <span class="badge-trust">EST. 2019</span>
    </div>
    <h1 class="fw-bold reveal">
      Mengenal Lebih Dekat <span class="text-grad">Zippy Store</span>
    </h1>
    <p class="text-muted-2 reveal mx-auto" style="max-width:680px">
      Penyedia layanan kebutuhan digital independen yang berfokus mendampingi pelajar, mahasiswa, dan profesional muda sejak 2019.
    </p>
  </div>
</header>

<!-- CERITA & IDENTITAS BISNIS -->
<section class="section pt-0">
  <div class="container" style="max-width:880px">
    <div class="zp-card p-4 p-md-5 reveal mb-4">
      <h2 class="h4 mb-3 fw-bold">Perjalanan &amp; Filosofi Kami</h2>
      <p class="text-muted-2" style="line-height:1.8">
        Berawal pada tahun 2019 dengan nama <strong>Zippediastore</strong>, kami hadir menjawab keresahan pelajar dan anak muda yang membutuhkan akun hiburan legal berbiaya hemat serta asistensi pengerjaan tugas akademik tanpa rasa khawatir. Seiring pertumbuhan layanan dan kepercayaan ribuan pelanggan, kami bertransformasi menjadi <strong>Zippy Store</strong> (domain resmi: <strong>zippystore.my.id</strong>).
      </p>
      <p class="text-muted-2" style="line-height:1.8">
        Kami memilih berdiri sebagai <em>independent digital provider &amp; freelance agency</em> yang tidak kaku seperti korporat. Karakter kami sederhana: <strong>cepat tanggap (respon &lt;24 jam), ramah, solutif, harga ramah kantong mahasiswa, serta mengutamakan pembayaran instan via QRIS</strong>.
      </p>
      <div class="row g-3 mt-2">
        <div class="col-6 col-md-3">
          <div class="p-3 zp-card text-center" style="background:#fffbeb">
            <div class="fw-bold h5 mb-0" style="font-family:var(--font-display)">2019</div>
            <span class="text-muted-2 small">Tahun Berdiri</span>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="p-3 zp-card text-center" style="background:#ecfdf5">
            <div class="fw-bold h5 mb-0" style="font-family:var(--font-display)">1.000+</div>
            <span class="text-muted-2 small">Pesanan Sukses</span>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="p-3 zp-card text-center" style="background:#fef3c7">
            <div class="fw-bold h5 mb-0" style="font-family:var(--font-display)">&lt; 24 Jam</div>
            <span class="text-muted-2 small">SOP Respon Admin</span>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="p-3 zp-card text-center" style="background:#f3e8ff">
            <div class="fw-bold h5 mb-0" style="font-family:var(--font-display)">200+</div>
            <span class="text-muted-2 small">Member Komunitas</span>
          </div>
        </div>
      </div>
    </div>

    <!-- 3 NILAI UTAMA PELAYANAN -->
    <div class="row g-4 mb-4">
      <div class="col-md-4 reveal">
        <div class="zp-card p-4 h-100">
          <div style="font-size:30px;margin-bottom:12px">🛡️</div>
          <h5 class="fw-bold mb-2">Garansi After-Sales</h5>
          <p class="text-muted-2 small mb-0">
            Akun premium dilindungi garansi 25–30 hari, sedangkan asistensi tugas dilengkapi hak gratis 1–2 kali revisi minor.
          </p>
        </div>
      </div>
      <div class="col-md-4 reveal">
        <div class="zp-card p-4 h-100">
          <div style="font-size:30px;margin-bottom:12px">⚡</div>
          <h5 class="fw-bold mb-2">Supplier First-Hand</h5>
          <p class="text-muted-2 small mb-0">
            Seluruh akun dan panel SMM bersumber dari supplier tangan pertama terverifikasi demi menjaga stabilitas layanan.
          </p>
        </div>
      </div>
      <div class="col-md-4 reveal">
        <div class="zp-card p-4 h-100">
          <div style="font-size:30px;margin-bottom:12px">🤝</div>
          <h5 class="fw-bold mb-2">Transparan &amp; Privat</h5>
          <p class="text-muted-2 small mb-0">
            Penghitungan fee transparan sesuai brief. Data diri dan file tugas pemesan dijamin 100% aman dan dirahasiakan.
          </p>
        </div>
      </div>
    </div>

    <!-- IDENTITAS OPERASIONAL LENGKAP -->
    <div class="zp-card p-4 reveal mb-4">
      <h3 class="h5 fw-bold mb-3">Informasi Operasional Bisnis</h3>
      <div class="row g-2 small text-muted-2">
        <div class="col-12 col-md-6 py-2 border-bottom" style="border-color:var(--zp-border-subtle)!important">
          <strong class="text-dark">Nama Brand:</strong> Zippy Store (Sebelumnya: Zippediastore)
        </div>
        <div class="col-12 col-md-6 py-2 border-bottom" style="border-color:var(--zp-border-subtle)!important">
          <strong class="text-dark">Domain Resmi:</strong> zippystore.my.id
        </div>
        <div class="col-12 col-md-6 py-2 border-bottom" style="border-color:var(--zp-border-subtle)!important">
          <strong class="text-dark">Badan Usaha:</strong> Penyedia Layanan Digital Independen (Freelance Agency)
        </div>
        <div class="col-12 col-md-6 py-2 border-bottom" style="border-color:var(--zp-border-subtle)!important">
          <strong class="text-dark">Target Audiens:</strong> Pelajar, Mahasiswa, &amp; Profesional Muda
        </div>
        <div class="col-12 col-md-6 py-2 border-bottom" style="border-color:var(--zp-border-subtle)!important">
          <strong class="text-dark">Metode Pembayaran:</strong> QRIS Instan (All E-Wallet &amp; Bank), BCA, Mandiri
        </div>
        <div class="col-12 col-md-6 py-2 border-bottom" style="border-color:var(--zp-border-subtle)!important">
          <strong class="text-dark">Saluran Utama:</strong> WhatsApp Chat &amp; Grup Komunitas (200+ Member)
        </div>
      </div>
    </div>

    <!-- SALURAN KONTAK RESMI -->
    <div class="zp-card p-4 text-center reveal">
      <h3 class="h5 fw-bold mb-2">Hubungi Tim Zippy Store</h3>
      <p class="text-muted-2 small mb-4">Punya pertanyaan atau ingin bermitra? Silakan hubungi saluran resmi kami di bawah ini:</p>
      <div class="d-flex flex-wrap justify-content-center gap-3">
        <a class="btn btn-outline-accent d-inline-flex align-items-center gap-2" href="<?= esc($wa) ?>" target="_blank" rel="noopener">
          <span>💬 WhatsApp Admin: <?= esc($set['no_wa'] ?? '+62 851-7783-8705') ?></span>
        </a>
        <a class="btn btn-outline-accent d-inline-flex align-items-center gap-2" href="<?= esc($set['tele_link'] ?? 'https://t.me/klddies') ?>" target="_blank" rel="noopener">
          <span>✈️ Telegram: <?= esc($set['tele_link'] ?? '@klddies') ?></span>
        </a>
        <a class="btn btn-outline-accent d-inline-flex align-items-center gap-2" href="<?= esc($set['twitter_link'] ?? '#') ?>" target="_blank" rel="noopener">
          <span>🐦 Twitter / X</span>
        </a>
        <a class="btn btn-outline-accent d-inline-flex align-items-center gap-2" href="<?= esc($set['ig_link'] ?? '#') ?>" target="_blank" rel="noopener">
          <span>📷 Instagram</span>
        </a>
      </div>
    </div>
  </div>
</section>

<?= $this->include('template/footer') ?>