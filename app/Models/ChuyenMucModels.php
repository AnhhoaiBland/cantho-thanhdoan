<?php

namespace App\Models;



class ChuyenMucModels extends BaseModel
{
    public function getList()
    {
        return $this->executeQuery('SELECT cm1.*, cm2.tenChuyenMuc AS tenChuyenMucCha, (SELECT COUNT(*) FROM BaiDang bd WHERE bd.maChuyenMuc = cm1.maChuyenMuc) AS soLuongBai FROM ChuyenMuc cm1 LEFT JOIN ChuyenMuc cm2 ON cm1.maChuyenMucCha = cm2.maChuyenMuc;');
    }

    public function getList_chuyen_muc_cha()
    {
        return $this->executeQuery(' SELECT * from ChuyenMuc WHERE maChuyenMucCha IS NULL;');
    }

    public function getList_chuyen_muc_con($id_cate_cha)
    {
        return $this->executeQuery("SELECT * FROM ChuyenMuc where maChuyenMucCha = '$id_cate_cha';");
    }

    public function save_cate($tenChuyenMuc, $maChuyenMucCha, $url)
    {
        $id = uniqid("cate_", true);
        $logger = service("logger");
        $strSQL = "";
        $logger->info($strSQL);
        if (isset($maChuyenMucCha)) {
            //INSERT INTO ChuyenMuc (maChuyenMuc, maChuyenMucCha, tenChuyenMuc, urlChuenMuc) VALUES ('$maChuyenMuc', '$maChuyenMucCa', '$tenChuyenMuc', '$urlChuyenMuc');
            $strSQL = "INSERT INTO ChuyenMuc(maChuyenMuc, tenChuyenMuc, maChuyenMucCha, urlChuenMuc) VALUES ('$id','$tenChuyenMuc','$maChuyenMucCha', '$url')";
        } else {
            $strSQL = "INSERT INTO ChuyenMuc(maChuyenMuc, tenChuyenMuc, urlChuenMuc) VALUES ('$id','$tenChuyenMuc', '$url')";
        }

        return $this->executeQueryBoolean($strSQL);
    }
    public function getCategoryById($id)
    {
        $strSQL = "SELECT cm1.*, cm2.tenChuyenMuc AS tenChuyenMucCha, (SELECT COUNT(*) FROM BaiDang bd WHERE bd.maChuyenMuc = cm1.maChuyenMuc) AS soLuongBai FROM ChuyenMuc cm1 LEFT JOIN ChuyenMuc cm2 ON cm1.maChuyenMucCha = cm2.maChuyenMuc WHERE cm1.maChuyenMuc = '$id'";
        return $this->executeQuery($strSQL);
    }

    public function update_cate($id, $maChuyenMucCha, $tenChuyenMuc, $ngayCapNhat,  $urlChuenMuc)
    {

        if (isset($maChuyenMucCha)) {
            $strSQL = "update ChuyenMuc set maChuyenMucCha = '$maChuyenMucCha', tenChuyenMuc = '$tenChuyenMuc', ngayCapNhat = '$ngayCapNhat', urlChuenMuc = '$urlChuenMuc' where maChuyenMuc = '$id';";
        } else {

            $strSQL = "update ChuyenMuc set maChuyenMucCha = null, tenChuyenMuc = '$tenChuyenMuc', ngayCapNhat = '$ngayCapNhat', urlChuenMuc = '$urlChuenMuc' where maChuyenMuc = '$id';";
        }
        return $this->executeQueryBoolean($strSQL);
    }

    public function xoa_chuyen_muc($id)
    {

        $strSQL = "delete from ChuyenMuc where maChuyenMuc = '$id';";

        return $this->executeQueryBoolean($strSQL);
    }

    public function lay_sl_bai_biet_cate($id)
    {
        $strSQL = "select count(*) as soLuong from BaiDang WHERE maChuyenMuc = '$id'";
        return $this->executeQuery($strSQL);
    }
    public function lay_sl_chuyen_muc_con($id)
    {
        $strSQL = "select count(*) as soLuong from ChuyenMuc WHERE maChuyenMucCha = '$id';";
        return $this->executeQuery($strSQL);
    }

    public function kiem_tra_da_ton_tai_url($url)
    {

        $strSQL = "SELECT COUNT(*) AS checkTonTai FROM ChuyenMuc WHERE urlChuenMuc = '$url'";

        $result = $this->executeQuery($strSQL);
        $sl = 0;
        foreach ($result as $row) {
            $sl = $row['checkTonTai'];
        }

        if ($sl <= 0) {
            return true;
        } else {
            return false;
        }
    }

    public function lay_chuyen_muc_byurl_chuyenMuc($urlChuenMuc){
        $strSQL = "select * from ChuyenMuc where urlChuenMuc = '$urlChuenMuc';";
        return $this->executeQuery($strSQL);
    }

    public function lay_ten_chuyen_muc_url($urlChuenMuc){
        $strSQL = "select tenChuyenMuc from ChuyenMuc where urlChuenMuc = '$urlChuenMuc';";
        $result = $this->executeQuery($strSQL);
        if(empty($result[0]['tenChuyenMuc'])){
            return 'cate';
        }
        return $result[0]['tenChuyenMuc'];
    }

    public function check_co_chuyen_muc_cha($urlChuenMucCon){
        $strSQL = "SELECT CASE WHEN maChuyenMucCha is null THEN '0' ELSE  '1' END as checkCMCha FROM ChuyenMuc where urlChuenMuc = '$urlChuenMucCon';";
        $result = $this->executeQuery($strSQL);
        return $result[0]['checkCMCha'];
    }

    
}
