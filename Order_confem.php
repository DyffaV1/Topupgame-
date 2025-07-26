<?php
require_once 'functions.php';

if (!isset($_GET['order_id'])) {
    header("Location: index.php");
    exit();
}

$order_id = clean_input($_GET['order_id']);
$order = get_order($order_id);

if (!$order) {
    die("Pesanan tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pesanan - DyffaTopupGame</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .receipt-container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .status-pending {
            color: #ffc107;
        }
        .status-success {
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="receipt-container">
            <h2 class="text-center mb-4">Konfirmasi Pesanan</h2>
            
            <div class="alert alert-success">
                <h4 class="alert-heading">Pesanan Berhasil Dibuat!</h4>
                <p>No. Pesanan: <strong><?= $order['order_id'] ?></strong></p>
            </div>
            
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Detail Pesanan</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Game</th>
                            <td><?= ucfirst($order['game']) ?></td>
                        </tr>
                        <tr>
                            <th>Paket</th>
                            <td><?= $order['package'] ?></td>
                        </tr>
                        <tr>
                            <th>User ID</th>
                            <td><?= $order['user_id'] ?></td>
                        </tr>
                        <tr>
                            <th>Metode Pembayaran</th>
                            <td><?= ucfirst($order['payment_method']) ?></td>
                        </tr>
                        <tr>
                            <th>Total Harga</th>
                            <td>RM <?= number_format($order['total_price'], 2) ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td class="status-<?= $order['status'] ?>"><?= ucfirst($order['status']) ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Pesanan</th>
                            <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="text-center">
                <p>Silakan lakukan pembayaran ke:</p>
                <p><strong>Touch 'n Go/DuitNow: 6016-944 5294</strong></p>
                <p>Setelah pembayaran, kirim bukti transfer ke WhatsApp:</p>
                <a href="https://wa.me/60169445294?text=Konfirmasi%20Pembayaran%20Order%20<?= $order['order_id'] ?>" 
                   class="btn btn-success" target="_blank">
                   <i class="fab fa-whatsapp"></i> Konfirmasi via WhatsApp
                </a>
                <a href="index.php" class="btn btn-primary ms-2">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
