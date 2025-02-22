<?php
session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_otp = $_POST['otp'];

    if (isset($_SESSION['otp']) && $_SESSION['otp'] == $entered_otp) {
        $_SESSION['otp_verified'] = true; // OTP verified flag
        header("Location: reset-password.php"); // Redirect to reset password page
        exit();
    } else {
        $message = "❌ Invalid OTP. Try again!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
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

        .otp-box {
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

        input[type="number"] {
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

        input[type="number"]:focus {
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

    </style>
</head>
<body>
    <div class="otp-box">
        <h2>Enter OTP</h2>
        <form action="" method="POST">
            <input type="number" name="otp" placeholder="Enter OTP" required>
            <button type="submit" class="btn">Verify OTP</button>
        </form>
        <p class="message"><?php if (!empty($message)) echo $message; ?></p>
    </div>
</body>
</html>
