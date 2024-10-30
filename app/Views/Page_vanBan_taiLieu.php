<style>
	/* Form Styling */
	#frmSearch {
		display: flex;
		/* Arrange form elements horizontally */
		flex-wrap: wrap;
		/* Allow elements to wrap on smaller screens */
		margin-bottom: 20px;
		/* Add some spacing after the form */
	}

	.form-group {
		margin-bottom: 10px;
		/* Adjust spacing between form groups */
	}

	.form-control {
		border-radius: 4px;
		/* Add rounded corners to input fields */
		height: 38px;
		/* Set a consistent height for input fields */
	}

	label {
		font-weight: bold;
		margin-bottom: 5px;
		/* Adjust label spacing */
	}

	.btn-primary {
		background-color: #007bff;
		/* Blue button color */
		border-color: #007bff;
		/* Match button color with border */
		color: #fff;
		/* White text color */
		font-weight: bold;
		/* Emphasize button text */
		padding: 8px 16px;
		/* Adjust button padding */
	}

	/* Table Styling */
	.table {
		border-collapse: collapse;
		/* Ensure proper border rendering */
	}

	th,
	td {
		padding: 10px;
		/* Consistent padding for table cells */
	}

	.table-bordered th,
	.table-bordered td {
		border: 1px solid #ddd;
		/* Light gray border for table cells */
	}

	/* Modal Styling */
	.modal-content {
		border-radius: 5px;
		/* Rounded corners for modal window */
	}

	.modal-header {
		padding: 15px;
		/* Adjust padding within the modal header */
		border-bottom: 1px solid #eee;
		/* Light border below header */
	}

	.modal-title {
		font-weight: bold;
		/* Emphasize modal title */
	}

	.modal-body {
		padding: 20px;
		/* Adjust padding within the modal body */
	}

	.table-bordered th,
	.table-bordered td {
		border: 1px solid #ddd;
		/* Light gray border for modal table cells */
	}

	/* Responsiveness (Adjust media queries as needed) */
	@media (max-width: 768px) {

		.col-md-4,
		.col-md-6,
		.col-md-8,
		.col-md-12 {
			flex: 100%;
			/* Make form elements full width on smaller screens */
		}
	}
</style>

<div style="min-height: 900px;" class="bg-body p-4">

	<form id="frmSearch" action="file/timTaiLieu" method="post">
		<div class="row form-group">
			<div class="col-md-6s form-group">
				<label>Kìm kím văn bản</label>
				<input type="text" name="tim_van_ban" id="tim_van_ban" class="form-control">
			</div>
			<div class="col-md-4">
				<label>Loại văn bản</label>
				<select name="maDanhMucTaiLieu" id="maDanhMucTaiLieu" class="form-control" aria-label="Default select example">
					<option value="" selected>--tất cả--</option>
					<?php foreach ($ds_loaiTL as $loatl) { ?>
						<option value="<?= $loatl['maDanhMucTaiLieu'] ?>"><?= $loatl['tenDanhMucTaiLieu'] ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-6">
						<label class="form-label">Thời gian ban hành</label>
						<input type="date" class="form-control" id="thoiGianBanHanh" name="thoiGianBanHanh">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
							<label class="form-check-label" for="flexCheckChecked">
								Toàn bộ thời gian
							</label>
						</div>
					</div>


				</div>
			</div>
			<div class="col-md-2" style="margin-top:30px;">
			<!-- <i class="fa fa-search"></i> -->
				<input type="submit" id="tim" style="width: 130px;" class="btn btn-primary form-control" value=" Tìm kiếm"/>
			</div>
		</div>
	</form>

	<div class="row">
		<div class="col-md-12 bg-white p-2">
			<table class="table table-bordered" id="main_table">
				<thead>
					<tr>
						<th>STT</th>
						<th>Số</th>
						<th width="50%">Tên văn bản</th>
						<th>Loại</th>
						<th>Thời gian ban hành</th>
						<th>Tải về</th>
					</tr>
				</thead>
				<tbody id="table_value"></tbody>
			</table>


		</div>
	</div>

	<!-- Modal -->
	<div id="modalView" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Văn bản liên quan</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered">
								<tr>
									<td>STT</td>
									<td id="modal_so"></td>
								</tr>
								<tr>
									<td>Số văn bản</td>
									<td id="modal_so"></td>
								</tr>
								<tr>
									<td>Trích yếu</td>
									<td id="modal_trichyeu"></td>
								</tr>
								<tr>
									<td>Ngày ban hành</td>
									<td id="modal_ngaybanhanh"></td>
								</tr>
								<tr>
									<td>Loại</td>
									<td><span id="modal_loai"></span></td>
								</tr>
								<tr>
									<td>Trạng thái</td>
									<td><span id="modal_trangthai"></span></td>
								</tr>
								<tr>
									<td>Cấp</td>
									<td><span id="modal_cap"></span></td>
								</tr>
								<tr>
									<td>Cơ quan ban hành</td>
									<td><span id="modal_coquanbanhanh"></span></td>
								</tr>
								<tr>
									<td>Người ký</td>
									<td><span id="modal_nguoiky"></span></td>
								</tr>
								<tr>
									<td>Tải file</td>
									<td>
										<span id="modal_url"></span>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {


		$('#frmSearch').submit(function(e) {
			 e.preventDefault();
			$.ajax({
				url: 'file/timTaiLieu',
				type: 'POST',
				data: {
					tim_van_ban: $('#tim_van_ban').val(),
					maDanhMucTaiLieu: $('#maDanhMucTaiLieu').val(),
					thoiGianBanHanh: $('#thoiGianBanHanh').val()
				},
				dataType: 'json',
				success: function(data) {
					if (data.status == 'success') {
						let ban = $('#table_value')
						let i = 1;
						$('#table_value').empty()
						data.datalist.forEach(element => {
							console.log(element)
							let newRow = $('<tr>').append(
								$('<td>').text(i++),
								$('<td>').text(element.soHieuTL),
								$('<td>').text(element.tenTaiLieu),
								$('<td>').text(element.tenDanhMucTaiLieu),
								$('<td>').text(element.thoiGianBanHanh == null ? "" : element.thoiGianBanHanh),
								$('<td>').html(
									'<a target="_blank" href="upload/document/' + element.duongDanTaiVe + '">' +
									'<i class="fa fa-lg fa-download text-success"></i>' +
									'</a>'
								)
							)

							ban.append(newRow);
						});
					}

				},
				error: function(xhr, status, error) {
					console.log("Có lỗi xảy ra: " + error);
				}
			});
		})



	});
</script>