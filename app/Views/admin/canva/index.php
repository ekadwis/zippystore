<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-0">
  
  <div class="row g-4 mb-4">
    <!-- Form Update Link Canva -->
    <div class="col-12 col-lg-5">
      <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="d-flex align-items-center gap-3 mb-3">
          <div style="font-size: 32px;">🎨</div>
          <div>
            <h5 class="fw-bold mb-0">Pengaturan Canva PRO EDU</h5>
            <small class="text-muted">Link otomatis dikirim ke email customer setelah bayar</small>
          </div>
        </div>

        <div class="alert alert-info py-2 px-3 small rounded-3 mb-3">
          💡 <strong>Tips Admin:</strong> Karena link Canva invite expired seminggu sekali, cukup perbarui input di bawah ini setiap ada link baru. Semua customer baru langsung menerima link terbaru!
        </div>

        <form action="<?= site_url('admin/canva/save') ?>" method="post">
          <?= csrf_field() ?>
          
          <div class="mb-3">
            <label class="form-label fw-semibold small">Nama Tim (Team Name)</label>
            <input type="text" name="team_name" class="form-control" value="<?= esc($settings['team_name'] ?? 'AEZ Team') ?>" required placeholder="AEZ Team">
            <div class="form-text small">Nama tim Canva yang harus di-accept customer.</div>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold small">Link Undangan Tim Canva (Invite Link)</label>
            <textarea name="invite_link" rows="4" class="form-control font-monospace small" required placeholder="https://www.canva.com/brand/join?token=..."><?= esc($settings['invite_link'] ?? '') ?></textarea>
            <div class="form-text small">Pastikan link diawali dengan https://www.canva.com/</div>
          </div>

          <div class="mb-3">
            <small class="text-muted d-block">Terakhir diperbarui: <strong><?= !empty($settings['updated_at']) ? date('d M Y, H:i', strtotime($settings['updated_at'])) : '-' ?></strong></small>
          </div>

          <button type="submit" class="btn btn-primary w-100 fw-bold py-2 rounded-3">
            💾 Simpan & Perbarui Link
          </button>
        </form>
      </div>
    </div>

    <!-- Quick Info & Instructions -->
    <div class="col-12 col-lg-7">
      <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
        <h5 class="fw-bold mb-3">⚡ Cara Kerja Auto-Delivery Canva</h5>
        <ol class="small text-muted mb-0 ps-3" style="line-height: 1.8;">
          <li>Customer membuka halaman order Canva di <a href="<?= site_url('premium/canva') ?>" target="_blank" class="fw-bold text-decoration-none">zippystore.my.id/premium/canva</a>.</li>
          <li>Customer memilih durasi (1 Bln 3k, 3 Bln 6k, 6 Bln 10k, 12 Bln 15k) & menginput <strong>Email Akun Canva</strong>.</li>
          <li>Customer melakukan scan QRIS (Duitku otomatis).</li>
          <li>Begitu payment masuk status <strong>SUCCESS</strong>, sistem otomatis mengirim email undangan resmi dari <code>zippystore08@gmail.com</code> ke email customer secara instan!</li>
          <li>Email memuat link invite aktif di sebelah kiri dan ringkasan 6 poin Terms & Conditions Canva.</li>
        </ol>
      </div>

      <!-- Riwayat Pesanan Canva Terakhir -->
      <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="fw-bold mb-0">📋 Riwayat Order Canva Terbaru</h5>
          <span class="badge bg-secondary"><?= count($orders) ?> order</span>
        </div>

        <div class="table-responsive">
          <table class="table table-hover align-middle small mb-0">
            <thead class="table-light">
              <tr>
                <th>Order Code</th>
                <th>Email Customer</th>
                <th>Paket</th>
                <th>Total</th>
                <th>Bayar</th>
                <th>Email Kirim</th>
                <th>Waktu</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($orders)): ?>
                <tr>
                  <td colspan="7" class="text-center text-muted py-4">Belum ada orderan Canva yang masuk.</td>
                </tr>
              <?php else: ?>
                <?php foreach ($orders as $o): ?>
                  <tr>
                    <td><strong class="font-monospace"><?= esc($o['order_code']) ?></strong></td>
                    <td><?= esc($o['customer_email']) ?></td>
                    <td><span class="badge bg-info text-dark"><?= esc($o['durasi_label']) ?></span></td>
                    <td class="fw-bold">Rp <?= number_format($o['harga'], 0, ',', '.') ?></td>
                    <td>
                      <?php if ($o['status_pembayaran'] === 'PAID'): ?>
                        <span class="badge bg-success">PAID</span>
                      <?php elseif ($o['status_pembayaran'] === 'PENDING'): ?>
                        <span class="badge bg-warning text-dark">PENDING</span>
                      <?php else: ?>
                        <span class="badge bg-secondary"><?= esc($o['status_pembayaran']) ?></span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if ($o['status_email'] === 'SENT'): ?>
                        <span class="badge bg-success">TERKIRIM 🚀</span>
                      <?php elseif ($o['status_email'] === 'FAILED'): ?>
                        <span class="badge bg-danger">GAGAL ⚠️</span>
                      <?php else: ?>
                        <span class="badge bg-light text-dark">PENDING</span>
                      <?php endif; ?>
                    </td>
                    <td class="text-muted" style="font-size: 11px;">
                      <?= date('d/m/y H:i', strtotime($o['created_at'])) ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>
<?= $this->endSection() ?>

