<?php
function updateBookQuantity($filePath, $bookId, $action) {
    $xml = simplexml_load_file($filePath);

    foreach ($xml->books->book as $book) {
        if ((string)$book['id'] === $bookId) {
            $quantity = (int)$book->quantity;
            if ($action === "borrow" && $quantity > 0) {
                $book->quantity = $quantity - 1;
                echo "Sách '{$book->title}' đã được mượn. Số lượng còn lại: " . ($quantity - 1);
            } elseif ($action === "return") {
                $book->quantity = $quantity + 1;
                echo "Sách '{$book->title}' đã được trả. Số lượng hiện tại: " . ($quantity + 1);
            } else {
                echo "Không thể mượn sách '{$book->title}', không còn đủ số lượng.";
            }
            break;
        }
    }

    // Lưu thay đổi vào file XML
    $xml->asXML($filePath);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookId = $_POST['bookId'];
    $action = $_POST['action'];
    updateBookQuantity('library.xml', $bookId, $action);

    // Quay lại trang chính sau khi cập nhật
    echo '<br><a href="index.php">Quay lại trang chính</a>';
}
?>
