<?php

namespace App\Models;

use CodeIgniter\Model;

class DanhMucThanhDoanModel extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'cat_id';
    protected $allowedFields = ['parent_id', 'catid_array', 'root', 'title', 'alias', 'description', 'date_add', 'date_modify', 'ordering', 'enabled', 'num_view', 'left', 'right', 'assoc_id'];
}
