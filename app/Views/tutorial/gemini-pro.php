<?= $this->include('template/header') ?>

<!-- Breadcrumb -->
<section style="padding-top:100px;padding-bottom:0">
  <div class="container">
    <nav aria-label="breadcrumb" class="reveal">
      <ol class="breadcrumb" style="font-size:14px">
        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>" style="color:var(--zp-accent)">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('tutorial') ?>" style="color:var(--zp-accent)">Tutorial</a></li>
        <li class="breadcrumb-item active text-muted-2" aria-current="page">Gemini PRO 1 Tahun</li>
      </ol>
    </nav>
  </div>
</section>

<!-- Hero Header -->
<section class="section" style="padding-top:20px;padding-bottom:40px">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8 reveal">
        <span class="badge rounded-pill px-3 py-2 mb-3" style="background:rgba(99,102,241,.15);color:var(--zp-accent)">🎓 TUTORIAL GRATIS</span>
        <h1 style="font-size:clamp(28px,4vw,42px);font-weight:800;line-height:1.2">
          🚀 Panduan Klaim Promo<br>
          <span class="text-grad">Gemini 12 Pro</span> <span style="color:var(--zp-text-2);font-weight:500;font-size:.6em">(Durasi 1 Tahun)</span>
        </h1>
        <p class="mt-3" style="color:var(--zp-text-2);font-size:17px;max-width:560px">
          Ikuti langkah-langkah di bawah ini secara berurutan untuk mendapatkan Gemini Pro selama 1 tahun penuh secara gratis.
        </p>
        <div class="d-flex flex-wrap gap-3 mt-3" style="font-size:14px;color:var(--zp-text-2)">
          <span>📖 3 Bagian</span>
          <span>⏱️ ~10 menit</span>
          <span>💰 100% Gratis</span>
        </div>
      </div>
      <div class="col-lg-4 text-center mt-4 mt-lg-0 reveal">
        <div class="tut-hero-icon">
          <span>🚀</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Tutorial Content -->
