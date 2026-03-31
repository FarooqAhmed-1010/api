# Quick Start Checklist

Follow these steps to get your Computer Parts Shop running:

## Pre-Setup
- [ ] XAMPP is installed and running
- [ ] Apache and MySQL services are started
- [ ] You have a Google Gemini API key (get it free at https://makersuite.google.com/app/apikey)

## Step 1: Database Setup
- [ ] Navigate to http://localhost/api/setup_database.php
- [ ] Database is created successfully
- [ ] Sample products are inserted

## Step 2: Configuration
- [ ] Open config/config.php
- [ ] Replace YOUR_GEMINI_API_KEY_HERE with your actual API key
- [ ] Save the file

## Step 3: Launch Website
- [ ] Open http://localhost/api/ in browser
- [ ] Home page loads correctly
- [ ] Navigation bar works
- [ ] Chatbox appears in bottom-right

## Step 4: Test Features
- [ ] Click "Shop Now" to view products
- [ ] Click on a product to see details
- [ ] Add items to cart
- [ ] View cart page
- [ ] Try checkout process
- [ ] Test chatbox with a question
- [ ] Test contact form

## Step 5: Troubleshooting
If something doesn't work:
- [ ] Check browser console for JavaScript errors (F12)
- [ ] Verify MySQL is running
- [ ] Check config/config.php has correct database info
- [ ] Verify API key is correct
- [ ] Clear browser cache

## File Summary

✅ **6 HTML Pages**
- index.php (Home)
- products.php (Products listing)
- product-detail.php (Product details)
- cart.php (Shopping cart)
- checkout.php (Checkout)
- contact.php (Contact)

✅ **3 Backend PHP Files**
- php/cart.php (Cart operations)
- php/checkout.php (Order processing)
- php/chatbot.php (Gemini API integration)

✅ **2 Config Files**
- config/db.php (Database config)
- config/config.php (Global config)

✅ **7 JavaScript Files**
- js/main.js (Global utilities)
- js/products.js (Products page)
- js/product-detail.js (Product details)
- js/cart.js (Cart management)
- js/checkout.js (Checkout logic)
- js/contact.js (Contact form)
- js/chatbox.js (AI chatbox)

✅ **1 CSS File**
- css/style.css (Complete styling)

✅ **Setup Files**
- setup_database.php (Database setup)
- README.md (Full documentation)
- SETUP_CHECKLIST.md (This file)

## Key Features

✅ Complete e-commerce functionality
✅ AI-powered chatbox with Gemini API
✅ Shopping cart with localStorage
✅ Order management
✅ Responsive design (mobile-friendly)
✅ Security best practices
✅ Beginner-friendly code with comments

## Next Steps

1. Customize products in the database
2. Update company information in footer
3. Add real product images
4. Implement email notifications
5. Add user registration/login
6. Integrate payment gateway

## Emergency Recovery

If database gets corrupted:
1. Delete the database from phpMyAdmin
2. Run setup_database.php again
3. All data will be restored

## Mobile Testing

- Open http://localhost/api on phone
- Website should be fully responsive
- Chatbox works on mobile
- All features accessible

---

Your Computer Parts Shop is ready to go! 🎉
