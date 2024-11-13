<?php

namespace App\Models;

use CodeIgniter\Model;

class DanhMucThanhDoanModel extends Model
{
    protected $table = 'category'; // Tên bảng chính xác
    protected $primaryKey = 'cat_id'; // Khóa chính đúng
    protected $allowedFields = ['parent_id', 'title', 'alias', 'description', 'enabled', 'date_add', 'date_modify'];

    /**
     * Lấy danh sách danh mục với độ sâu và sắp xếp theo ngày sửa
     *
     * @param string $sortBy Trường để sắp xếp ('date_add' hoặc 'date_modify')
     * @return array Cây danh mục
     */
    public function getCategoriesWithDepth($sortBy = 'date_modify')
    {
        $allowedSort = ['date_add', 'date_modify'];
        if (!in_array($sortBy, $allowedSort)) {
            $sortBy = 'date_modify';
        }

        $categories = $this->orderBy('parent_id', 'ASC')
            ->orderBy($sortBy, 'DESC') // Sắp xếp theo ngày sửa giảm dần
            ->findAll();
        $tree = $this->buildTree($categories);
        return $tree;
    }

    /**
     * Xây dựng cây danh mục từ danh sách
     *
     * @param array $categories
     * @param int $parentId
     * @param int $depth
     * @return array
     */
    public function buildTree(array $categories, $parentId = 0, $depth = 0)
    {
        $branch = [];

        foreach ($categories as $category) {
            if ($category['parent_id'] == $parentId) {
                $category['depth'] = $depth;
                $children = $this->buildTree($categories, $category['cat_id'], $depth + 1);
                if ($children) {
                    $category['children'] = $children;
                }
                $branch[] = $category;
            }
        }

        return $branch;
    }

    /**
     * Loại bỏ danh mục hiện tại và các danh mục con khỏi danh sách
     *
     * @param array $categories
     * @param int $currentId
     * @return array
     */
    public function removeCurrentAndChildren(array $categories, $currentId)
    {
        $idsToRemove = $this->getAllChildrenIds($categories, $currentId);
        $idsToRemove[] = $currentId;

        return array_filter($categories, function ($category) use ($idsToRemove) {
            return !in_array($category['cat_id'], $idsToRemove);
        });
    }

    /**
     * Lấy tất cả các ID của danh mục con (đệ quy)
     *
     * @param array $categories
     * @param int $parentId
     * @return array
     */
    private function getAllChildrenIds(array $categories, $parentId)
    {
        $children = [];
        foreach ($categories as $category) {
            if ($category['parent_id'] == $parentId) {
                $children[] = $category['cat_id'];
                $children = array_merge($children, $this->getAllChildrenIds($categories, $category['cat_id']));
            }
        }
        return $children;
    }
    public function searchCategories($name, $dateFrom, $dateTo)
    {
        $builder = $this->builder();

        if (!empty($name)) {
            // Tách từ khóa bằng dấu phẩy
            $keywords = array_map('trim', explode(',', $name));
            foreach ($keywords as $keyword) {
                $builder->orLike('title', $keyword);
            }
        }

        if (!empty($dateFrom)) {
            $builder->where('date_add >=', strtotime($dateFrom . ' 00:00:00'));
        }

        if (!empty($dateTo)) {
            $builder->where('date_add <=', strtotime($dateTo . ' 23:59:59'));
        }

        $builder->orderBy('parent_id', 'ASC');
        $builder->orderBy('date_modify', 'DESC');

        $categories = $builder->get()->getResultArray();

        // Xây dựng cây danh mục từ kết quả tìm kiếm để bao gồm cả danh mục cha và con
        $tree = $this->buildTreeWithParents($categories);

        return $tree;
    }
    public function buildTreeWithParents(array $categories)
    {
        // Lấy tất cả danh mục để xây dựng cây đầy đủ
        $allCategories = $this->findAll();

        // Tạo mảng tạm thời để lưu các danh mục phù hợp với từ khóa tìm kiếm
        $filteredCategories = [];
        $parentIds = [];

        foreach ($categories as $category) {
            $filteredCategories[$category['cat_id']] = $category;
            $parentIds[] = $category['parent_id'];
        }

        // Duyệt qua các danh mục cha để đảm bảo cây đầy đủ
        foreach ($allCategories as $category) {
            if (in_array($category['cat_id'], $parentIds)) {
                $filteredCategories[$category['cat_id']] = $category;
            }
        }

        // Xây dựng cây từ danh sách danh mục đã lọc
        return $this->buildTree($filteredCategories);
    }
}
