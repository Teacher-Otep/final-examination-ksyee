<?php
// Include the database connection file
require_once _DIR_ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_record'])) {
    // Sanitize and validate input data
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $middlename = filter_input(INPUT_POST, 'middlename', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $contact = filter_input(INPUT_POST, 'contact_number', FILTER_SANITIZE_STRING);

    if ($id && $surname && $name && $middlename && $address && $contact) {
        try {
         
            $query = "UPDATE students 
                      SET surname = :surname, 
                          name = :name, 
                          middlename = :middlename, 
                          address = :address, 
                          contact_number = :contact 
                      WHERE id = :id";

            $stmt = $pdo->prepare($query);

            $stmt->execute([
                ':id' => $id,
                ':surname' => $surname,
                ':name' => $name,
                ':middlename' => $middlename,
                ':address' => $address,
                ':contact' => $contact
            ]);

            header("Location: ../public/index.php?status=success");
            exit();
        } catch (PDOException $e) {

            echo "Database error: " . htmlspecialchars($e->getMessage());
        }
    } else {

        echo "Invalid input. Please ensure all fields are filled out correctly.";
    }
} else {

    echo "Invalid request. Please submit the form correctly.";
}
?>