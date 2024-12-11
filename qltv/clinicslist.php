<?php
function displayRegisteredClinics($filePath) {
    $xml = simplexml_load_file($filePath);
    if (!$xml) {
        die("Error: Unable to load XML file.");
    }

    // Build lookup maps for quick access
    $users = [];
    foreach ($xml->login_user->login_users as $user) {
        $users[(string)$user['id_user']] = $user;
    }

    $clinics = [];
    foreach ($xml->list_clinic->list_clinics as $clinic) {
        $clinics[(string)$clinic['id_clinic']] = $clinic;
    }

    echo "<h2>Danh sách đăng ký phòng khám</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Tên Người Bệnh</th><th>Email Người Bệnh</th><th>Số Điện Thoại Người Bệnh</th><th>Tên Phòng Khám</th><th>Tên Bác Sĩ</th><th>Khoa</th><th>Chi Phí</th></tr>";

    foreach ($xml->register_clinic->register_clinics as $registration) {
        $userId = (string)$registration->login_users_id_user;
        $clinicId = (string)$registration->list_clinics_id_clinic;

        echo "<tr>";

        if (isset($users[$userId])) {
            $user = $users[$userId];
            echo "<td>{$user->name_user}</td>";
            echo "<td>{$user->ermail_user}</td>";
            echo "<td>{$user->phone_user}</td>";
        } else {
            echo "<td colspan='3'>Thông tin không tìm thấy</td>";
        }

        if (isset($clinics[$clinicId])) {
            $clinic = $clinics[$clinicId];
            echo "<td>{$clinic->name_clinic}</td>";
            echo "<td>{$clinic->login_doctor_name_docters->login_doctor_name_docter}</td>";
            echo "<td>{$clinic->login_doctor_departments->login_doctor_department}</td>";
            echo "<td>{$clinic->hospital_bills}</td>";
        } else {
            echo "<td colspan='4'>Thông tin không tìm thấy</td>";
        }

        echo "</tr>";
    }

    echo "</table>";
}

// Call the function to display the table
$filePath = 'library.xml';
displayRegisteredClinics($filePath);
?>
