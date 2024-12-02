<?php
session_start();

// Database connection details
$host = "145.223.17.62"; // or your server IP
$db = "u390136364_secure_login";
$user = "u390136364_root";
$password = "8ph?89ClzUm~";

$conn = new mysqli($host, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute query
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['loggedin'] = true;
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid username or password."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid username or password."]);
    }

    $stmt->close();
}
$conn->close();
?>
