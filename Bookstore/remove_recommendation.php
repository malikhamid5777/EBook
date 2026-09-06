<?php
require_once 'includes/db_connect.php';
require_once 'includes/auth_check.php';

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Session validation
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Authentication required. Please login.', 401);
    }

    // Validate and sanitize ISBN
    $isbn = $_GET['isbn'] ?? '';
    if (!preg_match('/^[0-9\-]{10,17}$/', $isbn)) {
        throw new Exception('Invalid ISBN format', 400);
    }

    // Verify book exists
    $check_stmt = $conn->prepare("SELECT ISBN FROM book WHERE ISBN = ?");
    $check_stmt->bind_param("s", $isbn);
    $check_stmt->execute();
    if (!$check_stmt->get_result()->num_rows) {
        throw new Exception('Book not found in database', 404);
    }

    // Record removal with transaction
    $conn->begin_transaction();
    
    try {
        // Insert/update removal record
        $stmt = $conn->prepare("INSERT INTO customerbooks 
            (USIID, ISBN, removed, interaction_date)
            VALUES (?, ?, 1, NOW())
            ON DUPLICATE KEY UPDATE
            removed = 1,
            interaction_date = NOW()");
        $stmt->bind_param("ss", $_SESSION['user_id'], $isbn);
        
        if (!$stmt->execute()) {
            throw new Exception("Database update failed: " . $stmt->error, 500);
        }

        // Get replacement recommendation
        $newBook = getNewRecommendation($conn, $_SESSION['user_id'], $isbn, $_GET['genre']);
        $conn->commit();
        
        echo json_encode([
            'success' => true,
            'newBook' => $newBook,
            'removedISBN' => $isbn
        ]);

    } catch (Exception $e) {
        $conn->rollback();
        throw $e;
    }

} catch (Exception $e) {
    http_response_code($e->getCode() ?: 500);
    error_log("[Remove Recommendation] " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'errorCode' => $e->getCode()
    ]);
}
function getNewRecommendation($conn, $userId, $excludedIsbn, $genre) {
    // Add validation for genre
    if (empty($genre)) {
        throw new Exception("Genre parameter is required for recommendations.");
    }
    
    $sql = "SELECT b.* 
            FROM book b
            LEFT JOIN customerbooks cb 
                ON b.ISBN = cb.ISBN 
                AND cb.USIID = ?
            WHERE (cb.removed IS NULL OR cb.removed = 0)
 AND (cb.bought IS NULL OR cb.bought = 0)
                AND b.ISBN != ?
                AND b.genre = ?
            ORDER BY RAND()
            LIMIT 1";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $userId, $excludedIsbn, $genre);
    
    if (!$stmt->execute() || !$result = $stmt->get_result()) {
        throw new Exception("Recommendation query failed: " . $stmt->error);
    }
    
    return $result->fetch_assoc() ?: null;
}
?>