<?php

namespace App\Models;

use CodeIgniter\Model;

class BaiDangModel extends BaseModel
{
    public function layDanhSach()
    {
        return $this->executeQuery("SELECT *, (SELECT tenDangNhap FROM NguoiDung WHERE BaiDang.maNguoiDung = NguoiDung.maNguoiDung) as tenNguoiDung,(SELECT tenDangNhap FROM NguoiDung WHERE BaiDang.nguoiDungDuyetBai = NguoiDung.maNguoiDung) as tenNguoiDungDuyet,thoiGianDuyetBai ,(SELECT tenChuyenMuc FROM ChuyenMuc WHERE ChuyenMuc.maChuyenMuc = BaiDang.maChuyenMuc) as tenChuyenMuc FROM BaiDang where trangThai != '0';");
    }

    public function luu($mabaidang, $maNguoiDung, $maChuyenMuc, $tieuDe, $anhTieuDe, $noiDung, $urlBaiDang)
    {
        $strSQL = "INSERT INTO BaiDang (maBaiDang, maNguoiDung, maChuyenMuc, tieuDe, anhTieuDe, noiDung, urlBaiDang) VALUES ('$mabaidang', '$maNguoiDung', '$maChuyenMuc', '$tieuDe', '$anhTieuDe', '$noiDung', '$urlBaiDang');";
        return $this->executeQueryBoolean($strSQL);
    }

    public function lay_bai_dang_id($maBaiDang)
    {
        $strSQL = "SELECT *, (SELECT tenDangNhap FROM NguoiDung WHERE BaiDang.maNguoiDung = NguoiDung.maNguoiDung) AS tenNguoiDung, (SELECT tenChuyenMuc FROM ChuyenMuc WHERE ChuyenMuc.maChuyenMuc = BaiDang.maChuyenMuc) AS tenChuyenMuc FROM BaiDang where maBaiDang = '$maBaiDang' and trangThai != '0';";
        return $this->executeQuery($strSQL);
    }
    public function lay_bai_dang_url($urlBaiDang)
    {
        $strSQL = "SELECT *, (SELECT tenDangNhap FROM NguoiDung WHERE BaiDang.maNguoiDung = NguoiDung.maNguoiDung) AS tenNguoiDung, (SELECT tenChuyenMuc FROM ChuyenMuc WHERE ChuyenMuc.maChuyenMuc = BaiDang.maChuyenMuc) AS tenChuyenMuc FROM BaiDang where urlBaiDang = '$urlBaiDang' and trangThai != '0';";
        return $this->executeQuery($strSQL);
    }
    public function cap_nhat_bai_dang($maChuyenMuc, $maNguoiDungCapNhat, $tieuDe,  $anhTieuDe, $noiDung,  $ngayCapNhat,  $urlBaiDang,  $maBaiDang)
    {
        $strSQL = "";
        if (isset($anhTieuDe)) {
            $strSQL = " UPDATE BaiDang SET trangThai ='3', maChuyenMuc = '$maChuyenMuc', maNguoiDungCapNhatCuoi = '$maNguoiDungCapNhat', tieuDe = '$tieuDe', anhTieuDe = '$anhTieuDe', noiDung = '$noiDung', ngayCapNhat = '$ngayCapNhat', urlBaiDang = '$urlBaiDang' WHERE maBaiDang = '$maBaiDang';";
        } else {
            $strSQL = "UPDATE BaiDang SET trangThai ='3', maChuyenMuc = '$maChuyenMuc', maNguoiDungCapNhatCuoi = '$maNguoiDungCapNhat', tieuDe = '$tieuDe', noiDung = '$noiDung', ngayCapNhat = '$ngayCapNhat', urlBaiDang = '$urlBaiDang' WHERE maBaiDang = '$maBaiDang';";
        }
        return $this->executeQueryBoolean($strSQL);
    }

    public function xoa($maBaiDang)
    {
        return $this->executeQueryBoolean("UPDATE BaiDang SET trangThai = '0' WHERE maBaiDang = '$maBaiDang';");
    }

    public function lay_ds_bai_dang_by_id_ChuyenMuc($maChuyenMuc)
    {
        $strSQl = "select maBaiDang, noiDung, maNguoiDung, maChuyenMuc, maNguoiDungCapNhatCuoi, tieuDe, anhTieuDe, ngayDang, ngayCapNhat, trangThai, urlBaiDang from baidang where maChuyenMuc = '$maChuyenMuc';";
        return $this->executeQuery($strSQl);
    }

