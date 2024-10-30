<style>
	/* #block_them_nhom{
		display: none;
	} */
</style>
<div class="row">
	<div class="col-md-12">
		<h3>Quản lý nhóm chức năng "Nhóm quyền"</h3>
	</div>
</div>
<div class="row ">
	<div class="col-md-12 bg-white p-2">
		<div class="form-group">
			<button class="btn btn-success" id="mo_block_them_nhom"><i class="fa fa-plus"></i>Thêm mới nhóm quyền</button>
		</div>

		<div class="row p-3" id="block_them_nhom">
			<div class="col-md-3">
				<input type="text" id="ten_nhomQ" placeholder="Tên nhóm quyền" class="form-control">
			</div>
			<div class="col-md-4">
				<input type="text" id="mo_TaQ" placeholder="Mô tả" class="form-control">
			</div>
			<button id="tao_nhom" class="btn btn-danger">Tạo nhóm</button>
		</div>

		<div class="row p-3" id="block_edit_nhom">
			<div class="col-md-3">
				<input type="text" id="ten_nhomQ_edit" placeholder="Tên nhóm quyền" class="form-control">
				<input type="hidden" id="id_nhomQ_edit" class="form-control">

			</div>
			<div class="col-md-4">
				<input type="text" id="mo_TaQ_edit" placeholder="Mô tả" class="form-control">
			</div>
			<button id="edit_nhom" class="btn btn-danger">Cập nhật</button>
		</div>

		<table class="table table-bordered" id="datatable">
			<thead>
				<td>Stt</td>
				<td>Mã nhóm</td>
				<td>Tên nhóm quyền</td>
				<td>Mô tả</td>
				<td>Action</td>
			</thead>
			<tbody>
				<?php $stt = 1;
				foreach ($ds_tacvu as $tacvu) : ?>
					<tr data-id="<?= $tacvu['maNhom'] ?>" data-tt-id="<?= $tacvu['maNhom'] ?>" <?php if (isset($category['CAT_PARENT_ID']) && $category['CAT_PARENT_ID'] != NULL) echo 'data-tt-parent-id="' . $category['CAT_PARENT_ID'] . '"' ?>>
						<td> <?= $stt++ ?> </td>
						<td> <?= $tacvu['maNhom'] ?> </td>
						<td> <?= $tacvu['tenNhom'] ?> </td>
						<td> <?= $tacvu['moTa'] ?> </td>
						<td class="text-right">
							<a href="<?php echo base_url("admin/them_quyen_cho_nhom/{$tacvu['maNhom']}") ?>" class="btn btn-outline-warning "><i class="fas fa-dungeon"></i></a>
							<button class="btn btn-warning btnSua"><i class="fa fa-edit"></i></button>
							<button class="btn btn-danger btnXoa"><i class="fa fa-trash"></i></button>

						</td>
					</tr>
				<?php endforeach; ?>

			</tbody>
		</table>
	</div>
</div>
<?php echo view('admin/tacvu/add_tacvu'); ?>
<?php echo view('admin/tacvu/edit_tacvu');
?>

