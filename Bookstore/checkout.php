<?php

require_once 'includes/auth_check.php';
include('includes/db_connect.php');
include('includes/header.php');

// Redirect if cart is empty
if (empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit();
}

// Fetch user details
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, email, address, postcode FROM customer WHERE USIID = ?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Calculate total and store in session
$total = 0;
foreach ($_SESSION['cart'] as $isbn => $quantity) {
    $stmt = $conn->prepare("SELECT price FROM book WHERE ISBN = ?");
    $stmt->bind_param("s", $isbn);
    $stmt->execute();
    $book = $stmt->get_result()->fetch_assoc();
    $total += $book['price'] * $quantity;
}
$_SESSION['cart_total'] = $total; 
?>
<main class="checkout-page">
    <h1>Checkout</h1>
    
    <!-- Order Summary -->
    <div class="order-summary">
        <h2>Order Details</h2>
        <?php 
        $total = 0;
        foreach ($_SESSION['cart'] as $isbn => $quantity): 
            $stmt = $conn->prepare("SELECT * FROM book WHERE ISBN = ?");
            $stmt->bind_param("s", $isbn);
            $stmt->execute();
            $book = $stmt->get_result()->fetch_assoc();
            $subtotal = $book['price'] * $quantity;
            $total += $subtotal;
        ?>
        <div class="order-item">
            <h3><?= htmlspecialchars($book['book_title']) ?> (x<?= $quantity ?>)</h3>
            <p>Price: $<?= number_format($book['price'], 2) ?></p>
            <p>Subtotal: $<?= number_format($subtotal, 2) ?></p>
        </div>
        <?php endforeach; ?>
        <div class="order-total">
            <h3>Total: $<?= number_format($total, 2) ?></h3>
        </div>
    </div>

    <!-- Checkout Form -->
    <form action="checkout_process.php" method="POST" class="checkout-form">
        <!-- User Details -->
        <div class="form-section">
            <h2>Customer Information</h2>
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required 
                       value="<?= htmlspecialchars($user['name'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required 
                       value="<?= htmlspecialchars($user['email'] ?? '') ?>" disabled>
                <input type="hidden" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="address">Address (optional)</label>
                <input type="text" id="address" name="address" 
                       value="<?= htmlspecialchars($user['address'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="postcode">Postcode (optional)</label>
                <input type="text" id="postcode" name="postcode" 
                       value="<?= htmlspecialchars($user['postcode'] ?? '') ?>">
            </div>
        </div>

        <!-- Payment Details -->
        <div class="form-section">
            <h2>Payment Information</h2>
            <div class="form-group">
                <label for="card_number">Card Number</label>
                <input type="text" id="card_number" name="card_number" 
                       placeholder="4242 4242 4242 4242" 
                       pattern="\d{4} \d{4} \d{4} \d{4}" 
                       title="16-digit card number with spaces" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="expiry">Expiry (MM/YY)</label>
                    <input type="text" id="expiry" name="expiry" 
                           placeholder="MM/YY" 
                           pattern="(0[1-9]|1[0-2])\/\d{2}" 
                           title="MM/YY format" required>
                </div>
                <div class="form-group">
                    <label for="cvc">CVC</label>
                    <input type="text" id="cvc" name="cvc" 
                           placeholder="123" 
                           pattern="\d{3}" 
                           title="3-digit CVC" required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn-submit">Place Order</button>
    </form>
</main>


</body>
</html>