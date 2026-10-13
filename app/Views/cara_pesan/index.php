<?= $this->include('template/header') ?>

<?php
  $set = $pengaturan ?? [];
  $waNumber = !empty($set['no_wa']) ? preg_replace('/[^0-9]/', '', $set['no_wa']) : '6285177838705';
  $wa  = 'https://wa.me/' . $waNumber;
?>

<!-- HERO -->
<header class="section text-center" style="padding-top:140px;padding-bottom:40px">
  <div class="container">
    <div class="d-inline-flex align-items-center gap-2 mb-3 reveal">
      <span class="badge-trust">SOP TRANSAKSI RESMI</span>
      <span class="badge-trust">⚡ Instant QRIS</span>
    </div>
    <h1 class="fw-bold reveal">
      Alur Pemesanan &amp; <span class="text-grad">Pembayaran Transparan</span>
    </h1>
    <p class="text-muted-2 reveal mx-auto" style="max-width:640px">
      Sederhana, aman, dan tanpa birokrasi berbelit. Kami mendampingi setiap langkah transaksi dengan respon &lt;24 jam dan konfirmasi instan.
    </p>
  </div>
</header>

<!-- STATISTIK TRACTION -->
<section class="pt-0 pb-4">
  <div class="container">
    <div class="row g-4">
      <?php foreach ($statistik as $s): ?>
        <div class="col-6 col-lg-3">
          <div class="stat-box reveal">
            <div class="s-ico"><?= esc($s['icon']) ?></div>
            <div class="s-num"><?= esc($s['angka']) ?></div>
            <div class="s-lbl"><?= esc($s['label']) ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 4 LANGKAH PEMESANAN -->
