<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới bác sĩ</title>
</head>
<body>
    <h2>Thêm mới bác sĩ </h2>
    <form method="POST" action="process_doctor.php">
        <input type="hidden" name="action" value="add_doctor">
        <label>Tên bác sĩ :</label>
        <input type="text" name="name_doctor" required><br>
        <label>chuyên khoa :</label>
        <input type="text" name="department" required><br>
         <label>SĐT bác sĩ :</label>
        <input type="text" name="phone_doctor" required><br>
        <label>Email bác sĩ :</label>
        <input type="email" name="email_doctor" required><br>
       
        <input type="submit" value="Thêm mới">
    </form>
</body>
</html>
