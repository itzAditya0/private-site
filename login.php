<?php
session_start();

// Database connection details
$host = "localhost"; // or your server IP
$db = "u390136364_secure_login";
$user = "u390136364_root";
$password = "8ph?89ClzUm~";

// Connect to the database
$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die(
        json_encode([
            "status" => "error",
            "message" => "Database connection failed: " . $conn->connect_error,
        ])
    );
}

// Process POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"] ?? null;
    $password = $_POST["password"] ?? null;

    if (!$username || !$password) {
        die(
            json_encode([
                "status" => "error",
                "message" => "Missing credentials.",
            ])
        );
    }

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    if (!$stmt) {
        die(
            json_encode([
                "status" => "error",
                "message" => "Query preparation failed: " . $conn->error,
            ])
        );
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Invalid username or password.",
            ]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "No such user."]);
    }

    $stmt->close();
}
$conn->close();
?>
