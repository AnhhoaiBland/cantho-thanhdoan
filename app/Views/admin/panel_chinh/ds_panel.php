<style>
	.btn1-container {
		display: flex;
		flex-direction: column; /* Sắp xếp theo cột */
		gap: 5px; /* Khoảng cách giữa các nút */
	}

	.btn1 {
		width: 100%; /* Chiều rộng của các nút */
		height: 50px; /* Chiều cao của các nút */
		margin: 5px;
	}
</style>

<div class="row">
	<div class="col-md-12">
		<h3>Quản lý panel chính</h3>
		<i>Kích thước panel chính là 1600 x 510px</i>
	</div>
</div>
<div class="row ">
	<div class="col-md-12 bg-white p-2">
		<?php if ($checkQuyen == '1') { ?>
			<div class="form-group">
				<button class="btn btn-success" data-toggle="modal" data-target="#modalAddpanel"><i class="fa fa-plus"></i> Thêm</button>
			</div>
		<?php } ?>


		<table class="table table-bordered" id="datatable">
			<thead>
				<td width="350px">Hình ảnh</td>
				<td>Liên kết</td>
				<td>User tạo</td>
				<td>Ngày tạo</td>
				<td>User cập nhật</td>
				<td>Ngày cập nhật</td>
				<td>Vị trí</td>
				<?php if ($checkQuyen == '1') { ?>
					<td>Action</td>
				<?php } ?>

			</thead>
			<tbody>
				<?php $stt = 1;
				foreach ($ds_panel as $panel) : ?>
					<tr data-id="<?= $panel['maSlide'] ?>" data-tt-id="<?= $panel['maSlide'] ?>">
						<td> <img width='300px' src='upload/media/images/<?= $panel['imageURL'] ?>' style="border: 1px solid #ccc" /> </td>
						<td> <?= $panel['urlBaiViet'] ?> </td>
						<td> <?= $panel['tenNguoiDung'] ?> </td>
						<td> <?= $panel['ngayTao'] ?> </td>
						<td> <?= $panel['tenNguoiDungCapNhat'] ?> </td>
						<td> <?= $panel['ngayCapNhat'] ?> </td>
						<td> <?= $panel['viTri'] == '1' ? "panel trang chủ" : "panel cạnh" ?> </td>
						<?php if ($checkQuyen == '1') { ?>
							<td class="btn1-container">
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
<div>
	<?php echo view('admin/panel_chinh/add_panel'); ?>
</div>
<?php echo view('admin/panel_chinh/edit_panel'); ?>

<script>
	$(document).ready(function() {
		// $('#datatable').treetable({
		// 	expandable: true,
		// });
		// var table = $('#datatable').DataTable({
		// 	"language": {
		//         "url": "assets/datatable/Vietnamese.json"
		//     },
		//     "iDisplayLength": 25,
		// });
		// $('#frmAddpanel').submit(function(e){
		// 	e.preventDefault();
		// 	var id = $(this).find('input[name=id]').val();
		// 	var ten = $(this).find('input[name=ten]').val();
		// 	var formData = new FormData($('#frmAddpanel')[0]);
		// 	$.ajax({
		// 		url:$(this).attr('action'),
		// 		type:$(this).attr('method'),
		// 		data: formData,
		// 		dataType: 'JSON',
		// 		processData: false,
		// 		contentType: false,
		// 		success: function(result){
		// 			$('#modalEditpanel').modal('hide');
		// 			if(result.status == 'success'){
		// 				swal.fire('Thành công', result.content, result.status);
		// 				$('#modalAddpanel').modal('hide');
		// 			}else{
		// 				console.log(result.error);
		// 				swal.fire('Thất bại',result.content, result.status);
		// 			}
		// 		}
		// 	})
		// 	$('#modalAddpanel').addClass('d-none');
		// });
		$('.btnXoa').on('click', function() {
			node = $(this);
			Swal.fire({
				title: 'Xác nhận xóa',
				text: "Bạn có chắc muốn xóa chuyên mục này?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				//cancelButtonColor: '#3085d6',
				confirmButtonText: 'Xóa',
				cancelButtonText: 'Không xóa',
			}).then((result) => {
				if (result.value) {

					$.ajax({
						url: 'admin/xoa_panel',
						type: 'GET',
						data: {
							id: $(node).parents('tr').attr('data-id')
						},
						dataType: 'JSON',
						success: function(result) {
							//$(node).parents('tr').remove();
							//table.row(.draw();
							Swal.fire(
								'Đã xóa',
								result.message,
								result.status,
							);
							$(node).parents('tr').remove();
						},
						error: function(request, status, error) {
							alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại.")
							console.log(request.responseText, error);
						}
					})

				}
			})
		});

		$('.btnSua').click(function() {
			var row = $(this).closest('tr'); // changed parents to closest for better performance
			var id = row.attr('data-id'); // accessing data-id directly from row variable

			$.ajax({
				url: 'admin/sua_panel',
				type: 'POST',
				data: {
					id: id
				},
				dataType: 'JSON',
				success: function(result) {
					console.log(result);

					$('#txtId').val(result[0].maSlide);
					$('#txtURL').html(result[0].imageURL);
					$('#txtGroup').val(result[0].viTri);

					console.log(result[0].urlBaiViet);

					if (result[0].urlBaiViet !== null && typeof result[0].urlBaiViet !== 'undefined' && result[0].urlBaiViet !== "") {
						$('#inputedit_CheckLink').prop('checked', true); // corrected prop value to true
						$('#inputedit_Link').val(result[0].urlBaiViet);
						$('#inputedit_Link').removeClass('d-none');
					} else {
						$('#inputedit_CheckLink').prop('checked', false); // corrected prop value to false
						$('#inputedit_Link').val('');
						$('#inputedit_Link').addClass('d-none');
					}

					$('#selectVitri').val(result[0].viTri); // simplified the if-else condition

					$('#modalEditpanel').modal('show');
				}
			});
		});


		$('#frmEditpanel').submit(function(e) {
			e.preventDefault();
			var formData = new FormData($('#frmEditpanel')[0]);
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				data: formData,
				dataType: 'JSON',
				processData: false,
				contentType: false,
				success: function(result) {
					$('#modalEditpanel').modal('hide');
					if (result.status == 'success') {
						swal.fire('Thành công', result.content, result.status);

					} else {
						console.log(result.error);
						swal.fire('Thất bại', result.content, result.status);
					}
				}
			})
		});


	});
</script>
