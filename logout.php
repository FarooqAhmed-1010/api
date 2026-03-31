<?php
// Logout handler
session_start();
session_destroy();

// Redirect to home page
header('Location: index.php');
exit();
?>
