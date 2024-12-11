<?php
// Đường dẫn tới file XML
$file = __DIR__ . '/list_clinics.xml';

// Kiểm tra xem file XML có tồn tại không
if (!file_exists($file)) {
    die("File XML không tồn tại! Vui lòng kiểm tra lại đường dẫn.");
}

// Load file XML
$xml = simplexml_load_file($file);

// Kiểm tra nếu không thể load file
if (!$xml) {
    die("Không thể load file XML! Vui lòng kiểm tra nội dung file.");
}

// Tạo bảng HTML để hiển thị dữ liệu
echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 100%; text-align: left;'>";
echo "<tr>
        <th>Tên Phòng Khám</th>
        <th>Tên Bác Sĩ</th>
        <th>Chuyên Khoa</th>
        <th>Email Bác Sĩ</th>
        <th>Chi Phí</th>
      </tr>";

// Duyệt qua từng phần tử Clinic trong file XML và hiển thị
foreach ($xml->Clinic as $clinic) {
    $clinicId = (int) $clinic['id'];
    echo "<tr>";
    echo "<td>" . htmlspecialchars($clinic->Name_Clinic) . "</td>";
    echo "<td>" . htmlspecialchars($clinic->Name_Doctor) . "</td>";
    echo "<td>" . htmlspecialchars($clinic->Department) . "</td>";
    echo "<td>" . htmlspecialchars($clinic->Email_Doctor) . "</td>";
    echo "<td>" . htmlspecialchars(number_format((float)$clinic->Hospital_Bills, 0, ',', '.')) . " VND</td>";
    echo "<td>
    <a href='admin_clinic/edit_clinic.php?id=$clinicId'>Sửa</a> | 
    <a href='admin_clinic/delete_clinic.php?id=$clinicId'>Xóa</a>
  </td>"; 
    
    echo "</tr>";
}

echo "</table>";
?>
