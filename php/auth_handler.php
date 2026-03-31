<?php
// Authentication handler for AJAX requests
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/auth.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    
    if ($action === 'signup') {
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
        
        // Validate passwords match
        if ($password !== $confirm_password) {
            echo json_encode(['success' => false, 'message' => 'Passwords do not match']);
            exit();
        }
        
        // Validate password length
        if (strlen($password) < 6) {
            echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters']);
            exit();
        }
        
        $result = registerUser($conn, $name, $email, $password);
        
        if ($result['success']) {
            // Auto login after signup
            loginUser($conn, $email, $password);
            echo json_encode(['success' => true, 'message' => 'Account created successfully']);
        } else {
            echo json_encode($result);
        }
        exit();
    }
    
    if ($action === 'login') {
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        
        $result = loginUser($conn, $email, $password);
        echo json_encode($result);
        exit();
    }
}

?>
