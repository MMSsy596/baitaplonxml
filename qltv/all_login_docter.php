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
$sql = "SELECT * FROM login_doctor";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // In ra bảng HTML
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<thead>
            <tr>
                <th>Tên bác sĩ</th>
                <th>chuyên khoa </th>
                <th>SĐT bác sĩ</th>
                <th>Email bác sĩ </th>
              
                <th>Hành động</th>
            </tr>
          </thead>";
    echo "<tbody>";

    // Hiển thị từng dòng dữ liệu
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["name_doctor"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["department"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["phone_doctor"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["email_doctor"]) . "</td>";
     
        echo "<td>
                <a href='admin_doctor/edit_doctor.php?id=" . $row["id_doctor"] . "'>Sửa</a> | 
                <a href='admin_doctor/delete_doctor.php?id=" . $row["id_doctor"] . "'>Xóa</a>
              </td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

    // Thêm nút Thêm người dùng
    echo "<a href='admin_doctor/add_doctor.php'>Thêm mới người dùng</a>";
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

// Tạo phần tử gốc <Doctors>
$doctors = $xml->createElement("Doctors");
$xml->appendChild($doctors);

// Lấy dữ liệu từ bảng login_doctor
$sql = "SELECT * FROM login_doctor";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Duyệt qua từng dòng dữ liệu và thêm vào XML
    while ($row = $result->fetch_assoc()) {
        // Tạo phần tử <Doctor> cho mỗi dòng dữ liệu
        $doctor = $xml->createElement("Doctor");

        // Thêm các trường dữ liệu vào <Doctor>
        $doctor->appendChild($xml->createElement("Name_Doctor", htmlspecialchars($row["name_doctor"])));
        $doctor->appendChild($xml->createElement("Department", htmlspecialchars($row["department"])));
        $doctor->appendChild($xml->createElement("Phone_Doctor", htmlspecialchars($row["phone_doctor"])));
        $doctor->appendChild($xml->createElement("Email_Doctor", htmlspecialchars($row["email_doctor"])));

        // Thêm <Doctor> vào <Doctors>
        $doctors->appendChild($doctor);
    }

    // Lưu tài liệu XML vào tệp
    $xmlFileName = "save_xml/doctors.xml";
    if ($xml->save($xmlFileName)) {
        //echo "Dữ liệu đã được lưu thành công vào tệp <b>$xmlFileName</b>.";
    } else {
        echo "Đã xảy ra lỗi khi lưu tệp XML.";
    }
} else {
    echo "<p>Không có bác sĩ nào trong cơ sở dữ liệu!</p>";
}

// Đóng kết nối
$conn->close();
?>

