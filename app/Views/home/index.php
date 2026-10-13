<?= $this->include('template/header') ?>

<?php
$set = $pengaturan ?? [];
$waNumber = !empty($set['no_wa']) ? preg_replace('/[^0-9]/', '', $set['no_wa']) : '6285177838705';
$waLink   = 'https://wa.me/' . $waNumber;
?>

<!-- HERO SECTION (NEO-BRUTALIST CHUNKY POP) -->
<header class="hero">
  <div class="container text-center">
    <!-- Tag Pill -->
    <div class="hero-tag reveal">
      <span class="live-pulse"></span>
      <span>Penyedia Layanan Digital Independen Sejak 2019</span>
    </div>

    <!-- Main Headline -->
    <h1 class="reveal">
      Layanan Kebutuhan Digital, Aplikasi Premium,<br class="d-none d-lg-inline">
      &amp; Asistensi Tugas <span class="text-grad">Terpercaya Sejak 2019</span>
    </h1>

    <!-- Subtitle -->
    <p class="lead reveal">
      Solusi cepat, ramah, dan bersahabat untuk pelajar, mahasiswa, dan profesional muda. Dikerjakan transparan dengan format tiket bergaransi, respons &lt;24 jam, dan pembayaran instan via QRIS.
    </p>

    <!-- CTAs with Active Drop-down State -->
    <div class="d-flex justify-content-center gap-3 flex-wrap reveal mb-5">
      <a href="<?= esc($waLink) ?>" target="_blank" rel="noopener" class="btn btn-wa-hero px-4 py-2">
        💬 Chat WhatsApp Langsung
      </a>
      <a href="#tiket-layanan" class="btn btn-outline-accent px-4 py-2">
        Lihat Tiket Layanan ↓
      </a>
    </div>

    <!-- Trust Strip / Social Proof -->
    <div class="trust-strip reveal">
      <div class="trust-item">
        <div class="trust-item-icon">📅</div>
        <div class="trust-item-text text-start">
          <strong>5+ Tahun Pengalaman</strong>
          <span>Beroperasi Sejak 2019</span>
        </div>
      </div>
      <div class="trust-item">
        <div class="trust-item-icon" style="background:var(--accent-app)">🛡️</div>
        <div class="trust-item-text text-start">
          <strong>Garansi 25–30 Hari</strong>
          <span>Akun &amp; App Premium</span>
        </div>
      </div>
      <div class="trust-item">
        <div class="trust-item-icon" style="background:var(--accent-joki)">⚡</div>
        <div class="trust-item-text text-start">
          <strong>Respons &lt; 24 Jam</strong>
          <span>Admin Ramah &amp; Solutif</span>
        </div>
      </div>
      <div class="trust-item">
        <div class="trust-item-icon" style="background:var(--accent-sosmed)">💳</div>
        <div class="trust-item-text text-start">
          <strong>Instant QRIS</strong>
          <span>Semua E-Wallet &amp; Bank</span>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- JUMBOTRON FLASH SALE PROMO (INTERAKTIF) -->
<?= $this->include('components/flash_sale_banner') ?>

