<!DOCTYPE html>
<html>

<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Danh Sách Bài Đăng Thành Đoàn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fbfd;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .btn-primary {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background-color: #f9fbfd;
        }

        tr:hover {
            background-color: #f1f5fb;
        }

        td {
            font-size: 14px;
            color: #555;
        }

        .img-link {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .img-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .status {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
        }

        .enabled {
            color: #28a745;
            background-color: #e8f5e9;
        }

        .disabled {
            color: #dc3545;
            background-color: #f8d7da;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 13px;
        }
    </style>
</head>

<body>

    <h2>Danh Sách Bài Đăng Thành Đoàn</h2>
    
    <!-- Hiển thị thông báo nếu có -->
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <a class="btn-primary" href="/admin/baidangthanhdoan/create">Thêm Bài Viết Mới</a>


    <table>
        <tr>
            <th>ID</th>
            <th>Tiêu Đề</th>
            <th>Danh Mục</th>
            <th>Ngày Thêm</th>
            <th>Ngày Sửa</th>
            <th>URL Ảnh</th>
            <th>Số Lượt Xem</th>
            <th>Trạng Thái</th>
            <th>Thao Tác</th>
        </tr>

        <?php foreach ($bai_dang as $row): ?>
            <tr>
                <td><?= $row['news_id'] ?></td>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['category_title']) ?></td>
                <td><?= date('d-m-Y', $row['date_add']) ?></td>
                <td><?= date('d-m-Y', $row['date_modify']) ?></td>
                <td><a href="<?= htmlspecialchars($row['img_file']) ?>" class="img-link">Xem ảnh</a></td>
                <td><?= htmlspecialchars($row['num_view']) ?></td>
                <td>
                    <span class="status <?= $row['enabled'] ? 'enabled' : 'disabled' ?>">
                        <?= $row['enabled'] ? 'Kích hoạt' : 'Vô hiệu hóa' ?>
                    </span>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="/admin/baidangthanhdoan/edit/<?= $row['news_id'] ?>" class="btn btn-warning btn-sm">Chỉnh Sửa</a>
                        <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete('/admin/baidangthanhdoan/delete/<?= $row['news_id'] ?>', event)">Xóa</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa bài đăng này?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <a href="#" class="btn btn-danger" id="confirmDeleteBtn">Xóa</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDelete(deleteUrl, event) {
            event.preventDefault(); // Ngăn không cho trang chuyển hướng
            $('#confirmDeleteBtn').attr('href', deleteUrl);
            $('#deleteModal').modal('show');
        }
    </script>

</body>

</html>
