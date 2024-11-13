<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DanhMucThanhDoanModel;

class DanhMuc_BaiDang_ThanhDoanController extends BaseController
{
    protected $danhMucModel;

    public function __construct()
    {
        $this->danhMucModel = new DanhMucThanhDoanModel();
    }

    /**
     * Hiển thị danh sách danh mục
     */
    public function index()
    {
        // Lấy danh sách danh mục đã sắp xếp theo ngày sửa với độ sâu
        $tree = $this->danhMucModel->getCategoriesWithDepth('date_modify');

        // Gán dữ liệu cho View
        $data['ds_danh_muc'] = $tree;
        $data['checkQuyen'] = $this->check_nhom_quyen('nhomQ6721906c39cef4.74944927'); // Kiểm tra quyền người dùng

        // Trả về View với dữ liệu
        return $this->template_admin(view("admin/danhmuc_baidang_thanhdoan/ds_danhmuc_baidang_thanhdoan", $data));
    }

    /**
     * Hiển thị form thêm danh mục mới
     */
    public function create()
    {
        // Lấy danh sách danh mục đã sắp xếp với độ sâu
        $categories = $this->danhMucModel->getCategoriesWithDepth();

        // Truyền danh sách danh mục đến View để hiển thị trong dropdown
        $data['categories'] = $categories;

        // Hiển thị form thêm danh mục
        return $this->template_admin(view("admin/danhmuc_baidang_thanhdoan/create_danh_muc", $data));
    }

    /**
     * Xử lý lưu danh mục mới vào cơ sở dữ liệu
     */
    public function store()
    {
        // Đặt các quy tắc validation
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'alias' => 'required|alpha_dash|min_length[3]|max_length[255]|is_unique[category.alias]',
            // Thêm các quy tắc cho các trường khác nếu cần
        ];

        if (!$this->validate($rules)) {
            // Nếu validation thất bại, quay lại form với lỗi
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        // Lấy dữ liệu từ form
        $data = [
            'parent_id' => $this->request->getPost('parent_id'),
            'title' => $this->request->getPost('title'),
            'alias' => $this->request->getPost('alias'),
            'description' => $this->request->getPost('description'),
            'enabled' => $this->request->getPost('enabled'),
            'date_add' => time(),
            'date_modify' => time(),
        ];

        // Thêm dữ liệu vào cơ sở dữ liệu
        if ($this->danhMucModel->insert($data)) {
            return redirect()->to('/admin/dmbaidang_thanhdoan')->with('message', 'Thêm danh mục thành công');
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm danh mục');
        }
    }

    /**
     * Hiển thị form chỉnh sửa danh mục
     *
     * @param int $id ID của danh mục cần chỉnh sửa
     */
    public function edit($id)
    {
        // Kiểm tra xem danh mục có tồn tại không
        $category = $this->danhMucModel->find($id);
        if (!$category) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Không tìm thấy danh mục với ID $id");
        }

        // Lấy danh sách danh mục để hiển thị trong dropdown (loại bỏ danh mục hiện tại và các danh mục con để tránh vòng lặp)
        $categories = $this->danhMucModel->getCategoriesWithDepth();

        // Loại bỏ danh mục hiện tại và các danh mục con
        $categories = $this->danhMucModel->removeCurrentAndChildren($categories, $id);

        $data = [
            'category' => $category,
            'categories' => $categories,
        ];

        return $this->template_admin(view("admin/danhmuc_baidang_thanhdoan/edit_danh_muc", $data));
    }

    /**
     * Xử lý cập nhật danh mục vào cơ sở dữ liệu
     *
     * @param int $id ID của danh mục cần cập nhật
     */
    public function update($id)
    {
        // Kiểm tra xem danh mục có tồn tại không
        $category = $this->danhMucModel->find($id);
        if (!$category) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Không tìm thấy danh mục với ID $id");
        }

        // Đặt các quy tắc validation với đúng cột khóa chính
        $validationRules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'alias' => 'required|alpha_dash|min_length[3]|max_length[255]|is_unique[category.alias,cat_id,' . $id . ']',
            // Thêm các quy tắc cho các trường khác nếu cần
        ];

        if (!$this->validate($validationRules)) {
            // Nếu validation thất bại, quay lại form với lỗi
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        // Lấy dữ liệu từ form
        $data = [
            'parent_id' => $this->request->getPost('parent_id'),
            'title' => $this->request->getPost('title'),
            'alias' => $this->request->getPost('alias'),
            'description' => $this->request->getPost('description'),
            'enabled' => $this->request->getPost('enabled'),
            'date_modify' => time(),
        ];

        // Cập nhật dữ liệu vào cơ sở dữ liệu
        if ($this->danhMucModel->update($id, $data)) {
            return redirect()->to('/admin/dmbaidang_thanhdoan')->with('message', 'Cập nhật danh mục thành công');
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật danh mục');
        }
    }

    /**
     * Xử lý xóa danh mục
     *
     * @param int $id ID của danh mục cần xóa
     */
    public function delete($id)
    {
        // Kiểm tra xem danh mục có tồn tại không
        $category = $this->danhMucModel->find($id);
        if (!$category) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => "Không tìm thấy danh mục với ID $id"]);
            }
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Không tìm thấy danh mục với ID $id");
        }

        // Kiểm tra xem danh mục có danh mục con hay không
        $children = $this->danhMucModel->where('parent_id', $id)->findAll();
        if (!empty($children)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Không thể xóa danh mục này vì nó có danh mục con.']);
            }
            return redirect()->back()->with('error', 'Không thể xóa danh mục này vì nó có danh mục con.');
        }

        // Xóa danh mục
        if ($this->danhMucModel->delete($id)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => true]);
            }
            return redirect()->to('/admin/dmbaidang_thanhdoan')->with('message', 'Xóa danh mục thành công.');
        } else {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Có lỗi xảy ra khi xóa danh mục.']);
            }
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi xóa danh mục.');
        }
    }
    public function search()
    {
        // Lấy từ khóa tìm kiếm từ yêu cầu
        $searchTerm = $this->request->getGet('search');
        $dateFrom = $this->request->getGet('date_from');
        $dateTo = $this->request->getGet('date_to');

        // Sử dụng phương thức tìm kiếm theo tên và ngày trong model
        $categories = $this->danhMucModel->searchCategories($searchTerm, $dateFrom, $dateTo);

        // Xây dựng cây danh mục nếu cần
        $tree = $this->danhMucModel->buildTree($categories);

        // Truyền dữ liệu cho view
        $data['ds_danh_muc'] = $tree;
        $data['search'] = [
            'searchTerm' => $searchTerm,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo
        ];

        return $this->template_admin(view("admin/danhmuc_baidang_thanhdoan/ds_danhmuc_baidang_thanhdoan", $data));
    }
}
