<head>
    <!-- Thêm Slick Carousel CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />

    <!-- Thêm jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Thêm Slick Carousel JS -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js">
    </script>
    <!-- Thêm Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Thêm Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</head>

<style>
.carousel-inner1 {
    height: 600px;
    /* Chiều cao tổng của carousel */
}

.carousel-item {
    display: flex;
    flex-direction: column;
    /* Hướng trượt dọc */
    height: 100%;
}

.show_baiviet_hinh_3cot_khung {
    margin-top: 10px;
    border: 1px solid #eeeeee;
    padding: 3px;
    height: 100%;
    overflow: hidden;
    position: relative;
}

.show_baiviet_hinh_3cot_image {
    height: 200px;
    overflow: hidden;
}

.show_baiviet_hinh_3cot_image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.show_baiviet_hinh_3cot_title {
    position: absolute;
    bottom: 10px;
    left: 15px;
    color: #fff;
    background: rgba(0, 0, 0, 0.5);
    padding: 5px;
}

.left-space {
    /* Kích thước phần trống bên trái */
    height: 100%;
    background-color: #f8f9fa;
    /* Màu nền cho phần trống */
    border-right: 1px solid #eeeeee;
    /* Đường viền phải */
    padding: 15px;
    /* Khoảng cách bên trong */
}

.show_baiviet_hinh_slide_image {
    position: relative;
}

.show_baiviet_hinh_slide_title {
    padding: 15px;
    background-color: #fff;
    color: #333;
    margin-top: 10px;
    border-top: 1px solid #eeeeee;
}

.show_baiviet_hinh_slide_content {
    padding: 5px;
    background-color: #fff;
    border-top: 1px solid #eeeeee;
}

.read-more {
    display: block;
    margin-top: 15px;
    text-align: right;
}

</style>

<div class="pb-3 pt-5 block_ditich_hinh bg-body p-4">
    <div class="block_ditich_hinh_header block_title">
        <a style="font-size: 18px;" class="text-white" href="<?= base_url($url_cate) ?>"><?= esc($title) ?></a>
    </div>
    <hr>
    <div class="block_ditich_hinh_content">
        <div class="row">
            <!-- Phần chứa các mục tin dạng slide lớn -->
            <div class="col-md-8 left-space" id="leftContent">
                <?php
                if (count($ds_baiDang) > 0) :
                    // Lấy ngẫu nhiên một bài viết để hiển thị bên trái khi load trang
                    $random_baiDang = $ds_baiDang[array_rand($ds_baiDang)];
                ?>
                <div class="show_baiviet_hinh_slide_khung">
                    <div class="show_baiviet_hinh_slide_image"
                        style="background: url('<?= base_url('upload/media/images/' . ($random_baiDang['anhTieuDe'] != NULL ? $random_baiDang['anhTieuDe'] : 'image_blank.jpg')) ?>') center center; background-size: cover;">
                        <img src="<?= base_url('upload/media/images/' . ($random_baiDang['anhTieuDe'] != NULL ? $random_baiDang['anhTieuDe'] : 'image_blank.jpg')) ?>"
                            alt="<?= esc($random_baiDang['tieuDe']) ?>" class="d-block w-100">
                    </div>
                    <div class="show_baiviet_hinh_slide_title">
                        <a
                            href="<?= base_url('/bv/' . ($random_baiDang['urlBaiDang'] ?? $random_baiDang['maBaiDang'])) ?>">
                            <h3><?= esc($random_baiDang['tieuDe']) ?></h3>
                        </a>
                    </div>
                    <div class="show_baiviet_hinh_slide_content">
                        
                        <a href="<?= base_url('/bv/' . ($random_baiDang['urlBaiDang'] ?? $random_baiDang['maBaiDang'])) ?>"
                            class="read-more">Xem thêm &rarr;</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <?php
            // Tạo mảng chứa 6 bài viết đầu tiên từ danh sách bài đăng
            $ds_baiDang6 = array_slice($ds_baiDang, 0, 6);

            // Tách 3 bài viết đầu tiên và 3 bài viết còn lại
            $ds_baiDang3_hienThi = array_slice($ds_baiDang6, 0, 2);
            $ds_baiDang3_slide = array_slice($ds_baiDang6, 3, 3);
            ?>

            <div class="col-md-4">
                <?php if (count($ds_baiDang3_hienThi) > 0) : ?>
                <div class="news-vertical-slider">
                    <?php foreach ($ds_baiDang3_hienThi as $baidang) : ?>
                    <div class="show_baiviet_hinh_3cot_khung">
                        <div class="show_baiviet_hinh_3cot_image"
                            style="background: url('media/images/BV_HINH_ANH_SAMPLE') center center; background-size: cover;">
                            <img src="<?= base_url('upload/media/images/' . ($baidang['anhTieuDe'] != NULL ? $baidang['anhTieuDe'] : 'image_blank.jpg')) ?>"
                                alt="Image 1" class="d-block w-100">
                            <div class="show_baiviet_hinh_3cot_bg"></div>
                            <div class="show_baiviet_hinh_3cot_title">
                                <p href="<?= base_url('/bv/' . ($baidang['urlBaiDang'] ?? $baidang['maBaiDang'])) ?>"
                                  
                                    class="baiviet-link" data-title="<?= esc($baidang['tieuDe']) ?>"
                                    data-image="<?= base_url('upload/media/images/' . ($baidang['anhTieuDe'] != NULL ? $baidang['anhTieuDe'] : 'image_blank.jpg')) ?>">
                                    <?= esc($baidang['tieuDe']) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Slide chuyển động dọc hiển thị 3 bài viết còn lại -->
                <div id="verticalCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
                    <div class="carousel-inner">
                        <?php foreach ($ds_baiDang3_slide as $index => $baidang) : ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <div class="show_baiviet_hinh_3cot_khung">
                                <div class="show_baiviet_hinh_3cot_image"
                                    style="background: url('media/images/BV_HINH_ANH_SAMPLE') center center; background-size: cover;">
                                    <img src="<?= base_url('upload/media/images/' . ($baidang['anhTieuDe'] != NULL ? $baidang['anhTieuDe'] : 'image_blank.jpg')) ?>"
                                        alt="Image <?= $index + 4 ?>" class="d-block w-100">
                                    <div class="show_baiviet_hinh_3cot_bg"></div>
                                    <div class="show_baiviet_hinh_3cot_title">
                                <p href="<?= base_url('/bv/' . ($baidang['urlBaiDang'] ?? $baidang['maBaiDang'])) ?>"
                                    class="baiviet-link" data-title="<?= esc($baidang['tieuDe']) ?>"
                                    data-image="<?= base_url('upload/media/images/' . ($baidang['anhTieuDe'] != NULL ? $baidang['anhTieuDe'] : 'image_blank.jpg')) ?>">
                                    <?= esc($baidang['tieuDe']) ?>
                                </p>
                            </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                </div>
                <?php else : ?>
                <p>Nội dung đang cập nhật</p>
                <?php endif; ?>
            </div>

        </div>

    </div>

