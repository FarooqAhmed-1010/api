<?php
// Dynamic navbar - Include this in every page
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../php/auth.php';

$is_logged_in = isLoggedIn();
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
$cart_count = 0;

// Get cart count if logged in
if ($is_logged_in) {
    $user_id = getCurrentUserId();
    $stmt = $conn->prepare("SELECT SUM(quantity) as count FROM user_cart WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $cart_count = $row['count'] ? intval($row['count']) : 0;
}
?>

<!-- Navigation Bar -->
<nav class="navbar">
    <div class="container">
        <div class="nav-brand">
            <a href="index.php" style="color: white; text-decoration: none;">
                <h1>💻 ComputerParts Shop</h1>
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php" <?php echo basename($_SERVER['PHP_SELF']) === 'index.php' ? 'class="active"' : ''; ?>>Home</a></li>
            <li><a href="products.php" <?php echo basename($_SERVER['PHP_SELF']) === 'products.php' ? 'class="active"' : ''; ?>>Products</a></li>
            <?php if ($is_logged_in): ?>
                <li><a href="cart.php" <?php echo basename($_SERVER['PHP_SELF']) === 'cart.php' ? 'class="active"' : ''; ?>>Cart <span class="cart-count" id="cart-count"><?php echo $cart_count; ?></span></a></li>
                <li><a href="#" onclick="return false;" class="user-menu">👤 <?php echo htmlspecialchars(substr($user_name, 0, 10)); ?></a>
                    <div class="dropdown-menu">
                        <a href="logout.php">Logout</a>
                    </div>
                </li>
            <?php else: ?>
                <li><a href="login.php" <?php echo basename($_SERVER['PHP_SELF']) === 'login.php' ? 'class="active"' : ''; ?>>Login</a></li>
                <li><a href="signup.php" <?php echo basename($_SERVER['PHP_SELF']) === 'signup.php' ? 'class="active"' : ''; ?> class="btn btn-primary" style="display: inline-block; padding: 8px 16px;">Sign Up</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
