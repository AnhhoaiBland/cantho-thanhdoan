<!-- Main News Slider Start -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-7 px-0">
            <div class="owl-carousel main-carousel position-relative">
                <?php
                $displayed_indices = [];
                for ($i = 0; $i < 3; $i++) :
                    if (count($ds_baiDang) > 0) :
                        do {
                            $random_index = array_rand($ds_baiDang);
                        } while (in_array($random_index, $displayed_indices));
                        $displayed_indices[] = $random_index;
                        $random_baiDang = $ds_baiDang[$random_index];
                ?>
                <div class="position-relative overflow-hidden" style="height: 500px;">
                    <img src="<?= base_url('upload/media/images/' . ($random_baiDang['anhTieuDe'] != NULL ? $random_baiDang['anhTieuDe'] : 'image_blank.jpg')) ?>"
                        alt="<?= esc($random_baiDang['tieuDe']) ?>" class="d-block w-100">
                    <div class="overlay">
                        <div class="mb-2">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                href=""><?= esc($random_baiDang['tenChuyenMuc']) ?></a>
                            <a class="text-white"
                                href=""><?= date('d-m-Y', strtotime($random_baiDang['ngayDang'])) ?></a>
                        </div>
                        <a class="h2 m-0 text-white text-uppercase font-weight-bold"
                            href="<?= base_url('/bv/' . ($random_baiDang['urlBaiDang'] ?? $random_baiDang['maBaiDang'])) ?>"
                            style="color: white; text-decoration: none;">
                            <h3 style="color: white;"><?= esc($random_baiDang['tieuDe']) ?></h3>
                        </a>
                    </div>
                </div>
                <?php
                    endif;
                endfor;
                ?>
            </div>
        </div>

        <div class="col-lg-5 px-0">
            <?php
function renderBaiDang($baiDang, $height = 250) {
    ?>
            <div class="col-md-6 px-0">
                <div class="position-relative overflow-hidden" style="height: <?= $height ?>px;">
                    <img class="img-fluid w-100 h-100"
                        src="<?= base_url('upload/media/images/' . ($baiDang['anhTieuDe'] != NULL ? $baiDang['anhTieuDe'] : 'image_blank.jpg')) ?>"
                        alt="<?= esc($baiDang['tieuDe']) ?>" style="object-fit: cover;">
                    <div class="overlay">
                        <div class="mb-2">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                href=""><?= esc($baiDang['tenChuyenMuc']) ?></a>
                            <a class="text-white"
                                href=""><small><?= date('d-m-Y', strtotime($baiDang['ngayDang'])) ?></small></a>
                        </div>
                        <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold"
                            href="<?= base_url('/bv/' . ($baiDang['urlBaiDang'] ?? $baiDang['maBaiDang'])) ?>">
                            <?= esc($baiDang['tieuDe']) ?>
                        </a>
                    </div>
                </div>
            </div>
            <?php
}

// Lọc bài đăng có thời gian trong tháng hiện tại
$currentMonth = date('m');
$currentYear = date('Y');

$filteredBaiDang = array_filter($ds_baiDang, function($baiDang) use ($currentMonth, $currentYear) {
    $ngayDang = date('Y-m-d', strtotime($baiDang['ngayDang']));
    return date('m', strtotime($ngayDang)) == $currentMonth && date('Y', strtotime($ngayDang)) == $currentYear;
});

// Sắp xếp mảng theo ngày cập nhật giảm dần
usort($filteredBaiDang, function($a, $b) {
    return strtotime($b['ngayCapNhat']) - strtotime($a['ngayCapNhat']);
});

// Hiển thị các bài đăng đã lọc
foreach ($filteredBaiDang as $baiDang) {
    renderBaiDang($baiDang);
}
?>


        </div>


    </div>
</div>

<!-- Main News Slider End -->

<!-- Breaking News Start -->
<div class="container-fluid bg-dark py-3 mb-3">
    <div class="container">
        <div class="row align-items-center bg-dark">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <div class="bg-primary text-dark text-center font-weight-medium py-2" style="width: 170px;">
                        Breaking News
                    </div>
                    <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3"
                        style="width: calc(100% - 170px); padding-right: 90px;">
                        <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold"
                                href="">Lorem ipsum dolor sit amet elit. Proin interdum lacus eget ante
                                tincidunt,
                                sed faucibus nisl sodales</a></div>
                        <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold"
                                href="">Lorem ipsum dolor sit amet elit. Proin interdum lacus eget ante
                                tincidunt,
                                sed faucibus nisl sodales</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breaking News End -->