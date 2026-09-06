<?php
session_start();
include('includes/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $address = trim($_POST['address']);
    $postcode = trim($_POST['postcode']);

    // Validate inputs
    if(empty($name) || empty($email) || empty($password) || empty($address) || empty($postcode)) {
        $_SESSION['error'] = "All fields are required";
        header('Location: signup.php');
        exit();
    }

    // Check if email exists
    $stmt = $conn->prepare("SELECT USIID FROM customer WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    if($stmt->get_result()->num_rows > 0) {
        $_SESSION['error'] = "Email already registered";
        header('Location: signup.php');
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Generate USID
    $usid = 'cust_' . uniqid() . '.' . rand(10000000, 99999999);

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO customer (USIID, name, email, password, address, postcode, created_at) 
                           VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssssss", $usid, $name, $email, $hashed_password, $address, $postcode);
    
    if($stmt->execute()) {
        $_SESSION['success'] = "Registration successful! Please login";
        header('Location: login.php');
    } else {
        $_SESSION['error'] = "Registration failed. Please try again";
        header('Location: signup.php');
    }
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include('includes/header.php'); ?>

<main class="auth-page">
    <div class="auth-form">
        <h2>Create Account</h2>
        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert error"><?= $_SESSION['error'] ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <form method="post">
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Address:</label>
                <input type="text" name="address" required>
            </div>
            <div class="form-group">
                <label>Postcode:</label>
                <input type="text" name="postcode" required>
            </div>
            <button type="submit" class="btn-auth">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</main>

</body>
</html>