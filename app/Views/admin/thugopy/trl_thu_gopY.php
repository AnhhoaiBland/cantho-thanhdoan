<?php if (isset($errr)) echo '<h1> lỗi </h1>' ?>

<div class="row">
    <div class="col-md-12">
        <h3>Trả lời thư góp ý</h3>
    </div>
</div>
<hr>
<form  action="admin/add_phan_hoi_thugopy" method="post">

    <div class="row">
        <div class="col-md-6">
            <label for="" class="form-label">Họ và tên người gửi</label>
            <input type="hidden" class="form-control" name="id" value=<?= $thu_gopY[0]['maThuGopY'] ?>>
            <input type="text" class="form-control" name="hoten" value=<?= $thu_gopY[0]['hoTen'] ?>>
        </div>
        <div class="col-md-3">
            <label for="" class="form-label">Thời gian tiếp nhận thư</label>
            <input type="text" class="form-control" readonly value=<?= date('d/m/Y', strtotime($thu_gopY[0]['ngayTao'])) ?>>
        </div>
        <?php if (isset($thu_gopY[0]['thoiGianPhanHoi'])) { ?>
            <div class="col-md-3">
                <label for="" class="form-label">Thời gian phản hồi trước</label>
                <input type="text" class="form-control" readonly value=<?= date('d/m/Y', strtotime($thu_gopY[0]['thoiGianPhanHoi'])) ?>>
            </div>
        <?php } ?>

    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <label for="" required class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" name="sodienthoai" value=<?= $thu_gopY[0]['soDienThoai'] ?>>
        </div>
        <div class="col-md-5">
            <label for="" class="form-label">Email</label>
            <input type="text" class="form-control" name="email" value=<?= $thu_gopY[0]['email'] ?>>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <label for="" class="form-label">Tiêu đề thư góp ý</label>
            <input type="text" required class="form-control" name="tieuDe" value=<?= $thu_gopY[0]['tieuDe'] ?>>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12 form-group">
            <label>Nội dung</label>
            <textarea name="noidung" required id="editor1" cols="30" rows="10" class="form-control" required="required"><?= $thu_gopY[0]['noiDung'] ?> </textarea>
        </div>
    </div>


    <div class="row  mt-3">
        <div class="col-md-2 form-group">
            <label>Hình thức trả lời thư:</label>
            <select name="hinhThuc_tl" class="form-control">

                <option value="em" <?= $thu_gopY[0]['dangPhanHoi'] == 'em' ? "selected" : '' ?>>Email</option>
                <option value="call" <?= $thu_gopY[0]['dangPhanHoi'] == 'call' ? "selected" : '' ?>>Gọi điện trực tiếp</option>
                <option value="sms" <?= $thu_gopY[0]['dangPhanHoi'] == 'sms' ? "selected" : '' ?>>Qua tin nhắn điện thoại</option>
                <option value="zalo" <?= $thu_gopY[0]['dangPhanHoi'] == 'zalo' ? "selected" : '' ?>>Qua Zalo</option>
            </select>
        </div>
        <?php if (isset($thu_gopY[0]['tenNguoiDungPhanHoi'])) { ?>
            <div class="col-md-3">
                <label for="" class="form-label">Người phản hồi trước</label>
                <input type="text" class="form-control" readonly value=<?= $thu_gopY[0]['tenNguoiDungPhanHoi'] ?>>
            </div>
        <?php } ?>

    </div>

    <div class="row mt-3">
        <div class="col-md-12 form-group">
            <label>Nội dung trả lời</label>
            <textarea name="noidung_tl" id="editor2" cols="30" rows="10" class="form-control" required="required"><?= $thu_gopY[0]['noiDungTraLoiGopY'] ?></textarea>
        </div>
    </div>

    <div class="col-md-12">
        <button type="submit" class="btn btn-success">Xác nhận phản hồi</button>
        <a href=<?= base_url("admin/hopthu") ?> class="btn btn-danger" style="width: 100px; color: white;">Hủy</a>
    </div>

</form>


<script>
    $(document).ready(function() {
        $('input[required], select[required], textarea[required]').each(function() {
            console.log(this);
            $(this).parent().find('label').append('<span class="text-red">(*)</span>');
        });
        $('.select2').select2();

        CKEDITOR.replace('editor1', {
            language: 'vi',
            filebrowserBrowseUrl: 'node_modules/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl: 'node_modules/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl: 'node_modules/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl: 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl: 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
            // Tùy chỉnh thanh công cụ
            toolbar: [{
                    name: 'document',
                    items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates']
                },
                {
                    name: 'clipboard',
                    items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
                },
                {
                    name: 'editing',
                    items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                },
                {
                    name: 'insert',
                    items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak']
                },
                {
                    name: 'styles',
                    items: ['Styles', 'Format']
                },
                {
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
                },
                {
                    name: 'paragraph',
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
                },
                {
                    name: 'links',
                    items: ['Link', 'Unlink', 'Anchor']
                },
                {
                    name: 'tools',
                    items: ['Maximize']
                }
            ]
        });

        CKEDITOR.replace('editor2', {
            language: 'vi',
            filebrowserBrowseUrl: 'node_modules/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl: 'node_modules/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl: 'node_modules/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl: 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl: 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
            // Tùy chỉnh thanh công cụ
            toolbar: [{
                    name: 'document',
                    items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates']
                },
                {
                    name: 'clipboard',
                    items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
                },
                {
                    name: 'editing',
                    items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                },
                {
                    name: 'insert',
                    items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak']
                },
                {
                    name: 'styles',
                    items: ['Styles', 'Format']
                },
                {
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
                },
                {
                    name: 'paragraph',
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
                },
                {
                    name: 'links',
                    items: ['Link', 'Unlink', 'Anchor']
                },
                {
                    name: 'tools',
                    items: ['Maximize']
                }
            ]
        });
    });

    const tieuDeEdit = document.getElementById('tieuDeEdit');
    const duongDanEdit = document.getElementById('duongDanEdit');

    tieuDeEdit.addEventListener('change', (e) => {
        let vl = e.target.value;
        if (vl != null && vl.length > 0) {
            duongDanEdit.value = slugify(vl)
        }
    })
</script>