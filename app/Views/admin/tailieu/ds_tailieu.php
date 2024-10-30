<style>
	.btn1-container {
    display: flex;
    flex-direction: column; /* Sắp xếp theo cột */
    gap: 5px; /* Khoảng cách giữa các nút */
}

.btn1 {
    width: 100%; /* Chiều rộng của các nút */
}


</style>

<div class="row">
	<div class="col-md-12">
		<h3>Quản lý tài liệu</h3>
	</div>
</div>
<div class="row ">
	<div class="col-md-12 bg-white p-2">
		<?php if ($checkQuyen == '1') { ?>
			<div class="form-group">
				<button class="btn btn-success" id="add_tailieu" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus"></i> Thêm tài liệu</button>
				<button class="btn btn-info" data-toggle="modal" data-target="#modalAddloaiVB"><i class="fa fa-plus"></i> Thêm loại tài liệu</button>
				<button class="btn btn-danger" id="edit_loadtailieu" data-toggle="modal" data-target="#modaleditloaiVB"><i class="fa fa-edit"></i> Cập nhật loại tài liệu</button>
			</div>
		<?php } ?>

		<table class="table table-bordered" id="datatable">
			<thead>
				<td>Số</td>
				<td>Tên tài liệu</td>
				<td>Thời gian<br> có hiệu lực</td>
				<td>Loại tài liệu</td>
				<td>Ngày đăng tải</td>
				<td>User<br> đăng tải</td>
				<td>Ngày cập nhật</td>
				<td>User<br> cập nhật</td>
				<td>URL</td>
				<?php if ($checkQuyen == '1') { ?>
					<td>Action</td>
				<?php } ?>

			</thead>
			<tbody>
				<?php if ($ds_vanban == NULL || count($ds_vanban) == 0) : ?>
					<tr>
						<td></td>
						<td>Chưa có tài liệu</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<?php if ($checkQuyen == '1') { ?>
							<td></td>
						<?php } ?>

					</tr>
				<?php else : ?>
					<?php $stt = 1;
					foreach ($ds_vanban as $vanban) : ?>
						<tr data-id="<?= $vanban['maTaiLieu'] ?>">
							<td> <?= $vanban['soHieuTL'] ?> </td>
							<td> <?= $vanban['tenTaiLieu'] ?> </td>
							<td> <?= $vanban['thoiGianBanHanh'] ?> </td>
							<td> <?= $vanban['tenDanhMucTaiLieu'] ?> </td>
							<td> <?= date('d/m/Y', strtotime($vanban['ngayTao'])) ?> </td>
							<td> <?= $vanban['tenNguoiDungTai'] ?> </td>

							<td> <?= $vanban['ngayCapNhat'] == null ? "" : date('d/m/Y', strtotime($vanban['ngayCapNhat'])) ?> </td>
							<td> <?= $vanban['tenNguoiDungCapNhat'] ?> </td>

							<td>
								<a target="_blank" href="upload/document/<?= $vanban['duongDanTaiVe'] ?>"><i class="fa fa-lg fa-download text-success"></i></a>
							</td>
							<?php if ($checkQuyen == '1') { ?>
								<td class="text-right" style="min-width: 100px;">
    <div class="btn1-container">
        <button class="btn btn-warning btnSua"><i class="fa fa-edit"></i></button>
        <button class="btn btn-danger btnXoa"><i class="fa fa-trash"></i></button>
    </div>
</td>

							<?php } ?>
						</tr>
					<?php endforeach; ?>
				<?php endif ?>

			</tbody>
		</table>
	</div>
</div>
<?php echo view('admin/tailieu/add'); ?>
<?php echo view('admin/tailieu/addloaivb'); ?>
<?php echo view('admin/tailieu/editloaivb'); ?>
<?php echo view('admin/tailieu/edit');
?>

