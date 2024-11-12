<?php

namespace App\Models;

use CodeIgniter\Model;

class BaiDangThanhDoanModel extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'news_id';
    protected $allowedFields = ['category_id', 'acc_id', 'title', 'alias', 'description', 'content', 'date_add', 'date_modify', 'img_file', 'enabled', 'hashtags', 'ordering', 'focus', 'num_view', 'assoc_id'];
    public function getFilteredPosts($search = '', $start_date = '', $end_date = '', $category_id = '')
    {
        $builder = $this;

        if ($search) {
            $builder = $builder->like('title', $search);
        }

        if ($start_date) {
            $start_timestamp = strtotime($start_date);
            $builder = $builder->where('date_add >=', $start_timestamp);
        }

        if ($end_date) {
            $end_timestamp = strtotime($end_date . ' 23:59:59');
            $builder = $builder->where('date_add <=', $end_timestamp);
        }

        if ($category_id) {
            // Lấy danh sách các category con
            $danhMucModel = new DanhMucThanhDoanModel();
            $selected_category = $danhMucModel->find($category_id);
            if ($selected_category) {
                $left = $selected_category['left'];
                $right = $selected_category['right'];
                $categories = $danhMucModel
                    ->where('left >=', $left)
                    ->where('right <=', $right)
                    ->findAll();
                $category_ids = array_column($categories, 'cat_id');
                $builder = $builder->whereIn('category_id', $category_ids);
            }
        }

        return $builder->orderBy('category_id', 'ASC')->findAll();
    }

    /**
     * Lấy bài đăng nhóm theo danh mục
     */
    public function getGroupedPosts($search = '', $start_date = '', $end_date = '', $category_id = '')
    {
        $posts = $this->getFilteredPosts($search, $start_date, $end_date, $category_id);
        $danhMucModel = new DanhMucThanhDoanModel();
        $groupedPosts = [];

        foreach ($posts as $post) {
            $category = $danhMucModel->find($post['category_id']);
            $categoryTitle = $category ? $category['title'] : 'Chưa phân loại';
            $groupedPosts[$categoryTitle][] = $post;
        }

        return $groupedPosts;
    }

    /**
     * Lấy bài đăng mặc định (khi không có bộ lọc)
     */
    public function getDefaultGroupedPosts($categoriesPerPage, $offset)
    {
        $danhMucModel = new DanhMucThanhDoanModel();
        $categories = $danhMucModel
            ->select('cat_id, title AS category_title')
            ->orderBy('title', 'ASC')
            ->limit($categoriesPerPage, $offset)
            ->findAll();

        $groupedPosts = [];
        foreach ($categories as $category) {
            $posts = $this->where('category_id', $category['cat_id'])
                ->orderBy('date_add', 'DESC')
                ->findAll();
            if (!empty($posts)) {
                $groupedPosts[$category['category_title']] = $posts;
            }
        }

        return $groupedPosts;
    }
}
