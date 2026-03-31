<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Computer Parts Shop</title>
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
                <li><a href="contact.php" class="active">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Contact Page -->
    <section class="contact-page">
        <div class="container">
            <h2>Contact Us</h2>
            
            <div class="contact-container">
                <div class="contact-info">
                    <h3>Get in Touch</h3>
                    <p>Have questions about our products? Need help with your order? We're here to help!</p>
                    
                    <div class="contact-details">
                        <div class="detail">
                            <h4>📧 Email</h4>
                            <p><a href="mailto:support@computerparts.shop">support@computerparts.shop</a></p>
                        </div>
                        
                        <div class="detail">
                            <h4>📞 Phone</h4>
                            <p>+1 (800) 555-PARTS</p>
                        </div>
                        
                        <div class="detail">
                            <h4>🌐 Website</h4>
                            <p><a href="https://www.computerparts.shop" target="_blank">www.computerparts.shop</a></p>
                        </div>
                        
                        <div class="detail">
                            <h4>💬 Live Chat</h4>
                            <p>Use the chatbox for instant support</p>
                        </div>
                    </div>
                </div>

                <div class="contact-form-section">
                    <h3>Send us a Message</h3>
                    <form class="contact-form" onsubmit="handleContactSubmit(event)">
                        <div class="form-group">
                            <label for="contact-name">Your Name *</label>
                            <input type="text" id="contact-name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="contact-email">Your Email *</label>
                            <input type="email" id="contact-email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="contact-subject">Subject *</label>
                            <input type="text" id="contact-subject" name="subject" required>
                        </div>

                        <div class="form-group">
                            <label for="contact-message">Message *</label>
                            <textarea id="contact-message" name="message" rows="5" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                    <div id="contact-status"></div>
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
    <script src="js/contact.js"></script>
    <script src="js/chatbox.js"></script>
</body>
</html>
