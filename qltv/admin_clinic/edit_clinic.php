<?php
// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';


// Lấy thông tin phòng khám từ id_clinic
if (isset($_GET['id'])) {
    $id_clinic = (int)$_GET['id'];
    $sql = "SELECT * FROM list_clinic WHERE id_clinic=$id_clinic";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $clinic = $result->fetch_assoc();
    } else {
        die("Phòng khám không tồn tại!");
    }
} else {
    die("Không tìm thấy ID phòng khám!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa phòng khám</title>
</head>
<body>
    <h1>Sửa thông tin phòng khám</h1>
    <form method="POST" action="update_clinic.php">
        <input type="hidden" name="id_clinic" value="<?= $clinic['id_clinic'] ?>">

        <label>Tên phòng khám:</label>
        <input type="text" name="name_clinic" value="<?= htmlspecialchars($clinic['name_clinic']) ?>" required>
        <br>

        <label>Hóa đơn (VND):</label>
        <input type="text" name="hospital_bills" value="<?= htmlspecialchars($clinic['Hospital_bills']) ?>" required>
        <br>

        <input type="submit" value="Cập nhật">
    </form>
</body>
</html>

<?php
$conn->close();
?>
