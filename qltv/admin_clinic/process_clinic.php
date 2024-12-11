<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name_clinic = $_POST['name_clinic'];
    $doctor_id = (int)$_POST['doctor_id'];
    $hospital_bills = (float)$_POST['hospital_bills'];

    // Kiểm tra xem phòng đã tồn tại chưa
    $sqlCheck = "SELECT id_clinic FROM list_clinic WHERE name_clinic='$name_clinic'";
    $resultCheck = $conn->query($sqlCheck);

    if ($resultCheck->num_rows > 0) {
        // Phòng đã tồn tại
        echo "Phòng khám này đã tồn tại, vui lòng chọn phòng khác!";
    } else {
        // Lấy thông tin bác sĩ
        $sqlDoctor = "SELECT name_doctor, department, email_doctor FROM login_doctor WHERE id_doctor=$doctor_id";
        $resultDoctor = $conn->query($sqlDoctor);
        $doctor = $resultDoctor->fetch_assoc();
        
        if ($doctor) {
            $name_doctor = $doctor['name_doctor'];
            $department = $doctor['department'];
            $email_doctor = $doctor['email_doctor'];

            // Thêm phòng khám mới vào cơ sở dữ liệu
            $sql = "INSERT INTO list_clinic (name_clinic, name_doctor, department, email_doctor, Hospital_bills)
                    VALUES ('$name_clinic', '$name_doctor', '$department', '$email_doctor', $hospital_bills)";
            if ($conn->query($sql)) {
                echo "Thêm mới phòng khám thành công!";
                header("Location: ../index_admin.php");
            } else {
                echo "Lỗi: " . $conn->error;
            }
        } else {
            echo "Không tìm thấy thông tin bác sĩ.";
           
        }
    }
}

$conn->close();
?>