    public function lay_ds_bai_dang_by_url_ChuyenMuc($urlChuenMuc)
    {
        $strSQl = "select maBaiDang,noiDung, maNguoiDung, maChuyenMuc, maNguoiDungCapNhatCuoi, tieuDe, anhTieuDe, ngayDang, ngayCapNhat, trangThai, urlBaiDang from baidang where maChuyenMuc = (select maChuyenMuc from ChuyenMuc where urlChuenMuc = '$urlChuenMuc' ) and trangThai = '2';";
        return $this->executeQuery($strSQl);
    }
    public function lay_ds_bai_dang_by_url_ChuyenMuc_tam($urlChuenMuc)
    {
        $strSQl = "WITH RECURSIVE SubCategories AS ( SELECT maChuyenMuc FROM ChuyenMuc WHERE urlChuenMuc = '$urlChuenMuc' UNION ALL SELECT c.maChuyenMuc FROM ChuyenMuc c INNER JOIN SubCategories sc ON c.maChuyenMucCha = sc.maChuyenMuc ) SELECT b.* FROM BaiDang b INNER JOIN SubCategories sc ON b.maChuyenMuc = sc.maChuyenMuc WHERE b.trangThai = '2';";
        return $this->executeQuery($strSQl);
    }
    public function lay_ds_bai_dang_by_url_ChuyenMuc_chuyenMucConAndCha($urlChuenMuc)
    {
        $strSQl = "SELECT maBaiDang,noiDung, maNguoiDung, maChuyenMuc, maNguoiDungCapNhatCuoi, tieuDe, anhTieuDe, ngayDang, ngayCapNhat, trangThai, urlBaiDang from baidang where maChuyenMuc = (select maChuyenMuc from ChuyenMuc where urlChuenMuc = '$urlChuenMuc' ) or maChuyenMuc =  (select maChuyenMucCha from ChuyenMuc where urlChuenMuc = '$urlChuenMuc' )  and trangThai = '2';";
        return $this->executeQuery($strSQl);
    }

    public function lay_ds_bai_dang_by_url_ChuyenMuc_top($urlChuenMuc, $topNumber = 5)
    {
        $strSQl = "SELECT maBaiDang, noiDung, maNguoiDung, maChuyenMuc, maNguoiDungCapNhatCuoi, tieuDe, anhTieuDe, ngayDang, ngayCapNhat, trangThai, urlBaiDang FROM BaiDang WHERE maChuyenMuc = ( SELECT maChuyenMuc FROM ChuyenMuc WHERE urlChuenMuc = '$urlChuenMuc' )  and trangThai = '2'  ORDER BY ngayDang DESC LIMIT $topNumber;";
        return $this->executeQuery($strSQl);
    }

    public function cap_nhat_trang_thai($maBaiDang, $trangThai, $nguoiDungDuyetBai)
    {
        $logger = service('logger');
        $strSQl = "UPDATE BaiDang SET trangThai = '$trangThai', nguoiDungDuyetBai = '$nguoiDungDuyetBai', thoiGianDuyetBai = CURRENT_DATE WHERE (maBaiDang = '$maBaiDang');";
        $logger->info($strSQl);
        return $this->executeQueryBoolean($strSQl);
    }

    public function layDanhSachtop6new()
    {
        return $this->executeQuery("SELECT *, (SELECT tenDangNhap FROM NguoiDung WHERE BaiDang.maNguoiDung = NguoiDung.maNguoiDung) AS tenNguoiDung, (SELECT tenChuyenMuc FROM ChuyenMuc WHERE ChuyenMuc.maChuyenMuc = BaiDang.maChuyenMuc) AS tenChuyenMuc FROM BaiDang WHERE trangThai = '2' ORDER BY ngayDang DESC LIMIT 6 ;");
    }

    public function layTongSoDongBaiViet($urlChuenMuc)
    {
        $strSQL = "select count(*) as total from BaiDang where maChuyenMuc = (select maChuyenMuc from ChuyenMuc where urlChuenMuc = '$urlChuenMuc');";
        $result = $this->executeQuery($strSQL);
        return $result[0]['total'];
    }

    // public function layDanhSachBaiViet_ChuyenMuc_PhanTrang($urlChuenMuc, $start, $limit)
    // {
    //     $strSQL = "SELECT maBaiDang, noiDung, maNguoiDung, maChuyenMuc, maNguoiDungCapNhatCuoi, tieuDe, anhTieuDe, ngayDang, ngayCapNhat, trangThai, urlBaiDang FROM baidang WHERE maChuyenMuc = (SELECT maChuyenMuc FROM ChuyenMuc WHERE urlChuenMuc = '$urlChuenMuc') AND trangThai = '1' LIMIT $start, $limit;";
    //     return $this->executeQuery($strSQL);
    // }
    public function layDanhSachBaiViet_ChuyenMuc_PhanTrang($urlChuenMuc, $start, $limit)
    {
        $strSQL = "WITH RECURSIVE SubCategories AS ( SELECT maChuyenMuc FROM ChuyenMuc WHERE urlChuenMuc = '$urlChuenMuc' UNION ALL SELECT c.maChuyenMuc FROM ChuyenMuc c INNER JOIN SubCategories sc ON c.maChuyenMucCha = sc.maChuyenMuc ) SELECT b.* FROM BaiDang b INNER JOIN SubCategories sc ON b.maChuyenMuc = sc.maChuyenMuc WHERE b.trangThai = '2' LIMIT $start, $limit;";
        return $this->executeQuery($strSQL);
    }
}

//SELECT maBoSuuTap, tenBoSuuTap, loai, ngayTao, trangThai,ngayDuyet,moTa, ngayDuyet FROM BoSuuTap WHERE trangThai = '2' LIMIT $start, $limit;