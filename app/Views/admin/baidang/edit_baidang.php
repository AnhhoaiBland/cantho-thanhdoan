<div class="row">
    <div class="col-md-12">
        <h3>Cập nhật Bài Viết</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form action="admin/save_update_baidang/<?= $baiDangOld[0]['maBaiDang'] ?>" method="POST" style="width:100%"
            enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-5 form-group">
                    <label for="">Ngày đăng </label>
                    <input type="date" disabled value="<?= date('Y-m-d', strtotime($baiDangOld[0]['ngayDang'])); ?>"
                        class='form-control'>
                </div>
                <div class="col-md-5 form-group">
                    <label for="">Người đăng: </label>
                    <?= $baiDangOld[0]['tenNguoiDung'] ?>
                </div>
                <div class="col-md-12 form-group">
                    <label>Tiêu đề</label>
                    <input type="text" id="tieuDeEdit" name="tieude" value="<?= $baiDangOld[0]['tieuDe'] ?>"
                        class="form-control" required="required" placeholder="Nhập tiêu đề bài viết">
                </div>
                <div class="col-md-7 form-group">
                    <label>Đường dẫn bài viết</label>
                    <input type="text" id="duongDanEdit" name="urlBaiDang" value="<?= $baiDangOld[0]['urlBaiDang']?>"
                        class="form-control" required="required" placeholder="Nhập đường dẫn bài viết">
                </div>
                <div class="col-md-7 form-group">
                    <label>Mục Tin</label>
                    <select name="category" class="form-control" required="required">
                        <?php foreach ($ds_category as $category) : ?>
                        <option value="<?= $category['maChuyenMuc'] ?>" <?= $category['maChuyenMuc'] == $baiDangOld[0]['maChuyenMuc'] ? 'selected' : '' ?>>
                            <?= $category['tenChuyenMuc'] ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-12 form-group">
                    <label for="">Hình ảnh</label>
                    <input type="file" id="txt_hinhanh" name="AVATAR" class="form-control">
                    <input type="hidden" name="imgaeBaiVietOld" value="<?= $baiDangOld[0]['anhTieuDe'] ?>">
                    <img src="upload/media/images/<?= $baiDangOld[0]['anhTieuDe'] ?>" alt="Không hiển thị được hình"
                        width="auto" height="100px">
                </div>
                <div class="col-md-12 form-group">
                    <label>Nội dung</label>
                    <textarea name="noidung" id="editor1" cols="30" rows="10" class="form-control"
                        required="required"><?= $baiDangOld[0]['noiDung'] ?></textarea>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-success">Cập nhật</button>
                    <button type="reset" class="btn btn-default">Nhập lại</button>
                </div>
            </div>
        </form>
    </div>
</div>
<style type="text/css">
select option:disabled {
    background: #eee;
}
</style>

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
        filebrowserFlashUploadUrl: 'node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
});

const tieuDeEdit = document.getElementById('tieuDeEdit');
const duongDanEdit = document.getElementById('duongDanEdit');

tieuDeEdit.addEventListener('change', (e) => {
    let vl = e.target.value;
    if (vl != null && vl.length > 0) {
        duongDanEdit.value = slugify(vl)
    }
});

duongDanEdit.addEventListener('focus', () => {
    let vl = tieuDeEdit.value;
    if (vl != null && vl.length > 0) {
        duongDanEdit.value = slugify(vl)
    }
});

function slugify(text) {
    return text.toString().toLowerCase()
        .replace(/\s+/g, '-')           // Replace spaces with -
        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
        .replace(/\-\-+/g, '-')         // Replace multiple - with single -
        .replace(/^-+/, '')             // Trim - from start of text
        .replace(/-+$/, '');            // Trim - from end of text
}
</script>