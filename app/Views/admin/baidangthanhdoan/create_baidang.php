<script>
    $(document).ready(function () {
        $('input[required], select[required], textarea[required]').each(function () {
            $(this).parent().find('label').append('<span class="text-red">(*)</span>');
        });
        $('.select2').select2();

        // Initialize CKEditor for specific fields
        CKEDITOR.replace('description', {
            language: 'vi',
            filebrowserBrowseUrl: 'node_modules/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl: 'node_modules/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl: 'node_modules/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl: 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl: 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        });

        CKEDITOR.replace('content', {
            language: 'vi',
            filebrowserBrowseUrl: 'node_modules/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl: 'node_modules/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl: 'node_modules/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl: 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl: 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        });
    });

    const tieuDe = document.getElementById('title');
    const duongDan = document.getElementById('alias');

    tieuDe.addEventListener('change', (e) => {
        let vl = e.target.value;
        if (vl != null && vl.length > 0) {
            duongDan.value = slugify(vl);
        }
    });
</script>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm Bài Đăng Thành Đoàn</title>
    <style>

        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
            color: #34495e;
            display: block;
            margin-bottom: 8px;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #dcdcdc;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #3498db;
            outline: none;
        }
        .btn-submit {
            background-color: #3498db;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn-submit:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<h2>Thêm Bài Đăng Thành Đoàn</h2>

<form action="/admin/baidangthanhdoan/store" method="post" enctype="multipart/form-data">
    <input type="hidden" id="acc_id" name="acc_id" value="1"> <!-- Replace 1 with the actual account ID -->

    <div class="form-group">
        <label for="title">Tiêu Đề</label>
        <input type="text" id="title" name="title" required>
    </div>

    <div class="form-group">
        <label for="alias">Alias</label>
        <input type="text" id="alias" name="alias">
    </div>

    <div class="form-group">
        <label for="category_id">Danh Mục</label>
        <select id="category_id" name="category_id">
            <?php foreach ($ds_danh_muc as $danh_muc): ?>
                <option value="<?= $danh_muc['cat_id'] ?>"><?= htmlspecialchars($danh_muc['title']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="description">Mô Tả</label>
        <textarea id="description" name="description" rows="4"></textarea>
    </div>

    <div class="form-group">
        <label for="content">Nội Dung Chi Tiết</label>
        <textarea id="content" name="content" rows="6"></textarea>
    </div>

    <div class="form-group">
        <label for="img_file">Hình Ảnh</label>
        <input type="file" id="img_file" name="img_file">
    </div>

    <div class="form-group">
        <label for="enabled">Trạng Thái</label>
        <select id="enabled" name="enabled">
            <option value="1">Kích hoạt</option>
            <option value="0">Vô hiệu hóa</option>
        </select>
    </div>

    <button type="submit" class="btn-submit">Lưu Bài Đăng</button>
</form>

</body>
</html>