<!-- 3 PILAR LAYANAN: FORMAT TIKET LAYANAN / ORDER SLIP -->
<section id="tiket-layanan" class="section">
  <div class="container">
    <div class="text-center mb-5 reveal">
      <span class="badge-trust mb-2">FORMAT ORDER SLIP RESMI</span>
      <h2 class="section-title">Pilih Tiket Kebutuhanmu</h2>
      <p class="section-sub">
        Setiap layanan diterbitkan dengan nomor slip, cakupan jelas, dan jaminan after-sales aktif.
      </p>
    </div>

    <div class="row g-4 align-items-stretch">
      <!-- TIKET 1: ASISTENSI TUGAS & IT -->
      <div class="col-12 col-lg-4 reveal">
        <div class="ticket-slip ticket-joki">
          <!-- Ticket Header Bar -->
          <div class="ticket-header">
            <div>
              <span class="badge-joki">Hero Service</span>
            </div>
            <span class="ticket-id">SLIP: #ZP-JOKI-2019</span>
          </div>

          <!-- Ticket Content -->
          <div class="ticket-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div class="pillar-icon-box">💻</div>
              <span class="badge-trust" style="font-size:11.5px">⚡ Respons &lt; 24 Jam</span>
            </div>
            <h3 class="h4 mb-2">Asistensi &amp; Joki Tugas</h3>
            <p class="text-muted-2 small mb-3">
              Pendampingan dan pengerjaan tugas akademik maupun proyek profesional oleh tim spesialis. Skema pengerjaan transparan &amp; fleksibel.
            </p>

            <ul class="feature-check-list">
              <li>
                <span class="check-icon">✓</span>
                <span><strong>IT &amp; Coding:</strong> Web development, debug kode, skripsi IT.</span>
              </li>
              <li>
                <span class="check-icon">✓</span>
                <span><strong>Olah Data:</strong> Excel &amp; Google Sheets (rumus, visualisasi).</span>
              </li>
              <li>
                <span class="check-icon">✓</span>
                <span><strong>Administrasi:</strong> CV ATS-friendly &amp; surat-menyurat resmi.</span>
              </li>
              <li>
                <span class="check-icon">✓</span>
                <span><strong>Garansi:</strong> Gratis 1–2 kali revisi minor sesuai kesepakatan.</span>
              </li>
            </ul>
          </div>

          <!-- Ticket Perforated Divider & Notches -->
          <div class="ticket-perforated">
            <div class="ticket-notch-left"></div>
            <div class="ticket-notch-right"></div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="small fw-bold">Ketentuan DP:</span>
              <span class="badge-trust" style="background:#fef3c7;font-size:11px">Min. DP 50% via QRIS</span>
            </div>
            <a href="<?= base_url('joki') ?>" class="btn btn-accent w-100 py-2" style="background:var(--accent-joki)">
              Klaim Tiket Asistensi &rarr;
            </a>
          </div>
        </div>
      </div>

      <!-- TIKET 2: AKUN & APLIKASI PREMIUM -->
      <div class="col-12 col-lg-4 reveal">
        <div class="ticket-slip ticket-app">
          <!-- Ticket Header Bar -->
          <div class="ticket-header">
            <div>
              <span class="badge-app">Supplier First-Hand</span>
            </div>
            <span class="ticket-id">SLIP: #ZP-PREM-2019</span>
          </div>

          <!-- Ticket Content -->
          <div class="ticket-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div class="pillar-icon-box">🎬</div>
              <span class="badge-trust" style="font-size:11.5px">✓ Garansi 30 Hari</span>
            </div>
            <h3 class="h4 mb-2">Akun &amp; App Premium</h3>
            <p class="text-muted-2 small mb-3">
              Akses hiburan dan alat produktivitas resmi dari supplier tangan pertama (*first-hand*). Harga bersahabat dengan perlindungan garansi penuh.
            </p>

            <ul class="feature-check-list">
              <li>
                <span class="check-icon">✓</span>
                <span><strong>Streaming Musik:</strong> Spotify Premium (Family/Individual).</span>
              </li>
              <li>
                <span class="check-icon">✓</span>
                <span><strong>Streaming Film:</strong> Netflix UHD 4K &amp; YouTube Premium.</span>
              </li>
              <li>
                <span class="check-icon">✓</span>
                <span><strong>Editing Pro:</strong> CapCut Pro &amp; tools kreatif harian.</span>
              </li>
              <li>
                <span class="check-icon">✓</span>
                <span><strong>Klaim Cepat:</strong> Kendala login diganti/diperbaiki langsung via admin.</span>
              </li>
            </ul>
          </div>

          <!-- Ticket Perforated Divider & Notches -->
          <div class="ticket-perforated">
            <div class="ticket-notch-left"></div>
            <div class="ticket-notch-right"></div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="small fw-bold">Masa Garansi:</span>
              <span class="badge-trust" style="background:#d1fae5;font-size:11px">25–30 Hari Penuh</span>
            </div>
            <a href="<?= base_url('premium') ?>" class="btn btn-accent w-100 py-2" style="background:var(--accent-app)">
              Klaim Tiket App Premium &rarr;
            </a>
          </div>
        </div>
      </div>

      <!-- TIKET 3: SOCIAL MEDIA GROWTH -->
      <div class="col-12 col-lg-4 reveal">
        <div class="ticket-slip ticket-sosmed">
          <!-- Ticket Header Bar -->
          <div class="ticket-header">
            <div>
              <span class="badge-sosmed">Verified Panel</span>
            </div>
            <span class="ticket-id">SLIP: #ZP-SOSM-2019</span>
          </div>

          <!-- Ticket Content -->
          <div class="ticket-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div class="pillar-icon-box">🚀</div>
              <span class="badge-trust" style="font-size:11.5px">⚡ Proses Otomatis</span>
            </div>
            <h3 class="h4 mb-2">Social Media Growth</h3>
            <p class="text-muted-2 small mb-3">
              Optimasi interaksi (*social proof*) untuk profil pribadi, kreator konten, atau UMKM via panel SMM terverifikasi tangan pertama.
            </p>

            <ul class="feature-check-list">
              <li>
                <span class="check-icon">✓</span>
                <span><strong>Platform:</strong> Instagram, TikTok, YouTube, X, Threads.</span>
              </li>
              <li>
                <span class="check-icon">✓</span>
                <span><strong>Metrik Lengkap:</strong> Followers, Likes, Views, Shares.</span>
              </li>
              <li>
                <span class="check-icon">✓</span>
                <span><strong>Privasi Terjaga:</strong> Cukup kirim link profil, tanpa password.</span>
              </li>
              <li>
                <span class="check-icon">✓</span>
                <span><strong>Kalkulator Mandiri:</strong> Hitung sendiri biaya pesananmu real-time.</span>
              </li>
            </ul>
          </div>

          <!-- Ticket Perforated Divider & Notches -->
          <div class="ticket-perforated">
            <div class="ticket-notch-left"></div>
            <div class="ticket-notch-right"></div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="small fw-bold">Keamanan Akun:</span>
              <span class="badge-trust" style="background:#f3e8ff;font-size:11px">100% Tanpa Password</span>
            </div>
            <a href="<?= base_url('sosmed') ?>" class="btn btn-accent w-100 py-2" style="background:var(--accent-sosmed)">
              Klaim Tiket Sosmed Growth &rarr;
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- STATISTIK TRACTION NYATA -->
<?php if (!empty($statistik)): ?>
<section class="section pt-0">
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
<?php endif; ?>

