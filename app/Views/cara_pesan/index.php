<?= $this->include('template/header') ?>

<?php
  $set = $pengaturan ?? [];
  $wa  = !empty($set['no_wa'])
       ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $set['no_wa'])
       : 'https://wa.me/6285177838705';
?>

<!-- HERO -->
<header class="section text-center" style="padding-top:140px">
  <div class="container">
    <h1 class="fw-bold reveal">Cara <span class="text-grad">Pemesanan</span></h1>
    <p class="text-muted-2 reveal mx-auto" style="max-width:640px">
      Pesan di Zippy Store gampang banget. Cukup 4 langkah, pesananmu langsung kami proses.
    </p>
  </div>
</header>

<!-- STATISTIK -->
<section class="pt-0" style="padding-bottom:32px">
  <div class="container">
    <div class="row g-4">
      <?php foreach ($statistik as $s): ?>
        <div class="col-6 col-lg-3">
          <div class="stat-box reveal">
            <div class="s-ico"><?= $s['icon'] ?></div>
            <div class="s-num text-grad"><?= esc($s['angka']) ?></div>
            <div class="s-lbl"><?= esc($s['label']) ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- LANGKAH PEMESANAN -->
<section class="section pt-4">
  <div class="container">
    <h2 class="section-title reveal">4 Langkah Mudah</h2>
    <p class="section-sub reveal">Dari pilih layanan sampai pesanan selesai</p>

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

<!-- CTA -->
<section class="pt-0">
  <div class="container">
    <div class="promo text-white text-center p-5 reveal">
      <h2 class="h3 mb-2">Siap Pesan Sekarang?</h2>
      <p class="mb-4 opacity-75">Tim kami siap membantu kamu via WhatsApp. Respon cepat, ramah, dan terpercaya.</p>
      <a href="<?= esc($wa) ?>" target="_blank" class="btn px-4 py-2">💬 Chat WhatsApp Sekarang</a>
    </div>
  </div>
</section>

<?= $this->include('template/footer') ?>