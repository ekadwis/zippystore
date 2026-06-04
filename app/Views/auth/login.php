<?= $this->include('template/header') ?>

<div class="d-flex align-items-center justify-content-center" style="min-height:100vh;padding:24px">
  <div class="zp-card p-4 p-md-5 reveal" style="width:100%;max-width:400px">
    <h1 class="h3 text-center mb-1">Login</h1>
    <p class="text-muted-2 text-center small mb-4">Masuk ke dashboard Zippy Store</p>

    <form action="<?= base_url('login') ?>" method="post">
      <?= csrf_field() ?>
      <div class="mb-3">
        <label class="form-label small text-muted-2">Email / Username</label>
        <input type="text" name="email" class="form-control" placeholder="Masukkan email" required>
      </div>
      <div class="mb-3">
        <label class="form-label small text-muted-2">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
      </div>
      <button type="submit" class="btn btn-accent w-100 py-2">Masuk</button>
      <div class="d-flex justify-content-between mt-3 small">
        <a class="text-grad" href="#">Lupa password?</a>
        <a class="text-grad" href="#">Daftar</a>
      </div>
    </form>
  </div>
</div>

<?= $this->include('template/footer') ?>