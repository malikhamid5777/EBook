<?php
// forgot-password.php
require_once 'includes/auth_check.php';
include('includes/db_connect.php');
include('includes/header.php');

// Redirect logged-in users
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    if (empty($email)) {
        $error = 'Please enter your email address';
    } else {
        // Dummy success message (no actual password reset functionality)
        $success = 'If an account exists with this email, we\'ve sent reset instructions.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Bookstore</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<main class="auth-page">
    <div class="auth-form">
        <h2><i class="fas fa-unlock-alt"></i> Password Recovery</h2>
        
        <?php if (!empty($error)): ?>
            <div class="alert error">
                <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert success">
                <i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label><i class="fas fa-envelope"></i> Email:</label>
                <input type="email" name="email" required 
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>

            <button type="submit" class="btn-auth">
                <i class="fas fa-paper-plane"></i> Send Reset Link
            </button>
        </form>

        <div class="auth-links">
            <p>Remember your password? <a href="login.php">Login here</a></p>
            <p>Don't have an account? <a href="signup.php">Create one</a></p>
        </div>
    </div>
</main>

</body>
</html>