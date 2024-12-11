<?php
session_start();



// Lấy thông tin bác sĩ từ session
$name_doctor = $_SESSION['name_doctor'];
$email_doctor = $_SESSION['email_doctor'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Phòng Khám</title>
</head>
<body>
    <h1>Đăng Ký Phòng Khám</h1>
    <p>Chào mừng, Bác sĩ <?php echo htmlspecialchars($name_doctor); ?> (<?php echo htmlspecialchars($email_doctor); ?>)</p>

    <form method="POST" action="register_clinic_doctor.php">
        <label for="room_number">Chọn số phòng (1-10):</label>
        <select name="room_number" id="room_number" required>
            <option value="">-- Chọn số phòng --</option>
                <?php
                // Mảng danh sách phòng
                $rooms = ["Phòng 1", "Phòng 2", "Phòng 3", "Phòng 4", "Phòng 5", "Phòng 6", "Phòng 7", "Phòng 8", "Phòng 9", "Phòng 10"];

                // Hiển thị các phòng từ mảng $rooms
                foreach ($rooms as $room) {
                    echo "<option value='$room'>$room</option>";
                }
                ?>
        </select>
        <br><br>

        <label for="price">Nhập giá tiền (VND):</label>
        <input type="number" name="price" id="price" placeholder="Nhập giá tiền" required>
        <br><br>

        <button type="submit">Đăng Ký</button>
    </form>

    <br>
    <a href="index_doctoc.php">Quay lại trang chính</a>
</body>
</html>
