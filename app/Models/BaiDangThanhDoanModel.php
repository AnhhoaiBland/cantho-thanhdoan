<?php

namespace App\Models;

use CodeIgniter\Model;

class BaiDangThanhDoanModel extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'news_id';
    protected $allowedFields = ['category_id', 'acc_id', 'title', 'alias', 'description', 'content', 'date_add', 'date_modify', 'img_file', 'enabled', 'ordering', 'focus', 'num_view', 'assoc_id'];
}
