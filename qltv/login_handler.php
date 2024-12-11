<?php
session_start();
// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';


// Kiểm tra nếu form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin từ form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Kiểm tra nếu người dùng không nhập đủ thông tin
    if (empty($email) || empty($password)) {
        echo "<script>
                alert('Vui lòng nhập đầy đủ thông tin!');
                window.location.href = 'login.php';
              </script>";
        exit();
    }

    // Kiểm tra thông tin đăng nhập
    $sql_check_login = "SELECT * FROM login_user WHERE email_user = ? AND password_user = ?";
    $stmt = $conn->prepare($sql_check_login);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    // Kiểm tra thông tin đăng nhập của docter
    $sql_check_login_doctor = "SELECT * FROM login_doctor WHERE email_doctor = ? AND password_doctor = ?";
    $stmt_doctor = $conn->prepare($sql_check_login_doctor);
    $stmt_doctor->bind_param("ss", $email, $password);
    $stmt_doctor->execute();
    $result_doctor = $stmt_doctor->get_result();
     // Kiểm tra thông tin đăng nhập của admin
     $sql_check_login_admin = "SELECT * FROM login_admin WHERE account_admin = ? AND password_admin = ?";
     $stmt_admin = $conn->prepare($sql_check_login_admin);
     $stmt_admin->bind_param("ss", $email, $password);
     $stmt_admin->execute();
     $result_admin = $stmt_admin->get_result();
     

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        // Lưu thông tin người dùng vào session
        $_SESSION['id'] = $user['id_user'];
        $_SESSION['name'] = $user['name_user'];
        $_SESSION['email'] = $user['email_user'];
        $_SESSION['phone'] = $user['phone_user'];


        // Đăng nhập thành công
        echo "<script>
                alert('Đăng nhập thành công!');
                window.location.href = 'index.php'; // Chuyển đến trang chính
              </script>";

    }
    else if($result_doctor->num_rows > 0) 
    {
        
        $user_doctor = $result_doctor->fetch_assoc();

        // Lưu thông tin người dùng vào session
        $_SESSION['id_doctor'] = $user_doctor['id_doctor'];
        $_SESSION['name_doctor'] = $user_doctor['name_doctor'];
        $_SESSION['department'] = $user_doctor['department'];
        $_SESSION['email_doctor'] = $user_doctor['email_doctor'];
        $_SESSION['phone_doctor'] = $user_doctor['phone_doctor'];


        // Đăng nhập thành công
        echo "<script>
                alert('Đăng nhập thành công!');
                window.location.href = 'index_doctor.php'; 
              </script>";

            
    }else if($result_admin->num_rows > 0) 
    {
        
        $user_admin = $result_admin->fetch_assoc();
        $_SESSION['account_admin'] = $user_admin['account_admin'];

        // Đăng nhập thành công
        echo "<script>
                alert('Đăng nhập thành công!');
                window.location.href = 'index_admin.php'; 
              </script>";

            
    }  else {
        // Đăng nhập thất bại
        echo "<script>
                alert('Email hoặc mật khẩu không chính xác!');
                window.location.href = 'login.php';
              </script>";
    }
}

// Đóng kết nối
$conn->close();
?>
