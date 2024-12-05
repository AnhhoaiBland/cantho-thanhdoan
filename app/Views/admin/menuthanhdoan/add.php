<form action="<?= site_url('/admin/menuthanhdoan/addMenu') ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="title">Tên Menu:<span class="required-star">*</span></label>
        <input type="text" id="title" name="title" class="form-control" value="<?= old('title') ?>" placeholder="Nhập tiêu đề menu" required>
        <?php if (isset($errors['title'])): ?>
            <div class="text-danger"><?= $errors['title'] ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="url">Đường Dẫn URL:<span class="required-star">*</span></label>
        <input type="text" id="url" name="url" class="form-control" value="<?= old('url') ?>" placeholder="Nhập đường dẫn menu" required>
        <?php if (isset($errors['url'])): ?>
            <div class="text-danger"><?= $errors['url'] ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="parent_id">Menu Cha:</label>
        <select id="parent_id" name="parent_id" class="form-control" onchange="checkMenuParent()">
            <option value="">Chọn Menu Cha ( Nếu không là menu cha )</option>
            <!-- Lấy danh sách menu cha từ cơ sở dữ liệu -->
            <?php foreach ($laymenucha as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="menu_group">Nhóm Menu:</label>
        <select id="menu_group" name="menu_group" class="form-control">
            <option value="">Chọn nhóm menu</option>
            <option value="1">Menu ngang</option>
            <option value="2">Menu dọc</option>
            <option value="3">Menu footer</option>
        </select>
    </div>


    <div class="form-group">
        <label for="enabled">Trạng Thái:</label>
        <select id="enabled" name="enabled" class="form-control">
            <option value="1" <?= old('enabled', '1') == '1' ? 'selected' : '' ?>>Kích Hoạt</option>
            <option value="0" <?= old('enabled') == '0' ? 'selected' : '' ?>>Vô Hiệu Hóa</option>
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Thêm Menu</button>
    </div>
</form>
<script>
    function checkMenuParent() {
        var parentSelect = document.getElementById("parent_id");
        var menuGroupSelect = document.getElementById("menu_group");

        if (parentSelect.value) {
            // Nếu đã chọn menu cha, ẩn nhóm menu và đặt giá trị là ""
            menuGroupSelect.disabled = true;
            menuGroupSelect.value = ""; // Không cho chọn nhóm menu khi có menu cha
        } else {
            // Nếu không chọn menu cha, cho phép chọn nhóm menu
            menuGroupSelect.disabled = false;
        }
    }
</script>