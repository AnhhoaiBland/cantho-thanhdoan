<!-- Modal -->
<div id="modalAddloaiVB" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<form action="admin/addloaitailieu" method="POST" id="frmAddloaiVB">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title">Thêm loại tài liệu</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<label>Loại tài liệu</label><label class="text-danger">(*)</label>
						<input type="text" name="loaiTaiLieu" class="form-control" required="required">
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="submit" form="frmAddloaiVB" class="btn btn-success">Thêm</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
			</div>
		</div>
		</form>
	</div>
</div>