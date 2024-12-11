<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới bệnh nhân</title>
</head>
<body>
    <h2>Thêm mới bệnh nhân</h2>
    <form method="POST" action="process.php">
        <input type="hidden" name="action" value="add_user">
        <label>Tên bệnh nhân:</label>
        <input type="text" name="name_user" required><br>
        <label>Email người bệnh:</label>
        <input type="email" name="email_user" required><br>
        <label>SĐT người bệnh:</label>
        <input type="text" name="phone_user" required><br>
        <input type="submit" value="Thêm mới">
    </form>
</body>
</html>
