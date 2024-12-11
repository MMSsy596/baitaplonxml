<?php
session_start();

// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';


// Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION['email']) || !isset($_SESSION['name']) || !isset($_SESSION['id'])) {
    echo "<script>
            alert('Vui lòng đăng nhập trước!');
            window.location.href = 'login.php';
          </script>";
    exit();
}

// Lấy thông tin người dùng từ session
$id_user = $_SESSION['id'];

// Kiểm tra nếu form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_clinic = $_POST['id_clinic'];

    // Kiểm tra xem người dùng đã chọn phòng khám chưa
    if (empty($id_clinic)) {
        echo "<script>
                alert('Vui lòng chọn một phòng khám để đăng ký!');
                window.location.href = 'RegisterClinics.php';
              </script>";
        exit();
    }

    // Kiểm tra xem người dùng đã đăng ký phòng khám này chưa
    $sql_check_registration = "SELECT * FROM register_clinic WHERE id_user = ? AND id_clinic = ?";
    $stmt = $conn->prepare($sql_check_registration);
    $stmt->bind_param("ii", $id_user, $id_clinic);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>
                alert('Bạn đã đăng ký phòng khám này rồi!');
                window.location.href = 'RegisterClinics.php';
              </script>";
        exit();
    }

    // Thực hiện đăng ký phòng khám
    $sql_register = "INSERT INTO register_clinic (id_user, id_clinic) VALUES (?, ?)";
    $stmt = $conn->prepare($sql_register);
    $stmt->bind_param("ii", $id_user, $id_clinic);

    if ($stmt->execute()) {
        echo "<script>
                alert('Đăng ký phòng khám thành công!');
                window.location.href = 'information.php';
              </script>";
    } else {
        echo "<script>
                alert('Đã xảy ra lỗi khi đăng ký. Vui lòng thử lại!');
                window.location.href = 'RegisterClinics.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Truy cập không hợp lệ!');
            window.location.href = 'RegisterClinics.php';
          </script>";
}

// Đóng kết nối
$conn->close();
?>