<script>
	$(document).ready(function() {
		table = $('#datatable').treetable({
			expandable: true,
		});
		// var table = $('#datatable').DataTable({
		// 	"language": {
		//               "url": "assets/datatable/Vietnamese.json"
		//           },
		//           "iDisplayLength": 25,
		// });
		$('.btnXoa').on('click', function() {
			node = $(this);
			Swal.fire({
				title: 'Xác nhận xóa',
				text: "Bạn có chắc muốn xóa tài liệu này?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				//cancelButtonColor: '#3085d6',
				confirmButtonText: 'Xóa',
				cancelButtonText: 'Không xóa',
			}).then((result) => {
				if (result.value) {

					$.ajax({
						url: 'admin/xoatailieu',
						type: 'POST',
						data: {
							id: $(node).parents('tr').attr('data-id')
						},
						dataType: 'JSON',

						success: function(result) {
							$(node).parents('tr').remove();
							//table.row($(node).parents('tr')).remove().draw();
							Swal.fire(
								'Đã xóa',
								result.message,
								result.status,
							);
						},
						error: function(request, status, error) {
							alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại.")
							// console.log(request.responseText, error);
						}
					})

				}
			})
		});

		$("#edit_loadtailieu").click(function() {
			$.ajax({
				url: 'admin/ajax_laydsloaitl',
				type: 'get',
				dataType: 'JSON',
				success: function(result) {
					var dropdown = $('#ds_loai_tl');
					dropdown.empty();
					result.forEach((element, index) => {
						dropdown.append('<option value="' + element.maDanhMucTaiLieu + '">' + element.tenDanhMucTaiLieu + '</option>');
					});
				}

			});
		})

		$("#add_tailieu").click(function() {
			$.ajax({
				url: 'admin/ajax_laydsloaitl',
				type: 'get',
				dataType: 'JSON',
				success: function(result) {
					console.log(result)
					var dropdown = $('#ds_loai_tl_new');
					dropdown.empty();

					result.forEach((element, index) => {
						dropdown.append('<option value="' + element.maDanhMucTaiLieu + '">' + element.tenDanhMucTaiLieu + '</option>');
					});
				}

			});
		})


		$('.btnSua').click(function() {
			var row = $(this).parents('tr');
			var id = $(row).attr('data-id');
			$.ajax({
				url: 'admin/ajax_laythongtintailieucapnhat',
				type: 'POST',
				data: {
					id: id
				},
				dataType: 'JSON',
				success: function(result) {
					console.log(result.content[0].soHieuTL);
					if (result.status == 'success') {
						var dropdown = $('#ds_loai_tl_edit');
						dropdown.empty();
						$('#idtailieu').val(result.content[0].maTaiLieu);
						$('#so_hieu_TL').val(result.content[0].soHieuTL);
						$('#ten_tai_lieu_edit').val(result.content[0].tenTaiLieu);
						$('#thoi_Gian_Ban_Hanh').val(result.content[0].thoiGianBanHanh);
						$('#ds_loai_tl_edit').val(result.content[0].maDanhMucTaiLieu);
						$('#mo_ta').val(result.content[0].moTa)
						$('#mEdit_url').html(result.content[0].duongDanTaiVe);
						$('#fileold').val(result.content[0].duongDanTaiVe);
						result.loaitailieu.forEach((element, index) => {
							if (element.maDanhMucTaiLieu == result.content[0].maDanhMucTaiLieu) {
								dropdown.append('<option selected value="' + element.maDanhMucTaiLieu + '">' + element.tenDanhMucTaiLieu + '</option>');
							}
							dropdown.append('<option value="' + element.maDanhMucTaiLieu + '">' + element.tenDanhMucTaiLieu + '</option>');
						});

						$('#modalEdit').modal('show');
					}

				}

			})
		});

		$('#frmeditloaiVB').submit(function(e) {
			var formData = new FormData($('#frmeditloaiVB')[0]);
			e.preventDefault();
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				data: formData, //$(this).serialize(),
				dataType: 'JSON',
				processData: false,
				contentType: false,
				cache: false,
				beforeSend: function() {
					$('#frmAdd button[type=submit]').prop('disabled', true);
				},
				success: function(result) {
					$('#modal').modal('hide');
					if (result.status == 'success') {
						swal.fire('Thành công', result.message, result.status);
						$('#modaleditloaiVB').modal('hide');
						$('#frmeditloaiVB').reset();
						$('#frmeditloaiVB button[type=submit]').prop('disabled', false);
					} else {
						swal.fire('Thất bại', result.message, result.status);
					}
				}
			});

		});



		$('#frmAddloaiVB').submit(function(e) {
			var formData = new FormData($('#frmAddloaiVB')[0]);
			e.preventDefault();
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				data: formData, //$(this).serialize(),
				dataType: 'JSON',
				processData: false,
				contentType: false,
				cache: false,
				beforeSend: function() {
					$('#frmAdd button[type=submit]').prop('disabled', true);
				},
				success: function(result) {
					$('#modalAddloaiVB').modal('hide');
					if (result.status == 'success') {
						swal.fire('Thành công', result.message, result.status);
						$('#modalAdd').modal('hide');
						$('#frmAdd').reset();
						$('#frmAdd button[type=submit]').prop('disabled', false);
					} else {
						console.log(result.error);
						swal.fire('Thất bại', result.message, result.status);
					}
				}
			});
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
					$('#modalAdd').modal('hide');
					if (result.status == 'success') {
						swal.fire('Thành công', result.message, result.status);

					} else {
						console.log(result.error);
						swal.fire('Thất bại', result.message, result.status);
					}
				}
			});
		});


		$('#frmEdit').submit(function(e) {
			var formData = new FormData($('#frmEdit')[0]);
			e.preventDefault();
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				data: formData, //$(this).serialize(),
				dataType: 'JSON',
				processData: false,
				contentType: false,
				success: function(result) {
					$('#modalEdit').modal('hide');
					if (result.status == 'success') {
						swal.fire('Thành công', result.message, result.status);

					} else {
						console.log(result.error);
						swal.fire('Thất bại', result.message, result.status);
					}
				}
			});
		});


	});


	<?php
	if (session()->has('error')) {
		$error_view = session('error');
		echo "toastr.error('$error_view');";
	}
	if (session()->has("success")) {
		$success_v = session("success");
		echo "toastr.success('$success_v');";
	}
	?>
</script>