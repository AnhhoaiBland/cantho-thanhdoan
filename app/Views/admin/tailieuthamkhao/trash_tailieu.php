<?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<?php if (session()->has('success')): ?>
    <div class="alert alert-success">
        <?= session('success') ?>
    </div>
<?php endif; ?>
<h3 style="text-align: center; margin-bottom: 30px; font-family: Arial, sans-serif;">Thùng Rác</h3>

<div class="box" style="padding: 20px; border-radius: 10px; background-color: #ffffff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 900px; margin: auto;">
    <!-- Back to List Button -->
    <div style="text-align: right; margin-bottom: 20px;">
        <a href="<?= base_url('/admin/danh_sach_tai_lieu_tham_khao') ?>" class="btn" style="background-color: #3498db; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; transition: background-color 0.3s; font-weight: bold;">
            Trở Về Danh Sách
        </a>
    </div>
    <h4 style="margin-bottom: 20px; color: #333; font-family: Arial, sans-serif;">Danh sách Tệp Đã Xóa</h4>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 40px;">
        <thead>
            <tr style="background-color: #f7f7f7;">
                <th style="padding: 12px; border-bottom: 2px solid #ddd; text-align: left;">Tên Tệp</th>
                <th style="padding: 12px; border-bottom: 2px solid #ddd; text-align: left;">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($deletedFiles as $file): ?>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px;"><?= $file['name'] ?></td>
                    <td style="padding: 10px;">
                        <a href="<?= base_url('admin/tai_lieu_tham_khao/restoreFile/' . $file['id']) ?>" class="btn btn-restore">Khôi Phục</a>
                        <a href="<?= base_url('admin/tai_lieu_tham_khao/permanentlyDeleteFile/' . $file['id']) ?>" class="btn btn-delete">Xóa Vĩnh Viễn</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h4 style="margin-bottom: 20px; color: #333; font-family: Arial, sans-serif;">Danh sách Thư Mục Đã Xóa</h4>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f7f7f7;">
                <th style="padding: 12px; border-bottom: 2px solid #ddd; text-align: left;">Tên Thư Mục</th>
                <th style="padding: 12px; border-bottom: 2px solid #ddd; text-align: left;">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($deletedFolders as $folder): ?>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px;"><?= $folder['name'] ?></td>
                    <td style="padding: 10px;">
                        <a href="<?= base_url('admin/tai_lieu_tham_khao/restoreFolder/' . $folder['id']) ?>" class="btn btn-restore">Khôi Phục</a>
                        <a href="<?= base_url('admin/tai_lieu_tham_khao/permanentlyDeleteFolder/' . $folder['id']) ?>" class="btn btn-delete">Xóa Vĩnh Viễn</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<style>
    /* General styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        color: #333;
    }

    .btn {
        display: inline-block;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s, transform 0.3s;
        border: 1px solid transparent;
    }

    .btn-restore {
        background-color: #4CAF50;
        color: white;
    }

    .btn-restore:hover {
        background-color: #45a049;
        transform: translateY(-1px);
    }

    .btn-delete {
        background-color: #d9534f;
        color: white;
        margin-left: 10px;
    }

    .btn-delete:hover {
        background-color: #c9302c;
        transform: translateY(-1px);
    }

    .box {
        border-radius: 10px;
        background-color: #ffffff;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    th {
        background-color: #f1f1f1;
        font-weight: bold;
    }

    td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }
</style>