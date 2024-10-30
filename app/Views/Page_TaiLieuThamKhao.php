<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thư mục tài liệu</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f8f9fa;
    }

    .folder-list,
    .nested {
      list-style-type: none;
    }

    .folder-list {
      margin: 0;
      padding: 0;
    }

    .folder > .caret::before {
      content: "\25B6";
      display: inline-block;
      margin-right: 5px;
      transition: transform 0.3s;
    }

    .folder.open > .caret::before {
      transform: rotate(90deg);
    }

    .nested {
      display: none;
      padding-left: 20px;
      margin-left: 10px;
    }

    .file-tree .folder.open > .nested {
      display: block;
    }

    .folder-name,
    .file-name {
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      font-weight: 500;
      padding: 10px 15px;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .folder-name {
      color: #007bff;
    }

    .folder-name:hover {
      background-color: #e9ecef;
    }

    .file-name {
      color: #6c757d;
    }

    .file-name:hover {
      background-color: #f1f3f5;
    }

    .file .btn {
      padding: 5px 10px;
      font-size: 14px;
      margin-left: 10px;
    }

    .file .btn-outline-primary,
    .file .btn-outline-secondary {
      border-radius: 20px;
    }

    .block_title-gioi-thieu {
      font-weight: 700;
    }

    .container.bg-body {
      background-color: white;
      box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
      border-radius: 15px;
      padding: 2rem;
      margin-bottom: 2rem;
    }

    .heading-title {
      font-size: 28px;
      color: #343a40;
      font-weight: 700;
      margin-bottom: 30px;
    }
  </style>
</head>
<body>

<div class="container p-4 bg-body">
  <div class="row">
    <div class="col-md-12 text-center">
      <h1 class="block_title-gioi-thieu mt-3">SỞ THÔNG TIN VÀ TRUYỀN THÔNG THÀNH PHỐ CẦN THƠ</h1>
      <h3 class="block_title-gioi-thieu">TRUNG TÂM CÔNG NGHỆ THÔNG TIN VÀ TRUYỀN THÔNG THÀNH PHỐ CẦN THƠ</h3>
      <hr style="border: 1px solid #0000; width: 80%; margin: 0 auto;">
      <p>Trụ sở chính: Số 29 Cách Mạng Tháng 8, Phường Thới Bình, Quận Ninh Kiều, TPCT</p>
      <p>ĐT: 0292 3 690 888 | Fax: 08 07 12 13 | Website: <a href="http://ctict.cantho.gov.vn">http://ctict.cantho.gov.vn</a> | Email: <a href="mailto:ctict@cantho.gov.vn">ctict@cantho.gov.vn</a></p>
    </div>
  </div>
</div>

<!-- Folder and File Tree Structure -->
<div class="container p-4 bg-body">
  <h2 class="heading-title mb-4 text-center">Thư mục tài liệu</h2>
  <div class="file-tree">
    <ul class="folder-list">
      <?php foreach ($folders as $folder): ?>
        <li class="folder">
          <!-- Main Folder -->
          <span class="caret folder-name">
            <i class="fas fa-folder-open me-2"></i><?= $folder['name'] ?>
          </span>

          <!-- Check for Subfolders and Files -->
          <?php if (!empty($folder['files']) || !empty($folder['subfolders'])): ?>
            <ul class="nested">
              <!-- Display Files in the Folder -->
              <?php foreach ($folder['files'] as $file): ?>
                <li class="file d-flex align-items-center">
                  <span class="file-name">
                    <i class="fas fa-file-alt me-2"></i><?= $file['name'] ?>
                  </span>
                  <a href="<?= base_url($file['file_path']) ?>" class="btn btn-sm btn-outline-primary ms-2" download>Tải Về</a>
                  <a href="<?= base_url($file['file_path']) ?>" class="btn btn-sm btn-outline-secondary ms-2" target="_blank">Xem Trước</a>
                </li>
              <?php endforeach; ?>

              <!-- Display Subfolders Recursively -->
              <?php if (!empty($folder['subfolders'])): ?>
                <?php foreach ($folder['subfolders'] as $subfolder): ?>
                  <?= view('partials/_folder', ['folder' => $subfolder]) ?>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<!-- Expand/Collapse Script for Folder Tree -->
<script>
  document.querySelectorAll('.folder > .caret').forEach(caret => {
    caret.addEventListener('click', function() {
      const parentFolder = this.parentElement;
      parentFolder.classList.toggle('open');
    });
  });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
