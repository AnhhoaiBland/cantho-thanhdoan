<div class="container p-4 bg-body">
    <!-- Header Section -->
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="block_title-gioi-thieu mt-3">SỞ THÔNG TIN VÀ TRUYỀN THÔNG THÀNH PHỐ CẦN THƠ</h1>
            <h3 class="block_title-gioi-thieu">TRUNG TÂM CÔNG NGHỆ THÔNG TIN VÀ TRUYỀN THÔNG THÀNH PHỐ CẦN THƠ</h3>
            <hr style="border: 1px solid #0000; width: 80%; margin: 0 auto;">
            <p>Trụ sở chính: Số 29 Cách Mạng Tháng 8, Phường Thới Bình, Quận Ninh Kiều, TPCT</p>
            <p>ĐT: 0292 3 690 888 | Fax: 08 07 12 13 | Website: <a href="http://ctict.cantho.gov.vn">http://ctict.cantho.gov.vn</a> | Email: <a href="mailto:ctict@cantho.gov.vn">ctict@cantho.gov.vn</a></p>
        </div>
    </div>

    <!-- Files Section for the selected folder -->
    <div class="row mt-5">
        <h2 class="heading-title">Tài liệu trong thư mục: <?= $currentFolder->folder_name ?></h2>
        <div class="col-md-12">
            <?php if(!empty($files)): ?>
                <ul>
                    <?php foreach($files as $file): ?>
                        <li>
                            <?php
                                // Create a download link using the file name
                                $file_url = base_url('uploads/' . $file->file_name);
                            ?>
                                <a href="<?= $file_url ?>" download>
                                    <i class="fas fa-file"></i> <?= $file->file_name ?>
                                </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Không có tài liệu nào trong thư mục này.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
