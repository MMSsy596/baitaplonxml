<?php


// Thông tin kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "loginclinic";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
