<?php
$conn = new mysqli("localhost", "your_database_user", "your_database_password", "your_database_name");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
