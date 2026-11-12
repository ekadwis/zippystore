<?= $this->include('template/header') ?>

<main class="page-body">
<div class="container py-4">

  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb small">
      <li class="breadcrumb-item"><a href="<?= base_url() ?>" class="text-decoration-none">Home</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url('premium') ?>" class="text-decoration-none">Aplikasi Premium</a></li>
      <li class="breadcrumb-item active" aria-current="page">Canva PRO EDU</li>
    </ol>
  </nav>

  <!-- Hero Header -->
  <div class="row align-items-center mb-4">
    <div class="col-lg-8">
      <div class="d-flex align-items-center gap-3 mb-2">
        <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2 fw-semibold">
          ⚡ Auto Delivery via Email
        </span>
        <span class="badge rounded-pill bg-success bg-opacity-10 text-success px-3 py-2 fw-semibold">
          ✅ 100% Bergaransi
        </span>
      </div>
      <h1 class="display-6 fw-bold mb-2">Order Canva PRO EDU</h1>
      <p class="text-muted-2 lead fs-6 mb-0">
        Akses jutaan template premium, background remover, brand kit, dan elemen pro. Link invite otomatis terkirim ke email kamu detik itu juga setelah pembayaran terverifikasi!
      </p>
    </div>
  </div>

  <div class="row g-4">
    
    <!-- Left Column: Form Pemesanan -->
    <div class="col-12 col-lg-7" id="sectionOrderForm">
      <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
        
        <form id="formCanvaOrder">
          <?= csrf_field() ?>

          <!-- Step 1: Pilih Paket -->
          <div class="mb-4">
            <label class="form-label fw-bold d-flex justify-content-between align-items-center">
              <span>1. Pilih Durasi Langganan</span>
              <small class="text-primary fw-normal">Garansi Resmi</small>
            </label>

            <div class="row g-3">
              <?php foreach ($paketList as $idx => $paket): ?>
                <div class="col-6 col-md-6">
                  <label class="durasi-card p-3 rounded-4 border d-block position-relative h-100 cursor-pointer <?= $idx === 0 ? 'selected-durasi' : '' ?>" style="cursor: pointer; transition: all 0.2s;">
                    <input type="radio" name="durasi_bulan" value="<?= $paket['bulan'] ?>" class="d-none" <?= $idx === 0 ? 'checked' : '' ?> data-harga="<?= $paket['harga'] ?>" data-label="<?= esc($paket['label']) ?>">
                    
                    <?php if (!empty($paket['badge'])): ?>
                      <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2" style="font-size: 10px;"><?= esc($paket['badge']) ?></span>
                    <?php endif; ?>

                    <div class="fw-bold fs-6 mb-1 text-dark"><?= esc($paket['label']) ?></div>
                    <div class="text-primary fw-bold fs-5 font-display">
                      Rp <?= number_format($paket['harga'], 0, ',', '.') ?>
                    </div>
                  </label>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- Step 2: Email Canva -->
          <div class="mb-4">
            <label class="form-label fw-bold">2. Masukkan Email Akun Canva Kamu <span class="text-danger">*</span></label>
            <div class="input-group">
              <span class="input-group-text bg-light border-end-0">📧</span>
              <input type="email" name="customer_email" id="customer_email" class="form-control border-start-0" placeholder="contoh: akunanda@gmail.com" required>
            </div>
            <div class="form-text small text-muted">
              Link undangan join team akan dikirimkan langsung ke email ini. Pastikan tidak salah ketik!
            </div>
          </div>

          <!-- Step 3: Nomor WhatsApp (Opsional) -->
          <div class="mb-4">
            <label class="form-label fw-bold">3. Nomor WhatsApp <small class="text-muted fw-normal">(Opsional / untuk backup bantuan)</small></label>
            <div class="input-group">
              <span class="input-group-text bg-light border-end-0">📱</span>
              <input type="tel" name="customer_wa" id="customer_wa" class="form-control border-start-0" placeholder="08xxxxxxxxxx">
            </div>
          </div>

          <!-- Ringkasan & Submit Button -->
          <div class="p-3 bg-light rounded-3 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-1">
              <span class="text-muted small">Layanan:</span>
              <strong class="small">Canva PRO EDU (Team AEZ)</strong>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-1">
              <span class="text-muted small">Durasi Dipilih:</span>
              <strong class="small" id="txtRingkasanDurasi">1 Bulan (Garansi 25-30 Hari)</strong>
            </div>
            <hr class="my-2">
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-bold">Total Pembayaran:</span>
              <span class="fs-4 fw-bold text-primary font-display" id="txtRingkasanTotal">Rp 3.000</span>
            </div>
          </div>

          <button type="submit" id="btnSubmitOrder" class="btn btn-primary w-100 py-3 rounded-3 fw-bold fs-6 shadow-sm">
            ⚡ Lanjut ke Pembayaran QRIS
          </button>
        </form>

      </div>
    </div>

    <!-- Payment QRIS / Result Panel (Hidden by default) -->
    <div class="col-12 col-lg-7 d-none" id="sectionPaymentQRIS">
      <div class="card shadow-sm border-0 rounded-4 p-4 mb-4 text-center">
        
        <div id="paymentLoading" class="py-5">
          <div class="spinner-border text-primary mb-3" role="status"></div>
          <h5>Menyiapkan Kode Pembayaran QRIS...</h5>
          <p class="text-muted small">Mohon tunggu beberapa detik, sistem sedang menghubungi payment gateway.</p>
        </div>

        <div id="paymentBox" class="d-none">
          <span class="badge bg-warning text-dark px-3 py-1 mb-2">MENUNGGU PEMBAYARAN</span>
          <h4 class="fw-bold mb-1">Scan QRIS untuk Bayar</h4>
          <p class="text-muted small mb-3">Bisa dibayar dengan GoPay, OVO, DANA, ShopeePay, BCA, Mandiri, BRI, atau semua Mobile Banking.</p>

          <div class="qr-container bg-white p-3 rounded-4 shadow-sm d-inline-block border mb-3">
            <img id="qrisImage" src="" alt="QRIS Code" class="img-fluid rounded" style="max-width: 250px; height: auto;">
          </div>

          <div class="p-3 bg-light rounded-3 text-start small mb-3">
            <div class="d-flex justify-content-between mb-1">
              <span class="text-muted">Kode Pesanan:</span>
              <span class="fw-bold font-monospace" id="qrisOrderCode">-</span>
            </div>
            <div class="d-flex justify-content-between mb-1">
              <span class="text-muted">Email Penerima:</span>
              <span class="fw-bold" id="qrisCustomerEmail">-</span>
            </div>
            <div class="d-flex justify-content-between mb-1">
              <span class="text-muted">Total Bayar:</span>
              <span class="fw-bold text-primary fs-6" id="qrisTotalHarga">-</span>
            </div>
          </div>

          <div class="alert alert-info py-2 px-3 small rounded-3 mb-3 text-start">
            ⏳ <strong>Status:</strong> Menunggu pembayaran Anda... Halaman ini akan otomatis ter-update dan mengirim link invite begitu pembayaran terdeteksi.
          </div>

          <!-- Sandbox Simulation Button (Untuk testing sebelum live) -->
          <div class="border border-warning border-dashed p-3 rounded-3 bg-warning bg-opacity-10 text-start mb-3">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <strong class="d-block text-warning-emphasis small">Mode Simulasi / Testing:</strong>
                <small class="text-muted">Klik tombol ini untuk mensimulasikan pembayaran berhasil tanpa transfer.</small>
              </div>
              <button type="button" id="btnSimulateSuccess" class="btn btn-sm btn-outline-dark fw-bold ms-2">
                Simulasi Bayar ✅
              </button>
            </div>
          </div>

          <button type="button" class="btn btn-outline-secondary w-100" id="btnBatalBayar">
            Ganti Durasi / Data Pemesanan
          </button>
        </div>

        <!-- Success Fulfillment Box -->
        <div id="paymentSuccessBox" class="d-none py-4 text-start">
          <div class="text-center mb-4">
            <div style="font-size: 55px;" class="mb-2">🎉</div>
            <h3 class="fw-bold text-success mb-1">Pembayaran Berhasil!</h3>
            <p class="text-muted">Undangan Canva PRO EDU telah dikirim ke email kamu.</p>
          </div>

          <div class="alert alert-success p-3 rounded-3 mb-4">
            <h6 class="fw-bold mb-1">📧 Cek Kotak Masuk Email Kamu:</h6>
            <p class="small mb-0">
              Email resmi dari <strong>zippystore08@gmail.com</strong> telah dikirim ke <strong id="successTargetEmail"></strong>.
              Buka email dan klik tombol <strong>"Join Tim Canva Sekarang"</strong> untuk mengaktifkan akun!
            </p>
          </div>

          <!-- Direct Invite Link fallback -->
          <div class="p-3 bg-light rounded-3 mb-4">
            <label class="small text-muted d-block mb-1">Atau klik link aktivasi langsung di bawah ini:</label>
            <div class="d-flex gap-2">
              <a href="#" id="btnDirectJoin" target="_blank" class="btn btn-success fw-bold flex-grow-1">
                🚀 Join Tim Canva Sekarang
              </a>
            </div>
            <small class="text-muted d-block mt-2">Pastikan nama tim Canva saat accept adalah: <strong id="successTeamName">AEZ Team</strong></small>
          </div>

          <div class="text-center">
            <a href="<?= base_url('premium/canva') ?>" class="btn btn-outline-primary px-4">Pesan Lagi</a>
            <a href="<?= base_url() ?>" class="btn btn-light ms-2 px-4">Kembali ke Beranda</a>
          </div>
        </div>

      </div>
    </div>

    <!-- Right Column: Terms & Conditions & Info -->
    <div class="col-12 col-lg-5">
      
      <!-- Card Syarat & Ketentuan Canva -->
      <div class="card shadow-sm border-0 rounded-4 p-4 mb-4" style="background: #fafafa;">
        <div class="d-flex align-items-center gap-2 mb-3">
          <span style="font-size: 22px;">✨</span>
          <h5 class="fw-bold mb-0">TERMS &amp; CONDITIONS CANVA</h5>
        </div>
        <p class="text-muted small mb-3">Mohon dibaca &amp; dipahami sebelum/setelah order:</p>

        <div class="accordion accordion-flush" id="accordionTnc">
          
          <div class="accordion-item bg-transparent">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed px-0 bg-transparent fw-semibold small" type="button" data-bs-toggle="collapse" data-bs-target="#tnc1">
                1. Aktivasi (Join Team)
              </button>
            </h2>
            <div id="tnc1" class="accordion-collapse collapse show">
              <div class="accordion-body px-0 pt-1 pb-3 text-muted small">
                • Silakan cek email yang didaftarkan untuk accept undangan / join team.<br>
                • Pastikan nama tim adalah <strong>"AEZ Team"</strong> (khusus pemesanan Canva PRO EDU).
              </div>
            </div>
          </div>

          <div class="accordion-item bg-transparent">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed px-0 bg-transparent fw-semibold small" type="button" data-bs-toggle="collapse" data-bs-target="#tnc2">
                2. Klaim Garansi &amp; Bukti Login
              </button>
            </h2>
            <div id="tnc2" class="accordion-collapse collapse">
              <div class="accordion-body px-0 pt-1 pb-3 text-muted small">
                • Wajib kirim screenshoot (SS) bukti login/halaman Canva maksimal 1x24 jam sejak di-invite.<br>
                • <strong>No SS = No Garansi / Garansi Hangus.</strong>
              </div>
            </div>
          </div>

          <div class="accordion-item bg-transparent">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed px-0 bg-transparent fw-semibold small" type="button" data-bs-toggle="collapse" data-bs-target="#tnc3">
                3. Masa Garansi
              </button>
            </h2>
            <div id="tnc3" class="accordion-collapse collapse">
              <div class="accordion-body px-0 pt-1 pb-3 text-muted small">
                • Durasi 1 bulan berlaku garansi 25 - 30 hari sejak tanggal pembelian.
              </div>
            </div>
          </div>

          <div class="accordion-item bg-transparent">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed px-0 bg-transparent fw-semibold small" type="button" data-bs-toggle="collapse" data-bs-target="#tnc4">
                4. Wajib Backup Desain / File
              </button>
            </h2>
            <div id="tnc4" class="accordion-collapse collapse">
              <div class="accordion-body px-0 pt-1 pb-3 text-muted small">
                • Pastikan selalu backup berkala dan download file/project setelah selesai membuat desain.<br>
                • Jika masa aktif habis dan akun sudah di-kick dari team, akun TIDAK BISA join kembali ke tim tersebut kecuali melakukan pembelian/order ulang. Segala kehilangan file/desain di luar tanggung jawab admin.
              </div>
            </div>
          </div>

          <div class="accordion-item bg-transparent">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed px-0 bg-transparent fw-semibold small" type="button" data-bs-toggle="collapse" data-bs-target="#tnc5">
                5. Perpanjangan (Renew / PPJ)
              </button>
            </h2>
            <div id="tnc5" class="accordion-collapse collapse">
              <div class="accordion-body px-0 pt-1 pb-3 text-muted small">
                • Perpanjangan masa aktif wajib konfirmasi minimal H-7 sebelum masa aktif habis jika ingin tetap berada di team yang sama.
              </div>
            </div>
          </div>

          <div class="accordion-item bg-transparent">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed px-0 bg-transparent fw-semibold small" type="button" data-bs-toggle="collapse" data-bs-target="#tnc6">
                6. Khusus Canva Admin (Head)
              </button>
            </h2>
            <div id="tnc6" class="accordion-collapse collapse">
              <div class="accordion-body px-0 pt-1 pb-3 text-muted small">
                • Kapasitas maksimal 100 member per team. Dilarang melebihi kapasitas demi kestabilan akun.
              </div>
            </div>
          </div>

        </div>

        <div class="border-top pt-3 mt-3 text-center">
          <small class="text-muted fst-italic">*Order = Setuju dengan seluruh rules di atas.*</small>
        </div>
      </div>

      <!-- FAQ Card -->
      <div class="card shadow-sm border-0 rounded-4 p-4">
        <h6 class="fw-bold mb-2">❓ Butuh Bantuan?</h6>
        <p class="small text-muted mb-3">Jika email tidak kunjung masuk dalam 2 menit setelah bayar, periksa folder <em>Spam / Junk</em> atau hubungi customer support kami.</p>
        <a href="https://wa.me/<?= esc($pengaturan['whatsapp'] ?? '6285177838705') ?>?text=Halo%20Admin,%20saya%20sudah%20order%20Canva%20PRO%20EDU" target="_blank" class="btn btn-sm btn-outline-success rounded-3 w-100 fw-bold">
          💬 Hubungi Admin via WhatsApp
        </a>
      </div>

    </div>

  </div>

