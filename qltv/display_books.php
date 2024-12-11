
<?php
function displayLoginUsers($filePath) {
    $xml = simplexml_load_file($filePath);

    echo "<h2>Danh sách người dùng đăng nhập</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID Người Dùng</th><th>Tên Người Dùng</th><th>Email</th><th>Số Điện Thoại</th><th>Mật Khẩu</th></tr>";

    foreach ($xml->login_user->login_users as $user) {
        echo "<tr>";
        echo "<td>{$user['id_user']}</td>";
        echo "<td>{$user->name_user}</td>";
        echo "<td>{$user->ermail_user}</td>";
        echo "<td>{$user->phone_user}</td>";
        echo "<td>{$user->password_user}</td>";
        echo "</tr>";
    }

    echo "</table>";
}

function displayLoginDoctors($filePath) {
    $xml = simplexml_load_file($filePath);

    echo "<h2>Danh sách bác sĩ đăng nhập</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID Bác Sĩ</th><th>Tên Bác Sĩ</th><th>Khoa</th><th>Số Điện Thoại</th><th>Email</th><th>Mật Khẩu</th></tr>";

    foreach ($xml->login_doctor->login_doctors as $doctor) {
        echo "<tr>";
        echo "<td>{$doctor['id_doctor']}</td>";
        echo "<td>{$doctor->name_doctor}</td>";
        echo "<td>{$doctor->department}</td>";
        echo "<td>{$doctor->phone_doctor}</td>";
        echo "<td>{$doctor->ermail_doctor}</td>";
        echo "<td>{$doctor->password_doctor}</td>";
        echo "</tr>";
    }

    echo "</table>";
}

function displayClinics($filePath) {
    $xml = simplexml_load_file($filePath);

    echo "<h2>Danh sách phòng khám</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID Phòng Khám</th><th>Tên Phòng Khám</th><th>Tên Bác Sĩ</th><th>Khoa</th><th>Chi Phí</th></tr>";

    foreach ($xml->list_clinic->list_clinics as $clinic) {
        echo "<tr>";
        echo "<td>{$clinic['id_clinic']}</td>";
        echo "<td>{$clinic->name_clinic}</td>";
        echo "<td>{$clinic->login_doctor_name_docters->login_doctor_name_docter}</td>";
        echo "<td>{$clinic->login_doctor_departments->login_doctor_department}</td>";
        echo "<td>{$clinic->hospital_bills}</td>";
        echo "</tr>";
    }

    echo "</table>";
}

function displayRegisteredClinics($filePath) {
    $xml = simplexml_load_file($filePath);

    echo "<h2>Danh sách đăng ký phòng khám</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID Người Dùng</th><th>ID Phòng Khám</th></tr>";

    foreach ($xml->register_clinic->register_clinics as $registration) {
        echo "<tr>";
        echo "<td>{$registration->login_users_id_user}</td>";
        echo "<td>{$registration->list_clinics_id_clinic}</td>";
        echo "</tr>";
    }

    echo "</table>";
}

// Call functions to display data
$filePath = 'library.xml';
displayLoginUsers($filePath);
displayLoginDoctors($filePath);
displayClinics($filePath);
displayRegisteredClinics($filePath);
?>