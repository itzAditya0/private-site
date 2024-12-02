<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: index.html"); // Redirect to login page
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Private Section</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }
        h1 {
            color: #007BFF;
        }
        .logout {
            padding: 10px 20px;
            background-color: #FF4136;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Welcome to Your Private Section</h1>
    <p>This content is only visible to logged-in users.</p>
    <button class="logout" onclick="logout()">Logout</button>

    <script>
        function logout() {
            fetch("logout.php").then(() => {
                window.location.href = "index.html";
            });
        }
    </script>
</body>
</html>