</div>
</main>

<style>
.durasi-card {
  border: 2px solid #e2e8f0;
  background: #ffffff;
}
.durasi-card:hover {
  border-color: #3b82f6;
  transform: translateY(-2px);
}
.durasi-card.selected-durasi {
  border-color: #2563eb;
  background: #eff6ff;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const formOrder = document.getElementById('formCanvaOrder');
  const durasiCards = document.querySelectorAll('.durasi-card');
  const txtRingkasanDurasi = document.getElementById('txtRingkasanDurasi');
  const txtRingkasanTotal = document.getElementById('txtRingkasanTotal');

  const sectionOrderForm = document.getElementById('sectionOrderForm');
  const sectionPaymentQRIS = document.getElementById('sectionPaymentQRIS');
  const paymentLoading = document.getElementById('paymentLoading');
  const paymentBox = document.getElementById('paymentBox');
  const paymentSuccessBox = document.getElementById('paymentSuccessBox');

  const qrisImage = document.getElementById('qrisImage');
  const qrisOrderCode = document.getElementById('qrisOrderCode');
  const qrisCustomerEmail = document.getElementById('qrisCustomerEmail');
  const qrisTotalHarga = document.getElementById('qrisTotalHarga');
  const btnSimulateSuccess = document.getElementById('btnSimulateSuccess');
  const btnBatalBayar = document.getElementById('btnBatalBayar');

  let activeOrderCode = null;
  let pollingInterval = null;

  // Interaksi pilih durasi
  durasiCards.forEach(card => {
    card.addEventListener('click', function() {
      durasiCards.forEach(c => c.classList.remove('selected-durasi'));
      this.classList.add('selected-durasi');
      const radio = this.querySelector('input[type="radio"]');
      radio.checked = true;

      const harga = parseInt(radio.dataset.harga, 10);
      const label = radio.dataset.label;

      txtRingkasanDurasi.textContent = label;
      txtRingkasanTotal.textContent = 'Rp ' + harga.toLocaleString('id-ID');
    });
  });

  // Submit Order
  formOrder.addEventListener('submit', function(e) {
    e.preventDefault();

    const selectedRadio = document.querySelector('input[name="durasi_bulan"]:checked');
    const customerEmail = document.getElementById('customer_email').value.trim();
    const customerWa = document.getElementById('customer_wa').value.trim();

    if (!customerEmail) {
      alert('Harap masukkan email akun Canva Anda!');
      return;
    }

    const btnSubmit = document.getElementById('btnSubmitOrder');
    btnSubmit.disabled = true;
    btnSubmit.innerHTML = '⏳ Memproses Pesanan...';

    // Show payment section
    sectionPaymentQRIS.classList.remove('d-none');
    paymentLoading.classList.remove('d-none');
    paymentBox.classList.add('d-none');
    paymentSuccessBox.classList.add('d-none');

    // Scroll smoothly to payment section
    sectionPaymentQRIS.scrollIntoView({ behavior: 'smooth' });

    const formData = new FormData();
    formData.append('durasi_bulan', selectedRadio.value);
    formData.append('customer_email', customerEmail);
    formData.append('customer_wa', customerWa);

    fetch('<?= base_url('premium/canva/order') ?>', {
      method: 'POST',
      body: formData,
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    })
    .then(res => res.json())
    .then(data => {
      btnSubmit.disabled = false;
      btnSubmit.innerHTML = '⚡ Lanjut ke Pembayaran QRIS';

      if (data.status) {
        activeOrderCode = data.order_code;
        showPaymentBox(data);
        startPollingStatus(data.order_code);
      } else {
        alert(data.message || 'Terjadi kesalahan saat memproses pesanan.');
        sectionPaymentQRIS.classList.add('d-none');
      }
    })
    .catch(err => {
      btnSubmit.disabled = false;
      btnSubmit.innerHTML = '⚡ Lanjut ke Pembayaran QRIS';
      console.error(err);
      alert('Koneksi bermasalah. Silakan coba lagi.');
      sectionPaymentQRIS.classList.add('d-none');
    });
  });

  function showPaymentBox(data) {
    paymentLoading.classList.add('d-none');
    paymentBox.classList.remove('d-none');

    qrisOrderCode.textContent = data.order_code;
    qrisCustomerEmail.textContent = data.customer_email;
    qrisTotalHarga.textContent = 'Rp ' + parseInt(data.harga).toLocaleString('id-ID');
    
    // Set QRIS Image
    if (data.qr_image) {
      qrisImage.src = data.qr_image;
    } else {
      qrisImage.src = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' + encodeURIComponent(data.payment_url || 'WAITING_PAYMENT');
    }
  }

  function startPollingStatus(orderCode) {
    if (pollingInterval) clearInterval(pollingInterval);

    pollingInterval = setInterval(function() {
      fetch('<?= base_url('premium/canva/status') ?>/' + orderCode)
      .then(res => res.json())
      .then(res => {
        if (res.status && res.status_pembayaran === 'PAID') {
          clearInterval(pollingInterval);
          showSuccessBox(res);
        }
      })
      .catch(err => console.log('Polling check error:', err));
    }, 3000);
  }

  function showSuccessBox(res) {
    paymentBox.classList.add('d-none');
    paymentLoading.classList.add('d-none');
    paymentSuccessBox.classList.remove('d-none');

    document.getElementById('successTargetEmail').textContent = res.customer_email || 'email Anda';
    if (res.team_name) {
      document.getElementById('successTeamName').textContent = res.team_name;
    }
    if (res.invite_link) {
      document.getElementById('btnDirectJoin').href = res.invite_link;
    }
  }

  // Tombol Simulasi Pembayaran (Sandbox)
  btnSimulateSuccess.addEventListener('click', function() {
    if (!activeOrderCode) return;
    btnSimulateSuccess.disabled = true;
    btnSimulateSuccess.innerHTML = '⏳ Menyimulasikan...';

    fetch('<?= base_url('premium/canva/simulate-pay') ?>/' + activeOrderCode)
    .then(res => res.json())
    .then(data => {
      btnSimulateSuccess.disabled = false;
      btnSimulateSuccess.innerHTML = 'Simulasi Bayar ✅';
      if (data.status) {
        clearInterval(pollingInterval);
        showSuccessBox(data);
      } else {
        alert(data.message || 'Gagal simulasi.');
      }
    })
    .catch(err => {
      btnSimulateSuccess.disabled = false;
      btnSimulateSuccess.innerHTML = 'Simulasi Bayar ✅';
      alert('Error saat simulasi.');
    });
  });

  // Tombol Batal / Kembali ke Form
  btnBatalBayar.addEventListener('click', function() {
    if (pollingInterval) clearInterval(pollingInterval);
    sectionPaymentQRIS.classList.add('d-none');
    sectionOrderForm.scrollIntoView({ behavior: 'smooth' });
  });

});
</script>

<?= $this->include('template/footer') ?>
