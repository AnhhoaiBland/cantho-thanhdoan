<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BaiDangThanhDoanModel;
use App\Models\DanhMucThanhDoanModel;

class BaiDangThanhDoanController extends BaseController
{
    protected $baiDangModel;
    protected $danhMucModel;

    public function __construct()
    {
        $this->baiDangModel = new BaiDangThanhDoanModel();
        $this->danhMucModel = new DanhMucThanhDoanModel();
    }

    public function index()
    {
        // Lấy dữ liệu bài đăng cùng với danh mục liên kết
        $data['bai_dang'] = $this->baiDangModel
            ->select('news.*, category.title AS category_title')
            ->join('category', 'news.category_id = category.cat_id')
            ->orderBy('news.date_add', 'DESC')
            ->findAll();
        $data['ds_loai'] = []; // Define if required
        $data['ds_cap'] = [];  // Define if required
        $data['checkQuyen'] = $this->check_nhom_quyen('nhomQ6721906c39cef4.74944927'); // Check user permissions
        return $this->template_admin(view("admin/baidangthanhdoan/ds_baidangthanhdoan", $data));
    }

    public function create()
    {
        // Lấy danh sách danh mục và bài đăng để hiển thị trong form
        $data['ds_danh_muc'] = $this->danhMucModel->findAll();
        $data['ds_bai_dang'] = $this->baiDangModel->findAll(); // List of all posts for assoc_id
        return $this->template_admin(view("admin/baidangthanhdoan/create_baidang", $data));
    }


    public function store()
    {
        $data = [
            'category_id' => $this->request->getPost('category_id'),
            'acc_id' => $this->request->getPost('acc_id'),
            'title' => $this->request->getPost('title'),
            'alias' => $this->request->getPost('alias'),
            'description' => $this->request->getPost('description'),
            'content' => $this->request->getPost('content'),
            'date_add' => time(),
            'date_modify' => time(),
            'enabled' => $this->request->getPost('enabled'),
            'num_view' => 0,
            'assoc_id' => $this->request->getPost('assoc_id') // Add assoc_id here
        ];

        // Xử lý file upload nếu có
        $img_file = $this->request->getFile('img_file');
        if ($img_file && $img_file->isValid() && !$img_file->hasMoved()) {
            $newName = $img_file->getRandomName();
            $img_file->move(WRITEPATH . 'uploads', $newName);
            $data['img_file'] = '/uploads/' . $newName;
        }

        // Lưu vào database
        if ($this->baiDangModel->insert($data)) {
            return redirect()->to('/admin/baidangthanhdoan')->with('message', 'Thêm bài đăng thành công');
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm bài đăng');
        }
    }
    public function edit($id)
    {
        // Fetch the post and category data for editing
        $data['bai_dang'] = $this->baiDangModel->find($id);
        $data['ds_danh_muc'] = $this->danhMucModel->findAll();
        $data['ds_bai_dang'] = $this->baiDangModel->findAll(); // For assoc_id dropdown

        if (!$data['bai_dang']) {
            return redirect()->to('/admin/baidangthanhdoan')->with('error', 'Bài đăng không tồn tại');
        }

        return $this->template_admin(view("admin/baidangthanhdoan/edit_baidang", $data));
    }

    public function update($id)
    {
        // Prepare data for update
        $data = [
            'category_id' => $this->request->getPost('category_id'),
            'acc_id' => $this->request->getPost('acc_id'),
            'title' => $this->request->getPost('title'),
            'alias' => $this->request->getPost('alias'),
            'description' => $this->request->getPost('description'),
            'content' => $this->request->getPost('content'),
            'date_modify' => time(),
            'enabled' => $this->request->getPost('enabled'),
            'assoc_id' => $this->request->getPost('assoc_id')
        ];

        // Handle file upload if a new image is provided
        $img_file = $this->request->getFile('img_file');
        if ($img_file && $img_file->isValid() && !$img_file->hasMoved()) {
            $newName = $img_file->getRandomName();
            $img_file->move(WRITEPATH . 'uploads', $newName);
            $data['img_file'] = '/uploads/' . $newName;
        }

        // Update the database record
        if ($this->baiDangModel->update($id, $data)) {
            return redirect()->to('/admin/baidangthanhdoan')->with('message', 'Cập nhật bài đăng thành công');
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật bài đăng');
        }
    }

    public function relatedPosts($categoryId)
    {
        $relatedPosts = $this->baiDangModel
            ->where('category_id', $categoryId)
            ->findAll();
        return $this->response->setJSON($relatedPosts);
    }
    public function delete($id)
    {
        if ($this->baiDangModel->delete($id)) {
            // Set flash data for success message
            session()->setFlashdata('message', 'Xóa bài đăng thành công');
            return redirect()->to('/admin/baidangthanhdoan');
        } else {
            session()->setFlashdata('error', 'Có lỗi xảy ra khi xóa bài đăng');
            return redirect()->to('/admin/baidangthanhdoan');
        }
    }
    
}
