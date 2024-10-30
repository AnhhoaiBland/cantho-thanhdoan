<?php
$url = $_SERVER['REQUEST_URI'];
$lastSegment = basename($url);
?>

<div id="modalAddItemBoSuTap" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="admin/add_Item_DaPhuongTien" method="POST" id="frmAddItemBoSuTap" enctype="multipart/form-data">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm bộ sưu tập mới</h4>
                    <input type="hidden" name="id" value=<?= $lastSegment ?>>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="uploadImages">Chọn 1 hoặc nhiều ảnh/ video:</label>
                        <input type="file" id="uploadImages" name="images[]" multiple>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="frmAddItemBoSuTap" class="btn btn-success">Thêm</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </form>
    </div>
</div>