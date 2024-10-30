<!-- Modal -->
<div id="modalAddpaneledit" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<form action="admin/add_panel" method="POST" id="frmAddpanel" enctype="multipart/form-data">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">

					<h4 class="modal-title">Thêm panel</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Hình ảnh</label>
						<input type="file" name="url-img" class="form-control" required="required">
					</div>
					<div class="form-group">
					
						<div class="form-group">
							<label>Vị trí</label>
							<select name="viTri" id=""  class="form-control">
								<option value="1">Panel trang chủ</option>
								<option value="2">Panel cạnh</option>
							</select>
						</div>
						<div class="form-group">
							<input id="input_CheckLink" type="checkbox" name="have_link">
							<label>Link</label>
							<input id="input_Link" type="text" name="link" class="form-control d-none" placeholder="Nhập link...">
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" form="frmAddpanel" class="btn btn-success">Thêm</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
					</div>
				</div>
		</form>

	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#input_CheckLink').change(function() {
			if (!$('#input_CheckLink').prop('checked')) {
				console.log('tat checkbox');
				$('#input_Link').addClass('d-none');
			} else {
				console.log('mo checkbox');
				$('#input_Link').removeClass('d-none');
			}
		});
	});
</script>