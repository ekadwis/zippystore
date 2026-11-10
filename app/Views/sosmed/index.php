<?= $this->include('template/header') ?>

<?php
  $set = $pengaturan ?? [];
  $waAdmin = '6285177838705';
?>

<!-- HERO -->
<header class="section text-center" style="padding-top:140px;padding-bottom:30px">
  <div class="container">
    <div class="d-inline-flex align-items-center gap-2 mb-3 reveal">
      <span class="badge-sosmed">⚡ INSTANT DISPATCH SMM</span>
      <span class="badge-trust">🛡️ 100% Aman Tanpa Password</span>
    </div>
    <h1 class="fw-bold reveal">
      Social Media Growth <span class="text-grad-emerald">&amp; Auto SMM</span>
    </h1>
    <p class="text-muted-2 reveal mx-auto" style="max-width:680px">
      Suntik interaksi sosial media secara instan &amp; otomatis. Mendukung <strong>Pemesanan Tunggal</strong> maupun <strong>Orderan Massal (Hingga 50 Target Sekaligus)</strong> dengan pembayaran QRIS otomatis!
    </p>
  </div>
</header>

<!-- FEATURE STRIP SOSMED -->
<section class="pt-0 pb-4">
  <div class="container">
    <div class="row g-3">
      <div class="col-6 col-md-3 reveal">
        <div class="zp-card p-3 text-center" style="background:#fdf4ff">
          <div style="font-size:26px;margin-bottom:6px">🔒</div>
          <h6 class="mb-1 fw-bold" style="font-size:14px">Tanpa Password</h6>
          <p class="text-muted-2 mb-0" style="font-size:12px">Hanya butuh link postingan / username</p>
        </div>
      </div>
      <div class="col-6 col-md-3 reveal">
        <div class="zp-card p-3 text-center" style="background:#fdf4ff">
          <div style="font-size:26px;margin-bottom:6px">📋</div>
          <h6 class="mb-1 fw-bold" style="font-size:14px">Mendukung Massal</h6>
          <p class="text-muted-2 mb-0" style="font-size:12px">Order s/d 50 link/akun sekali klik</p>
        </div>
      </div>
      <div class="col-6 col-md-3 reveal">
        <div class="zp-card p-3 text-center" style="background:#fdf4ff">
          <div style="font-size:26px;margin-bottom:6px">📱</div>
          <h6 class="mb-1 fw-bold" style="font-size:14px">QRIS Otomatis</h6>
          <p class="text-muted-2 mb-0" style="font-size:12px">Bayar via Dana, GoPay, OVO, BCA dll</p>
        </div>
      </div>
      <div class="col-6 col-md-3 reveal">
        <div class="zp-card p-3 text-center" style="background:#fdf4ff">
          <div style="font-size:26px;margin-bottom:6px">🛡️</div>
          <h6 class="mb-1 fw-bold" style="font-size:14px">Garansi Refill</h6>
          <p class="text-muted-2 mb-0" style="font-size:12px">Refill 21 hari jika drop &gt; 40%</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MAIN ORDER SECTION (2 COLUMNS: FORM ORDER & SYARAT KETENTUAN) -->
