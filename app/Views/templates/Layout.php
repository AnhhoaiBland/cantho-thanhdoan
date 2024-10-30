<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= base_url() . "upload/media/images/" . $logo ?>" type="image/x-icon">
    <title><?= WEB_TITLE ?></title>

    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" href="<?= base_url("public/templates/style.css") ?>" />
    <link href="<?= base_url("public/assets/admin_template/plugins/fontawesome-free/css/all.min.css") ?>"
        rel="stylesheet">
    <link href="<?= base_url("public/assets/font-awesome/css/font-awesome.css") ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url("public/bootstrap513/bootstrap.min.css") ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url("public/icons/icon.css") ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url("public/assets/template/css/slicknav.min.css") ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url("public/assets/template/css/style.css") ?>" media="all" />
    <link rel="stylesheet" type="text/css" href="<?= base_url("public/assets/swiper/swiper-bundle.min.css") ?>"
        media="all" />
    <link rel="stylesheet" type="text/css" href="<?= base_url("public/assets/template/css/responsive.css") ?>"
        media="all" />


    <!-- JavaScript Files -->
    <script src="<?= base_url("public/assets/template/js/jquery.min.js") ?>"></script>
    <script src="<?= base_url("public/assets/template/js/owl.carousel.min.js") ?>"></script>
    <script src="<?= base_url("public/assets/template/js/isotope-3.0.4.min.js") ?>"></script>
    <script src="<?= base_url("public/assets/template/js/jquery.bxslider.min.js") ?>"></script>
    <script src="<?= base_url("public/assets/template/js/wow-1.3.0.min.js") ?>"></script>
    <script src="<?= base_url("public/assets/template/js/jquery.imagezoom.js") ?>"></script>
    <script src="<?= base_url("public/templates/summernote-0.8.18-dist/summernote-lite.min.js") ?>"></script>
    <style>
    Style the list ul.breadcrumb {
        padding: 10px 16px;
        list-style: none;
        border-radius: 5px;
    }

    /* Display list items side by side */
    ul.breadcrumb li {
        display: inline;
        font-size: 18px;
    }

    /* Add a slash symbol (/) before/behind each list item */
    ul.breadcrumb li+li:before {
        padding: 8px;
        color: black;
        content: "/\00a0";
    }

    /* Add a color to all links inside the list */
    ul.breadcrumb li a {
        color: #0275d8;
        text-decoration: none;
        font-size: 20px;
    }

    /* Add a color on mouse-over */
    ul.breadcrumb li a:hover {
        color: #01447e;
        text-decoration: none;
    }

    .breadcrumb .active {
        font-weight: bold;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        ul.breadcrumb li {
            font-size: 14px;
        }

        ul.breadcrumb li+li:before {
            padding: 5px;
        }
    }

    @media (max-width: 480px) {
        ul.breadcrumb {
            padding: 5px;
        }

        ul.breadcrumb li {
            font-size: 12px;
        }

        ul.breadcrumb li+li:before {
            padding: 4px;
        }
    }

    .section-title {
        text-decoration: none;
    }

    .section-title a {
        text-decoration: none;
        background-color: #bddcfe;
        color: #000;
        padding: 4.5px;
        border-radius: 5px;
    }


    .container-home {

        max-width: 100rem;
        /* Giới hạn kích thước tối đa của container */
        margin: 0 auto;
        /* Căn giữa container */
        padding-left: 5px;
        /* Khoảng cách bên trái */
        padding-right: 5px;
        /* Khoảng cách bên phải */
    }

    .section-title {
        margin-bottom: 20px;
        font-size: 18px;
        /* Kích thước chữ lớn hơn */
        font-weight: bold;
    }

    .video-title,
    .image-title {
        border-bottom: 2px solid #ddd;
        padding-bottom: 10px;
    }
    </style>
</head>

<body style="background-color: #bddcfe">

    <?php $dt['ds_category_slide'] = $ds_category;

    echo view('templates/Header2', $dt) ?>

    <?php if (!empty($breadcrumb)) { ?>
    <div class='container'>
        <ul class="breadcrumb1">

        </ul>
    </div>
    <?php } ?>



    <div class="container-home">
        <div class="row">

            <div class="col-md-9">
                <!-- nạp trang -->
                <?php echo $page ?>
                <!-- end add page -->
            </div>

            <div class="col-md-3">
                <!-- Phần panel -->
                <?php $dataPa['dataPanel'] = $dataPanel;
            echo view('templates/PanelCanh', $dataPa) ?>

                <!-- Phần liên kết web -->
                <?php echo view('block/Show_lienKetWeb') ?>

                <!-- Phần thư viện video -->
                <?php if ($showTVVideo) { ?>
                <div class="section-title video-title">
                    <?php
                    $dat['title'] = "THƯ VIỆN VIDEO";
                    $dat['url'] = "/thu-vien-video";
                    echo view('block/Show_thuVienAnh_video', $dat) ?>
                </div>
                <?php } ?>

                <!-- Phần thư viện hình ảnh -->
                <?php if ($showTVAnh) { ?>
                <div class="section-title image-title">
                    <?php
                    $dat['title'] = "THƯ VIỆN HÌNH ẢNH";
                    $dat['url'] = "/thu-vien-anh";
                    echo view('block/Show_thuVienAnh_video', $dat) ?>
                </div>
                <?php } ?>
            </div>

        </div>
    </div>


    <?php $dt_luoc_tc['luoc_truy_cap'] = $luoc_truy_cap;
    echo view('templates/Footer', $dt_luoc_tc) ?>

    <script src=<?= base_url("public/assets/swiper/swiper-bundle.min.js") ?>></script>
    <script src=<?= base_url("public/assets/template/js/jquery.slicknav.min.js") ?>></script>
    <script src=<?= base_url("public/assets/template/js/main.js") ?>></script>

    <script src=<?= base_url("public/bootstrap513/bootstrap.bundle.min.js") ?>></script>
    <script src=<?= base_url("public/templates/scripts.js") ?>></script>



</body>

</html>