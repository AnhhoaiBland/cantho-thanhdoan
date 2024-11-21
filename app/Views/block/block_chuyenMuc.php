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
                        } while (in_array($random_index, $displayed_indices) || $ds_baiDang[$random_index]['maChuyenMuc'] != 290);
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
            <div class="row">
                <?php
                $counter = 0;
                foreach ($ds_baiDang as $baiDang) {
                    if ($counter >= 4) break;
                    if ($baiDang['maChuyenMuc'] == 290) {
                        renderBaiDang($baiDang);
                        $counter++;
                    }
                }
                ?>
            </div>
        </div>
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
    ?>
</div>

<!-- Main News Slider End -->

<!-- Breaking News Start -->
<div class="container-fluid bg-dark py-3 mb-3">
    <div class="container">
        <div class="row align-items-center bg-dark">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                <div class="bg-primary text-dark text-center font-weight-bold py-2" style="width: 170px; font-size: 1rem;">
                    TIN VẮN
                </div>
                    <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3"
                        style="width: calc(100% - 170px); padding-right: 90px;">
                        <?php
                        $displayed_indices = [];
                        for ($i = 0; $i < 9; $i++) :
                            if (count($ds_baiDang) > 0) :
                                do {
                                    $random_index = array_rand($ds_baiDang);
                                } while (in_array($random_index, $displayed_indices) || $ds_baiDang[$random_index]['maChuyenMuc'] != 503);
                                $displayed_indices[] = $random_index;
                                $random_baiDang = $ds_baiDang[$random_index];
                        ?>
                        <div class="text-truncate">
                            <a class="text-white text-uppercase font-weight-semi-bold" href="">
                                <?php echo $random_baiDang['tieuDe']; ?>
                            </a>
                        </div>
                        <?php
                            endif;
                        endfor;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breaking News End -->