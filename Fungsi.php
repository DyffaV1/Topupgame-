<?php
require_once 'config.php';

// Fungsi untuk membersihkan input
function clean_input($data) {
    global $conn;
    return htmlspecialchars(strip_tags(trim($conn->real_escape_string($data))));
}

// Fungsi untuk menambahkan order baru
function add_order($game, $user_id, $package, $payment_method, $total_price, $status = 'pending') {
    global $conn;
    
    $order_id = 'DYF-' . date('Ymd') . '-' . substr(uniqid(), -6);
    $created_at = date('Y-m-d H:i:s');
    
    $stmt = $conn->prepare("INSERT INTO orders (order_id, game, user_id, package, payment_method, total_price, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssdss", $order_id, $game, $user_id, $package, $payment_method, $total_price, $status, $created_at);
    
    if ($stmt->execute()) {
        return $order_id;
    } else {
        return false;
    }
}

// Fungsi untuk mendapatkan daftar produk
function get_products($game = null) {
    global $conn;
    
    $query = "SELECT * FROM products";
    if ($game) {
        $query .= " WHERE game = '$game'";
    }
    $query .= " ORDER BY game, price";
    
    $result = $conn->query($query);
    $products = [];
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    
    return $products;
}

// Fungsi untuk mendapatkan detail order
function get_order($order_id) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt->bind_param("s", $order_id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        return $result->fetch_assoc();
    }
    
    return false;
}

// Fungsi untuk update status order
function update_order_status($order_id, $status) {
    global $conn;
    
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
    $stmt->bind_param("ss", $status, $order_id);
    
    return $stmt->execute();
}
?>
