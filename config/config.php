<?php
// Global configuration file

// Gemini API Key (Replace with your actual API key)
// Get your API key from: https://makersuite.google.com/app/apikey
define('GEMINI_API_KEY', '');
define('GEMINI_API_URL', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent');

// Session configuration
define('SESSION_TIMEOUT', 1800); // 30 minutes

// Include database config
require_once 'db.php';


?>

