<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Danh Mục Mới</title>
    <style>
        /* CSS tùy chỉnh cho giao diện */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            color: #555;
        }

        .submit {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .form-note {
            text-align: center;
            color: #777;
            font-size: 14px;
            margin-top: 20px;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .form-container {
                padding: 20px;
            }
        }

        /* Thêm kiểu cho dấu (*) yêu cầu */
        .required-star {
            color: red;
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <button class="btn btn-danger " onclick="window.location.href='/admin/dmbaidang_thanhdoan'">Quay Về</button>
    <div>
        <h2>Thêm Danh Mục Mới</h2>
        <!-- Hiển thị thông báo lỗi nếu có -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="/admin/dmbaidang_thanhdoan/store" method="post">
            <!-- Bảo vệ CSRF nếu cần -->
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="parent_id">Danh Mục Cha:</label>
                <select id="parent_id" name="parent_id" class="form-control">
                    <option value="0">-- Không có danh mục cha --</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['cat_id'] ?>" <?= ($category['cat_id'] == old('parent_id')) ? 'selected' : '' ?>>
                            <?= str_repeat('--', $category['depth']) . ' ' . htmlspecialchars($category['title']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="title">Tiêu Đề:<span class="required-star">*</span></label>
                <input type="text" id="title" name="title" placeholder="Nhập tiêu đề danh mục" value="<?= old('title') ?>" required>
            </div>

            <div class="form-group">
                <label for="alias">Alias (Đường dẫn):<span class="required-star">*</span></label>
                <input type="text" id="alias" name="alias" placeholder="Nhập alias" value="<?= old('alias') ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Mô Tả:</label>
                <textarea id="description" name="description" placeholder="Nhập mô tả"><?= old('description') ?></textarea>
            </div>

            <div class="form-group">
                <label for="enabled">Trạng Thái:</label>
                <select id="enabled" name="enabled" class="form-control">
                    <option value="1" <?= (old('enabled') === '1') ? 'selected' : '' ?>>Kích hoạt</option>
                    <option value="0" <?= (old('enabled') === '0') ? 'selected' : '' ?>>Vô hiệu hóa</option>
                </select>
            </div>

            <button class="submit" type="submit">Thêm Danh Mục</button>
        </form>
        <div class="form-note">Vui lòng điền đầy đủ thông tin trước khi thêm danh mục</div>
    </div>

    <!-- Thêm các thư viện cần thiết -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- CKEditor nếu cần (tùy chỉnh nếu sử dụng) -->
    <!-- <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script> -->

    <script>
        // Hàm slugify để chuyển đổi chuỗi thành slug
        function slugify(text) {
            return text.toString().toLowerCase()
                .normalize('NFD') // Chuyển các ký tự có dấu sang dạng chuẩn hóa
                .replace(/[\u0300-\u036f]/g, '') // Loại bỏ dấu
                .replace(/[^a-z0-9 -]/g, '') // Loại bỏ ký tự không phải chữ, số, dấu cách hoặc dấu -
                .replace(/\s+/g, '-') // Thay thế khoảng trắng bằng dấu -
                .replace(/-+/g, '-') // Thay thế nhiều dấu - thành một
                .trim(); // Loại bỏ khoảng trắng ở đầu và cuối
        }

        document.addEventListener('DOMContentLoaded', function() {
            const tieuDe = document.getElementById('title');
            const duongDan = document.getElementById('alias');

            tieuDe.addEventListener('input', function(e) {
                let vl = e.target.value;
                if (vl != null && vl.length > 0) {
                    duongDan.value = slugify(vl);
                } else {
                    duongDan.value = '';
                }
            });

            // Nếu người dùng thay đổi alias thủ công, không tự động cập nhật
            duongDan.addEventListener('input', function(e) {
                // Có thể thêm logic nếu cần
            });
        });
    </script>
</body>

</html>