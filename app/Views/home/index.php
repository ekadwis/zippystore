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

<!-- GALLERY PREVIEW -->
<section class="section pt-0">
  <div class="container">
    <h2 class="section-title reveal">📸 Contoh Produk</h2>
    <p class="section-sub reveal">Beberapa hasil produk & layanan yang telah kami kerjakan</p>

    <?php if (!empty($galeri)): ?>
      <?php
        // Helper to resolve gallery image src (same as gallery page)
        if (!function_exists('_galSrc')) {
            function _galSrc($f) {
                if (empty($f)) return '';
                return (str_starts_with($f, 'http://') || str_starts_with($f, 'https://')) ? $f : base_url($f);
            }
        }
        $katLabel = ['surat'=>'Surat','tugas'=>'Tugas','premium'=>'Premium','sosmed'=>'Sosmed'];
      ?>
      <div class="row g-3">
        <?php foreach (array_slice($galeri, 0, 4) as $g): ?>
          <div class="col-6 col-md-4 col-lg-3 reveal">
            <div class="zp-card p-0 overflow-hidden" style="border-radius:12px">
              <img src="<?= esc(_galSrc($g['file']), 'attr') ?>" alt="<?= esc($g['nama']) ?>" style="width:100%;height:180px;object-fit:cover;display:block" loading="lazy">
              <div class="p-3">
                <h6 class="mb-1" style="font-size:14px"><?= esc($g['nama']) ?></h6>
                <?php if (!empty($g['kategori'])): ?>
                  <span class="badge rounded-pill" style="background:rgba(99,102,241,.15);color:var(--zp-accent);font-size:11px"><?= esc($katLabel[$g['kategori']] ?? ucfirst($g['kategori'])) ?></span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="text-center mt-4 reveal">
        <a href="<?= base_url('gallery') ?>" class="btn btn-outline-accent px-4">Lihat Semua Galeri →</a>
      </div>
    <?php else: ?>
      <div class="empty reveal">
        <div class="em">📷</div>Galeri belum tersedia.
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- TUTORIAL GRATIS -->
<section class="section pt-0">
  <div class="container">
    <h2 class="section-title reveal">🎓 Tutorial Gratis</h2>
    <p class="section-sub reveal">Panduan lengkap yang bisa kamu ikuti sendiri — 100% gratis!</p>

    <div class="row g-4 justify-content-center">
      <div class="col-md-6 col-lg-4 reveal">
        <a href="<?= base_url('tutorial/gemini-pro') ?>" class="text-decoration-none">
          <div class="zp-card p-4 text-center">
            <div style="font-size:40px;margin-bottom:12px">🚀</div>
            <h5 class="mb-2">Gemini PRO 1 Tahun</h5>
            <p class="text-muted-2 small mb-2">Klaim Gemini 12 Pro gratis selama 1 tahun lewat Bot Telegram.</p>
            <span class="badge rounded-pill" style="background:rgba(16,185,129,.15);color:#10b981">GRATIS</span>
          </div>
        </a>
      </div>
      <div class="col-md-6 col-lg-4 reveal">
        <a href="<?= base_url('tutorial/cloudflare-glm') ?>" class="text-decoration-none">
          <div class="zp-card p-4 text-center">
            <div style="font-size:40px;margin-bottom:12px">☁️</div>
            <h5 class="mb-2">Claim GLM 5.2 & Kimi</h5>
            <p class="text-muted-2 small mb-2">Akses model AI premium via Cloudflare Workers AI tanpa biaya.</p>
            <span class="badge rounded-pill" style="background:rgba(16,185,129,.15);color:#10b981">GRATIS</span>
          </div>
        </a>
      </div>
    </div>
    <div class="text-center mt-4 reveal">
      <a href="<?= base_url('tutorial') ?>" class="btn btn-outline-accent px-4">Lihat Semua Tutorial →</a>
    </div>
  </div>
</section>

<!-- TESTIMONI -->
<section class="section pt-0">
  <div class="container">
    <h2 class="section-title reveal">💬 Yang Pernah Kami Bantu</h2>
    <p class="section-sub reveal">Cerita langsung dari pelanggan yang sudah merasakan layanan kami</p>

    <?php if (!empty($testimoni)): ?>
      <div class="row g-4">
        <?php foreach (array_slice($testimoni, 0, 4) as $t): ?>
          <div class="col-md-6 col-lg-4 reveal">
            <div class="zp-card p-4">
              <div class="d-flex align-items-center gap-3 mb-3">
                <div style="width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,var(--zp-accent),#818cf8);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:18px">
                  <?= strtoupper(substr($t['nama'] ?? 'U', 0, 1)) ?>
                </div>
                <div>
                  <h6 class="mb-0" style="font-size:14px"><?= esc($t['nama']) ?></h6>
                  <?php if (!empty($t['layanan'])): ?>
                    <small class="text-muted-2"><?= esc($t['layanan']) ?></small>
                  <?php endif; ?>
                </div>
              </div>
              <p class="small mb-0" style="color:var(--zp-text-2)">"<?= esc($t['pesan'] ?? $t['isi'] ?? '') ?>"</p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="text-center mt-4 reveal">
        <a href="<?= base_url('testimonials') ?>" class="btn btn-outline-accent px-4">Lihat Semua Testimoni →</a>
      </div>
    <?php else: ?>
      <div class="empty reveal">
        <div class="em">💬</div>Testimoni belum tersedia.
      </div>
    <?php endif; ?>
  </div>
</section>

<?= $this->include('template/footer') ?>