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

        return array_filter($categories, function($category) use ($idsToRemove) {
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
}
