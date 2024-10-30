<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= base_url() . "upload/media/images/" . $logo ?>" type="image/x-icon">
    <title><?=WEB_TITLE ?></title>
    
    <link href=<?= base_url("public/assets/admin_template/plugins/fontawesome-free/css/all.min.css") ?> rel="stylesheet">
    <link href=<?= base_url("public/assets/font-awesome/css/font-awesome.css") ?> rel="stylesheet">
    <link rel="stylesheet" type="text/css" href=<?= base_url("public/bootstrap513/bootstrap.min.css") ?> />
    <link rel="stylesheet" type="text/css" href=<?= base_url("public/icons/icon.css") ?> />
    <link rel="stylesheet" type="text/css" href=<?= base_url("public/assets/template/css/slicknav.min.css") ?>>
    <link rel="stylesheet" type="text/css" href=<?= base_url("public/assets/template/css/style.css") ?> media="all" />

    <link rel="stylesheet" type="text/css" href=<?= base_url("public/assets/swiper/swiper-bundle.min.css") ?> media="all" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" type="text/css" href=<?= base_url("public/assets/template/css/responsive.css") ?> media="all" />
    <script src=<?= base_url("public/assets/template/js/jquery.min.js") ?>></script>

    <!-- <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/blogs/blog-5/assets/css/blog-5.css"> -->
    <!-- <script src="summernote-0.8.18-dist/jquery-3.5.1.min.js"></script> -->
    <!-- public\templates\summernote-0.8.18-dist\summernote-lite.min.css -->
    <link href=<?= base_url("public/templates/summernote-0.8.18-dist/summernote-lite.min.css") ?> rel="stylesheet">
    <script src=<?= base_url("public/templates/summernote-0.8.18-dist/summernote-lite.min.js") ?>></script>

    <script src=<?= base_url("public/assets/template/js/owl.carousel.min.js") ?>></script>
    <script src=<?= base_url("public/assets/template/js/isotope-3.0.4.min.js") ?>></script>
    <script src=<?= base_url("public/assets/template/js/jquery.bxslider.min.js") ?>></script>
    <script src=<?= base_url("public/assets/template/js/wow-1.3.0.min.js") ?>></script>
    <script src=<?= base_url("public/assets/template/js/jquery.imagezoom.js") ?>></script>

    <link rel="stylesheet" type="text/css" href=<?= base_url("public/templates/style_v2.css") ?> />

    <style>
        /* Style the list */
        ul.breadcrumb {
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
            color: #a707b5;
            text-decoration: none;
        }

        /* Add a color on mouse-over */
        ul.breadcrumb li a:hover {
            color: #a707b5;
            text-decoration: underline;
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
    </style>
</head>

<body style="background-color: #e0e0e0">

    <?php $dt['ds_category_slide'] = $ds_category;

    echo view('templates/Header2_v2', $dt) ?>

    <?php if (!empty($breadcrumb)) { ?>
        <div class='container'>
            <ul class="breadcrumb">
                <!-- <li><a href=<?= base_url() ?>> Trang chủ </a></li> -->
                <?php
                $url = current_url();
                $parsedUrl = parse_url($url);
                $pathParts = explode('/', $parsedUrl['path']);
                $lastPathPart = end($pathParts);
                foreach ($breadcrumb as $value) {
                    $parsedUrl_Crum = parse_url($value['url']);
                    $pathParts_Crum = explode('/', $parsedUrl_Crum['path']);
                    $lastPathPart_Crum = end($pathParts_Crum);
                ?>
                    <li class=<?= $lastPathPart_Crum == $lastPathPart ? "active" : "" ?>><a href=<?= $value['url'] ?>><?= $value['title'] ?></a></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>



    <div class="container">
        <div class="row">

            <div class="col-md-9">

                <!-- nạp trang -->


                <?php echo $page ?>

                <!-- end add page -->

            </div>

            <div class="col-md-3">
                <?php $dataPa['dataPanel'] = $dataPanel;
                echo view('templates/PanelCanh', $dataPa) ?>

                <?php echo view('block/Show_lienKetWeb') ?>

                <?php if ($showTVAnh) { ?>
                    <?php
                    $dat['title'] = "THƯ VIỆN HÌNH ẢNH";
                    $dat['url'] = "/thu-vien-anh";
                    echo view('block/Show_thuVienAnh_video', $dat) ?>
                <?php } ?>

                <?php if ($showTVVideo) { ?>
                    <?php
                    $dat['title'] = "THƯ VIỆN VIDEO";
                    $dat['url'] = "/thu-vien-video";
                    echo view('block/Show_thuVienAnh_video', $dat) ?>
                <?php } ?>


            </div>

        </div>
      

    </div>

    <?php $dt_luoc_tc['luoc_truy_cap'] = $luoc_truy_cap;
    echo view('templates/Footer_v2', $dt_luoc_tc) ?>

    <script src=<?= base_url("public/assets/swiper/swiper-bundle.min.js") ?>></script>
    <script src=<?= base_url("public/assets/template/js/jquery.slicknav.min.js") ?>></script>
    <script src=<?= base_url("public/assets/template/js/main.js") ?>></script>

    <script src=<?= base_url("public/bootstrap513/bootstrap.bundle.min.js") ?>></script>
    <script src=<?= base_url("public/templates/scripts.js") ?>></script>



</body>

</html>