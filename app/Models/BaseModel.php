<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Connection;

abstract class BaseModel extends Model
{
    /**
     * Thực thi truy vấn SQL với prepared statements
     *
     * @param string $sql Truy vấn SQL
     * @param array $data Mảng dữ liệu truyền vào
     * @param bool $returnData Xác định có trả về dữ liệu hay không
     * @return mixed Dữ liệu trả về hoặc null
     */

    public function executeQuery($strQuery)
    {
        $db = \Config\Database::connect();

        $query = $db->query($strQuery);
        $results = $query->getResultArray();
        return $results;
    }

    public function executeQueryBoolean($strQuery)
    {
        $db = \Config\Database::connect();
        $db->query($strQuery);
        $affectedRows = $db->affectedRows();
        return $affectedRows > 0 ? true : false;
    }

    public function all()
    {
        $query = $this->db->table($this->table)->get();

        // Kiểm tra xem có dữ liệu trả về không
        if ($query->getNumRows() == 0) {
            return NULL;
        } else {
            // Trường hợp có dữ liệu trả về
            $results = $query->getResult(); // Lấy kết quả dưới dạng mảng đối tượng

            $data = [];
            foreach ($results as $result) {
                $data[] = $result; // Thêm đối tượng vào mảng kết quả
            }

            return $data;
        }
    }
}
