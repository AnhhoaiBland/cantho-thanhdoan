<!-- Modal -->
<div id="modalEditCategory" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<form action="/admin/sua_category" method="POST" id="frmEditCategory">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">

					<h4 class="modal-title">Cập nhật chuyên mục</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Tên chuyên mục</label>
						<input type="text" name="ten" class="form-control" id="txt_TenEdit">
						<input type="hidden" name="id" value="" id="txt_IdEdit">
					</div>
					<div class="form-group">
						<label for="">Đường dẫn </label>
						<input type="text" name="alias" class="form-control" id="txt_AliasEdit">
					</div>

					<div class="form-group">
					<label for="">Nhóm chuyên mục </label>
						<select name="category_cha" id="txt_category_cha" class="form-control">
							<option value="" id="defaultOption">Không có</option>
							<!-- <input id="nameUpdateHtml"type='text'></input> -->
							<?php foreach ($ds_category as $cat) : ?>
								<?php if ($cat['tenChuyenMuc'] !== "") : ?>
									<option value="<?= $cat['maChuyenMuc'] ?>"><?= $cat['tenChuyenMuc'] ?></option>
								<?php endif; ?>
							<?php endforeach ?>
						</select>
						<input id="nameUpdateHtml" type='text' class="d-none" />
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" form="frmEditCategory" class="btn btn-warning">Cập nhật</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				</div>
			</div>
		</form>

	</div>
</div>

<script>
	var txt_category_cha = document.getElementById('txt_category_cha');
	var defaultOption = document.getElementById('defaultOption');
	var ds_category = <?php echo json_encode($ds_category); ?>;
	var nameUpdateHtml = document.getElementById('nameUpdateHtml');

	// Xử lý khi nhận được giá trị từ JavaScript
	function setDefaultOption(value) {
		// Lặp qua tất cả các option
		for (var i = 0; i < txt_category_cha.options.length; i++) {
			// Nếu giá trị của option khớp với giá trị từ JavaScript
			if (txt_category_cha.options[i].text === value) {
				// Đặt option này làm giá trị mặc định
				txt_category_cha.options[i].selected = true;
				return; // Kết thúc xử lý
			}
		}
		// Nếu không tìm thấy giá trị khớp, đặt giá trị mặc định cho select box
		defaultOption.selected = true;
	}


	function removeOptionByValue(value) {
		// var select = document.getElementById('txt_category_cha');
		// var options = select.options;

		// for (var i = 0; i < options.length; i++) {
		// 	if (options[i].value === value) {
		// 		options[i].remove();
		// 		break;
		// 	}
		// }
	}

	// console.log(ds_category);
	// ds_category.forEach(function(category) {
	// 	if (category.tenChuyenMuc !== nameUpdateHtml.value) {
	// 		var option = document.createElement("option");
	// 		option.value = category.maChuyenMuc;
	// 		option.textContent = category.tenChuyenMuc;
	// 		document.getElementById("txt_category_cha").appendChild(option);
	// 	}
	// });

	let txt_TenEdit = document.getElementById('txt_TenEdit');
	let txt_AliasEdit = document.getElementById('txt_AliasEdit');

	txt_TenEdit.addEventListener('change', (e) => {
		let vl = e.target.value;
		if (vl != null && vl.length > 0) {
			txt_AliasEdit.value = slugify(vl)
		}
	})
</script>