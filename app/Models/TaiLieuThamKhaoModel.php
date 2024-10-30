<?php

namespace App\Models;

use CodeIgniter\Model;

class TaiLieuThamKhaoModel extends BaseModel
{
    public function layDanhSachTaiLieuThamKhao()
    {
        $strSQL = "select *, (select TenDanhMuc from danhmuctailieuthamkhao where danhmuctailieuthamkhao.MaDanhMucTL_ThamKhao = tailieuthamkhao.MaDanhMucTL_ThamKhao) as tenDanhMucTaiLieuThamKhao , (select tenDangNhap from NguoiDung where nguoidung.maNguoiDung = tailieuthamkhao.maNguoiDung) as tenNguoiDungTai, (select tenDangNhap from nguoidung where nguoidung.maNguoiDung = tailieuthamkhao.maNguoiDungCapNhatCuoi) as tenNguoiDungCapNhat from tailieuthamkhao";

        $result = $this->executeQuery($strSQL);
        return $result;
    }
   
}
