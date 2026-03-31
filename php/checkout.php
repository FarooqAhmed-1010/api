<?php
// Handle checkout form submission
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $country = isset($_POST['country']) ? trim($_POST['country']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    
    // Basic validation
    if (empty($name) || empty($email) || empty($country) || empty($address)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit();
    }
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email address']);
        exit();
    }
    
    // Check if cart is empty
    if (empty($_SESSION['cart'])) {
        echo json_encode(['success' => false, 'message' => 'Your cart is empty']);
        exit();
    }
    
    // Calculate total price
    $total_price = 0;
    $order_items = array();
    
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        
        if ($product) {
            $subtotal = $product['price'] * $quantity;
            $total_price += $subtotal;
            $order_items[] = [
                'product_id' => $product_id,
                'quantity' => $quantity,
                'price' => $product['price']
            ];
        }
    }
    
    // Insert order into database
    $stmt = $conn->prepare("INSERT INTO orders (user_name, user_email, total_price, country, address) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $name, $email, $total_price, $country, $address);
    
    if ($stmt->execute()) {
        $order_id = $conn->insert_id;
        
        // Insert order items
        foreach ($order_items as $item) {
            $stmt2 = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
            $stmt2->bind_param("iiii", $order_id, $item['product_id'], $item['quantity'], $item['price']);
            $stmt2->execute();
        }
        
        // Clear the cart
        $_SESSION['cart'] = array();
        
        echo json_encode([
            'success' => true,
            'message' => 'Order placed successfully!',
            'order_id' => $order_id,
            'total_price' => $total_price
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error placing order: ' . $conn->error]);
    }
    
    exit();
}

?>
