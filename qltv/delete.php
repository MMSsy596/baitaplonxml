<?php
// Kiểm tra nếu có tham số reader_id và book_id trong URL
if (isset($_GET['reader_id']) && isset($_GET['book_id'])) {
    $reader_id = $_GET['reader_id'];
    $book_id = $_GET['book_id'];

    // Tải file XML
    $xml = simplexml_load_file('library.xml');

    // Duyệt qua tất cả các người mượn sách
    foreach ($xml->readers->reader as $reader) {
        // Kiểm tra nếu người mượn có id trùng với reader_id
        if ($reader['id'] == $reader_id) {
            // Duyệt qua danh sách các sách mà người mượn đã mượn
            foreach ($reader->borrowed_books->book_id as $information => $book_id_element) {
                // Kiểm tra nếu book_id trùng với sách cần xóa
                if ((string)$book_id_element == $book_id) {
                    // Xóa sách khỏi danh sách
                    unset($reader->borrowed_books->book_id[$information]);
                    break; // Dừng vòng lặp khi đã xóa xong
                }
            }
        }
    }

    // Lưu lại file XML sau khi xóa
    $xml->asXML('library.xml');

    // Sau khi xóa, chuyển hướng về trang chính để cập nhật lại danh sách
    header("Location: information.php");
    exit();
}
?>
