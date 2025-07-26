-- Database: dyffa_topup

CREATE DATABASE IF NOT EXISTS dyffa_topup;
USE dyffa_topup;

-- Table: products
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    game VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: orders
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id VARCHAR(20) NOT NULL UNIQUE,
    game VARCHAR(50) NOT NULL,
    user_id VARCHAR(100) NOT NULL,
    package VARCHAR(100) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: admin
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample admin (password: admin123)
INSERT INTO admin (username, password) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Insert sample products
INSERT INTO products (game, name, description, price) VALUES
('mlbb', '140 Diamond', '140 Diamond Mobile Legends', 9.00),
('mlbb', '165 Diamond', '165 Diamond Mobile Legends', 12.00),
('freefire', '130 Diamond', '130 Diamond Free Fire', 3.50),
('freefire', '210 Diamond', '210 Diamond Free Fire', 8.00),
('pubg', '60 UC', '60 UC PUBG Mobile', 4.00),
('pubg', '325 UC', '300+25 UC PUBG Mobile', 19.02),
('efootball', '130 Coin', '130 Coin eFootball Android', 4.90),
('efootball', '300 Coin', '300 Coin eFootball Android', 10.55),
('netflix', '1 Minggu', 'Akun Netflix 1 Minggu', 5.00),
('netflix', '1 Bulan', 'Akun Netflix 1 Bulan', 9.00),
('roblox', '80 Robux', '80 Robux', 3.80),
('roblox', '500 Robux', '500 Robux', 18.00),
('spotify', '1 Bulan Premium', 'Akun Spotify Premium 1 Bulan', 12.00),
('spotify', '3 Bulan Premium', 'Akun Spotify Premium 3 Bulan', 30.00),
('internet', '1GB - 1 Hari', 'Paket Internet 1GB 1 Hari', 3.00),
('internet', '3GB - 3 Hari', 'Paket Internet 3GB 3 Hari', 8.00);
