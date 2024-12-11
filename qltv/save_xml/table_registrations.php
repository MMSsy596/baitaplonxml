<?php
// Đường dẫn đến file XML
$file = __DIR__ . '/registrations.xml';

// Kiểm tra nếu file XML tồn tại
if (!file_exists($file)) {
    die("File XML không tồn tại! Vui lòng kiểm tra lại đường dẫn.");
}

// Load file XML
$xml = simplexml_load_file($file);

// Kiểm tra nếu không thể load file XML
if (!$xml) {
    die("Không thể load file XML! Vui lòng kiểm tra nội dung file.");
}

// Tạo bảng HTML
echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 100%; text-align: left;'>";
echo "<tr>
        <th>Tên Người Dùng</th>
        <th>Email Người Dùng</th>
        <th>Số Điện Thoại</th>
        <th>Tên Phòng Khám</th>
        <th>Tên Bác Sĩ</th>
        <th>Khoa</th>
        <th>Email Bác Sĩ</th>
        <th>Chi Phí</th>
      </tr>";

// Duyệt qua từng phần tử <registration> trong file XML và hiển thị dữ liệu
foreach ($xml->registration as $registration) {
    $user = $registration->user;
    $clinic = $registration->clinic;
    $registrationId = (int) $registration['id'];
    echo "<tr>";
    echo "<td>" . htmlspecialchars($user->name) . "</td>";
    echo "<td>" . htmlspecialchars($user->email) . "</td>";
    echo "<td>" . htmlspecialchars($user->phone) . "</td>";
    echo "<td>" . htmlspecialchars($clinic->name) . "</td>";
    echo "<td>" . htmlspecialchars($clinic->doctor) . "</td>";
    echo "<td>" . htmlspecialchars($clinic->department) . "</td>";
    echo "<td>" . htmlspecialchars($clinic->email) . "</td>";
    echo "<td>" . htmlspecialchars($clinic->hospital_bills) . "</td>";
    echo "<td>               
    <a href='delete_registration.php?id=$registrationId' onclick='return confirm(\"Bạn có chắc chắn muốn xóa không?\");'>hủy đăng ký phòng khám</a>
  </td>";

    echo "</tr>";
}

echo "</table>";
?>