<section class="section pt-3">
  <div class="container">
    <div class="text-center mb-5 reveal">
      <span class="badge-trust mb-2">PANDUAN LANGKAH DEMI LANGKAH</span>
      <h2 class="section-title">4 Tahap Menuju Pesanan Selesai</h2>
      <p class="section-sub">
        Setiap pesanan diproses berdasarkan brief yang disepakati bersama.
      </p>
    </div>

    <div class="row g-4">
      <?php foreach ($langkah as $l): ?>
        <div class="col-12 col-md-6 col-lg-3">
          <div class="step-card reveal">
            <div class="s-bgnum"><?= $l['no'] ?></div>
            <div class="s-no"><?= $l['no'] ?></div>
            <h3><?= esc($l['judul']) ?></h3>
            <p><?= esc($l['desc']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- PANDUAN PEMBAYARAN QRIS & BANK -->
<section class="section pt-0">
  <div class="container">
    <div class="zp-card p-4 p-md-5 reveal">
      <div class="row gy-4 align-items-center">
        <div class="col-12 col-lg-6">
          <span class="badge-trust mb-3">METODE PEMBAYARAN RESMI</span>
          <h2 class="h3 mb-3 fw-bold">Pembayaran Instan via QRIS &amp; Transfer Bank</h2>
          <p class="text-muted-2 small mb-4" style="line-height:1.7">
            Untuk kecepatan transaksi, Zippy Store menggunakan <strong>QRIS Dinamis/Statis</strong> yang dapat dipindai oleh semua aplikasi pembayaran di Indonesia tanpa biaya admin tambahan dari pihak kami.
          </p>

          <div class="d-flex flex-column gap-3">
            <div class="d-flex align-items-center gap-3 p-3 zp-card" style="background:#eff6ff">
              <span style="font-size:26px">⚡</span>
              <div>
                <strong class="d-block small">QRIS (All E-Wallet &amp; Mobile Banking)</strong>
                <span class="text-muted-2" style="font-size:12px">GoPay, OVO, Dana, ShopeePay, LinkAja, BCA Mobile, Livin' by Mandiri, BRImo, BNI Mobile, dll.</span>
              </div>
            </div>
            <div class="d-flex align-items-center gap-3 p-3 zp-card" style="background:#eff6ff">
              <span style="font-size:26px">🏦</span>
              <div>
                <strong class="d-block small">Transfer Rekening Bank</strong>
                <span class="text-muted-2" style="font-size:12px">Bank Central Asia (BCA) &amp; Bank Mandiri (Nomor rekening diberikan saat konfirmasi order).</span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-6">
          <div class="p-4 zp-card" style="background:#fafafa">
            <h3 class="h6 mb-3 fw-bold">Ketentuan Pembayaran &amp; DP:</h3>
            <ul class="ketentuan-list">
              <li>
                <span class="k-ico">✓</span>
                <span><strong>Akun Premium &amp; SMM Boost:</strong> Wajib *full payment* di muka sebelum akun diserahkan atau metrik disuntikkan.</span>
              </li>
              <li>
                <span class="k-ico">✓</span>
                <span><strong>Jasa Joki &amp; Asistensi Tugas:</strong> Menerima skema Down Payment (DP) minimal 50% sebelum pengerjaan dimulai, dan pelunasan saat tugas selesai sebelum penyerahan final.</span>
              </li>
              <li>
                <span class="k-ico">✓</span>
                <span><strong>Bukti Pembayaran:</strong> Cukup kirimkan tangkapan layar (screenshot) mutasi transfer atau bukti berhasil QRIS ke chat admin WhatsApp.</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ TRANSAKSI -->
<section class="section pt-0">
  <div class="container" style="max-width:840px">
    <div class="text-center mb-5 reveal">
      <h2 class="section-title">Hal yang Sering Ditanyakan Mengenai Transaksi</h2>
      <p class="section-sub">Kejelasan aturan transaksi demi kenyamanan bersama</p>
    </div>

    <div class="reveal">
      <div class="faq-card">
        <div class="faq-question">
          <span style="color:var(--zp-accent)">Q.</span>
          <span>Berapa lama waktu yang dibutuhkan setelah saya transfer?</span>
        </div>
        <p class="faq-answer ms-4">
          Untuk akun premium yang ready stock, penyerahan dilakukan dalam 10 hingga 30 menit. Untuk joki tugas, proses pengerjaan langsung dijadwalkan sesuai target deadline yang telah disepakati bersama.
        </p>
      </div>

      <div class="faq-card">
        <div class="faq-question">
          <span style="color:var(--zp-accent)">Q.</span>
          <span>Apakah bisa membatalkan pesanan?</span>
        </div>
        <p class="faq-answer ms-4">
          Jika stok akun habis atau tugas tidak memungkinkan kami kerjakan, dana Anda akan dikembalikan 100%. Namun jika pengerjaan tugas sudah berjalan dan dibatalkan secara sepihak oleh klien, maka DP yang telah disetor tidak dapat ditarik kembali.
        </p>
      </div>

      <div class="faq-card">
        <div class="faq-question">
          <span style="color:var(--zp-accent)">Q.</span>
          <span>Bagaimana cara klaim revisi setelah tugas diterima?</span>
        </div>
        <p class="faq-answer ms-4">
          Pelanggan memiliki hak gratis 1–2 kali revisi minor yang relevan dengan kesepakatan awal. Cukup sampaikan bagian mana saja yang perlu disesuaikan via WhatsApp, dan tim kami akan segera mengerjakannya.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="pt-0">
  <div class="container">
    <div class="zp-card text-center p-5 reveal" style="border:1px solid #33364c;background:linear-gradient(135deg,#10111a,#171926)">
      <span class="badge-trust mb-3">MULAI TRANSAKSI SEKARANG</span>
      <h2 class="h3 text-white mb-2">Ada Tugas Mendesak atau Butuh Akun Premium Hari Ini?</h2>
      <p class="text-muted-2 small mb-4 mx-auto" style="max-width:540px">
        Admin Zippy Store siap merespon konsultasimu secara ramah, santai, dan cepat.
      </p>
      <a href="<?= esc($wa) ?>" target="_blank" rel="noopener" class="btn btn-wa-hero px-4 py-2">
        💬 Hubungi Admin via WhatsApp
      </a>
    </div>
  </div>
</section>

<?= $this->include('template/footer') ?>