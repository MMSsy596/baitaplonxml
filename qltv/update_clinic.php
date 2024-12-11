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

// Cập nhật thông tin khi form được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name_clinic = trim($_POST['name_clinic']);
    $hospital_bills = $_POST['hospital_bills'];

    // Lấy email bác sĩ từ session
    $email_doctor = $_SESSION['email_doctor'];

    // Lấy id_clinic từ URL (nếu có)
    if (isset($_GET['id'])) {
        $id_clinic = $_GET['id'];

        // Truy vấn lấy thông tin phòng khám
        $sql = "SELECT * FROM list_clinic WHERE name_clinic = ?";
        $stmt = $conn->prepare($sql);  // Prepare the statement only if necessary
        if ($stmt) {
            $stmt->bind_param("s", $name_clinic);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Nếu phòng đã được đăng ký, thông báo lỗi
                echo "<script>
                        alert('Phòng này đã được đăng ký bởi bác sĩ khác!');
                        window.location.href = 'information_doctor.php';
                      </script>";
                exit();
            }
            $stmt->close(); // Close the prepared statement after use
        } else {
            echo "<script>alert('Lỗi khi chuẩn bị câu lệnh SQL.');</script>";
        }
    }

    // Kiểm tra xem tên phòng khám và hóa đơn có hợp lệ không
    if (empty($name_clinic) || empty($hospital_bills)) {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin');</script>";
    } elseif (!is_numeric($hospital_bills)) {
        echo "<script>alert('Hóa đơn phải là số hợp lệ');</script>";
    } else {
        // Cập nhật thông tin phòng khám (chỉ cập nhật tên phòng khám và hóa đơn)
        $update_sql = "UPDATE list_clinic SET name_clinic = ?, Hospital_bills = ? WHERE id_clinic = ?";
        $update_stmt = $conn->prepare($update_sql);
        if ($update_stmt) {
            $update_stmt->bind_param("sii", $name_clinic, $hospital_bills, $id_clinic);

            if ($update_stmt->execute()) {
                echo "<script>alert('Cập nhật thành công'); window.location.href = 'information_doctor.php';</script>";
            } else {
                echo "<script>alert('Cập nhật thất bại');</script>";
            }
            $update_stmt->close(); // Close the update statement
        } else {
            echo "<script>alert('Lỗi khi chuẩn bị câu lệnh SQL để cập nhật thông tin phòng khám.');</script>";
        }
    }
}

// Đóng kết nối
$conn->close();
?>