</div>

<script>
$(document).ready(function() {
    // Tùy chỉnh để chuyển trượt từ ngang sang dọc
    $('#verticalCarousel').on('slide.bs.carousel', function(e) {
        var $e = $(e.relatedTarget);
        var idx = $e.index();
        var itemsPerSlide = 3; // Hiển thị tối thiểu 3 bài
        var totalItems = $('.carousel-item').length;

        if (idx >= totalItems - (itemsPerSlide - 1)) {
            var it = itemsPerSlide - (totalItems - idx);
            for (var i = 0; i < it; i++) {
                // Lặp lại các mục từ đầu để tạo hiệu ứng lặp vòng
                if (e.direction == "down") {
                    $('.carousel-item').eq(i).appendTo('.carousel-inner');
                } else {
                    $('.carousel-item').eq(0).appendTo('.carousel-inner');
                }
            }
        }
    });

    // Xử lý sự kiện click vào bài viết bên phải
    $('.baiviet-link').on('click', function(e) {
        e.preventDefault();
        var title = $(this).data('title');
        var image = $(this).data('image');
        var link = $(this).attr('href');

        // Hiển thị nội dung bên trái
        var contentHtml = '<div class="show_baiviet_hinh_slide_khung">' +
            '<div class="show_baiviet_hinh_slide_image" style="background: url(' + image +
            ') center center; background-size: cover;">' +
            '<img src="' + image + '" alt="' + title + '" class="d-block w-100">' +
            '</div>' +
            '<div class="show_baiviet_hinh_slide_title">' +
            '<a href="' + link + '"><h3>' + title + '</h3></a>' +
            '</div>' +
            '<div class="show_baiviet_hinh_slide_content">' +
            '<a href="' + link + '" class="read-more">Xem thêm &rarr;</a>' +
            '</div>' +
            '</div>';

        $('#leftContent').html(contentHtml);
    });
});
</script>