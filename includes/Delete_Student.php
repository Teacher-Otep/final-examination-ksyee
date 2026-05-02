<?php
// Include the database connection file
require_once _DIR_ . '/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        // Prepare the DELETE statement
        $stmt = $pdo->prepare("DELETE FROM students WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the index page with a success message
            header("Location: /public/index.php?status=success");
            exit();
        } else {
            // Redirect with an error message if deletion fails
            header("Location: /public/index.php?status=error");
            exit();
        }
    } catch (PDOException $e) {
        // Display the error message
        echo "Error: " . $e->getMessage();
    }
} else {
    // Redirect if the request is invalid
    header("Location: /public/index.php?status=invalid_request");
    exit();
}
?>