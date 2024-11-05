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

    public function index()
    {
        // Lấy cây danh mục
        $data['ds_danh_muc'] = $this->getCategoryTree();
        
        $data['ds_loai'] = []; // Define if required
        $data['ds_cap'] = [];  // Define if required
        $data['checkQuyen'] = $this->check_nhom_quyen('nhomQ6721906c39cef4.74944927'); // Check user permissions
        return $this->template_admin(view("admin/danhmuc_baidang_thanhdoan/ds_danhmuc_baidang_thanhdoan", $data));
    }

    public function getCategoryTree($parent_id = 0, $level = 0)
    {
        $categories = $this->danhMucModel->where('parent_id', $parent_id)->findAll();
        $tree = [];

        foreach ($categories as $category) {
            $category['level'] = $level;
            $tree[] = $category;
            $children = $this->getCategoryTree($category['cat_id'], $level + 1);
            $tree = array_merge($tree, $children);
        }

        return $tree;
    }

    public function create()
    {
        // Hiển thị form thêm danh mục
        return $this->template_admin(view("admin/danhmuc_baidang_thanhdoan/create_danh_muc"));
    }

    public function store()
    {
        // Lấy dữ liệu từ form
        $data = [
            'parent_id' => $this->request->getPost('parent_id'),
            'title' => $this->request->getPost('title'),
            'alias' => $this->request->getPost('alias'),
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
}
