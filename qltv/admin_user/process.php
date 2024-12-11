<?php
// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'add_user') {
        // Thêm người dùng mới
        $name_user = $_POST['name_user'];
        $email_user = $_POST['email_user'];
        $phone_user = $_POST['phone_user'];

        $sql = "INSERT INTO login_user (name_user, email_user, phone_user) 
                VALUES ('$name_user', '$email_user', '$phone_user')";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../index_admin.php"); // Redirect to main page after adding
        } else {
            echo "Error: " . $conn->error;
        }

    } elseif ($_POST['action'] == 'update_user') {
        // Chỉnh sửa người dùng
        $id_user = $_POST['id_user'];
        $name_user = $_POST['name_user'];
        $email_user = $_POST['email_user'];
        $phone_user = $_POST['phone_user'];

        $sql = "UPDATE login_user SET name_user='$name_user', email_user='$email_user', phone_user='$phone_user' 
                WHERE id_user=$id_user";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../index_admin.php");// Redirect to main page after updating
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$conn->close();
?>
