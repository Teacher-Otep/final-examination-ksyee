<?php
// Include the database connection file
require_once _DIR_ . '/db.php';

try {
    // Verify if the $pdo object is properly set and is an instance of PDO
    if (isset($pdo) && $pdo instanceof PDO) {
        // Test the connection by executing a simple query
        $stmt = $pdo->query("SELECT 1");
        if ($stmt) {
            echo "Database connection is active and working!";
        } else {
            echo "Database connection is established, but the test query failed.";
        }
    } else {
        throw new Exception("Database connection is not properly configured.");
    }
} catch (Exception $e) {
    // Handle any exceptions and display the error message
    echo "Error: " . htmlspecialchars($e->getMessage());
}
?>