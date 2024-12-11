<?php
// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';


// Lấy thông tin người dùng
if (isset($_GET['id'])) {
    $id_doctor = $_GET['id'];
    $sql = "SELECT * FROM login_doctor WHERE id_doctor=$id_doctor";
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
    <title>Chỉnh sửa </title>
</head>
<body>
    <h2>Chỉnh sửa </h2>
    <form method="POST" action="process_doctor.php">
        <input type="hidden" name="action" value="update_doctor">
        <input type="hidden" name="id_doctor" value="<?php echo $user['id_doctor']; ?>">
        
        <label>Tên bác sĩ :</label>
        <input type="text" name="name_doctor" value="<?php echo $user['name_doctor']; ?>" required><br>
        
        <label>Chuyên khoa :</label>
        <input type="text" name="department" value="<?php echo $user['department']; ?>" required><br>
        
        <label>SĐT :</label>
        <input type="text" name="phone_doctor" value="<?php echo $user['phone_doctor']; ?>" required><br>
        
        <label>Email :</label>
        <input type="email" name="email_doctor" value="<?php echo $user['email_doctor']; ?>" readonly><br>
        
        <input type="submit" value="Cập nhật">
    </form>
</body>
</html>

