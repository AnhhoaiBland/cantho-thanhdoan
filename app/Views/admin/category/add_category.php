<!-- Modal -->
<div id="modalAddCategory" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <form action="admin/add_category" method="POST" id="frmAddCategory">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title">Thêm chuyên mục</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="">Tên chuyên mục</label>
            <input type="text" id="tenChuyenMuc" name="ten" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="">Đường dẫn </label>
            <input type="text" id="alias" name="alias" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Chuyên mục cha</label>
            <select name="category_cha" class="form-control">
              <option value="non">Không có</option>
              <?php foreach ($ds_category as $category) : ?>
                <option value="<?= $category['maChuyenMuc'] ?>"><?= $category['tenChuyenMuc'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" form="frmAddCategory" class="btn btn-success">Thêm</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </form>

  </div>
</div>

<script>
  const tenChuyenMuc = document.getElementById('tenChuyenMuc')
  const alias = document.getElementById('alias')


  // function slugify(text) {
  //   return text.toString().toLowerCase()
  //     .replace(/\s+/g, '-') // Thay thế dấu cách bằng dấu gạch ngang
  //     .replace(/[^\w\-]+/g, '') // Loại bỏ các ký tự không phải chữ cái, số, hoặc gạch ngang
  //     .replace(/\-\-+/g, '-') // Loại bỏ các gạch ngang kéo dài
  //     .replace(/^-+/, '') // Loại bỏ gạch ngang ở đầu chuỗi
  //     .replace(/-+$/, ''); // Loại bỏ gạch ngang ở cuối chuỗi
  // }


  tenChuyenMuc.addEventListener('change', (e) => {
    let vl = e.target.value;
    if (vl != null && vl.length > 0) {
      alias.value = slugify(vl)
    }
  })
</script>