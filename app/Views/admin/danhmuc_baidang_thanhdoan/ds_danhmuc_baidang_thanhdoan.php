<!DOCTYPE html>
<html>

<head>
    <title>Danh Sách Danh Mục Bài Đăng Thành Đoàn</title>
    <style>
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

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9f5e9;
        }

        .nested {
            display: none;
            background-color: #e8f0f2;
        }

        .status {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .enabled {
            color: #2e7d32;
            background-color: #e8f5e9;
        }

        .disabled {
            color: #c62828;
            background-color: #ffebee;
        }

        /* Thêm các thụt lề theo cấp */
        .level-0 {
            background-color: #f9fbfc;
        }

        .level-1 {
            padding-left: 20px;
            background-color: #eef7f9;
            font-weight: bold;
            color: #333;
        }

        .level-2 {
            padding-left: 40px;
            background-color: #e0f0f2;
            color: #555;
        }

        .toggle-button {
            cursor: pointer;
            font-weight: bold;
            color: #333;
        }

        .toggle-button i {
            margin-right: 8px;
            transition: transform 0.2s;
            font-size: 1.2em;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMLMO/IFjHg0DQhlS/8Rkv3LZXH+4ImiKkj/1nF" crossorigin="anonymous">
</head>

<body>

    <h2>Danh Sách Danh Mục Bài Đăng Thành Đoàn</h2>

    <a class="btn-primary" href="/admin/dmbaidang_thanhdoan/create">Thêm Danh Mục Mới</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Danh Mục Cha</th>
            <th>Tiêu Đề</th>
            <th>Alias</th>
            <th>Ngày Thêm</th>
            <th>Ngày Sửa</th>
            <th>Số Lượt Xem</th>
            <th>Trạng Thái</th>
        </tr>

        <?php foreach ($ds_danh_muc as $row): ?>
            <tr class="<?= $row['parent_id'] ? 'nested nested-' . $row['parent_id'] : '' ?> level-<?= $row['level'] ?>" data-parent-id="<?= $row['parent_id'] ?>" data-cat-id="<?= $row['cat_id'] ?>">
                <td><?= $row['cat_id'] ?></td>
                <td><?= $row['parent_id'] ?></td>
                <td>
                    <span class="toggle-button">
                        <?php if ($row['level'] == 0): ?>
                            <i class="fas fa-folder"></i> <!-- Icon thư mục cha -->
                        <?php else: ?>
                            <i class="fas fa-folder"></i> <!-- Icon thư mục con -->
                        <?php endif; ?>
                        <?= htmlspecialchars($row['title']) ?>
                    </span>
                </td>
                <td><?= htmlspecialchars($row['alias']) ?></td>
                <td><?= date('d-m-Y', $row['date_add']) ?></td>
                <td><?= date('d-m-Y', $row['date_modify']) ?></td>
                <td><?= $row['num_view'] ?></td>
                <td>
                    <span class="status <?= $row['enabled'] ? 'enabled' : 'disabled' ?>">
                        <?= $row['enabled'] ? 'Kích hoạt' : 'Vô hiệu hóa' ?>
                    </span>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleButtons = document.querySelectorAll(".toggle-button");

            toggleButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const row = button.closest("tr");
                    const catId = row.getAttribute("data-cat-id");
                    const nestedRows = document.querySelectorAll(`.nested-${catId}`);
                    const icon = button.querySelector("i");

                    nestedRows.forEach(nestedRow => {
                        if (nestedRow.style.display === "table-row") {
                            nestedRow.style.display = "none";
                            icon.classList.remove("fa-folder-open");
                            icon.classList.add("fa-folder");
                        } else {
                            nestedRow.style.display = "table-row";
                            icon.classList.remove("fa-folder");
                            icon.classList.add("fa-folder-open");
                        }
                    });
                });
            });
        });
    </script>

</body>

</html>
