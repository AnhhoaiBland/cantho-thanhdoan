<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Danh Mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

        button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-note {
            text-align: center;
            color: #777;
            font-size: 14px;
            margin-top: 20px;
        }

        /* Thêm kiểu cho dấu (*) yêu cầu */
        .required-star {
            color: red;
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Chỉnh Sửa Danh Mục</h2>

        <form action="/admin/dmbaidang_thanhdoan/update/<?= $category['cat_id'] ?>" method="post">
            <!-- Bảo vệ CSRF -->
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="parent_id">Danh Mục Cha:</label>
                <select id="parent_id" name="parent_id" class="form-select">
                    <option value="0">-- Không có danh mục cha --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['cat_id'] ?>" <?= ($cat['cat_id'] == old('parent_id', $category['parent_id'])) ? 'selected' : '' ?>>
                            <?= str_repeat('--', $cat['depth']) . ' ' . htmlspecialchars($cat['title']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="title">Tiêu Đề:<span class="required-star">*</span></label>
                <input type="text" id="title" name="title" placeholder="Nhập tiêu đề danh mục" value="<?= old('title', htmlspecialchars($category['title'])) ?>" required>
            </div>

            <div class="form-group">
                <label for="alias">Alias (Đường dẫn):<span class="required-star">*</span></label>
                <input type="text" id="alias" name="alias" placeholder="Nhập alias" value="<?= old('alias', htmlspecialchars($category['alias'])) ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Mô Tả:</label>
                <textarea id="description" name="description" placeholder="Nhập mô tả"><?= old('description', htmlspecialchars($category['description'])) ?></textarea>
            </div>

            <div class="form-group">
                <label for="enabled">Trạng Thái:</label>
                <select id="enabled" name="enabled" class="form-select">
                    <option value="1" <?= (old('enabled', $category['enabled']) === '1') ? 'selected' : '' ?>>Kích hoạt</option>
                    <option value="0" <?= (old('enabled', $category['enabled']) === '0') ? 'selected' : '' ?>>Vô hiệu hóa</option>
                </select>
            </div>

            <button type="submit">Cập Nhật Danh Mục</button>
        </form>
        <div class="form-note">Vui lòng điền đầy đủ thông tin trước khi cập nhật danh mục</div>
    </div>

    <!-- Thêm các thư viện cần thiết -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- CKEditor nếu cần (tùy chỉnh nếu sử dụng) -->
    <!-- <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script> -->

    <script>
        // Hàm slugify để chuyển đổi chuỗi thành slug
        function slugify(text) {
            return text.toString().toLowerCase()
                .normalize('NFD')                   // Chuyển các ký tự có dấu sang dạng chuẩn hóa
                .replace(/[\u0300-\u036f]/g, '')   // Loại bỏ dấu
                .replace(/[^a-z0-9 -]/g, '')       // Loại bỏ ký tự không phải chữ, số, dấu cách hoặc dấu -
                .replace(/\s+/g, '-')               // Thay thế khoảng trắng bằng dấu -
                .replace(/-+/g, '-')                // Thay thế nhiều dấu - thành một
                .trim();                            // Loại bỏ khoảng trắng ở đầu và cuối
        }

        document.addEventListener('DOMContentLoaded', function() {
            const tieuDe = document.getElementById('title');
            const duongDan = document.getElementById('alias');
            let aliasManuallyEdited = false;

            // Nếu alias được chỉnh sửa thủ công, không tự động cập nhật
            duongDan.addEventListener('input', function() {
                aliasManuallyEdited = true;
            });

            tieuDe.addEventListener('input', function(e) {
                let vl = e.target.value;
                if (vl != null && vl.length > 0 && !aliasManuallyEdited) {
                    duongDan.value = slugify(vl);
                }
            });
        });
    </script>
</body>

</html>