<section class="section pt-0" id="orderSection">
  <div class="container">
    <div class="row g-4 justify-content-center">
      
      <!-- KOLOM KIRI: FORM ORDER & PEMBAYARAN -->
      <div class="col-12 col-lg-7">
        <div class="zp-card p-4 p-md-5 reveal h-100">
          
          <!-- TAB SWITCHER: SINGLE vs MASSAL -->
          <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="badge bg-primary px-3 py-2 text-white fw-bold">FORM PEMESANAN INSTAN</span>
            <div class="btn-group btn-group-sm" role="group">
              <button type="button" class="btn btn-dark active" id="tabSingle">Single Order</button>
              <button type="button" class="btn btn-outline-dark" id="tabMass">⚡ Order Massal (Max 50)</button>
            </div>
          </div>

          <h2 class="h4 mb-1" id="formTitle">Pesan Layanan Sosmed</h2>
          <p class="text-muted-2 small mb-4" id="formSubtitle">Pilih layanan, tentukan jumlah, dan bayar praktis via QRIS otomatis.</p>

          <!-- Form Pemesanan -->
          <form id="sosmedOrderForm">
            <?= csrf_field() ?>
            <input type="hidden" name="is_mass" id="is_mass" value="0">

            <!-- Platform -->
            <div class="mb-3">
              <label class="form-label fw-semibold small">1. Pilih Platform</label>
              <select id="platform" class="form-select">
                <option value="">— Pilih Platform —</option>
              </select>
            </div>

            <!-- Layanan -->
            <div class="mb-3">
              <label class="form-label fw-semibold small">2. Pilih Kategori Layanan</label>
              <select id="layanan" name="layanan_id" class="form-select" disabled>
                <option value="">— Pilih platform terlebih dahulu —</option>
              </select>
              <div class="form-text text-muted-2" id="serviceDesc"></div>
            </div>

            <!-- INPUT KHUSUS SINGLE ORDER -->
            <div id="singleFields">
              <!-- Jumlah -->
              <div class="mb-3">
                <label class="form-label fw-semibold small">3. Jumlah Pesanan</label>
                <div class="input-group">
                  <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="Contoh: 1000" min="100">
                  <span class="input-group-text" id="unitText">pcs / views</span>
                </div>
                <div class="form-text text-muted-2" id="rangeHint">Pilih layanan untuk melihat batas min/max order.</div>
              </div>

              <!-- Target Link / Username -->
              <div class="mb-3">
                <label class="form-label fw-semibold small">4. Target (Link Postingan / Video / Username)</label>
                <input type="text" id="target" name="target" class="form-control" placeholder="https://vt.tiktok.com/... atau @username">
                <div class="form-text text-muted-2">
                  • Untuk <strong>Followers</strong>: Masukkan username profil (contoh: <code>@akunsaya</code> atau link profil).<br>
                  • Untuk <strong>Likes &amp; Views</strong>: Masukkan link video/postingan langsung.
                </div>
              </div>
            </div>

            <!-- INPUT KHUSUS ORDER MASSAL (BATCH) -->
            <div id="massFields" style="display:none">
              <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <label class="form-label fw-semibold small mb-0">3. Masukkan Daftar Target &amp; Jumlah (1 Baris = 1 Target)</label>
                  <span class="badge bg-secondary font-monospace" id="massCounter">0 / 50 Baris</span>
                </div>
                <textarea id="mass_input" name="mass_input" class="form-control font-monospace" rows="6" placeholder="Format: link|jumlah&#10;Contoh:&#10;https://vt.tiktok.com/ZSpDaGD7t/|1000&#10;https://vt.tiktok.com/ZSpDaGD7x/|5000&#10;https://www.tiktok.com/@user/video/123|10000"></textarea>
                <div class="form-text text-muted-2">
                  Format penulisan per baris: <code>link_atau_username|jumlah</code> (dipisahkan tanda garis tegak <strong>|</strong> atau spasi). Maksimal <strong>50 target</strong> per submit.
                </div>
              </div>

              <div id="massPreviewBox" class="p-3 bg-light rounded border mb-3 small" style="display:none">
                <div class="fw-bold mb-1 text-dark">Ringkasan Validasi Massal:</div>
                <div id="massPreviewContent" class="text-muted-2"></div>
              </div>
            </div>

            <!-- No WhatsApp Buyer -->
            <div class="mb-4">
              <label class="form-label fw-semibold small">5. No. WhatsApp (Untuk Konfirmasi &amp; Tracking)</label>
              <input type="tel" id="wa_buyer" name="wa_buyer" class="form-control" placeholder="Contoh: 081234567890">
              <div class="form-text text-muted-2">ID transaksi dan update status order akan tercatat ke nomor ini.</div>
            </div>

            <!-- Live Summary Box -->
            <div class="calc-result p-3 rounded-3 mb-4 text-center" style="background:#0f172a; color:#fff">
              <div class="text-muted-2 small mb-1">Total Biaya Pemesanan:</div>
              <div class="h3 fw-bold text-success mb-1" id="livePrice">Rp 0</div>
              <div class="small text-muted-2" id="liveDetail">Silakan pilih layanan dan tentukan jumlah</div>
            </div>

            <div class="alert alert-danger" id="formError" style="display:none"></div>

            <button type="submit" class="btn btn-accent w-100 py-3 fw-bold" id="btnSubmitOrder">
              💳 Lanjut ke Pembayaran QRIS
            </button>
          </form>

          <!-- BOX 1: POPUP TAMPILAN QRIS ASLI & SIMULASI -->
          <div id="paymentBox" class="mt-4 p-4 rounded-3 text-center border border-primary" style="display:none; background:#f8fafc">
            <span class="badge bg-primary px-3 py-2 text-white mb-2">MENUNGGU PEMBAYARAN</span>
            <h4 class="fw-bold text-dark mt-1">Scan QRIS Untuk Membayar</h4>
            <p class="text-muted small mb-3">Buka aplikasi E-Wallet (Dana, GoPay, OVO, ShopeePay) atau Mobile Banking kamu lalu scan kode QR di bawah:</p>

            <!-- Render QR Code Image -->
            <div class="p-3 bg-white rounded border d-inline-block shadow-sm mb-3">
              <img id="qrImage" src="" alt="QRIS Code" style="max-width:240px; height:auto; display:block; margin:0 auto;" />
              <div class="mt-2 text-muted small fw-bold">QRIS NASIONAL (Duitku)</div>
              <div class="h5 fw-bold text-dark mt-1" id="payAmountText">Rp 0</div>
            </div>

            <div class="alert alert-warning small py-2 mb-3 text-start">
              <strong>🧪 Mode Sandbox Duitku:</strong><br>
              Kamu dapat menekan tombol simulasi di bawah untuk menguji proses pembayaran sukses tanpa memotong uang asli.
            </div>

            <div class="d-flex flex-column gap-2">
              <button type="button" class="btn btn-success fw-bold py-2" id="btnSimulateSuccess">
                ⚡ Simulasi Bayar Berhasil (Sandbox Test)
              </button>
              <button type="button" class="btn btn-sm btn-outline-secondary" onclick="location.reload()">
                Batal / Buat Pesanan Baru
              </button>
            </div>

            <div class="mt-3 p-2 bg-light rounded small text-muted">
              <span class="spinner-border spinner-border-sm text-primary me-1" role="status"></span>
              Sistem memantau pembayaran realtime...
            </div>
          </div>

          <!-- BOX 2: STATUS PEMBAYARAN SUKSES & ORDER DISPATCHED -->
          <div id="orderSuccessBox" class="mt-4 p-4 rounded-3 text-center border border-success" style="display:none; background:#f0fdf4">
            <div style="font-size:48px">🎉</div>
            <h4 class="fw-bold text-success mt-2">Pembayaran Berhasil Dikonfirmasi!</h4>
            <p class="text-muted mb-3" id="successMsg">Pesanan Anda telah otomatis dikirimkan ke antrean server.</p>
            
            <div class="bg-white p-3 rounded border text-start mb-3 small">
              <div><strong>Kode Pesanan:</strong> <span id="resOrderCode" class="badge bg-secondary font-monospace"></span></div>
              <div><strong>Tipe Pesanan:</strong> <span id="resTipe" class="badge bg-info text-dark">Single</span></div>
              <div><strong>ID Server:</strong> <span id="resProviderId" class="badge bg-primary font-monospace"></span></div>
              <div><strong>Status Order:</strong> <span id="resStatus" class="badge bg-success">PROCESSING</span></div>
              <div><strong>Keterangan:</strong> <span id="resCatatan">Otomatis diproses server</span></div>
            </div>

            <div class="d-flex flex-column gap-2">
              <a href="#" id="btnTrackWA" target="_blank" class="btn btn-sm btn-outline-success">
                💬 Simpan / Kirim Bukti ke WhatsApp Admin
              </a>
              <button type="button" class="btn btn-sm btn-link text-muted" onclick="location.reload()">Buat Pesanan Baru</button>
            </div>
          </div>

        </div>
      </div>

      <!-- KOLOM KANAN: SYARAT & KETENTUAN (SOP & NOTES) -->
      <div class="col-12 col-lg-5">
        <div class="zp-card p-4 p-md-5 reveal h-100" style="background:#fcfbf9; border-left:4px solid #10b981">
          <div class="d-flex align-items-center gap-2 mb-3">
            <span class="badge bg-dark px-3 py-2 text-white fw-bold">CATATAN &amp; SYARAT KETENTUAN</span>
          </div>
          <h3 class="h5 fw-bold mb-3">Wajib Dibaca Sebelum Order</h3>

          <div class="d-flex flex-column gap-3 text-muted-2 small">
            
            <div class="d-flex gap-3">
              <div class="text-primary fs-5">📋</div>
              <div>
                <strong class="text-dark">Fitur Order Massal:</strong><br>
                Bisa memasukkan hingga <strong>50 video/link/akun sekaligus</strong> dalam 1 kali transaksi QRIS. Sangat cocok untuk kreator atau agensi yang ingin boost banyak konten sekaligus.
              </div>
            </div>

            <div class="d-flex gap-3">
              <div class="text-primary fs-5">⏱️</div>
              <div>
                <strong class="text-dark">Estimasi Waktu Pengerjaan:</strong><br>
                Proses pengerjaan maksimal <strong>1–6 hari kerja</strong> (sebagian besar views/likes masuk dalam hitungan menit hingga jam).
              </div>
            </div>

            <div class="d-flex gap-3">
              <div class="text-warning fs-5">⚠️</div>
              <div>
                <strong class="text-dark">Lebih dari 6 Hari Belum Masuk?</strong><br>
                Jika dalam 6 hari order belum tuntas atau status macet, langsung hubungi admin WhatsApp untuk pengecekan tiket ke provider.
              </div>
            </div>

            <div class="d-flex gap-3">
              <div class="text-info fs-5">🌍</div>
              <div>
                <strong class="text-dark">Kualitas Akun:</strong><br>
                Karakter akun adalah <strong>mix bule / internasional</strong>.
              </div>
            </div>

            <div class="d-flex gap-3">
              <div class="text-danger fs-5">🚫</div>
              <div>
                <strong class="text-danger">DILARANG PRIVATE AKUN:</strong><br>
                Akun atau video <strong>tidak boleh di-private</strong> selama pesanan berlangsung. Akun yang di-private = <strong>NO GARANSI</strong> (order otomatis dianggap hangus/batal oleh server).
              </div>
            </div>

            <div class="d-flex gap-3">
              <div class="text-success fs-5">🔄</div>
              <div>
                <strong class="text-dark">Garansi Refill 21 Hari:</strong><br>
                Garansi refill berlaku <strong>21 hari</strong> sejak orderan masuk jika terjadi drop &gt; 40% (khusus layanan yang mendukung garansi).
              </div>
            </div>

            <div class="d-flex gap-3">
              <div class="text-success fs-5">💬</div>
              <div>
                <strong class="text-dark">Bantuan &amp; Konsultasi:</strong><br>
                Jika ada kendala atau pertanyaan sebelum order, jangan ragu untuk hubungi admin:<br>
                <a href="https://wa.me/<?= $waAdmin ?>" target="_blank" class="btn btn-sm btn-outline-success mt-2 fw-semibold">
                  Hubungi Admin via WA (0851-7783-8705)
                </a>
              </div>
            </div>

          </div>

          <hr class="my-4">

          <div class="p-3 rounded bg-white border">
            <h6 class="fw-bold mb-2 small text-dark">💡 Contoh Input Massal:</h6>
            <code class="d-block small p-2 bg-light rounded text-dark mb-2">
              https://vt.tiktok.com/xxxx1/|1000<br>
              https://vt.tiktok.com/xxxx2/|2000<br>
              https://vt.tiktok.com/xxxx3/|5000
            </code>
            <span class="small text-muted-2">Gunakan format di atas untuk submit banyak link sekaligus.</span>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

