<?php
require_once 'includes/auth_check.php';

include('includes/db_connect.php');
include('includes/header.php');
// Redirect logged-in users
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate inputs
    if (empty($email) || empty($password)) {
        $error = 'Please fill in all fields';
    } else {
        // Check user exists
        $stmt = $conn->prepare("SELECT USIID, name, password FROM customer WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['USIID'];
                $_SESSION['user_name'] = $user['name'];

                // Redirect to stored URL or homepage
                if (isset($_SESSION['redirect_url'])) {
                    $redirect = $_SESSION['redirect_url'];
                    unset($_SESSION['redirect_url']);
                    header("Location: $redirect");
                } else {
                    header('Location: index.php');
                }
                exit();
            }
        }
        $error = 'Invalid email or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bookstore</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>


<main class="auth-page">
    <div class="auth-form">
        <h2><i class="fas fa-sign-in-alt"></i> User Login</h2>
        
        <?php if (!empty($error)): ?>
            <div class="alert error">
                <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label><i class="fas fa-envelope"></i> Email:</label>
                <input type="email" name="email" required 
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label><i class="fas fa-lock"></i> Password:</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="btn-auth">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </form>

        <div class="auth-links">
            <p>Don't have an account? <a href="signup.php">Create one</a></p>
            <p><a href="forgot-password.php">Forgot password?</a></p>
        </div>
    </div>
</main>

</body>
</html>