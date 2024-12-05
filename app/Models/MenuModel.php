<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table      = 'menus';  // Tên bảng trong cơ sở dữ liệu
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'title',
        'url',
        'parent_id',
        'enabled',
        'order',
        'group',
        'updated_at', // If you're using timestamps manually
    ];
    

    protected $useTimestamps = true;
    protected $updatedField  = 'updated_at';
    

    // Sửa lại phương thức này để sử dụng query đúng cách
    public function lay_menu_cha()
    {
        // Sử dụng db->query() để thực thi câu lệnh SQL
        return $this->db->query('SELECT * FROM menus WHERE parent_id = 0')->getResultArray();
    }
    public function getList_menu_con($id)
    {
        return $this->db->query("SELECT * FROM menus where parent_id = '$id';")->getResultArray();
    }


}

