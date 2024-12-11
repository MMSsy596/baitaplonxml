<?php
// Đọc nội dung từ các file XML
$page1 = simplexml_load_file('page1.xml');
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Đơn Xin Việc</title>
</head>

<body>
    <div class="container">
        <!-- Thông tin cá nhân -->
        <section id="personal-info">
            <h2>Thông Tin Cá Nhân</h2>
            <p><?php echo $page1->personal_info->name; ?></p>
            <p><?php echo $page1->personal_info->address; ?></p>
            <p><?php echo $page1->personal_info->email; ?></p>
            <p><?php echo $page1->personal_info->phone; ?></p>
            <p><?php echo $page1->personal_info->position; ?></p>
        </section>

        <!-- Học vấn -->
        <section id="education">
            <h2>Học Vấn</h2>
            <p><?php echo $page1->education->degree; ?></p>
            <p><?php echo $page1->education->school; ?></p>
            <p><?php echo $page1->education->graduation_year; ?></p>
        </section>

        <!-- Kinh nghiệm làm việc -->
        <section id="experience">
            <h2>Kinh Nghiệm Làm Việc</h2>
            <p><?php echo $page1->experience->job_title; ?></p>
            <p><?php echo $page1->experience->company; ?></p>
            <p><?php echo $page1->experience->duration; ?></p>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>