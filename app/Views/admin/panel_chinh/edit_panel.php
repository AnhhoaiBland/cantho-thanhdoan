<!-- Modal -->
<div id="modalEditpanel" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<form action="admin/sua_panel" method="POST" id="frmEditpanel">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">

					<h4 class="modal-title">Cập nhật panel</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id" id="txtId">
					<div class="form-group">
						<label for="">Chọn ảnh</label><br>
						<input type="file" name="url" class="form-control">
					</div>
					<div class="form-group">
						<label>Vị trí</label>
						<select name="viTri" id="selectVitri" class="form-control">
							<option value="1">Panel trang chủ</option>
							<option value="2">Panel cạnh</option>
						</select>
					</div>
					<div class="form-group">
						<input id="inputedit_CheckLink" type="checkbox" name="have_link">
						<label>Link</label>
						<input id="inputedit_Link" type="text" name="link" class="form-control d-none" placeholder="Nhập link...">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" form="frmEditpanel" class="btn btn-warning">Cập nhật</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>

	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#inputedit_CheckLink').change(function() {
			if (!$('#inputedit_CheckLink').prop('checked')) {
				console.log('tat checkbox');
				$('#inputedit_Link').addClass('d-none');
			} else {
				console.log('mo checkbox');
				$('#inputedit_Link').removeClass('d-none');
			}
		});
	});
</script>