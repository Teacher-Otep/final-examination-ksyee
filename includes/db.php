<?php

$host = "localhost";
$user = "root";      
$pass = "";        
$db = "dbstudents";  

$connection = new mysqli($host, $user, $pass, $db);

if ($connection->connect_error) {
    die("Failed to connect to the database: " . $connection->connect_error);
}

// If successful
echo "Database connection established successfully!";
?>