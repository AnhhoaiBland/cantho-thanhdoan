<?php

namespace App\Models;

use CodeIgniter\Model;

class DaPhuongTienModel extends BaseModel
{
    public function LayAll()
    {
        $strSQL = "SELECT maBoSuuTap, tenBoSuuTap, loai, ngayTao, trangThai,ngayDuyet,moTa, ngayDuyet, (SELECT tenDangNhap FROM NguoiDung WHERE maNguoiDung = nguoiDungDang ) as tenNguoiDang, (SELECT tenDangNhap FROM NguoiDung WHERE maNguoiDung = nguoiDungDuyet ) as tenNguoiDuyet, (SELECT urlFile FROM ChiTietBoSuuTap WHERE ChiTietBoSuuTap.maBoSuuTap = BoSuuTap.maBoSuuTap limit 1 ) as urlFile FROM BoSuuTap;";
        return $this->executeQuery($strSQL);
    }
    public function Luu($tenBoSuuTap, $loai, $nguoiDungDang, $moTa)
    {
        $maBoSuuTap = uniqid('bost_', true);
        $strSQL = "insert into BoSuuTap ( maBoSuuTap, tenBoSuuTap, loai, nguoiDungDang, moTa ) values ('$maBoSuuTap', '$tenBoSuuTap', '$loai', '$nguoiDungDang', '$moTa' );";
        return $this->executeQueryBoolean($strSQL);
    }

    public function capNhat($maBoSuuTap, $tenBoSuuTap, $loai, $moTa)
    {
        $strSQL = "UPDATE BoSuuTap SET tenBoSuuTap = '$tenBoSuuTap', loai = '$loai', moTa = '$moTa', trangThai = '3' WHERE maBoSuuTap = '$maBoSuuTap';";
        return $this->executeQueryBoolean($strSQL);
    }

    public function LayChiTiet($maBoSuuTap)
    {
        $strSQL = "select *, (SELECT tenBoSuuTap FROM BoSuuTap WHERE ChiTietBoSuuTap.maBoSuuTap = BoSuuTap.maBoSuuTap) as tenBoSuuTap, (SELECT loai FROM BoSuuTap WHERE ChiTietBoSuuTap.maBoSuuTap = BoSuuTap.maBoSuuTap) as loai from ChiTietBoSuuTap WHERE maBoSuuTap = '$maBoSuuTap';";
        return $this->executeQuery($strSQL);
    }
    public function LayBST($maBoSuuTap)
    {
        $strSQL = "select * from BoSuuTap WHERE maBoSuuTap = '$maBoSuuTap';";
        return $this->executeQuery($strSQL);
    }
    public function LayLoaiBST($maBoSuuTap)
    {
        $strSQL = "select loai from BoSuuTap WHERE maBoSuuTap = '$maBoSuuTap';";
        $result = $this->executeQuery($strSQL);
        if (!empty($result) && isset($result[0]['loai'])) {
            if (is_string($result[0]['loai'])) {
                return trim($result[0]['loai']);
            } else {
                return $result[0]['loai'];
            }
        } else {
            return null;
        }
    }

    public function luuChiTiet($maChiTiet, $maBoSuuTap, $urlFile)
    {
        $strSQL = "insert into ChiTietBoSuuTap (maChiTiet, maBoSuuTap, urlFile ) values ( '$maChiTiet', '$maBoSuuTap', '$urlFile' );";
        return $this->executeQueryBoolean($strSQL);
    }

    public function layDSChiTiet($maBoSuuTap)
    {
        $strSQL = "SELECT * from ChiTietBoSuuTap WHERE maBoSuuTap = '$maBoSuuTap';";
        return $this->executeQuery($strSQL);
    }

    public function layAnhChiTetByMaChiTiet($maChiTiet)
    {
        $strSQL = "SELECT urlFile from ChiTietBoSuuTap WHERE maChiTiet = '$maChiTiet';";
        $result = $this->executeQuery($strSQL);
        return $result[0]['urlFile'];
    }

    public function xoaChiTiet($maChiTiet)
    {
        $strSQL = "DELETE FROM ChiTietBoSuuTap WHERE maChiTiet = '$maChiTiet';";
        return $this->executeQueryBoolean($strSQL);
    }

    public function capNhatTrangThai($maBoSuuTap, $trangThai, $tenDangNhap)
    {
      

        $strSQL = "UPDATE BoSuuTap set trangThai = '$trangThai', ngayDuyet = CURRENT_DATE, nguoiDungDuyet = (SELECT maNguoiDung FROM NguoiDung where `tenDangNhap` = '$tenDangNhap') WHERE maBoSuuTap = '$maBoSuuTap';";
  
        return $this->executeQueryBoolean($strSQL);
    }

    public function tongBoSuTap($loai)
    {
        $strSQL = "select count(*) as tong from BoSuuTap where loai = '$loai'";
        $result = $this->executeQuery($strSQL);
        return $result[0]['tong'];
    }

    public function lay_ds_boST_loai_phanTrang($loai,  $start, $limit)
    {
        $strSQL = "SELECT maBoSuuTap, tenBoSuuTap, loai, ngayTao, trangThai,ngayDuyet,moTa, ngayDuyet, (SELECT urlFile FROM ChiTietBoSuuTap WHERE ChiTietBoSuuTap.maBoSuuTap = BoSuuTap.maBoSuuTap limit 1 ) as urlFile  FROM BoSuuTap WHERE trangThai = '2' and loai = '$loai' LIMIT $start, $limit;";
        return $this->executeQuery($strSQL);
    }


    public function ds_item_BST($maBoSuuTap)
    {
        $strSQL = " select * from ChiTietBoSuuTap where maBoSuuTap = '$maBoSuuTap' and (select trangThai from BoSuuTap where maBoSuuTap = '$maBoSuuTap') = 2;";
        $result = $this->executeQuery($strSQL);
        return $result;
    }
}
