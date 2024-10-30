<div class="row">
	<div class="col-md-12">
		<h3>Thống kê bài viết theo chuyên mục</h3>
	</div>
	<div class="col-md-12 bg-white p-2" >
		<table class="table table-bordered">
			<thead>
				<th>ID</th>
				<th>Chuyên mục</th>
				<th>Số lượng bài viết</th>
			</thead>
			<tbody>
				<?php foreach ($ds_category as $chuyenmuc): ?>
					<tr>
						<td><?= $chuyenmuc->CAT_ID ?></td>
						<td><?= $chuyenmuc->CAT_NAME ?></td>
						<td><?= $chuyenmuc->SL ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>