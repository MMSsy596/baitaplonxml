<?php
// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';


// Lấy thông tin từ form
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];

// Kiểm tra xem người dùng đã nhập đầy đủ thông tin chưa
if (empty($name) || empty($email) || empty($password) || empty($phone)) {
    echo "<script>
            alert('Vui lòng nhập đầy đủ thông tin!');
            window.location.href = 'register.php'; // Quay lại trang đăng ký
          </script>";
    exit();
}

// Kiểm tra nếu email đã tồn tại trong cơ sở dữ liệu
$sql_check_email = "SELECT * FROM login_user WHERE email_user = ?";
$stmt = $conn->prepare($sql_check_email);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>
            alert('Email đã tồn tại!');
            window.location.href = 'register.php';
          </script>";
    exit();
}

// Thêm người dùng mới vào cơ sở dữ liệu (mã hóa mật khẩu)
$sql_insert_user = "INSERT INTO login_user (name_user, email_user, phone_user, password_user) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql_insert_user);
$stmt->bind_param("ssss", $name, $email, $phone, $password);

if ($stmt->execute()) {
    echo "<script>
            alert('Đăng ký thành công!');
            window.location.href = 'login.php'; // Chuyển tới trang đăng nhập
          </script>";
} else {
    echo "<script>
            alert('Đã xảy ra lỗi. Vui lòng thử lại sau!');
            window.location.href = 'register.php';
          </script>";
}

// Đóng kết nối
$conn->close();
?>
