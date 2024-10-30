<!-- Modal -->
<div id="modalEdit" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<form action="admin/capnhattailieu" method="POST" id="frmEdit">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">

					<h4 class="modal-title">Cập nhật văn bản</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-8">
							<input type="hidden" name="idtailieu" id="idtailieu" class="form-control" required="required">
							<label>Số hiệu</label><label class="text-danger">(*)</label>
							<input type="text" name="soHieuTL" id="so_hieu_TL" class="form-control" required="required">
						</div>
						<div class="col-md-12">
							<label>Tên tài liệu</label><label class="text-danger">(*)</label>
							<input type="text" name="tenTaiLieu" id="ten_tai_lieu_edit" class="form-control" required="required">
						</div>

						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<label>Loại</label><label class="text-danger">(*)</label>
									<select name="maDanhMucTaiLieu" id="ds_loai_tl_edit" class="form-control"></select>
								</div>
								<div class="col-md-6">
									<label>Thời gian ban hành</label><label class="text-danger">(*)</label>
									<input type="date" class="form-control" id="thoi_Gian_Ban_Hanh" name="thoiGianBanHanh">
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<label>Ghi chú/ mô tả</label><label class="text-danger">(*)</label>
							<textarea name="moTa" id="mo_ta" class="form-control"></textarea>
						</div>

						<!-- <div class="col-md-4">
							<label>Trạng thái</label><label class="text-danger">(*)</label>
							<select name="trangthai" class="form-control">
								<option value="1" selected="selected">Còn hiệu lực</option>
								<option value="0">Hết hiệu lực</option>
							</select>
						</div> -->

						<div class="col-md-12">
							<label>Tải file</label><label class="text-danger">(*)</label> <span id="mEdit_url" class="ml-2">sd</span>
							<input type="file" name="duongDanTaiVe" class="form-control">
							<input type="hidden" name="fileold" id="fileold">
						</div>

					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" form="frmEdit" class="btn btn-success">Cập nhật</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				</div>
			</div>
		</form>

	</div>
</div>