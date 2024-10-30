<!-- Modal -->
<div id="modaleditlnd" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <form action="admin/editloainguoidung" method="POST" id="formeditloaind">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Cập nhật loại tài khoản</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
          <input type="hidden" name="maloaindold" id="maloaindold">
          <label for="">Tên loại tài khoản</label>
          <input type="text" id="tenLoaind" name="tenLoaiND" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Ghi chú/ mô tả</label>
          <textarea id="moTaloaind" type="text" name="mota" class="form-control"></textarea>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" form="formeditloaind" class="btn btn-success">Cập nhật</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>
    </div>
    </form>

  </div>
</div>