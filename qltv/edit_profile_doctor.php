<?php
session_start();

// Kiểm tra nếu bác sĩ đã đăng nhập
if (!isset($_SESSION['id_doctor'])) {
    echo "<script>
            alert('Vui lòng đăng nhập trước!');
            window.location.href = 'login.php';
          </script>";
    exit();
}

// Lấy thông tin bác sĩ từ session để hiển thị trên form
$current_name = $_SESSION['name_doctor'];
$current_department = $_SESSION['department'];
$current_phone = $_SESSION['phone_doctor'];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin bác sĩ</title>
</head>
<body>
    <h1>Chỉnh sửa thông tin bác sĩ</h1>
    <form method="POST" action="update_doctor_profile.php">
        <label for="name_doctor">Tên bác sĩ:</label><br>
        <input type="text" id="name_doctor" name="name_doctor" value="<?php echo htmlspecialchars($current_name); ?>" required><br><br>

        <label for="department">Khoa:</label><br>
        <input type="text" id="department" name="department" value="<?php echo htmlspecialchars($current_department); ?>" required><br><br>

        <label for="phone_doctor">Số điện thoại:</label><br>
        <input type="text" id="phone_doctor" name="phone_doctor" value="<?php echo htmlspecialchars($current_phone); ?>" required><br><br>

        <button type="submit">Cập nhật</button>
    </form>
</body>
</html>
