<?php
require_once 'includes/auth_check.php';
include('includes/db_connect.php');
include('includes/header.php');

$user_id = $_SESSION['user_id'];
$errors = [];
$success = '';

// Handle Profile Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $postcode = $_POST['postcode'];

    $stmt = $conn->prepare("UPDATE customer SET name=?, address=?, postcode=? WHERE USIID=?");
    $stmt->bind_param("ssss", $name, $address, $postcode, $user_id);
    if ($stmt->execute()) {
        $success = "Profile updated successfully!";
    } else {
        $errors[] = "Profile update failed";
    }
}

// Handle Password Change
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Verify current password
    $stmt = $conn->prepare("SELECT password FROM customer WHERE USIID=?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    
    if (password_verify($current_password, $result['password'])) {
        if ($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE customer SET password=? WHERE USIID=?");
            $stmt->bind_param("ss", $hashed_password, $user_id);
            if ($stmt->execute()) {
                $success = "Password changed successfully!";
            }
        } else {
            $errors[] = "New passwords do not match";
        }
    } else {
        $errors[] = "Current password is incorrect";
    }
}

// Handle Rating Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_rating'])) {
    $isbn = $_POST['isbn'];
    $rating = $_POST['rating'];

    $stmt = $conn->prepare("INSERT INTO ratings (USIID, ISBN, rating) VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE rating=?");
    $stmt->bind_param("ssii", $user_id, $isbn, $rating, $rating);
    $stmt->execute();
}

// Handle Account Deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_account'])) {
    $stmt = $conn->prepare("DELETE FROM customer WHERE USIID=?");
    $stmt->bind_param("s", $user_id);
    if ($stmt->execute()) {
        session_destroy();
        header("Location: login.php");
        exit();
    }
}

// Get User Details
$stmt = $conn->prepare("SELECT * FROM customer WHERE USIID=?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Get Purchased Books
$purchased_stmt = $conn->prepare("
    SELECT b.ISBN, b.book_title, b.image, r.rating 
    FROM customerbooks cb
    JOIN book b ON cb.ISBN = b.ISBN
    LEFT JOIN ratings r ON cb.ISBN = r.ISBN AND cb.USIID = r.USIID
    WHERE cb.USIID=? AND cb.bought=1
");
$purchased_stmt->bind_param("s", $user_id);
$purchased_stmt->execute();
$purchased_books = $purchased_stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .rating-stars { 
            unicode-bidi: bidi-override; 
            direction: rtl;
        }
        .rating-stars input { display: none; }
        .rating-stars label { 
            font-size: 24px; 
            padding: 0 3px; 
            cursor: pointer; 
            color: #ddd;
        }
        .rating-stars input:checked ~ label,
        .rating-stars label:hover,
        .rating-stars label:hover ~ label { color: #ffd700; }
    </style>
</head>
<body>
    <main class="profile-page">
        <div class="profile-container">
            <?php if (!empty($errors)): ?>
                <div class="alert error"><?= implode('<br>', $errors) ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert success"><?= $success ?></div>
            <?php endif; ?>

            <!-- Profile Section -->
            <section class="profile-section">
                <h1>Profile Details</h1>
                <form method="POST">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" value="<?= htmlspecialchars($user['email']) ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>Address:</label>
                        <input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>">
                    </div>
                    <div class="form-group">
                        <label>Postcode:</label>
                        <input type="text" name="postcode" value="<?= htmlspecialchars($user['postcode']) ?>">
                    </div>
                    <button type="submit" name="update_profile" class="btn-submit">Update Profile</button>
                </form>
            </section>

            <!-- Purchased Books Section -->
            <section class="purchased-books">
                <h2>Purchased Books</h2>
                <?php if ($purchased_books->num_rows > 0): ?>
                    <div class="books-grid">
                        <?php while ($book = $purchased_books->fetch_assoc()): ?>
                            <div class="book-card">
                                <img src="assets/images/<?= $book['image'] ?>" alt="<?= $book['book_title'] ?>">
                                <h3><?= $book['book_title'] ?></h3>
                                <form method="POST" class="rating-form">
                                    <div class="rating-stars">
                                        <?php for ($i = 5; $i >= 1; $i--): ?>
                                            <input type="radio" id="star<?= $i ?>-<?= $book['ISBN'] ?>" 
                                                   name="rating" value="<?= $i ?>" 
                                                   <?= $book['rating'] == $i ? 'checked' : '' ?>>
                                            <label for="star<?= $i ?>-<?= $book['ISBN'] ?>">★</label>
                                        <?php endfor; ?>
                                    </div>
                                    <input type="hidden" name="isbn" value="<?= $book['ISBN'] ?>">
                                    <button type="submit" name="submit_rating" class="btn-rate">Rate</button>
                                </form>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <p>No purchased books found.</p>
                <?php endif; ?>
            </section>

            <!-- Change Password Section -->
            <section class="password-section">
                <h2>Change Password</h2>
                <form method="POST">
                    <div class="form-group">
                        <label>Current Password:</label>
                        <input type="password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label>New Password:</label>
                        <input type="password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password:</label>
                        <input type="password" name="confirm_password" required>
                    </div>
                    <button type="submit" name="change_password" class="btn-submit">Change Password</button>
                </form>
            </section>

            <!-- Delete Account Section -->
            <section class="delete-section">
                <h2>Delete Account</h2>
                <form method="POST" onsubmit="return confirm('This will permanently delete your account!')">
                    <button type="submit" name="delete_account" class="btn-delete">
                        <i class="fas fa-trash"></i> Delete Account Permanently
                    </button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>