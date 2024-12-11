<?php
// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';

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
        $doctor->setAttribute("id", htmlspecialchars($row["id_doctor"]));
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
