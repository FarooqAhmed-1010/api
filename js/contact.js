// ============================================
// CONTACT.JS - Contact Page
// ============================================

// Handle contact form submission
function handleContactSubmit(event) {
    event.preventDefault();
    
    const form = event.target;
    const name = document.getElementById('contact-name').value.trim();
    const email = document.getElementById('contact-email').value.trim();
    const subject = document.getElementById('contact-subject').value.trim();
    const message = document.getElementById('contact-message').value.trim();
    const statusDiv = document.getElementById('contact-status');
    
    // Basic validation
    if (!name || !email || !subject || !message) {
        showStatus('Please fill in all fields', 'error');
        return;
    }
    
    // Validate email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        showStatus('Please enter a valid email', 'error');
        return;
    }
    
    // Simulate message sending (in production, this would be sent to a backend)
    showStatus('Sending message...', 'info');
    
    setTimeout(() => {
        showStatus('Thank you for your message! We\'ll get back to you soon at ' + email, 'success');
        form.reset();
    }, 1500);
}

// Show status message
function showStatus(message, type) {
    const statusDiv = document.getElementById('contact-status');
    statusDiv.textContent = message;
    statusDiv.className = type;
}

// Initialize contact page
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', handleContactSubmit);
    }
});
