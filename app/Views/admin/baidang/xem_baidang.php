<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem Bài Đăng</title>
    <style>
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .post {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Xem Bài Đăng</h1>
        <?php if (isset($baiDang) && !empty($baiDang)): ?>
            <div class="post">
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label>Ngày đăng:</label>
                        <p><?= date('Y-m-d', strtotime($baiDang[0]['ngayDang'])); ?></p>
                    </div>
                    <div class="col-md-5 form-group">
                        <label>Người đăng:</label>
                        <p><?= htmlspecialchars($baiDang[0]['tenNguoiDung']); ?></p>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Tiêu đề:</label>
                        <p><?= htmlspecialchars($baiDang[0]['tieuDe']); ?></p>
                    </div>
                    <div class="col-md-7 form-group">
                        <label>Đường dẫn bài viết:</label>
                        <p><?= htmlspecialchars($baiDang[0]['urlBaiDang']); ?></p>
                    </div>
                    <div class="col-md-7 form-group">
                        <label>Mục Tin:</label>
                        <p><?= htmlspecialchars($baiDang[0]['tenChuyenMuc']); ?></p>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Hình ảnh:</label>
                        <img src="upload/media/images/<?= htmlspecialchars($baiDang[0]['anhTieuDe']); ?>" alt="Không hiển thị được hình" width="auto" height="100px">
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Nội dung:</label>
                        <p><?= nl2br(htmlspecialchars($baiDang[0]['noiDung'])); ?></p>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p>Bài viết không tồn tại.</p>
        <?php endif; ?>
        <a href="ds_baidang.php" class="back-button">Back</a>
    </div>
</body>
</html>