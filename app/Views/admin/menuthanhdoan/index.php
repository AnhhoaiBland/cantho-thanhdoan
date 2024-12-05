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

        /* Reset một số style mặc định */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #navbar {
            background-color: #343a40;
            padding: 10px 0;
            position: relative;
        }

        /* Style cho menu ngang (group = 1) */
        .menu {
            list-style: none;
            display: flex;
            justify-content: center;
            padding: 0;
            position: relative;
        }

        .menu li {
            margin: 0 20px;
            position: relative;
            /* Để chứa edit-button */
        }

        .menu a.nav-link {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 15px;
            display: block;
            border-radius: 5px;
            transition: background-color 0.3s ease, padding 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .menu a.nav-link:hover {
            background-color: #007bff;
            padding-left: 20px;
            /* Thêm hiệu ứng padding khi hover */
        }

        /* Nút chỉnh sửa */
        .edit-button {
            display: none;
            position: absolute;
            background-color: #ffc107;
            color: #333;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            transition: opacity 0.3s ease;
            white-space: nowrap;
            z-index: 2;
        }

        /* Hiển thị nút chỉnh sửa khi hover */
        .menu li:hover .edit-button,
        ul.vertical-menu li:hover .edit-button,
        .footer-menu li:hover .edit-button {
            display: inline-block;
        }

        /* Vị trí cho nút chỉnh sửa trong menu ngang */
        .menu li .edit-button {
            top: 50%;
            right: -60px;
            transform: translateY(-50%);
        }

        /* Vị trí cho nút chỉnh sửa trong menu dọc */
        ul.vertical-menu .edit-button {
            right: 10px;
            /* Điều chỉnh giá trị này theo ý muốn */
            top: 50%;
            transform: translateY(-50%);
        }

        /* Vị trí cho nút chỉnh sửa trong menu footer */
        .footer-menu .edit-button {
            position: absolute;
            right: -60px;
            /* Điều chỉnh giá trị này theo ý muốn */
            top: 50%;
            transform: translateY(-50%);
        }

        /* Hiệu ứng submenu */
        .submenu {
            list-style: none;
            padding: 0;
            display: none;
            background-color: #495057;
            top: 100%;
            left: 0;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .menu li:hover .submenu,
        ul.vertical-menu li:hover ul.submenu {
            display: block;
            animation: slideIn 0.3s ease-in-out;
            /* Hiệu ứng di chuyển */
        }

        .submenu-item a {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            text-decoration: none;
            display: block;
        }

        .submenu-item a:hover {
            background-color: #007bff;
        }

        /* Hiệu ứng di chuyển submenu */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Style cho menu dọc */
        ul.vertical-menu {
            list-style: none;
            padding: 0;
            max-height: 500px;
            overflow-y: auto;
            background-color: #f4f6f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
        }

        ul.vertical-menu li {
            margin-bottom: 15px;
            position: relative;
            /* Đảm bảo vị trí tương đối cho edit-button */
        }

        ul.vertical-menu a.menu-link {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 15px;
            display: block;
            background-color: #343a40;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        ul.vertical-menu a.menu-link:hover {
            background-color: #007bff;
        }

        /* Style cho submenu của menu dọc */
        ul.vertical-menu ul.submenu {
            list-style: none;
            padding-left: 20px;
            display: none;
            background-color: #495057;
            border-radius: 5px;
            margin-top: 5px;
        }

        ul.vertical-menu ul.submenu li a.submenu-item {
            font-size: 16px;
            background-color: #495057;
            color: #fff;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        ul.vertical-menu ul.submenu li a.submenu-item:hover {
            background-color: #007bff;
        }

        /* Style cho menu footer */
        .footer-menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            position: relative;
            /* Đảm bảo vị trí tương đối cho edit-button */
        }

        .footer-menu li {
            margin-right: 20px;
            position: relative;
            /* Đảm bảo vị trí tương đối cho edit-button */
        }

        .footer-menu li:last-child {
            margin-right: 0;
        }

        .footer-menu a.menu-link {
            color: #343a40;
            text-decoration: none;
            font-size: 16px;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            display: block;
        }

        .footer-menu a.menu-link:hover {
            background-color: #007bff;
            color: #fff;
        }

        /* Tạo thanh cuộn nếu menu dọc quá dài */
        ul.vertical-menu {
            max-height: 500px;
            overflow-y: auto;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>Quản lý menu</h2>
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-4 float-right">
                <a class="btn btn-danger btn-primary-nut" href="">
                    Thùng rác
                </a>
            </div>
            <div class="d-flex justify-content-between align-items-center mr-4 float-right">
                <a class="btn btn-primary btn-primary-nut" href="/admin/menuthanhdoan/createMenu">
                    Thêm Menu
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <!-- Hiển thị menu ngang (group = 1) -->
                    <h4>Danh sách Menu Ngang</h4>
                    <nav class="navbar" id="navbar">
                        <ul class="menu">
                            <?php if (isset($structuredMenus[1])): ?>
                                <?php foreach ($structuredMenus[1] as $parentId => $parentMenus): ?>
                                    <!-- Kiểm tra nếu menu có parent -->
                                    <?php if ($parentId == 0): ?>
                                        <?php foreach ($parentMenus as $menu): ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?= base_url($menu['title']); ?>">
                                                    <?= $menu['title']; ?>
                                                </a>
                                                <!-- Nút chỉnh sửa -->
                                                <a class="edit-button" href="<?= base_url('admin/menuthanhdoan/editMenu/' . $menu['id']); ?>">
                                                    <i class="fas fa-edit"></i> Chỉnh sửa
                                                </a>

                                                <!-- Kiểm tra và hiển thị các menu con -->
                                                <?php if (isset($structuredMenus[1][$menu['id']])): ?>
                                                    <ul class="submenu">
                                                        <?php foreach ($structuredMenus[1][$menu['id']] as $subMenu): ?>
                                                            <li class="submenu-item">
                                                                <a class="nav-link" href="<?= base_url($subMenu['title']); ?>">
                                                                    <?= $subMenu['title']; ?>
                                                                </a>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>

                <div class="col-md-12 mt-5">
                    <h4>Danh sách Menu Dọc</h4>
                    <ul class="vertical-menu">
                        <?php if (isset($structuredMenus[2])): ?>
                            <?php foreach ($structuredMenus[2] as $parentId => $parentMenus): ?>
                                <?php if ($parentId == 0): ?>
                                    <?php foreach ($parentMenus as $menu): ?>
                                        <li class="menu-item">
                                            <a href="#" class="menu-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <?= $menu['title']; ?>
                                            </a>
                                            <!-- Nút chỉnh sửa -->
                                            <a class="edit-button" href="<?= base_url('admin/menuthanhdoan/editMenu/' . $menu['id']); ?>">
                                                <i class="fas fa-edit"></i> Chỉnh sửa
                                            </a>
                                            <?php if (isset($structuredMenus[2][$menu['id']])): ?>
                                                <ul class="submenu">
                                                    <?php foreach ($structuredMenus[2][$menu['id']] as $subMenu): ?>
                                                        <li><a class="submenu-item" href="<?= base_url($subMenu['title']); ?>">
                                                                <?= $subMenu['title']; ?>
                                                            </a></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>

                </div>

                <div class="col-md-12 mt-5">
                    <!-- Hiển thị menu footer (group = 3) -->
                    <h4>Danh sách Menu Footer</h4>
                    <ul class="footer-menu">
                        <?php if (isset($structuredMenus[3])): ?>
                            <?php foreach ($structuredMenus[3] as $parentId => $parentMenus): ?>
                                <?php if ($parentId == 0): ?>
                                    <?php foreach ($parentMenus as $menu): ?>
                                        <li>
                                            <a href="<?= base_url($menu['title']); ?>" class="menu-link">
                                                <?= $menu['title']; ?>
                                            </a>
                                            <!-- Nút chỉnh sửa -->
                                            <a class="edit-button" href="<?= base_url('admin/menuthanhdoan/editMenu/' . $menu['id']); ?>">
                                                <i class="fas fa-edit"></i> Chỉnh sửa
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>

                </div>

            </div>
        </div>

        <!-- <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center mb-4 float-right">
                <a class="btn btn-danger btn-primary-nut" href="">
                    </i>Thùng rác
                </a>
            </div>
        </div> -->

    </div>

    <!-- Bao gồm Bootstrap 5 JS và các phụ thuộc -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>