<script>
	$(document).ready(function() {
		$("#block_them_nhom").hide()
		$("#block_edit_nhom").hide()

		$('#datatable').treetable({
			expandable: true,
		});
		var table = $('#datatable').DataTable({
			"language": {
				"url": "assets/datatable/Vietnamese.json"
			},
			"iDisplayLength": 25,
		});
		let stt = false;
		$('#mo_block_them_nhom').on('click', function() {
			stt = !stt;
			if (stt) $("#block_them_nhom").show();
			else $("#block_them_nhom").hide();

		})

		$('#tao_nhom').on('click', function() {
			let tenNhomQ = $('#ten_nhomQ').val();
			let moTaQ = $('#mo_TaQ').val();

			$.ajax({
				url: 'admin/them_moi_nhom_quyen',
				type: 'POST',
				data: {
					ten_NhomQ: tenNhomQ,
					mo_TaQ: moTaQ
				},
				dataType: 'JSON',
				success: function(result) {
					if (result.status === 'success') {
						Swal.fire(
							'Đã thêm',
							result.message,
							result.status
						);

					} else {
						Swal.fire(
							'thêm không thành công',
							result.message,
							result.status
						);
					}

					window.location.reload();
				},
				error: function(request, status, error) {
					alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại. ");
					// console.log(request.responseText, error);
				}
			});
		})

		$('.btnXoa').on('click', function() {
			node = $(this);
			Swal.fire({
				title: 'Xác nhận xóa',
				text: "Bạn có chắc muốn xóa tác vụ này?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				confirmButtonText: 'Xóa',
				cancelButtonText: 'Không xóa',
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: 'admin/xoa_nhom_quyen',
						type: 'POST',
						data: {
							id: $(node).parents('tr').attr('data-id')
						},
						dataType: 'JSON',
						success: function(result) {
							console.log(result);
							if (result.status === 'success') {
								Swal.fire(
									'Đã xóa',
									result.message,
									result.status
								);
								$(node).parents('tr').remove();
							} else {
								Swal.fire(
									'Xóa không thành công',
									result.message,
									result.status
								);
							}
						},
						error: function(request, status, error) {
							alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại. ");
							// console.log(request.responseText, error);
						}
					});
				}
			});
		});


		let stt_edit = false;
		$(".btnSua").click(function() {
			// Lấy mã nhóm, tên nhóm và mô tả từ dòng tương ứng
			var maNhom = $(this).closest('tr').data('id');
			var tenNhom = $(this).closest('tr').find('td:nth-child(3)').text();
			var moTa = $(this).closest('tr').find('td:nth-child(4)').text();

			// Set giá trị vào các phần tử input trong div block_edit_nhom
			$('#id_nhomQ_edit').val(maNhom);
			$('#ten_nhomQ_edit').val(tenNhom);
			$('#mo_TaQ_edit').val(moTa);

			// Hiển thị div block_edit_nhom
			$("#block_edit_nhom").show();
		});

		$('#edit_nhom').click(function() {
			let maNhom = $('#id_nhomQ_edit').val();
			let tenNhomQ = $('#ten_nhomQ_edit').val();
			let moTaQ = $('#mo_TaQ_edit').val();

			$.ajax({
				url: 'admin/capNhat_nhom_quyen',
				type: 'POST',
				data: {
					ma_Nhom: maNhom,
					ten_NhomQ: tenNhomQ,
					mo_TaQ: moTaQ
				},
				dataType: 'JSON',
				success: function(result) {
					if (result.status === 'success') {
						Swal.fire(
							'Đã Cập nhật',
							result.message,
							result.status
						);

					} else {
						Swal.fire(
							'Cập nhật không thành công',
							result.message,
							result.status
						);
					}

					window.location.reload();
				},
				error: function(request, status, error) {
					alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại. ");
					// console.log(request.responseText, error);
				}
			});
		})


		$('#btnSua_nhom').click(function() {
			var row = $(this).parents('tr');
			var id = $(row).attr('data-id');
			$.ajax({
				url: 'admin/ajax_laythongtintacvu',
				type: 'POST',
				data: {
					id: id
				},
				dataType: 'JSON',
				success: function(result) {

					$('#txt_IdEdit').val(result[0].maChucNang);
					$('#txt_TenEdit').val(result[0].tenChucNang);
					$('#txt_AliasEdit').val(result[0].urlChucNang);

					$('#modalEditTacvu').modal('show');
				}
			})
		});
		$('#frmAdd').submit(function(e) {
			var formData = new FormData($('#frmAdd')[0]);
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
					console.log(result);
					$('#modalAdd').modal('hide');
					if (result.status == 'success') {
						swal.fire('Thành công', result.message, result.status);

					} else {
						swal.fire('Thất bại', result.message, result.status);
					}
					window.location.reload();
				}
			});
		});

		$('#frmEditCategory').submit(function(e) {
			var formData = new FormData($('#frmEditCategory')[0]);
			e.preventDefault();
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				data: formData, //$(this).serialize(),
				dataType: 'JSON',
				processData: false,
				contentType: false,
				success: function(result) {
					$('#modalEditTacvu').modal('hide');
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


		$('.btnCapQuyenTruyCap').click(function() {
			var row = $(this).parents('tr');
			var id = $(row).attr('data-id');
			$.ajax({
				url: 'admin/ajax_ldschucNang',
				type: 'POST',
				dataType: 'JSON',
				data: {
					id: id
				},
				success: function(result) {

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

	});
</script>