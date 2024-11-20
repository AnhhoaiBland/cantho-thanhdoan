<?= $this->section('templates/slide') ?>
<!-- Include main slide template -->
<?= $this->include('templates/slide') ?>
<!-- Include Đối Tác slide template -->


<?= $this->endSection() ?>

<!-- Other sections like bài viết mới -->


<?php

use App\Controllers\BaiDangController;


$databaidangtop6new['ds_baiDang'] =  $baidangtop6new;
echo view('block/block_chuyenMuc', $databaidangtop6new);
?>

<!-- Main HTML content -->
<div class="white-background">
    <?= $this->include('templates/tintucnoibac') ?>
</div>



<div class="white-background">
    <?= $this->include('templates/noidung') ?>
</div>

