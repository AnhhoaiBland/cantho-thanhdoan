<div class="row">	
	<div class="col-md-12">	
		<h3>Thêm Sản phẩm</h3>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<form action="admin/add2_sanpham" method="POST" style="width:100%" enctype="multipart/form-data">
			<div class="row">
			
				<!-- <div class="col-md-12 form-group">
					<span>Mục Tin</span>
					<select name="category"class="form-control">
						<?php foreach ($ds_category as $category) : ?>
							<option value="<?=$category->get('CAT_ID') ?>"><?=$category->get('CAT_NAME') ?></option>
						<?php endforeach ?>
					</select>
				</div> -->
				<div class="col-md-12 form-group">
					<span>Tiêu đề</span>
					<input type="text" name="tieude" class="form-control">
				</div>
				<!-- <div class="col-md-12 form-group">
					<span>Hiện tiêu đề:</span>
					<input type="checkbox" name="hien_tieude" value="1" checked>
				</div> -->
				
				<!-- <div class="col-md-12 form-group">
					<label for="">Ngày kết thúc</label>
					<input type="date" id="txt_ngayketthuc" name ="ngayketthuc">
				</div> -->
				<div class="col-md-4">
					<input type="checkbox" id="chk_spmoi" name="sp_moi" checked="checkbox" style="margin-right: 15px">
					<label for="#chk_spmoi">Sản phẩm mới</label>
				</div>
				<div class="col-md-4">
					<input type="checkbox" id="chk_spmoi" name="sp_banchay" style="margin-right: 15px">
					<label for="#chk_spmoi">Sản phẩm bán chạy</label>
				</div>
				<div class="col-md-4">
					<label for="">Ngày đăng </label>
					<div class="pull-right">
						<input type="date" id="txt_ngaydang" name ="ngaydang" value="<?= date('Y-m-d') ?>">	
					</div>
					
				</div>
				<div class="col-md-12 form-group">
					<label for="">Hình ảnh</label>
					<input type="file" id="txt_hinhanh" name="hinhanh" class="hidden" >
				</div>
				<div class="col-md-12 form-group">
					<span>Mô tả sản phẩm</span>
					<textarea name="noidung" id="editor1" cols="30" rows="10" class="form-control"></textarea>
				</div>
				<div class="col-md-12 text-center">
					<button class="btn btn-success">Đăng sản phẩm</button>
					<button class="btn btn-default">Nhập lại</button>
				</div>
			
			</div>
		</form>
	</div>	
</div>
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
	});
</script>