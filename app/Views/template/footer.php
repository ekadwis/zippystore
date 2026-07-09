<?php
$set = $pengaturan ?? [];
$wa  = !empty($set['no_wa']) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $set['no_wa']) : '#';
$namaToko = $set['nama_toko'] ?? 'Zippy Store';
?>
<footer class="footer pt-5 pb-4 mt-5">
  <div class="container">
    <div class="row gy-4 align-items-start">
      <div class="col-md-5">
        <div class="navbar-brand fs-4"><?= esc($namaToko) ?><span>.</span></div>
        <p class="text-muted-2 mt-2" style="max-width:320px">
          <?= esc($set['deskripsi'] ?? 'Solusi digital termudah & termurah untuk kebutuhan harianmu.') ?>
        </p>
      </div>
      <div class="col-md-4">
        <div class="d-flex flex-wrap gap-3">
          <a href="<?= base_url('about') ?>">About</a>
          <a href="<?= base_url('testimonials') ?>">Testimonials</a>
          <a href="<?= base_url('cara-pesan') ?>">Cara Pesan</a>
          <a href="<?= base_url('gallery') ?>">Gallery</a>
          <a href="<?= base_url('tutorial') ?>">Tutorial</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="d-flex gap-2">
          <a class="social-ico" href="<?= esc($set['ig_link'] ?? '#') ?>" target="_blank">IG</a>
          <a class="social-ico" href="<?= esc($set['tele_link'] ?? '#') ?>" target="_blank">TG</a>
          <a class="social-ico" href="<?= esc($set['twitter_link'] ?? '#') ?>" target="_blank">X</a>
          <a class="social-ico" href="<?= esc($wa) ?>" target="_blank">WA</a>
        </div>
      </div>
    </div>
    <div class="text-center text-muted-2 border-top mt-4 pt-3" style="border-color:var(--zp-border)!important;font-size:13px">
      © <?= date('Y') ?> <?= esc($namaToko) ?>. All rights reserved.
    </div>
  </div>
</footer>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('js/script.js') ?>"></script>
</body>

</html>