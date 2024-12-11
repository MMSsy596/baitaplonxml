<?php

// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';


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
        $registrationId = $registration['id_registration']; // ID đăng ký

        // Tạo phần tử <registration> với thuộc tính `id`
        $registrationNode = $xml->createElement("registration");
        $registrationNode->setAttribute("id", $registrationId); // Gán id vào thuộc tính

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
