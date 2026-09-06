<?php
session_start();
require_once 'includes/auth_check.php';
include('includes/db_connect.php');

// Validate payment data
$errors = [];
$card_number = preg_replace('/\s+/', '', $_POST['card_number']);
if (!preg_match('/^\d{16}$/', $card_number)) $errors[] = "Invalid card number";

// Validate expiry (MM/YY)
if (!preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $_POST['expiry'])) {
    $errors[] = "Invalid expiry date";
}

// Validate CVC
if (!preg_match('/^\d{3}$/', $_POST['cvc'])) {
    $errors[] = "Invalid CVC";
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: checkout.php');
    exit();
}

// Generate order ID
$order_id = 'ORD-' . strtoupper(uniqid());

try {
    $conn->begin_transaction();

    
    $stmt = $conn->prepare("INSERT INTO orders 
        (order_id, USIID, total_amount, payment_status, shipping_address, shipping_postcode)
        VALUES (?, ?, ?, 'completed', ?, ?)");
    
    $stmt->bind_param("ssdss",
        $order_id,
        $_SESSION['user_id'],
        $_SESSION['cart_total'], 
        $_POST['address'],
        $_POST['postcode']
    );
    $stmt->execute();

    // 2. Process order items
    foreach ($_SESSION['cart'] as $isbn => $quantity) {
        // Get current price
        $price_stmt = $conn->prepare("SELECT price FROM book WHERE ISBN = ?");
        $price_stmt->bind_param("s", $isbn);
        $price_stmt->execute();
        $price = $price_stmt->get_result()->fetch_assoc()['price'];

        // Insert into order_items (FIXED COLUMN NAME)
        $item_stmt = $conn->prepare("INSERT INTO order_items 
            (order_id, ISBN, quantity, price_at_purchase)
            VALUES (?, ?, ?, ?)");
        $item_stmt->bind_param("ssid", $order_id, $isbn, $quantity, $price);
        $item_stmt->execute();

        // Update customerbooks
        $update_stmt = $conn->prepare("INSERT INTO customerbooks 
            (USIID, ISBN, bought, interaction_date, quantity)
            VALUES (?, ?, 1, NOW(), ?)
            ON DUPLICATE KEY UPDATE bought=1, quantity=quantity+?");
        $update_stmt->bind_param("ssii", $_SESSION['user_id'], $isbn, $quantity, $quantity);
        $update_stmt->execute();
    }

    $conn->commit();
    
    // Clear cart and redirect
    unset($_SESSION['cart']);
    $_SESSION['order_id'] = $order_id;
    header('Location: confirmation.php');

} catch (Exception $e) {
    $conn->rollback();
    die("Order failed: " . $e->getMessage());
}