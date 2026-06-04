<?= $this->include('template/header') ?>

<header class="section text-center" style="padding-top:140px">
  <div class="container">
    <h1 class="fw-bold reveal">Tentang <span class="text-grad">Zippy Store</span></h1>
    <p class="text-muted-2 reveal mx-auto" style="max-width:640px">Partner digital andalan untuk pelajar, mahasiswa, dan content creator.</p>
  </div>
</header>

<section class="section pt-0">
  <div class="container" style="max-width:760px">
    <div class="reveal">
      <p class="text-muted-2">Zippy Store hadir sebagai solusi digital yang mudah, cepat, dan terjangkau. Kami membantu kebutuhan harianmu — mulai dari tugas sekolah &amp; kuliah, aplikasi premium, peningkatan sosial media, hingga nomor OTP.</p>
      <p class="text-muted-2">Dengan harga bersahabat dan pelayanan yang ramah, kami berkomitmen memberikan pengalaman terbaik untuk setiap pelanggan.</p>
    </div>
  </div>
</section>

<section class="section pt-0">
  <div class="container">
    <h2 class="section-title reveal">Layanan Kami</h2>
    <p class="section-sub reveal">Apa saja yang bisa kami bantu</p>
    <?php if (!empty($layanan)): ?>
      <div class="row g-4">
        <?php foreach ($layanan as $l): ?>
          <div class="col-6 col-lg-3">
            <div class="zp-card p-4 reveal">
              <div class="icon mb-3"><?= esc($l['icon'] ?? '✨') ?></div>
              <h3 class="h5"><?= esc($l['nama']) ?></h3>
              <p class="text-muted-2 small mb-0"><?= esc($l['deskripsi']) ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<section class="section pt-0">
  <div class="container" style="max-width:480px">
    <h2 class="section-title reveal">Hubungi Kami</h2>
    <?php $set = $pengaturan ?? []; ?>
    <div class="d-grid gap-3 mt-4 reveal">
      <div class="zp-card p-3">📷 Instagram: <a class="text-grad" href="<?= esc($set['ig_link'] ?? '#') ?>" target="_blank">@zippy_store</a></div>
      <div class="zp-card p-3">✈️ Telegram: <a class="text-grad" href="<?= esc($set['tele_link'] ?? '#') ?>" target="_blank">@zippy_store</a></div>
      <div class="zp-card p-3">🐦 Twitter: <a class="text-grad" href="<?= esc($set['twitter_link'] ?? '#') ?>" target="_blank">@zippy_store</a></div>
      <div class="zp-card p-3">💬 WhatsApp: <a class="text-grad" href="<?= !empty($set['no_wa']) ? 'https://wa.me/'.preg_replace('/[^0-9]/','',$set['no_wa']) : '#' ?>" target="_blank"><?= esc($set['no_wa'] ?? '+62 857-xxxx-xxxx') ?></a></div>
    </div>
  </div>
</section>

<?= $this->include('template/footer') ?>