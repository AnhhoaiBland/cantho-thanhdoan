

<div class="mt-3">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-primary fw-bold">Cấu hình thông tin website</h3>
            <p class="text-muted">Chỉnh sửa thông tin hiển thị trên trang web của bạn</p>
        </div>
    </div>
    <hr>

    <form action="admin/luuthongtinweb" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="pageHeading" class="form-label fw-bold">Chữ chạy đầu trang</label>
            <input type="text" class="form-control" value="<?= $Chu_chay ?>" id="pageHeading" name="pageHeading" placeholder="Nhập chữ chạy đầu trang">
        </div>

        <div class="mb-3">
            <label for="logo" class="form-label fw-bold">Logo <i class="text-danger">*</i></label>
            <div class="row">
                <div class="col-md-6">
                    <?php if ($checkQuyen == '1') { ?>
                        <input type="file" class="form-control form-control-lg" id="logo_img" name="logo_img">
                    <?php } ?>
                </div>
                <div class="col-md-6 text-center">
                    <img src="<?= "upload/media/images/" . $logo ?>" class="img-fluid rounded shadow-sm" style="max-width: 200px; max-height: 200px; object-fit: contain;">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="slogan" class="form-label fw-bold">Khẩu hiệu <i class="text-danger">*</i></label>
            <input type="text" class="form-control" value="<?= $slogan ?>" id="slogan" name="slogan" placeholder="Nhập khẩu hiệu">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label fw-bold">Địa chỉ <i class="text-danger">*</i></label>
            <input type="text" class="form-control" id="address" value="<?= $address ?>" name="address" placeholder="Nhập địa chỉ">
        </div>

        <div class="mb-3">
            <label for="phoneNumber" class="form-label fw-bold">Số điện thoại <i class="text-danger">*</i></label>
            <input type="tel" class="form-control" id="phoneNumber" value="<?= $phoneNumber ?>" name="phoneNumber" placeholder="Nhập số điện thoại">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email <i class="text-danger">*</i></label>
            <input type="email" class="form-control" id="email" value="<?= $email ?>" name="email" placeholder="Nhập địa chỉ email">
        </div>

        <div class="mb-3">
            <label for="faxNumber" class="form-label fw-bold">Số fax <i class="text-danger">*</i></label>
            <input type="tel" class="form-control" id="faxNumber" value="<?= $faxNumber ?>" name="faxNumber" placeholder="Nhập số fax">
        </div>

        <div class="mb-3">
            <label for="facebook" class="form-label fw-bold">Facebook</label>
            <input type="url" class="form-control" id="facebook" value="<?= $facebook ?>" name="facebook" placeholder="Nhập liên kết Facebook">
        </div>

        <div class="mb-3">
            <label for="map" class="form-label fw-bold">Bản đồ <i class="text-danger">*</i></label>
            <input type="text" class="form-control" id="map" value="<?= htmlspecialchars(str_replace('  ', '', $map)) ?>" name="map" placeholder="Nhập liên kết bản đồ">
        </div>

        <div class="mb-3">
            <label for="responsiblePerson" class="form-label fw-bold">Người chịu trách nhiệm <i class="text-danger">*</i></label>
            <input type="text" class="form-control" id="responsiblePerson" value="<?= $responsiblePerson ?>" name="responsiblePerson" placeholder="Nhập tên người chịu trách nhiệm">
        </div>

        <div class="mb-3 mt-3">
            <label for="responsiblePerson" class="form-label fw-bold">Hiển thị Block</label>
            <div class="form-check form-switch">
                <input class="form-check-input" name="showTVAnh" type="checkbox" <?= $showTVAnh ? 'checked' : '' ?> id="flexCheckChecked1">
                <label class="form-check-label" for="flexCheckChecked1">
                    Hiển thị thư viện ảnh
                </label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" name="showTVVideo" type="checkbox" <?= $showTVVideo ? 'checked' : '' ?> id="flexCheckChecked2">
                <label class="form-check-label" for="flexCheckChecked2">
                    Hiển thị thư viện video
                </label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" name="showThuGopY" type="checkbox" <?= $showThuGopY ? 'checked' : '' ?> id="flexCheckChecked3">
                <label class="form-check-label" for="flexCheckChecked3">
                    Hiển thị trả lời thư góp ý
                </label>
            </div>
        </div>

        <div class="mb-3">
            <label for="responsiblePerson" class="form-label fw-bold">Liên kết đến các trang <i class="text-danger">*</i></label>
            <div class="col-md-8">
                <table class="table table-bordered table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>Tên liên kết</th>
                            <th>Đường dẫn liên kết</th>
                            <?php if ($checkQuyen == '1') { ?>
                                <th>Hành động</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody id="table_main">
                        <?php
                        if (!empty($banLienKet)) {
                            foreach ($banLienKet as $key => $value) {
                        ?>
                                <tr>
                                    <td><?= str_replace('{"', '', $key) ?></td>
                                    <td><?= str_replace('"}', '', $value) ?></td>
                                    <?php if ($checkQuyen == '1') { ?>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" id="xoa">Xóa</button>
                                            <button type="button" class="btn btn-primary btn-sm" id="sua">Sửa</button>
                                        </td>
                                    <?php } ?>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php if ($checkQuyen == '1') { ?>
                <div class="row">
                    <div class="col-md-12">
                        <label for="newLink" class="form-label fw-bold mt-3">Thêm liên kết trang</label>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="tenLienKet" placeholder="Tên liên kết" name="tenLienKet">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="duongDan" placeholder="Đường dẫn liên kết" name="duongDan">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success w-100" id="appLienKet">Thêm</button>
                                <button type="button" class="btn btn-primary w-100 mt-2" id="capNhatLienKet">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php if ($checkQuyen == '1') { ?>
            <div class="mt-5">
                <div class="row">
                    <div class="col-md-4">
                        <button class="btn btn-primary btn-lg w-100" type="submit">Cập nhật thông tin</button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </form>
</div>

<style>
    .form-label {
        font-weight: bold;
        font-size: 16px;
    }

    .form-control {
        font-size: 15px;
        padding: 10px;
        border-radius: 10px;
    }

    .btn {
        font-size: 14px;
        padding: 8px 12px;
    }

    table.table thead {
        background-color: #f8f9fa;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }
</style>
