<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Bài Đăng</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
    <h2>Chỉnh Sửa Bài Đăng</h2>
    <form action="/admin/baidangthanhdoan/update/<?= $bai_dang['news_id'] ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" id="acc_id" name="acc_id" value="1"> <!-- Replace 1 with the actual account ID -->

        <div class="form-group">
            <label for="title">Tiêu Đề <span class="text-red">(*)</span></label>
            <input type="text" id="title" name="title" class="form-control" value="<?= htmlspecialchars($bai_dang['title']) ?>" required>
        </div>

        <div class="form-group">
            <label for="alias">Tên Đường Dẫn (alias)</label>
            <input type="text" id="alias" name="alias" class="form-control" value="<?= htmlspecialchars($bai_dang['alias']) ?>">
        </div>

        <div class="form-group">
            <label for="category_id">Danh Mục <span class="text-red">(*)</span></label>
            <select id="category_id" name="category_id" class="styled-select" onchange="fetchRelatedPosts()" required>
                <option value="">Chọn danh mục</option>
                <?php foreach ($ds_danh_muc as $danh_muc): ?>
                    <option value="<?= $danh_muc['cat_id'] ?>" <?= $danh_muc['cat_id'] == $bai_dang['category_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($danh_muc['title']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="assoc_id">Nội Dung Liên Quan</label>
            <select id="assoc_id" name="assoc_id" class=" select2 styled-select">
                <option value="">Chọn bài viết liên quan</option>
                <?php foreach ($ds_bai_dang as $bai_dang_item): ?>
                    <option value="<?= $bai_dang_item['news_id'] ?>" <?= $bai_dang_item['news_id'] == $bai_dang['assoc_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($bai_dang_item['title']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Mô Tả</label>
            <textarea id="description" name="description" class="form-control" rows="4"><?= htmlspecialchars($bai_dang['description']) ?></textarea>
        </div>

        <div class="form-group">
            <label for="content">Nội Dung Chi Tiết</label>
            <textarea id="content" name="content" class="form-control" rows="6"><?= htmlspecialchars($bai_dang['content']) ?></textarea>
        </div>

        <div class="form-group">
            <label for="img_file">Hình Ảnh (Để trống nếu không muốn thay đổi)</label>
            <input type="file" id="img_file" name="img_file" class="form-control-file">
        </div>

        <div class="form-group">
            <label for="enabled">Trạng Thái</label>
            <select id="enabled" name="enabled" class=" styled-select">
                <option value="1" <?= $bai_dang['enabled'] ? 'selected' : '' ?>>Kích hoạt</option>
                <option value="0" <?= !$bai_dang['enabled'] ? 'selected' : '' ?>>Vô hiệu hóa</option>
            </select>
        </div>

        <button type="submit" class="btn-submit">Lưu Thay Đổi</button>
    </form>

    <script>
        $(document).ready(function() {
            $('.select2').select2();

            // Initialize CKEditor for specific fields
            CKEDITOR.replace('description', {
                language: 'vi',
                filebrowserBrowseUrl: 'node_modules/ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl: 'node_modules/ckfinder/ckfinder.html?type=Images',
                filebrowserUploadUrl: 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl: 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
            });

            CKEDITOR.replace('content', {
                language: 'vi',
                filebrowserBrowseUrl: 'node_modules/ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl: 'node_modules/ckfinder/ckfinder.html?type=Images',
                filebrowserUploadUrl: 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl: 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
            });
        });

        // Fetch related posts based on category selection
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
</body>

</html>
