<?php
// send_message.php
session_start();
require_once 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simple validation
    $errors = [];
    
    if (empty($_POST['name'])) {
        $errors[] = "Name is required";
    }
    
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    
    if (empty($_POST['message'])) {
        $errors[] = "Message cannot be empty";
    }

    if (empty($errors)) {
        
        $_SESSION['success'] = "Thank you! Your message has been sent.";
    } else {
        $_SESSION['errors'] = $errors;
    }
}

header('Location: contact.php');
exit();