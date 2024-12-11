<?php
// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';


// Lấy danh sách bác sĩ từ bảng login_doctor
$sql = "SELECT * FROM login_doctor";
$resultDoctors = $conn->query($sql);

// Danh sách 10 phòng
$rooms = ["Phòng 1", "Phòng 2", "Phòng 3", "Phòng 4", "Phòng 5", "Phòng 6", "Phòng 7", "Phòng 8", "Phòng 9", "Phòng 10"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm phòng khám</title>
</head>
<body>
    <h1>Thêm phòng khám mới</h1>
    <form method="POST" action="process_clinic.php">
        <!-- Chọn tên phòng -->
        <label>Tên phòng khám:</label>

        <select name="name_clinic" required>
            <?php foreach ($rooms as $room): ?>
                <option value="<?= htmlspecialchars($room) ?>"><?= htmlspecialchars($room) ?></option>
            <?php endforeach; ?>
        </select>

     
        <br>

        <!-- Chọn bác sĩ -->
        <label>Bác sĩ:</label>
        <select name="doctor_id" required>
            <?php if ($resultDoctors && $resultDoctors->num_rows > 0): ?>
                <?php while ($doctor = $resultDoctors->fetch_assoc()): ?>
                    <option value="<?= htmlspecialchars($doctor['id_doctor']) ?>">
                        <?= htmlspecialchars($doctor['name_doctor']) ?> (<?= htmlspecialchars($doctor['department']) ?>)
                    </option>
                <?php endwhile; ?>
            <?php else: ?>
                <option value="">Không có bác sĩ nào</option>
            <?php endif; ?>
        </select>
        <br>

        <!-- Nhập hóa đơn -->
        <label>Hóa đơn (VND):</label>
        <input type="number" name="hospital_bills" min="0" step="0.01" required>
        <br>

        <!-- Nút thêm mới -->
        <input type="submit" value="Thêm mới">
    </form>
</body>
</html>

<?php
$conn->close();
?>
