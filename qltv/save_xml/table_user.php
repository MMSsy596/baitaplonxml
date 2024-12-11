<?php
// Đường dẫn tới file XML
$file = __DIR__ . '/login_user.xml';

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
        <th>Tên Người Dùng</th>
        <th>Email</th>
        <th>Số Điện Thoại</th>
         <th>Hành động</th>
      </tr>";

// Duyệt qua từng phần tử user trong file XML và hiển thị
foreach ($xml->login_user->user as $user) {
    $userId = (int) $user['id'];
    echo "<tr>";
    echo "<td>" . htmlspecialchars($user->name_user) . "</td>";
    echo "<td>" . htmlspecialchars($user->email_user) . "</td>";
    echo "<td>" . htmlspecialchars($user->phone_user) . "</td>";
    echo "<td>
        <a href='admin_user/edit_user.php?id=$userId'>Sửa</a> | 
        <a href='admin_user/delete_user.php?id=$userId' onclick=\"return confirm('Bạn có chắc chắn muốn xóa người dùng này?');\">Xóa</a>

      </td>";
    
    echo "</tr>";

}



echo "</table>";
?>
