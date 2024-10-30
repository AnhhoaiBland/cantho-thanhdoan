<!-- Modal -->
<div id="modalAdd" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <form action="admin/addtacvu" method="POST" id="frmAdd">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title">Thêm tác vụ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="">Tên tác vụ</label>
            <input type="text" id="tenTacV" name="tenTacVu" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="">Đường dẫn truy cập tác vụ</label>
            <input type="text" id="alias" name="urlTacVu" class="form-control">
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" form="frmAdd" class="btn btn-success">Thêm</button>
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