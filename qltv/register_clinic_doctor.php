<?php
session_start();

// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';


// Kiểm tra xem bác sĩ đã đăng nhập chưa
if (!isset($_SESSION['name_doctor']) || !isset($_SESSION['email_doctor'])) {
    echo "<script>
            alert('Vui lòng đăng nhập trước!');
            window.location.href = 'login.php';
          </script>";
    exit();
}

// Lấy thông tin bác sĩ từ session
$id_doctor = $_SESSION['id_doctor'];
$name_doctor = $_SESSION['name_doctor'];
$email_doctor = $_SESSION['email_doctor'];
$department_doctor = $_SESSION['department'];

// Kiểm tra nếu form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin từ form
    $room_number = $_POST['room_number'];
    $price = $_POST['price'];

    // Kiểm tra thông tin đầu vào
    if (empty($room_number) || empty($price)) {
        echo "<script>
                alert('Vui lòng nhập đầy đủ thông tin!');
                window.location.href = 'register_clinic_doctor_form.php';
              </script>";
        exit();
    }

    // Kiểm tra xem phòng đã được đăng ký chưa
    $sql_check_room = "SELECT * FROM list_clinic WHERE name_clinic = ?";
    $stmt_check = $conn->prepare($sql_check_room);
    $stmt_check->bind_param("s", $room_number);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Nếu phòng đã được đăng ký, thông báo lỗi
        echo "<script>
                alert('Phòng này đã được đăng ký bởi bác sĩ khác!');
                window.location.href = 'register_clinic_doctor_form.php';
              </script>";
        exit();
    }

    // Thêm thông tin phòng khám vào cơ sở dữ liệu
    $sql_insert_clinic = "INSERT INTO list_clinic (name_clinic, name_doctor, department,email_doctor, hospital_bills) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert_clinic);
    $stmt->bind_param("sssss", $room_number, $name_doctor, $department_doctor, $email_doctor,$price);

    if ($stmt->execute()) {
        echo "<script>
                alert('Đăng ký phòng khám thành công!');
                window.location.href = 'information_doctor.php';
              </script>";
    } else {
        echo "<script>
                alert('Đã xảy ra lỗi khi đăng ký phòng khám. Vui lòng thử lại!');
                window.location.href = 'register_clinic_doctor_form.php';
              </script>";
    }

    // Đóng statement sau khi thực thi
    $stmt->close();
}

$conn->close();
?>
