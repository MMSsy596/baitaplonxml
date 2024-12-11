<?php
// Kiểm tra và khởi động session nếu chưa được khởi động
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

// Kiểm tra xem bác sĩ đã đăng nhập chưa
if (!isset($_SESSION['email_doctor'])) {
    echo "<script>
            alert('Vui lòng đăng nhập trước!');
            window.location.href = 'login.php';
          </script>";
    exit();
}

// Lấy email của bác sĩ từ session
$email_doctor = $_SESSION['email_doctor'];

// Truy vấn danh sách phòng khám của bác sĩ đang đăng nhập
$sql = "SELECT * FROM list_clinic WHERE email_doctor = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email_doctor);
$stmt->execute();
$result = $stmt->get_result();

// Tạo tài liệu XML
$dom = new DOMDocument('1.0', 'UTF-8');
$dom->formatOutput = true;

// Tạo phần tử gốc <Clinics>
$root = $dom->createElement("Clinics");
$dom->appendChild($root);

// Kiểm tra nếu có kết quả
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Tạo phần tử <Clinic> cho mỗi phòng khám
        $clinic = $dom->createElement("Clinic");

        // Thêm từng trường dữ liệu vào <Clinic>
        $name_clinic = $dom->createElement("Name_Clinic", htmlspecialchars($row["name_clinic"]));
        $clinic->appendChild($name_clinic);

        $name_doctor = $dom->createElement("Name_Doctor", htmlspecialchars($row["name_doctor"]));
        $clinic->appendChild($name_doctor);

        $department = $dom->createElement("Department", htmlspecialchars($row["department"]));
        $clinic->appendChild($department);

        $email_doctor = $dom->createElement("Email_Doctor", htmlspecialchars($row["email_doctor"]));
        $clinic->appendChild($email_doctor);

        $hospital_bills = $dom->createElement("Hospital_Bills", htmlspecialchars($row["Hospital_bills"]));
        $clinic->appendChild($hospital_bills);

        // Thêm <Clinic> vào phần tử gốc <Clinics>
        $root->appendChild($clinic);
    }
}

// Lưu XML vào tệp
$xmlFileName = "clinics.xml";
$dom->save($xmlFileName);

// Gửi tiêu đề HTTP và xuất XML
header('Content-Type: text/xml');
echo $dom->saveXML();

// Đóng kết nối
$stmt->close();
$conn->close();
?>
