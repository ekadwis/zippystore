<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zippy Store - Homepage</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            color: #343A40;
        }

        body {
            background-color: #FFFFFF;
        }

        .navbar {
            background-color: #F8F9FA;
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            color: #343A40 !important;
        }

        .card {
            background-color: #F8F9FA;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #FFC107;
            border: none;
            color: #000000;
        }

        .btn-primary:hover {
            background-color: #FFCA28;
        }

        .offcanvas-end {
            background-color: #F8F9FA;
            /* Background color for the sidebar */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="<?= base_url(); ?>img/logo.png" alt="Zippy Store Logo" style="height: 40px; margin-right: 10px;">
                <span>Zippy Store</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Body Content -->
    <div class="container mt-5">
        <div class="card text-center mx-auto" style="width: 18rem;">
            <img src="<?= base_url(); ?>img/thumb-link-bola.jpg" class="card-img-top" alt="Link Nonton Bola">
            <div class="card-body">
                <h5 class="card-title">Link Nonton Bola</h5>
                <p class="card-text text-start">Tonton pertandingan olahraga secara eksklusif dengan streaming berkualitas dari Vidio, Vision+, RCTI+, dan penyedia top lainnya.</p>
                <!-- Button trigger for buy link bola -->
                <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#purchaseSidebar" aria-controls="purchaseSidebar">
                    Buy Now
                </button>
            </div>
        </div>
    </div>


    <!-- Sidebar buy link bola -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="purchaseSidebar" aria-labelledby="purchaseSidebarLabel">
        <div class="offcanvas-header">
            <h5 id="purchaseSidebarLabel">Purchase Form</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form method="POST" action="<?= base_url(); ?>linkbola/purchase" enctype="multipart/form-data">

                <?php csrf_field(); ?>
                <div class="mb-3">
                    <label for="customerName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="customerName" name="customer_name" required>
                </div>
                <div class="mb-3">
                    <label for="customerEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="customerEmail" name="email" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="customerPhone" class="form-label">Phone Number</label>
                    <input type="number" class="form-control" id="customerPhone" name="phone_number" required>
                </div>
                <div class="mb-3">
                    <label for="linkType" class="form-label">Select Link Type</label>
                    <select class="form-select" id="linkType" required>
                        <option value="" disabled selected>Select a link type</option>
                        <?php foreach ($products as $product) : ?>
                            <?php if ($product['product_type'] == "link_streaming" && $product['status'] == "aktif") : ?>
                                <option value="<?= $product['product_id']; ?>" data-price="<?= $product['price']; ?>" name="product_id">
                                    <?= $product['description']; ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" class="form-control" id="price" name="price" readonly>
                </div>

                <div class="mb-3">
                    <label for="paymentMethod" class="form-label">Select Payment Method</label>
                    <select class="form-select" id="paymentMethod" name="payment_method" required>
                        <option value="qris">QRIS (+2%)</option>
                        <option value="bank">Bank Transfer/Virtual Account (+4.000)</option>
                        <option value="ewallet">E-Wallet (Gopay/Shopeepay) (+4)</option>
                        <option value="merchant">Indomaret/Alfamart (+5000)</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const linkTypeSelect = document.getElementById('linkType');
            const priceInput = document.getElementById('price');

            linkTypeSelect.addEventListener('change', function() {
                const selectedOption = linkTypeSelect.options[linkTypeSelect.selectedIndex];
                const price = selectedOption.getAttribute('data-price');

                // Menghapus karakter selain angka dan titik (untuk desimal)
                const numericPrice = price ? price.replace(/[^0-9.]/g, '') : '';

                // Mengubah string dengan titik menjadi angka desimal (contoh: '5000.00' -> 5000)
                const cleanPrice = numericPrice ? parseFloat(numericPrice) : '';

                // Set nilai cleanPrice ke input
                priceInput.value = cleanPrice;
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('customerEmail');

            emailInput.addEventListener('input', function() {
                const emailValue = emailInput.value;
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regex untuk validasi email

                if (!emailPattern.test(emailValue)) {
                    emailInput.classList.add('is-invalid'); // Tambah kelas 'is-invalid' jika email tidak valid
                } else {
                    emailInput.classList.remove('is-invalid'); // Hapus kelas 'is-invalid' jika email valid
                }
            });
        });
    </script>


</body>

</html>