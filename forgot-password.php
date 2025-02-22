<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mybro_db";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("❌ Database Connection Failed: " . $conn->connect_error);
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "❌ Invalid email format!";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $token = bin2hex(random_bytes(50)); 
            $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));
            
            $stmt = $conn->prepare("UPDATE users SET reset_token = ?, token_expiry = ? WHERE email = ?");
            $stmt->bind_param("sss", $token, $expiry, $email);
            $stmt->execute();

            $reset_link = "http://localhost/reset-password.php?token=" . $token;
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['otp_email'] = $email;

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'himanshushuklahs5@gmail.com'; // ✅ Replace with your Gmail
                $mail->Password = 'mtxw qipq iyuz karf'; // ✅ Replace with your App Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('himanshushuklahs5@gmail.com', 'MyBro');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Password Reset Request';
                $mail->Body = "<p>Click the link below to reset your password:</p>
                               <p><a href='$reset_link'>$reset_link</a></p>
                               <p>Your OTP: <strong>$otp</strong></p>";

                $mail->send();

                // ✅ Redirect to verify-otp.php after sending OTP
                header("Location: verify-otp.php");
                exit(); // ✅ STOP script execution after redirect

            } catch (Exception $e) {
                $message = "❌ Email sending failed: " . $mail->ErrorInfo;
            }
        } else {
            $message = "❌ Email not found!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        /* Google Font */
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Orbitron', sans-serif;
        }

        body {
            background: #000;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .forgot-box {
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            background: rgba(0, 0, 0, 0.9);
            box-shadow: 0px 0px 15px cyan;
            border: 2px solid cyan;
            text-align: center;
            transition: 0.3s;
        }

        .forgot-box:hover {
            box-shadow: 0px 0px 25px cyan;
        }

        h2 {
            font-size: 24px;
            text-transform: uppercase;
            margin-bottom: 20px;
            color: cyan;
        }

        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid cyan;
            background: transparent;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            outline: none;
            transition: 0.3s;
        }

        input[type="email"]:focus {
            border-color: lime;
            box-shadow: 0px 0px 10px lime;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: cyan;
            color: black;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            text-transform: uppercase;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn:hover {
            background: lime;
            box-shadow: 0px 0px 15px lime;
            transform: scale(1.05);
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }

        a.btn {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            background: red;
            color: white;
            padding: 10px;
            border-radius: 5px;
            transition: 0.3s;
        }

        a.btn:hover {
            background: orangered;
            box-shadow: 0px 0px 10px red;
        }

    </style>
</head>
<body>
    <div class="forgot-box">
        <h2>Forgot Password</h2>
        <form action="" method="POST">
            <input type="email" name="email" placeholder="Enter your email" required>
            <button type="submit" class="btn">Send Reset Link & OTP</button>
        </form>
        <p class="error-message"><?php if (!empty($message)) echo $message; ?></p>
        <a href="login.php" class="btn">Back to Login</a>
    </div>
</body>
</html>
