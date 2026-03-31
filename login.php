<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Computer Parts Shop</title>
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
                <li><a href="cart.php">Cart</a></li>
                <li><a href="login.php" class="active">Login</a></li>
            </ul>
        </div>
    </nav>

    <!-- Login Section -->
    <section class="auth-section">
        <div class="auth-container">
            <div class="auth-card">
                <h2>Welcome Back</h2>
                <p class="auth-subtitle">Login to your ComputerParts Shop account</p>

                <form id="login-form" class="auth-form">
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required placeholder="you@example.com">
                    </div>

                    <div class="form-group">
                        <label for="password">Password *</label>
                        <input type="password" id="password" name="password" required placeholder="Enter your password">
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
                </form>

                <div id="login-message" class="auth-message"></div>

                <p class="auth-footer">
                    Don't have an account? <a href="signup.php">Create one here</a>
                </p>
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

    <!-- Scripts -->
    <script src="js/main.js"></script>
    <script src="js/auth.js"></script>
</body>
</html>
