<?php
// auth_check.php
session_start();


$allowed_pages = ['login.php', 'signup.php'];
$current_page = basename($_SERVER['PHP_SELF']);

// Only check authentication for protected pages
if (!in_array($current_page, $allowed_pages)) {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        header("Location: login.php");
        exit();
    }
}
?>