<!-- SECTION ALUR QRIS & PERBANDINGAN TRANSPARAN (CHECKLIST & TABEL MODULAR) -->
<section class="section pt-0">
  <div class="container">
    <div class="text-center mb-5 reveal">
      <span class="badge-trust mb-2">METODE &amp; TRANSPARANSI BIAYA</span>
      <h2 class="section-title">Alur QRIS &amp; Perbandingan Transparan</h2>
      <p class="section-sub">
        Tidak ada biaya tersembunyi. Semua estimasi harga dan metode bayar dipaparkan secara jujur.
      </p>
    </div>

    <!-- Tabel Perbandingan Metode Bayar -->
    <div class="row g-4 mb-5">
      <div class="col-12 reveal">
        <div class="table-responsive">
          <table class="modular-table">
            <thead>
              <tr>
                <th style="width:25%">Metode Pembayaran</th>
                <th style="width:25%">Aplikasi yang Didukung</th>
                <th style="width:25%">Biaya Admin Tambahan</th>
                <th style="width:25%">Waktu Konfirmasi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <strong>⚡ QRIS Dinamis/Statis</strong><br>
                  <span class="badge-trust" style="font-size:11px;background:#dcfce7">Utama &amp; Tercepat</span>
                </td>
                <td>Semua E-Wallet (GoPay, OVO, Dana, ShopeePay, LinkAja) &amp; Semua M-Banking</td>
                <td><strong class="text-success">Rp 0 (Gratis)</strong></td>
                <td><strong>Instan (Langsung Terdeteksi)</strong></td>
              </tr>
              <tr>
                <td>
                  <strong>🏦 Transfer Bank BCA</strong><br>
                  <span class="text-muted-2 small">Bank Central Asia</span>
                </td>
                <td>BCA Mobile, myBCA, KlikBCA, ATM BCA</td>
                <td>Rp 0 (Sesama) / Sesuai Bank Pengirim</td>
                <td>1–5 Menit via Bukti Mutasi</td>
              </tr>
              <tr>
                <td>
                  <strong>🏦 Transfer Bank Mandiri</strong><br>
                  <span class="text-muted-2 small">Bank Mandiri</span>
                </td>
                <td>Livin' by Mandiri, ATM Mandiri, Internet Banking</td>
                <td>Rp 0 (Sesama) / Sesuai Bank Pengirim</td>
                <td>1–5 Menit via Bukti Mutasi</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Checklist Modular 4 Alur Pengerjaan -->
    <div class="row g-4">
      <?php
      $langkahHome = [
        [
          1,
          'Pilih Layanan & Brief',
          'Tentukan kebutuhanmu dan kirim detail tugas atau akun yang dicari.',
          'Form web atau WhatsApp',
        ],
        [
          2,
          'Cek Stok & Estimasi Fee',
          'Admin verifikasi stok atau menganalisis tingkat kesulitan tugas.',
          'Hitungan adil & transparan',
        ],
        [
          3,
          'Scan QRIS Instan',
          'Selesaikan pembayaran di muka via QRIS (semua e-wallet & bank).',
          'Konfirmasi otomatis',
        ],
        [
          4,
          'Delivery & Garansi',
          'Akun aktif atau tugas dikerjakan tepat waktu dengan hak revisi.',
          'Garansi 25–30 hari',
        ],
      ];
      foreach ($langkahHome as $l):
      ?>
        <div class="col-12 col-md-6 col-lg-3">
          <div class="step-card reveal">
            <div class="s-bgnum"><?= $l[0] ?></div>
            <div class="s-no"><?= $l[0] ?></div>
            <h3><?= esc($l[1]) ?></h3>
            <p class="mb-3"><?= esc($l[2]) ?></p>
            <span class="badge-trust" style="font-size:11px"><?= esc($l[3]) ?></span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- GALLERY PREVIEW -->