<section class="section" style="padding-top:0">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-9">

        <!-- ===== BAGIAN 1 ===== -->
        <div class="tut-section reveal" id="bagian-1">
          <div class="tut-section-header">
            <div class="tut-section-num">1</div>
            <div>
              <h2 class="tut-section-title">Aktivasi Bot</h2>
              <p class="tut-section-sub">Siapkan Telegram dan ikuti langkah berikut</p>
            </div>
          </div>

          <div class="tut-steps">
            <div class="tut-step reveal">
              <div class="tut-step-dot"></div>
              <div class="tut-step-content">
                <h4>Buka Link Bot Telegram</h4>
                <p>Klik atau buka tautan berikut untuk memulai:</p>
                <a href="https://t.me/gemini12pro_bot?start=inv_7G-7UA6RL68" target="_blank" class="tut-link-box">
                  <span class="tut-link-icon">🤖</span>
                  <span class="tut-link-text">
                    <strong>Gemini 12 Pro Bot</strong>
                    <small>t.me/gemini12pro_bot</small>
                  </span>
                  <span class="tut-link-arrow">→</span>
                </a>
              </div>
            </div>

            <div class="tut-step reveal">
              <div class="tut-step-dot"></div>
              <div class="tut-step-content">
                <h4>Mulai Bot</h4>
                <p>Setelah ruang obrolan terbuka, ketik atau klik tombol <code>/start</code>.</p>
              </div>
            </div>

            <div class="tut-step reveal">
              <div class="tut-step-dot"></div>
              <div class="tut-step-content">
                <h4>Bergabung ke Channel</h4>
                <p>Bot akan meminta Anda untuk masuk ke <strong>2 channel Telegram</strong> resmi. Silakan klik dan bergabung (join) ke kedua channel tersebut.</p>
              </div>
            </div>

            <div class="tut-step reveal">
              <div class="tut-step-dot"></div>
              <div class="tut-step-content">
                <h4>Konfirmasi Aktivasi</h4>
                <p>Jika sudah bergabung ke kedua channel, kembali ke bot lalu klik tombol <strong>Activation</strong>.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- ===== BAGIAN 2 ===== -->
        <div class="tut-section reveal" id="bagian-2">
          <div class="tut-section-header">
            <div class="tut-section-num">2</div>
            <div>
              <h2 class="tut-section-title">Proses Pengambilan Link Promo</h2>
              <p class="tut-section-sub">Ambil link promo Gemini Pro kamu</p>
            </div>
          </div>

          <div class="tut-steps">
            <div class="tut-step reveal">
              <div class="tut-step-dot"></div>
              <div class="tut-step-content">
                <h4>Siapkan Kode 2FA</h4>
                <p>Pastikan Anda sudah menyiapkan kode <strong>Two-Factor Authentication (2FA) Secret</strong> dari akun Google Anda (berupa <strong>32 digit karakter</strong>).</p>
                <div class="tut-warning">
                  <span>⚠️</span>
                  <span>Kode 2FA Secret berbeda dengan kode OTP 6 digit. Ini adalah kode master sepanjang 32 karakter yang Anda dapatkan saat pertama kali mengaktifkan 2FA.</span>
                </div>
              </div>
            </div>

            <div class="tut-step reveal">
              <div class="tut-step-dot"></div>
              <div class="tut-step-content">
                <h4>Masuk ke Menu Tugas</h4>
                <p>Di dalam bot, pilih dan klik menu secara berurutan:</p>
                <div class="tut-flow">
                  <span class="tut-flow-item">Start Task</span>
                  <span class="tut-flow-sep">→</span>
                  <span class="tut-flow-item">Extract Offer Link</span>
                  <span class="tut-flow-sep">→</span>
                  <span class="tut-flow-item">Use Balance</span>
                  <span class="tut-flow-sep">→</span>
                  <span class="tut-flow-item">Normal</span>
                </div>
              </div>
            </div>

            <div class="tut-step reveal">
              <div class="tut-step-dot"></div>
              <div class="tut-step-content">
                <h4>Kirim Data Akun</h4>
                <p>Masukkan data akun Google Anda ke dalam bot dengan format penulisan seperti di bawah ini (pisahkan dengan tiga tanda hubung <code>---</code> tanpa spasi):</p>
                <div class="tut-code-block">
                  <div class="tut-code-header">
                    <span>📋 Format Input</span>
                    <button class="tut-copy-btn" onclick="copyCode(this)" data-code="email---password---2FA secret (32 chars)">Copy</button>
                  </div>
                  <code>email---password---2FA secret (32 chars)</code>
                </div>
                <p class="mt-2" style="font-size:13px;color:var(--zp-text-2)">Contoh: <code>user@gmail.com---MyP@ss123---ABCDEFGHIJKLMNOPQRSTUVWXYZ234567</code></p>
              </div>
            </div>

            <div class="tut-step reveal">
              <div class="tut-step-dot"></div>
              <div class="tut-step-content">
                <h4>Tunggu Proses</h4>
                <p>Biarkan bot memproses data Anda selama beberapa saat. Jangan menutup chat Telegram selama proses berjalan.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- ===== BAGIAN 3 ===== -->
        <div class="tut-section reveal" id="bagian-3">
          <div class="tut-section-header">
            <div class="tut-section-num">3</div>
            <div>
              <h2 class="tut-section-title">Penyelesaian</h2>
              <p class="tut-section-sub">Klaim promo dan selesai!</p>
            </div>
          </div>

          <div class="tut-steps">
            <div class="tut-step reveal">
              <div class="tut-step-dot"></div>
              <div class="tut-step-content">
                <h4>Klaim Promo</h4>
                <p>Bot akan mengirimkan kembali sebuah <strong>tautan (link offer)</strong>. Klik link tersebut untuk langsung mengklaim promo Gemini Pro durasi 1 tahun.</p>
              </div>
            </div>

            <div class="tut-step reveal">
              <div class="tut-step-dot"></div>
              <div class="tut-step-content">
                <h4>Selesai! 🎉</h4>
                <p>Akun Anda kini sudah berhasil diaktifkan dengan <strong>Gemini Pro selama 1 tahun penuh</strong>.</p>
                <div class="tut-success">
                  <span>✅</span>
                  <span>Selamat! Anda berhasil mengaktifkan Gemini Pro.</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ===== TIPS ===== -->
        <div class="tut-tips reveal">
          <div class="tut-tips-header">
            <span>💡</span>
            <h3>Tips & Solusi Tambahan</h3>
          </div>

          <div class="tut-tip-item">
            <div class="tut-tip-icon">🌍</div>
            <div>
              <h5>Ganti Region Pembayaran</h5>
              <p>Ingin tahu cara mengubah region akun agar bisa melakukan pembayaran menggunakan <strong>DANA, GoPay, atau e-wallet</strong> lainnya? Langsung hubungi saya via DM!</p>
            </div>
          </div>

          <div class="tut-tip-item">
            <div class="tut-tip-icon">⚡</div>
            <div>
              <h5>Gak Mau Ribet?</h5>
              <p>Buat Anda yang malas melewati proses di atas, Anda bisa langsung membeli akun yang sudah jadi siap pakai dengan durasi <strong>1 Tahun penuh</strong> seharga:</p>
              <div class="tut-price-box mt-2">
                <div class="tut-price">Rp 50.000</div>
                <div class="tut-price-note">Akun jadi, siap pakai 1 tahun</div>
                <?php
                  $set = $pengaturan ?? [];
                  $wa  = !empty($set['no_wa']) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $set['no_wa']) . '?text=' . urlencode('Halo, saya mau beli akun Gemini Pro 1 Tahun') : '#';
                ?>
                <a href="<?= $wa ?>" target="_blank" class="btn btn-accent btn-sm px-4 mt-2">💬 Hubungi via WhatsApp</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Back -->
        <div class="text-center mt-5 reveal">
          <a href="<?= base_url('tutorial') ?>" class="btn btn-outline-accent px-4">← Kembali ke Tutorial</a>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- Copy function -->
<script>
function copyCode(btn){
  const code = btn.getAttribute('data-code');
  navigator.clipboard.writeText(code).then(()=>{
    btn.textContent='Copied!';
    setTimeout(()=>btn.textContent='Copy',2000);
  });
}
</script>

<?= $this->include('template/footer') ?>