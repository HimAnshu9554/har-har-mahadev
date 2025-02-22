<?php
include 'db.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM users WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        $message = "✅ User Deleted Successfully!";
        $status = "success";
    } else {
        $message = "❌ Error Deleting User!";
        $status = "error";
    }

    // Redirect to user list with message
    header("Location: userlist.php?message=" . urlencode($message) . "&status=" . $status);
    exit();
}
?>
