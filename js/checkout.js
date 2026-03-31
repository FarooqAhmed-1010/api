// ============================================
// CHECKOUT.JS - Checkout Page
// ============================================

const productsData = [
    { id: 1, product_name: 'Intel i9-13900K', price: 589.99 },
    { id: 2, product_name: 'NVIDIA RTX 4090', price: 1599.99 },
    { id: 3, product_name: 'Corsair 32GB RAM DDR5', price: 199.99 },
    { id: 4, product_name: 'Samsung 1TB NVMe SSD', price: 89.99 },
    { id: 5, product_name: 'ASUS B650E Motherboard', price: 349.99 },
    { id: 6, product_name: 'Corsair 850W Power Supply', price: 179.99 },
    { id: 7, product_name: 'Noctua NH-D15 CPU Cooler', price: 99.99 },
    { id: 8, product_name: 'Lian Li Lancool 515 Case', price: 79.99 }
];

// Display order items
function displayOrderItems() {
    const cart = getCart();
    const orderItemsContainer = document.getElementById('order-items');
    
    if (Object.keys(cart).length === 0) {
        orderItemsContainer.innerHTML = '<p>Your cart is empty</p>';
        return;
    }
    
    let html = '<div class="order-items">';
    let total = 0;
    
    for (const [productId, quantity] of Object.entries(cart)) {
        const product = productsData.find(p => p.id === parseInt(productId));
        if (!product) continue;
        
        const subtotal = product.price * quantity;
        total += subtotal;
        
        html += `
            <div class="order-item">
                <span>${product.product_name} x${quantity}</span>
                <span>${formatPrice(subtotal)}</span>
            </div>
        `;
    }
    
    html += '</div>';
    orderItemsContainer.innerHTML = html;
    
    // Update total
    document.getElementById('order-total').textContent = formatPrice(total);
}

// Handle checkout form submission
function handleCheckout(event) {
    event.preventDefault();
    
    const form = document.getElementById('checkout-form');
    const formData = new FormData(form);
    
    // Create request
    const requestData = new URLSearchParams();
    requestData.append('action', 'process_checkout');
    requestData.append('name', formData.get('name'));
    requestData.append('email', formData.get('email'));
    requestData.append('country', formData.get('country'));
    requestData.append('address', formData.get('address'));
    
    // Add cart data
    const cart = getCart();
    requestData.append('cart', JSON.stringify(cart));
    
    // Validate form
    if (!formData.get('name') || !formData.get('email') || !formData.get('country') || !formData.get('address')) {
        showNotification('Please fill in all fields', 'error');
        return;
    }
    
    // Validate email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(formData.get('email'))) {
        showNotification('Please enter a valid email', 'error');
        return;
    }
    
    // Submit order
    fetch('php/checkout.php', {
        method: 'POST',
        body: new URLSearchParams({
            name: formData.get('name'),
            email: formData.get('email'),
            country: formData.get('country'),
            address: formData.get('address')
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Clear cart
            localStorage.removeItem('cart');
            updateCartCount();
            
            // Show success message
            form.style.display = 'none';
            const successMsg = document.getElementById('success-message');
            document.getElementById('order-id').textContent = data.order_id;
            document.getElementById('total-amount').textContent = formatPrice(data.total_price);
            document.getElementById('confirm-email').textContent = formData.get('email');
            successMsg.style.display = 'block';
        } else {
            showNotification(data.message || 'Error processing order', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Error processing order', 'error');
    });
}

// Initialize checkout page
document.addEventListener('DOMContentLoaded', function() {
    displayOrderItems();
    
    const checkoutForm = document.getElementById('checkout-form');
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', handleCheckout);
    }
});
