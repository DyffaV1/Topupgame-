<?php
// Konfigurasi Database
define('DB_HOST', 'localhost');
define('DB_USER', 'username_db');
define('DB_PASS', 'password_db');
define('DB_NAME', 'dyffa_topup');

// Koneksi ke Database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Cek Koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Set timezone
date_default_timezone_set('Asia/Kuala_Lumpur');
?>
