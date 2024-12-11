<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "1121";
$dbname = "loginclinic";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
    // In ra bảng HTML
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<thead>
            <tr>
                <th>Tên bệnh nhân</th>
                <th>Email người bệnh</th>
                <th>SĐT người bệnh</th>
                <th>Hành động</th>
            </tr>
          </thead>";
    echo "<tbody>";

    // Hiển thị từng dòng dữ liệu
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["name_user"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["email_user"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["phone_user"]) . "</td>";
        echo "<td>
                <a href='admin_user/edit_user.php?id=" . $row["id_user"] . "'>Sửa</a> | 
                <a href='admin_user/delete_user.php?id=" . $row["id_user"] . "'>Xóa</a>
              </td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

    // Thêm nút Thêm người dùng
    echo "<a href='admin_user/add_user.php'>Thêm mới người dùng</a>";
} else {
    echo "<p>Không có bệnh nhân nào!</p>";
}

$conn->close();

// Lưu tài liệu XML vào file hoặc xuất ra trình duyệt
// header('Content-Type: text/xml');
echo $xml->saveXML();

// Đóng kết nối
//$conn->close();
?>
<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "1121";
$dbname = "loginclinic";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
