<!-- Popular News Start -->
<div class="mb-3">
    <div class="section-title mb-0">
        <h4 class="m-0 text-uppercase font-weight-bold">Lịch Làm Việc</h4>
    </div>
    <div class="bg-white border border-top-0 p-3">
        <div class="d-flex flex-column">

            <?php
            if (!function_exists('displayPosts')) {
                function displayPosts($ds_baiDang, &$displayed_indices, $count = 6) {
                    for ($i = 0; $i < $count; $i++) {
                        if (count($ds_baiDang) > 0) {
                            do {
                                $random_index = array_rand($ds_baiDang);
                            } while (in_array($random_index, $displayed_indices));
                            $displayed_indices[] = $random_index;
                            $random_baiDang = $ds_baiDang[$random_index];
                            ?>
                            <div class="d-flex align-items-center bg-white mb-3" style="height: 80px;">
                                <img class="img-fluid" src="<?= base_url('upload/media/images/' . ($random_baiDang['anhTieuDe'] != NULL ? $random_baiDang['anhTieuDe'] : 'image_blank.jpg')) ?>" alt="" style="width: 80px; height: 80px; object-fit: cover;">
                                <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                                    <div class="mb-2">
                                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href=""><?= $random_baiDang['tenChuyenMuc'] ?? 'Category' ?></a>
                                        <a class="text-body" href=""><small><?= date('d-m-Y', strtotime($random_baiDang['ngayDang'])) ?></small></a>
                                    </div>
                                    <a class="h6 m-0 text-body text-uppercase font-weight-semi-bold" href="<?= base_url('/bv/' . ($random_baiDang['urlBaiDang'] ?? $random_baiDang['maBaiDang'])) ?>">
                                        <?= esc($random_baiDang['tieuDe']) ?>
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
            }

            // Assuming $ds_baiDang is defined and $displayed_indices is an array
            $displayed_indices = [];
            displayPosts($ds_baiDang, $displayed_indices);
            ?>
        </div>
    </div>
</div>
<!-- Popular News End -->