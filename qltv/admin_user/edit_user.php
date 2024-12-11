<?php
// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';


// Lấy thông tin người dùng
if (isset($_GET['id'])) {
    $id_user = (int)$_GET['id'];
    $sql = "SELECT * FROM login_user WHERE id_user=$id_user";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
} else {
    die("Không có thông tin người dùng!");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa bệnh nhân</title>
</head>
<body>
    <h2>Chỉnh sửa bệnh nhân</h2>
    <form method="POST" action="process.php">
        <input type="hidden" name="action" value="update_user">
        <input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
        <label>Tên bệnh nhân:</label>
        <input type="text" name="name_user" value="<?php echo $user['name_user']; ?>" required><br>
        <label>Email người bệnh:</label>
        <input type="email" name="email_user" value="<?php echo $user['email_user']; ?>" required><br>
        <label>SĐT người bệnh:</label>
        <input type="text" name="phone_user" value="<?php echo $user['phone_user']; ?>" required><br>
        <input type="submit" value="Cập nhật">
    </form>
</body>
</html>