<?php if (!empty($galeri)): ?>
<section class="section pt-0">
  <div class="container">
    <div class="text-center mb-4 reveal">
      <h2 class="section-title">Dokumentasi &amp; Portofolio</h2>
      <p class="section-sub">Sampel pekerjaan surat, tugas akademik, konfigurasi akun, dan metrik sosmed yang telah kami selesaikan</p>
    </div>

    <?php
      if (!function_exists('_galSrc')) {
          function _galSrc($f) {
              if (empty($f)) return '';
              return (str_starts_with($f, 'http://') || str_starts_with($f, 'https://')) ? $f : base_url($f);
          }
      }
      $katLabel = ['surat'=>'Surat / Administrasi','tugas'=>'Asistensi Tugas','premium'=>'App Premium','sosmed'=>'Sosmed Boost'];
    ?>
    <div class="row g-3">
      <?php foreach (array_slice($galeri, 0, 4) as $g): ?>
        <div class="col-6 col-md-4 col-lg-3 reveal">
          <div class="zp-card p-0 overflow-hidden">
            <img src="<?= esc(_galSrc($g['file']), 'attr') ?>" alt="<?= esc($g['nama']) ?>" style="width:100%;height:180px;object-fit:cover;display:block" loading="lazy">
            <div class="p-3">
              <h6 class="mb-1" style="font-size:14px"><?= esc($g['nama']) ?></h6>
              <?php if (!empty($g['kategori'])): ?>
                <span class="badge-trust" style="font-size:11px;padding:2px 8px"><?= esc($katLabel[$g['kategori']] ?? ucfirst($g['kategori'])) ?></span>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="text-center mt-4 reveal">
      <a href="<?= base_url('gallery') ?>" class="btn btn-outline-accent px-4 py-2">Lihat Semua Galeri &rarr;</a>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- TUTORIAL GRATIS SECTION -->
