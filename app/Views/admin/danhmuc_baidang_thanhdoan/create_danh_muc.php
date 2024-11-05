<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Danh Mục Mới</title>
    <style>
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            color: #555;
        }

        button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-note {
            text-align: center;
            color: #777;
            font-size: 14px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Thêm Danh Mục Mới</h2>
        <form action="/admin/dmbaidang_thanhdoan/store" method="post">
            <div class="form-group">
                <label for="parent_id">Danh Mục Cha:</label>
                <input type="number" id="parent_id" name="parent_id" placeholder="Nhập ID danh mục cha">
            </div>

            <div class="form-group">
                <label for="title">Tiêu Đề:</label>
                <input type="text" id="title" name="title" placeholder="Nhập tiêu đề danh mục" required>
            </div>

            <div class="form-group">
                <label for="alias">Alias:</label>
                <input type="text" id="alias" name="alias" placeholder="Nhập alias" required>
            </div>

            <div class="form-group">
                <label for="description">Mô Tả:</label>
                <textarea id="description" name="description" placeholder="Nhập mô tả"></textarea>
            </div>

            <div class="form-group">
                <label for="assoc_id">ID Liên Kết:</label>
                <input type="number" id="assoc_id" name="assoc_id" placeholder="Nhập ID liên kết (nếu có)">
            </div>

            <div class="form-group">
                <label for="enabled">Trạng Thái:</label>
                <select id="enabled" name="enabled">
                    <option value="1">Kích hoạt</option>
                    <option value="0">Vô hiệu hóa</option>
                </select>
            </div>

            <button type="submit">Thêm Danh Mục</button>
        </form>
        <div class="form-note">Vui lòng điền đầy đủ thông tin trước khi thêm danh mục</div>
    </div>
</body>
</html>
