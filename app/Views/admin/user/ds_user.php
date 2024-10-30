<style>
    /* Thêm CSS cho phần tìm kiếm */
    #datatable_filter {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 15px;
    }

    #datatable_filter label {
        display: flex;
        align-items: center;
        font-weight: bold;
        color: #333;
    }

    #datatable_filter input {
        margin-left: 10px;
        padding: 8px 12px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
        transition: border-color 0.3s ease;
    }

    #datatable_filter input:focus {
        border-color: #007bff;
        outline: none;
    }

    /* Điều chỉnh chiều rộng của ô tìm kiếm */
    #datatable_filter input {
        width: 250px;
    }

    /* Tùy chỉnh màu sắc cho nút lọc */
    .dataTables_length select {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 5px;
        margin-left: 10px;
        transition: border-color 0.3s ease;
    }

    .dataTables_length select:focus {
        border-color: #007bff;
        outline: none;
    }


	   /* Tùy chỉnh phần chuyển trang (pagination) */
	   .dataTables_paginate {
        display: flex;
        justify-content: center; /* Canh giữa các nút */
        margin-top: 20px;
    }

    .dataTables_paginate .pagination {
        display: flex;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .dataTables_paginate .pagination li {
        margin: 0 5px; /* Khoảng cách giữa các nút */
    }

    .dataTables_paginate .pagination li a {
        display: inline-block;
        padding: 8px 12px;
        color: #007bff;
        background-color: #f9f9f9;
        border: 1px solid #ddd; /* Viền cho các nút */
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }

    .dataTables_paginate .pagination li a:hover {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    .dataTables_paginate .pagination li.active a {
        background-color: #007bff; /* Màu nền của nút đang chọn */
        color: #fff;
        border-color: #007bff;
    }

    .dataTables_paginate .pagination li.disabled a {
        color: #ccc; /* Màu sắc của các nút vô hiệu hóa */
        background-color: #f1f1f1;
        border-color: #ddd;
        pointer-events: none; /* Không cho phép nhấn vào */
    }

    /* Tùy chỉnh màu nền của container pagination */
    .dataTables_paginate .pagination {
        background-color: #fff; /* Màu nền của vùng chứa pagination */
        border: 1px solid #ddd; /* Viền ngoài của vùng chứa pagination */
        border-radius: 4px;
        padding: 10px;
    }

    /* Thêm bóng đổ cho các nút */
    .dataTables_paginate .pagination li a {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Khi nút được chọn */
    .dataTables_paginate .pagination li.active a {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
	
</style>



<div class="row">
	<div class="col-md-12 form-group">
		<h3>Quản lý tài khoản</h3>
	</div>
</div>
<div class="row ">
	<?php if ($checkQuyen == '1') { ?>
		<div class="col-md-12 form-group">
			<button class="btn btn-success" data-toggle="modal" id="them_user" data-target="#modalAddUser"><i class="fa fa-plus"></i> Thêm tài khoản</button>
		</div>
	<?php } ?>

	<div class="col-md-12 bg-white p-2">

		<table class="table" id="datatable">
			<thead>
				<td>STT</td>
				<td>Tài khoản</td>
				<td>Tên</td>
				<?php if ($checkQuyen == '1') { ?>
					<td>Mật khẩu</td>
				<?php } ?>

				<td>Trạng thái</td>
				<td>Loại người dùng</td>
				<?php if ($checkQuyen == '1') { ?>
					<td>Action</td>
				<?php } ?>

			</thead>
			<tbody>
				<?php

				$stt = 1;
				foreach ($ds_user as $nguoidung) : ?>
					<tr data-id="<?= $nguoidung['maNguoiDung'] ?>">
						<td class="text-right"> <?= $stt++; ?> </td>
						<td> <?= $nguoidung['tenDangNhap'] ?> </td>
						<td><?= $nguoidung['hoVaTen'] ?></td>
						<?php if ($checkQuyen == '1') { ?>
							<td> <a href="javascript:;" class="btn_ChangePass">Đổi mật khẩu</a> </td>
						<?php } ?>

						<td> <?= $nguoidung['trangThai'] == 1 ? '<span class="text-success btnLock">Hoạt động</span>' : '<span class="text-danger btnUnlock">Ngừng hoạt động</span>' ?></td>
						<td><?= $nguoidung['tenLoaiNguoiDung'] ?></td>
						<?php if ($checkQuyen == '1') { ?>
							<td class="text-right" style="min-width: 100px;">
								<button class="btn btn-warning btnSua"><i class="fa fa-edit"></i></button>
								<button class="btn btn-danger btnXoa"><i class="fa fa-trash"></i></button>

							</td>
						<?php } ?>

					</tr>
				<?php endforeach; ?>

			</tbody>
		</table>
	</div>
</div>
<?php echo view('admin/user/modal_add_user'); ?>
<?php echo view('admin/user/modal_change_pass'); ?>
<?php echo view('admin/user/modal_edit_user'); ?>
<script>
	$('#them_user').click(function() {
		let seleLoaiND = $('#dsloaitaikhoan');
		$.ajax({
			url: 'admin/ajax_laydsloainguoidung',
			type: 'POST',
			dataType: 'JSON',
			success: function(response) {
				if (response.status === 'success') {
					// Xóa các option cũ trong select trước khi thêm mới
					seleLoaiND.empty();

					// Duyệt qua mảng dữ liệu và thêm option vào select
					response.dataresult.forEach(function(element) {
						seleLoaiND.append('<option value="' + element.maLoaiND + '">' + element.tenLoaiNguoiDung + '</option>');
					});
				} else {
					console.log('Lỗi khi lấy dữ liệu');
				}
			},
			error: function(request, status, error) {
				alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại.")
				console.log(request.responseText, error);
			}
		})
	});

	function reload_maintable() {
		$.ajax({
			url: 'admin/ajax_ds_taikhoan',
			type: 'GET',
			dataType: 'JSON',
			success: function(result) {
				console.log(result);
				for (i = 0; i < result.length; i++) {
					console.log(result[i].data);
				}
			},
			error: function(request, status, error) {
				alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại.")
				console.log(request.responseText, error);
			}
		});
	}
	$(document).ready(function() {
		$('#datatable').dataTable({
			"language": {
				"url": "assets/datatable/Vietnamese.json"
			}
		});

		<?php if ($checkQuyen == '1') { ?>
			$('.btnLock').click(function() {
				Swal.fire({
					title: 'Xác nhận',
					text: "Bạn có chắc muốn khóa tài khoản này?",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#d33',
					//cancelButtonColor: '#3085d6',
					confirmButtonText: 'Khóa',
					cancelButtonText: 'Không khóa',
				}).then((result) => {
					if (result.value) {
						node = $(this);
						$.ajax({
							url: 'admin/lock_user',
							type: 'POST',
							data: {
								id: $(node).parents('tr').attr('data-id')
							},
							dataType: 'JSON',
							success: function(result) {

								if (result.status == 'success') {
									$(node).parents('tr').remove();
									Swal.fire(
										'Đã khóa',
										result.content,
										result.status,
									);
								} else {
									Swal.fire(
										'khóa không thành công',
										result.content,
										result.status,
									);
								}
								// reload_maintable();
								window.location.reload();
							},
							error: function(request, status, error) {
								alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại.")
								console.log(request.responseText, error);
							}
						})

					}
				})

			});

			$('.btnUnlock').click(function() {
				Swal.fire({
					title: 'Xác nhận',
					text: "Bạn có chắc muốn mở khóa cho tài khoản này?",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#d33',
					//cancelButtonColor: '#3085d6',
					confirmButtonText: 'Mở khóa',
					cancelButtonText: 'Không mở khóa',
				}).then((result) => {
					if (result.value) {
						node = $(this);
						$.ajax({
							url: 'admin/unlock_user',
							type: 'POST',
							data: {
								id: $(node).parents('tr').attr('data-id')
							},
							dataType: 'JSON',
							success: function(result) {

								if (result.status == 'success') {
									$(node).parents('tr').remove();
									Swal.fire(
										'Đã mở khóa',
										result.content,
										result.status,
									);
								} else {
									Swal.fire(
										'Mở khóa không thành công',
										result.content,
										result.status,
									);
								}
								window.location.reload();
							},
							error: function(request, status, error) {
								alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại.")
								console.log(request.responseText, error);
							}
						})

					}
				})

			});

			$('.btn_ChangePass').click(function() {
				var row = $(this).parents('tr');
				var id = $(row).attr('data-id');
				var username = row.find('td').eq(1).text(); 

				$('#hid_username').val(id);
				$('#txt_username').val(username);
				$('#modalChangePass').modal('show');

			});

		<?php } ?>




		$(".btnSua").click(function() {
			let seleLoaiND = $('#dsloaitaikhoanedit');
			let node = $(this); // Khai báo biến node một cách cụ thể

			// Gửi yêu cầu AJAX để lấy thông tin cập nhật
			$.ajax({
				url: 'admin/ajax_laythongtincapnhat',
				type: 'POST',
				data: {
					id: $(node).parents('tr').attr('data-id')
				},
				dataType: 'json',
				success: function(response) {
					console.log(response)
					if (response.status === 'success') {
						$('#id_nd').val(response.thongTinCN[0].maNguoiDung);
						$('#tentk').val(response.thongTinCN[0].tenDangNhap);
						$('#hoTen').val(response.thongTinCN[0].hoVaTen);
						seleLoaiND.empty();
						// Duyệt qua danh sách loại người dùng và thêm vào dropdown
						response.dsLoaiND.forEach(function(element) {
							let option = '<option value="' + element.maLoaiND + '"';
							if (element.maLoaiND == response.thongTinCN[0].maLoaiND) {
								option += ' selected';
							}
							option += '>' + element.tenLoaiNguoiDung + '</option>';
							seleLoaiND.append(option);
						});
					} else {
						console.log('Lỗi khi lấy dữ liệu');
					}
					$('#modaleditUser').modal('show');
				},
				error: function(request, status, error) {
					// Hiển thị thông báo lỗi cụ thể
					alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại.");
					console.log(request.responseText, error);
				}
			});
		});



		$('#frmChangePass').submit(function(e) {
			e.preventDefault();

			// Lấy giá trị mật khẩu từ các input
			var pass = $(this).find('input[name=new_password]').val();
			var pass2 = $(this).find('input[name=new_password2]').val();

			// Kiểm tra xem hai mật khẩu có giống nhau không
			if (pass !== pass2) {
				alert('Mật khẩu không giống nhau');
				return false;
			}

			// Tạo đối tượng FormData để gửi dữ liệu
			var formData = new FormData(this);

			// Gửi AJAX request
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				data: formData,
				dataType: 'json',
				contentType: false, // Không sử dụng contentType mặc định
				processData: false, // Không xử lý dữ liệu trước khi gửi
				success: function(result) {
					if (result.status == 'success') {
						Swal.fire(
							'Thành công',
							result.content,
							result.status
						);
						$('#modalChangePass').modal('hide');
					} else {
						Swal.fire(
							'Thất bại',
							result.content,
							result.status
						);
					}
				},
				error: function(request, status, error) {
					alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại.");
					console.log(request.responseText, error);
				}
			});
		});



		$('#frmAddUser').submit(function(e) {
			e.preventDefault();
			pass = $(this).find('input[name=new_password]').val();
			pass2 = $(this).find('input[name=new_password2]').val();
			if (pass !== pass2) {
				//Truong hop 2 password khac nhau
				// alert('Mật khẩu không giống nhau');
				return false;
			} else {
				$.ajax({
					url: $(this).attr('action'),
					type: $(this).attr('method'),
					data: $(this).serialize(),
					dataType: 'JSON',
					success: function(result) {
						if (result.status == 'success') {
							Swal.fire(
								'Thành công',
								result.content,
								result.status,
							);
						} else {
							Swal.fire(
								'Thất bại',
								result.content,
								result.status,
							);
						}
						$("#modalAddUser").modal('hide');
					},
					error: function(request, status, error) {
						alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại.")
						$("#modalAddUser").modal('hide');
						console.log(request.responseText, error);
					}
				})
			}
		});

		$('#frmEditUser').submit(function(e) {
			e.preventDefault();
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				data: $(this).serialize(),
				dataType: 'JSON',
				success: function(result) {
					if (result.status == 'success') {
						Swal.fire(
							'Thành công',
							result.content,
							result.status,
						);
					} else {
						Swal.fire(
							'Thất bại',
							result.content,
							result.status,
						);
					}
					$("#modaleditUser").modal('hide');
				},
				error: function(request, status, error) {
					alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại.")
					$("#modaleditUser").modal('hide');
					console.log(request.responseText, error);
				}
			})
		});

		$('.btnXoa').click(function() {
			Swal.fire({
				title: 'Xác nhận xóa',
				text: "Bạn có chắc muốn xóa người dùng này?",
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
						url: 'admin/del_user',
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
									result.content,
									result.status,
								);
							} else {
								Swal.fire(
									'Thất bại',
									result.content,
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
	});
</script>