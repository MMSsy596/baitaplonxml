<?php
// Kết nối đến cơ sở dữ liệu
// $servername = "localhost";
// $username = "root";
// $password = "1121";
// $dbname = "loginclinic";

// $conn = new mysqli($servername, $username, $password, $dbname);

include 'db_connection.php';
// Kiểm tra kết nối

// Lấy dữ liệu từ bảng login_user
$sqllogin_user = "SELECT * FROM login_user";
$resultlogin_user = $conn->query($sqllogin_user);

// Tạo tài liệu XML
$xml = new DOMDocument('1.0', 'UTF-8');
$xml->formatOutput = true;

// Tạo phần tử gốc <library>
$library = $xml->createElement("library");
$xml->appendChild($library);

// Thêm danh sách người dùng vào <login_user>
$login_user = $xml->createElement("login_user");
$library->appendChild($login_user);

$sql = "SELECT * FROM list_clinic";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // In ra bảng HTML
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<thead>
            <tr>
                <th>Tên phòng khám</th>
                <th>Tên bác sĩ</th>
                <th>Chuyên khoa</th>
                <th>Email bác sĩ</th>
                <th>Hóa đơn (VND)</th>
            </tr>
          </thead>";
    echo "<tbody>";

    // Hiển thị từng dòng dữ liệu
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["name_clinic"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["name_doctor"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["department"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["email_doctor"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["Hospital_bills"]) . " VND</td>";
        echo "<td>
                <a href='admin_clinic/edit_clinic.php?id=" . $row["id_clinic"] . "'>Sửa</a> | 
                <a href='admin_clinic/delete_clinic.php?id=" . $row["id_clinic"] . "'>Xóa</a>
              </td>";    
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "<a href='admin_clinic/add_clinic.php'>Thêm mới người dùng</a>";
} else {
    echo "<p>Không có phòng khám nào!</p>";
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

// Tạo phần tử gốc <Clinics>
$clinics = $xml->createElement("Clinics");
$xml->appendChild($clinics);

// Truy vấn dữ liệu từ bảng list_clinic
$sql = "SELECT * FROM list_clinic";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Tạo phần tử <Clinic> cho mỗi dòng dữ liệu
        $clinic = $xml->createElement("Clinic");

        // Thêm các trường dữ liệu vào <Clinic>
        $clinic->appendChild($xml->createElement("Name_Clinic", htmlspecialchars($row["name_clinic"])));
        $clinic->appendChild($xml->createElement("Name_Doctor", htmlspecialchars($row["name_doctor"])));
        $clinic->appendChild($xml->createElement("Department", htmlspecialchars($row["department"])));
        $clinic->appendChild($xml->createElement("Email_Doctor", htmlspecialchars($row["email_doctor"])));
        $clinic->appendChild($xml->createElement("Hospital_Bills", htmlspecialchars($row["Hospital_bills"])));

        // Thêm <Clinic> vào <Clinics>
        $clinics->appendChild($clinic);
    }
} else {
    echo "<p>Không có phòng khám nào!</p>";
}

// Lưu tài liệu XML vào tệp
$xmlFileName = "save_xml/list_clinics.xml";
if ($xml->save($xmlFileName)) {
   // echo "Dữ liệu đã được lưu thành công vào tệp <b>$xmlFileName</b>.";
} else {
    echo "Đã xảy ra lỗi khi lưu tệp XML.";
}

// Đóng kết nối
//$conn->close();
?>
