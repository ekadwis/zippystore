<?= $this->include('template/header') ?>

<!-- Hero -->
<section class="section" style="padding-top:120px">
  <div class="container">
    <div class="text-center mb-5 reveal">
      <span class="badge rounded-pill px-3 py-2 mb-3" style="background:rgba(99,102,241,.15);color:var(--zp-accent)">🎓 FREE</span>
      <h1 class="section-title">Tutorial <span class="text-grad">Gratis</span></h1>
      <p class="section-sub mx-auto" style="max-width:560px">Kumpulan panduan lengkap yang bisa kamu ikuti sendiri. Semua tutorial ini 100% gratis tanpa biaya apapun!</p>
    </div>

    <!-- Tutorial Cards Grid -->
    <div class="row g-4 justify-content-center">

      <!-- Card 1: Gemini PRO -->
      <div class="col-md-6 col-lg-4 reveal">
        <a href="<?= base_url('tutorial/gemini-pro') ?>" class="text-decoration-none">
          <div class="tut-card p-4">
            <div class="tut-icon mb-3">🚀</div>
            <div class="tut-badge mb-3"><span>GRATIS</span></div>
            <h3 class="tut-title">Gemini PRO 1 Tahun</h3>
            <p class="tut-desc">Panduan lengkap klaim promo Gemini 12 Pro dengan durasi 1 tahun penuh secara gratis melalui Bot Telegram.</p>
            <div class="tut-meta">
              <span>📖 3 Bagian</span>
              <span>⏱️ ~10 menit</span>
            </div>
            <div class="tut-cta mt-3">
              Baca Tutorial <span>→</span>
            </div>
          </div>
        </a>
      </div>

      <!-- Card 2: Cloudflare GLM & Kimi -->
      <div class="col-md-6 col-lg-4 reveal">
        <a href="<?= base_url('tutorial/cloudflare-glm') ?>" class="text-decoration-none">
          <div class="tut-card p-4">
            <div class="tut-icon mb-3">☁️</div>
            <div class="tut-badge mb-3"><span>GRATIS</span></div>
            <h3 class="tut-title">Claim GLM 5.2 & Kimi</h3>
            <p class="tut-desc">Panduan klaim model AI premium GLM 5.2 dan Kimi 2.7 Code lewat Cloudflare Workers AI, gratis tanpa biaya.</p>
            <div class="tut-meta">
              <span>📖 2 Bagian</span>
              <span>⏱️ ~8 menit</span>
            </div>
            <div class="tut-cta mt-3">
              Baca Tutorial <span>→</span>
            </div>
          </div>
        </a>
      </div>

      <!-- Card 3: Coming Soon -->
      <div class="col-md-6 col-lg-4 reveal">
        <div class="tut-card tut-card-soon p-4">
          <div class="tut-icon mb-3">🔒</div>
          <h3 class="tut-title">Coming Soon</h3>
          <p class="tut-desc">Tutorial baru sedang dalam persiapan. Pantau terus halaman ini untuk update terbaru!</p>
          <div class="tut-meta">
            <span>🕐 Segera hadir</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<?= $this->include('template/footer') ?>