<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <!-- Include your CSS files here -->
    <link rel="stylesheet" href="<?= base_url('path/to/your/css/file.css') ?>">
    <link rel="stylesheet" href="<?= base_url('path/to/another/css/file.css') ?>">
</head>
<body>
    <?= $this->section('templates/slide') ?>
    <!-- Include main slide template -->
    <?= $this->include('templates/slide') ?>
    <!-- Include Đối Tác slide template -->
    <?= $this->endSection() ?>

    <!-- Other sections like bài viết mới -->
    <?php
    $databaidangtintuc['ds_baiDang'] =  $baidangtintuc;
    echo view('block/block_chuyenMuc', $databaidangtintuc);

    ?>

  

  

    <!-- Main HTML content -->
    <div class="white-background">
        <?= $this->include('templates/tintucnoibac') ?>
    </div>

    

    <?php
    $databaidangtuoitretaydo['ds_baiDang'] =  $baidangtuoitretaydo;
    echo view('block/block_tuoiTreTayDo', $databaidangtuoitretaydo);
    ?>
    
    <div class="white-background">
        <?= $this->include('templates/noidung') ?>
    </div>
</body>
</html>
