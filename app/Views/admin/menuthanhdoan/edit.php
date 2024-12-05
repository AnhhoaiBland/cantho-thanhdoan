<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Danh Mục</title>
    <style>
        /* CSS giữ nguyên */
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
        }

        .form-group {
            margin-bottom: 20px;
        }

        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }

        /* Thêm một số CSS để xử lý layout */
        .d-flex {
            display: flex;
            gap: 20px;
        }

        .col-6 {
            flex: 1;
        }

        .col-4 {
            flex: 1;
        }

        .col-2 {
            flex: 0 0 20%;
        }

        .text-center {
            text-align: center;
        }

        .btn {
            padding: 5px 10px;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            color: white;
            cursor: pointer;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
    <!-- Thêm jQuery nếu chưa có -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h2>Chỉnh Sửa Menu</h2>

    <!-- Start Form -->
    <form action="<?= base_url('/admin/menuthanhdoan/updateMenu/' . $menuItem['id']) ?>" method="POST">
        <?= csrf_field() ?>
        <div class="form-group">
            <div class="d-flex">
                <div class="col-6">
                    <label for="parent_title">Tiêu Đề (Menu Cha):</label>
                    <input type="text" id="parent_title" name="title" value="<?= esc($menuItem['title']) ?>" required>
                </div>
                <div class="col-6">
                    <label for="parent_url">URL (Menu Cha):</label>
                    <input type="text" id="parent_url" name="url" value="<?= esc($menuItem['url']) ?>" required>
                </div>
            </div>
            <div class="d-flex">
                <div class="col-6">
                    <label for="order">Số thứ tự</label>
                    <input type="number" id="order" name="order" value="<?= esc($menuItem['order']) ?>" required>
                </div>
                <div class="col-6">
                    <label for="menu_group">Nhóm Menu:</label>
                    <select id="menu_group" name="menu_group" class="form-control" required>
                        <option value="">Chọn nhóm menu</option> <!-- Option mặc định -->
                        <option value="1" <?= (isset($menuItem['group']) && $menuItem['group'] == '1') ? 'selected' : '' ?>>Menu ngang</option>
                        <option value="2" <?= (isset($menuItem['group']) && $menuItem['group'] == '2') ? 'selected' : '' ?>>Menu dọc</option>
                        <option value="3" <?= (isset($menuItem['group']) && $menuItem['group'] == '3') ? 'selected' : '' ?>>Menu footer</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Các Menu Con -->
        <?php if (!empty($menucon)): ?>
            <?php foreach ($menucon as $index => $menucon1): ?>
                <div class="form-group" id="menu-<?= $index + 1 ?>"> <!-- Thêm id để dễ dàng thao tác -->
                    <div class="d-flex align-items-center">
                        <input type="hidden" name="child_ids[]" value="<?= esc($menucon1['id']) ?>">
                        <div class="col-6">
                            <label for="child_title_<?= $index + 1 ?>">Tiêu Đề (Menu Con <?= $index + 1 ?>):</label>
                            <input type="text" id="child_title_<?= $index + 1 ?>" name="child_titles[]" value="<?= esc($menucon1['title']) ?>" required>
                        </div>
                        <div class="col-4">
                            <label for="child_url_<?= $index + 1 ?>">URL (Menu Con <?= $index + 1 ?>):</label>
                            <input type="text" id="child_url_<?= $index + 1 ?>" name="child_urls[]" value="<?= esc($menucon1['url']) ?>" required>
                        </div>
                        <div class="col-2 text-center">
                            <!-- Nút xóa với sự kiện onclick gọi ajax -->
                            <button type="button" class="btn btn-danger btn-sm delete-menu" data-id="<?= $menucon1['id'] ?>">Xóa</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="form-group">
            <button type="submit" class="submit-btn">Cập Nhật</button>
        </div>
    </form>
    <!-- End Form -->

    <script>
        $(document).ready(function() {
            // Xử lý sự kiện click vào nút xóa
            $('.delete-menu').click(function() {
                var menuId = $(this).data('id'); // Lấy ID của menu từ thuộc tính data-id

                // Xác nhận với người dùng trước khi xóa
                if (confirm("Bạn có chắc chắn muốn xóa menu này?")) {
                    // Gửi yêu cầu AJAX để xóa menu
                    $.ajax({
                        url: '/admin/menuthanhdoan/deleteMenu', // Thay đổi với URL xử lý xóa
                        type: 'POST',
                        data: {
                            id: menuId,
                            <?= csrf_token() ?>: "<?= csrf_hash() ?>" // Bảo mật CSRF
                        },
                        success: function(response) {
                            if (response.success) {
                                // Nếu xóa thành công, tải lại trang
                                location.reload(); // Tải lại trang
                                alert("Menu đã được xóa thành công.");
                            } else {
                                // Nếu có lỗi trong quá trình xóa
                                alert("Có lỗi xảy ra. Vui lòng thử lại.");
                            }
                        },
                        error: function() {
                            alert("Lỗi kết nối. Vui lòng thử lại.");
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
