<?php
 // Bắt đầu session để lấy thông tin người dùng
  session_start();
 
 
 
 // Lấy thông tin người dùng từ session
 $id_doctor = $_SESSION['id_doctor'];
 $phone_doctor = $_SESSION['phone_doctor'];
 $name_doctor = $_SESSION['name_doctor'];
 $email_doctor = $_SESSION['email_doctor'];
 ?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chính</title>

    <style>
        .button-container {
            display: flex; /* Sắp xếp các phần tử con nằm ngang */
            gap: 10px; /* Khoảng cách giữa các nút */
        }

        .button-container form {
            margin: 0; /* Bỏ khoảng cách mặc định giữa các form */
        }

        /* Tùy chỉnh màu sắc cho các nút */
        .btn-yellow {
            background-color: yellow;
            color: black; /* Màu chữ */
            border: 1px solid #ccc; /* Viền */
            padding: 10px 20px; /* Khoảng cách bên trong */
            cursor: pointer;
            font-size: 16px;
        }

        .btn-green  {
            background-color: green ;
            color: white; /* Màu chữ */
            border: 1px solid #ccc; /* Viền */
            padding: 10px 20px; /* Khoảng cách bên trong */
            cursor: pointer;
            font-size: 16px;
        }

        /* Thêm hiệu ứng hover */
        .btn-yellow:hover {
            background-color: gold;
        }

        .btn-green :hover {
            background-color: darkblue;
        }
    </style>
</head>

<body>
<p>Chào mừng, Bác sĩ <?php echo htmlspecialchars($name_doctor); ?> (<?php echo htmlspecialchars($email_doctor); ?>)</p>
    <p>Email của bạn: <?php echo $email_doctor; ?></p>
    <p>Số điện thoại của bạn: <?php echo htmlspecialchars($phone_doctor); ?></p>
    <p>sđt của bạn: <?php echo $phone_doctor; ?></p>
    <div class="container">
        <!-- Hiển thị danh sách sách -->
        <div class="section">
            <h2>Danh sách phòng khám đã đăng ký </h2>
            <?php include 'save_xml/save_rigister_clinic_sql.php'; ?>
            <?php include 'model_register_clinic.php'; ?>
        </div>
        <div class="section">
            <h2>Danh sách phòng khám </h2>
            <?php include 'save_xml/save_clinic_sql.php'; ?>
            <?php include 'model_list_clinic_doctor.php'; ?>
        </div>
    </div>


 
    <div class="button-container">
        <form method="POST" action="index_doctor.php">
            <button type="submit" class="btn-yellow">Quay về trang chủ</button>
        </form>
        <form method="POST" action="register_clinic_doctor_form.php">
            <button type="submit" class="btn-green ">Đăng ký phòng khám</button>
        </form>
        <form method="POST" action="edit_profile_doctor.php">
        <button type="submit" class="btn-yellow">Chỉnh sửa thông tin cá nhân</button>
    </form>
    </div>

    
    <form method="POST" action="logout.php">

        <button type="submit">Đăng xuất</button>
    </form>
    
</body>
</html>
