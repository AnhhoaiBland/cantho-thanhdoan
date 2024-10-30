<!-- Modal -->
<div id="modalEditTacvu" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<form action="/admin/capnhattacvu" method="POST" id="frmEditCategory">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">

					<h4 class="modal-title">Cập nhật tác vụ</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Tên tác vụ</label>
						<input type="text" name="tenTacVu" class="form-control" id="txt_TenEdit">
						<input type="hidden" name="id" id="txt_IdEdit">
					</div>
					<div class="form-group">
						<label for="">Đường dẫn đến tác vụ</label>
						<input type="text" name="urlTacVu" class="form-control" id="txt_AliasEdit">
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" form="frmEditCategory" class="btn btn-warning">Cập nhật</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>

	</div>
</div>
