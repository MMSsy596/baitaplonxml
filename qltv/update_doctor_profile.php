<?php
session_start();

// Kiểm tra nếu bác sĩ đã đăng nhập
if (!isset($_SESSION['id_doctor'])) {
    echo "<script>
            alert('Vui lòng đăng nhập trước!');
            window.location.href = 'login.php';
          </script>";
    exit();
}

// Lấy thông tin bác sĩ từ session
$id_doctor = $_SESSION['id_doctor'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_name = trim($_POST['name_doctor']);
    $new_department = trim($_POST['department']);
    $new_phone = trim($_POST['phone_doctor']);

    // Kết nối cơ sở dữ liệu
    $servername = "localhost";
    $username = "root";
    $password = "1121";
    $dbname = "loginclinic";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Cập nhật thông tin trong bảng `login_doctor`
    $sql_update_doctor = "UPDATE login_doctor SET name_doctor = ?, department = ?, phone_doctor = ? WHERE id_doctor = ?";
    $stmt = $conn->prepare($sql_update_doctor);
    $stmt->bind_param("sssi", $new_name, $new_department, $new_phone, $id_doctor);

    if ($stmt->execute()) {
        // Cập nhật thông tin trong bảng `list_clinic`
        $sql_update_clinic = "UPDATE list_clinic SET name_doctor = ?, department = ? WHERE email_doctor = ?";
        $stmt_update_clinic = $conn->prepare($sql_update_clinic);
        $stmt_update_clinic->bind_param("sss", $new_name, $new_department, $_SESSION['email_doctor']);
        $stmt_update_clinic->execute();

        // Cập nhật thông tin trong session
        $_SESSION['name_doctor'] = $new_name;
        $_SESSION['department'] = $new_department;
        $_SESSION['phone_doctor'] = $new_phone;

        echo "<script>
                alert('Cập nhật thông tin thành công!');
                window.location.href = 'information_doctor.php';
              </script>";
    } else {
        echo "<script>
                alert('Cập nhật thông tin thất bại!');
                window.location.href = 'edit_profile_doctor.php';
              </script>";
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>
