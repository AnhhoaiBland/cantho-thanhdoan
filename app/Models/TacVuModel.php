<?php

namespace App\Models;

use CodeIgniter\Model;

class TacVuModel extends BaseModel
{


    public function getallChucNang()
    {
        $sql = "SELECT * FROM ChucNangTruyCap";
        return $this->executeQuery($sql);
    }

    public function lay_ds_chucNang_maNhom($maNhom)
    {
        $sql = "SELECT cn.maChucNang, cn.tenChucNang, cn.urlChucNang FROM NhomChucNang_ChucNang AS ncnc INNER JOIN ChucNangTruyCap AS cn ON ncnc.maChucNang = cn.maChucNang WHERE ncnc.maNhom = '$maNhom';";
        return $this->executeQuery($sql);
    }

    public function layThongTinNhomQuyen($maNhom)
    {
        $sql = "select * from NhomChucNang where maNhom = '$maNhom';";
        return $this->executeQuery($sql);
    }

    public function luu_chuc_nang_vao_nhom($maNhom, $maChucNang)
    {
        $sql = "INSERT INTO NhomChucNang_ChucNang (maNhom, maChucNang) VALUES ('$maNhom', '$maChucNang');";
        return $this->executeQueryBoolean($sql);
    }

    public function xoa_chuc_nang_khoi_nhomCN($maNhom, $maChucNang)
    {
        $sql = "DELETE FROM NhomChucNang_ChucNang WHERE (maNhom = '$maNhom') and (maChucNang = '$maChucNang');";
        return $this->executeQueryBoolean($sql);
    }

    public function getAllNhomChucNang()
    {
        $sql = "SELECT * FROM NhomChucNang";
        return $this->executeQuery($sql);
    }

    public function getTacVuTruyCapById($maChucNang)
    {
        $sql = "SELECT * FROM ChucNangTruyCap WHERE maChucNang = '$maChucNang'";
        return $this->executeQuery($sql);
    }

    public function getTenTacVuTruyCapById($maChucNang)
    {
        $sql = "SELECT tenChucNang FROM ChucNangTruyCap WHERE maChucNang = '$maChucNang'";
        $result = $this->executeQuery($sql);
        return $result[0]['tenChucNang'];
    }

    public function countQuyenTruyCapByTacVu($maChucNang)
    {
        $logger = service('logger');
        $sql = "SELECT COUNT(*) AS dem FROM NhomChucNang_ChucNang WHERE maChucNang = '$maChucNang'";
        $logger->info($sql);
        $result = $this->executeQuery($sql);
        return $result[0]['dem'];
    }

    public function countTacVuTruyCapByTen($tenChucNang)
    {
        $sql = "SELECT COUNT(*) AS dem FROM ChucNangTruyCap WHERE tenChucNang = '$tenChucNang'";
        $result = $this->executeQuery($sql);
        return $result[0]['dem'];
    }

    public function createTacVuTruyCap($maChucNang, $tenChucNang, $urlChucNang)
    {
        $sql = "INSERT INTO ChucNangTruyCap (maChucNang, tenChucNang, urlChucNang) VALUES ('$maChucNang', '$tenChucNang', '$urlChucNang')";
        return $this->executeQueryBoolean($sql);
    }

    public function updateTacVuTruyCap($maChucNang, $tenChucNanga, $urlChucNanga)
    {
        $logger = service("logger");
        $sql = "UPDATE ChucNangTruyCap SET tenChucNang = '$tenChucNanga', urlChucNang = '$urlChucNanga' WHERE (maChucNang = '$maChucNang');";
        $logger->info($sql);
        return $this->executeQueryBoolean($sql);
    }
    public function deleteTacVuTruyCap($maChucNang)
    {
        $sql = "DELETE FROM ChucNangTruyCap WHERE (maChucNang = '$maChucNang')";
        return $this->executeQueryBoolean($sql);
    }



    // nhóm chức năng


    public function capNhat_nhomQuyen($maNhom, $tenNhom, $moTa)
    {
        $sql = "UPDATE NhomChucNang SET tenNhom = '$tenNhom', moTa = '$moTa' WHERE (maNhom = '$maNhom');";
        return $this->executeQueryBoolean($sql);
    }
    public function them_moi_nhomQuyen($ten_NhomQ, $mo_TaQ)
    {
        $maNhom = uniqid('nhomQ', true);
        $sql = "INSERT INTO NhomChucNang (maNhom, tenNhom, moTa) VALUES ('$maNhom', '$ten_NhomQ', '$mo_TaQ');";
        return $this->executeQueryBoolean($sql);
    }
    public function dem_dung_nhom_quyen($maNhom)
    {
        $sql = "SELECT COUNT(DISTINCT maLoaiND) AS soLuongLoaiNguoiDung FROM LoaiNguoiDung_NhomChucNang WHERE maNhom = '$maNhom';";
        $result = $this->executeQuery($sql);
        return $result[0]['soLuongLoaiNguoiDung'];
    }
    public function delete_nhom_quyen($maNhom)
    {
        $sql = "DELETE FROM .NhomChucNang WHERE (maNhom = '$maNhom');";
        return $this->executeQueryBoolean($sql);
    }


}
