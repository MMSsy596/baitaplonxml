<?php
// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';


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
        $clinic->setAttribute("id", htmlspecialchars($row["id_clinic"]));
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