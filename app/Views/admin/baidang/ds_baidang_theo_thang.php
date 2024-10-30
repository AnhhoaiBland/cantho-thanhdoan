<div class="row">
	<div class="col-md-12">
		<h3>Danh sách bài viết theo tháng</h3>
	</div>
	<div class="col-md-12 bg-white">
		<form action="admin/ds_baiviet_theo_thang" method="POST">
			<div class="row form-group">
				<div class="col-md-5">
					<label >Từ ngày</label>
					<input type="date" name="tungay" value="<?=$tungay ?>" class="form-control">
				</div>
				<div class="col-md-5">
					<label >Đến ngày</label>
					<input type="date" name="denngay" value="<?=$denngay ?>" class="form-control">
				</div>
				<div class="col-md-2" style="margin-top: 27px;">
					
					<input type="submit" value="Tìm kiếm" class="btn btn-success form-control">
				</div>
			</div>
		</form>
		<table class="table table-bordered" id="datatable">
			<thead>
				<th>Id</th>
				<th>Tên bài viết</th>
				<th>Chuyên mục</th>
				<th>Ngày đăng</th>
			</thead>
			<tbody>
				<?php foreach ($ds_baiviet as $baiviet): ?>
					<tr>
						<td><?= $baiviet->BV_ID ?></td>
						<td><?= $baiviet->BV_TIEU_DE ?></td>
						<td><?= $baiviet->CAT_NAME ?></td>
						<td><?= date('d/m/Y',strtotime($baiviet->BV_NGAY_DANG)) ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#datatable').dataTable({
			"language": {
                "url": "assets/datatable/Vietnamese.json"
            },
            "iDisplayLength": 25,
            columnDefs: [
		        { type: 'date-uk', targets: 3 }
		    ]
		});
	});
</script>