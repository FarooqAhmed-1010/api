// ============================================
// PRODUCTS.JS - Products Page Functionality
// ============================================

// All products data (mock data - fetch from DB in production)
const allProducts = [
    {
        id: 1,
        product_name: 'Intel i9-13900K',
        serial_number: 'INTEL-I9-13900K-001',
        category: 'CPU',
        brand: 'Intel',
        price: 589.99,
        stock_quantity: 15,
        description: 'High-performance gaming and productivity CPU with 24 cores',
        image_url: 'https://via.placeholder.com/250x250?text=Intel+i9'
    },
    {
        id: 2,
        product_name: 'NVIDIA RTX 4090',
        serial_number: 'NVIDIA-RTX4090-001',
        category: 'GPU',
        brand: 'NVIDIA',
        price: 1599.99,
        stock_quantity: 5,
        description: 'Flagship gaming GPU with 24GB VRAM',
        image_url: 'https://via.placeholder.com/250x250?text=RTX+4090'
    },
    {
        id: 3,
        product_name: 'Corsair 32GB RAM DDR5',
        serial_number: 'CORSAIR-RAM32GB-001',
        category: 'RAM',
        brand: 'Corsair',
        price: 199.99,
        stock_quantity: 30,
        description: '32GB DDR5 memory kit for high-speed performance',
        image_url: 'https://via.placeholder.com/250x250?text=Corsair+RAM'
    },
    {
        id: 4,
        product_name: 'Samsung 1TB NVMe SSD',
        serial_number: 'SAMSUNG-SSD1TB-001',
        category: 'Storage',
        brand: 'Samsung',
        price: 89.99,
        stock_quantity: 25,
        description: 'Fast NVMe storage with 7GB/s read speed',
        image_url: 'https://via.placeholder.com/250x250?text=Samsung+SSD'
    },
    {
        id: 5,
        product_name: 'ASUS B650E Motherboard',
        serial_number: 'ASUS-B650E-001',
        category: 'Motherboard',
        brand: 'ASUS',
        price: 349.99,
        stock_quantity: 10,
        description: 'Premium X650 chipset motherboard',
        image_url: 'https://via.placeholder.com/250x250?text=ASUS+Mobo'
    },
    {
        id: 6,
        product_name: 'Corsair 850W Power Supply',
        serial_number: 'CORSAIR-PSU850W-001',
        category: 'PSU',
        brand: 'Corsair',
        price: 179.99,
        stock_quantity: 20,
        description: '850W 80+ Gold certified power supply',
        image_url: 'https://via.placeholder.com/250x250?text=Corsair+PSU'
    },
    {
        id: 7,
        product_name: 'Noctua NH-D15 CPU Cooler',
        serial_number: 'NOCTUA-ND15-001',
        category: 'Cooling',
        brand: 'Noctua',
        price: 99.99,
        stock_quantity: 12,
        description: 'Premium air cooler for high-end CPUs',
        image_url: 'https://via.placeholder.com/250x250?text=Noctua+Cooler'
    },
    {
        id: 8,
        product_name: 'Lian Li Lancool 515 Case',
        serial_number: 'LIANLI-515-001',
        category: 'Case',
        brand: 'Lian Li',
        price: 79.99,
        stock_quantity: 18,
        description: 'Mid-tower ATX case with great airflow',
        image_url: 'https://via.placeholder.com/250x250?text=Lian+Li+Case'
    }
];

// Display products
function displayProducts(productsToDisplay = allProducts) {
    const container = document.getElementById('products-container');
    if (!container) return;
    
    if (productsToDisplay.length === 0) {
        container.innerHTML = '<p style="grid-column: 1/-1; text-align: center;">No products found</p>';
        return;
    }
    
    container.innerHTML = productsToDisplay.map(product => `
        <div class="product-card">
            <div class="product-image">
                <img src="${product.image_url}" alt="${product.product_name}">
            </div>
            <div class="product-info">
                <div class="product-category">${product.category}</div>
                <h3 class="product-name">${product.product_name}</h3>
                <div class="product-price">$${product.price.toFixed(2)}</div>
                <div class="product-stock">Stock: ${product.stock_quantity}</div>
                <div class="product-actions">
                    <input type="number" value="1" min="1" class="qty-input">
                    <button class="btn btn-primary" onclick="handleAddToCart(event, ${product.id})">Add to Cart</button>
                </div>
            </div>
        </div>
    `).join('');
    
    // Add click handlers to view product details
    document.querySelectorAll('.product-card').forEach((card, index) => {
        card.style.cursor = 'pointer';
        card.addEventListener('click', function(e) {
            if (e.target.tagName !== 'BUTTON' && e.target.tagName !== 'INPUT') {
                window.location.href = `product-detail.php?id=${productsToDisplay[index].id}`;
            }
        });
    });
}

// Filter products by category
function filterByCategory(category) {
    if (!category) {
        displayProducts(allProducts);
    } else {
        const filtered = allProducts.filter(p => p.category === category);
        displayProducts(filtered);
    }
}

// Search products
function searchProducts(query) {
    if (!query) {
        displayProducts(allProducts);
        return;
    }
    
    const lowerQuery = query.toLowerCase();
    const filtered = allProducts.filter(p => 
        p.product_name.toLowerCase().includes(lowerQuery) ||
        p.brand.toLowerCase().includes(lowerQuery) ||
        p.description.toLowerCase().includes(lowerQuery)
    );
    displayProducts(filtered);
}

// Initialize products page
document.addEventListener('DOMContentLoaded', function() {
    // Display all products initially
    displayProducts();
    
    // Add filter listener
    const categoryFilter = document.getElementById('category-filter');
    if (categoryFilter) {
        categoryFilter.addEventListener('change', function() {
            filterByCategory(this.value);
        });
    }
    
    // Add search functionality if search input exists
    const searchInput = document.getElementById('search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            searchProducts(this.value);
        });
    }
});
