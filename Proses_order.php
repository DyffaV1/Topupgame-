<?php
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $game = clean_input($_POST['game']);
    $user_id = clean_input($_POST['user_id']);
    $package = clean_input($_POST['package']);
    $payment_method = clean_input($_POST['payment_method']);
    $total_price = floatval($_POST['total_price']);
    
    // Validasi input
    if (empty($game) || empty($user_id) || empty($package) || empty($payment_method) || $total_price <= 0) {
        die("Data tidak valid. Silakan cek kembali form pemesanan.");
    }
    
    // Tambahkan order ke database
    $order_id = add_order($game, $user_id, $package, $payment_method, $total_price);
    
    if ($order_id) {
        // Redirect ke halaman konfirmasi dengan order ID
        header("Location: order_confirmation.php?order_id=" . $order_id);
        exit();
    } else {
        die("Gagal membuat pesanan. Silakan coba lagi.");
    }
} else {
    header("Location: index.php");
    exit();
}
?>
