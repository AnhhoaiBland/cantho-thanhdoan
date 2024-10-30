<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TaiLieuThamKhaoModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\FolderModel;
use App\Models\FileModel;

class TaiLieuThamKhaoController extends BaseController
{
    protected $taiLieuThamKhaoModel, $userModel, $folderModel, $fileModel;

    public function __construct()
    {
        // Initialize models
        $this->taiLieuThamKhaoModel = new TaiLieuThamKhaoModel();
        $this->userModel = new UserModel();
        $this->folderModel = new FolderModel();
        $this->fileModel = new FileModel();
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function index()
    {
        // Fetch all folders
        $folders = $this->getFoldersWithFiles();  // Fetch folders and files recursively

        // Fetch other necessary data
        $data['folders'] = $folders;
        $data['ds_tailieuthamkhao'] = $this->taiLieuThamKhaoModel->layDanhSachTaiLieuThamKhao();
        $data['ds_loai'] = []; // Define if required
        $data['ds_cap'] = [];  // Define if required
        $data['checkQuyen'] = $this->check_nhom_quyen('nhomQ66fcf9d8b36bb7.78885073'); // Check user permissions

        return $this->template_admin(view("admin/tailieuthamkhao/ds_tailieuthamkhao", $data));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Recursive function to fetch folders and attach their files
    private function getFoldersWithFiles($parentId = null)
    {
        $folders = $this->folderModel->getFolders($parentId); // Fetch folders by parent ID

        // Loop through each folder to attach its files and subfolders
        foreach ($folders as &$folder) {
            $folder['files'] = $this->fileModel->getFilesByFolder($folder['id']);  // Attach files to the folder
            $folder['subfolders'] = $this->getFoldersWithFiles($folder['id']);     // Attach subfolders recursively
        }

        return $folders;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Function to add a new folder
    public function addFolder()
    {
        $title = $this->request->getPost('title');
        $folderName = $this->request->getPost('folderName');
        $parentFolder = $this->request->getPost('parentFolder');
        $publicationDate = $this->request->getPost('publicationDate'); // Ngày công bố

        if (!$folderName) {
            return redirect()->back()->with('error', 'Tên thư mục là bắt buộc.');
        }

        // Kiểm tra thư mục cha và ngày công bố
        if ($parentFolder) {
            $parentFolderData = $this->folderModel->find($parentFolder);
            if (!$parentFolderData) {
                return redirect()->back()->with('error', 'Thư mục cha không tồn tại.');
            }

            if ($publicationDate && $parentFolderData['publication_date'] && $publicationDate < $parentFolderData['publication_date']) {
                return redirect()->back()->with('error', 'Ngày công bố của thư mục con không được sớm hơn ngày công bố của thư mục cha.');
            }
        }

        // Kiểm tra thư mục trùng tên
        $existingFolder = $this->folderModel->where('name', $folderName)
            ->where('parent_id', $parentFolder ?: null)
            ->first();

        if ($existingFolder) {
            return redirect()->back()->with('error', 'Một thư mục với tên này đã tồn tại.');
        }

        $data = [
            'title' => $title,
            'name' => $folderName,
            'parent_id' => $parentFolder ?: null,
            'publication_date' => $publicationDate ?: null,
        ];

        try {
            $this->folderModel->save($data);
            return redirect()->to('/admin/danh_sach_tai_lieu_tham_khao')->with('success', 'Thêm thư mục thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Thêm thư mục thất bại: ' . $e->getMessage());
        }
    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function editFolder()
    {
        $folderId = $this->request->getPost('folderId');
        $folderName = $this->request->getPost('folderName');
        $publicationDate = $this->request->getPost('publicationDate');

        if (!$folderId || !$folderName) {
            return redirect()->back()->with('error', 'Thiếu thông tin cần thiết.');
        }

        $folder = $this->folderModel->find($folderId);
        if (!$folder) {
            return redirect()->back()->with('error', 'Thư mục không tồn tại.');
        }

        // Kiểm tra thư mục cha
        $parentFolderId = $folder['parent_id'];
        if ($parentFolderId) {
            $parentFolderData = $this->folderModel->find($parentFolderId);
            if ($publicationDate && $parentFolderData['publication_date'] && $publicationDate < $parentFolderData['publication_date']) {
                return redirect()->back()->with('error', 'Ngày công bố của thư mục không được sớm hơn ngày công bố của thư mục cha.');
            }
        }

        $existingFolder = $this->folderModel->where('name', $folderName)
            ->where('parent_id', $parentFolderId)
            ->where('id !=', $folderId)
            ->first();

        if ($existingFolder) {
            return redirect()->back()->with('error', 'Một thư mục với tên này đã tồn tại.');
        }

        $data = [
            'name' => $folderName,
            'publication_date' => $publicationDate ?: null,
        ];

        try {
            $this->folderModel->update($folderId, $data);
            return redirect()->to('/admin/danh_sach_tai_lieu_tham_khao')->with('success', 'Cập nhật thư mục thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật thư mục thất bại: ' . $e->getMessage());
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function deleteFolder($folderId)
    {
        try {
            $this->deleteFolderRecursively($folderId);
            return redirect()->to('/admin/danh_sach_tai_lieu_tham_khao')->with('success', 'Thư mục và tất cả nội dung bên trong đã được chuyển vào thùng rác.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xóa thư mục thất bại: ' . $e->getMessage());
        }
    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Function to upload a file to a specific folder
    public function addFile()
    {
        $files = $this->request->getFiles(); // Lấy tất cả các tệp đã tải lên
        $folderId = $this->request->getPost('folderId');

        if ($files && isset($files['files'])) {
            $validFiles = [];

            foreach ($files['files'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $allowedTypes = ['pdf', 'doc', 'docx', 'txt', 'jpg', 'png'];
                    $fileType = $file->getExtension();

                    if (!in_array($fileType, $allowedTypes)) {
                        return redirect()->back()->with('error', 'Một hoặc nhiều tệp không hợp lệ.');
                    }

                    try {
                        // Sử dụng uniqid để tạo tên file duy nhất
                        $newFileName = uniqid() . '.' . $fileType; // Tạo tên mới với uniqid và đuôi file

                        // Lưu tệp vào thư mục 'public/uploads'
                        $file->move(FCPATH . 'uploads', $newFileName);

                        $validFiles[] = [
                            'name' => $file->getClientName(), // Tên hiển thị người dùng nhập
                            'name_link' => $newFileName, // Tên file thực tế được lưu
                            'folder_id' => $folderId,
                            'file_type' => $fileType,
                            'file_path' => 'uploads/' . $newFileName, // Đường dẫn file lưu trong public/uploads
                        ];
                    } catch (\Exception $e) {
                        return redirect()->back()->with('error', 'Lỗi tải tệp: ' . $e->getMessage());
                    }
                }
            }

            if (!empty($validFiles)) {
                // Lưu dữ liệu vào database
                foreach ($validFiles as $data) {
                    $this->fileModel->save($data);
                }
                return redirect()->to('/admin/danh_sach_tai_lieu_tham_khao')->with('success', 'Tải tệp thành công.');
            }
        }

        return redirect()->back()->with('error', 'Không có tệp nào để tải lên.');
    }



    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function editFile()
    {
        $fileId = $this->request->getPost('fileId');
        $fileName = $this->request->getPost('fileName'); // Tên mới của tệp
        $newFile = $this->request->getFile('file'); // Tệp mới được chọn (nếu có)

        if (!$fileId || !$fileName) {
            return redirect()->back()->with('error', 'Thiếu thông tin cần thiết.');
        }

        $data = [
            'name' => $fileName
        ];

        // Nếu có tệp mới được chọn, xử lý việc thay thế tệp
        if ($newFile && $newFile->isValid() && !$newFile->hasMoved()) {
            $allowedTypes = ['pdf', 'doc', 'docx', 'txt', 'jpg', 'png'];
            $fileType = $newFile->getExtension();

            if (!in_array($fileType, $allowedTypes)) {
                return redirect()->back()->with('error', 'Tệp không hợp lệ.');
            }

            try {
                // Lưu tệp mới vào thư mục 'public/uploads'
                $newFileName = $newFile->getName();
                $newFile->move(FCPATH . 'uploads', $newFileName);

                // Cập nhật đường dẫn tệp và loại tệp trong cơ sở dữ liệu
                $data['file_type'] = $fileType;
                $data['file_path'] = 'uploads/' . $newFileName;
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Lỗi tải tệp: ' . $e->getMessage());
            }
        }

        try {
            // Cập nhật tệp với id tương ứng
            $this->fileModel->update($fileId, $data);
            return redirect()->to('/admin/danh_sach_tai_lieu_tham_khao')->with('success', 'Cập nhật tệp thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật tệp thất bại: ' . $e->getMessage());
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function deleteFile($fileId)
    {
        try {
            $this->fileModel->update($fileId, ['deleted' => 1]);
            return redirect()->to('/admin/danh_sach_tai_lieu_tham_khao')->with('success', 'Tệp đã được chuyển vào thùng rác.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xóa tệp thất bại: ' . $e->getMessage());
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function trash()
    {
        $data['deletedFiles'] = $this->fileModel->where('deleted', 1)->findAll();
        $data['deletedFolders'] = $this->folderModel->where('deleted', 1)->findAll();
        return $this->template_admin(view("admin/tailieuthamkhao/trash_tailieu", $data));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function trashFile($fileId)
    {
        $file = $this->fileModel->find($fileId);

        if (!$file) {
            return redirect()->back()->with('error', 'Tệp không tồn tại.');
        }

        try {
            // Đưa tệp vào thùng rác
            $this->fileModel->softDelete($fileId);
            return redirect()->to('/admin/danh_sach_tai_lieu_tham_khao')->with('success', 'Tệp đã được đưa vào thùng rác.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi đưa tệp vào thùng rác: ' . $e->getMessage());
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function restoreFile($fileId)
    {
        // Lấy thông tin của file
        $file = $this->fileModel->find($fileId);
        if (!$file) {
            return redirect()->back()->with('error', 'Tệp không tồn tại.');
        }

        // Kiểm tra xem thư mục chính của tệp có bị xóa không
        $folder = $this->folderModel->find($file['folder_id']);
        if ($folder && $folder['deleted']) {
            return redirect()->back()->with('error', 'Không thể khôi phục tệp vì thư mục chính đã bị xóa.');
        }

        try {
            // Khôi phục tệp
            $this->fileModel->update($fileId, ['deleted' => null]);
            return redirect()->to('/admin/trash')->with('success', 'Tệp đã được phục hồi.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Phục hồi tệp thất bại: ' . $e->getMessage());
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function restoreFolder($folderId)
    {
        // Lấy thông tin của thư mục
        $folder = $this->folderModel->find($folderId);
        if (!$folder) {
            return redirect()->back()->with('error', 'Thư mục không tồn tại.');
        }

        // Kiểm tra xem thư mục cha có bị xóa không
        if ($folder['parent_id']) {
            $parentFolder = $this->folderModel->find($folder['parent_id']);
            if ($parentFolder && $parentFolder['deleted']) {
                return redirect()->back()->with('error', 'Không thể khôi phục thư mục này vì thư mục cha đã bị xóa.');
            }
        }

        try {
            // Khôi phục thư mục
            $this->folderModel->update($folderId, ['deleted' => null]);
            return redirect()->to('/admin/trash')->with('success', 'Thư mục đã được phục hồi.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Phục hồi thư mục thất bại: ' . $e->getMessage());
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function trashFolder($folderId)
    {
        $folder = $this->folderModel->find($folderId);

        if (!$folder) {
            return redirect()->back()->with('error', 'Thư mục không tồn tại.');
        }

        try {
            // Đưa thư mục vào thùng rác
            $this->folderModel->softDelete($folderId);
            return redirect()->to('/admin/danh_sach_tai_lieu_tham_khao')->with('success', 'Thư mục đã được đưa vào thùng rác.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi đưa thư mục vào thùng rác: ' . $e->getMessage());
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function permanentlyDeleteFile($fileId)
    {
        // Tìm thông tin file cần xóa
        $file = $this->fileModel->find($fileId);
        if (!$file) {
            return redirect()->back()->with('error', 'Tệp không tồn tại.');
        }

        // Lấy đường dẫn file thực tế
        $filePath = FCPATH . $file['file_path'];

        try {
            // Nếu file tồn tại trong hệ thống, xóa nó đi
            if (file_exists($filePath)) {
                unlink($filePath);  // Xóa tệp vật lý khỏi hệ thống
            }

            // Xóa dữ liệu file khỏi database
            $this->fileModel->delete($fileId);

            return redirect()->to('/admin/trash')->with('success', 'Tệp đã được xóa vĩnh viễn và xóa khỏi hệ thống lưu trữ.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xóa tệp vĩnh viễn thất bại: ' . $e->getMessage());
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function permanentlyDeleteFolder($folderId)
    {
        // Lấy thông tin thư mục cần xóa
        $folder = $this->folderModel->find($folderId);
        if (!$folder) {
            return redirect()->back()->with('error', 'Thư mục không tồn tại.');
        }

        try {
            // Gọi hàm xóa đệ quy tất cả thư mục con và các tệp tin
            $this->deleteFolderAndFilesPermanently($folderId);

            return redirect()->to('/admin/trash')->with('success', 'Thư mục và tất cả nội dung bên trong đã được xóa vĩnh viễn khỏi hệ thống.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xóa thư mục vĩnh viễn thất bại: ' . $e->getMessage());
        }
    }

    private function deleteFolderAndFilesPermanently($folderId)
    {
        // Lấy tất cả các thư mục con
        $subFolders = $this->folderModel->where('parent_id', $folderId)->findAll();
        foreach ($subFolders as $subFolder) {
            $this->deleteFolderAndFilesPermanently($subFolder['id']);
        }

        // Lấy tất cả các tệp tin trong thư mục này
        $files = $this->fileModel->where('folder_id', $folderId)->findAll();
        foreach ($files as $file) {
            // Xóa tệp tin trên hệ thống
            if (file_exists(FCPATH . $file['file_path'])) {
                unlink(FCPATH . $file['file_path']);
            }
            // Xóa tệp tin trong database
            $this->fileModel->delete($file['id']);
        }

        // Xóa thư mục trong database
        $this->folderModel->delete($folderId);
    }

    private function deleteFolderRecursively($folderId)
    {
        // Lấy tất cả thư mục con của thư mục hiện tại
        $subfolders = $this->folderModel->where('parent_id', $folderId)->findAll();

        // Lặp qua từng thư mục con và gọi đệ quy
        foreach ($subfolders as $subfolder) {
            $this->deleteFolderRecursively($subfolder['id']);
        }

        // Lấy tất cả các tệp tin trong thư mục hiện tại và xóa chúng
        $files = $this->fileModel->getFilesByFolder($folderId);
        foreach ($files as $file) {
            $this->fileModel->update($file['id'], ['deleted' => 1]); // Xóa tệp (đánh dấu là đã xóa)
        }

        // Cuối cùng, xóa thư mục hiện tại
        $this->folderModel->update($folderId, ['deleted' => 1]); // Xóa thư mục (đánh dấu là đã xóa)
    }


    public function indexGD()
    {
        // Lấy thông tin cấu hình từ file JSON
        $dtJson =  $this->docthongtinweb();

        // Chuẩn bị dữ liệu cho trang giới thiệu
        $data_template = [
            'title' => 'Giới thiệu về chúng tôi',
            'content' => !empty($dtJson['aboutContent']) ? $dtJson['aboutContent'] : 'Chúng tôi là tổ chức hàng đầu trong lĩnh vực XYZ. Với sứ mệnh mang đến những sản phẩm chất lượng cao và dịch vụ vượt trội, chúng tôi luôn nỗ lực không ngừng để cải thiện chất lượng cuộc sống cho mọi người.',
            'address' => $dtJson['address'] ?? '',
            'phoneNumber' => $dtJson['phoneNumber'] ?? '',
            'email' => $dtJson['email'] ?? '',
            'logo' => $dtJson['logo'] ?? '',
            'facebook' => $dtJson['facebook'] ?? ''
        ];

        // Thống kê lượt truy cập
        $this->demTruyCap();
        $data_template['luoc_truy_cap'] = [
            "sl_tc_ngay" => $this->UserModel->lay_sl_truy_cap_ngay_now(),
            "sl_tc_thang" => $this->UserModel->lay_sl_truy_cap_thang_now(),
            "sl_tc_nam" => $this->UserModel->lay_sl_truy_cap_nam_now(),
            "sl_tc_tong" => $this->UserModel->lay_sl_truy_cap_tong()
        ];
        $data_template['folders'] = $this->getFoldersWithFiles();

        // Render trang giới thiệu với dữ liệu đã chuẩn bị
        return $this->template(view("Page_TaiLieuThamKhao", $data_template));
    }
}
