<?php
// Get current user status - for JavaScript to check if logged in
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/auth.php';

header('Content-Type: application/json');

$logged_in = isLoggedIn();
$user_id = getCurrentUserId();
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';

echo json_encode([
    'logged_in' => $logged_in,
    'user_id' => $user_id,
    'user_name' => $user_name
]);
?>
