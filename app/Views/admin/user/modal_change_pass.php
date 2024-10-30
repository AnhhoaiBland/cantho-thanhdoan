<!-- Modal -->
<div id="modalChangePass" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <form action="admin/change_pass_user" method="POST" id="frmChangePass">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title">Đổi mật khẩu</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="">Tên tài khoản</label>
            <input type="hidden" name="username" value="" id="hid_username">
            <input type="text" name="tenuser" class="form-control" id="txt_username" readonly>
          </div>
          <div class="form-group">
            <label for="">Mật khẩu mới</label>
            <input type="password" id="txt_new_password" name="new_password" class="form-control" autocomplete="new-password">
          </div>
          <div class="form-group">
            <label for="">Nhập lại mật khẩu mới</label>
            <input type="password" id="txt_new_password2" name="new_password2" class="form-control">
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              Hiển thị mật khẩu
            </label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" form="frmChangePass" class="btn btn-primary">Thay đổi</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </form>

  </div>
</div>

<script>
  $(document).ready(function() {
    // Xử lý sự kiện khi checkbox được thay đổi
    $('#flexCheckDefault').change(function() {
      // Nếu checkbox được chọn
      if ($(this).is(':checked')) {
        // Hiển thị mật khẩu
        $('#txt_new_password, #txt_new_password2').attr('type', 'text');
      } else {
        // Nếu checkbox không được chọn, ẩn mật khẩu
        $('#txt_new_password, #txt_new_password2').attr('type', 'password');
      }
    });
  });
</script>