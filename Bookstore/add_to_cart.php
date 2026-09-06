<?php
require_once 'includes/auth_check.php';
include('includes/db_connect.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isbn = $_POST['isbn'] ?? '';
    
    // Validate ISBN exists
    $stmt = $conn->prepare("SELECT ISBN FROM book WHERE ISBN = ?");
    $stmt->bind_param("s", $isbn);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        if (isset($_SESSION['cart'][$isbn])) {
            $_SESSION['cart'][$isbn]++;
        } else {
            $_SESSION['cart'][$isbn] = 1;
        }
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}