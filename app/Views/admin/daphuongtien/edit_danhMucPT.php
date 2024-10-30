<div id="modalEditBoSuTap" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="admin/edit_DaPhuongTien" method="POST" id="frmEditCategory">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" id="maBST" name="maBST">
                    <h4 class="modal-title">Cập nhật thông tin bộ sưu tập</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tên bộ sưu</label>
                        <input type="text" id="tenBoSuuTapEdit" name="tenBoSuuTap" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Loại</label>
                        <select name="loai" id="loai" class="form-control">
                            <option selected value="im">Hình ảnh</option>
                            <option value="vi">video</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="moTa">Mô tả</label>
                        <textarea class="form-control" name="moTa" id="moTa" ></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="frmEditCategory" class="btn btn-success">Cập nhật</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </form>

    </div>
</div>