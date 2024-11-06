
<!DOCTYPE html>
<html>
<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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

        .btn-back {
            background-color: #95a5a6;
            color: white;
            margin-top: 10px;
        }

        .btn-back:hover {
            background-color: #7f8c8d;
            transform: translateY(-2px);
        }

        .form-group select.styled-select {
            width: 100%;
            padding: 12px;
            border: 1px solid #dcdcdc;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
            appearance: none;
            /* Remove default styling for select */
        }

        .form-group select.styled-select:focus {
            border-color: #3498db;
            outline: none;
        }

        /* Optional: Customize the Select2 dropdown to match the form style */
        .select2-container .select2-selection--single {
            height: auto;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #dcdcdc;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #34495e;
            font-size: 16px;
            padding-left: 10px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100%;
        }
    </style>
</head>

<body>
    <button class="btn btn-danger" onclick="window.location.href='/admin/baidangthanhdoan'">Quay Về</button>
    <h2>Thêm Bài Đăng Thành Đoàn</h2>

    <form action="/admin/baidangthanhdoan/store" method="post" enctype="multipart/form-data">
        <input type="hidden" id="acc_id" name="acc_id" value="1"> <!-- Replace 1 with the actual account ID -->

        <div class="form-group">
            <label for="title">Tiêu Đề</label>
            <input type="text" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="alias">Tên Đường Dẫn (alias)</label>
            <input type="text" id="alias" name="alias">
        </div>

        <div class="form-group">
            <label for="category_id">Danh Mục</label>
            <select id="category_id" name="category_id" onchange="fetchRelatedPosts()" required>
                <option value="">Chọn danh mục</option>
                <?php foreach ($ds_danh_muc as $danh_muc): ?>
                    <option value="<?= $danh_muc['cat_id'] ?>"><?= htmlspecialchars($danh_muc['title']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="assoc_id">Nội Dung Liên Quan</label>
            <select id="assoc_id" name="assoc_id" class="select2 styled-select">
                <option value="">Chọn bài viết liên quan</option>
                <!-- Options will be populated dynamically -->
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

<!-- Lặp những bài viết liên quan đến danh mục -->
<script>
    function fetchRelatedPosts() {
        const categoryId = document.getElementById('category_id').value;
        const assocSelect = document.getElementById('assoc_id');

        if (categoryId) {
            fetch(`/admin/baidangthanhdoan/relatedPosts/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    assocSelect.innerHTML = '<option value="">Chọn bài viết liên quan</option>';
                    data.forEach(post => {
                        assocSelect.innerHTML += `<option value="${post.news_id}">${post.title}</option>`;
                    });
                });
        } else {
            assocSelect.innerHTML = '<option value="">Chọn bài viết liên quan</option>';
        }
    }
</script>

<!-- CKEDITOR -->
<script>
    $(document).ready(function() {
        $('input[required], select[required], textarea[required]').each(function() {
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