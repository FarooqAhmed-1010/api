// ============================================
// AUTH.JS - Authentication Functionality
// ============================================

// Handle sign up form
document.addEventListener('DOMContentLoaded', function() {
    const signupForm = document.getElementById('signup-form');
    if (signupForm) {
        signupForm.addEventListener('submit', handleSignup);
    }
    
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', handleLogin);
    }
});

// Handle signup submission
function handleSignup(event) {
    event.preventDefault();
    
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    const messageDiv = document.getElementById('signup-message');
    
    // Basic validation
    if (!name || !email || !password || !confirmPassword) {
        showAuthMessage(messageDiv, 'All fields are required', 'error');
        return;
    }
    
    if (password.length < 6) {
        showAuthMessage(messageDiv, 'Password must be at least 6 characters', 'error');
        return;
    }
    
    if (password !== confirmPassword) {
        showAuthMessage(messageDiv, 'Passwords do not match', 'error');
        return;
    }
    
    // Send signup request
    const formData = new URLSearchParams();
    formData.append('action', 'signup');
    formData.append('name', name);
    formData.append('email', email);
    formData.append('password', password);
    formData.append('confirm_password', confirmPassword);
    
    fetch('php/auth_handler.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAuthMessage(messageDiv, 'Account created! Redirecting...', 'success');
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 1500);
        } else {
            showAuthMessage(messageDiv, data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAuthMessage(messageDiv, 'Signup failed. Please try again.', 'error');
    });
}

// Handle login submission
function handleLogin(event) {
    event.preventDefault();
    
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const messageDiv = document.getElementById('login-message');
    
    // Basic validation
    if (!email || !password) {
        showAuthMessage(messageDiv, 'Email and password required', 'error');
        return;
    }
    
    // Send login request
    const formData = new URLSearchParams();
    formData.append('action', 'login');
    formData.append('email', email);
    formData.append('password', password);
    
    fetch('php/auth_handler.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAuthMessage(messageDiv, 'Login successful! Redirecting...', 'success');
            setTimeout(() => {
                // Check for redirect URL
                const params = new URLSearchParams(window.location.search);
                const redirect = params.get('redirect') || 'index.php';
                window.location.href = redirect;
            }, 1000);
        } else {
            showAuthMessage(messageDiv, data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAuthMessage(messageDiv, 'Login failed. Please try again.', 'error');
    });
}

// Show authentication message
function showAuthMessage(messageDiv, message, type) {
    if (!messageDiv) return;
    
    messageDiv.textContent = message;
    messageDiv.className = 'auth-message ' + type;
    messageDiv.style.display = 'block';
}
