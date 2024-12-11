<?php
// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'add_doctor') {
        // Thêm người dùng mới
        $name_doctor = $_POST['name_doctor'];
        $department = $_POST['department'];
        $email_doctor = $_POST['email_doctor'];
        $phone_doctor = $_POST['phone_doctor'];

        $sql = "INSERT INTO login_doctor (name_doctor, department, phone_doctor, email_doctor) 
                VALUES ('$name_doctor','$department', '$phone_doctor','$email_doctor' )";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../index_admin.php"); // Redirect to main page after adding
        } else {
            echo "Error: " . $conn->error;
        }

    } elseif ($_POST['action'] == 'update_doctor') {
        // Chỉnh sửa người dùng
        $id_doctor = $_POST['id_doctor'];
        $name_doctor = $_POST['name_doctor'];
        $department = $_POST['department'];
        $email_doctor = $_POST['email_doctor'];
        $phone_doctor = $_POST['phone_doctor'];

        $sql = "UPDATE login_doctor SET name_doctor='$name_doctor', department='$department', phone_doctor='$phone_doctor' ,email_doctor='$email_doctor'
                WHERE id_doctor=$id_doctor";

        if ($conn->query($sql) === TRUE) {

           // Cập nhật thông tin trong bảng `list_clinic`
           $sql_update_clinic = "UPDATE list_clinic SET name_doctor = ?, department = ? WHERE email_doctor = ?";
           $stmt_update_clinic = $conn->prepare($sql_update_clinic);
           $stmt_update_clinic->bind_param("sss", $name_doctor, $department, $email_doctor); // Sửa $$email_doctor thành $email_doctor
           $stmt_update_clinic->execute();

           header("Location: ../index_admin.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$conn->close();
?>
