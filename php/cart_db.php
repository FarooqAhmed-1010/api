<?php
// Cart management with database (user-specific)
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/auth.php';

// Check if user is logged in
if (!isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit();
}

$user_id = getCurrentUserId();
$action = isset($_POST['action']) ? $_POST['action'] : '';

// Add to cart (database)
if ($action === 'add_to_cart') {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    
    if ($product_id <= 0 || $quantity <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid product or quantity']);
        exit();
    }
    
    // Check if product exists and has stock
    $stmt = $conn->prepare("SELECT stock_quantity FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    
    if (!$product) {
        echo json_encode(['success' => false, 'message' => 'Product not found']);
        exit();
    }
    
    if ($quantity > $product['stock_quantity']) {
        echo json_encode(['success' => false, 'message' => 'Not enough stock available']);
        exit();
    }
    
    // Check if item already in cart
    $stmt = $conn->prepare("SELECT id, quantity FROM user_cart WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Update quantity
        $cart_item = $result->fetch_assoc();
        $new_quantity = $cart_item['quantity'] + $quantity;
        
        if ($new_quantity > $product['stock_quantity']) {
            echo json_encode(['success' => false, 'message' => 'Not enough stock available']);
            exit();
        }
        
        $stmt = $conn->prepare("UPDATE user_cart SET quantity = ? WHERE id = ?");
        $stmt->bind_param("ii", $new_quantity, $cart_item['id']);
        $stmt->execute();
    } else {
        // Insert new cart item
        $stmt = $conn->prepare("INSERT INTO user_cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $user_id, $product_id, $quantity);
        $stmt->execute();
    }
    
    echo json_encode(['success' => true, 'message' => 'Product added to cart']);
    exit();
}

// Get cart items
if ($action === 'get_cart') {
    $stmt = $conn->prepare("
        SELECT uc.id as cart_item_id, uc.product_id, uc.quantity, 
               p.product_name, p.price, p.image_url
        FROM user_cart uc
        JOIN products p ON uc.product_id = p.id
        WHERE uc.user_id = ?
        ORDER BY uc.added_at DESC
    ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $cart_items = [];
    while ($row = $result->fetch_assoc()) {
        $cart_items[] = $row;
    }
    
    echo json_encode(['success' => true, 'items' => $cart_items]);
    exit();
}

// Update quantity
if ($action === 'update_quantity') {
    $cart_item_id = isset($_POST['cart_item_id']) ? intval($_POST['cart_item_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;
    
    if ($quantity <= 0) {
        // Remove if quantity is 0 or less
        $stmt = $conn->prepare("DELETE FROM user_cart WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $cart_item_id, $user_id);
        $stmt->execute();
    } else {
        $stmt = $conn->prepare("UPDATE user_cart SET quantity = ? WHERE id = ? AND user_id = ?");
        $stmt->bind_param("iii", $quantity, $cart_item_id, $user_id);
        $stmt->execute();
    }
    
    echo json_encode(['success' => true, 'message' => 'Cart updated']);
    exit();
}

// Remove from cart
if ($action === 'remove_from_cart') {
    $cart_item_id = isset($_POST['cart_item_id']) ? intval($_POST['cart_item_id']) : 0;
    
    $stmt = $conn->prepare("DELETE FROM user_cart WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $cart_item_id, $user_id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Item removed from cart']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error removing item']);
    }
    exit();
}

// Clear entire cart
if ($action === 'clear_cart') {
    $stmt = $conn->prepare("DELETE FROM user_cart WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    
    echo json_encode(['success' => true, 'message' => 'Cart cleared']);
    exit();
}

// Get cart count
if ($action === 'get_cart_count') {
    $stmt = $conn->prepare("SELECT SUM(quantity) as count FROM user_cart WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    $count = $row['count'] ? intval($row['count']) : 0;
    echo json_encode(['success' => true, 'count' => $count]);
    exit();
}

// Get cart total price
if ($action === 'get_cart_total') {
    $stmt = $conn->prepare("
        SELECT SUM(p.price * uc.quantity) as total
        FROM user_cart uc
        JOIN products p ON uc.product_id = p.id
        WHERE uc.user_id = ?
    ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    $total = $row['total'] ? floatval($row['total']) : 0;
    echo json_encode(['success' => true, 'total' => $total]);
    exit();
}

echo json_encode(['success' => false, 'message' => 'Invalid action']);
?>
