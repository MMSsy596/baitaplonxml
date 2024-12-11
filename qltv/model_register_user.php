<?php
// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';

$sqllogin_user = "SELECT * FROM login_user";
$resultlogin_user = $conn->query($sqllogin_user);

?>