<section class="section pt-0">
  <div class="container">
    <div class="text-center mb-4 reveal">
      <h2 class="section-title">Tutorial &amp; Panduan Gratis</h2>
      <p class="section-sub">Panduan langkah demi langkah yang bisa kamu ikuti sendiri secara mandiri tanpa biaya</p>
    </div>

    <div class="row g-4 justify-content-center">
      <div class="col-md-6 col-lg-4 reveal">
        <a href="<?= base_url('tutorial/gemini-pro') ?>" class="text-decoration-none">
          <div class="zp-card p-4 text-center">
            <div style="font-size:38px;margin-bottom:12px">🚀</div>
            <h5 class="mb-2">Gemini PRO 1 Tahun</h5>
            <p class="text-muted-2 small mb-3">Cara klaim promo Gemini 1.5/2.0 Pro gratis selama 1 tahun via bot Telegram resmi.</p>
            <span class="badge-app">100% GRATIS</span>
          </div>
        </a>
      </div>
      <div class="col-md-6 col-lg-4 reveal">
        <a href="<?= base_url('tutorial/cloudflare-glm') ?>" class="text-decoration-none">
          <div class="zp-card p-4 text-center">
            <div style="font-size:38px;margin-bottom:12px">☁️</div>
            <h5 class="mb-2">Claim GLM 5.2 &amp; Kimi</h5>
            <p class="text-muted-2 small mb-3">Akses model AI tingkat lanjut via Cloudflare Workers AI tanpa ribet setup kartu kredit.</p>
            <span class="badge-app">100% GRATIS</span>
          </div>
        </a>
      </div>
    </div>
    <div class="text-center mt-4 reveal">
      <a href="<?= base_url('tutorial') ?>" class="btn btn-outline-accent px-4 py-2">Lihat Semua Tutorial &rarr;</a>
    </div>
  </div>
</section>

<!-- TESTIMONI ASLI -->
<section class="section pt-0">
  <div class="container">
    <div class="text-center mb-4 reveal">
      <h2 class="section-title">Apa Kata Mereka?</h2>
      <p class="section-sub">Ulasan dan cerita nyata dari pelanggan yang sudah dibantu oleh tim Zippy Store</p>
    </div>

    <?php if (!empty($testimoni)): ?>
      <div class="row g-4">
        <?php foreach (array_slice($testimoni, 0, 3) as $t): ?>
          <div class="col-md-6 col-lg-4 reveal">
            <div class="zp-card p-4">
              <div class="d-flex align-items-center gap-3 mb-3">
                <div style="width:44px;height:44px;border-radius:8px;background:var(--accent-main);border:2px solid var(--zp-border-solid);box-shadow:2px 2px 0px 0px #18181b;display:flex;align-items:center;justify-content:center;color:#18181b;font-weight:900;font-size:18px">
                  <?= strtoupper(substr($t['nama'] ?? 'U', 0, 1)) ?>
                </div>
                <div>
                  <h6 class="mb-0" style="font-size:14px"><?= esc($t['nama']) ?></h6>
                  <?php if (!empty($t['layanan'])): ?>
                    <small class="text-muted-2"><?= esc($t['layanan']) ?></small>
                  <?php endif; ?>
                </div>
              </div>
              <p class="small mb-0" style="color:var(--zp-ink-2);line-height:1.6">&ldquo;<?= esc($t['pesan'] ?? $t['isi'] ?? '') ?>&rdquo;</p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="text-center mt-4 reveal">
        <a href="<?= base_url('testimonials') ?>" class="btn btn-outline-accent px-4 py-2">Lihat Bukti &amp; Arsip Testimoni &rarr;</a>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- FAQ SECTION (NEO-BRUTALIST TILES) -->
<section class="section pt-0">
  <div class="container" style="max-width:840px">
    <div class="text-center mb-5 reveal">
      <span class="badge-trust mb-2">JAWABAN KEBUTUHANMU</span>
      <h2 class="section-title">Pertanyaan Sering Diajukan (FAQ)</h2>
      <p class="section-sub">
        Informasi seputar SOP garansi, alur revisi tugas, dan metode pembayaran yang perlu kamu ketahui.
      </p>
    </div>

    <div class="reveal">
      <?php foreach ($faqList as $idx => $f): ?>
        <div class="faq-card">
          <div class="faq-question">
            <span class="q-tag">Q</span>
            <span><?= esc($f['q']) ?></span>
          </div>
          <p class="faq-answer">
            <?= esc($f['a']) ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Direct CTA to WhatsApp -->
    <div class="mt-5 text-center p-4 zp-card reveal" style="border:2px dashed var(--zp-border-solid);background:var(--zp-bg-subtle)">
      <h4 class="h5 mb-2">Masih Ada Pertanyaan yang Belum Terjawab?</h4>
      <p class="text-muted-2 small mb-3">Admin kami siap diajak diskusi santai untuk mencocokkan kebutuhan dan anggaranmu.</p>
      <a href="<?= esc($waLink) ?>" target="_blank" rel="noopener" class="btn btn-wa-hero px-4 py-2">
        💬 Tanya Admin via WhatsApp Langsung
      </a>
    </div>
  </div>
</section>

<?= $this->include('template/footer') ?>