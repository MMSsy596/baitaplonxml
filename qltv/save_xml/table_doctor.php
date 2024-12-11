<?php
// Đường dẫn tuyệt đối đến file XML
$file = __DIR__ . '/doctors.xml';

// Kiểm tra xem file XML có tồn tại hay không
if (!file_exists($file)) {
    die("File XML không tồn tại! Vui lòng kiểm tra lại đường dẫn.");
}

// Load file XML
$xml = simplexml_load_file($file);

if (!$xml) {
    die("Không thể load file XML! Vui lòng kiểm tra nội dung file.");
}

// Hiển thị bảng dữ liệu từ file XML
echo "<table border='1'>";
echo "<tr>
        <th>Tên Bác Sĩ</th>
        <th>Chuyên Khoa</th>
        <th>Số Điện Thoại</th>
        <th>Email</th>
      </tr>";

foreach ($xml->Doctor as $doctor) {
    $doctorId = (int) $doctor['id'];
    echo "<tr>";
    echo "<td>" . htmlspecialchars($doctor->Name_Doctor) . "</td>";
    echo "<td>" . htmlspecialchars($doctor->Department) . "</td>";
    echo "<td>" . htmlspecialchars($doctor->Phone_Doctor) . "</td>";    
    echo "<td>" . htmlspecialchars($doctor->Email_Doctor) . "</td>";
    echo "<td>
    <a href='admin_doctor/edit_doctor.php?id=$doctorId'>Sửa</a> | 
    <a href='admin_doctor/delete_doctor.php?id=$doctorId'>Xóa</a>
  </td>";
    echo "</tr>";
}

echo "</table>";
?>
