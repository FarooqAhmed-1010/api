<?php
// Handle Gemini chatbot API requests
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_message = isset($_POST['message']) ? trim($_POST['message']) : '';
    
    if (empty($user_message)) {
        echo json_encode(['success' => false, 'message' => 'Message cannot be empty']);
        exit();
    }
    
    // Check if API key is set
    if (GEMINI_API_KEY === 'YOUR_GEMINI_API_KEY_HERE') {
        echo json_encode([
            'success' => false,
            'message' => 'API key not configured. Please add your Gemini API key in config/config.php'
        ]);
        exit();
    }
    
    // Prepare the request to Gemini API
    $api_key = GEMINI_API_KEY;
    $url = GEMINI_API_URL . '?key=' . $api_key;
    
    $system_prompt = "You are a helpful assistant for a computer parts e-commerce store. You can help customers with product recommendations, specifications, pricing, and general questions about computer hardware. Keep responses concise and friendly.";
    
    $request_data = [
        'contents' => [
            [
                'parts' => [
                    ['text' => $system_prompt . "\n\nCustomer: " . $user_message]
                ]
            ]
        ]
    ];
    
    // Initialize cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_data));
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($http_code === 200) {
        $api_response = json_decode($response, true);
        
        if (isset($api_response['candidates'][0]['content']['parts'][0]['text'])) {
            $bot_message = $api_response['candidates'][0]['content']['parts'][0]['text'];
            echo json_encode([
                'success' => true,
                'message' => $bot_message
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Could not parse API response'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error communicating with AI service. Please try again later.'
        ]);
    }
    
    exit();
}

?>
