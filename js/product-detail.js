// ============================================
// PRODUCT-DETAIL.JS - Product Details Page
// ============================================

// All products data (same as products.js)
const productsData = [
    {
        id: 1,
        product_name: 'Intel i9-13900K',
        serial_number: 'INTEL-I9-13900K-001',
        category: 'CPU',
        brand: 'Intel',
        price: 589.99,
        stock_quantity: 15,
        country_available: 'USA, UK, Canada, Germany, France, Japan, Australia',
        description: 'High-performance gaming and productivity CPU with 24 cores, 8P+16E cores, and advanced technology.',
        image_url: 'https://via.placeholder.com/400x400?text=Intel+i9'
    },
    {
        id: 2,
        product_name: 'NVIDIA RTX 4090',
        serial_number: 'NVIDIA-RTX4090-001',
        category: 'GPU',
        brand: 'NVIDIA',
        price: 1599.99,
        stock_quantity: 5,
        country_available: 'USA, UK, Canada, Germany, Japan',
        description: 'Flagship gaming GPU with 24GB VRAM, exceptional performance for gaming and 3D applications.',
        image_url: 'https://via.placeholder.com/400x400?text=RTX+4090'
    },
    {
        id: 3,
        product_name: 'Corsair 32GB RAM DDR5',
        serial_number: 'CORSAIR-RAM32GB-001',
        category: 'RAM',
        brand: 'Corsair',
        price: 199.99,
        stock_quantity: 30,
        country_available: 'USA, UK, Canada, Germany, France, Japan, Australia',
        description: '32GB DDR5 memory kit for high-speed performance with excellent timings.',
        image_url: 'https://via.placeholder.com/400x400?text=Corsair+RAM'
    },
    {
        id: 4,
        product_name: 'Samsung 1TB NVMe SSD',
        serial_number: 'SAMSUNG-SSD1TB-001',
        category: 'Storage',
        brand: 'Samsung',
        price: 89.99,
        stock_quantity: 25,
        country_available: 'USA, UK, Canada, Germany, France, Japan, Australia',
        description: 'Fast NVMe storage with 7GB/s read speed for lightning-fast boot and load times.',
        image_url: 'https://via.placeholder.com/400x400?text=Samsung+SSD'
    },
    {
        id: 5,
        product_name: 'ASUS B650E Motherboard',
        serial_number: 'ASUS-B650E-001',
        category: 'Motherboard',
        brand: 'ASUS',
        price: 349.99,
        stock_quantity: 10,
        country_available: 'USA, UK, Canada, Germany, France',
        description: 'Premium X650 chipset motherboard with excellent power delivery and connectivity.',
        image_url: 'https://via.placeholder.com/400x400?text=ASUS+Mobo'
    },
    {
        id: 6,
        product_name: 'Corsair 850W Power Supply',
        serial_number: 'CORSAIR-PSU850W-001',
        category: 'PSU',
        brand: 'Corsair',
        price: 179.99,
        stock_quantity: 20,
        country_available: 'USA, UK, Canada, Germany',
        description: '850W 80+ Gold certified power supply with modular cables and silent operation.',
        image_url: 'https://via.placeholder.com/400x400?text=Corsair+PSU'
    },
    {
        id: 7,
        product_name: 'Noctua NH-D15 CPU Cooler',
        serial_number: 'NOCTUA-ND15-001',
        category: 'Cooling',
        brand: 'Noctua',
        price: 99.99,
        stock_quantity: 12,
        country_available: 'USA, UK, Canada, Germany, France, Japan',
        description: 'Premium air cooler designed for high-end CPUs with excellent cooling performance.',
        image_url: 'https://via.placeholder.com/400x400?text=Noctua+Cooler'
    },
    {
        id: 8,
        product_name: 'Lian Li Lancool 515 Case',
        serial_number: 'LIANLI-515-001',
        category: 'Case',
        brand: 'Lian Li',
        price: 79.99,
        stock_quantity: 18,
        country_available: 'USA, UK, Canada, Germany',
        description: 'Mid-tower ATX case with excellent airflow and modern design.',
        image_url: 'https://via.placeholder.com/400x400?text=Lian+Li+Case'
    }
];

// Get product ID from URL
function getProductIdFromURL() {
    const params = new URLSearchParams(window.location.search);
    return parseInt(params.get('id')) || null;
}

// Get product by ID
function getProductById(id) {
    return productsData.find(p => p.id === id);
}

// Display product details
function displayProductDetail() {
    const productId = getProductIdFromURL();
    const container = document.getElementById('product-detail');
    
    if (!productId) {
        container.innerHTML = '<p style="grid-column: 1/-1; text-align: center;">Product not found</p>';
        return;
    }
    
    const product = getProductById(productId);
    
    if (!product) {
        container.innerHTML = '<p style="grid-column: 1/-1; text-align: center;">Product not found</p>';
        return;
    }
    
    // Calculate discount (mock)
    const originalPrice = Math.round(product.price * 1.15);
    const discount = Math.round(originalPrice - product.price);
    
    container.innerHTML = `
        <div class="product-detail-image">
            <img src="${product.image_url}" alt="${product.product_name}">
        </div>
        <div class="product-detail-info">
            <div class="product-category">${product.category}</div>
            <h2>${product.product_name}</h2>
            <p style="color: #5f6368; margin-bottom: 1rem;">Brand: ${product.brand}</p>
            
            <div class="product-detail-price">
                $${product.price.toFixed(2)}
                ${discount > 0 ? `<span style="text-decoration: line-through; font-size: 0.8em; color: #5f6368;">$${originalPrice}</span>` : ''}
            </div>
            
            <div class="product-detail-specs">
                <p><strong>Serial:</strong> ${product.serial_number}</p>
                <p><strong>Stock:</strong> ${product.stock_quantity} units available</p>
                <p><strong>Available in:</strong> ${product.country_available}</p>
            </div>
            
            <p style="margin-bottom: 1rem; line-height: 1.8;">${product.description}</p>
            
            <div class="product-quantity-selector">
                <label>Quantity:</label>
                <input type="number" id="quantity" value="1" min="1" max="${product.stock_quantity}">
            </div>
            
            <button class="btn btn-primary" onclick="addToCartDetail()" style="width: 100%; padding: 15px; font-size: 1.1rem;">
                Add to Cart
            </button>
            
            <button class="btn btn-secondary" onclick="window.history.back()" style="width: 100%; margin-top: 1rem;">
                Back to Products
            </button>
        </div>
    `;
}

// Add to cart from detail page
function addToCartDetail() {
    const productId = getProductIdFromURL();
    const quantityInput = document.getElementById('quantity');
    const quantity = parseInt(quantityInput.value) || 1;
    
    if (quantity <= 0) {
        showNotification('Please select a valid quantity', 'error');
        return;
    }
    
    addToCartLocal(productId, quantity);
    
    setTimeout(() => {
        if (confirm('Product added to cart! Go to cart?')) {
            window.location.href = 'cart.php';
        }
    }, 500);
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    displayProductDetail();
});
