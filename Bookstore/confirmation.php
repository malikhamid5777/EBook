<?php
require_once 'includes/auth_check.php';
include('includes/db_connect.php');
include('includes/header.php');

// Get order details
$stmt = $conn->prepare("
    SELECT o.*, c.name, c.email 
    FROM orders o
    JOIN customer c ON o.USIID = c.USIID
    WHERE o.order_id = ?
");
$stmt->bind_param("s", $_SESSION['order_id']);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

// Get order items with corrected price column
$items_stmt = $conn->prepare("
    SELECT 
        oi.order_item_id, 
        oi.order_id, 
        oi.ISBN, 
        oi.quantity, 
        oi.price_at_purchase AS price,  -- Aliased to match 'price' key
        b.book_title, 
        b.image 
    FROM order_items oi
    JOIN book b ON oi.ISBN = b.ISBN
    WHERE oi.order_id = ?
");
$items_stmt->bind_param("s", $_SESSION['order_id']);
$items_stmt->execute();
$items = $items_stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <main class="confirmation-page">
        <div class="confirmation-container">
            <div class="confirmation-header">
                <i class="fas fa-check-circle success-icon"></i>
                <h1>Order Confirmed!</h1>
                <p>Thank you for your purchase, <?= htmlspecialchars($order['name']) ?>!</p>
            </div>

            <div class="order-details">
                <div class="detail-box">
                    <h2>Order Summary</h2>
                    <div class="detail-item">
                        <span>Order ID:</span>
                        <span><?= $order['order_id'] ?></span>
                    </div>
                    <div class="detail-item">
                        <span>Order Date:</span>
                        <span><?= date('F j, Y, g:i a', strtotime($order['order_date'])) ?></span>
                    </div>
                    <div class="detail-item">
                        <span>Shipping to:</span>
                        <span>
                            <?= htmlspecialchars($order['shipping_address']) ?><br>
                            <?= htmlspecialchars($order['shipping_postcode']) ?>
                        </span>
                    </div>
                </div>

                <div class="items-box">
                    <h2>Items Purchased</h2>
                    <?php while ($item = $items->fetch_assoc()): ?>
                    <div class="item">
                        <img src="assets/images/<?= htmlspecialchars($item['image']) ?>" 
                             alt="<?= htmlspecialchars($item['book_title']) ?>">
                        <div class="item-info">
                            <h3><?= htmlspecialchars($item['book_title']) ?></h3>
                            <p>Quantity: <?= $item['quantity'] ?></p>
                            <p>Price: $<?= number_format($item['price'], 2) ?></p>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>

                <div class="total-box">
                    <!-- Fixed total_amount reference -->
                    <h3>Total Paid: $<?= number_format($order['total_amount'], 2) ?></h3>
                </div>
            </div>

            <div class="confirmation-actions">
                <a href="index.php" class="btn-continue">
                    <i class="fas fa-shopping-bag"></i> Continue Shopping
                </a>
            </div>
        </div>
    </main>
</body>
</html>