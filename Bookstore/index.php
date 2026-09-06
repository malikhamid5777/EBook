<?php
require_once 'includes/auth_check.php';
include('includes/header.php');
include('includes/db_connect.php');

// Get top 3 rated books based on average rating
$stmt = $conn->prepare("
    SELECT b.*, AVG(r.rating) AS average_rating 
    FROM ratings r
    JOIN book b ON r.ISBN = b.ISBN 
    GROUP BY b.ISBN
    ORDER BY average_rating DESC 
    LIMIT 3
");
$stmt->execute();
$recommended_books = $stmt->get_result();
?>



<main class="index-main">
    <!-- Most Bought Books Carousel -->
    <?php if ($recommended_books->num_rows > 0): ?>
    <section class="most-bought-section">
        <h2>Best Rated Books</h2>
        <div class="most-bought-carousel">
            <button class="carousel-arrow prev"></button>
            <div class="carousel-container">
                <?php while ($book = $recommended_books->fetch_assoc()): ?>
                <div class="carousel-slide">
                    <div class="featured-book">
                        <a href="book.php?isbn=<?= htmlspecialchars($book['ISBN']) ?>">
                            <img src="assets/images/<?= htmlspecialchars($book['image']) ?>" 
                                alt="<?= htmlspecialchars($book['book_title']) ?>">
                            <div class="book-meta">
                                <h3><?= htmlspecialchars($book['book_title']) ?></h3>
                                
                                
                                <!-- Add to Cart Button -->
                                <form method="post" action="add_to_cart.php" class="cart-form">
                                    <input type="hidden" name="isbn" value="<?= htmlspecialchars($book['ISBN']) ?>">
                                    <button type="submit" class="btn-cart">
                                        <i class="fas fa-cart-plus"></i> Add to Cart
                                    </button>
                                </form>
                            </div>
                        </a>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <button class="carousel-arrow next"></button>
        </div>
    </section>
    <?php endif; ?>

    <!-- Genre Section -->
    <section class="genre-section">
        <h2>Browse Genres</h2>
        <div class="genre-grid">
            <?php foreach ($genres as $genre => $genre_name): ?>
                <div class="genre-card">
                    <a href="genre.php?genre=<?= urlencode($genre_name) ?>">
                        <div class="genre-image">
                            <img src="assets/images/genre/<?= 
                                strtolower(str_replace(' ', '-', $genre_name)) 
                            ?>.jpg" alt="<?= htmlspecialchars($genre_name) ?>">
                        </div>
                        <h3 class="genre-title"><?= htmlspecialchars($genre_name) ?></h3>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.querySelector('.most-bought-carousel');
    if (!carousel) return;

    const slides = carousel.querySelectorAll('.carousel-slide');
    const prevBtn = carousel.querySelector('.carousel-arrow.prev');
    const nextBtn = carousel.querySelector('.carousel-arrow.next');
    
    let currentIndex = 0;
    const totalSlides = slides.length;

    function updateCarousel() {
        slides.forEach((slide, index) => {
            slide.classList.remove('active', 'prev', 'next');
            if (index === currentIndex) {
                slide.classList.add('active');
            } else if (index === (currentIndex - 1 + totalSlides) % totalSlides) {
                slide.classList.add('prev');
            } else if (index === (currentIndex + 1) % totalSlides) {
                slide.classList.add('next');
            }
        });
    }

    prevBtn.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateCarousel();
    });

    nextBtn.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateCarousel();
    });

    updateCarousel();
});
</script>
</script>

</body>
</html>
