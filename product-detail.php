<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - Computer Parts Shop</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                <h1>💻 ComputerParts Shop</h1>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="cart.php">Cart <span class="cart-count" id="cart-count">0</span></a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Product Details -->
    <section class="product-details">
        <div class="container">
            <div class="product-detail-container" id="product-detail">
                <p>Loading product details...</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Computer Parts Shop. All rights reserved.</p>
            <p>Your trusted source for computer hardware worldwide</p>
        </div>
    </footer>

    <!-- Chatbox -->
    <div id="chatbox-container" class="chatbox-container">
        <div class="chatbox-header">
            <h3>💬 Chat Assistant</h3>
            <button id="chatbox-toggle" class="chatbox-toggle">−</button>
        </div>
        <div id="chatbox-messages" class="chatbox-messages"></div>
        <div class="chatbox-input">
            <input type="text" id="chatbox-input" placeholder="Ask about products..." />
            <button id="chatbox-send">Send</button>
        </div>
    </div>

    <!-- Scripts -->
    <script src="js/main.js"></script>
    <script src="js/product-detail.js"></script>
    <script src="js/chatbox.js"></script>
</body>
</html>
