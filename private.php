<?php
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("Location: index.html");
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
            margin-top: 50px;
        }
        .logout {
            background-color: #FF4136;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>
    <p>This is a private section of the website.</p>
    <button class="logout" onclick="logout()">Logout</button>

    <script>
        function logout() {
            fetch("logout.php").then(() => window.location.href = "index.html");
        }
    </script>
</body>
</html>
