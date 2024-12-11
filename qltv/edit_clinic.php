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

    // Truy vấn lấy thông tin phòng khám
    $sql = "SELECT * FROM list_clinic WHERE id_clinic = ? AND email_doctor = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $id_clinic, $email_doctor);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Lấy dữ liệu phòng khám
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Không tìm thấy phòng khám này'); window.location.href = 'index_doctor.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Không có mã phòng khám'); window.location.href = 'index_doctor.php';</script>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa phòng khám</title>
</head>
<body>

<h2>Sửa thông tin phòng khám</h2>

<form method="POST" action="update_clinic.php?id=<?php echo $id_clinic; ?>">
    <label for="name_clinic">Tên phòng khám:</label>
    <input type="text" name="name_clinic" id="name_clinic" value="<?php echo htmlspecialchars($row['name_clinic']); ?>" required><br><br>

    <label for="hospital_bills">Hóa đơn:</label>
    <input type="number" name="hospital_bills" id="hospital_bills" value="<?php echo htmlspecialchars($row['Hospital_bills']); ?>" required><br><br>

    <button type="submit">Cập nhật</button>
</form>

</body>
</html>

<?php
// Đóng kết nối
$stmt->close();
$conn->close();
?>
