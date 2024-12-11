<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Quản lý Trang Đăng Ký Phòng Khám Bệnh</title>
    <style>
        /* Toàn bộ body */
        body {
            font-family: Arial, sans-serif;
           /* // background: url('https://source.unsplash.com/1600x900/?library') no-repeat center center fixed; */
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #333;
            background: red url('anh1.jpg');
            /* background:blue; */
        }

        /* Tiêu đề chính */
        h1 {
            text-align: center;
            color: white;
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            margin: 0;
            font-size: 2.5em;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }

        /* Container chính */
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Phân vùng mỗi phần */
        .section {
            margin-bottom: 30px;
            padding: 20px;
            border-radius: 8px;
        }

        /* Phân biệt màu nền từng phần */
        .section:nth-child(1) {
            background: #e3f2fd; /* Phần danh sách sách - xanh nhạt */
        }

        .section:nth-child(2) {
            background: #fffde7; /* Phần mượn hoặc trả sách - vàng nhạt */
        }

        /* Tiêu đề phụ */
        h2 {
            color: #333;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        /* Label và input */
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        select {
            background: #f9f9f9;
        }

        /* Nút bấm */
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Danh sách sách */
        .book-list {
            list-style-type: none;
            padding: 0;
        }

        .book-list li {
            background: #f9f9f9;
            margin: 5px 0;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .book-list li:hover {
            background: #e0f7fa;
            transform: translateX(5px);
        }

        /* Footer (nếu cần) */
        footer {
            text-align: center;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            margin-top: 20px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <h1>quản lý web đăng ký khám bệnh online </h1>

    <div class="container">
       
        <div class="section">
            <h2>Danh sách người dùng đăng ký phòng khám </h2>
            <?php include 'save_xml/save_rigister_clinic_sql.php'; ?>
            <?php include 'save_xml/table_registrations.php'; ?>
        </div>
        <div class="section">
            <h2>Danh sách phòng khám  </h2>
            <?php include 'save_xml/save_clinic_sql.php'; ?>
            <?php include 'save_xml/table_clinic.php'; ?>
        </div>
        <div class="section">
            <h2>Danh sách bác sĩ </h2>
            <?php include 'save_xml/save_doctor_sql.php'; ?>
            <?php include 'save_xml/table_doctor.php'; ?>
        </div>

        <div class="section">
            <h2>Danh sách người dùng </h2>
            <?php include 'save_xml/save_user_sql.php'; ?>
            <?php include 'save_xml/table_user.php'; ?>
        </div>
        

       
    </div>
    <form method="POST" action="admin_clinic/add_clinic.php">

        <button type="submit">đăng ký thêm phòng khám </button>
    </form>
    <form method="POST" action="admin_doctor/add_doctor.php">

        <button type="submit">thêm bác sĩ </button>
    </form>
    <form method="POST" action="admin_user/add_user.php">

        <button type="submit">đăng ký thêm người dùng  </button>
    </form>
   
    <form method="POST" action="logout.php">

        <button type="submit">Đăng xuất</button>
    </form>
</body>
</html>

