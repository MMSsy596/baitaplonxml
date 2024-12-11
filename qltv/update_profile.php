<?php
session_start();

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['id'])) {
    echo "<script>
            alert('Vui lòng đăng nhập trước!');
            window.location.href = 'login.php';
          </script>";
    exit();
}

// Lấy thông tin người dùng từ session
$id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_name = $_POST['name'];
    $new_phone = $_POST['phone'];

    // Kết nối cơ sở dữ liệu
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "loginclinic";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Cập nhật thông tin người dùng
    $sql = "UPDATE login_user SET name_user = ?, phone_user = ? WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $new_name, $new_phone, $id);

    if ($stmt->execute()) {
        // Cập nhật thông tin trong session
        $_SESSION['name'] = $new_name;
        $_SESSION['phone'] = $new_phone;

        echo "<script>
                alert('Cập nhật thông tin thành công!');
                window.location.href = 'information.php';
              </script>";
    } else {
        echo "<script>
                alert('Cập nhật thông tin thất bại!');
                window.location.href = 'edit_profile.php';
              </script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>
            alert('Yêu cầu không hợp lệ!');
            window.location.href = 'edit_profile.php';
          </script>";
    exit();
}
?>
