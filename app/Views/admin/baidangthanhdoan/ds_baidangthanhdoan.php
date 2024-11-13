<?php

// Controller logic (BaiDangThanhDoanController) stays the same, so I'll just focus on the HTML part.

?>

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

    .pagination .page-item .page-link {
        padding: 8px 12px;
        font-size: 14px;
        color: #007bff;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }
    </style>
</head>

<body>

    <h2>Danh Sách Bài Đăng Thành Đoàn</h2>

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

    <?php foreach ($groupedPosts as $category => $posts): ?>
    <div class="category-group">
        <h3><?= htmlspecialchars($category) ?></h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu Đề</th>
                    <th>Ngày Thêm</th>
                    <th>URL Ảnh</th>
                    <th>Số Lượt Xem</th>
                    <th>Trạng Thái</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?= $post['news_id'] ?></td>
                    <td><?= htmlspecialchars($post['title']) ?></td>
                    <td><?= date('d-m-Y', $post['date_add']) ?></td>
                    <td><a href="<?= htmlspecialchars($post['img_file']) ?>" class="img-link">Xem ảnh</a></td>
                    <td><?= htmlspecialchars($post['num_view']) ?></td>
                    <td>
                        <span class="status <?= $post['enabled'] ? 'enabled' : 'disabled' ?>">
                            <?= $post['enabled'] ? 'Kích hoạt' : 'Vô hiệu hóa' ?>
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="/admin/baidangthanhdoan/edit/<?= $post['news_id'] ?>"
                                class="btn btn-warning btn-sm">Chỉnh Sửa</a>
                            <a href="#" class="btn btn-danger btn-sm"
                                onclick="confirmDelete('/admin/baidangthanhdoan/delete/<?= $post['news_id'] ?>', event)">Xóa</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endforeach; ?>

    <!-- Pagination controls -->
    <!-- Pagination controls -->
    <nav aria-label="Page navigation" class="mt-3">
        <ul class="pagination justify-content-center">
            <?php if ($currentPage > 1): ?>
            <li class="page-item">
                <a class="page-link"
                    href="<?= base_url('/admin/baidangthanhdoan/' . ($currentPage - 1)) ?>">Previous</a>
            </li>
            <?php endif; ?>

            <?php
            // Set the range for visible pages
            $visiblePages = 5;
            $startPage = max(1, $currentPage - floor($visiblePages / 2));
            $endPage = min($totalPages, $startPage + $visiblePages - 1);

            // Adjust startPage if we're near the last pages
            if ($endPage - $startPage < $visiblePages - 1) {
                $startPage = max(1, $endPage - $visiblePages + 1);
            }

            // Display ellipsis if there are pages before the start page
            if ($startPage > 1): ?>
            <li class="page-item">
                <a class="page-link" href="<?= base_url('/admin/baidangthanhdoan/1') ?>">1</a>
            </li>
            <?php if ($startPage > 2): ?>
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>
            <?php endif; ?>
            <?php endif; ?>

            <!-- Display the visible range of page links -->
            <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
            <li class="page-item <?= ($i === $currentPage) ? 'active' : '' ?>">
                <a class="page-link" href="<?= base_url('/admin/baidangthanhdoan/' . $i) ?>"><?= $i ?></a>
            </li>
            <?php endfor; ?>

            <!-- Display ellipsis if there are pages after the end page -->
            <?php if ($endPage < $totalPages): ?>
            <?php if ($endPage < $totalPages - 1): ?>
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>
            <?php endif; ?>
            <li class="page-item">
                <a class="page-link"
                    href="<?= base_url('/admin/baidangthanhdoan/' . $totalPages) ?>"><?= $totalPages ?></a>
            </li>
            <?php endif; ?>

            <?php if ($currentPage < $totalPages): ?>
            <li class="page-item">
                <a class="page-link" href="<?= base_url('/admin/baidangthanhdoan/' . ($currentPage + 1)) ?>">Next</a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>


    <script>
    const categoriesPerPage = 10;
    let currentPage = 1;
    const categoryGroups = Array.from(document.querySelectorAll('.category-group'));

    // Function to display the correct category groups based on page
    function displayPage(page) {
        const start = (page - 1) * categoriesPerPage;
        const end = start + categoriesPerPage;

        categoryGroups.forEach((group, index) => {
            group.style.display = index >= start && index < end ? 'block' : 'none';
        });
    }

    // Function to create pagination controls
    function createPagination() {
        const totalPages = Math.ceil(categoryGroups.length / categoriesPerPage);
        const paginationNumbers = document.getElementById('pagination-numbers');
        paginationNumbers.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            paginationNumbers.innerHTML += `<li class="page-item${i === currentPage ? ' active' : ''}">
                <a class="page-link" href="#" onclick="changePage(${i}, event)">${i}</a>
            </li>`;
        }
    }

    // Change page function
    function changePage(page, event) {
        if (event) event.preventDefault();

        const totalPages = Math.ceil(categoryGroups.length / categoriesPerPage);

        if (page === 'prev' && currentPage > 1) {
            currentPage--;
        } else if (page === 'next' && currentPage < totalPages) {
            currentPage++;
        } else if (typeof page === 'number') {
            currentPage = page;
        }

        displayPage(currentPage);
        createPagination();
    }

    // Initial setup
    displayPage(currentPage);
    createPagination();
    </script>

</body>

</html>