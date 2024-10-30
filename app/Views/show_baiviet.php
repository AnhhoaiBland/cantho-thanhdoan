<style>
/* Blog Post Container */
.bg-body {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
}

/* Title Section */
.content_tieude {
    margin-bottom: 20px;
}

.content_tieude h3 {
    font-size: 28px;
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 10px;
    letter-spacing: 1px;
}

.span_ngaydang,
.span_chuyenmuc {
    font-size: 14px;
    color: #7f8c8d;
}

.span_chuyenmuc {
    font-style: italic;
}

/* Image Styling - Consistent Size */
.img_anhminhhoa {
    max-width: 100%;
    height: 400px; /* Set fixed height for consistent image sizes */
    object-fit: cover; /* Ensures the image fits within the fixed height while maintaining aspect ratio */
    display: block;
    margin: 0 auto;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease;
}

.img_anhminhhoa:hover {
    transform: scale(1.05);
}

/* Content Text Styling - Justified */
.content_noidung {
    font-size: 18px;
    line-height: 1.8;
    color: #34495e;
    margin-top: 20px;
    text-align: justify; /* Justify text for equal alignment on both sides */
}

.content_noidung p {
    margin-bottom: 15px;
}

/* Buttons or Links in Content */
.content_noidung a {
    color: #3498db;
    text-decoration: none;
    font-weight: 600;
    border-bottom: 2px solid transparent;
    transition: all 0.3s ease;
}

.content_noidung a:hover {
    border-bottom: 2px solid #3498db;
}

/* Responsive Layout */
@media (max-width: 768px) {
    .content_tieude h3 {
        font-size: 24px;
    }

    .content_noidung {
        font-size: 16px;
        text-align: justify; /* Ensure justification on smaller screens as well */
    }

    .img_anhminhhoa {
        height: 250px; /* Adjust image height for smaller screens */
    }
}


</style>
<div class="w-100 bg-body" style="min-height: 1000px;">
	<div class="content_baiviet">
		<div class="content_tieude">
			<h3><?= $baiDang[0]['tieuDe'] ?></h3>
			<span class="span_ngaydang">Ngày đăng: <?php echo date("d-m-Y", strtotime($baiDang[0]['ngayDang'])); ?></span> -
			<span class="span_chuyenmuc"> <?= $baiDang[0]['tenChuyenMuc'] ?></span>
		</div>
		<div class="mt-2 mb-2">
			<img class="img_anhminhhoa text-center" src=<?= base_url("upload/media/images/{$baiDang[0]['anhTieuDe']}") ?> alt="Ảnh minh họa" title="Ảnh minh họa" />
		</div>
		<div class="content_noidung">
			<?= $baiDang[0]['noiDung'] ?>
		</div>
	</div>
</div>