<!DOCTYPE html>
<html>

<head>
    <!-- Sử dụng Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Danh Sách Bài Đăng Thành Đoàn</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: bold;
        }

        .btn-primary-nut {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #0069d9;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-primary-nut:hover {
            background-color: #0053ba;
        }

        .table thead th {
            background-color: #343a40;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            white-space: nowrap;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
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
            font-size: 13px;
            white-space: nowrap;
        }

        .enabled {
            color: #28a745;
            background-color: #e2f5e9;
        }

        .disabled {
            color: #dc3545;
            background-color: #f8d7da;
        }

        .action-buttons .btn {
            margin-right: 5px;
            white-space: nowrap;
        }

        .category-group h3 {
            background-color: #17a2b8;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .form-label {
            font-weight: bold;
        }

        .pagination .page-item .page-link {
            color: #007bff;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }

        /* Thêm CSS để cố định độ rộng cột */
        .table th,
        .table td {
            vertical-align: middle;
            /* Loại bỏ white-space: nowrap; để cho phép xuống hàng */
        }

        .table td {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .col-id {
            width: 50px;
            white-space: nowrap;
        }

        .col-actions {
            width: 150px;
            white-space: nowrap;
        }

        .col-title {
            max-width: 250px;
            /* Thiết lập chiều rộng tối đa cho cột tiêu đề */
            word-wrap: break-word;
            /* Cho phép xuống hàng khi nội dung quá dài */
        }

        /* Tùy chỉnh liên kết trong cột tiêu đề */
        .col-title a {
            color: inherit;
            /* Sử dụng màu chữ của phần tử cha */
            text-decoration: none;
            /* Loại bỏ gạch chân dưới liên kết */
            font-weight: bold;
            /* Tùy chọn: làm đậm tiêu đề để nổi bật */
        }

        .col-title a:hover {
            text-decoration: underline;
            /* Tùy chọn: thêm gạch chân khi di chuột */
            color: #007bff;
            /* Tùy chọn: đổi màu chữ khi di chuột */
        }

        .col-date,
        .col-views {
            width: 100px;
            white-space: nowrap;
        }

        .col-status {
            width: 120px;
            white-space: nowrap;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .action-buttons .btn {
            white-space: nowrap;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>Danh Sách Bài Đăng Thành Đoàn</h2>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <a class="btn btn-primary btn-primary-nut" href="/admin/baidangthanhdoan/create">
                <i class="fas fa-plus"></i> Thêm Bài Đăng Mới
            </a>
        </div>

        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php elseif (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Search form -->
        <div class="card mb-4">
        <div class="card-header bg-primary text-white">
                Tìm kiếm bài đăng
            </div>
            <div class="card-body">
                <form action="" method="get" class="row g-3">
                    <div class="col-md-3">
                        <label for="search" class="form-label">Tìm kiếm theo tiêu đề:</label>
                        <input type="text" name="search" id="search" class="form-control"
                            placeholder="Nhập tiêu đề..." value="<?= htmlspecialchars($search) ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="category_id" class="form-label">Danh mục:</label>
                        <select name="category_id" id="category_id" class="form-select">
                            <option value="">-- Chọn danh mục --</option>
                            <?php foreach ($ds_danh_muc as $danh_muc): ?>
                                <option value="<?= $danh_muc['cat_id'] ?>" <?= ($category_id == $danh_muc['cat_id']) ? 'selected' : '' ?>>
                                    <?= str_repeat('--', $danh_muc['depth']) . ' ' . htmlspecialchars($danh_muc['title']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                    <div class="col-md-2">
                        <label for="start_date" class="form-label">Từ ngày:</label>
                        <input type="date" name="start_date" id="start_date" class="form-control"
                            value="<?= htmlspecialchars($start_date ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="end_date" class="form-label">Đến ngày:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control"
                            value="<?= htmlspecialchars($end_date ?? '') ?>">
                    </div>
                    <div class="col-md-2 align-self-end">
                        <button class="btn btn-primary w-100" type="submit">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <?php if ($search || $start_date || $end_date || $category_id): ?>
            <p>Kết quả tìm kiếm
                <?php if ($search): ?>
                    cho từ khóa "<strong><?= htmlspecialchars($search) ?></strong>"
                <?php endif; ?>
                <?php if ($category_id): ?>
                    trong danh mục "<strong><?= htmlspecialchars($selected_category_title) ?></strong>"
                <?php endif; ?>
                <?php if ($start_date && $end_date): ?>
                    từ ngày <strong><?= date('d-m-Y', strtotime($start_date)) ?></strong> đến ngày
                    <strong><?= date('d-m-Y', strtotime($end_date)) ?></strong>
                <?php elseif ($start_date): ?>
                    từ ngày <strong><?= date('d-m-Y', strtotime($start_date)) ?></strong>
                <?php elseif ($end_date): ?>
                    đến ngày <strong><?= date('d-m-Y', strtotime($end_date)) ?></strong>
                <?php endif; ?>
            </p>
        <?php endif; ?>

        <?php foreach ($groupedPosts as $category => $posts): ?>
            <div class="category-group">
                <h3>
                    <?= htmlspecialchars($category) ?>
                </h3>

                <!-- Thêm lớp table-responsive -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="col-id">ID</th>
                                <th class="col-title">Tiêu Đề</th>
                                <th class="col-date">Ngày Thêm</th>
                                <th>Ảnh</th>
                                <th class="col-views">Lượt Xem</th>
                                <th class="col-status">Trạng Thái</th>
                                <th class="col-actions">Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($posts as $post): ?>
                                <tr>
                                    <td><?= $post['news_id'] ?></td>
                                    <td class="col-title">
                                        <a href="/admin/baidangthanhdoan/edit/<?= $post['news_id'] ?>">
                                            <?= htmlspecialchars($post['title']) ?>
                                        </a>
                                    </td>
                                    <td><?= date('d-m-Y', $post['date_add']) ?></td>
                                    <td>
                                        <a href="<?= htmlspecialchars($post['img_file']) ?>" class="img-link" target="_blank">
                                            <i class="fas fa-image"></i> Xem ảnh
                                        </a>
                                    </td>
                                    <td><?= htmlspecialchars($post['num_view']) ?></td>
                                    <td>
                                        <span class="status <?= $post['enabled'] ? 'enabled' : 'disabled' ?>">
                                            <?= $post['enabled'] ? 'Kích hoạt' : 'Vô hiệu hóa' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete('/admin/baidangthanhdoan/delete/<?= $post['news_id'] ?>', event)">
                                                <i class="fas fa-trash-alt"></i> Xóa
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div> <!-- Kết thúc table-responsive -->
            </div>
        <?php endforeach; ?>

        <!-- Pagination controls -->
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <?php
                $query_string = http_build_query([
                    'search' => $search,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'category_id' => $category_id
                ]);
                ?>

                <?php if ($currentPage > 1): ?>
                    <li class="page-item">
                        <a class="page-link"
                            href="<?= base_url('/admin/baidangthanhdoan/' . ($currentPage - 1) . '?' . $query_string) ?>">
                            <i class="fas fa-chevron-left"></i> Trước
                        </a>
                    </li>
                <?php endif; ?>

                <?php
                $visiblePages = 5;
                $startPage = max(1, $currentPage - floor($visiblePages / 2));
                $endPage = min($totalPages, $startPage + $visiblePages - 1);

                if ($endPage - $startPage < $visiblePages - 1) {
                    $startPage = max(1, $endPage - $visiblePages + 1);
                }

                if ($startPage > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= base_url('/admin/baidangthanhdoan/1?' . $query_string) ?>">1</a>
                    </li>
                    <?php if ($startPage > 2): ?>
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                    <li class="page-item <?= ($i === $currentPage) ? 'active' : '' ?>">
                        <a class="page-link"
                            href="<?= base_url('/admin/baidangthanhdoan/' . $i . '?' . $query_string) ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($endPage < $totalPages): ?>
                    <?php if ($endPage < $totalPages - 1): ?>
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    <?php endif; ?>
                    <li class="page-item">
                        <a class="page-link"
                            href="<?= base_url('/admin/baidangthanhdoan/' . $totalPages . '?' . $query_string) ?>"><?= $totalPages ?></a>
                    </li>
                <?php endif; ?>

                <?php if ($currentPage < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link"
                            href="<?= base_url('/admin/baidangthanhdoan/' . ($currentPage + 1) . '?' . $query_string) ?>">
                            Tiếp <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

    </div>

    <!-- Thêm các liên kết đến các file JavaScript cần thiết -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDelete(url, event) {
            event.preventDefault();
            if (confirm('Bạn có chắc chắn muốn xóa bài đăng này không?')) {
                window.location.href = url;
            }
        }
    </script>

</body>

</html>