# Computer Parts E-Commerce Website

A beginner-friendly full-stack website for selling computer parts worldwide. Built with HTML, CSS, JavaScript, PHP, and MySQL.

## Features

✅ **Product Catalog** - Browse and filter computer parts by category
✅ **Product Details** - View detailed information about each component
✅ **Shopping Cart** - Add/remove items and manage quantities
✅ **Checkout** - Simple checkout process with order placement
✅ **AI Chatbox** - Get product recommendations via Gemini API
✅ **Responsive Design** - Works on desktop, tablet, and mobile
✅ **Worldwide Shipping** - Available to 50+ countries
✅ **Security** - Prepared statements and input validation

## Tech Stack

- **Frontend:** HTML5, CSS3, Vanilla JavaScript
- **Backend:** PHP 7.4+
- **Database:** MySQL 5.7+
- **AI Integration:** Google Gemini API (free model)

## Project Structure

```
api/
├── index.php                 # Home page
├── products.php              # Products listing page
├── product-detail.php        # Individual product details
├── cart.php                  # Shopping cart
├── checkout.php              # Checkout page
├── contact.php               # Contact page
├── setup_database.php        # Database setup script
├── config/
│   ├── db.php               # Database connection
│   └── config.php           # Global configuration
├── php/
│   ├── cart.php             # Cart management
│   ├── checkout.php         # Order processing
│   └── chatbot.php          # Gemini API integration
├── css/
│   └── style.css            # All styling
├── js/
│   ├── main.js              # Global utilities
│   ├── products.js          # Products page logic
│   ├── product-detail.js    # Product detail logic
│   ├── cart.js              # Cart page logic
│   ├── checkout.js          # Checkout logic
│   ├── contact.js           # Contact form logic
│   └── chatbox.js           # Chatbox functionality
└── images/                  # Product images

```

## Installation & Setup

### Prerequisites
- XAMPP or similar PHP/MySQL server
- Web browser
- Google Gemini API key (free)

### Step 1: Extract Files

Place all files in your XAMPP htdocs folder:
```
C:\xampp\htdocs\api\
```

### Step 2: Start XAMPP

1. Open XAMPP Control Panel
2. Start Apache and MySQL services

### Step 3: Create Database

1. Open your browser and go to: `http://localhost/api/setup_database.php`
2. This will automatically create the database and populate sample products

### Step 4: Get Gemini API Key

1. Go to https://makersuite.google.com/app/apikey
2. Create a new API key
3. Copy the API key

### Step 5: Configure API Key

1. Open `config/config.php`
2. Replace `'YOUR_GEMINI_API_KEY_HERE'` with your actual API key:

```php
define('GEMINI_API_KEY', 'your-api-key-here');
```

### Step 6: Access the Website

Open your browser and navigate to:
```
http://localhost/api/
```

## Database Schema

### Products Table
```sql
- id (Primary Key)
- product_name
- serial_number (Unique)
- category (CPU, GPU, RAM, etc.)
- brand
- price
- stock_quantity
- country_available
- description
- image_url
- created_at
```

### Orders Table
```sql
- id (Primary Key)
- user_name
- user_email
- total_price
- country
- address
- status
- created_at
```

### Order Items Table
```sql
- id (Primary Key)
- order_id (Foreign Key)
- product_id (Foreign Key)
- quantity
- price
```

## Features Explained

### 1. Product Catalog
- Browse all available computer parts
- Filter by category (CPU, GPU, RAM, Storage, etc.)
- View product details including specifications

### 2. Shopping Cart
- Add products to cart with quantity
- Update quantities
- Remove items
- Cart persists using browser localStorage

### 3. Checkout
- Enter shipping information
- Validate email and address
- Place order with order confirmation

### 4. AI Chatbox
- Ask questions about products
- Get recommendations
- Available 24/7 in bottom-right corner
- Uses Google Gemini 2.5 Flash API

### 5. Contact Page
- Send messages directly
- View contact information
- Get support

## Sample Products

- Intel i9-13900K CPU - $589.99
- NVIDIA RTX 4090 GPU - $1,599.99
- Corsair 32GB RAM DDR5 - $199.99
- Samsung 1TB NVMe SSD - $89.99
- ASUS B650E Motherboard - $349.99
- Corsair 850W Power Supply - $179.99
- Noctua NH-D15 CPU Cooler - $99.99
- Lian Li Lancool 515 Case - $79.99

## Security Measures

✅ Prepared statements for SQL queries
✅ Input validation on all forms
✅ Email validation
✅ API key stored securely in backend
✅ No sensitive data in frontend
✅ CSRF protection ready

## Troubleshooting

### Database Connection Error
- Make sure MySQL is running in XAMPP
- Check database credentials in `config/db.php`
- Default: user=root, password=(empty)

### API Key Error
- Verify API key in `config/config.php`
- Test API key validity at Google Makersuite
- Check internet connection

### Cart Not Loading
- Clear browser cache
- Check browser console for errors
- Ensure localStorage is enabled

### Chatbox Not Working
- Check if JavaScript is enabled
- Verify API key is set correctly
- Check browser console for errors

## Future Enhancements

- User registration and login
- Payment gateway integration
- Email notifications
- Admin dashboard
- Product reviews and ratings
- Inventory management
- Multi-language support
- Advanced search and filtering

## Code Comments

All code includes detailed comments explaining:
- Function purposes
- Variable meanings
- Complex logic
- Security measures

This makes it easy for beginners to understand and modify the code.

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

## Performance Tips

- Optimize product images
- Use CDN for static files
- Implement caching
- Compress CSS/JS files
- Use lazy loading for images

## Security Tips

- Keep PHP updated
- Use HTTPS in production
- Implement rate limiting
- Add CAPTCHA to contact form
- Regular backups
- Monitor error logs

## License

This project is for educational purposes.

## Support

For issues or questions:
- Check the troubleshooting section
- Review code comments
- Check browser console for errors
- Test database connection

---

**Created:** 2024
**Version:** 1.0
**Status:** Production Ready
Thats it