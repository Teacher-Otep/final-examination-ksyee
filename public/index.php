<?php require_once __DIR__ . '/../includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operations</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
            <img src="../images/northhub.svg" id="logo"></img>
        <img src="../images/kim.svg.svg" id="logo" style="cursor: pointer;">
        <button class="navbarbuttons" onclick="showSection('create')"> Create </button>
        <button class="navbarbuttons" onclick="showSection('read')"> Read </button>
        <button class="navbarbuttons" onclick="showSection('update')"> Update </button>
        <button class="navbarbuttons" onclick="showSection('delete')"> Delete </button>
    </nav>

    <section id="home" class="homecontent"> 
        <h1 class="splash">Welcome to Student Management System</h1>
        <h2 class="splash">A Project in Integrative Programming Technologies</h2>
    </section>
    
    <section id="create" class="content">
        <h1 class="contenttitle"> Insert New Student </h1>
        <form action="../includes/insert.php" method="POST">
            <label for="surname" class="label">Surname</label>
            <input type="text" name="surname" id="surname" class="field" required><br/>

            <label for="name" class="label">Name</label>
            <input type="text" name="name" id="name" class="field" required><br/>

            <label for="middlename" class="label">Middle name</label>
            <input type="text" name="middlename" id="middlename" class="field"><br/>

            <label for="address" class="label">Address</label>
            <input type="text" name="address" id="address" class="field"><br/>

            <label for="contact" class="label">Mobile Number</label>
            <input type="text" name="contact" id="contact" class="field"><br/>

            <div id="btncontainer">
                <button type="button" id="clrbtn" class="btns">Clear Fields</button><br/>
                <button type="submit" id="savebtn" class="btns">Save</button>
            </div>
        </form>   
    </section>

    <section id="read" class="content"> 
        <h1 class="contenttitle"> View Students </h1>
        <?php
        try {
            $stmt = $pdo->query("SELECT * FROM students");
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($students) > 0) {
                echo "<table border='1' style='border-collapse: collapse; width: 100%; text-align: left; margin-top: 15px;'>";
                echo "<tr><th>ID</th><th>Surname</th><th>Name</th><th>Middle Name</th><th>Address</th><th>Contact Number</th></tr>";
                foreach ($students as $row) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['id']) . "</td>
                            <td>" . htmlspecialchars($row['surname']) . "</td>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['middlename']) . "</td>
                            <td>" . htmlspecialchars($row['address']) . "</td>
                            <td>" . htmlspecialchars($row['contact_number']) . "</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='label'>No records found in the database.</p>";
            }
        } catch (PDOException $e) {
            echo "Error fetching records: " . $e->getMessage();
        }
        ?>
    </section>

    <section id="update" class="content"> 
        <h1 class="contenttitle"> Update Student Records </h1>
        <form action="../includes/update_action.php" method="POST">
            <label for="update_id" class="label">Select Student ID</label>
            <select name="id" id="update_id" class="field" required>
                <option value="">-- Choose ID --</option>
                <?php
                try {
                    $stmt = $pdo->query("SELECT id, name, surname FROM students");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['id']}'>ID: {$row['id']} - {$row['surname']}, {$row['name']}</option>";
                    }
                } catch (PDOException $e) { /**/ }
                ?>
            </select><br/>

            <label for="update_surname" class="label">New Surname</label>
            <input type="text" name="surname" id="update_surname" class="field" required><br/>

            <label for="update_name" class="label">New Name</label>
            <input type="text" name="name" id="update_name" class="field" required><br/>

            <label for="update_middlename" class="label">New Middle name</label>
            <input type="text" name="middlename" id="update_middlename" class="field"><br/>

            <label for="update_address" class="label">New Address</label>
            <input type="text" name="address" id="update_address" class="field"><br/>

            <label for="update_contact" class="label">New Mobile Number</label>
            <input type="text" name="contact" id="update_contact" class="field"><br/>

            <div id="btncontainer">
                <button type="submit" id="updatebtn" class="btns">Update Record</button>
            </div>
        </form>
    </section>

    <section id="delete" class="content"> 
        <h1 class="contenttitle"> Remove Student Records </h1>
        <form action="../includes/delete_action.php" method="POST">
            <label for="delete_id" class="label">Select Student ID</label>
            <select name="id" id="delete_id" class="field" required>
                <option value="">-- Choose ID to Delete --</option>
                <?php
                try {
                    $stmt = $pdo->query("SELECT id, name, surname FROM students");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['id']}'>ID: {$row['id']} - {$row['surname']}, {$row['name']}</option>";
                    }
                } catch (PDOException $e) { /**/ }
                ?>
            </select><br/>

            <div id="btncontainer">
                <button type="submit" id="deletebtn" class="btns" style="background-color: #ff4d4d; color: white;">Delete Record</button>
            </div>
        </form>
    </section>

    <div id="success-toast" class="toast-hidden">
        Operation Successful!
    </div>

    <script src="script.js"></script>
</body>
</html>