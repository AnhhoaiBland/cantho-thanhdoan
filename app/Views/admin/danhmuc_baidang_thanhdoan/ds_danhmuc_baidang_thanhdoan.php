<!DOCTYPE html>
<html>

<head>
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
    </style>
    <!-- Thư viện Font Awesome cho các icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMLMO/IFjHg0DQhlS/8Rkv3LZXH+4ImiKkj/1nF" crossorigin="anonymous">
</head>

<body>

    <h2>Danh Sách Danh Mục Bài Đăng Thành Đoàn</h2>

    <a class="btn-primary" href="/admin/dmbaidang_thanhdoan/create">Thêm Danh Mục Mới</a>

    <?php
    // Giả sử $ds_danh_muc là mảng chứa danh sách danh mục của bạn
    // Ví dụ:
    /*
    $ds_danh_muc = [
        ['cat_id' => 1, 'parent_id' => 0, 'title' => 'Danh Mục 1', 'alias' => 'danh-muc-1', 'date_add' => strtotime('2023-01-01'), 'date_modify' => strtotime('2023-01-05'), 'num_view' => 100, 'enabled' => true],
        ['cat_id' => 2, 'parent_id' => 1, 'title' => 'Danh Mục 1.1', 'alias' => 'danh-muc-1-1', 'date_add' => strtotime('2023-02-01'), 'date_modify' => strtotime('2023-02-05'), 'num_view' => 50, 'enabled' => true],
        // Thêm các danh mục khác...
    ];
    */

    // Bước 1: Xây dựng cây danh mục
    function buildTree(array $elements, $parentId = 0) {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = buildTree($elements, $element['cat_id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    $tree = buildTree($ds_danh_muc);

    // Bước 2: Hiển thị cây danh mục
    function renderTree($tree) {
        echo '<ul>';
        foreach ($tree as $node) {
            echo '<li>';
            echo '<div class="toggle-button">';
            if (isset($node['children'])) {
                echo '<i class="fas fa-folder"></i>';
            } else {
                echo '<i class="fas fa-file"></i>';
            }
            echo '<span>' . htmlspecialchars($node['title']) . '</span>';
            // Hiển thị trạng thái
            echo '<span class="status ' . ($node['enabled'] ? 'enabled' : 'disabled') . '">';
            echo $node['enabled'] ? 'Kích hoạt' : 'Vô hiệu hóa';
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
            if (isset($node['children'])) {
                // Mặc định ẩn các danh mục con
                echo '<div class="children hidden">';
                renderTree($node['children']);
                echo '</div>';
            }
            echo '</li>';
        }
        echo '</ul>';
    }

    renderTree($tree);
    ?>

    <!-- JavaScript xử lý thu gọn/mở rộng danh mục -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggleButtons = document.querySelectorAll(".toggle-button");

            toggleButtons.forEach(button => {
                button.addEventListener("click", function () {
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
