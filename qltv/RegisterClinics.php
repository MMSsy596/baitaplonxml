<?php
session_start();

// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';


// Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION['email']) || !isset($_SESSION['name'])) {
    echo "<script>
            alert('Vui lòng đăng nhập trước!');
            window.location.href = 'login.php';
          </script>";
    exit();
}

// Lấy thông tin người dùng từ session
$id = $_SESSION['id'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];

// Truy vấn danh sách phòng khám
$sql_clinics = "SELECT * FROM list_clinic";
$result_clinics = $conn->query($sql_clinics);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Phòng Khám</title>
</head>
<body>
    <h1>Danh Sách Phòng Khám</h1>
    <p>Chào mừng, <?php echo htmlspecialchars($name); ?> (<?php echo htmlspecialchars($email); ?>)</p>

    <form method="POST" action="register_clinic.php">
        <h2>Chọn phòng khám để đăng ký</h2>
        <select name="id_clinic" required>
            <option value="">-- Chọn phòng khám --</option>
            <?php
            if ($result_clinics->num_rows > 0) {
                while ($clinic = $result_clinics->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($clinic['id_clinic']) . "'>" 
                        . htmlspecialchars($clinic['name_clinic']) 
                        . " - Bác sĩ: " . htmlspecialchars($clinic['name_doctor']) . "</option>";
                }
            } else {
                echo "<option value=''>Không có phòng khám nào!</option>";
            }
            ?>
        </select>
        <br><br>
        <button type="submit">Đăng Ký</button>
    </form>

    <br>
    <a href="index.php">Quay lại trang chính</a>
</body>
</html>

<?php
// Đóng kết nối
$conn->close();
?>
