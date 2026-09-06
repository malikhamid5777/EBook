<?php
require_once 'includes/auth_check.php';
include('includes/db_connect.php');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get genre from URL parameter
$genre = isset($_GET['genre']) ? $_GET['genre'] : '';

// Validate input
if(empty($genre)) {
    die("Genre parameter is missing!");
}

// Fetch books for the selected genre
$sql = "SELECT * FROM book WHERE genre = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $genre);
$stmt->execute();
$result = $stmt->get_result();

$rec_sql = "SELECT b.* 
            FROM book b
            LEFT JOIN customerbooks cb 
                ON b.ISBN = cb.ISBN 
                AND cb.USIID = ?
            WHERE (cb.removed IS NULL OR cb.removed = 0)
            AND b.genre = ?
            AND (cb.bought IS NULL OR cb.bought = 0)
            ORDER BY RAND()
            LIMIT 4";
$rec_stmt = $conn->prepare($rec_sql);
$rec_stmt->bind_param("ss", $_SESSION['user_id'], $genre);
$rec_stmt->execute();
$rec_result = $rec_stmt->get_result();

// Page title
$page_title = htmlspecialchars($genre) . " Books";

include('includes/header.php');

// Additional session validation
if (!isset($_SESSION['user_id'])) {
    die("User authentication required");
}
?>

<main class="genre-main">
    <div class="recommendations-section">
        <h2>Recommended for You</h2>
        <div class="recommendations-grid">
            <?php if ($rec_result->num_rows > 0): ?>
                <?php while($rec_book = $rec_result->fetch_assoc()): ?>
                    <div class="recommended-book" data-isbn="<?= htmlspecialchars($rec_book['ISBN']) ?>">
                        <div class="rec-book-image">
                            <img src="assets/images/<?= htmlspecialchars($rec_book['image']) ?>"
                                 alt="<?= htmlspecialchars($rec_book['book_title']) ?>">
                        </div>
                        <div class="rec-book-details">
                            <h4><?= htmlspecialchars($rec_book['book_title']) ?></h4>
                            <span class="rec-genre"><?= htmlspecialchars($rec_book['genre']) ?></span>
                            <div class="rec-book-actions">
                                <form method="post" action="add_to_cart.php" class="inline-form">
                                    <input type="hidden" name="isbn" value="<?= htmlspecialchars($rec_book['ISBN']) ?>">
                                    <button type="submit" class="btn-cart-sm">Add to Cart</button>
                                </form>
                                <button class="btn-remove">
                                    Remove Suggestion
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="no-recommendations">No recommendations available based on your preferences.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="genre-header">
        <h1><?= $page_title ?></h1>
        <p>Showing <?= $result->num_rows ?> books in this category</p>
    </div>

    <div class="books-grid">
        <?php if ($result->num_rows > 0): ?>
            <?php while($book = $result->fetch_assoc()): ?>
                <div class="book-card">
                    <div class="book-image">
                        <img src="assets/images/<?= htmlspecialchars($book['image']) ?>"
                             alt="<?= htmlspecialchars($book['book_title']) ?>">
                    </div>
                    <div class="book-details">
                        <h3><?= htmlspecialchars($book['book_title']) ?></h3>
                        <p class="book-description">
                            <?= substr(htmlspecialchars($book['description']), 0, 150) ?>...
                        </p>
                        <div class="book-meta">
                            <span class="price">$<?= number_format($book['price'], 2) ?></span>
                            <a href="/Bookstore/book.php?isbn=<?= htmlspecialchars($book['ISBN']) ?>"
                               class="btn-view">View Details</a>
                            <form method="post" action="add_to_cart.php">
                                <input type="hidden" name="isbn" value="<?= htmlspecialchars($book['ISBN']) ?>">
                                <button type="submit" class="btn-cart">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-books">No books found in this category.</p>
        <?php endif; ?>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const recommendationsGrid = document.querySelector('.recommendations-grid');

    if (!recommendationsGrid) return;

    recommendationsGrid.addEventListener('click', async (event) => {
        const removeBtn = event.target.closest('.btn-remove');
        if (!removeBtn) return;

        const bookElement = removeBtn.closest('.recommended-book');
        const isbn = bookElement?.dataset?.isbn;
        const genre = new URLSearchParams(window.location.search).get('genre');

        if (!isbn || !genre) {
            console.error('Missing ISBN or genre data');
            return;
        }

        // Visual feedback
        const originalHTML = removeBtn.innerHTML;
        removeBtn.innerHTML = `<i class="fas fa-spinner fa-spin"></i> Removing...`;
        removeBtn.disabled = true;

        try {
            const response = await fetch(`/Bookstore/remove_recommendation.php?isbn=${encodeURIComponent(isbn)}&genre=${encodeURIComponent(genre)}`, {
                headers: { 'Accept': 'application/json' }
            });

            // Handle HTTP errors
            if (!response.ok) {
                const errorText = await response.text();
                throw new Error(`Server error: ${response.status} - ${errorText}`);
            }

            const data = await response.json();
            console.log('Removal Response:', data);

            if (data.success) {
                // Animate removal
                bookElement.classList.add('removing');

                if (data.newBook) {
                    // Delay replacement for smooth transition
                    setTimeout(() => {
                        bookElement.outerHTML = createBookElement(data.newBook);
                    }, 300);
                } else {
                    // Remove element if no replacement
                    setTimeout(() => {
                        bookElement.remove();
                        if (!document.querySelector('.recommended-book')) {
                            showEmptyRecommendations();
                        }
                    }, 500);
                }
            } else {
                throw new Error(data.message || 'Removal failed');
            }

        } catch (error) {
            console.error('Removal Error:', error);
            alert(`Error: ${error.message}`);
            // Restore button state
            removeBtn.innerHTML = originalHTML;
            removeBtn.disabled = false;
        }
    });
});

// Safe HTML generation
const createBookElement = (book) => {
    const escape = (str) => str
        ? str.toString()
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
        : '';

    return `
    <div class="recommended-book" data-isbn="${escape(book?.ISBN)}">
        <div class="rec-book-image">
            <img src="/Bookstore/assets/images/${escape(book?.image)}" 
                 alt="${escape(book?.book_title)}">
        </div>
        <div class="rec-book-details">
            <h4>${escape(book?.book_title)}</h4>
            <span class="rec-genre">${escape(book?.genre)}</span>
            <div class="rec-book-actions">
                <form method="post" action="/Bookstore/add_to_cart.php" class="inline-form">
                    <input type="hidden" name="isbn" value="${escape(book?.ISBN)}">
                    <button type="submit" class="btn-cart-sm">
                        <i class="fas fa-cart-plus"></i> Add to Cart
                    </button>
                </form>
                <button class="btn-remove">
                    <i class="fas fa-times"></i> Remove
                </button>
            </div>
        </div>
    </div>`;
};

const showEmptyRecommendations = () => {
    const container = document.querySelector('.recommendations-grid');
    if (container) {
        container.innerHTML = `
            <div class="no-recommendations">
                <i class="fas fa-book-open"></i>
                <p>No more recommendations in this genre!</p>
            </div>
        `;
    }
};

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    .recommended-book {
        transition: all 0.3s ease;
        opacity: 1;
    }
    
    .recommended-book.removing {
        animation: fadeOutSlide 0.5s ease forwards;
    }
    
    @keyframes fadeOutSlide {
        0% { opacity: 1; transform: translateX(0); }
        100% { opacity: 0; transform: translateX(-100%); }
    }
    
    .no-recommendations {
        text-align: center;
        padding: 2rem;
        color: #666;
    }
`;
document.head.appendChild(style); 
</script>
</body>
</html>