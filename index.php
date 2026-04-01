<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computer Parts Shop - Home</title>
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
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="cart.php">Cart <span class="cart-count" id="cart-count">0</span></a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section with Gradient Background -->
    <section class="hero">
        <div class="container">
            <h2>Welcome to Computer Parts Shop</h2>
            <p>Your one-stop shop for premium computer hardware worldwide</p>
            <a href="products.php" class="btn btn-primary">Shop Now</a>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="featured-products">
        <div class="container">
            <h2>Featured Products</h2>
            <div class="products-grid" id="featured-products">
                <!-- Products will be loaded here by JavaScript -->
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="features-grid">
                <div class="feature-card">
                    <h3>🌍 Worldwide Shipping</h3>
                    <p>We ship computer parts to over 50 countries worldwide</p>
                </div>
                <div class="feature-card">
                    <h3>✅ Authentic Products</h3>
                    <p>100% genuine computer components from trusted brands</p>
                </div>
                <div class="feature-card">
                    <h3>💰 Best Prices</h3>
                    <p>Competitive pricing on all premium computer hardware</p>
                </div>
                <div class="feature-card">
                    <h3>🤝 Expert Support</h3>
                    <p>Get help from our AI chatbot or contact us directly</p>
                </div>
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
    <script src="js/chatbox.js"></script>
</body>
</html>
