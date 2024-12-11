<?php
// Kiểm tra và khởi động session nếu chưa được khởi động
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "1121";
$dbname = "loginclinic";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kiểm tra xem bác sĩ đã đăng nhập chưa
if (!isset($_SESSION['email_doctor'])) {
    echo "<script>
            alert('Vui lòng đăng nhập trước!');
            window.location.href = 'login.php';
          </script>";
    exit();
}

// Lấy email bác sĩ từ session
$email_doctor = $_SESSION['email_doctor'];

// Lấy id_clinic từ URL (nếu có)
if (isset($_GET['id'])) {
    $id_clinic = $_GET['id'];

    // Truy vấn xóa phòng khám
    $delete_sql = "DELETE FROM list_clinic WHERE id_clinic = ? AND email_doctor = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("is", $id_clinic, $email_doctor);

    if ($delete_stmt->execute()) {
        echo "<script>alert('Xóa phòng khám thành công'); window.location.href = 'information_doctor.php';</script>";
    } else {
        echo "<script>alert('Xóa phòng khám thất bại'); window.location.href = 'information_doctor.php';</script>";
    }
} else {
    echo "<script>alert('Không có mã phòng khám'); window.location.href = 'information_doctor.php';</script>";
}

$delete_stmt->close();
$conn->close();
?>
