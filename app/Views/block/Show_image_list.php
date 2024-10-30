<?php
// Hàm cắt chuỗi tiếng Việt
function cut_text($text, $max_length, $ellipsis = '...')
{
    // Kiểm tra độ dài của chuỗi
    if (mb_strlen($text, 'UTF-8') > $max_length) {
        // Cắt chuỗi tại độ dài tối đa
        $cut_off = mb_substr($text, 0, $max_length, 'UTF-8');

        // Tìm vị trí cuối cùng của dấu cách hoặc dấu gạch ngang
        $last_space = mb_strrpos($cut_off, ' ', 0, 'UTF-8');
        $last_dash = mb_strrpos($cut_off, '-', 0, 'UTF-8');

        // Chọn vị trí cuối cùng giữa dấu cách và dấu gạch ngang
        if ($last_space !== false && $last_dash !== false) {
            $last_pos = max($last_space, $last_dash);
        } else {
            $last_pos = ($last_space === false) ? $last_dash : $last_space;
        }

        // Nếu tìm thấy vị trí hợp lệ, cắt chuỗi tại vị trí đó
        if ($last_pos !== false) {
            $cut_off = mb_substr($cut_off, 0, $last_pos, 'UTF-8');
        }

        // Thêm hậu tố vào chuỗi đã cắt
        $cut_off .= $ellipsis;

        return $cut_off;
    } else {
        // Thêm dấu cách hoặc <br> để đảm bảo đủ độ dài
        while (mb_strlen($text, 'UTF-8') < $max_length) {
            $text .= ' ';
        }

        return $text;
    }
}
?>

<style>
    .carousel-item {
        background-color: white;
    }

    .carousel-item img {
        width: 600px;
        height: 500px;
        object-fit: contain;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .title {
        margin-top: 10px;
        margin-left: 25px;
        background-color: #007bff; /* Blue background color */
        color: white; /* White text color */
        border-radius: 8px; /* Rounded corners */
        padding: 10px; /* Padding */
    }
</style>

<div class="bg-body" style="min-height: 800px;">
    <div class="title p-3">
        <?= $infor_bst[0]["tenBoSuuTap"] ?>
    </div>

    <?php if ($infor_bst[0]["loai"] == 'im') { ?>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php foreach ($item_bst as $key => $bst) { ?>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $key ?>" <?= $key === 0 ? 'class="active"' : '' ?> aria-label="Slide <?= $key ?>"></button>
                <?php } ?>
            </div>

            <div class="carousel-inner">
                <?php foreach ($item_bst as $key => $bst) { ?>
                    <div class="carousel-item <?= $key === 0 ? 'active' : '' ?>">
                        <a href="<?= base_url("upload/media/images/{$bst['urlFile']}") ?>" target="_blank">
                            <img src="<?= base_url("upload/media/images/{$bst['urlFile']}") ?>" class="d-block w-100" alt="...">
                        </a>
                    </div>
                <?php } ?>
            </div>
           
        </div>
    <?php } else { ?>
        <!-- <div class="d-flex justify-content-center">
            <video width="90%" height="340" controls>
                <source src="upload/media/videos/movie.mp4" type="video/mp4">
            </video> 
        </div> -->
        <?php $dtv['item_bst']  = $item_bst;
        echo view('block/Block_video', $dtv) ?>
    <?php } ?>

    <div class="mota p-3">
        <?= $infor_bst[0]["moTa"] ?>
    </div>
</div>
