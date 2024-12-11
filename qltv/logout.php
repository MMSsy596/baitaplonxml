
<?php
session_start();
session_destroy(); // Hủy toàn bộ session
echo "<script>
        alert('Bạn đã đăng xuất thành công!');
        window.location.href = 'login.php'; // Quay lại trang đăng nhập
      </script>";
exit();
?>