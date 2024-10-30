<div class="row">	
	<div class="col-md-12 form-group">	
		<h3>Cập nhật sản phẩm</h3>
	</div>
</div>
<form action="admin/edit2_sanpham/<?=$sanpham->get('SP_ID') ?>" method="POST" style="width:100%" enctype="multipart/form-data">
<div class="row bg-white p-3">
	<div class="col-md-3 form-group">
		<label for="">Hình ảnh</label>
					<input type="file" id="txt_hinhanh" name="hinhanh" class="d-none" > <br>
					<img id="img_hinhanh" src="media/images/<?= $sanpham->get('SP_HINH_ANH') ?>" alt ="Không hiển thị được hình" width = "100%">
	</div>
	<div class="col-md-9">
		<div class="row">
			<div class="col-md-12 form-group">
				<label>Tên sản phẩm</label>
				<input type="text" name="tieude" class="form-control" value="<?=$sanpham->get('SP_TEN') ?> "	>
			</div>
			<div class="col-md-12 form-group">
				<label>Bài viết về sản phẩm</label>
				<select name="baiviet" id="sel_baiviet" class="form-control select2" placeholder="Chưa chọn bài viết..">
					<option></option>
					<?php foreach ($ds_baiviet as $baiviet): ?>
						<?php if ($baiviet->get('BV_ID') == $sanpham->get('SP_BAI_VIET')): ?>
							<option value="<?=$baiviet->get('BV_ID') ?>" selected><?=$baiviet->get('BV_TIEU_DE') ?></option>
						<?php else: ?>
							<option value="<?=$baiviet->get('BV_ID') ?>"><?=$baiviet->get('BV_TIEU_DE') ?></option>
						<?php endif ?>
					<?php endforeach ?>
				</select>
				<!-- <input type="text" name="baiviet" class="form-control" value="<?=$sanpham->get('SP_TEN') ?> "	> -->
			</div>
			<div class="col-md-4">
				<input type="checkbox" id="chk_spmoi" name="sp_moi" <?php if($sanpham->get('SP_MOI')==1) echo 'checked' ?> style="margin-right: 15px">
				<label for="#chk_spmoi">Sản phẩm mới</label>
			</div>
			<div class="col-md-4">
				<input type="checkbox" id="chk_spbanchay" name="sp_banchay" <?php if($sanpham->get('SP_BAN_CHAY')==1) echo 'checked' ?> style="margin-right: 15px">
				<label for="#chk_spmoi">Sản phẩm bán chạy</label>
			</div>
			<div class="col-md-4">
				<label for="">Ngày đăng </label>
				<div class="pull-right">
					
					<input type="date" id="txt_ngaydang" name ="ngaydang" value="<?= date('Y-m-d',strtotime($sanpham->get('SP_NGAY_TAO'))); ?>">
				</div>
				
			</div>
			<div class="col-md-12 form-group">
				<label>Nội dung</label>
				<textarea name="noidung" id="editor1" cols="30" rows="10" class="form-control"><?= $sanpham->get('SP_MO_TA') ?></textarea>
			</div>
			<div class="col-md-12 text-center">
				<button class="btn btn-success">Cập nhật</button>
				<a href="admin/ds_sanpham" class="btn btn-default">Quay lại</a>
			</div>
		</div>
	</div>
</div>
</form>
<script>
	$(document).ready(function(){
		CKEDITOR.replace( 'editor1' ,
			{
				language: 'vi',
				filebrowserBrowseUrl : 'node_modules/ckfinder/ckfinder.html',
				filebrowserImageBrowseUrl : 'node_modules/ckfinder/ckfinder.html?type=Images',
				filebrowserFlashBrowseUrl : 'node_modules/ckfinder/ckfinder.html?type=Flash',
				filebrowserUploadUrl : 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
				filebrowserImageUploadUrl : 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				filebrowserFlashUploadUrl : 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
			}
		);

		$('#img_hinhanh').click(function(){
			$('#txt_hinhanh').click();
		});
		$('#txt_hinhanh').change(function(){
			readURL(this,'img_hinhanh');
			//$('#img_hinhanh').prop('src',$(this).val());
		});

		$('#sel_baiviet').select2({
			placeholder: 'Chưa chọn bài viết...',
			allowClear: true,
		});
	});
	function readURL(input, image_id) {
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    
	    reader.onload = function(e) {
	      $('#'+image_id).attr('src', e.target.result);
	    }
	    
	    reader.readAsDataURL(input.files[0]); // convert to base64 string
	  }
	}
</script>
