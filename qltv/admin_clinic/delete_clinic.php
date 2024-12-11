<?php
// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';


// Xóa phòng khám theo id_clinic
if (isset($_GET['id'])) {
    $id_clinic = (int)$_GET['id'];

    $sql = "DELETE FROM list_clinic WHERE id_clinic=$id_clinic";

    if ($conn->query($sql)) {
        header("Location: ../index_admin.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }
} else {
    die("Không tìm thấy ID phòng khám!");
}

$conn->close();
?>
