<style>
    .show_baiviet_hinh_3cot_khung {
        margin-top: 10px;
        border: 1px solid #eeeeee;
        padding: 3px;
        height: 270px;
        overflow: hidden;
        position: relative;
    }

    .show_baiviet_hinh_3cot_image {
        height: 222px;
        overflow: hidden;
        position: relative;
        background-size: cover;
        background-position: center center;
    }

    .show_baiviet_hinh_3cot_title {
        width: 100%;
        left: 0;
        bottom: 0;
        padding: 15px 10px 10px 10px;
        position: absolute;
    }

    .show_baiviet_hinh_3cot_title a {
        color: #ffffff;
        font-weight: bold;
        text-decoration: none;
    }

    .show_baiviet_hinh_3cot_bg {
        width: calc(100% - 6px);
        left: 0;
        bottom: 0;
        padding: 10px;
        height: 100px;
        position: absolute;
        margin: 3px;
        background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(192,192,192, 1));
        z-index: 1;
    }

    .show_baiviet_hinh_3cot_title {
        z-index: 2;
    }
</style>


<div class="pb-3 pt-5 block_ditich_hinh bg-body p-4">
    <div class="block_ditich_hinh_header block_title">
        <!-- Hiển thị tiêu đề chuyên mục -->
        <a style="font-size: 18px;" class="text-white" href="<?= base_url($url_cate) ?>"><?= esc($title) ?></a>
    </div>
    <hr>
    <div class="block_ditich_hinh_content">
        <?php if (count($ds_baiDang) > 0) : ?>
            <div class="row">
                <?php foreach ($ds_baiDang as $baidang) : ?>
                    <div class="col-md-4">
                        <div class="show_baiviet_hinh_3cot_khung">
                            <div class="show_baiviet_hinh_3cot_image" 
                                style="background-image: url('<?= base_url('upload/media/images/' . ($baidang['anhTieuDe'] ?? 'image_blank.jpg')) ?>');">
                                <div class="show_baiviet_hinh_3cot_bg"></div>
                                <div class="show_baiviet_hinh_3cot_title">
                                    <!-- Liên kết đến URL của bài đăng -->
                                    <a href="<?= base_url('/bv/' . ($baidang['urlBaiDang'] ?? $baidang['maBaiDang'])) ?>">
                                        <?= esc($baidang['tieuDe']) ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>

            <!-- Thêm nút dẫn tới chuyên mục -->
            <div class="text-center mt-3">
                <a href="<?= base_url($url_cate) ?>" class="btn btn-primary">Xem thêm tại <?= esc($title) ?></a>
            </div>

        <?php else : ?>
            <p>Nội dung đang cập nhật</p>
        <?php endif ?>
    </div>
</div>
