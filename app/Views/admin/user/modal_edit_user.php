<!-- Modal -->
<div id="modaleditUser" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <form action="admin/edit_user" method="POST" id="frmEditUser">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cập nhật tài khoản</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="">Họ tên</label>
            <input type="hidden" name="id_nd" id="id_nd">
            <input type="text" id="hoTen" name="hoTen" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Tên tài khoản</label>
            <input type="text" id="tentk" name="tentk" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Loại tài khoản</label>
            <select class="form-control" name="loaitaikhoan" id="dsloaitaikhoanedit"> </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" form="frmEditUser" class="btn btn-success">Cập nhật</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </form>
  </div>
</div>