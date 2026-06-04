<?= $this->include('template/header') ?>

<!-- HERO -->
<header class="hero">
  <div class="container">
    <h1>Solusi Digital <span class="text-grad">Termudah</span><br>& Termurah!</h1>
    <p class="my-4">Dari tugas sekolah sampai kebutuhan digital harian, semuanya ada di Zippy Store!</p>
    <div class="d-flex gap-3 flex-wrap">
      <a href="#layanan" class="btn btn-accent px-4 py-2">Lihat Produk</a>
      <a href="<?= base_url('about') ?>" class="btn btn-outline-accent px-4 py-2">Tentang Kami</a>
    </div>
  </div>
</header>

<!-- LAYANAN -->
<section id="layanan" class="section">
  <div class="container">
    <h2 class="section-title reveal">Layanan Kami</h2>
    <p class="section-sub reveal">Pilih layanan sesuai kebutuhanmu</p>

    <?php if (!empty($layanan)): ?>
      <div class="row g-4">
        <?php foreach ($layanan as $l): ?>
          <div class="col-6 col-lg-3">
            <div class="zp-card p-4 reveal">
              <div class="icon mb-3"><?= esc($l['icon'] ?? '✨') ?></div>
              <h3 class="h5"><?= esc($l['nama']) ?></h3>
              <p class="text-muted-2 small"><?= esc($l['deskripsi']) ?></p>
              <?php
              // Arahkan tiap layanan ke halaman khususnya
              switch ($l['slug']) {
                case 'sosmed-boost':
                  $linkLayanan = base_url('sosmed');
                  break;
                case 'joki-tugas':
                  $linkLayanan = base_url('joki');
                  break;
                case 'app-premium':
                  $linkLayanan = base_url('premium');
                  break;
                case 'nomor-otp':
                  $linkLayanan = base_url('otp');
                  break;
                default:
                  $linkLayanan = base_url('gallery?kategori=' . esc($l['slug'], 'url'));
                  break;
              }
              ?>
              <a href="<?= $linkLayanan ?>" class="btn btn-outline-accent btn-sm">Lihat Selengkapnya</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="empty">
        <div class="em">🗂️</div>Layanan belum tersedia.
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- STATISTIK (landing) -->
<?php if (!empty($statistik)): ?>
<section class="section pt-0">
  <div class="container">
    <div class="row g-4">
      <?php foreach ($statistik as $s): ?>
        <div class="col-6 col-lg-3">
          <div class="stat-box reveal">
            <div class="s-ico"><?= esc($s['icon']) ?></div>
            <div class="s-num text-grad"><?= esc($s['angka']) ?></div>
            <div class="s-lbl"><?= esc($s['label']) ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- CARA PESAN RINGKAS (landing) -->
<section class="section pt-0">
  <div class="container">
    <h2 class="section-title reveal">Cara Pesan</h2>
    <p class="section-sub reveal">Gampang, cuma 4 langkah</p>
    <div class="row g-4">
      <?php
      $langkahHome = [
        [1, 'Pilih Layanan', 'Tentukan produk yang kamu butuhkan.'],
        [2, 'Chat WhatsApp', 'Hubungi admin & sampaikan detail pesanan.'],
        [3, 'Pembayaran', 'Bayar sesuai harga yang disepakati.'],
        [4, 'Diproses', 'Pesanan langsung kami kerjakan.'],
      ];
      foreach ($langkahHome as $l):
      ?>
        <div class="col-12 col-md-6 col-lg-3">
          <div class="step-card reveal">
            <div class="s-bgnum"><?= $l[0] ?></div>
            <div class="s-no"><?= $l[0] ?></div>
            <h3><?= $l[1] ?></h3>
            <p><?= $l[2] ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="text-center mt-4 reveal">
      <a href="<?= base_url('cara-pesan') ?>" class="btn btn-outline-accent px-4">Lihat Selengkapnya</a>
    </div>
  </div>
</section>

<!-- PROMO -->
<section class="pb-5">
  <div class="container">
    <div class="promo text-white text-center p-5 reveal">
      <h2 class="h3 mb-2">🎉 Diskon 20% untuk pemesanan pertama!</h2>
      <p class="mb-4 opacity-75">Khusus pelanggan baru. Jangan sampai kelewatan.</p>
      <a href="<?= base_url('testimonials') ?>" class="btn px-4 py-2">Ambil Voucher</a>
    </div>
  </div>
</section>

<!-- CLIENTS -->
<section class="section pt-0">
  <div class="container">
    <h2 class="section-title reveal">Yang Pernah Kami Bantu</h2>
    <p class="section-sub reveal">Client &amp; project yang telah mempercayai kami</p>

    <?php if (!empty($clients)): ?>
      <div class="row g-4">
        <?php foreach ($clients as $c): ?>
          <div class="col-6 col-lg-3">
            <div class="zp-card p-4 text-center reveal">
              <?php if (!empty($c['logo'])): ?>
                <img src="<?= base_url($c['logo']) ?>" alt="<?= esc($c['nama']) ?>" style="height:60px;object-fit:contain" class="mx-auto mb-3">
              <?php endif; ?>
              <h3 class="h6 mb-0"><?= esc($c['nama']) ?></h3>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="empty reveal">
        <div class="em">🚀</div>Akan segera hadir!
      </div>
    <?php endif; ?>
  </div>
</section>

<?= $this->include('template/footer') ?>