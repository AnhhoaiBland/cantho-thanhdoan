
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    /* Đặt màu nền của thanh menu là trắng */
    .mainmenu {
        background-color: #fff;
        /* Màu nền trắng của thanh menu */
        position: relative;
        /* Đặt position relative cho thanh menu lớn */
        padding: 5px;
    }

    /* Đặt màu chữ trong menu là đen */
    .nav-link {
        color: #000;
        /* Màu chữ đen */

        font-weight: 500;
    }

    /* Đặt màu nền của menu con và màu chữ */
    .nav-item .dropdown-menu {
        background-color: #fff;
        /* Màu nền trắng của menu con */
        color: #000;
        /* Màu chữ đen trong menu con */
        display: none;
        /* Ẩn menu con mặc định */
        position: absolute;
        /* Đặt vị trí tuyệt đối để menu con xuất hiện dưới menu lớn */
        top: 100%;
        /* Đặt menu con ngay dưới menu lớn */
        left: 0;
        /* Canh lề trái */
        min-width: 200px;
        /* Đặt chiều rộng tối thiểu để tránh bị cắt chữ */
        z-index: 1000;
        /* Đặt chỉ số z để đảm bảo menu con hiển thị trên các phần tử khác */
        padding: 0.5rem;
        /* Thêm khoảng cách bên trong menu con */
        border-radius: 0.25rem;
        /* Làm tròn các góc menu con */
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);
        /* Thêm bóng cho menu con */
    }

    /* Đặt màu chữ và nền của mục menu con khi hover */
    .nav-item .dropdown-item {
        color: #000;
        /* Màu chữ đen trong mục menu con */

    }

    .nav-item .dropdown-item:hover {
        background-color: #cce5ff;
        /* Màu nền khi hover xanh dương nhạt */

    }

    /* Hiển thị menu con khi di chuột qua bất kỳ mục menu lớn nào */
    .nav-item:hover .dropdown-menu {
        display: block;
        /* Hiển thị menu con khi hover */
    }

    .nav-link:hover,
    .nav-item:hover>.nav-link {
        padding-right: 15px;
        background-color: #cce5ff;

    }

    .dropdown-menu {
        background-color: #ffffff;
        color: #000;
        border-radius: 0;
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);
    }

    .dropdown-item:hover {
        padding: 1rem ;
        background-color: #cce5ff;
        color: #000;
    }

    .dropdown button {
        height: 100%;
        padding: 0.5rem 1rem;
        margin-top: 8px;
    }

    .nav-link,
    .dropdown-toggle {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
    }

    .dropdown-item {
        padding: 0.5rem 1rem;
    }


    .slide-container {
        width: 100%;
        overflow: hidden;
    }

    .nav-link i {
        margin-bottom: 20px;
        margin-right: 8px;
    }

    .slide {
        width: 100%;
        height: auto;
        display: flex;
    }

    .slide img {
        width: 100%;
        height: auto;
    }

    .partners {
        background-color: #f8f9fa;

    }

    .partners .container {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }

    .partner-item {
        margin: 10px;
        width: 150px;
    }

    .partner-item img {
        width: 100%;
        height: auto;
    }
    </style>
</head>

<body>
    <header class="container-fluid nav_top" style="color: #11286e">
        <div class="container-fluid d-flex align-items-center justify-content-end p-3 position-relative"
            style="height: 40px">
            <marquee style="
                font-size: 15px;    
                width: 100%;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
           " class="element-to-hide-960 text-white position-absolute">TRANG THÔNG TIN ĐIỆN TỬ TRUNG TÂM CÔNG NGHỆ THÔNG
                TIN VÀ TRUYỀN THÔNG THÀNH PHỐ CẦN THƠ </marquee>
            <ul class="d-flex list-unstyled align-items-center mt-3 me-3 position-relative">
        </div>
        </ul>
    </header>


    <!-- Slide Section -->
    <div class="slide-container">
        <?= $this->renderSection('templates/slide') ?>
    </div>



    <div style="background-color: #fff">
        <!-- Menu -->
        <div class="menubar container">
            <div class="menu_shadow">
                <div class="wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="responsive-menu"></div>
                            <div class="mainmenu" style="text-align: center;">
                                <div class="pull-left" id="logo_in_menu"></div>
                                <ul id="primary-menu" class="list-unstyled d-flex justify-content-center mb-0">
                                    <!-- Menu Items -->
                                    <li>
                                        <a class="text-white fw-bold" href="<?= base_url() ?>">
                                            <img style="width: 30px;"
                                                src="<?= base_url('public/icons/logoctict.png') ?>" alt="Logo">
                                        </a>
                                    </li>

                                    <li><a class="text-dark fw-bold nav-link" href="<?= base_url() ?>"><i class=""></i>
                                            Trang Chủ</a></li>

                                    <li class="nav-item dropdown">
                                        <div class="dropdown">
                                            <button class="btn text-dark fw-bold dropdown-toggle" type="button"
                                                id="dropdownMenu1" data-bs-toggle="dropdown" aria-expanded="false">
                                                Giới Thiệu
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <a class="dropdown-item" href="/gioi-thieu">Giới thiệu chung</a>
                                                <a class="dropdown-item" href="/chuc-nang-nhiem-vu">Chức năng - Nhiệm
                                                    vụ</a>
                                                <a class="dropdown-item" href="/co-cau-to-chuc">Cơ cấu tổ chức</a>
                                                <a class="dropdown-item" href="/linh-vuc-hoat-dong">Lĩnh vực hoạt
                                                    động</a>
                                            </div>
                                        </div>
                                    </li>

                                    <li><a class="text-dark fw-bold nav-link" href="/cate/tin-tuc-su-kien"><i
                                                class=""></i> Tin tức - Sự Kiện</a></li>

                                    <li class="nav-item dropdown">
                                        <div class="dropdown">
                                            <button class="btn text-dark fw-bold dropdown-toggle" type="button"
                                                id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                                Tài Liệu Tham Khảo
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                <a class="dropdown-item" href="/tai-lieu">PCTN, THTK, CLP</a>
                                            </div>
                                        </div>
                                    </li>

                                    <li><a class="text-dark fw-bold nav-link" href="/gop-y"><i class=""></i> Góp Ý</a>
                                    </li>
                                    <!-- <li><a class="text-dark fw-bold nav-link" href="#"><i class=""></i> Liên Hệ</a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Menu area end -->
    </div>


</body>

</html>