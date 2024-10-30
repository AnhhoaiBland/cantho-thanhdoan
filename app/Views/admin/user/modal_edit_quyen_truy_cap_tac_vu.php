<!-- Modal -->
<div id="modalquyentruycaptacvu" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="admin/themtacvuchonloaind" method="POST" id="formeditquyntruycaptacvu">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Cập nhật quyền truy cập tác vụ cho loại tài khoản</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="min-height: 300px;">
                    <div class="form-group">
                        <label for="">Khi cập nhật sẽ xóa tất cả quyền thuộc loại người dùng trước đó</label>
                    </div>
                    <div class="form-group">
                        <label for="">Tên loại tài khoản</label>
                        <input type="text" id="ten_loaind" disabled name="new_hoten" class="form-control">
                        <input type="hidden" id="id_loaind" name="new_hoten" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Chọn tác vụ</label>
                        <select class="form-select" name="listtacvu" id="multiple-select-field" data-placeholder="Choose anything" multiple></select>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="selectAllCheckbox">
                            <label class="form-check-label" for="selectAllCheckbox">
                                Chọn tất cả
                            </label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" form="formeditquyntruycaptacvu" class="btn btn-success">Thêm</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </form>

    </div>
</div>

<script>
    $(document).ready(function() {
        // Xử lý sự kiện khi checkbox được thay đổi
        $('#selectAllCheckbox').change(function() {
            if ($(this).is(':checked')) {
                $('#multiple-select-field').find('option').prop('selected', true);
                $(this).next('label').text('Bỏ chọn tất cả');
            } else {
                $('#multiple-select-field').find('option').prop('selected', false);
                $(this).next('label').text('Chọn tất cả');
            }
            $('#multiple-select-field').trigger('change');
        });


        $('#multiple-select-field').change(function() {
            if ($(this).find('option:selected').length === $(this).find('option').length) {
                $('#selectAllCheckbox').prop('checked', true);
                $('#selectAllCheckbox').next('label').text('Bỏ chọn tất cả');
            } else {
                $('#selectAllCheckbox').prop('checked', false);
                $('#selectAllCheckbox').next('label').text('Chọn tất cả');
            }
        });
    });
</script>