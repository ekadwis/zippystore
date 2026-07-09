<?= $this->include('template/header') ?>

<!-- Breadcrumb -->
<section style="padding-top:100px;padding-bottom:0">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0" style="font-size:14px">
        <li class="breadcrumb-item"><a href="<?= base_url('tutorial') ?>" style="color:var(--zp-accent)">Tutorial</a></li>
        <li class="breadcrumb-item active">Claim GLM 5.2 & Kimi via Cloudflare</li>
      </ol>
    </nav>
  </div>
</section>

<!-- Hero -->
<section class="section" style="padding-top:32px">
  <div class="container" style="max-width:820px">

    <div class="text-center mb-5 reveal">
      <div class="tut-hero-icon mb-4" style="background:linear-gradient(135deg,rgba(245,158,11,.2),rgba(99,102,241,.2))">☁️</div>
      <span class="badge rounded-pill px-3 py-2 mb-3" style="background:rgba(245,158,11,.15);color:#f59e0b">🎁 BANSOS GRATIS</span>
      <h1 class="fw-bold mb-3" style="font-size:clamp(26px,4vw,38px)">Cara Klaim <span class="text-grad">GLM 5.2</span> & <span class="text-grad">Kimi 2.7</span> via Cloudflare</h1>
      <p class="text-muted-2 mx-auto" style="max-width:580px;font-size:16px">
        Manfaatkan program Workers AI dari Cloudflare untuk mengakses model AI premium secara gratis. Cocok dipakai bareng OpenCode buat coding assistant!
      </p>
      <div class="d-flex justify-content-center gap-3 mt-3 flex-wrap" style="font-size:14px;color:var(--zp-text-2)">
        <span>📖 2 Bagian</span>
        <span>⏱️ ~8 menit</span>
        <span>💰 Rp 0</span>
      </div>
    </div>

    <!-- ========================== -->
    <!-- BAGIAN 1: Setup Cloudflare -->
    <!-- ========================== -->
    <div class="tut-section reveal">
      <div class="tut-section-header">
        <div class="tut-section-num">1</div>
        <div>
          <h2 class="tut-section-title">Siapkan API Token Cloudflare</h2>
          <p class="tut-section-sub">Registrasi akun & buat token Workers AI dalam beberapa langkah mudah</p>
        </div>
      </div>

      <div class="tut-steps">

        <!-- Step 1.1 -->
        <div class="tut-step">
          <div class="tut-step-dot"></div>
          <div class="tut-step-content">
            <h4>Buat Akun Cloudflare</h4>
            <p>Kalau belum punya akun, buka <strong>cloudflare.com</strong> dan daftar gratis. Cukup pakai email aktif dan buat password. Nggak perlu kartu kredit sama sekali.</p>
            <a href="https://dash.cloudflare.com/sign-up" target="_blank" class="tut-link-box mt-2">
              <div class="tut-link-icon">☁️</div>
              <div class="tut-link-text">
                <strong>Cloudflare Sign Up</strong>
                <small>dash.cloudflare.com/sign-up</small>
              </div>
              <div class="tut-link-arrow">→</div>
            </a>
          </div>
        </div>

        <!-- Step 1.2 -->
        <div class="tut-step">
          <div class="tut-step-dot"></div>
          <div class="tut-step-content">
            <h4>Masuk ke Menu Workers AI</h4>
            <p>Setelah login ke Dashboard Cloudflare, lihat sidebar kiri. Cari dan klik menu <code>Workers AI</code>. Di sinilah semua fitur AI inference dari Cloudflare bisa diakses.</p>
          </div>
        </div>

        <!-- Step 1.3 -->
        <div class="tut-step">
          <div class="tut-step-dot"></div>
          <div class="tut-step-content">
            <h4>Buka Halaman REST API</h4>
            <p>Di dalam Workers AI, klik tab <code>REST API</code>. Kamu akan diarahkan ke halaman panduan <strong>"Using Workers AI REST API"</strong>. Halaman ini berisi semua yang kamu butuhkan.</p>
          </div>
        </div>

        <!-- Step 1.4 -->
        <div class="tut-step">
          <div class="tut-step-dot"></div>
          <div class="tut-step-content">
            <h4>Generate API Token</h4>
            <p>Pada halaman REST API tadi, klik tombol <strong>"Create a Workers AI API Token"</strong>. Ikuti prosesnya sampai selesai, lalu <strong>salin token</strong> yang muncul ke Notepad atau tempat aman.</p>
            <div class="tut-warning">
              <span>⚠️</span>
              <div>Token hanya ditampilkan <strong>sekali</strong>. Pastikan kamu sudah menyalinnya sebelum menutup halaman. Kalau lupa, kamu harus bikin token baru.</div>
            </div>
          </div>
        </div>

        <!-- Step 1.5 -->
        <div class="tut-step">
          <div class="tut-step-dot"></div>
          <div class="tut-step-content">
            <h4>Catat Account ID</h4>
            <p>Masih di halaman yang sama, kamu akan melihat <strong>Account ID</strong> (deretan karakter alfanumerik). Salin juga ke Notepad. Nanti Account ID ini dipakai bareng API Token untuk koneksi.</p>
            <div class="tut-success">
              <span>✅</span>
              <div>Sekarang kamu punya 2 hal penting: <strong>API Token</strong> dan <strong>Account ID</strong>. Simpan keduanya baik-baik!</div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- ========================== -->
    <!-- BAGIAN 2: Setup OpenCode   -->
    <!-- ========================== -->
    <div class="tut-section reveal">
      <div class="tut-section-header">
        <div class="tut-section-num">2</div>
        <div>
          <h2 class="tut-section-title">Hubungkan ke OpenCode</h2>
          <p class="tut-section-sub">Opsional — kamu bisa pakai coding agent favoritmu, tapi di sini kita contohkan pakai OpenCode</p>
        </div>
      </div>

      <div class="tut-steps">

        <!-- Step 2.1 -->
        <div class="tut-step">
          <div class="tut-step-dot"></div>
          <div class="tut-step-content">
            <h4>Install OpenCode</h4>
            <p>Pastikan OpenCode sudah ter-install di sistem kamu. Kalau belum, ikuti petunjuk instalasi di dokumentasi resminya.</p>
            <a href="https://opencode.ai" target="_blank" class="tut-link-box mt-2">
              <div class="tut-link-icon">⚡</div>
              <div class="tut-link-text">
                <strong>OpenCode — AI Coding Agent</strong>
                <small>opencode.ai</small>
              </div>
              <div class="tut-link-arrow">→</div>
            </a>
          </div>
        </div>

        <!-- Step 2.2 -->
        <div class="tut-step">
          <div class="tut-step-dot"></div>
          <div class="tut-step-content">
            <h4>Jalankan Perintah Connect</h4>
            <p>Buka terminal, masuk ke OpenCode, lalu ketik perintah berikut untuk memulai koneksi ke provider baru:</p>
            <div class="tut-code-block">
              <div class="tut-code-header">
                <span>Terminal</span>
                <button class="tut-copy-btn" onclick="navigator.clipboard.writeText('/connect')">Copy</button>
              </div>
              <code>/connect</code>
            </div>
          </div>
        </div>

        <!-- Step 2.3 -->
        <div class="tut-step">
          <div class="tut-step-dot"></div>
          <div class="tut-step-content">
            <h4>Pilih Cloudflare AI Worker</h4>
            <p>Setelah menekan Enter, akan muncul daftar provider. Scroll atau cari <strong>Cloudflare AI Worker</strong>, lalu pilih.</p>
          </div>
        </div>

        <!-- Step 2.4 -->
        <div class="tut-step">
          <div class="tut-step-dot"></div>
          <div class="tut-step-content">
            <h4>Masukkan Kredensial</h4>
            <p>OpenCode akan meminta dua informasi yang sudah kamu catat sebelumnya:</p>
            <div class="tut-flow mt-2">
              <span class="tut-flow-item">Account ID</span>
              <span class="tut-flow-sep">→</span>
              <span class="tut-flow-item">API Token</span>
              <span class="tut-flow-sep">→</span>
              <span class="tut-flow-item">Connected ✓</span>
            </div>
            <p class="mt-3">Paste masing-masing ketika diminta. Kalau berhasil, OpenCode akan konfirmasi bahwa koneksi aktif.</p>
          </div>
        </div>

        <!-- Step 2.5 -->
        <div class="tut-step">
          <div class="tut-step-dot"></div>
          <div class="tut-step-content">
            <h4>Pilih Model AI</h4>
            <p>Langkah terakhir! Pilih model yang ingin kamu gunakan. Dua model yang lagi "dibansos" Cloudflare saat ini:</p>
            <div class="row g-3 mt-2">
              <div class="col-sm-6">
                <div class="tut-price-box w-100 text-center">
                  <span style="font-size:28px">🧠</span>
                  <div class="tut-price" style="font-size:18px">GLM 5.2</div>
                  <div class="tut-price-note">General purpose, multi-task</div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="tut-price-box w-100 text-center">
                  <span style="font-size:28px">💻</span>
                  <div class="tut-price" style="font-size:18px">Kimi 2.7 Code</div>
                  <div class="tut-price-note">Optimized for coding</div>
                </div>
              </div>
            </div>
            <div class="tut-success mt-3">
              <span>🎉</span>
              <div>Selesai! Sekarang kamu bisa ngoding dengan bantuan AI kelas premium tanpa keluar uang sepeser pun.</div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- ========================== -->
    <!-- TIPS                       -->
    <!-- ========================== -->
    <div class="tut-tips reveal">
      <div class="tut-tips-header">
        <span>💡</span>
        <h3>Tips & Info Tambahan</h3>
      </div>

      <div class="tut-tip-item">
        <div class="tut-tip-icon">🧪</div>
        <div>
          <h5>Kenapa Bisa Gratis?</h5>
          <p>Saat ini Cloudflare sedang dalam fase piloting untuk layanan Workers AI mereka. Artinya, mereka membuka akses model-model premium secara gratis untuk pengujian. Manfaatkan selagi masih buka!</p>
        </div>
      </div>

      <div class="tut-tip-item">
        <div class="tut-tip-icon">🔄</div>
        <div>
          <h5>Tidak Harus OpenCode</h5>
          <p>Tutorial ini mencontohkan OpenCode karena simpel dan cepat. Tapi kamu bebas pakai coding agent atau tool lain yang mendukung koneksi ke Cloudflare Workers AI REST API, misalnya via curl atau SDK sendiri.</p>
        </div>
      </div>

      <div class="tut-tip-item">
        <div class="tut-tip-icon">📊</div>
        <div>
          <h5>Ada Batas Kuota?</h5>
          <p>Setiap akun Cloudflare punya free tier quota untuk Workers AI. Selama masih dalam batas wajar, kamu bisa pakai terus. Kalau kuota habis, biasanya reset per bulan.</p>
        </div>
      </div>

      <div class="tut-tip-item">
        <div class="tut-tip-icon">🔐</div>
        <div>
          <h5>Jaga API Token</h5>
          <p>Jangan pernah share API Token kamu ke siapapun atau commit ke repository publik. Kalau bocor, orang lain bisa pakai kuota akun kamu. Selalu simpan di environment variable.</p>
        </div>
      </div>
    </div>

    <!-- CTA -->
    <div class="text-center reveal mb-5">
      <a href="<?= base_url('tutorial') ?>" class="btn btn-outline-accent px-4 py-2">← Kembali ke Daftar Tutorial</a>
    </div>

  </div>
</section>

<?= $this->include('template/footer') ?>