<?php
// Start session to manage cart
session_start();

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Include database config
require_once '../config/db.php';

// Get all products
function getAllProducts($conn) {
    $query = "SELECT * FROM products ORDER BY created_at DESC";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $products = array();
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        return $products;
    }
    return array();
}

// Get product by ID
function getProductById($conn, $product_id) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return null;
}

// Add to cart
function addToCart($product_id, $quantity) {
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
}

// Update cart quantity
function updateCartQuantity($product_id, $quantity) {
    if ($quantity <= 0) {
        removeFromCart($product_id);
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
}

// Remove from cart
function removeFromCart($product_id) {
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

// Get cart total
function getCartTotal($conn) {
    $total = 0;
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $product = getProductById($conn, $product_id);
            if ($product) {
                $total += $product['price'] * $quantity;
            }
        }
    }
    return $total;
}

// Get cart items with full product details
function getCartItems($conn) {
    $cart_items = array();
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $product = getProductById($conn, $product_id);
            if ($product) {
                $product['quantity'] = $quantity;
                $product['subtotal'] = $product['price'] * $quantity;
                $cart_items[] = $product;
            }
        }
    }
    return $cart_items;
}

// Clear cart
function clearCart() {
    $_SESSION['cart'] = array();
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    
    if ($action === 'add_to_cart') {
        $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
        
        if ($product_id > 0 && $quantity > 0) {
            addToCart($product_id, $quantity);
            echo json_encode(['success' => true, 'message' => 'Product added to cart']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid product or quantity']);
        }
        exit();
    }
    
    if ($action === 'update_quantity') {
        $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;
        
        if ($product_id > 0) {
            updateCartQuantity($product_id, $quantity);
            echo json_encode(['success' => true, 'message' => 'Cart updated']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid product']);
        }
        exit();
    }
    
    if ($action === 'remove_from_cart') {
        $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
        
        if ($product_id > 0) {
            removeFromCart($product_id);
            echo json_encode(['success' => true, 'message' => 'Product removed from cart']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid product']);
        }
        exit();
    }
    
    if ($action === 'get_cart_total') {
        $total = getCartTotal($conn);
        echo json_encode(['success' => true, 'total' => $total]);
        exit();
    }
}

?>
