<!-- News With Sidebar Start -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h4 class="m-0 text-uppercase font-weight-bold">Bản tin Tuổi trẻ Tây Đô</h4>
                            <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        if (isset($ds_baiDang) && is_array($ds_baiDang)) {
                            $counter = 0;
                            foreach ($ds_baiDang as $baiDang) {
                                if ($counter >= 6) break;
                                $counter++;

                                // Limit the title to 5 words
                                $title = esc($baiDang['tieuDe']);
                                $words = explode(' ', $title);
                                if (count($words) > 4) {
                                    $shortTitle = implode(' ', array_slice($words, 0, 4)) . '...';
                                } else {
                                    $shortTitle = $title;
                                }
                        ?>
                        <div class="col-lg-6">
                            <div class="position-relative mb-3">
                                <img class="img-fluid w-100"
                                    src="<?= base_url('upload/media/images/' . ($baiDang['anhTieuDe'] != NULL ? $baiDang['anhTieuDe'] : 'image_blank.jpg')) ?>"
                                    alt="<?= esc($baiDang['tieuDe']) ?>" style="height: 200px; object-fit: cover;">
                                <div class="bg-white border border-top-0 p-4">
                                    <div class="mb-2">
                                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                            href=""><?= esc($baiDang['tenChuyenMuc']) ?></a>
                                        <a class="text-body"
                                            href=""><small><?= date('d-m-Y', strtotime($baiDang['ngayDang'])) ?></small></a>
                                    </div>
                                    <a class="h4 d-block mb-0 text-secondary text-uppercase font-weight-bold truncate-title"
                                        href="<?= base_url('/bv/' . ($baiDang['urlBaiDang'] ?? $baiDang['maBaiDang'])) ?>"
                                        title="<?= esc($baiDang['tieuDe']) ?>"><?= $shortTitle ?></a>
                                </div>
                                <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle mr-2" src="../../../public/assets/images/user.jpg"
                                            width="25" height="25" alt="">
                                        <small><?= esc($baiDang['maNguoiDung']) ?></small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <small class="ml-3"><i class="far fa-eye mr-2"></i>12345</small>
                                        <small class="ml-3"><i class="far fa-comment mr-2"></i>123</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <a href=""><img class="img-fluid w-100" src="../../../public/assets/images/ads-728x90.png"
                                alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- lien ket truyen thong -->
                <div class="white-background">
                    <?= $this->include('templates/truyenthong') ?>
                </div>
                <!-- hashtag -->
                <div class="white-background">
                    <?= $this->include('templates/hashtag') ?>
                </div>
                <?php
                    $databaidanglichlamviec['ds_baiDang'] =  $baidanglichlamviec;
                    echo view('block/block_lichLamViec', $databaidanglichlamviec);
                    ?>
            </div>
        </div>
    </div>
</div>
<!-- News With Sidebar End -->