// ============================================
// CHATBOX.JS - AI Chatbox with Gemini API
// ============================================

// Initialize chatbox
function initializeChatbox() {
    const chatboxContainer = document.getElementById('chatbox-container');
    const chatboxToggle = document.getElementById('chatbox-toggle');
    const chatboxSend = document.getElementById('chatbox-send');
    const chatboxInput = document.getElementById('chatbox-input');
    
    if (!chatboxContainer) return;
    
    // Toggle chatbox minimize/maximize
    if (chatboxToggle) {
        chatboxToggle.addEventListener('click', function() {
            chatboxContainer.classList.toggle('minimized');
            chatboxToggle.textContent = chatboxContainer.classList.contains('minimized') ? '+' : '−';
        });
    }
    
    // Send message on button click
    if (chatboxSend) {
        chatboxSend.addEventListener('click', sendMessage);
    }
    
    // Send message on Enter key
    if (chatboxInput) {
        chatboxInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    }
    
    // Add welcome message
    addChatMessage('Hello! 👋 I\'m here to help you find the perfect computer parts. What are you looking for?', 'bot');
}

// Add message to chat
function addChatMessage(message, sender = 'user') {
    const messagesContainer = document.getElementById('chatbox-messages');
    
    const messageDiv = document.createElement('div');
    messageDiv.className = `chat-message ${sender}`;
    
    const bubble = document.createElement('div');
    bubble.className = 'chat-bubble';
    bubble.textContent = message;
    
    messageDiv.appendChild(bubble);
    messagesContainer.appendChild(messageDiv);
    
    // Scroll to bottom
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

// Send message to chatbot
function sendMessage() {
    const chatboxInput = document.getElementById('chatbox-input');
    const message = chatboxInput.value.trim();
    
    if (!message) return;
    
    // Add user message to chat
    addChatMessage(message, 'user');
    chatboxInput.value = '';
    
    // Show typing indicator
    addChatMessage('Typing...', 'bot');
    const typingMessage = document.querySelector('.chat-message.bot:last-child');
    
    // Send request to backend
    fetch('php/chatbot.php', {
        method: 'POST',
        body: new URLSearchParams({
            message: message
        })
    })
    .then(response => response.json())
    .then(data => {
        // Remove typing indicator
        if (typingMessage) {
            typingMessage.remove();
        }
        
        if (data.success) {
            addChatMessage(data.message, 'bot');
        } else {
            addChatMessage('Sorry, I encountered an error. ' + data.message, 'bot');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        if (typingMessage) {
            typingMessage.remove();
        }
        addChatMessage('Sorry, I\'m having trouble connecting. Please try again.', 'bot');
    });
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    initializeChatbox();
});
