<?php
// Enhanced checkout handler - creates orders from database cart
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/auth.php';

header('Content-Type: application/json');

// Require login
if (!isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'Please login to checkout']);
    exit();
}

$user_id = getCurrentUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $country = isset($_POST['country']) ? trim($_POST['country']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    
    // Validation
    if (!$name || !$email || !$country || !$address) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit();
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email address']);
        exit();
    }
    
    // Get cart items
    $stmt = $conn->prepare("
        SELECT uc.product_id, uc.quantity, p.price, p.stock_quantity
        FROM user_cart uc
        JOIN products p ON uc.product_id = p.id
        WHERE uc.user_id = ?
    ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Your cart is empty']);
        exit();
    }
    
    // Calculate total and validate stock
    $total_price = 0;
    $order_items = [];
    
    while ($row = $result->fetch_assoc()) {
        if ($row['quantity'] > $row['stock_quantity']) {
            echo json_encode(['success' => false, 'message' => 'Some products are out of stock']);
            exit();
        }
        $subtotal = $row['price'] * $row['quantity'];
        $total_price += $subtotal;
        $order_items[] = [
            'product_id' => $row['product_id'],
            'quantity' => $row['quantity'],
            'price' => $row['price']
        ];
    }
    
    // Start transaction
    $conn->begin_transaction();
    
    try {
        // Create order
        $stmt = $conn->prepare("
            INSERT INTO orders (user_id, user_name, user_email, total_price, country, address, status)
            VALUES (?, ?, ?, ?, ?, ?, 'pending')
        ");
        $stmt->bind_param("issdsss", $user_id, $name, $email, $total_price, $country, $address, $status);
        $status = 'pending';
        $stmt->execute();
        $order_id = $conn->insert_id;
        
        // Create order items
        foreach ($order_items as $item) {
            $stmt = $conn->prepare("
                INSERT INTO order_items (order_id, product_id, quantity, price)
                VALUES (?, ?, ?, ?)
            ");
            $stmt->bind_param("iiii", $order_id, $item['product_id'], $item['quantity'], $item['price']);
            $stmt->execute();
        }
        
        // Clear user's cart
        $stmt = $conn->prepare("DELETE FROM user_cart WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        
        // Commit transaction
        $conn->commit();
        
        echo json_encode([
            'success' => true,
            'message' => 'Order placed successfully!',
            'order_id' => $order_id,
            'total_price' => $total_price
        ]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'Error creating order: ' . $e->getMessage()]);
    }
    
    exit();
}

echo json_encode(['success' => false, 'message' => 'Invalid request']);
?>
