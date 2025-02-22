<?php
session_start();
$message = "";

if (!isset($_SESSION['otp_verified']) || $_SESSION['otp_verified'] !== true) {
    die("Unauthorized Access!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['password'];
    $email = $_SESSION['otp_email'];

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    
    $conn = new mysqli("localhost", "root", "", "mybro_db", 3307);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, token_expiry = NULL WHERE email = ?");
    $stmt->bind_param("ss", $hashed_password, $email);
    if ($stmt->execute()) {
        $message = "✅ Password Reset Successfully!";
        session_destroy();
    } else {
        $message = "❌ Error resetting password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Orbitron', sans-serif;
        }

        body {
            background: black;
            color: white;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            animation: neonBg 3s infinite alternate;
        }

        @keyframes neonBg {
            0% { background: black; }
            100% { background: #020202; }
        }

        .reset-box {
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            background: rgba(0, 0, 0, 0.8);
            box-shadow: 0px 0px 20px cyan, 0px 0px 40px cyan inset;
            border: 2px solid cyan;
            text-align: center;
            transition: 0.3s;
            animation: neonBox 1.5s infinite alternate;
        }

        @keyframes neonBox {
            0% { box-shadow: 0px 0px 15px cyan, 0px 0px 30px cyan inset; }
            100% { box-shadow: 0px 0px 25px cyan, 0px 0px 50px cyan inset; }
        }

        h2 {
            font-size: 26px;
            text-transform: uppercase;
            margin-bottom: 20px;
            color: cyan;
            text-shadow: 0px 0px 10px cyan;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid cyan;
            background: transparent;
            color: white;
            font-size: 18px;
            border-radius: 5px;
            outline: none;
            transition: 0.3s;
            text-align: center;
            animation: glowInput 1.5s infinite alternate;
        }

        @keyframes glowInput {
            0% { box-shadow: 0px 0px 10px cyan; }
            100% { box-shadow: 0px 0px 20px cyan; }
        }

        input[type="password"]:focus {
            border-color: lime;
            box-shadow: 0px 0px 15px lime;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: cyan;
            color: black;
            border: none;
            cursor: pointer;
            font-size: 18px;
            border-radius: 5px;
            text-transform: uppercase;
            font-weight: bold;
            transition: 0.3s;
            animation: glowButton 1.5s infinite alternate;
        }

        @keyframes glowButton {
            0% { box-shadow: 0px 0px 15px cyan; }
            100% { box-shadow: 0px 0px 30px cyan; }
        }

        .btn:hover {
            background: lime;
            box-shadow: 0px 0px 20px lime, 0px 0px 40px lime inset;
            transform: scale(1.05);
        }

        .message {
            color: red;
            font-weight: bold;
            margin-top: 10px;
            text-shadow: 0px 0px 10px red;
        }

        .back-btn {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            background: red;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: 0.3s;
            font-weight: bold;
            text-transform: uppercase;
            animation: glowBack 1.5s infinite alternate;
        }

        @keyframes glowBack {
            0% { box-shadow: 0px 0px 10px red; }
            100% { box-shadow: 0px 0px 20px red; }
        }

        .back-btn:hover {
            background: orangered;
            box-shadow: 0px 0px 15px orangered;
        }

    </style>
</head>
<body>
    <div class="reset-box">
        <h2>Reset Password</h2>
        <form action="" method="POST">
            <input type="password" name="password" placeholder="Enter new password" required>
            <button type="submit" class="btn">Reset Password</button>
        </form>
        <p class="message"><?php if (!empty($message)) echo $message; ?></p>
        <a href="login.php" class="back-btn">Back to Login</a>
    </div>
</body>
</html>
