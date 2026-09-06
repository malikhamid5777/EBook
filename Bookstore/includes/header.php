<?php

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


$genres = [
    'Fantasy' => 'Fantasy',
    'Adventure' => 'Adventure',
    'Mystery' => 'Mystery',
    'Science Fiction' => 'Science Fiction',
    'Romance' => 'Romance',
    'Thriller' => 'Thriller',
    'Horror' => 'Horror'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>
    <header>
        <div class="logo-container">
            <img src="assets/images/logo0.png" alt="Bookstore Logo" class="logo">
        </div>
        
        <nav class="main-menu">
            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">Genres ▾</a>
                    <div class="dropdown-content">
                        <?php foreach ($genres as $genre => $genre_name): ?>
                            <a href="genre.php?genre=<?= urlencode($genre_name) ?>"><?= $genre_name ?></a>
                        <?php endforeach; ?>
                    </div>
                </li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                  <li><a href="logout.php">Logout</a></li>
                    
    <li class="profile-icon">
        <a href="profile.php">
            <i class="fas fa-user"></i>
        </a>
    </li>

                 <li class="cart-icon">
            <a href="cart.php">
                <i class="fas fa-shopping-cart"></i>
                <?php if (array_sum($_SESSION['cart']) > 0): ?>
                    <span class="cart-count"><?= array_sum($_SESSION['cart']) ?></span>
                <?php endif; ?>
            </a>
        </li>
            </ul>
        </nav>
    </header>