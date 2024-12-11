<?php
// Bắt đầu session để lấy thông tin người dùng
 session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['name']) || !isset($_SESSION['email'])) {
    echo "<script>
            alert('Vui lòng đăng nhập trước!');
            window.location.href = 'login.php'; // Chuyển hướng về trang đăng nhập
          </script>";
    exit();
}

// Lấy thông tin người dùng từ session
$id = $_SESSION['id'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chính</title>

    <style>
        body {
            /* background: #c78484; */
        }
        .content{

        }
        .button-container {
            margin: 20px 30px 40px 50px;
            /* Căn giữa theo chiều ngang */
            width: 50%;
            /* Đặt độ rộng bảng, tùy chỉnh theo ý muốn */
            display: flex;
            /* Sắp xếp các phần tử con nằm ngang */
            gap: 15px;
            /* Khoảng cách giữa các nút */
        }

        .button-container form {
            margin: 0;
            /* Bỏ khoảng cách mặc định giữa các form */
        }

        /* Tùy chỉnh màu sắc cho các nút */
        .btn-yellow {
            display: block;
            left: 20px
            font-size: 16px;
            color: #fff;
            background: linear-gradient(135deg, #667eea 0%, #fd23c7 100%);
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
            box-shadow: 0 4px 14px 0 rgba(0, 118, 255, 0.39);
            transition: all 0.2s ease-in-out;
        }

        .btn-yellow:hover {
            transform: translateY(-5px);
            /* Nhấc lên khi hover */
            box-shadow: 0 6px 16px rgba(248, 4, 126, 0.57);
            /* Tăng độ đổ bóng */
        }

        .btn-yellow:active {
            transform: translateY(3px);
            /* Hạ xuống nhẹ khi nhấn */

        }

        .btn-green {
            display: block;
            left: 20px
            font-size: 16px;
            color: #fff;
            background: linear-gradient(135deg, #afe930 0%, #fd2362 100%);
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
            box-shadow: 0 4px 14px 0 rgb(255 0 36 / 44%);
            transition: all 0.2s ease-in-out;
        }


        .btn-green:hover {
            transform: translateY(-5px);
            /* Nhấc lên khi hover */
            box-shadow: 0 6px 16px rgba(248, 4, 126, 0.57);
            /* Tăng độ đổ bóng */
        }

        .btn-green:active {

            transform: translateY(3px);
            /* Hạ xuống nhẹ khi nhấn */

        }

        /* Định dạng cơ bản cho bảng */
        table {
            margin: 20px auto;
            /* Căn giữa theo chiều ngang */
            width: 80%;
            /* Đặt độ rộng bảng, tùy chỉnh theo ý muốn */
            width: 50%;
            border-collapse: collapse;
            /* margin: 20px auto; */
            text-align: center;
        }

        th,
        td {
            padding: 10px;
        }

        /* Hiệu ứng hover cho ô */
        tr:hover {
            background-color: #4CAF50;
            /* Màu nền khi hover */
            color: #000;
            /* Màu chữ khi hover */
            cursor: pointer;
            /* Con trỏ chuột dạng tay */
            transform: scale(1.05);
            /* Phóng to nhẹ khi hover */
            transition: all 0.3s ease;
            /* Thời gian và kiểu chuyển đổi */
        }


        /* menu drop */
        /* Định dạng cho container của dropdown */
        .dropdown {
            position: absolute;
            display: block;
            right: 20px;
        }

        

        /* Nút của menu */
        .dropdown-btn {
            right: 20px;
            background-color: #4CAF50;
            /* Màu nền */
            color: white;
            /* Màu chữ */
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        /* Nội dung menu dropdown (ẩn mặc định) */
        .dropdown-content {

            display: none;
            position: absolute;
            right: inherit;
            background-color: #bbe8ff;
            width: 300px;
            height: 420px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 10px;
        }

        .dropdown-content form{
            margin: 15px ; /* Căn giữa theo chiều ngang */
            width: 80%; /* Đặt độ rộng bảng, tùy chỉnh theo ý muốn */
        }

        /* Định dạng cho các liên kết trong menu */
        .dropdown-content a {
            left: 20px;
            background-color: #;
            color: black;
            padding: 10px 16px;
            text-decoration: none;
            display: block;
            border-bottom: 1px solid #ddd;
        }

        .dropdown-content h1 {
            left: 20px;
            background-color: #;
            color: black;
            padding: 10px 16px;
            text-decoration: none;
            display: block;
            border-bottom: 1px solid #ddd;
        }

        .dropdown-content p {
            left: 20px;
            background-color: #;
            color: black;
            padding: 10px 16px;
            text-decoration: none;
            display: block;
            border-bottom: 1px solid #ddd;
        }

        /* Hiệu ứng hover cho liên kết */
        .dropdown-content a:hover {
            background-color: #ddd;

        }

        .dropdown-content p:hover {
            background-color: #ddd;
        }

        /* Hiện menu khi bật */
        .show {
            display: block;
        }
        /* Sidebar */
.sidebar {
    height: 100%; /* Chiều cao toàn màn hình */
    width: 0; /* Bắt đầu với chiều rộng 0 để ẩn */
    position: fixed;
    top: 0;
    left: 0;
    background-color: #111; /* Màu nền đen */
    overflow-x: hidden; /* Ẩn cuộn ngang */
    transition: 0.3s; /* Hiệu ứng mở/đóng mượt mà */
    padding-top: 60px; /* Khoảng cách từ trên xuống */
}

/* Các liên kết trong sidebar */
.sidebar a {
    padding: 10px 15px;
    text-decoration: none;
    font-size: 18px;
    color: #fff;
    display: block;
    transition: 0.3s;
}

.sidebar a:hover {
    background-color: #575757;
}

/* Nút đóng sidebar */
.sidebar .close-btn {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 25px;
    color: #fff;
    text-decoration: none;
    cursor: pointer;
}

/* Nút mở menu */
.menu-button {
    font-size: 18px;
    background-color: #111;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 1;
}

.menu-button:hover {
    background-color: #575757;
}

/* Nội dung chính */
.content {
    margin-left: 20px;
    padding: 20px;
    transition: margin-left 0.3s; /* Hiệu ứng dịch chuyển nội dung */
    margin-left: 0; /* Ban đầu không có khoảng cách */

}
    </style>

</head>

<body>

    <!-- Nút mở sidebar -->
    <button id="openSidebar" class="menu-button">☰ Mở Menu</button>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
    <h1>Chào mừng bạn, <?php echo $name; ?>!</h1>
            <p>Email của bạn: <?php echo $email; ?></p>
            <p>Số điện thoại của bạn: <?php echo htmlspecialchars($phone); ?></p>
            </form>
            <form class="a" method="POST" action="edit_profile.php">
                <button type="submit" class="btn-yellow">Chỉnh sửa thông tin cá nhân</button>
            </form>
            </form>
            <form class="b" method="POST" action="logout.php">
                <button type="submit" class="btn-yellow">Đăng xuất</button>
            </form>
            <a href="#" class="close-btn" id="closeSidebar">&times;</a>
    </div>

<div class="dropdown">
        <button class="dropdown-btn">Menu</button>
        <div class="dropdown-content">
            <h1>Chào mừng bạn, <?php echo $name; ?>!</h1>
            <p>Email của bạn: <?php echo $email; ?></p>
            <p>Số điện thoại của bạn: <?php echo htmlspecialchars($phone); ?></p>
            </form>
            <form class="a" method="POST" action="edit_profile.php">
                <button type="submit" class="btn-yellow">Chỉnh sửa thông tin cá nhân</button>
            </form>
            </form>
            <form class="b" method="POST" action="logout.php">
                <button type="submit" class="btn-yellow">Đăng xuất</button>
            </form>
        </div>
    </div>

  
    <div class="container" id="container">
        <!-- Hiển thị danh sách sách -->
        <div class="section">
            <h2>Danh sách phòng khám đã đăng ký </h2>
            <?php include 'save_xml/save_rigister_clinic_sql.php'; ?>
            <?php include 'model_register_clinic.php'; ?>
        </div>
    </div>
    <!-- Đăng xuất -->
     
    <div class="button-container">
        <form method="POST" action="index.php">
            <button type="submit" class="btn-yellow">Quay về trang chủ</button>
        </form>
        <form method="POST" action="RegisterClinics.php">
            <button type="submit" class="btn-green ">Đăng ký phòng khám</button>
        </form>
        <form method="POST" action="edit_profile.php">
        <button type="submit" class="btn-yellow">Chỉnh sửa thông tin cá nhân</button>
    </form>
    </div>

    

    
</body>

</html>

<script>
    // Lấy phần tử nút và menu
    const dropdownBtn = document.querySelector('.dropdown-btn');
    const dropdownContent = document.querySelector('.dropdown-content');

    // Thêm sự kiện click vào nút
    dropdownBtn.addEventListener('click', () => {
        dropdownContent.classList.toggle('show');
    });

    // Đóng menu khi bấm ra ngoài
    window.addEventListener('click', (e) => {
        if (!e.target.matches('.dropdown-btn')) {
            const dropdowns = document.querySelectorAll('.dropdown-content');
            dropdowns.forEach((dropdown) => {
                dropdown.classList.remove('show');
            });
        }
    });

// Lấy các phần tử
const sidebar = document.getElementById('sidebar');
const openBtn = document.getElementById('openSidebar');
const closeBtn = document.getElementById('closeSidebar');
const container =document.getElementById('container')
// Sự kiện mở sidebar
openBtn.addEventListener('click', () => {
    sidebar.style.width = '250px'; // Mở sidebar với chiều rộng 250px
    container.style.marginLeft = '250px'; // Dịch nội dung sang phải

});

// Sự kiện đóng sidebar
closeBtn.addEventListener('click', () => {
    sidebar.style.width = '0'; // Đóng sidebar về 0
    container.style.marginLeft = '0'; // Đưa nội dung về vị trí ban đầu

});

</script>