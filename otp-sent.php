<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mybro_db";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if email exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $otp = rand(100000, 999999); // Generate OTP
        $_SESSION['otp'] = $otp;
        $_SESSION['otp_email'] = $email;

        // Store OTP in database (optional)
        $stmt = $conn->prepare("UPDATE users SET otp = ? WHERE email = ?");
        $stmt->bind_param("ss", $otp, $email);
        $stmt->execute();

        // Redirect to OTP confirmation page
        header("Location: otp-sent.php");
        exit();
    } else {
        $message = "❌ Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <form action="" method="POST">
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit">Send OTP</button>
    </form>

    <p><?php echo $message; ?></p>
    <a href="login.php">Back to Login</a>
</body>
</html>
