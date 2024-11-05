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
        // Lấy danh sách danh mục để hiển thị trong form
        $data['ds_danh_muc'] = $this->danhMucModel->findAll();
        return $this->template_admin(view("admin/baidangthanhdoan/create_baidang", $data));
    }

    public function store()
    {
        $data = [
            'category_id' => $this->request->getPost('category_id'),
            'acc_id' => $this->request->getPost('acc_id'),  // Thay đổi nếu cần
            'title' => $this->request->getPost('title'),
            'alias' => $this->request->getPost('alias'),
            'description' => $this->request->getPost('description'),
            'content' => $this->request->getPost('content'),
            'date_add' => time(),
            'date_modify' => time(),
            'enabled' => $this->request->getPost('enabled'),
            'num_view' => 0,
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
}
