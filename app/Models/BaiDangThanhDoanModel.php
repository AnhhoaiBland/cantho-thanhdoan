<?php

namespace App\Models;

class BaiDangThanhDoanModel extends BaseModel
{
    protected $table = 'news';
    protected $primaryKey = 'news_id';
    protected $allowedFields = ['category_id', 'acc_id', 'title', 'alias', 'description', 'content', 'date_add', 'date_modify', 'img_file', 'enabled', 'ordering', 'focus', 'num_view', 'assoc_id'];

    
}