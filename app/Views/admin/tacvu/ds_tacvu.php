<div class="row">
	<div class="col-md-12">
		<h3>Quản lý các chức năng</h3>
	</div>
</div>
<div class="row ">
	<div class="col-md-12 bg-white p-2">
		<div class="form-group">
			<button class="btn btn-success" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus"></i> Thêm tác vụ</button>
		</div>

		<table class="table table-bordered" id="datatable">
			<thead>
				<td>Stt</td>
				<td>Tên tác vụ</td>
				<td>Đường dẫn đến tác vụ</td>
				<td>Action</td>
			</thead>
			<tbody>
				<?php $stt = 1;
				foreach ($ds_tacvu as $tacvu) : ?>
					<tr data-id="<?= $tacvu['maChucNang'] ?>" data-tt-id="<?= $tacvu['maChucNang'] ?>" <?php if (isset($category['CAT_PARENT_ID']) && $category['CAT_PARENT_ID'] != NULL) echo 'data-tt-parent-id="' . $category['CAT_PARENT_ID'] . '"' ?>>
						<td> <?= $stt++ ?> </td>
						<td> <?= $tacvu['tenChucNang'] ?> </td>
						<td> <?= $tacvu['urlChucNang'] ?> </td>
						<td class="text-right">
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
		$('#datatable').treetable({
			expandable: true,
		});
		var table = $('#datatable').DataTable({
			"language": {
				"url": "assets/datatable/Vietnamese.json"
			},
			"iDisplayLength": 25,
		});
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
						url: 'admin/xoatacvu',
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


		$('.btnSua').click(function() {
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


	});
</script>