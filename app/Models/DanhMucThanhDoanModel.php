<?php

namespace App\Models;

use CodeIgniter\Model;

class DanhMucThanhDoanModel extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'cat_id';
    protected $allowedFields = ['parent_id', 'catid_array', 'root', 'title', 'alias', 'description', 'date_add', 'date_modify', 'ordering', 'enabled', 'num_view', 'left', 'right', 'assoc_id'];
    public function getCategoriesWithDepth()
    {
        $categories = $this->orderBy('left', 'ASC')->findAll();
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

    /**
     * Xây dựng cây danh mục
     */
    public function buildTree(array $elements, $parentId = 0)
    {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['cat_id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }
}
