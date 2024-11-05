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

        .toggle-button {
            cursor: pointer;
            color: #333;
            font-weight: bold;
        }

        .nested {
            display: none;
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

        .toggle-button i {
            margin-right: 5px;
            transition: transform 0.2s;
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
            <tr class="<?= $row['parent_id'] ? 'nested nested-' . $row['parent_id'] : '' ?>" data-parent-id="<?= $row['parent_id'] ?>" data-cat-id="<?= $row['cat_id'] ?>">
                <td><?= $row['cat_id'] ?></td>
                <td><?= $row['parent_id'] ?></td>
                <td>
                    <?php if ($row['level'] > 0): ?>
                        <?= str_repeat('&nbsp;&nbsp;', $row['level']) ?>
                    <?php endif; ?>
                    <span class="toggle-button">
                        <i class="fas fa-caret-right"></i> <!-- Icon mũi tên -->
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
            // Thêm sự kiện click cho các nút toggle
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
                            icon.classList.remove("fa-caret-down");
                            icon.classList.add("fa-caret-right");
                        } else {
                            nestedRow.style.display = "table-row";
                            icon.classList.remove("fa-caret-right");
                            icon.classList.add("fa-caret-down");
                        }
                    });
                });
            });
        });
    </script>

</body>

</html>