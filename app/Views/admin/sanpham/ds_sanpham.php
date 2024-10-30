<div class="row">	
	<div class="col-md-12">	
		<h3>Quản lý sản phẩm</h3>
	</div>
</div>
<div class="row ">
	<div class="col-md-12 bg-white p-2">
		<div class="form-group">
			<a href="admin/add_sanpham" class="btn btn-success"><i class="fa fa-plus"></i> Thêm mới</a>
		</div>
		
		<table class="table table-bordered" id="datatable">
			<thead>
				<td>ID</td>
				<td>Tên sản phẩm</td>
				<td>Hình ảnh</td>
				<td style="max-width: 30%">Mô tả</td>
				<td>Người đăng</td>
				
				<td>Ngày đăng</td>
				<td>Mới</td>
				<td>Bán chạy</td>
				<td>Action</td>
			</thead>
			<tbody>
				<?php if (is_array($ds_sanpham) && count($ds_sanpham)>0): ?>
				<?php $stt=1; foreach($ds_sanpham as $sanpham): ?>
					<tr data-id="<?= $sanpham->get('SP_ID') ?>">
						<td class="text-right"> <?= $stt++; ?> </td>
						<td><a href="admin/edit_sanpham/<?=$sanpham->get('SP_ID') ?>"> <?= $sanpham->get('SP_TEN') ?> </a></td>
						<td>
							<img src="media/images/<?=$sanpham->get('SP_HINH_ANH')?>" alt="Hình ảnh sản phẩm" width="100px"/>
						</td>
						<td><?= substr(strip_tags($sanpham->get('SP_MO_TA')),0,150).'...' ?></td>
						<td> <?= $sanpham->get_nguoi_tao()->get('U_TEN') ?> </td>
						
						<td> <?= date('d/m/Y',strtotime($sanpham->get('SP_NGAY_TAO'))) ?> </td>
						<td class="text-center">
							<input type="checkbox" readonly <?php if ($sanpham->get('SP_MOI') == 1) echo 'checked' ?> >
						</td>
						<td class="text-center">
							<input type="checkbox" readonly <?php if ($sanpham->get('SP_BAN_CHAY') == 1) echo 'checked' ?> >
						</td>
						<td class="text-right">
							<button class="btn btn-warning btnSua" type="submit" ><i class="fa fa-edit"></i></button>
							<button class="btn btn-danger btnXoa" type="button" ><i class="fa fa-trash"></i></button>
						</td>
					</tr>
				<?php endforeach; ?>
				<?php endif ?>
			</tbody>
		</table>
	</div>
</div>


<script>
	
	$(document).ready(function(){
		$('#datatable').dataTable({
			language: {
                url: "assets/datatable/Vietnamese.json"
            },
            "iDisplayLength": 25,
            columnDefs: [
		        { type: 'date-uk', targets: 4 }
		    ]
		});
		$('.btnSua').click(function(){
			id = $(this).parents('tr').attr('data-id');
			window.location.replace('admin/edit_sanpham/'+id);
		});
		$('.btnXoa').click(function(){
			Swal.fire({
			  title: 'Xác nhận xóa',
			  text: "Bạn có chắc muốn xóa sản phẩm này?",
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
			    	url: 'admin/del_sanpham/'+$(node).parents('tr').attr('data-id'),
			    	type: 'GET',
			    	dataType: 'JSON',
			    	success:function(result){
			    		$(node).parents('tr').remove();
			    		Swal.fire(
					      'Đã xóa',
					      result.message,
					      result.status,
					    );
					},
					error: function (request, status, error) {
						alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại.")
						console.log(request.responseText, error);
					}
			    })
			    
			  }
			})
		});
	});
</script>