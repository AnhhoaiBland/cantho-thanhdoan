<style>
	/* Cải thiện tổng thể cho container và card */
	.container-fluid-card {
		padding: 20px;
		background-color: #f7f7f7;
		/* Màu nền nhẹ nhàng cho container */
	}

	.container-card {
		display: grid;
		gap: 20px;
		/* Khoảng cách giữa các card */
		margin-top: 20px;
		/* Khoảng cách từ tiêu đề chuyên mục đến card đầu tiên */
	}

	.card {
		background-color: #ffffff;
		/* Màu nền cho card */
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		/* Bóng đổ nhẹ */
		border-radius: 10px;
		/* Bo góc cho card */
		overflow: hidden;
		/* Ẩn nội dung tràn ra ngoài card */
		transition: transform 0.3s ease-in-out;
		/* Hiệu ứng khi hover */
	}

	.card:hover {
		transform: translateY(-5px);
		/* Nâng card lên khi hover */
	}

	/* Style cho tiêu đề và nội dung */
	.card h3 {
		font-size: 1.2em;
		/* Cỡ chữ cho tiêu đề */
		margin: 16px;
		/* Khoảng cách xung quanh tiêu đề */
		color: #333;
		/* Màu chữ cho tiêu đề */
	}

	.card p {
		font-size: 1em;
		/* Cỡ chữ cho nội dung */
		margin: 0 16px 16px;
		/* Khoảng cách xung quanh nội dung */
		color: #666;
		/* Màu chữ cho nội dung */
	}

	/* Responsive design cho các kích thước màn hình khác nhau */
	@media screen and (max-width: 767px) {
		.container-card {
			grid-template-columns: repeat(1, 1fr);
		}
	}

	@media screen and (min-width: 768px) and (max-width: 1024px) {
		.container-card {
			grid-template-columns: repeat(2, 1fr);
		}
	}

	@media screen and (min-width: 1025px) {
		.container-card {
			grid-template-columns: repeat(3, 1fr);
			/* Hiển thị 3 card trên mỗi hàng cho màn hình lớn */
		}
	}

	.pagination {
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.active_a {
		color: #11286e;
		font-size: 15px;
		font-weight: bold;
	}

	.pagination a {
		color: black;
		text-decoration: none;
		padding: 8px 16px;
		margin: 0 5px;
		border-radius: 5px;
		transition: background-color 0.3s;
	}

	.pagination a:hover {
		background-color: #f2f2f2;
	}

	.pagination .current {
		background-color: #4CAF50;
		color: white;
	}
</style>

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
<div class="container-fluid container-fluid-card bg-body" style="min-height: 700px;">

	<div>
		<h5 class="category_title"><?= $chuyenMuc[0]['tenChuyenMuc'] ?></h5>
	</div>
	<?php if (count($ds_baiDang) > 0) : ?>
		<div class="container-card">
			<?php foreach ($ds_baiDang as $baidang) : ?>

				<div class="card">
					<a href="<?= $baidang['urlBaiDang'] ? base_url('/bv/' . $baidang['urlBaiDang']) : base_url('/bv/' . $baidang['maBaiDang']) ?>">
						<img src="<?= base_url('upload/media/images/' . ($baidang['anhTieuDe'] != NULL ? $baidang['anhTieuDe'] : 'image_blank.jpg')) ?>" alt="Image 1">

						<h3><?= cut_text(strip_tags($baidang['tieuDe']), 50) ?> </h3>
						<p><?=  cut_text(strip_tags($baidang['noiDung']), 120) ?></p>
					</a>
				</div>
			<?php endforeach ?>



		</div>
	<?php else : ?>
		Nội dung đang cập nhật
	<?php endif ?>

	<?php $total_page = $total_page - 1;
	if (count($ds_baiDang) > 0) { ?>

		<div class="pagination">
			<?php if ($current_page > 1 && $total_page > 1) { ?>
				<a href=<?= $full_url . "?page=" . ($current_page - 1) ?>>&laquo; Quay lại</a>
			<?php	} ?>

			<?php for ($i = 1; $i <= $total_page; $i++) {
				if ($i == $current_page) { ?>
					<a class="active_a" href=<?= $full_url . "?page=" . $i ?>><?= $i ?></a>
				<?php } else { ?>
					<a href=<?= $full_url . "?page=" . $i ?>><?= $i ?></a>
			<?php }
			} ?>

			<?php if ($current_page < $total_page && $total_page > 1) { ?>
				<a href=<?= $full_url . "?page=" . ($current_page + 1) ?>>Xem tiếp &raquo;</a>
			<?php } ?>


		</div>

	<?php } ?>


</div>