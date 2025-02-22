<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mybro_db";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("❌ Database Connection Failed: " . $conn->connect_error);
}

// ✅ User ki info get karna
$id = 0; // Default ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT name, email FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
}

// ✅ User update karna
$successMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $new_name = trim($_POST['name']);
    $new_email = trim($_POST['email']);

    $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $new_name, $new_email, $id);

    if ($stmt->execute()) {
        $successMessage = "✅ User Updated Successfully!";
    } else {
        $successMessage = "❌ Error updating user!";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
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
        }

        .edit-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            padding: 30px;
            border-radius: 15px;
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
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .btn {
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
        }

        .btn:hover {
            background: linear-gradient(135deg, #0072ff, #00c6ff);
        }

        .back-to-list {
            margin-top: 15px;
            font-size: 14px;
        }

        .back-to-list a {
            color: #00ffff;
            text-decoration: none;
        }

        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .popup-content button {
            margin-top: 10px;
            padding: 5px 10px;
            border: none;
            background: #0072ff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="edit-box">
        <h2>Edit User</h2>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <button type="submit" class="btn">Update User</button>
        </form>
        <p class="back-to-list"><a href="userlist.php">← Back to User List</a></p>
    </div>

    <?php if (!empty($successMessage)): ?>
    <div id="popup" class="popup">
        <div class="popup-content">
            <p><?php echo $successMessage; ?></p>
            <button onclick="closePopup()">OK</button>
        </div>
    </div>

    <script>
        document.getElementById("popup").style.display = "flex";

        function closePopup() {
            document.getElementById("popup").style.display = "none";
            window.location.href = 'userlist.php';
        }
    </script>
    <?php endif; ?>
</body>
</html>
