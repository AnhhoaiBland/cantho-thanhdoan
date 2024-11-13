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

    public function index($page = 1)
    {
        $categoriesPerPage = 10;
        $offset = ($page - 1) * $categoriesPerPage;
        $search = $this->request->getGet('search') ?? '';
        $start_date = $this->request->getGet('start_date') ?? '';
        $end_date = $this->request->getGet('end_date') ?? '';
        $category_id = $this->request->getGet('category_id') ?? '';
    
        // Fetch categories with depth for hierarchical display and sort by desired order
        $data['ds_danh_muc'] = $this->danhMucModel->orderBy('title', 'ASC')->getCategoriesWithDepth();
    
        if ($category_id) {
            // Fetch selected category for display
            $selected_category = $this->danhMucModel->find($category_id);
            $selected_category_title = $selected_category ? $selected_category['title'] : '';
            $data['selected_category_title'] = $selected_category_title;
        } else {
            $data['selected_category_title'] = '';
        }
    
        if ($search || $start_date || $end_date || $category_id) {
            // Lấy bài đăng có bộ lọc
            $groupedPosts = $this->baiDangModel->getGroupedPosts($search, $start_date, $end_date, $category_id);
        } else {
            // Lấy bài đăng mặc định
            $groupedPosts = $this->baiDangModel->getDefaultGroupedPosts($categoriesPerPage, $offset);
        }
    
        // Pagination details
        $totalCategories = $this->danhMucModel->countAllResults();
        $totalPages = ceil($totalCategories / $categoriesPerPage);
        $data['groupedPosts'] = $groupedPosts;
        $data['currentPage'] = $page;
        $data['totalPages'] = $totalPages;
        $data['search'] = $search;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['category_id'] = $category_id;
    
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
            'hashtags' => $this->request->getPost('hashtags')
        ];

        // Xử lý file upload nếu có
        $img_file = $this->request->getFile('img_file');
        if ($img_file && $img_file->isValid() && !$img_file->hasMoved()) {
            $newName = $img_file->getRandomName();
            $img_file->move(FCPATH . 'uploads', $newName); // Save to public/uploads
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
            'hashtags' => $this->request->getPost('hashtags')
        ];

        // Handle file upload if a new image is provided
        $img_file = $this->request->getFile('img_file');
        if ($img_file && $img_file->isValid() && !$img_file->hasMoved()) {
            $newName = $img_file->getRandomName();
            $img_file->move(FCPATH . 'uploads', $newName); // Save to public/uploads
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
    private function getCategoriesWithDepth()
    {
        $categories = $this->danhMucModel->orderBy('left', 'ASC')->findAll();
        $ds_danh_muc = [];
        $stack = [];
        foreach ($categories as $category) {
            while (!empty($stack) && end($stack)['right'] < $category['right']) {
                array_pop($stack);
            }
            $depth = count($stack);
            $category['depth'] = $depth;
            $ds_danh_muc[] = $category;
            $stack[] = $category;
        }
        return $ds_danh_muc;
    }
}
