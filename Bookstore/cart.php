<?php
require_once 'includes/auth_check.php';
include('includes/db_connect.php');
include('includes/header.php');


// Handle item removal
if (isset($_GET['remove'])) {
    $isbn = $_GET['remove'];
    if (isset($_SESSION['cart'][$isbn])) {
        unset($_SESSION['cart'][$isbn]);
    }
    header('Location: cart.php');
    exit();
}
?>
<main class="cart-page">
    <h1>Shopping Cart</h1>
    <?php if (!empty($_SESSION['cart'])): ?>
        <div class="cart-items">
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
            <div class="cart-item">
                <img src="assets/images/<?= htmlspecialchars($book['image']) ?>" 
                     alt="<?= htmlspecialchars($book['book_title']) ?>">
                <div class="item-info">
                    <h3><?= htmlspecialchars($book['book_title']) ?></h3>
                    <div class="item-details">
                        <p>Quantity: <?= $quantity ?></p>
                        <p>Price: $<?= number_format($book['price'], 2) ?></p>
                        <p>Subtotal: $<?= number_format($subtotal, 2) ?></p>
                    </div>
                    <a href="cart.php?remove=<?= $isbn ?>" class="remove-item">
                        <i class="fas fa-trash-alt"></i> Remove Item
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
            <div class="cart-total">
                <h3>Total: $<?= number_format($total, 2) ?></h3>
                <a href="checkout.php" class="btn-checkout">
                    <i class="fas fa-credit-card"></i> Proceed to Checkout
                </a>
            </div>
        </div>
    <?php else: ?>
        <div class="empty-cart">
            <i class="fas fa-shopping-cart"></i>
            <p>Your cart is empty</p>
        </div>
    <?php endif; ?>
</main>
</body>
</html>