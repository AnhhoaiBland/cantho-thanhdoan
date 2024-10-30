<!-- Modal -->
<div id="modalAdd" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<form action="admin/themmoitailieu" method="POST" id="frmAdd">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">

					<h4 class="modal-title">Thêm văn bản</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-8">
							<label>Số hiệu</label><label class="text-danger">(*)</label>
							<input type="text" name="soHieuTL" class="form-control" required="required">
						</div>
						<div class="col-md-12">
							<label>Tên tài liệu</label><label class="text-danger">(*)</label>
							<input type="text" name="tenTaiLieu" class="form-control" required="required">
						</div>

						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<label>Loại</label><label class="text-danger">(*)</label>
									<select name="maDanhMucTaiLieu" id="ds_loai_tl_new" class="form-control"></select>
								</div>

								<div class="col-md-6">
									<label>Thời gian ban hành</label><label class="text-danger">(*)</label>
									<input type="date" class="form-control" name="thoiGianBanHanh">
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<label>Ghi chú/ mô tả</label><label class="text-danger">(*)</label>
							<textarea name="moTa" class="form-control"></textarea>
						</div>

						<!-- <div class="col-md-4">
							<label>Trạng thái</label><label class="text-danger">(*)</label>
							<select name="trangthai" class="form-control">
								<option value="1" selected="selected">Còn hiệu lực</option>
								<option value="0">Hết hiệu lực</option>
							</select>
						</div> -->

						<div class="col-md-12">
							<label>Tải file</label><label class="text-danger">(*)</label>
							<input type="file" name="duongDanTaiVe" class="form-control" required="required">
						</div>

					</div>

				</div>
				<div class="modal-footer">
					<button type="reset" class="btn btn-default">Xóa</button>
					<button type="submit" form="frmAdd" class="btn btn-success">Thêm</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
				</div>
			</div>
		</form>

	</div>
</div>