<div class=" mt-3">
	<div class="row">
		<div class="col-md-12 mb-3">
			<h3 class="text-primary fw-bold">Quản lý loại tài khoản</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 mb-3">
			<button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modaladdlnd">
				<i class="fa fa-plus"></i> Thêm mới loại tài khoản
			</button>
		</div>
		<div class="col-md-12 bg-white p-3 rounded shadow">
			<table class="table table-striped table-hover" id="datatable">
				<thead class="bg-primary text-white">
					<tr>
						<th scope="col">STT</th>
						<th scope="col">Tên loại tài khoản</th>
						<th scope="col">Mô tả</th>
						<th scope="col">Các quyền truy cập</th>
						<th scope="col">Hành động</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$stt = 1;
					foreach ($ds_loaiND as $nguoidung) :
					?>
						<tr data-id="<?= $nguoidung->maLoaiND ?>">
							<td class="text-end"> <?php echo $stt++; ?> </td>
							<td id="tenLoai"> <?= $nguoidung->tenLoaiNguoiDung ?></td>
							<td> <?= $nguoidung->moTa ?></td>
							<td>
								<ul>
									<?php if (is_array($nguoidung->list_tacvu)) : ?>
										<?php foreach ($nguoidung->list_tacvu as $tacvu) : ?>
											<li><?= $tacvu['tenChucNang'] ?></li>
										<?php endforeach; ?>
									<?php endif; ?>
								</ul>
							</td>
							<td class="text-end" style="min-width: 150px;">
								<button class="btn btn-outline-primary btn-sm btnCapQuyenTruyCap">
									<i class="fas fa-key"></i>
								</button>
								<button class="btn btn-warning btn-sm btnSua">
									<i class="fa fa-edit"></i>
								</button>
								<button class="btn btn-danger btn-sm btnXoa">
									<i class="fa fa-trash"></i>
								</button>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php echo view('admin/user/modal_add_loai_nguoi_dung'); ?>
<?php echo view('admin/user/modal_edit_loai_nguoi_dung'); ?>
<?php echo view('admin/user/modal_edit_quyen_truy_cap_tac_vu'); ?>

<script>
	$(document).ready(function () {
		$('.btnSua').click(function () {
			var row = $(this).parents('tr');
			var id = $(row).attr('data-id');
			var username = row.find('td').eq(1).text();
			$.ajax({
				url: 'admin/ajax_laythongtinloainguoidung',
				type: 'POST',
				data: {
					id: id
				},
				dataType: 'JSON',
				success: function (result) {
					if (result.status == 'success') {
						$('#maloaindold').val(result.dataresult[0].maLoaiND);
						$('#tenLoaind').val(username);
						$('#moTaloaind').val(result.dataresult[0].moTa);
						$('#modaleditlnd').modal('show');
					}
				}
			})
		});

		$('.btnCapQuyenTruyCap').click(function () {
			var row = $(this).parents('tr');
			var id = $(row).attr('data-id');
			$.ajax({
				url: 'admin/ajax_ldstacvu',
				type: 'POST',
				dataType: 'JSON',
				data: {
					id: id
				},
				success: function (result) {
					if (result.status == 'success') {
						console.log(result.nhom_quyen_hien_co);
						$('#id_loaind').val(id);
						$('#ten_loaind').val($('#tenLoai').html());
						var dropdown = $('#multiple-select-field');
						dropdown.empty();

						result.databstacvu.forEach((element) => {
							var isSelected = result.nhom_quyen_hien_co.some((QuyenOld) => QuyenOld.maNhom === element.maNhom);
							var option = $('<option>', {
								value: element.maNhom,
								text: element.tenNhom,
								selected: isSelected
							});
							dropdown.append(option);
						});

						$('#modalquyentruycaptacvu').modal('show');
					}
				}
			})
		});

		$('.btnXoa').click(function () {
			Swal.fire({
				title: 'Xác nhận xóa',
				text: "Bạn có chắc muốn xóa loại tài khoản này?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
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
						success: function (result) {
							if (result.status == 'success') {
								$(node).parents('tr').remove();
								Swal.fire('Đã xóa', result.message, result.status);
							} else {
								Swal.fire('Thất bại', result.message, result.status);
							}
						},
						error: function (request, status, error) {
							alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại.")
							console.log(request.responseText, error);
						}
					})
				}
			})
		});

		$('#formeditloaind').submit(function (e) {
			var formData = new FormData($('#formeditloaind')[0]);
			e.preventDefault();
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				data: formData,
				dataType: 'JSON',
				processData: false,
				contentType: false,
				cache: false,
				success: function (result) {
					$('#modaleditlnd').modal('hide');
					if (result.status == 'success') {
						swal.fire('Thành công', result.message, result.status);
					} else {
						console.log(result.error);
						swal.fire('Thất bại', result.message, result.status);
					}
					window.location.reload();
				}
			});
		});

		$('#formaddloaind').submit(function (e) {
			var formData = new FormData($('#formaddloaind')[0]);
			e.preventDefault();
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				data: formData,
				dataType: 'JSON',
				processData: false,
				contentType: false,
				cache: false,
				success: function (result) {
					$('#modaladdlnd').modal('hide');
					if (result.status == 'success') {
						swal.fire('Thành công', result.message, result.status);
					} else {
						console.log(result.error);
						swal.fire('Thất bại', result.message, result.status);
					}
					window.location.reload();
				}
			});
		});

		$('#formeditquyntruycaptacvu').submit(function (e) {
			let formData = new FormData($('#formeditquyntruycaptacvu')[0]);

			let selectedValues = $('#multiple-select-field').val();
			let tenLoaind = $('#ten_loaind').val();
			let idLoaind = $('#id_loaind').val();
			e.preventDefault();
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				data: {
					id_loaind: idLoaind,
					ten_loaind: tenLoaind,
					selected_Values: selectedValues
				},
				dataType: 'JSON',
				success: function (result) {
					$('#modalquyentruycaptacvu').modal('hide');
					if (result.status == 'success') {
						swal.fire('Thành công', result.message, result.status);
					} else {
						console.log(result.error);
						swal.fire('Thất bại', result.message, result.status);
					}
					window.location.reload();
				}
			});
		});
	})
</script>

<style>
	body {
		background-color: #f0f4f8;
	}

	.table th {
		font-weight: bold;
		text-transform: uppercase;
	}

	.table-hover tbody tr:hover {
		background-color: #e8f7ff;
	}

	.btn {
		font-size: 14px;
	}

	.btn-primary {
		background-color: #007bff;
		border-color: #007bff;
	}

	.btn-outline-primary {
		color: #007bff;
		border-color: #007bff;
	}

	.btn-outline-primary:hover {
		background-color: #007bff;
		color: white;
	}
</style>
