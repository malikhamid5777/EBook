<?php
// book.php
require_once 'includes/auth_check.php';
include('includes/db_connect.php');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);



// Get ISBN from URL parameter
$isbn = isset($_GET['isbn']) ? trim($_GET['isbn']) : '';

// Validate ISBN
if(empty($isbn)) {
    die("ISBN parameter is missing!");
}

try {
    // Fetch book details using prepared statement
    $stmt = $conn->prepare("SELECT * FROM book WHERE ISBN = ?");
    $stmt->bind_param("s", $isbn);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();

    if(!$book) {
        throw new Exception("Book not found!");
    }
} catch(Exception $e) {
    die($e->getMessage());
}
$stmt_recommended = $conn->prepare("
    SELECT b.*, SUM(cb.quantity) AS total_bought 
    FROM customerbooks cb
    JOIN book b ON cb.ISBN = b.ISBN 
    WHERE cb.bought = 1
    GROUP BY cb.ISBN 
    ORDER BY total_bought DESC 
    LIMIT 4
");
$stmt_recommended->execute();
$recommended_books = $stmt_recommended->get_result();


include('includes/header.php');
?>

<section class="recommendations">
    <h2>Most Purchased Books</h2>
    <div class="recommendations-grid">
        <?php while($rec_book = $recommended_books->fetch_assoc()): ?>
        <div class="recommended-book">
            <a href="book.php?isbn=<?= htmlspecialchars($rec_book['ISBN']) ?>">
                <img src="assets/images/<?= htmlspecialchars($rec_book['image']) ?>" 
                     alt="<?= htmlspecialchars($rec_book['book_title']) ?>">
                <h3><?= htmlspecialchars($rec_book['book_title']) ?></h3>
                <p class="price">$<?= number_format($rec_book['price'], 2) ?></p>
            </a>
            <form method="post" action="add_to_cart.php">
                <input type="hidden" name="isbn" value="<?= htmlspecialchars($rec_book['ISBN']) ?>">
                <button type="submit" class="btn-cart">
                    <i class="fas fa-cart-plus"></i> Add to Cart
                </button>
            </form>
        </div>
        <?php endwhile; ?>
    </div>
</section>

<main class="book-detail">
    <div class="book-container">
        <div class="book-image">
            <img src="assets/images/<?= htmlspecialchars($book['image']) ?>" 
                 alt="<?= htmlspecialchars($book['book_title']) ?>">
        </div>
        
        <div class="book-info">
            <h1><?= htmlspecialchars($book['book_title']) ?></h1>
            
            <div class="meta">
                <span class="price">$<?= number_format($book['price'], 2) ?></span>
                <span class="genre"><?= htmlspecialchars($book['genre']) ?></span>
            </div>
            
            <div class="description">
                <?= nl2br(htmlspecialchars($book['description'])) ?>
            </div>

            <!-- Add to Cart Form -->
            <div class="add-to-cart">
                <form method="post" action="add_to_cart.php">
                    <input type="hidden" name="isbn" value="<?= htmlspecialchars($book['ISBN']) ?>">
                    <button type="submit" class="btn-cart">
                        <i class="fas fa-cart-plus"></i> Add to Cart
                    </button>
                </form>
            </div>

            <a href="genre.php?genre=<?= urlencode($book['genre']) ?>" class="btn-back">
                ← Back to <?= htmlspecialchars($book['genre']) ?>
            </a>
        </div>
    </div>
</main>

</body>
</html>