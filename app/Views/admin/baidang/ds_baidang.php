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
	<div class="col-md-12">
		<h3>Quản lý bài viết</h3>
	</div>
</div>
<div class="row">
	<div class="col-md-12 bg-white p-2">
		<?php if ($checkQuyen == '1' || $chi_dang_bai == '1') { ?>
			<div class="form-group">
				<a href="admin/add_baidang" class="btn btn-success"><i class="fa fa-plus"></i> Thêm bài viết</a>
			</div>
		<?php } ?>


		<table class="table table-bordered" id="datatable">
			<thead>
				<td>STT</td>
				<td>Tiêu đề</td>
				<td>Người đăng</td>
				<td>Chuyên mục</td>
				<td>Ngày đăng</td>
				<td>Trạng thái duyệt</td>
				<td>người dùng duyệt</td>
				<td>Thời gian duyệt</td>
				<?php if ($checkQuyen == '1'  || $chi_dang_bai == '1') { ?>
					<td>Action</td>
				<?php } ?>

			</thead>
			<tbody>
				<?php $stt = 1;
				foreach ($ds_baidang as $baiviet) : ?>
					<tr data-id="<?= $baiviet['maBaiDang'] ?>">
						<td class="text-right"> <?= $stt++; ?> </td>
						<td>
							<a href="admin/edit_baidang/<?= $baiviet['urlBaiDang'] ?>"> <?= $baiviet['tieuDe'] ?> </a>
						</td>
						<td> <?= $baiviet['tenNguoiDung'] ?> </td>
						<td> <?= $baiviet['tenChuyenMuc'] ?> </td>
						<td> <?= date('d/m/Y', strtotime($baiviet['ngayDang'])) ?> </td>
						<?php if ($baiviet['trangThai'] == '1') { ?>
							<td><a href="javascript:;" class="duyet text-danger">Đang chờ duyệt</a></td>
						<?php } elseif ($baiviet['trangThai'] == '3') { ?>
							<td><a href="javascript:;" class="duyet text-success">Đã cập nhật, đang chờ duyệt</a></td>
						<?php } else { ?>
							<td><a href="javascript:;" class="huy-duyet">Đã duyệt, đang hiển thị</a></td>
						<?php } ?>
						<td> <?= $baiviet['tenNguoiDungDuyet'] ?></td>
						<td>
							<?php if (!empty($baiviet['thoiGianDuyetBai'])) {
								echo date('d/m/Y', strtotime($baiviet['thoiGianDuyetBai']));
							} ?>
						</td>
						<?php if ($checkQuyen == '1' || $chi_dang_bai == '1') { ?>

							<td class="text-right" style="min-width: 100px;">
								<button class="btn btn-warning btnSua" type="submit"><i class="fa fa-edit"></i></button>
								<button class="btn btn-danger btnXoa" type="button"><i class="fa fa-trash"></i></button>
							</td>
						<?php } ?>
					</tr>
				<?php endforeach; ?>
			</tbody>

		</table>
	</div>
</div>


<script>
	$(document).ready(function() {
		$('#datatable').dataTable({
			language: {
				url: "assets/datatable/Vietnamese.json"
			},
			"iDisplayLength": 25,
			columnDefs: [{
				type: 'date-uk',
				targets: 4
			}]
		});


		<?php if ($checkQuyen == '1') { ?>
			$('.duyet').click(function() {
				var row = $(this).parents('tr');
				var id = $(row).attr('data-id');
				Swal.fire({
					title: 'Xác nhận duyệt bài',
					text: "Bạn xác nhận duyệt, và cho phép hiển thị bài đăng này?",
					icon: 'white',
					showCancelButton: true,
					confirmButtonColor: '#d33',
					//cancelButtonColor: '#3085d6',
					confirmButtonText: 'Đồng ý',
					cancelButtonText: 'Không đồng ý',
				}).then((result) => {
					if (result.value) {
						node = $(this);
						$.ajax({
							url: 'admin/ajax_duyetBaiDang',
							type: 'POST',
							data: {
								id: $(node).parents('tr').attr('data-id')
							},
							dataType: 'JSON',
							success: function(result) {

								if (result.status == 'success') {

									Swal.fire(
										'Duyệt thành công',
										result.content,
										result.status,
									);
									window.location.reload();
								} else {
									Swal.fire(
										'Duyệt không thành công',
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


			$('.huy-duyet').click(function() {
				var row = $(this).parents('tr');
				var id = $(row).attr('data-id');
				Swal.fire({
					title: 'Xác nhận hủy duyệt bài đăng này',
					text: "Bạn xác nhận hủy duyệt, và không cho phép hiển thị bài đăng này?",
					icon: 'white',
					showCancelButton: true,
					confirmButtonColor: '#d33',
					//cancelButtonColor: '#3085d6',
					confirmButtonText: 'Đồng ý',
					cancelButtonText: 'Không đồng ý',
				}).then((result) => {
					if (result.value) {
						node = $(this);
						$.ajax({
							url: 'admin/ajax_Huy_duyetBaiDang',
							type: 'POST',
							data: {
								id: $(node).parents('tr').attr('data-id')
							},
							dataType: 'JSON',
							success: function(result) {

								if (result.status == 'success') {

									Swal.fire(
										'Duyệt thành công',
										result.content,
										result.status,
									);
									window.location.reload();
								} else {
									Swal.fire(
										'Duyệt không thành công',
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
		<?php } ?>



		$('.btnSua').click(function() {
			id = $(this).parents('tr').attr('data-id');
			window.location.replace('admin/edit_baidang/' + id);
		});
		$('.btnXoa').click(function() {
			Swal.fire({
				title: 'Xác nhận xóa',
				text: "Bạn có chắc muốn xóa bài viết này?",
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
						url: 'admin/del_baidang',
						type: 'POST',
						data: {
							id: $(node).parents('tr').attr('data-id')
						},
						dataType: 'JSON',
						success: function(result) {
							$(node).parents('tr').remove();
							Swal.fire(
								'Đã xóa',
								result.message,
								result.status,
							);
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