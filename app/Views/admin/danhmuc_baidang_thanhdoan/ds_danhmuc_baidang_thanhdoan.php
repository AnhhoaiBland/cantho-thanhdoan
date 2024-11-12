<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Danh Mục Bài Đăng Thành Đoàn</title>
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

        .btn-primary {
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
    <!-- Thư viện Font Awesome cho các icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMLMO/IFjHg0DQhlS/8Rkv3LZXH+4ImiKkj/1nF" crossorigin="anonymous">
</head>

<body>

    <h2>Danh Sách Danh Mục Bài Đăng Thành Đoàn</h2>

    <a class="btn-primary" href="/admin/dmbaidang_thanhdoan/create">Thêm Danh Mục Mới</a>

    <?php
    /**
     * Hiển thị cây danh mục từ cấu trúc cây đã được xây dựng bởi Controller
     *
     * @param array $tree Cấu trúc cây danh mục
     */
    function renderTree($tree)
    {
        echo '<ul>';
        foreach ($tree as $node) {
            echo '<li>';
            echo '<div class="toggle-button">';
            if (isset($node['children']) && !empty($node['children'])) {
                echo '<i class="fas fa-folder"></i>';
            } else {
                echo '<i class="fas fa-file"></i>';
            }
            echo '<span>' . htmlspecialchars($node['title']) . '</span>';
            // Hiển thị trạng thái
            echo '<span class="status ' . ($node['enabled'] ? 'enabled' : 'disabled') . '">';
            echo $node['enabled'] ? 'Kích hoạt' : 'Vô hiệu hóa';
            echo '</span>';

            // Thêm nút hành động
            echo '<span class="action-buttons">';
            echo '<a href="/admin/dmbaidang_thanhdoan/edit/' . $node['cat_id'] . '" class="edit" title="Chỉnh Sửa">';
            echo '<i class="fas fa-edit"></i> Chỉnh Sửa';
            echo '</a>';
            echo '<a href="/admin/dmbaidang_thanhdoan/delete/' . $node['cat_id'] . '" class="delete" title="Xóa" onclick="return confirm(\'Bạn có chắc chắn muốn xóa danh mục này không?\')">';
            echo '<i class="fas fa-trash-alt"></i> Xóa';
            echo '</a>';
            echo '</span>';

            echo '</div>';
            // Hiển thị thông tin chi tiết
            echo '<div class="node-details">';
            echo 'ID: ' . $node['cat_id'] . ' | ';
            echo 'Alias: ' . htmlspecialchars($node['alias']) . ' | ';
            echo 'Ngày Thêm: ' . date('d-m-Y', $node['date_add']) . ' | ';
            echo 'Ngày Sửa: ' . date('d-m-Y', $node['date_modify']) . ' | ';
            echo 'Số Lượt Xem: ' . $node['num_view'];
            echo '</div>';
            if (isset($node['children']) && !empty($node['children'])) {
                // Mặc định ẩn các danh mục con
                echo '<div class="children hidden">';
                renderTree($node['children']);
                echo '</div>';
            }
            echo '</li>';
        }
        echo '</ul>';
    }

    // Gọi hàm renderTree với cây danh mục từ Controller
    renderTree($ds_danh_muc);
    ?>

    <!-- JavaScript xử lý thu gọn/mở rộng danh mục -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggleButtons = document.querySelectorAll(".toggle-button");

            toggleButtons.forEach(button => {
                button.addEventListener("click", function (event) {
                    // Nếu nhấp vào nút Chỉnh Sửa hoặc Xóa, không xử lý toggle
                    if (event.target.closest('.action-buttons')) {
                        return;
                    }

                    const parentLi = button.parentElement;
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

</body>

</html>
