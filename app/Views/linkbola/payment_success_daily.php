<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .card {
            max-width: 500px;
            width: 100%;
            margin-top: 20px;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
        }
        .card-text {
            font-size: 1rem;
        }
        .header-img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="<?= base_url(); ?>img/payment-success.png" alt="Payment Success" class="header-img">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Terimakasih atas pembelian product Link Nonton Bola</h5>
                <p class="card-text">Berikut adalah link untuk pertandingan:</p>
                
                <?php foreach($results as $result) : ?>
                <a href="<?= $result['link']; ?>" class="btn btn-primary" target="_blank"><?= $result['link']; ?></a><br>
                <sub style="color: red;">* jangan lupa untuk menyimpan link ini.</sub>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
