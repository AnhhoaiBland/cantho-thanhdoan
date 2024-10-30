<div id="modalAddBoSuTap" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="admin/add_DaPhuongTien" method="POST" id="frmAddCategory">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Thêm bộ sưu tập mới</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tên bộ sưu</label>
                        <input type="text" id="tenBoSuuTap" name="tenBoSuuTap" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Loại</label>
                        <select name="loai" id="" class="form-control">
                            <option selected value="im">Hình ảnh</option>
                            <option value="vi">video</option>
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