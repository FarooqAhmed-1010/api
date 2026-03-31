<?php
// Database setup script - Run this file once to create the database and tables
// Access it via: http://localhost/api/setup_database.php

$servername = "localhost";
$username = "root";
$password = "";

// Create connection WITHOUT selecting database first
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$create_db = "CREATE DATABASE IF NOT EXISTS computer_parts_shop";
if ($conn->query($create_db) === TRUE) {
    echo "Database created successfully or already exists.<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db("computer_parts_shop");

// Create products table
$create_products = "CREATE TABLE IF NOT EXISTS products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(100) NOT NULL,
    serial_number VARCHAR(50) UNIQUE NOT NULL,
    category VARCHAR(50) NOT NULL,
    brand VARCHAR(50) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    stock_quantity INT NOT NULL,
    country_available VARCHAR(255) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($create_products) === TRUE) {
    echo "Products table created successfully.<br>";
} else {
    echo "Error creating products table: " . $conn->error . "<br>";
}

// Create users table
$create_users = "CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($create_users) === TRUE) {
    echo "Users table created successfully.<br>";
} else {
    echo "Error creating users table: " . $conn->error . "<br>";
}

// Create orders table
$create_orders = "CREATE TABLE IF NOT EXISTS orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(100) NOT NULL,
    user_email VARCHAR(100) NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    country VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    status VARCHAR(50) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($create_orders) === TRUE) {
    echo "Orders table created successfully.<br>";
} else {
    echo "Error creating orders table: " . $conn->error . "<br>";
}

// Create order_items table
$create_order_items = "CREATE TABLE IF NOT EXISTS order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
)";

if ($conn->query($create_order_items) === TRUE) {
    echo "Order items table created successfully.<br>";
} else {
    echo "Error creating order_items table: " . $conn->error . "<br>";
}

// Insert sample products
$sample_products = "INSERT IGNORE INTO products (product_name, serial_number, category, brand, price, stock_quantity, country_available, description, image_url) VALUES
('Intel i9-13900K', 'INTEL-I9-13900K-001', 'CPU', 'Intel', 589.99, 15, 'USA, UK, Canada, Germany, France, Japan, Australia', 'High-performance gaming and productivity CPU with 24 cores', 'https://via.placeholder.com/250x250?text=Intel+i9'),
('NVIDIA RTX 4090', 'NVIDIA-RTX4090-001', 'GPU', 'NVIDIA', 1599.99, 5, 'USA, UK, Canada, Germany, Japan', 'Flagship gaming GPU with 24GB VRAM', 'https://via.placeholder.com/250x250?text=RTX+4090'),
('Corsair 32GB RAM DDR5', 'CORSAIR-RAM32GB-001', 'RAM', 'Corsair', 199.99, 30, 'USA, UK, Canada, Germany, France, Japan, Australia', '32GB DDR5 memory kit for high-speed performance', 'https://via.placeholder.com/250x250?text=Corsair+RAM'),
('Samsung 1TB NVMe SSD', 'SAMSUNG-SSD1TB-001', 'Storage', 'Samsung', 89.99, 25, 'USA, UK, Canada, Germany, France, Japan, Australia', 'Fast NVMe storage with 7GB/s read speed', 'https://via.placeholder.com/250x250?text=Samsung+SSD'),
('ASUS B650E Motherboard', 'ASUS-B650E-001', 'Motherboard', 'ASUS', 349.99, 10, 'USA, UK, Canada, Germany, France', 'Premium X870 chipset motherboard', 'https://via.placeholder.com/250x250?text=ASUS+Mobo'),
('Corsair 850W Power Supply', 'CORSAIR-PSU850W-001', 'PSU', 'Corsair', 179.99, 20, 'USA, UK, Canada, Germany', '850W 80+ Gold certified power supply', 'https://via.placeholder.com/250x250?text=Corsair+PSU'),
('Noctua NH-D15 CPU Cooler', 'NOCTUA-ND15-001', 'Cooling', 'Noctua', 99.99, 12, 'USA, UK, Canada, Germany, France, Japan', 'Premium air cooler for high-end CPUs', 'https://via.placeholder.com/250x250?text=Noctua+Cooler'),
('Lian Li Lancool 515 Case', 'LIANLI-515-001', 'Case', 'Lian Li', 79.99, 18, 'USA, UK, Canada, Germany', 'Mid-tower ATX case with great airflow', 'https://via.placeholder.com/250x250?text=Lian+Li+Case');
";

if ($conn->query($sample_products) === TRUE) {
    echo "Sample products inserted successfully.<br>";
} else {
    echo "Error inserting sample products: " . $conn->error . "<br>";
}

echo "<br><strong>Database setup complete!</strong><br>";
echo "<p style='color: green;'>You can now navigate to the website.</p>";
echo "<p>Next steps:<br>";
echo "1. Update your Gemini API key in /config/config.php<br>";
echo "2. Access the website at http://localhost/api/index.php</p>";

$conn->close();
?>
