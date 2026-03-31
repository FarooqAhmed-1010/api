// ============================================
// CART.JS - Shopping Cart Page
// ============================================

const productsData = [
    {
        id: 1,
        product_name: 'Intel i9-13900K',
        price: 589.99,
        image_url: 'https://via.placeholder.com/250x250?text=Intel+i9'
    },
    {
        id: 2,
        product_name: 'NVIDIA RTX 4090',
        price: 1599.99,
        image_url: 'https://via.placeholder.com/250x250?text=RTX+4090'
    },
    {
        id: 3,
        product_name: 'Corsair 32GB RAM DDR5',
        price: 199.99,
        image_url: 'https://via.placeholder.com/250x250?text=Corsair+RAM'
    },
    {
        id: 4,
        product_name: 'Samsung 1TB NVMe SSD',
        price: 89.99,
        image_url: 'https://via.placeholder.com/250x250?text=Samsung+SSD'
    },
    {
        id: 5,
        product_name: 'ASUS B650E Motherboard',
        price: 349.99,
        image_url: 'https://via.placeholder.com/250x250?text=ASUS+Mobo'
    },
    {
        id: 6,
        product_name: 'Corsair 850W Power Supply',
        price: 179.99,
        image_url: 'https://via.placeholder.com/250x250?text=Corsair+PSU'
    },
    {
        id: 7,
        product_name: 'Noctua NH-D15 CPU Cooler',
        price: 99.99,
        image_url: 'https://via.placeholder.com/250x250?text=Noctua+Cooler'
    },
    {
        id: 8,
        product_name: 'Lian Li Lancool 515 Case',
        price: 79.99,
        image_url: 'https://via.placeholder.com/250x250?text=Lian+Li+Case'
    }
];

// Get product data
function getProductData(productId) {
    return productsData.find(p => p.id === productId);
}

// Display cart
function displayCart() {
    const cart = getCart();
    const cartContent = document.getElementById('cart-content');
    const cartSummary = document.getElementById('cart-summary');
    const emptyCart = document.getElementById('empty-cart');
    
    if (Object.keys(cart).length === 0) {
        // Empty cart
        cartContent.innerHTML = '';
        cartSummary.style.display = 'none';
        emptyCart.style.display = 'block';
        return;
    }
    
    // Build cart table
    let html = `
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
    `;
    
    let total = 0;
    
    for (const [productId, quantity] of Object.entries(cart)) {
        const product = getProductData(parseInt(productId));
        if (!product) continue;
        
        const subtotal = product.price * quantity;
        total += subtotal;
        
        html += `
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div class="cart-item-image">
                            <img src="${product.image_url}" alt="${product.product_name}">
                        </div>
                        ${product.product_name}
                    </div>
                </td>
                <td>${formatPrice(product.price)}</td>
                <td>
                    <input type="number" value="${quantity}" min="1" class="quantity-input" 
                           onchange="updateQuantity(${productId}, this.value)">
                </td>
                <td>${formatPrice(subtotal)}</td>
                <td>
                    <button class="btn btn-danger" onclick="removeProduct(${productId})">Remove</button>
                </td>
            </tr>
        `;
    }
    
    html += `
            </tbody>
        </table>
    `;
    
    cartContent.innerHTML = html;
    cartSummary.style.display = 'block';
    emptyCart.style.display = 'none';
    
    // Update summary
    document.getElementById('subtotal').textContent = formatPrice(total);
    document.getElementById('total').textContent = formatPrice(total);
}

// Update quantity
function updateQuantity(productId, quantity) {
    quantity = parseInt(quantity);
    if (quantity <= 0) {
        removeProduct(productId);
    } else {
        updateCartQuantityLocal(productId, quantity);
        displayCart();
        showNotification('Cart updated', 'success');
    }
}

// Remove product
function removeProduct(productId) {
    if (confirm('Remove this item from cart?')) {
        removeFromCartLocal(productId);
        displayCart();
        showNotification('Item removed from cart', 'success');
    }
}

// Clear entire cart
function clearCart() {
    if (confirm('Clear entire cart?')) {
        localStorage.removeItem('cart');
        updateCartCount();
        displayCart();
        showNotification('Cart cleared', 'success');
    }
}

// Initialize cart page
document.addEventListener('DOMContentLoaded', function() {
    displayCart();
});