<!-- DAFTAR PAKET TRANSPARAN -->
<section class="section pt-0">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title reveal">Katalog Harga &amp; Paket Tertera</h2>
      <p class="section-sub reveal mx-auto" style="max-width:600px">Semua paket di bawah ini sudah disesuaikan dengan harga terbaik Zippy Store dan terhubung ke antrean API otomatis.</p>
    </div>

    <?php if (!empty($struktur)): ?>
      <?php foreach ($struktur as $blok): ?>
        <div class="mb-5">
          <h3 class="h5 mb-3 reveal d-flex align-items-center gap-2">
            <span class="badge badge-plat px-3 py-2 fs-6"><?= esc($blok['platform']['nama']) ?></span>
          </h3>

          <div class="row g-4">
            <?php foreach ($blok['layanans'] as $lay): ?>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="zp-card p-4 h-100 reveal d-flex flex-column justify-content-between">
                  <div>
                    <div class="d-flex justify-content-between align-items-start mb-2">
                      <h4 class="h6 mb-0 fw-bold"><?= esc($lay['info']['nama']) ?></h4>
                      <span class="badge bg-light text-dark border font-monospace" style="font-size:10px">ID: <?= esc($lay['info']['provider_service_id']) ?></span>
                    </div>
                    <ul class="list-unstyled mb-3 mt-3">
                      <?php foreach ($lay['pakets'] as $pk): ?>
                        <li class="d-flex justify-content-between align-items-center py-2" style="border-bottom:1px solid var(--zp-border)">
                          <span class="small">
                            <strong><?= number_format($pk['jumlah'], 0, ',', '.') ?></strong>
                            <span class="text-muted-2"><?= (stripos($lay['info']['nama'], 'views') !== false) ? 'views' : ((stripos($lay['info']['nama'], 'likes') !== false) ? 'likes' : 'folls') ?></span>
                          </span>
                          <span class="d-flex align-items-center gap-2">
                            <span class="text-grad fw-bold">Rp <?= number_format($pk['harga'], 0, ',', '.') ?></span>
                            <button type="button" class="btn btn-sm btn-outline-accent py-1 px-2 btnPilihPaket" 
                                    data-platform-id="<?= $blok['platform']['id'] ?>"
                                    data-layanan-id="<?= $lay['info']['id'] ?>"
                                    data-jumlah="<?= $pk['jumlah'] ?>">Pilih</button>
                          </span>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>

                  <div class="text-muted-2 pt-2 border-top" style="font-size:11px">
                    Min: <?= number_format($lay['info']['min_order'], 0, ',', '.') ?> · Max: <?= number_format($lay['info']['max_order'], 0, ',', '.') ?>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<?= $this->include('template/footer') ?>

