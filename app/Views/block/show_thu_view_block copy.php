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
	.card {
		height: 250px;
	}

	.card img {
		height: 100px;
		width: 100%;
		object-fit: cover;
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
<div class="container bg-body pb-3 pt-3" style="min-height: 800px;">
	<div class="row row-cols-1 row-cols-md-3 g-4">
		<?php foreach ($ds_BoSuTap as $BoSuTap) { ?>
			<?php if ($BoSuTap['loai'] == 'im') { ?>
				<a href="<?= base_url("view/" . $BoSuTap['maBoSuuTap']) ?>" class="col">
				<?php } else { ?>
					<a href="<?= base_url("video/" . $BoSuTap['maBoSuuTap']) ?>" class="col">
					<?php } ?>

					<div class="card">
						<?php if ($BoSuTap['loai'] == 'im') { ?>
							<img src="<?= base_url('upload/media/images/' . ($BoSuTap['urlFile'] != NULL ? $BoSuTap['urlFile'] : 'image_blank.jpg')) ?>" class="card-img-top" alt="...">
						<?php } else { ?>
							<video src="<?= base_url('upload/media/videos/' . ($BoSuTap['urlFile'] != NULL ? $BoSuTap['urlFile'] : 'image_blank.jpg')) ?>" class="card-img-top" alt="..."></video>
						<?php } ?>
						<div class="card-body">
							<p class="card-text"><?= cut_text(strip_tags($BoSuTap['tenBoSuuTap']), 50) ?></p>
						</div>
						<div class="card-footer">
							<small class="text-body-secondary"><?= date('d-m-y', strtotime($BoSuTap['ngayTao'])) ?></small>
						</div>
					</div>
					</a>
				<?php } ?>
	</div>

	<?php $total_page = $total_page - 1;
	if (count($ds_BoSuTap) > 0) { ?>

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