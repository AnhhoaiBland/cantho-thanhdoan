<div class="row">
	<div class="col-md-12">
		<h3>Quản lý Chuyên mục</h3>
	</div>
</div>
<div class="row ">
	<div class="col-md-12 bg-white p-2">
		<?php if ($checkQuyen == '1') { ?>
			<div class="form-group">
				<button class="btn btn-success" data-toggle="modal" data-target="#modalAddCategory"><i class="fa fa-plus"></i> Thêm chuyên mục</button>
			</div>
		<?php } ?>


		<table class="table table-bordered" id="datatable">
			<thead>
				<td>STT</td>
				<td>Tên chuyên mục</td>
				<td>Đường dẫn</td>
				<td>SL bài viết</td>
				<td>Thuộc nhóm chuyên mục</td>
				<?php if ($checkQuyen == '1') { ?>
					<td>Action</td>
				<?php } ?>

			</thead>
			<tbody>
				<?php $stt = 1;
				foreach ($ds_category as $category) : ?>
					<tr data-id="<?= $category['maChuyenMuc'] ?>" data-tt-id="<?= $category['maChuyenMuc'] ?>" <?php if (isset($category['CAT_PARENT_ID']) && $category['CAT_PARENT_ID'] != NULL) echo 'data-tt-parent-id="' . $category['CAT_PARENT_ID'] . '"' ?>>
						<td> <?= $stt++ ?> </td>
						<td> <?= $category['tenChuyenMuc'] ?> </td>
						<td> <?= $category['urlChuenMuc'] ?> </td>
						<td> <?= $category['soLuongBai'] ?> </td>
						<td> <?= $category['tenChuyenMucCha'] ?> </td>
						<?php if ($checkQuyen == '1') { ?>
							<td class="text-right">
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
<?php echo view('admin/category/add_category'); ?>
<?php echo view('admin/category/edit_category'); ?>

<script>
	$(document).ready(function() {
		$('#datatable').treetable({
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
				text: "Bạn có chắc muốn xóa chuyên mục này?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				confirmButtonText: 'Xóa',
				cancelButtonText: 'Không xóa',
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: 'admin/xoa_category',
						type: 'GET',
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
							alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại.");
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
				url: 'admin/ajax_sua_category',
				type: 'POST',
				data: {
					id: id
				},
				dataType: 'JSON',
				success: function(result) {
					$('#txt_IdEdit').val(result[0].maChuyenMuc);
					$('#txt_TenEdit').val(result[0].tenChuyenMuc);
					$('#nameUpdateHtml').val(result[0].tenChuyenMuc);
					$('#txt_AliasEdit').val(result[0].urlChuenMuc);
					$('#modalEditCategory').modal('show');
					setDefaultOption(result[0].tenChuyenMucCha);
					removeOptionByValue(result[0].maChuyenMuc);
				}
			})
		});
		$('#frmEditCategory').submit(function(e) {
			e.preventDefault();
			var id = $(this).find('input[name=id]').val();
			var ten = $(this).find('input[name=ten]').val();
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				data: $(this).serialize(),
				dataType: 'JSON',
				success: function(result) {
					$('#modalEditCategory').modal('hide');
					if (result.status == 'success') {
						swal.fire('Thành công', result.content, result.status);
						$('#datatable').find('tr[data-id=' + id + ']').find('td:eq(1)').html(ten);
					} else {
						console.log(result.error);
						swal.fire('Thất bại', result.content, result.status);
					}
				}
			})
		});


	});
</script>