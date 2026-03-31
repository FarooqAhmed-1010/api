// ============================================
// MAIN.JS - Global Functions and Utilities
// ============================================

// Update cart count in navbar
function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('cart')) || {};
    const count = Object.values(cart).reduce((sum, qty) => sum + qty, 0);
    const cartCountElements = document.querySelectorAll('#cart-count');
    cartCountElements.forEach(el => {
        el.textContent = count;
    });
}

// Get cart from localStorage
function getCart() {
    return JSON.parse(localStorage.getItem('cart')) || {};
}

// Save cart to localStorage
function saveCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
}

// Add item to cart (client-side)
function addToCartLocal(productId, quantity = 1) {
    const cart = getCart();
    const productIdStr = String(productId);
    
    if (cart[productIdStr]) {
        cart[productIdStr] += quantity;
    } else {
        cart[productIdStr] = quantity;
    }
    
    saveCart(cart);
    
    // Show notification
    showNotification('Product added to cart!', 'success');
}

// Remove item from cart
function removeFromCartLocal(productId) {
    const cart = getCart();
    delete cart[String(productId)];
    saveCart(cart);
}

// Update quantity in cart
function updateCartQuantityLocal(productId, quantity) {
    const cart = getCart();
    if (quantity <= 0) {
        removeFromCartLocal(productId);
    } else {
        cart[String(productId)] = quantity;
        saveCart(cart);
    }
}

// Show notification
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 1.5rem;
        background-color: ${type === 'success' ? '#34a853' : type === 'error' ? '#ea4335' : '#1a73e8'};
        color: white;
        border-radius: 4px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        z-index: 10000;
        animation: slideIn 0.3s ease;
    `;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Format price
function formatPrice(price) {
    return '$' + parseFloat(price).toFixed(2);
}

// Load featured products on home page
function loadFeaturedProducts() {
    const container = document.getElementById('featured-products');
    if (!container) return;
    
    // Mock data - in production this would be fetched from backend
    const products = [
        {
            id: 1,
            product_name: 'Intel i9-13900K',
            price: 589.99,
            image_url: 'https://via.placeholder.com/250x250?text=Intel+i9',
            category: 'CPU',
            stock_quantity: 15
        },
        {
            id: 2,
            product_name: 'NVIDIA RTX 4090',
            price: 1599.99,
            image_url: 'https://via.placeholder.com/250x250?text=RTX+4090',
            category: 'GPU',
            stock_quantity: 5
        },
        {
            id: 3,
            product_name: 'Corsair 32GB RAM DDR5',
            price: 199.99,
            image_url: 'https://via.placeholder.com/250x250?text=Corsair+RAM',
            category: 'RAM',
            stock_quantity: 30
        },
        {
            id: 4,
            product_name: 'Samsung 1TB NVMe SSD',
            price: 89.99,
            image_url: 'https://via.placeholder.com/250x250?text=Samsung+SSD',
            category: 'Storage',
            stock_quantity: 25
        }
    ];
    
    container.innerHTML = products.map(product => `
        <div class="product-card" onclick="window.location.href='product-detail.php?id=${product.id}'">
            <div class="product-image">
                <img src="${product.image_url}" alt="${product.product_name}">
            </div>
            <div class="product-info">
                <div class="product-category">${product.category}</div>
                <h3 class="product-name">${product.product_name}</h3>
                <div class="product-price">${formatPrice(product.price)}</div>
                <div class="product-stock">Stock: ${product.stock_quantity}</div>
                <div class="product-actions">
                    <input type="number" value="1" min="1" class="qty-input">
                    <button class="btn btn-primary" onclick="handleAddToCart(event, ${product.id})">Add to Cart</button>
                </div>
            </div>
        </div>
    `).join('');
}

// Handle add to cart
function handleAddToCart(event, productId) {
    event.stopPropagation();
    const input = event.target.previousElementSibling;
    const quantity = parseInt(input.value) || 1;
    addToCartLocal(productId, quantity);
}

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
    loadFeaturedProducts();
    
    // Add CSS for animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
});
