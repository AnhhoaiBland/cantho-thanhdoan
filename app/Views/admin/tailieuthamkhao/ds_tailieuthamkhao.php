<head>
    <style>
        /* Remove default bullets */
        ul,
        #myUL {
            list-style-type: none;
        }

        /* Remove margins and padding from the parent ul */
        #myUL {
            margin: 0;
            padding: 0;
        }

        /* Style the caret/arrow */
        .caret {
            cursor: pointer;
            user-select: none;
            display: inline-flex;
            align-items: center;
            font-size: 16px;
            transition: color 0.2s;
        }

        /* Create the caret/arrow with a unicode, and style it */
        .caret::before {
            content: "\25B6";
            color: #333;
            display: inline-block;
            margin-right: 8px;
            transition: transform 0.2s, color 0.2s;
        }

        /* Rotate the caret/arrow icon when clicked */
        .caret-down::before {
            transform: rotate(90deg);
        }

        /* Hide the nested list */
        .nested {
            display: none;
        }

        /* Show the nested list when active */
        .active {
            display: table-row;
        }

        /* Add folder and file icons */
        .folder-icon::before {
            content: "\1F4C1";
            /* Folder emoji icon */
            margin-right: 8px;
        }

        .file-icon::before {
            content: "\1F4C4";
            /* File emoji icon */
            margin-right: 8px;
        }

        /* Adjust font size and spacing for list items */
        li {
            font-size: 15px;
            line-height: 1.5;
            padding-left: 4px;
            padding-top: 4px;
        }

        /* Hover effects */
        .caret:hover,
        .file-icon:hover {
            color: #0056b3;
        }

        /* Responsive design */
        @media screen and (max-width: 600px) {
            .caret {
                font-size: 14px;
            }

            li {
                font-size: 13px;
            }
        }

        /* Add button styles */
        .btn {
            font-size: 14px;
            padding: 8px 12px;
            margin-left: 8px;
            cursor: pointer;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .btn i {
            font-size: 16px;
        }

        .btn:hover {
            background-color: #0056b3;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        /* Style the box around the file structure */
        .box {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
            width: 100%;
            margin: 0 auto;
            max-width: 100%;
        }

        /* Style the table for full width display */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed;
            /* Ensure cells distribute evenly */
        }

        table th,
        table td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
            word-wrap: break-word;
            /* Ensure text wraps properly */
        }

        table th {
            background-color: #f1f1f1;
        }

        /* Align nested folders and files correctly */
        .nested td {
            padding-left: 40px;
            /* Indent nested rows */
        }

        /* Modal Styles */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            /* Black with opacity */
            overflow: auto;
            /* Enable scroll if needed */
            backdrop-filter: blur(4px);
            /* Optional blur effect */
        }


        /* Modal content */
        .modal-content {
            background-color: #ffffff;
            margin: 10% auto;
            /* 10% from the top and centered */
            padding: 20px;
            border-radius: 10px;
            /* Rounded corners */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            /* Subtle shadow */
            width: 90%;
            max-width: 500px;
            /* Responsive width */
            transition: transform 0.3s ease, opacity 0.3s ease;
            /* Smooth transitions */
        }

        /* Close button style */
        .close {
            color: #333;
            float: right;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.2s;
        }

        .close:hover,
        .close:focus {
            color: #ff0000;
            /* Red when hovered */
        }

        /* Form styling inside the modal */
        #folderForm label,
        #folderForm input {
            margin-bottom: 10px;
        }

        #folderForm input[type="text"] {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
        }

        #folderForm button {
            padding: 10px;
            font-size: 16px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #folderForm button:hover {
            background-color: #218838;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        form label {
            margin-bottom: 8px;
            font-weight: bold;
        }

        form input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            transition: border-color 0.3s;
        }

        form input[type="text"]:focus {
            border-color: #007BFF;
            /* Blue border when focused */
        }

        form button {
            padding: 12px;
            font-size: 16px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        form button:hover {
            background-color: #218838;
            /* Darker green on hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Slight shadow */
        }

        /* Title styling */
        .modal-title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>


<body>
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

    <h3 style="text-align: center;">Danh Sách Thư Mục Và Tài Liệu</h3>

    <!-- Folder Modal for Creating Subfolders -->
    <div id="folderModal" class="modal" style="display: none;">
        <div class="modal-content" style="width: 500px; margin: 100px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
            <span class="close" style="float: right; font-size: 20px; cursor: pointer;">&times;</span>
            <h2 style="text-align: center; margin-bottom: 20px;">Thêm Thư Mục Mới</h2>
            <form action="<?= base_url('/admin/danh_sach_tai_lieu_tham_khao/addFolder') ?>" method="POST">
                <div style="margin-bottom: 15px;">
                    <label for="title" style="display: block; margin-bottom: 5px;">Tiêu Đề:</label>
                    <input type="text" id="title" name="title" required style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="folderName" style="display: block; margin-bottom: 5px;">Tên Thư Mục:</label>
                    <input type="text" id="folderName" name="folderName" required style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="publicationDate" style="display: block; margin-bottom: 5px;">Ngày Công Bố:</label>
                    <input type="date" id="publicationDate" name="publicationDate" style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                </div>
                <input type="hidden" id="parentFolder" name="parentFolder">
                <div style="text-align: center;">
                    <button type="submit" class="btn" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Thêm</button>
                </div>
            </form>
        </div>
    </div>

    <!-- File Upload Modal -->
    <div id="fileModal" class="modal" style="display: none;">
        <div class="modal-content" style="width: 500px; margin: 100px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
            <span class="close" style="float: right; font-size: 20px; cursor: pointer;">&times;</span>
            <h2 style="text-align: center; margin-bottom: 20px;">Thêm Tệp Mới</h2>
            <form action="<?= base_url('/admin/danh_sach_tai_lieu_tham_khao/addFile') ?>" method="POST" enctype="multipart/form-data">
                <!-- <div style="margin-bottom: 15px;">
                    <label for="fileName" style="display: block; margin-bottom: 5px;">Tên Hiển Thị Của Tệp:</label>
                    <input type="text" id="fileName" name="fileName" required style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                </div> -->
                <div style="margin-bottom: 15px;">
                    <label for="file" style="display: block; margin-bottom: 5px;">Chọn Tệp:</label>
                    <input type="file" id="file" name="files[]" multiple required style="display: none;">
                    <label for="file" class="custom-file-upload" style="display: inline-block; background-color: #008CBA; color: white; padding: 10px 20px; border-radius: 4px; cursor: pointer;">
                        Chọn Tệp
                    </label>
                    <span id="fileNameLink" style="margin-left: 10px; font-style: italic;"></span>

                </div>
                <input type="hidden" id="folderId" name="folderId">
                <div style="text-align: center;">
                    <button type="submit" class="btn" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Tải lên</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal chỉnh sửa tên thư mục và ngày công bố -->
    <div id="editFolderModal" class="modal" style="display: none;">
        <div class="modal-content" style="width: 500px; margin: 100px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
            <span class="close" style="float: right; font-size: 20px; cursor: pointer;">&times;</span>
            <h2 style="text-align: center; margin-bottom: 20px;">Sửa Tên Thư Mục</h2>
            <form action="<?= base_url('/admin/danh_sach_tai_lieu_tham_khao/editFolder') ?>" method="POST">
                <input type="hidden" id="editFolderId" name="folderId">
                <div style="margin-bottom: 15px;">
                    <label for="editFolderName" style="display: block; margin-bottom: 5px;">Tên Thư Mục Mới:</label>
                    <input type="text" id="editFolderName" name="folderName" required style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="editPublicationDate" style="display: block; margin-bottom: 5px;">Ngày Công Bố:</label>
                    <input type="date" id="editPublicationDate" name="publicationDate" style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                </div>
                <div style="text-align: center;">
                    <button type="submit" class="btn" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal chỉnh sửa tên tệp và chọn tệp khác -->
    <div id="editFileModal" class="modal" style="display: none;">
        <div class="modal-content" style="width: 500px; margin: 100px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
            <span class="close" style="float: right; font-size: 20px; cursor: pointer;">&times;</span>
            <h2 style="text-align: center; margin-bottom: 20px;">Sửa Tên Tệp Và Chọn Tệp Khác</h2>
            <form action="<?= base_url('/admin/danh_sach_tai_lieu_tham_khao/editFile') ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="editFileId" name="fileId">
                <div style="margin-bottom: 15px;">
                    <label for="editFileName" style="display: block; margin-bottom: 5px;">Tên Hiển Thị Của Tệp:</label>
                    <input type="text" id="editFileName" name="fileName" required style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="editFile" style="display: block; margin-bottom: 5px;">Chọn Tệp:</label>
                    <input type="file" id="editFile" name="file" style="display: none;">
                    <label for="editFile" class="custom-file-upload" style="display: inline-block; background-color: #008CBA; color: white; padding: 10px 20px; border-radius: 4px; cursor: pointer;">
                        Chọn Tệp
                    </label>
                    <!-- Hiển thị tên file đã chọn -->
                    <span id="editFileNameLink" style="margin-left: 10px; font-style: italic;"></span>
                </div>
                <div style="text-align: center;">
                    <button type="submit" class="btn" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>

    <div class="box">
        <!-- Button to add a new main folder -->
        <div style="margin-bottom: 20px; text-align: right;">
            <button class="btn" id="add-main-folder" title="Thêm Thư Mục Chính">
                <i class="fas fa-folder-plus"></i> Thêm Thư Mục <!-- Folder Plus Icon -->
            </button>
            <a href="<?= base_url('/admin/trash') ?>" class="btn" title="Thùng Rác">
                <i class="fas fa-trash"></i> Thùng Rác
            </a>
        </div>


        <!-- Table structure to display folders and files -->
        <table>
            <thead>
                <tr>
                    <th>Thư mục / Tệp tin</th>
                    <th>Ngày Công Bố</th> <!-- Thêm cột Ngày Công Bố -->
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody id="folder-structure">
                <!-- Loop through the top-level folders -->
                <?php foreach ($folders as $folder): ?>
                    <!-- Display main folder -->
                    <tr data-id="<?= $folder['id'] ?>" data-parent-id="<?= $folder['parent_id'] ?>">
                        <td>
                            <div class="table-actions">
                                <span class="caret folder-icon"><?= $folder['name'] ?></span>
                            </div>
                        </td>
                        <td>
                            <?= $folder['publication_date'] ?? 'Không có' ?> <!-- Hiển thị ngày công bố hoặc thông báo không có -->
                        </td>
                        <td>
                            <!-- Add buttons for uploading files and adding subfolders -->
                            <button class="btn" onclick="addSubfolder('<?= $folder['id'] ?>')" title="Thêm Thư Mục Con">
                                <i class="fas fa-folder-plus"></i>
                            </button>
                            <button class="btn" onclick="addFile('<?= $folder['id'] ?>')" title="Thêm Tệp">
                                <i class="fas fa-file-upload"></i>
                            </button>
                            <button class="btn" onclick="editFolder('<?= $folder['id'] ?>', '<?= $folder['name'] ?>')" title="Sửa Tên Thư Mục">
                                <i class="fas fa-edit"></i> <!-- Icon chỉnh sửa -->
                            </button>
                            <button class="btn" onclick="deleteFolder('<?= $folder['id'] ?>')" title="Xóa Thư Mục">
                                <i class="fas fa-trash"></i> <!-- Icon xóa -->
                            </button>
                        </td>
                    </tr>

                    <!-- Display files inside the main folder -->
                    <?php if (!empty($folder['files'])): ?>
                        <?php foreach ($folder['files'] as $file): ?>
                            <tr class="nested" data-parent-id="<?= $folder['id'] ?>" style="display: none;">
                                <td style="padding-left: 40px;">
                                    <span class="file-icon"><?= $file['name'] ?></span>
                                </td>
                                <td>
                                    <?= $folder['publication_date'] ?? 'Không có' ?> <!-- Hiển thị ngày công bố hoặc thông báo không có -->
                                </td>
                                <td>
                                    <!-- Nút sửa tên file -->
                                    <button class="btn" onclick="editFileName('<?= $file['id'] ?>', '<?= $file['name'] ?>')" title="Sửa Tên Tệp Tin">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <!-- Nút tải về file -->
                                    <a class="btn" href="<?= base_url($file['file_path']) ?>" title="Tải Về Tệp Tin">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <!-- Nút xóa file -->
                                    <button class="btn" onclick="deleteFile('<?= $file['id'] ?>')" title="Xóa Tệp Tin">
                                        <i class="fas fa-trash"></i> <!-- Icon xóa -->
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <!-- Recursively display subfolders and their files -->
                    <?php if (!empty($folder['subfolders'])): ?>
                        <?php foreach ($folder['subfolders'] as $subfolder): ?>
                            <?= renderFolder($subfolder, 40); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>

            <?php
            // Helper function to recursively render folders and files
            function renderFolder($folder, $padding)
            {
            ?>
                <!-- Subfolder row -->
                <tr data-id="<?= $folder['id'] ?>" data-parent-id="<?= $folder['parent_id'] ?>" style="display: none;">
                    <td style="padding-left: <?= $padding ?>px;">
                        <div class="table-actions">
                            <span class="caret folder-icon"><?= $folder['name'] ?></span>
                        </div>
                    </td>
                    <td>
                        <?= $folder['publication_date'] ?? 'Không có' ?> <!-- Hiển thị ngày công bố hoặc thông báo không có -->
                    </td>
                    <td>
                        <button class="btn" onclick="addSubfolder('<?= $folder['id'] ?>')" title="Thêm Thư Mục Con">
                            <i class="fas fa-folder-plus"></i>
                        </button>
                        <button class="btn" onclick="addFile('<?= $folder['id'] ?>')" title="Thêm Tệp">
                            <i class="fas fa-file-upload"></i>
                        </button>
                        <button class="btn" onclick="editFolder('<?= $folder['id'] ?>', '<?= $folder['name'] ?>')" title="Sửa Tên Thư Mục">
                            <i class="fas fa-edit"></i> <!-- Icon chỉnh sửa -->
                        </button>
                        <button class="btn" onclick="deleteFolder('<?= $folder['id'] ?>')" title="Xóa Thư Mục">
                            <i class="fas fa-trash"></i> <!-- Icon xóa -->
                        </button>
                    </td>
                </tr>

                <!-- Display files in the subfolder -->
                <?php if (!empty($folder['files'])): ?>
                    <?php foreach ($folder['files'] as $file): ?>
                        <tr class="nested" data-parent-id="<?= $folder['id'] ?>" style="display: none;">
                            <td style="padding-left: <?= $padding + 20 ?>px;">
                                <span class="file-icon"><?= $file['name'] ?></span>
                            </td>
                            <td>
                                <!-- Nút sửa tên file -->
                                <button class="btn" onclick="editFileName('<?= $file['id'] ?>', '<?= $file['name'] ?>')" title="Sửa Tên Tệp Tin">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <!-- Nút tải về file -->
                                <a class="btn" href="<?= base_url($file['file_path']) ?>" title="Tải Về Tệp Tin">
                                    <i class="fas fa-download"></i>
                                </a>
                                <!-- Nút xóa file -->
                                <button class="btn" onclick="deleteFile('<?= $file['id'] ?>')" title="Xóa Tệp Tin">
                                    <i class="fas fa-trash"></i> <!-- Icon xóa -->
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- Recursively display deeper subfolders -->
                <?php if (!empty($folder['subfolders'])): ?>
                    <?php foreach ($folder['subfolders'] as $subfolder): ?>
                        <?= renderFolder($subfolder, $padding + 20); ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php
            }
            ?>
        </table>
    </div>

    <script>
        // Handle opening file upload modal with folder ID
        function addFile(folderId) {
            var fileModal = document.getElementById("fileModal");
            var fileFolderIdInput = document.getElementById("folderId");
            var fileInput = document.getElementById('file');
            var fileNameLink = document.getElementById('fileNameLink');

            fileInput.onchange = function() {
                if (fileInput.files.length > 0) {
                    let fileNames = Array.from(fileInput.files).map(file => file.name).join(', ');
                    fileNameLink.textContent = 'Tệp đã chọn: ' + fileNames;
                }
            };

            fileFolderIdInput.value = folderId; // Set the folder ID in the hidden input field
            fileModal.style.display = "block"; // Display the modal
        }

        // Open modal for adding subfolder with parent folder ID
        function addSubfolder(parentFolderId) {
            var folderModal = document.getElementById("folderModal");
            var parentFolderInput = document.getElementById("parentFolder");

            parentFolderInput.value = parentFolderId; // Set parent folder ID
            folderModal.style.display = "block"; // Show the modal
        }

        function editFolder(folderId, folderName, publicationDate) {
            var editModal = document.getElementById("editFolderModal");
            document.getElementById("editFolderId").value = folderId;
            document.getElementById("editFolderName").value = folderName;
            document.getElementById("editPublicationDate").value = publicationDate || ""; // Thiết lập ngày công bố nếu có
            editModal.style.display = "block";
        }



        // Open modal for editing file name and selecting a new file
        function editFileName(fileId, fileName) {
            var editModal = document.getElementById("editFileModal");
            document.getElementById("editFileId").value = fileId;
            document.getElementById("editFileName").value = fileName;
            editModal.style.display = "block";
        }


        function deleteFolder(folderId) {
            if (confirm('Bạn có chắc chắn muốn xóa thư mục này và tất cả nội dung bên trong?')) {
                // Nếu người dùng đồng ý, gửi yêu cầu xóa thư mục
                window.location.href = '/admin/danh_sach_tai_lieu_tham_khao/deleteFolder/' + folderId;
            }
        }

        // Hàm xác nhận xóa tệp tin
        function deleteFile(fileId) {
            if (confirm('Bạn có chắc chắn muốn xóa tệp tin này?')) {
                // Nếu người dùng đồng ý, gửi yêu cầu xóa tệp
                window.location.href = '/admin/danh_sach_tai_lieu_tham_khao/deleteFile/' + fileId;
            }
        }

        // Open modal for adding main folder
        document.getElementById("add-main-folder").addEventListener("click", function() {
            var folderModal = document.getElementById("folderModal");
            var parentFolderInput = document.getElementById("parentFolder");
            parentFolderInput.value = ""; // Clear parentFolder input for main folder creation
            folderModal.style.display = "block"; // Show the modal
        });

        // Close the modal when user clicks on the 'x'
        document.querySelectorAll(".close").forEach(closeBtn => {
            closeBtn.onclick = function() {
                this.closest(".modal").style.display = "none";
            };
        });

        // Close the modal when user clicks outside the modal content
        window.onclick = function(event) {
            if (event.target.classList.contains("modal")) {
                event.target.style.display = "none";
            }
        };

        // Toggle folder content (expand/collapse)
        var toggler = document.getElementsByClassName("caret");

        for (var i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function() {
                this.classList.toggle("caret-down");

                // Get the parent row (tr) id
                var parentRow = this.closest("tr");
                var parentId = parentRow.getAttribute("data-id");

                // Get all nested rows with the same parent id
                var nestedRows = document.querySelectorAll('tr[data-parent-id="' + parentId + '"]');

                // Toggle visibility of all nested rows
                nestedRows.forEach(function(row) {
                    row.style.display = (row.style.display === "table-row") ? "none" : "table-row";
                });
            });
        }
    </script>
</body>