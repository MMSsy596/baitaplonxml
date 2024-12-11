<?php
// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_clinic = (int)$_POST['id_clinic'];
    $name_clinic = $conn->real_escape_string($_POST['name_clinic']);
    $hospital_bills = (float)$_POST['hospital_bills'];

    $sql = "UPDATE list_clinic 
            SET name_clinic='$name_clinic', Hospital_bills=$hospital_bills 
            WHERE id_clinic=$id_clinic";

    if ($conn->query($sql)) {
        echo "Cập nhật thông tin phòng khám thành công!";
        header("Location: ../index_admin.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

$conn->close();
?>
