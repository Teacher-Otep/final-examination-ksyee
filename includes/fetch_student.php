<?php
// Include the database connection file
require_once _DIR_ . '/db.php';

try {
    // Prepare and execute the SELECT query
    $query = "SELECT id, surname, name, middlename, address, contact_number FROM students";
    $stmt = $pdo->query($query);

    // Fetch all rows from the query result
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($students)) {
        // Display the student data in an HTML table
        echo "<table border='1' style='width: 100%; border-collapse: collapse;'>";
        echo "<thead>
                <tr>
                    <th>ID</th>
                    <th>Surname</th>
                    <th>Name</th>
                    <th>Middle Name</th>
                    <th>Address</th>
                    <th>Contact Number</th>
                </tr>
              </thead>";
        echo "<tbody>";

        foreach ($students as $student) {
            echo "<tr>
                    <td>" . htmlspecialchars($student['id']) . "</td>
                    <td>" . htmlspecialchars($student['surname']) . "</td>
                    <td>" . htmlspecialchars($student['name']) . "</td>
                    <td>" . htmlspecialchars($student['middlename']) . "</td>
                    <td>" . htmlspecialchars($student['address']) . "</td>
                    <td>" . htmlspecialchars($student['contact_number']) . "</td>
                  </tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No student records found in the database.</p>";
    }
} catch (PDOException $e) {
    // Handle database errors
    echo "<p>Error fetching student data: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>