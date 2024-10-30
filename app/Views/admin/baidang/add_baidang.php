<div class="row">
	<div class="col-md-12">
		<h3>Thêm Bài Viết</h3>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<form action="admin/save_baidang" method="POST" style="width:100%" enctype="multipart/form-data">
			<div class="row">

				<div class="col-md-12 form-group">
					<label>Tiêu đề</label>
					<input type="text" name="tieude" id="tieuDe" class="form-control" required="required">
				</div>
				<div class="col-md-7 form-group">
					<label>Đường dẫn bài viết</label>
					<input type="text" id="duongDan" name="urlBaiDang" class="form-control" required="required">
				</div>
				<div class="col-md-7 form-group">
					<label>Mục Tin</label>
					<select name="category" class="form-control" required="required">
						<?php foreach ($ds_category as $category) : ?>
							<option value="<?= $category['maChuyenMuc'] ?>"><?= $category['tenChuyenMuc'] ?></option>
						<?php endforeach ?>
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
					<input type="file" id="txt_hinhanh" name="AVATAR" class="">
				</div>
				<div class="col-md-12 form-group">
					<label>Nội dung</label>
					<textarea name="noidung" id="editor1" cols="30" rows="10" class="form-control" required="required"></textarea>
				</div>
				<div class="col-md-12 text-center">
					<button class="btn btn-success">Đăng tin</button>
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

	const tieuDe = document.getElementById('tieuDe');
	const duongDan = document.getElementById('duongDan');

	tieuDe.addEventListener('change', (e) => {
		let vl = e.target.value;
		if (vl != null && vl.length > 0) {
			duongDan.value = slugify(vl)
		}
	})
</script>