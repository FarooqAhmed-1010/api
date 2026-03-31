<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Computer Parts Shop</title>
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

    <!-- Checkout Page -->
    <section class="checkout-page">
        <div class="container">
            <div class="checkout-container">
                <div class="checkout-form-section">
                    <h2>Checkout</h2>
                    <form id="checkout-form" class="checkout-form">
                        <h3>Shipping Information</h3>
                        
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="country">Country *</label>
                            <select id="country" name="country" required>
                                <option value="">Select a country</option>
                                <option value="USA">United States</option>
                                <option value="UK">United Kingdom</option>
                                <option value="Canada">Canada</option>
                                <option value="Germany">Germany</option>
                                <option value="France">France</option>
                                <option value="Japan">Japan</option>
                                <option value="Australia">Australia</option>
                                <option value="India">India</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="address">Street Address *</label>
                            <textarea id="address" name="address" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Place Order</button>
                    </form>
                </div>

                <div class="order-summary-section">
                    <h3>Order Summary</h3>
                    <div id="order-items">
                        <p>Loading order items...</p>
                    </div>
                    <div class="order-total">
                        <h4>Total: <span id="order-total">$0.00</span></h4>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            <div id="success-message" class="success-message" style="display: none;">
                <h3>✅ Order Placed Successfully!</h3>
                <p>Thank you for your purchase!</p>
                <p>Order ID: <strong id="order-id"></strong></p>
                <p>Total Amount: <strong id="total-amount"></strong></p>
                <p>We'll send you a confirmation email at: <strong id="confirm-email"></strong></p>
                <br>
                <a href="products.php" class="btn btn-primary">Continue Shopping</a>
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
    <script src="js/checkout.js"></script>
    <script src="js/chatbox.js"></script>
</body>
</html>
