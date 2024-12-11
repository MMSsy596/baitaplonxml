<?php
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

// Kiểm tra nếu ID được gửi qua URL
if (isset($_GET['id'])) {
    $registrationId = $_GET['id'];

    // Xóa bản ghi
    $sql_delete = "DELETE FROM register_clinic WHERE id_registration = ?";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("i", $registrationId);

    if ($stmt->execute()) {
        echo "<script>
                alert('Xóa đăng ký thành công!');
                window.location.href = 'information.php';
              </script>";
    } else {
        echo "<script>
                alert('Xóa thất bại!');
                window.location.href = 'information.php';
              </script>";
    }

    $stmt->close();
}

$conn->close();
?>