<script>
  const WA_ADMIN = '<?= $waAdmin ?>';
  const LAYANAN = <?= json_encode(array_map(function($l){
      return [
        'id'          => (int)$l['id'],
        'nama'        => $l['nama'],
        'platform_id' => (int)$l['platform_id'],
        'platform_nama'=> $l['platform_nama'],
        'min'         => (int)$l['min_order'],
        'max'         => (int)$l['max_order'],
        'service_id'  => $l['provider_service_id'],
      ];
  }, $layananFlat)) ?>;

  const tabSingle  = document.getElementById('tabSingle');
  const tabMass    = document.getElementById('tabMass');
  const isMassInp  = document.getElementById('is_mass');
  const singleFields = document.getElementById('singleFields');
  const massFields   = document.getElementById('massFields');
  const massInput    = document.getElementById('mass_input');
  const massCounter  = document.getElementById('massCounter');

  const elPlat    = document.getElementById('platform');
  const elLay     = document.getElementById('layanan');
  const elJml     = document.getElementById('jumlah');
  const elTarget  = document.getElementById('target');
  const elWaBuyer = document.getElementById('wa_buyer');
  const elRange   = document.getElementById('rangeHint');
  const elPrice   = document.getElementById('livePrice');
  const elDetail  = document.getElementById('liveDetail');
  const elErr     = document.getElementById('formError');
  const elForm    = document.getElementById('sosmedOrderForm');
  const btnSubmit = document.getElementById('btnSubmitOrder');

  let currentActiveOrderCode = null;

  // TAB SWITCHING: Single vs Massal
  tabSingle.addEventListener('click', () => {
    tabSingle.classList.add('active', 'btn-dark');
    tabSingle.classList.remove('btn-outline-dark');
    tabMass.classList.remove('active', 'btn-dark');
    tabMass.classList.add('btn-outline-dark');

    isMassInp.value = '0';
    singleFields.style.display = 'block';
    massFields.style.display = 'none';
    document.getElementById('formTitle').textContent = 'Pesan Layanan Sosmed';
    document.getElementById('formSubtitle').textContent = 'Pilih layanan, tentukan jumlah, dan bayar praktis via QRIS otomatis.';
    updateCalculation();
  });

  tabMass.addEventListener('click', () => {
    tabMass.classList.add('active', 'btn-dark');
    tabMass.classList.remove('btn-outline-dark');
    tabSingle.classList.remove('active', 'btn-dark');
    tabSingle.classList.add('btn-outline-dark');

    isMassInp.value = '1';
    singleFields.style.display = 'none';
    massFields.style.display = 'block';
    document.getElementById('formTitle').textContent = 'Order Sosmed Massal (Batch)';
    document.getElementById('formSubtitle').textContent = 'Masukkan hingga 50 target konten/akun sekaligus. 1 Baris = 1 Target.';
    updateCalculation();
  });

  // Populasi Dropdown Platform
  const platMap = {};
  LAYANAN.forEach(l => { platMap[l.platform_id] = l.platform_nama; });
  Object.keys(platMap).forEach(pid => {
    elPlat.insertAdjacentHTML('beforeend', `<option value="${pid}">${platMap[pid]}</option>`);
  });

  elPlat.addEventListener('change', () => {
    const pid = parseInt(elPlat.value);
    elLay.innerHTML = '<option value="">— Pilih Layanan —</option>';
    if (!pid) {
      elLay.disabled = true;
      elRange.textContent = 'Pilih layanan untuk melihat batas min/max order.';
      return;
    }
    LAYANAN.filter(l => l.platform_id === pid).forEach(l => {
      elLay.insertAdjacentHTML('beforeend', `<option value="${l.id}" data-min="${l.min}" data-max="${l.max}" data-nama="${l.nama}">${l.nama}</option>`);
    });
    elLay.disabled = false;
    updateCalculation();
  });

  elLay.addEventListener('change', () => {
    const opt = elLay.selectedOptions[0];
    if (opt && opt.dataset.min) {
      const isViews = opt.dataset.nama.toLowerCase().includes('views');
      elRange.innerHTML = `Batas per target: <strong>${(+opt.dataset.min).toLocaleString('id-ID')} – ${(+opt.dataset.max).toLocaleString('id-ID')}</strong>` + 
                          (isViews ? ` (Min 1.000 views, bebas ketik misal 1.500)` : ``);
    } else {
      elRange.textContent = '';
    }
    updateCalculation();
  });

  elJml.addEventListener('input', updateCalculation);
  massInput.addEventListener('input', () => {
    const lines = massInput.value.split('\n').filter(l => l.trim().length > 0);
    massCounter.textContent = `${lines.length} / 50 Baris`;
    if (lines.length > 50) {
      massCounter.className = 'badge bg-danger font-monospace';
    } else {
      massCounter.className = 'badge bg-secondary font-monospace';
    }
    updateCalculation();
  });

  // Kalkulasi harga realtime (Single / Massal)
  let debounceTimeout = null;
  function updateCalculation() {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(async () => {
      const lid    = elLay.value;
      const isMass = parseInt(isMassInp.value);

      if (!lid) {
        elPrice.textContent = 'Rp 0';
        elDetail.textContent = 'Silakan pilih layanan terlebih dahulu';
        return;
      }

      const fd = new FormData();
      fd.append('layanan_id', lid);
      fd.append('is_mass', isMass);
      fd.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

      if (isMass === 1) {
        const raw = massInput.value.trim();
        if (!raw) {
          elPrice.textContent = 'Rp 0';
          elDetail.textContent = 'Masukkan baris target massal (format: link|jumlah)';
          return;
        }
        fd.append('mass_input', raw);
      } else {
        const jml = parseInt(elJml.value);
        if (!jml || jml <= 0) {
          elPrice.textContent = 'Rp 0';
          elDetail.textContent = 'Silakan tentukan jumlah pesanan';
          return;
        }
        fd.append('jumlah', jml);
      }

      try {
        const res = await fetch('<?= base_url('sosmed/hitung') ?>', { method: 'POST', body: fd });
        const json = await res.json();
        if (json.ok) {
          elPrice.textContent = json.harga_fmt;
          if (json.is_mass) {
            elDetail.textContent = `Order Massal: ${json.count} Target | Total Akumulasi: ${json.total_jumlah.toLocaleString('id-ID')} pcs`;
          } else {
            elDetail.textContent = `${json.jumlah.toLocaleString('id-ID')} ${json.layanan} (${json.tier})`;
          }
          elErr.style.display = 'none';
        } else {
          elPrice.textContent = 'Rp -';
          elDetail.innerHTML = `<span class="text-warning">${json.msg}</span>`;
        }
      } catch (err) {
        console.error(err);
      }
    }, 300);
  }

  // Tombol "Pilih" di tabel katalog
  document.querySelectorAll('.btnPilihPaket').forEach(btn => {
    btn.addEventListener('click', () => {
      const pid = btn.dataset.platformId;
      const lid = btn.dataset.layananId;
      const jml = btn.dataset.jumlah;

      tabSingle.click(); // Reset ke tab single

      elPlat.value = pid;
      elPlat.dispatchEvent(new Event('change'));

      setTimeout(() => {
        elLay.value = lid;
        elLay.dispatchEvent(new Event('change'));
        elJml.value = jml;
        updateCalculation();

        document.getElementById('orderSection').scrollIntoView({ behavior: 'smooth' });
        elTarget.focus();
      }, 50);
    });
  });

  // Polling Status Pembayaran Realtime
  let checkPaymentInterval = null;
  function startPaymentPolling(orderCode) {
    if (checkPaymentInterval) clearInterval(checkPaymentInterval);
    checkPaymentInterval = setInterval(async () => {
      try {
        const res = await fetch(`<?= base_url('sosmed/status') ?>/${orderCode}`);
        const data = await res.json();
        if (data.ok && data.status_pembayaran === 'paid') {
          clearInterval(checkPaymentInterval);
          // Sembunyikan Box Bayar -> Tampilkan Box Sukses
          document.getElementById('paymentBox').style.display = 'none';
          document.getElementById('resOrderCode').textContent = data.order_code;
          document.getElementById('resTipe').textContent = data.is_mass ? `Massal (${data.mass_count} Target)` : 'Single Order';
          document.getElementById('resProviderId').textContent = data.provider_order_id ? '#' + data.provider_order_id : 'Antrean Server';
          document.getElementById('resStatus').textContent = (data.status_order || 'Processing').toUpperCase();
          document.getElementById('resCatatan').textContent = data.catatan || 'Otomatis diproses';

          const waText = `Halo Admin Zippy Store, saya telah membayar order sosmed:%0A` +
                         `*Kode Pesanan:* ${data.order_code}%0A` +
                         `*Tipe:* ${data.is_mass ? 'Massal (' + data.mass_count + ' target)' : 'Single'}%0A` +
                         `*Status:* Lunas & Sedang Diproses Server%0A` +
                         `Mohon dipantau ya!`;
          document.getElementById('btnTrackWA').href = `https://wa.me/${WA_ADMIN}?text=${waText}`;

          document.getElementById('orderSuccessBox').style.display = 'block';
        }
      } catch (e) {
        console.error('Polling error', e);
      }
    }, 2500);
  }

  // Handle Tombol Simulasi Bayar Berhasil (Sandbox)
  document.getElementById('btnSimulateSuccess').addEventListener('click', async () => {
    if (!currentActiveOrderCode) return;
    const btn = document.getElementById('btnSimulateSuccess');
    btn.disabled = true;
    btn.innerHTML = '⏳ Memproses simulasi pembayaran...';

    try {
      const res = await fetch(`<?= base_url('payment/simulate-pay') ?>/${currentActiveOrderCode}`);
      const json = await res.json();
      if (!json.ok) {
        alert(json.msg || 'Gagal simulasi');
        btn.disabled = false;
        btn.innerHTML = '⚡ Simulasi Bayar Berhasil (Sandbox Test)';
      }
    } catch (err) {
      alert('Koneksi simulasi gagal');
      btn.disabled = false;
      btn.innerHTML = '⚡ Simulasi Bayar Berhasil (Sandbox Test)';
    }
  });

  // Handle Form Submit (Membuat Tagihan Duitku QRIS)
  elForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    elErr.style.display = 'none';

    const lid    = elLay.value;
    const isMass = parseInt(isMassInp.value);
    const wa     = elWaBuyer.value.trim();

    if (!lid) {
      elErr.textContent = 'Harap pilih Layanan terlebih dahulu.';
      elErr.style.display = 'block';
      return;
    }

    const fd = new FormData();
    fd.append('layanan_id', lid);
    fd.append('is_mass', isMass);
    fd.append('wa_buyer', wa);
    fd.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

    if (isMass === 1) {
      const massVal = massInput.value.trim();
      const lines = massVal.split('\n').filter(l => l.trim().length > 0);
      if (!massVal || lines.length === 0) {
        elErr.textContent = 'Daftar target massal tidak boleh kosong.';
        elErr.style.display = 'block';
        return;
      }
      if (lines.length > 50) {
        elErr.textContent = 'Maksimal 50 target sekali checkout.';
        elErr.style.display = 'block';
        return;
      }
      fd.append('mass_input', massVal);
    } else {
      const jml    = elJml.value;
      const target = elTarget.value.trim();
      if (!jml || !target) {
        elErr.textContent = 'Harap lengkapi Jumlah dan Target Link/Username.';
        elErr.style.display = 'block';
        return;
      }
      fd.append('jumlah', jml);
      fd.append('target', target);
    }

    btnSubmit.disabled = true;
    btnSubmit.innerHTML = '⏳ Menyiapkan Tagihan QRIS...';

    try {
      const res = await fetch('<?= base_url('sosmed/order') ?>', { method: 'POST', body: fd });
      const json = await res.json();

      if (!json.ok) {
        elErr.innerHTML = json.msg || 'Gagal membuat tagihan pembayaran. Silakan periksa kembali input.';
        elErr.style.display = 'block';
        btnSubmit.disabled = false;
        btnSubmit.innerHTML = '💳 Lanjut ke Pembayaran QRIS';
        return;
      }

      currentActiveOrderCode = json.order_code;

      // Sembunyikan Form -> Tampilkan Box QRIS
      elForm.style.display = 'none';
      document.getElementById('payAmountText').textContent = json.harga_fmt;

      // Render QR Code Image
      const qrImg = document.getElementById('qrImage');
      const qrData = json.qr_string || json.payment_url;
      qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=${encodeURIComponent(qrData)}`;

      document.getElementById('paymentBox').style.display = 'block';

      // Mulai pantau status pembayaran secara realtime
      startPaymentPolling(json.order_code);

    } catch (err) {
      elErr.textContent = 'Terjadi kesalahan jaringan/server saat membuat tagihan.';
      elErr.style.display = 'block';
      btnSubmit.disabled = false;
      btnSubmit.innerHTML = '💳 Lanjut ke Pembayaran QRIS';
    }
  });
</script>
