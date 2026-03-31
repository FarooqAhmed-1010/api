# v2.0 Quick Testing Guide

## ✅ Pre-Setup Checklist

Before testing, ensure:
- [ ] XAMPP running (Apache + MySQL)
- [ ] http://localhost/api/ accessible
- [ ] setup_database.php has been run
- [ ] Gemini API key is set in config/config.php

---

## 🚀 Test Scenarios

### Test 1: Sign Up Flow
```
1. Navigate to http://localhost/api/signup.php
2. Fill in form:
   - Name: John Doe
   - Email: john@example.com
   - Password: TestPass123
   - Confirm: TestPass123
3. Click "Sign Up"
4. Should see success message
5. Should redirect to home page
6. Check Top-Right → should show "👤 John"
✅ PASS if: Redirected to home and username shows
```

### Test 2: Duplicate Email Prevention
```
1. Go to signuppage again
2. Use same email: john@example.com
3. Fill form and submit
4. Should see error: "Email already registered"
5. Should stay on signup page
✅ PASS if: Error displayed
```

### Test 3: Login Flow
```
1. Go to http://localhost/api/logout.php (to logout first)
2. Navigate to http://localhost/api/login.php
3. Enter:
   - Email: john@example.com
   - Password: TestPass123
4. Click "Login"
5. Should see success message
6. Should redirect to home
7. Should show username "👤 John"
✅ PASS if: Logged in successfully
```

### Test 4: Wrong Password
```
1. Go to http://localhost/api/login.php (logout first if needed)
2. Enter:
   - Email: john@example.com
   - Password: WrongPassword
3. Click "Login"
4. Should see error: "Invalid email or password"
5. Should stay on login page
✅ PASS if: Error displayed
```

### Test 5: Add to Cart (Logged In)
```
1. Make sure logged in (username shows)
2. Go to Products page
3. Find a product
4. Set quantity to 2
5. Click "Add to Cart"
6. Should see: "Product added to cart!"
7. Cart badge should show "1" (item count, not product count)
8. Navigate to Cart page
9. Should see the product listed
✅ PASS if: Product appears in cart with quantity
```

### Test 6: Add to Cart (Not Logged In)
```
1. Go to http://localhost/api/logout.php
2. Go to http://localhost/api/products.php
3. Try to add product to cart
4. Should see: "Please login to add items to cart"
5. Should redirect to login page
✅ PASS if: Redirected to login
```

### Test 7: Update Cart Quantity
```
1. Go to cart page (logged in)
2. Find product
3. Change quantity from 2 to 5
4. Should update automatically
5. Total price should update
✅ PASS if: Quantity and total updated
```

### Test 8: Remove from Cart
```
1. Go to cart page
2. Click "Remove" button on a product
3. Product should disappear
4. Cart count badge should decrease
✅ PASS if: Product removed
```

### Test 9: Checkout Flow
```
1. Go to cart page (with items, logged in)
2. Click "Proceed to Checkout"
3. See order summary on right
4. Fill form:
   - Name: John Doe
   - Email: john@example.com
   - Country: USA
   - Address: 123 Main St
5. Click "Place Order"
6. Should see confirmation with Order ID
✅ PASS if: Order confirmation displayed
```

### Test 10: Cart Cleared After Checkout
```
1. After checkout, go to cart page
2. Should be empty with message "Your cart is empty"
✅ PASS if: Cart is empty
```

### Test 11: Database Persistence
```
1. Add items to cart
2. Refresh page (F5)
3. Items should still be there
4. Close browser, reopen
5. Login again
6. Items should still be there
✅ PASS if: Cart persists
```

### Test 12: Logout Flow
```
1. Click username in navbar
2. See dropdown menu
3. Click "Logout"
4. Should redirect to home
5. Navbar should show "Login" & "Sign Up" buttons
✅ PASS if: Logged out successfully
```

### Test 13: UI Styling
```
1. Look at buttons
2. Should have gradient effect
3. Hover over button
4. Should lift up with shadow
5. Look at authentication pages
6. Should have centered form with gradient background
✅ PASS if: Modern UI visible
```

### Test 14: Chatbox Toggle
```
1. Bottom-right corner
2. Should see floating 💬 button
3. Click button
4. Chatbox should open
5. Click '-' in header
6. Chatbox should minimize
7. Click '+' to expand again
✅ PASS if: Toggle works
```

### Test 15: Chat Functionality
```
1. Open chatbox
2. Type: "What GPU do you recommend?"
3. Click Send or press Enter
4. Message should appear as user bubble
5. Bot should respond (requires API key)
6. Response should appear as bot bubble
✅ PASS if: Chat works and response comes
```

### Test 16: Mobile Responsive
```
1. Open Chrome DevTools (F12)
2. Click device toolbar (mobile view)
3. Test different screen sizes:
   - iPhone SE (375px)
   - iPad (768px)
   - Desktop (1920px)
4. Page should reflow properly
5. All buttons clickable
6. Text readable
✅ PASS if: Responsive on all sizes
```

### Test 17: Error Messages
```
Test various error scenarios:
1. Empty form fields → error message
2. Invalid email format → error message
3. Mismatched passwords → error message
4. Out of stock product → cannot add to cart
5. All errors should be clear
✅ PASS if: Error messages helpful
```

