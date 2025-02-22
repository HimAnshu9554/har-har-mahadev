<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$database = "mybro_db";
$port = 3307; // MySQL Port

$conn = new mysqli($host, $user, $password, $database, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ Initialize message variable
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if email already exists
    $check_email = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $check_email->store_result();
    
    if ($check_email->num_rows > 0) {
        $message = "Email already exists! Please use another email.";
    } else {
        // Insert user
        $sql = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $sql->bind_param("sss", $name, $email, $password);

        if ($sql->execute()) {
            $_SESSION['user_name'] = $name;
            echo "<script>alert('Registration Successful!'); window.location.href='welcome.php';</script>";
            exit();
        } else {
            $message = "Error: " . $sql->error;
        }
        $sql->close();
    }
    $check_email->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            overflow: hidden;
        }
        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 255, 255, 0.3);
            text-align: center;
            border: 2px solid rgba(255, 255, 255, 0.2);
            width: 380px;
        }
        h2 {
            color: #00ffff;
            font-size: 24px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            outline: none;
            text-align: center;
            transition: 0.3s;
        }
        input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        input:focus {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
            border: 1px solid #00ffff;
            box-shadow: 0px 0px 10px #00ffff;
        }
        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            transition: 0.3s;
            box-shadow: 0px 0px 10px #00c6ff;
        }
        button:hover {
            background: linear-gradient(135deg, #0072ff, #00c6ff);
            transform: scale(1.05);
            box-shadow: 0px 0px 20px #00c6ff;
        }
        .links {
            margin-top: 15px;
            font-size: 14px;
        }
        .links a {
            color: #00ffff;
            text-decoration: none;
            transition: 0.3s;
        }
        .links a:hover {
            text-decoration: underline;
            color: #00c6ff;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Register</h2>
        <form action="" method="POST">
            <input type="text" name="name" placeholder="Enter Name" required>
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit">Register</button>
        </form>
        
        <!-- ✅ Error Message -->
        <?php if (!empty($message)) : ?>
            <p class="error-message"><?php echo $message; ?></p>
        <?php endif; ?>

        <!-- ✅ Login Button -->
        <a href="login.php"><button class="login-btn">Login</button></a>
    </div>

</body>
</html>
