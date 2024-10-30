<!-- Modal -->
<div id="modalthugopy" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <form action="admin/addloainguoidung" method="POST" id="formphanhoi">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Thêm loại tài khoản</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
          <label for="">Tên loại tài khoản</label>
          <input type="text" name="tenLoaiND" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Ghi chú/ mô tả</label>
          <textarea type="text" name="mota" class="form-control"></textarea>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" form="formphanhoi" class="btn btn-success">Thêm</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>
    </div>
    </form>

  </div>
</div>