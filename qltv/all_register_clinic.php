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

// Truy vấn danh sách người dùng
$sql_users = "SELECT * FROM login_user";
$result_users = $conn->query($sql_users);
$users = [];
while ($user = $result_users->fetch_assoc()) {
    $users[$user['id_user']] = $user;
}

// Truy vấn danh sách phòng khám
$sql_clinics = "SELECT * FROM list_clinic";
$result_clinics = $conn->query($sql_clinics);
$clinics = [];
while ($clinic = $result_clinics->fetch_assoc()) {
    $clinics[$clinic['id_clinic']] = $clinic;
}

// Truy vấn danh sách đăng ký phòng khám
$sql_registrations = "SELECT * FROM register_clinic";
$result_registrations = $conn->query($sql_registrations);

// Hiển thị bảng dữ liệu

echo "<table border='1'>";
echo "<tr>
        <th>Tên Người Bệnh</th>
        <th>Email Người Bệnh</th>
        <th>Số Điện Thoại Người Bệnh</th>
        <th>Tên Phòng Khám</th>
        <th>Tên Bác Sĩ</th>
        <th>Chuyên Khoa</th>
         <th>email bác sĩ</th>
        <th>Chi Phí</th>
        <th>Hành Động</th>
      </tr>";

if ($result_registrations->num_rows > 0) {
    while ($registration = $result_registrations->fetch_assoc()) {
        $userId = $registration['id_user'];
        $clinicId = $registration['id_clinic'];
        $registrationId = $registration['id_registration']; // ID đăng ký

        echo "<tr>";

        // Thông tin người dùng
        if (isset($users[$userId])) {
            $user = $users[$userId];
            echo "<td>" . htmlspecialchars($user['name_user']) . "</td>";
            echo "<td>" . htmlspecialchars($user['email_user']) . "</td>";
            echo "<td>" . htmlspecialchars($user['phone_user']) . "</td>";
        } else {
            echo "<td colspan='3'>Thông tin không tìm thấy</td>";
        }

        // Thông tin phòng khám
        if (isset($clinics[$clinicId])) {
            $clinic = $clinics[$clinicId];
            echo "<td>" . htmlspecialchars($clinic['name_clinic']) . "</td>";
            echo "<td>" . htmlspecialchars($clinic['name_doctor']) . "</td>";
            echo "<td>" . htmlspecialchars($clinic['department']) . "</td>";
            echo "<td>" . htmlspecialchars($clinic['email_doctor']) . "</td>";
            echo "<td>" . htmlspecialchars($clinic['Hospital_bills']) . " VND</td>";
        } else {
            echo "<td colspan='4'>Thông tin không tìm thấy</td>";
        }

        // Nút Sửa và Xóa
        echo "<td>               
                <a href='delete_registration.php?id=$registrationId' onclick='return confirm(\"Bạn có chắc chắn muốn xóa không?\");'>hủy đăng ký phòng khám</a>
              </td>";

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>Không có đăng ký nào!</td></tr>";
}

echo "</table>";

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

// Truy vấn danh sách người dùng
$sql_users = "SELECT * FROM login_user";
$result_users = $conn->query($sql_users);
$users = [];
while ($user = $result_users->fetch_assoc()) {
    $users[$user['id_user']] = $user;
}

// Truy vấn danh sách phòng khám
$sql_clinics = "SELECT * FROM list_clinic";
$result_clinics = $conn->query($sql_clinics);
$clinics = [];
while ($clinic = $result_clinics->fetch_assoc()) {
    $clinics[$clinic['id_clinic']] = $clinic;
}

// Truy vấn danh sách đăng ký phòng khám
$sql_registrations = "SELECT * FROM register_clinic";
$result_registrations = $conn->query($sql_registrations);

// Tạo tài liệu XML
$xml = new DOMDocument('1.0', 'UTF-8');
$xml->formatOutput = true;

// Tạo phần tử gốc <registrations>
$registrations = $xml->createElement("registrations");
$xml->appendChild($registrations);

// Thêm dữ liệu vào XML
if ($result_registrations->num_rows > 0) {
    while ($registration = $result_registrations->fetch_assoc()) {
        $userId = $registration['id_user'];
        $clinicId = $registration['id_clinic'];

        // Tạo phần tử <registration>
        $registrationNode = $xml->createElement("registration");

        // Thêm thông tin người dùng
        if (isset($users[$userId])) {
            $user = $users[$userId];
            $userNode = $xml->createElement("user");
            $userNode->appendChild($xml->createElement("name", htmlspecialchars($user['name_user'])));
            $userNode->appendChild($xml->createElement("email", htmlspecialchars($user['email_user'])));
            $userNode->appendChild($xml->createElement("phone", htmlspecialchars($user['phone_user'])));
            $registrationNode->appendChild($userNode);
        }

        // Thêm thông tin phòng khám
        if (isset($clinics[$clinicId])) {
            $clinic = $clinics[$clinicId];
            $clinicNode = $xml->createElement("clinic");
            $clinicNode->appendChild($xml->createElement("name", htmlspecialchars($clinic['name_clinic'])));
            $clinicNode->appendChild($xml->createElement("doctor", htmlspecialchars($clinic['name_doctor'])));
            $clinicNode->appendChild($xml->createElement("department", htmlspecialchars($clinic['department'])));
            $clinicNode->appendChild($xml->createElement("email", htmlspecialchars($clinic['email_doctor'])));
            $clinicNode->appendChild($xml->createElement("hospital_bills", htmlspecialchars($clinic['Hospital_bills'])));
            $registrationNode->appendChild($clinicNode);
        }

        // Thêm <registration> vào <registrations>
        $registrations->appendChild($registrationNode);
    }

    // Lưu file XML
    $xml->save("save_xml/registrations.xml");
    //echo "Dữ liệu đã được lưu vào file registrations.xml!";
} else {
    echo "Không có đăng ký nào!";
}

// Đóng kết nối
$conn->close();
?>
