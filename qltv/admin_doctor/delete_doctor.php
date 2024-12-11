<?php
// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';


// Lấy id_user từ GET
if (isset($_GET['id'])) {
    $id_doctor= $_GET['id'];
    $sql = "DELETE FROM login_doctor WHERE id_doctor=$id_doctor";

    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully!";
        header("Location: ../index_admin.php"); // Redirect back to the main page
        exit;
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}

$conn->close();
?>
