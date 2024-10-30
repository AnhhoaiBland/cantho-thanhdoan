<!-- Modal -->
<div id="modaleditloaiVB" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<form action="admin/editloaitailieu" method="POST" id="frmeditloaiVB">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Cập nhật loại tài liệu</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<label>Loại tài liệu trên sẽ được cập nhật thành</label><label class="text-danger">(*)</label>
							<select class="form-control" name="maDanhMucTaiLieuUpdate" id="ds_loai_tl">
							</select>
						</div>

					</div>
					<div class="row">
						<div class="col-md-12">
							<label>Tên loại tài liệu</label><label class="text-danger">(*)</label>
							<input type="text" name="loaiTaiLieuUpdate" class="form-control" required="required">
						</div>

					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" form="frmeditloaiVB" class="btn btn-success">Cập nhật</button>
					<button type="button" class="btn btn-danger btn-xoaLoai" data-dismiss="modal">Xóa</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				</div>
			</div>
		</form>

	</div>
</div>

<script>
	$('.btn-xoaLoai').on('click', function() {
		Swal.fire({
			title: 'Xác nhận xóa',
			text: "Bạn có chắc muốn xóa loại tài liệu này?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			confirmButtonText: 'Xóa',
			cancelButtonText: 'Không xóa',
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: 'admin/xoaloaitailieu',
					type: 'POST',
					data: {
						id: $('#ds_loai_tl').val()
					},
					dataType: 'JSON',
					success: function(result) {
						if (result.status === 'success') {
							// Xóa thành công
							Swal.fire(
								'Đã xóa',
								result.message,
								'success',
							);
							// Cập nhật giao diện nếu cần
						} else {
							// Xóa không thành công
							Swal.fire(
								'Lỗi',
								result.message,
								'error',
							);
						}
					},
					error: function(request, status, error) {
						alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại.")
						// console.log(request.responseText, error);
					}
				})
			}
		})
	});
</script>