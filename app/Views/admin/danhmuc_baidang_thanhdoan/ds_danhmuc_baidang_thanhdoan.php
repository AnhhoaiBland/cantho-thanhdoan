<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Danh Mục Bài Đăng Thành Đoàn</title>

    <!-- Bao gồm Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bao gồm Font Awesome cho các icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMLMO/IFjHg0DQhlS/8Rkv3LZXH+4ImiKkj/1nF" crossorigin="anonymous">

    <style>
        /* Định dạng chung */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-primary-custom {
            display: inline-block;
            padding: 10px 20px;
            margin-bottom: 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }

        /* Định dạng danh sách dạng cây */
        ul {
            list-style-type: none;
            padding-left: 20px;
        }

        li {
            margin: 5px 0;
        }

        .toggle-button {
            cursor: pointer;
            user-select: none;
            display: flex;
            align-items: center;
        }

        .toggle-button i {
            margin-right: 5px;
        }

        .node-details {
            margin-left: 25px;
            color: #555;
        }

        .hidden {
            display: none;
        }

        /* Định dạng trạng thái */
        .status {
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 3px;
            margin-left: 10px;
        }

        .enabled {
            color: #2e7d32;
            background-color: #e8f5e9;
        }

        .disabled {
            color: #c62828;
            background-color: #ffebee;
        }

        /* Định dạng nút hành động */
        .action-buttons {
            margin-left: 10px;
        }

        .action-buttons a {
            margin-right: 5px;
            text-decoration: none;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 12px;
        }

        .action-buttons a.edit {
            background-color: #007bff;
            color: white;
        }

        .action-buttons a.delete {
            background-color: #dc3545;
            color: white;
        }

        .action-buttons a.edit:hover {
            background-color: #0056b3;
        }

        .action-buttons a.delete:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>Danh Sách Danh Mục Bài Đăng Thành Đoàn</h2>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <a class="btn btn-primary btn-primary-nut" href="/admin/dmbaidang_thanhdoan/create">
                <i class="fas fa-plus"></i> Thêm Danh Mục Mới
            </a>
        </div>
        <!-- Bọc form tìm kiếm trong một card có border -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Tìm kiếm danh mục
            </div>
            <div class="card-body">
                <form action="/admin/dmbaidang_thanhdoan/search" method="get" class="row g-3">
                    <div class="col-md-4">
                        <label for="search" class="form-label">Tìm theo tên danh mục :</label>
                        <input type="text" name="search" id="search" class="form-control" placeholder="có thể nhập nhiều từ khóa, phân cách bởi dấu phẩy" value="<?= htmlspecialchars($searchTerm ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="date_from" class="form-label">Từ ngày:</label>
                        <input type="date" id="date_from" name="date_from" class="form-control"
                            value="<?= htmlspecialchars($dateFrom ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="date_to" class="form-label">Đến ngày:</label>
                        <input type="date" id="date_to" name="date_to" class="form-control"
                            value="<?= htmlspecialchars($dateTo ?? '') ?>">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-3">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <?php
        /**
         * Hiển thị cây danh mục từ cấu trúc cây đã được xây dựng bởi Controller
         *
         * @param array $tree Cấu trúc cây danh mục
         */
        function renderTree($tree)
        {
            if (empty($tree)) {
                echo '<p>Không có danh mục nào phù hợp với tiêu chí tìm kiếm.</p>';
                return;
            }

            echo '<ul class="list-group">';
            foreach ($tree as $node) {
                echo '<li class="list-group-item">';
                echo '<div class="d-flex justify-content-between align-items-center">';
                echo '<div class="toggle-button">';
                if (isset($node['children']) && !empty($node['children'])) {
                    echo '<i class="fas fa-folder me-2"></i>';
                } else {
                    echo '<i class="fas fa-file me-2"></i>';
                }
                echo '<span>' . htmlspecialchars($node['title']) . '</span>';
                echo '<span class="badge ' . ($node['enabled'] ? 'bg-success' : 'bg-danger') . ' ms-2">';
                echo $node['enabled'] ? 'Kích hoạt' : 'Vô hiệu hóa';
                echo '</span>';
                echo '</div>';
                echo '<div class="action-buttons">';
                echo '<a href="/admin/dmbaidang_thanhdoan/edit/' . $node['cat_id'] . '" class="btn btn-sm btn-primary me-2" title="Chỉnh Sửa">';
                echo '<i class="fas fa-edit"></i>';
                echo '</a>';
                echo '<a href="/admin/dmbaidang_thanhdoan/delete/' . $node['cat_id'] . '" class="btn btn-sm btn-danger" title="Xóa" onclick="return confirm(\'Bạn có chắc chắn muốn xóa danh mục này không?\')">';
                echo '<i class="fas fa-trash-alt"></i>';
                echo '</a>';
                echo '</div>';
                echo '</div>';

                // Hiển thị thông tin chi tiết
                echo '<div class="mt-2">';
                echo 'ID: ' . $node['cat_id'] . ' | ';
                echo 'Alias: ' . htmlspecialchars($node['alias']) . ' | ';
                echo 'Ngày Thêm: ' . date('d-m-Y', $node['date_add']) . ' | ';
                echo 'Ngày Sửa: ' . date('d-m-Y', $node['date_modify']) . ' | ';
                echo 'Số Lượt Xem: ' . $node['num_view'];
                echo '</div>';

                if (isset($node['children']) && !empty($node['children'])) {
                    // Mặc định ẩn các danh mục con
                    echo '<div class="children ms-4 mt-2">';
                    renderTree($node['children']);
                    echo '</div>';
                }
            }
            echo '</ul>';
        }

        // Gọi hàm renderTree với cây danh mục từ Controller
        renderTree($ds_danh_muc);
        ?>

        <!-- JavaScript xử lý thu gọn/mở rộng danh mục -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const toggleButtons = document.querySelectorAll(".toggle-button");

                toggleButtons.forEach(button => {
                    button.addEventListener("click", function(event) {
                        // Nếu nhấp vào nút Chỉnh Sửa hoặc Xóa, không xử lý toggle
                        if (event.target.closest('.action-buttons')) {
                            return;
                        }

                        const parentLi = button.closest('li');
                        const childDiv = parentLi.querySelector(":scope > .children");
                        const icon = button.querySelector("i");

                        if (childDiv) {
                            if (childDiv.classList.contains("hidden")) {
                                childDiv.classList.remove("hidden");
                                icon.classList.remove("fa-folder");
                                icon.classList.add("fa-folder-open");
                            } else {
                                childDiv.classList.add("hidden");
                                icon.classList.remove("fa-folder-open");
                                icon.classList.add("fa-folder");
                            }
                        }
                    });
                });
            });
        </script>

    </div>

    <!-- Bao gồm Bootstrap 5 JS và các phụ thuộc -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>