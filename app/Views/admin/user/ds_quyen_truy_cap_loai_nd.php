<div class="row">
	<div class="col-md-12 form-group">
		<h3>Quản lý loại tài khoản</h3>
	</div>
</div>
<div class="row ">
	<div class="col-md-12 form-group">
		<button class="btn btn-success" data-toggle="modal" data-target="#modaladdlnd"><i class="fa fa-plus"></i> Thêm mới loại tài khoản</button>
	</div>
	<div class="col-md-12 bg-white p-2">

		<table class="table" id="datatable">
			<thead>
				<td>STT</td>
				<td>Tên loại tài khoản</td>
				<td>Mô tả</td>
				<td>Các quyền truy cập</td>
				<td>Action</td>
			</thead>
			<tbody>
				<?php

				$stt = 1;
				foreach ($ds_loaiND as $nguoidung) :
				?>
					<tr data-id="<?= $nguoidung['maLoaiND'] ?>">
						<td class="text-right"> <?php echo $stt++; ?> </td>
						<td> <?= $nguoidung['tenLoaiNguoiDung']  ?></td>
						<td> <?= $nguoidung['moTa']  ?></td>
						<td>Các quyền truy cập</td>
						<td class="text-right" style="min-width: 100px;">
							<button class="btn btn-outline-warning btnCapQuyenTruyCap"><i class="fas fa-dungeon"></i></button>
							<button class="btn btn-warning btnSua"><i class="fa fa-edit"></i></button>
							<button class="btn btn-danger btnXoa"><i class="fa fa-trash"></i></button>

						</td>
					</tr>
				<?php endforeach;
				?>
			</tbody>
		</table>
	</div>
</div>
<?php echo view('admin/user/modal_add_loai_nguoi_dung'); ?>

<script>
	$('.btnXoa').click(function() {
		Swal.fire({
			title: 'Xác nhận xóa',
			text: "Bạn có chắc muốn xóa loại tài khoản này?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			//cancelButtonColor: '#3085d6',
			confirmButtonText: 'Xóa',
			cancelButtonText: 'Không xóa',
		}).then((result) => {
			if (result.value) {
				node = $(this);
				$.ajax({
					url: 'admin/xoaloainguoidung',
					type: 'POST',
					dataType: 'JSON',
					data: {
						id: $(node).parents('tr').attr('data-id')
					},
					success: function(result) {
						if (result.status == 'success') {
							$(node).parents('tr').remove();
							Swal.fire(
								'Đã xóa',
								result.message,
								result.status,
							);
						} else {
							Swal.fire(
								'Thất bại',
								result.message,
								result.status,
							);
						}

					},
					error: function(request, status, error) {
						alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại.")
						console.log(request.responseText, error);
					}
				})

			}
		})
	});

	$('#formaddloaind').submit(function(e) {
		var formData = new FormData($('#formaddloaind')[0]);
		e.preventDefault();
		$.ajax({
			url: $(this).attr('action'),
			type: $(this).attr('method'),
			data: formData, //$(this).serialize(),
			dataType: 'JSON',
			processData: false,
			contentType: false,
			cache: false,
			success: function(result) {
				$('#modaladdlnd').modal('hide');
				if (result.status == 'success') {
					swal.fire('Thành công', result.message, result.status);

				} else {
					console.log(result.error);
					swal.fire('Thất bại', result.message, result.status);
				}
			}
		});
	});
</script>