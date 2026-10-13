<?php
$set = $pengaturan ?? [];
$waNumber = !empty($set['no_wa']) ? preg_replace('/[^0-9]/', '', $set['no_wa']) : '6285177838705';
$wa  = 'https://wa.me/' . $waNumber;
$namaToko = $set['nama_toko'] ?? 'Zippy Store';
?>
<footer class="footer pt-5 pb-4 mt-5">
  <div class="container">
    <div class="row gy-4 gx-lg-5 align-items-start">
      <!-- Brand & About -->
      <div class="col-12 col-md-4">
        <div class="footer-brand mb-2">
          <span class="brand-text"><?= esc($namaToko) ?></span>
          <span class="badge-est ms-2">EST. 2019</span>
        </div>
        <p class="text-muted-2 small mb-3" style="line-height:1.7">
          Penyedia Layanan Digital Independen untuk pelajar, mahasiswa, dan profesional muda. Menghubungkan kebutuhan tugas, aplikasi premium, dan optimasi digital sejak 2019 dengan ribuan transaksi sukses.
        </p>
        <div class="footer-status-pill d-inline-flex align-items-center gap-2">
          <span class="live-dot"></span>
          <span class="small text-muted-2">Respon Cepat &lt;24 Jam &bull; Layanan Terpercaya</span>
        </div>
      </div>

      <!-- 3 Pilar Layanan -->
      <div class="col-6 col-md-3">
        <h6 class="footer-heading mb-3">Layanan Utama</h6>
        <ul class="footer-links list-unstyled small mb-0">
          <li><a href="<?= base_url('joki') ?>">Asistensi Tugas &amp; Coding IT</a></li>
          <li><a href="<?= base_url('joki') ?>">Olah Data Excel &amp; Sheets</a></li>
          <li><a href="<?= base_url('joki') ?>">Pembuatan CV ATS &amp; Administrasi</a></li>
          <li><a href="<?= base_url('premium') ?>">Akun &amp; App Premium (Garansi)</a></li>
          <li><a href="<?= base_url('sosmed') ?>">Sosmed Growth (SMM Panel)</a></li>
          <li><a href="<?= base_url('otp') ?>">Sewa Nomor OTP Verifikasi</a></li>
        </ul>
      </div>

      <!-- Bantuan & Transaksi -->
      <div class="col-6 col-md-2">
        <h6 class="footer-heading mb-3">Panduan &amp; Bukti</h6>
        <ul class="footer-links list-unstyled small mb-0">
          <li><a href="<?= base_url('cara-pesan') ?>">Alur &amp; Cara Pesan</a></li>
          <li><a href="<?= base_url('testimonials') ?>">Testimoni Asli</a></li>
          <li><a href="<?= base_url('gallery') ?>">Galeri Pekerjaan</a></li>
          <li><a href="<?= base_url('tutorial') ?>">Tutorial Gratis</a></li>
          <li><a href="<?= base_url('about') ?>">Profil Bisnis</a></li>
        </ul>
      </div>

      <!-- Pembayaran & Kontak -->
      <div class="col-12 col-md-3">
        <h6 class="footer-heading mb-3">Metode Pembayaran</h6>
        <div class="payment-badges-wrap mb-3">
          <span class="badge-pay">⚡ QRIS</span>
          <span class="badge-pay">GoPay</span>
          <span class="badge-pay">OVO</span>
          <span class="badge-pay">Dana</span>
          <span class="badge-pay">ShopeePay</span>
          <span class="badge-pay">BCA</span>
          <span class="badge-pay">Mandiri</span>
        </div>
        <h6 class="footer-heading mb-2">Saluran Resmi</h6>
        <div class="d-flex gap-2">
          <a class="social-ico" href="<?= esc($set['ig_link'] ?? '#') ?>" target="_blank" rel="noopener" title="Instagram">IG</a>
          <a class="social-ico" href="<?= esc($set['tele_link'] ?? 'https://t.me/klddies') ?>" target="_blank" rel="noopener" title="Telegram">TG</a>
          <a class="social-ico" href="<?= esc($set['twitter_link'] ?? '#') ?>" target="_blank" rel="noopener" title="X (Twitter)">X</a>
          <a class="social-ico" href="<?= esc($wa) ?>" target="_blank" rel="noopener" title="WhatsApp">WA</a>
        </div>
      </div>
    </div>

    <!-- Bottom Bar -->
    <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 border-top mt-4 pt-3">
      <div class="text-muted-2 small">
        &copy; 2019 &ndash; <?= date('Y') ?> <strong><?= esc($namaToko) ?></strong> (zippystore.my.id). Hak Cipta Dilindungi.
      </div>
      <div class="text-muted-2 small">
        Penyedia Layanan Digital Independen &bull; Direct WhatsApp &amp; Komunitas
      </div>
    </div>
  </div>
</footer>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('js/script.js') ?>"></script>
</body>

</html>