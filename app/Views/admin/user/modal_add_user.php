<!-- Modal -->
<div id="modalAddUser" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <form action="admin/add_user" method="POST" id="frmAddUser">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Thêm tài khoản</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="">Họ tên</label>
            <input type="text" name="new_hoten" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Tên tài khoản</label>
            <input type="text" name="new_username" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Loại tài khoản</label>
            <select class="form-control" name="loaitaikhoan" id="dsloaitaikhoan"> </select>
          </div>
          <div class="form-group">
            <label for="">Mật khẩu</label>
            <input type="password" name="new_password" class="form-control" autocomplete="new-password">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="showPassword1">
              <label class="form-check-label" for="showPassword1">
                hiển thị mật khẩu
              </label>
            </div>
          </div>
          <div class="form-group">
          <div id="passwordMismatchError" style="color: red;"></div>
            <label for="">Nhập lại mật khẩu</label>
            <input type="password" name="new_password2" class="form-control">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="showPassword2">
              <label class="form-check-label" for="showPassword2">
                hiển thị mật khẩu
              </label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" form="frmAddUser" class="btn btn-success">Thêm</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  $(document).ready(function() {

    $('#showPassword1').click(function() {
      var passwordField = $('input[name="new_password"]');
      var passwordFieldType = passwordField.attr('type');
      if (passwordFieldType === 'password') {
        passwordField.attr('type', 'text');
      } else {
        passwordField.attr('type', 'password');
      }
    });

    $('#showPassword2').click(function() {
      var passwordField = $('input[name="new_password2"]');
      var passwordFieldType = passwordField.attr('type');
      if (passwordFieldType === 'password') {
        passwordField.attr('type', 'text');
      } else {
        passwordField.attr('type', 'password');
      }
    });

    // Kiểm tra mật khẩu khi form được submit
    $('#frmAddUser').submit(function(event) {
      var password1 = $('input[name="new_password"]').val();
      var password2 = $('input[name="new_password2"]').val();

      // Nếu mật khẩu không trùng nhau, hiển thị thông báo lỗi và ngăn chặn việc gửi form
      if (password1 !== password2) {
        $('#passwordMismatchError').text('Mật khẩu không khớp.');
        event.preventDefault(); // Ngăn chặn gửi form
      } else {
        $('#passwordMismatchError').text(''); // Xóa thông báo lỗi nếu mật khẩu khớp
      }
    });
  });
</script>

<!-- Thêm một phần tử HTML để hiển thị thông báo lỗi -->