### Test 18: Cart Count Badge
```
1. Add 3 items to cart
2. Navigate to different pages
3. Badge should show correct count
4. Add more items  
5. Badge updates in real-time
6. Add same product twice
7. Count should be quantity, not types
✅ PASS if: Badge accurate
```

### Test 19: Product Stock Validation
```
1. Add product with qty 5
2. If only 3 in stock
3. Should show error: "Not enough stock"
4. Should not add to cart
✅ PASS if: Stock validation works
```

### Test 20: Session Persistence
```
1. Add to cart
2. Close browser completely
3. Reopen and navigate to site
4. Login with same credentials
5. Cart should still have items
✅ PASS if: Session restored
```

---

## 📊 Database Verification

### Check Users Table
```sql
SELECT * FROM users;
-- Should show registered users with hashed passwords
```

### Check User Cart
```sql
SELECT u.name, p.product_name, uc.quantity 
FROM user_cart uc
JOIN users u ON uc.user_id = u.id
JOIN products p ON uc.product_id = p.id;
-- Should show users' cart items
```

### Check Orders
```sql
SELECT u.name, o.user_name, o.total_price, o.status
FROM orders o
JOIN users u ON o.user_id = u.id;
-- Should show placed orders linked to users
```

---

## 🔍 Browser Console Debugging

Open DevTools Console (F12) and test:

```javascript
// Check user status
fetch('php/get_user_status.php')
    .then(r => r.json())
    .then(d => console.log(d))
// Should show: {logged_in: true/false, user_id: ..., user_name: ...}

// Check cart count
fetch('php/cart_db.php', {
    method: 'POST',
    body: new URLSearchParams({action: 'get_cart_count'})
})
    .then(r => r.json())
    .then(d => console.log(d))
// Should show: {success: true, count: ...}

// Check if user logged in
console.log(isUserLoggedIn)
// Should show: true/false
```

---

## 🎯 Success Criteria

### Core Features
- ✅ Sign up/Login system works
- ✅ Password hashing verified
- ✅ Database cart persists per user
- ✅ Can add/remove/update cart items
- ✅ Checkout creates orders
- ✅ Orders linked to users in database

### UI/UX
- ✅ Modern gradient buttons
- ✅ Hover effects work
- ✅ Authentication pages styled
- ✅ Responsive design works
- ✅ Real-time cart updates
- ✅ Navbar shows user status

### Functionality
- ✅ Chatbox toggles
- ✅ Error messages display
- ✅ Input validation works
- ✅ Stock validation works
- ✅ Transactions are atomic

---

## 📋 Test Summary Form

Test Date: _______________
Tester: ___________________

| Test # | Name | Result | Notes |
|--------|------|--------|-------|
| 1 | Sign Up | PASS/FAIL | |
| 2 | Duplicate Email | PASS/FAIL | |
| 3 | Login | PASS/FAIL | |
| 4 | Wrong Password | PASS/FAIL | |
| 5 | Add to Cart (Logged In) | PASS/FAIL | |
| 6 | Add to Cart (Not Logged In) | PASS/FAIL | |
| 7 | Update Quantity | PASS/FAIL | |
| 8 | Remove from Cart | PASS/FAIL | |
| 9 | Checkout | PASS/FAIL | |
| 10 | Cart Cleared | PASS/FAIL | |
| 11 | Persistence | PASS/FAIL | |
| 12 | Logout | PASS/FAIL | |
| 13 | UI Styling | PASS/FAIL | |
| 14 | Chatbox Toggle | PASS/FAIL | |
| 15 | Chat Functionality | PASS/FAIL | |
| 16 | Mobile Responsive | PASS/FAIL | |
| 17 | Error Messages | PASS/FAIL | |
| 18 | Cart Count | PASS/FAIL | |
| 19 | Stock Validation | PASS/FAIL | |
| 20 | Session Persistence | PASS/FAIL | |

**Overall Status:** PASS / FAIL

**Issues Found:**
- 
- 

**Comments:**


---

## 🐛 Troubleshooting Common Issues

### Issue: "Please login to add items"
- ✅ Make sure you're logged in
- ✅ Check navbar for username
- ✅ Try logout/login again

### Issue: Cart empty after reload
- ✅ Database connection might be failing
- ✅ Check MySQL is running
- ✅ Check config/db.php credentials

### Issue: Chatbot not responding
- ✅ Verify API key in config.php
- ✅ Check internet connection
- ✅ Open  browser console for errors

### Issue: Buttons not showing gradient
- ✅ Clear browser cache (Ctrl+Shift+Del)
- ✅ Hard refresh (Ctrl+F5)
- ✅ Check CSS file loaded

### Issue: Can't checkout
- ✅ Must be logged in
- ✅ Must have items in cart
- ✅ Form must be completed

---

## ✅ Final Verification

When all tests pass:
1. ✅ Authentication system works
2. ✅ Database cart operational
3. ✅ UI modern and responsive
4. ✅ Chatbox functional
5. ✅ No breaking changes to v1.0
6. ✅ Ready for production use

**You're all set!** 🎉
