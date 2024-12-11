<?php
// Kiểm tra và khởi động session nếu chưa được khởi động
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Đường dẫn tới file XML
$file = __DIR__ . '/save_xml/list_clinics.xml';

// Kiểm tra xem file XML có tồn tại không
if (!file_exists($file)) {
    die("File XML không tồn tại! Vui lòng kiểm tra lại đường dẫn.");
}

// Load file XML
$xml = simplexml_load_file($file);

// Kiểm tra nếu không thể load file XML
if (!$xml) {
    die("Không thể load file XML! Vui lòng kiểm tra nội dung file.");
}

// Lấy email bác sĩ từ session
$email_doctor = $_SESSION['email_doctor'] ?? null;

// Tạo bảng HTML để hiển thị dữ liệu
echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 100%; text-align: left;'>";
echo "<tr>
        <th>Tên Phòng Khám</th>
        <th>Tên Bác Sĩ</th>
        <th>Chuyên Khoa</th>
        <th>Email Bác Sĩ</th>
        <th>Chi Phí</th>
        <th>Hành Động</th>
      </tr>";

// Duyệt qua từng phần tử Clinic trong file XML và hiển thị
foreach ($xml->Clinic as $clinic) {
    // Kiểm tra nếu email bác sĩ trong XML trùng với email bác sĩ từ session
    if ($email_doctor && $clinic->Email_Doctor == $email_doctor) {
        $clinicId = (int) $clinic['id']; // Đảm bảo id được lấy từ thuộc tính 'id' của Clinic
        echo "<tr>";
        echo "<td>" . htmlspecialchars($clinic->Name_Clinic) . "</td>";
        echo "<td>" . htmlspecialchars($clinic->Name_Doctor) . "</td>";
        echo "<td>" . htmlspecialchars($clinic->Department) . "</td>";
        echo "<td>" . htmlspecialchars($clinic->Email_Doctor) . "</td>";
        echo "<td>" . htmlspecialchars(number_format((float)$clinic->Hospital_Bills, 0, ',', '.')) . " VND</td>";
        echo "<td><a href='edit_clinic.php?id=" . htmlspecialchars($clinicId) . "'>Sửa</a>
       <a href='delete_clinic.php?id=" . htmlspecialchars($clinicId) . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa phòng khám này?\")'>Xóa</a></td>";
        echo "</tr>";
    }
}

echo "</table>";
?>
