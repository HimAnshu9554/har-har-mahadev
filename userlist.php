<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$database = "mybro_db";
$port = 3307;

$conn = new mysqli($host, $user, $password, $database, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete User
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if ($conn->query("DELETE FROM users WHERE id=$id") === TRUE) {
        $message = "✅ User Deleted Successfully!";
        $status = "success";
    } else {
        $message = "❌ Error Deleting User!";
        $status = "error";
    }
    header("Location: userlist.php?message=" . urlencode($message) . "&status=" . $status);
    exit();
}

// Fetch Users
$result = $conn->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background: #121212;
            color: white;
            text-align: center;
        }
        h2 {
            margin: 20px 0;
            font-size: 26px;
            text-transform: uppercase;
            font-weight: bold;
            color: cyan;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #222;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 255, 255, 0.3);
        }
        th, td {
            padding: 12px;
            border: 1px solid cyan;
            text-align: center;
        }
        th {
            background: cyan;
            color: black;
            font-size: 18px;
        }
        td {
            font-size: 16px;
        }
        a {
            padding: 8px 15px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .edit {
            background: orange;
        }
        .delete {
            background: red;
        }
        .delete:hover {
            background: darkred;
        }
        .edit:hover {
            background: darkorange;
        }
        .message-box {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 15px 20px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            display: none;
            z-index: 9999;
            text-align: center;
            width: 300px;
        }
        .success {
            background: #4CAF50;
            color: white;
        }
        .error {
            background: #f44336;
            color: white;
        }
    </style>
</head>
<body>

    <h2>User List</h2>

    <?php if (isset($_GET['message']) && isset($_GET['status'])): ?>
        <div class="message-box <?php echo $_GET['status']; ?>" id="popup">
            <?php echo urldecode($_GET['message']); ?>
        </div>
        <script>
            document.getElementById('popup').style.display = 'block';
            setTimeout(() => {
                document.getElementById('popup').style.display = 'none';
                window.location.href = 'userlist.php';
            }, 2000);
        </script>
    <?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
                <a href="edit-user.php?id=<?php echo $row['id']; ?>" class="edit">Edit</a>
                <a href="userlist.php?delete=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
