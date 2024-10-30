<div class="row">
	<div class="col-md-12">
		<h3>Cập nhật Bài Viết</h3>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<form action="admin/save_update_baidang/<?= $baiDangOld[0]['maBaiDang'] ?>" method="POST" style="width:100%" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-5 form-group">
					<label for="">Ngày đăng </label>
					<input type="date" disabled value="<?= date('Y-m-d', strtotime($baiDangOld[0]['ngayDang'])); ?>" class=''>
				</div>
				<div class="col-md-5 form-group">
					<label for="">Người đăng: </label>
					<?= $baiDangOld[0]['tenNguoiDung'] ?>
				</div>
				<div class="col-md-12 form-group">
					<label>Tiêu đề</label>
					<input type="text" id="tieuDeEdit" name="tieude" value="<?= $baiDangOld[0]['tieuDe'] ?>" class="form-control" required="required">
				</div>
				<div class="col-md-7 form-group">
					<label>Đường dẫn bài viết</label>
					<input type="text" id="duongDanEdit" name="urlBaiDang" value="<?= $baiDangOld[0]['urlBaiDang']?>" class="form-control" required="required">
				</div>
				<div class="col-md-7 form-group">
					<label>Mục Tin</label>
					<select name="category" class="form-control" required="required">
						<?php foreach ($ds_category as $category) : ?>
							<?php if ($category['maChuyenMuc'] == $baiDangOld[0]['maChuyenMuc']) : ?>
								<option value="<?= $category['maChuyenMuc'] ?>" selected><?= $category['tenChuyenMuc'] ?></option>
							<?php else : ?>
								<option value="<?= $category['maChuyenMuc'] ?>"><?= $category['tenChuyenMuc'] ?></option>
							<?php endif; ?>
						<?php endforeach; ?>
					</select>

				</div>

				<!-- <div class="col-md-5 form-group">
					<label>Tag:</label>
					<select name="tag[]" class="select2 form-control" multiple>
						<option value="cqs">Chính quyền số</option>
						<option value="kts">Kinh tế số</option>
						<option value="xhs">Xã hội số</option>
					</select>
				</div> -->
				<!-- <div class="col-md-2 form-group">
					<label>Hiện tiêu đề:</label>
					<input type="checkbox" name="hien_tieude" value="1" checked required="required">
				</div> -->

				<!-- <div class="col-md-5 form-group">
					<label for="">Ngày đăng </label>
					<input type="date" id="txt_ngaydang" name="ngaydang" value="<?php # date('Y-m-d') 
																				?>" required="required">
				</div>
				
				<div class="col-md-5 form-group">
					<label for="">Ngày kết thúc</label>
					<input type="date" id="txt_ngayketthuc" name="ngayketthuc">
				</div> -->

				<div class="col-md-12 form-group">
					<label for="">Hình ảnh</label>
					<input type="file" id="txt_hinhanh" value="" name="AVATAR" class="">
					<input type="hidden" name="imgaeBaiVietOld" value="<?= $baiDangOld[0]['anhTieuDe'] ?>">
					<img src="upload/media/images/<?= $baiDangOld[0]['anhTieuDe'] ?>" alt="Không hiển thị được hình" width="auto" height="100px">
				</div>
				<div class="col-md-12 form-group">
					<label>Nội dung</label>
					<textarea name="noidung" id="editor1" cols="30" rows="10" class="form-control" required="required"><?= $baiDangOld[0]['noiDung'] ?></textarea>
				</div>
				<div class="col-md-12 text-center">
					<button class="btn btn-success">Cập nhật</button>
					<button class="btn btn-default">Nhập lại</button>
				</div>

			</div>
		</form>
	</div>
</div>
<style type="text/css">
	select option:disabled {
		background: #eee;
	}
</style>

<script>
	$(document).ready(function() {
		$('input[required], select[required], textarea[required]').each(function() {
			console.log(this);
			$(this).parent().find('label').append('<span class="text-red">(*)</span>');
		});
		$('.select2').select2();

		CKEDITOR.replace('editor1', {
			language: 'vi',
			filebrowserBrowseUrl: 'node_modules/ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl: 'node_modules/ckfinder/ckfinder.html?type=Images',
			filebrowserFlashBrowseUrl: 'node_modules/ckfinder/ckfinder.html?type=Flash',
			filebrowserUploadUrl: 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl: 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			filebrowserFlashUploadUrl: 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
		});
	});

	const tieuDeEdit = document.getElementById('tieuDeEdit');
	const duongDanEdit = document.getElementById('duongDanEdit');

	tieuDeEdit.addEventListener('change', (e) => {
		let vl = e.target.value;
		if (vl != null && vl.length > 0) {
			duongDanEdit.value = slugify(vl)
		}
	})
</script>