<?php
// contact.php

require_once 'includes/auth_check.php';
require_once 'includes/db_connect.php';
include('includes/header.php');

// Initialize variables
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';
?>

<main class="contact-page">
    <div class="contact-container">
        <h1>Contact Bookoria</h1>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert success">
                <?= $_SESSION['success'] ?>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($_SESSION['errors'])): ?>
            <div class="alert error">
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
                <?php unset($_SESSION['errors']); ?>
            </div>
        <?php endif; ?>

        <div class="contact-grid">
            <div class="contact-info">
                <h2>Get in Touch</h2>
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>123 Book Street<br>London, UK</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-phone"></i>
                    <p>+44 020 7946 0814</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <p>bookoria@gmail.com</p>
                </div>
            </div>

            <form class="contact-form" method="POST" action="send_message.php">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" 
                           value="<?= htmlspecialchars($name) ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email"
                           value="<?= htmlspecialchars($email) ?>" required>
                </div>
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject"
                           value="<?= htmlspecialchars($subject) ?>" required>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="5" required><?= 
                        htmlspecialchars($message) 
                    ?></textarea>
                </div>
                <button type="submit" class="btn-submit">Send Message</button>
            </form>
        </div>

        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2483.68038048772!2d-0.1277583846917223!3d51.50073247963425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487604ce3941eb1f%3A0x1a5342fdf089dd67!2s123%20Book%20St%2C%20London!5e0!3m2!1sen!2suk!4v1648823456789!5m2!1sen!2suk" 
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
            </iframe>
        </div>
    </div>
</main>

<style>
.contact-page {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1.5rem;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 3rem;
    margin: 2rem 0;
}

.info-item {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
}

.info-item i {
    font-size: 1.5rem;
    margin-right: 1rem;
    color: #3498db;
}

.contact-form {
    background: #fff;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.map-container {
    margin: 3rem 0;
    border-radius: 10px;
    overflow: hidden;
}

.alert {
    padding: 1rem;
    border-radius: 8px;
    margin: 1rem 0;
}

.success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.btn-submit {
    background: #3498db;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    font-size: 1.1rem;
    transition: background 0.3s ease;
}

.btn-submit:hover {
    background: #2980b9;
}

@media (max-width: 768px) {
    .contact-grid {
        grid-template-columns: 1fr;
    }
}
</style>

</body>
</HTML>
