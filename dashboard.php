<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #28a745;
            color: white;
            font-family: Arial, sans-serif;
            flex-direction: column;
        }
        h2 {
            font-size: 24px;
        }
        a {
            background: white;
            color: #28a745;
            padding: 10px;
            text-decoration: none;
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <h2>Welcome, <?php echo $_SESSION['user']; ?> 🎉</h2>
    <a href="logout.php">Logout</a>

</body>
</html>
