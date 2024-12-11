<?php
// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';


// Tạo tài liệu XML
$xml = new DOMDocument('1.0', 'UTF-8');
$xml->formatOutput = true;

// Tạo phần tử gốc <library>
$library = $xml->createElement("library");
$xml->appendChild($library);

// Thêm danh sách người dùng vào <login_user>
$login_user = $xml->createElement("login_user");
$library->appendChild($login_user);

// Lấy dữ liệu từ bảng login_user
$sql = "SELECT * FROM login_user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Tạo phần tử <user> cho mỗi người dùng
        $user = $xml->createElement("user");
        $user->setAttribute("id", htmlspecialchars($row["id_user"]));
        // Thêm các trường dữ liệu vào <user>
        $name_user = $xml->createElement("name_user", htmlspecialchars($row["name_user"]));
        $user->appendChild($name_user);

        $email_user = $xml->createElement("email_user", htmlspecialchars($row["email_user"]));
        $user->appendChild($email_user);

        $phone_user = $xml->createElement("phone_user", htmlspecialchars($row["phone_user"]));
        $user->appendChild($phone_user);

        // Thêm <user> vào <login_user>
        $login_user->appendChild($user);
    }

    // Lưu file XML
    $xml->save("save_xml/login_user.xml");
    //echo "Dữ liệu đã được lưu vào file login_user.xml!";
} else {
    echo "<p>Không có bệnh nhân nào!</p>";
}

// Đóng kết nối
$conn->close();
?>