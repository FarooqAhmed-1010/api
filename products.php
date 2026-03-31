<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Computer Parts Shop</title>
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
                <li><a href="products.php" class="active">Products</a></li>
                <li><a href="cart.php">Cart <span class="cart-count" id="cart-count">0</span></a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Products Page -->
    <section class="products-page">
        <div class="container">
            <h2>Our Products</h2>
            
            <!-- Filter Section -->
            <div class="filter-section">
                <label for="category-filter">Filter by Category:</label>
                <select id="category-filter">
                    <option value="">All Categories</option>
                    <option value="CPU">CPU</option>
                    <option value="GPU">GPU</option>
                    <option value="RAM">RAM</option>
                    <option value="Storage">Storage</option>
                    <option value="Motherboard">Motherboard</option>
                    <option value="PSU">Power Supply</option>
                    <option value="Cooling">Cooling</option>
                    <option value="Case">Case</option>
                </select>
            </div>

            <!-- Products Grid -->
            <div class="products-grid" id="products-container">
                <!-- Products will be loaded here by JavaScript -->
                <p>Loading products...</p>
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
    <script src="js/products.js"></script>
    <script src="js/chatbox.js"></script>
</body>
</html>
