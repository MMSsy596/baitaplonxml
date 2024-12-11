<?php
session_start();

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['id'])) {
    echo "<script>
            alert('Vui lòng đăng nhập trước!');
            window.location.href = 'login.php';
          </script>";
    exit();
}

// Lấy thông tin người dùng từ session
$name = $_SESSION['name'];
$phone = $_SESSION['phone'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin cá nhân</title>
</head>
<body>
    <h1>Chỉnh sửa thông tin cá nhân</h1>
    <form method="POST" action="update_profile.php">
        <label for="name">Tên:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br><br>
        <label for="phone">Số điện thoại:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required><br><br>
        <button type="submit">Cập nhật</button>
        <a href="information.php">Hủy bỏ</a>
    </form>
</body>
</html>
