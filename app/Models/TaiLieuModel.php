<?php

namespace App\Models;

use CodeIgniter\Model;

class TaiLieuModel extends BaseModel
{
    public function tim_tailieu($tim_van_ban, $maDanhMucTaiLieu, $thoiGianBanHanh)
    {
        $logger = service("logger");
        $strSQl = "SET @searchKeyword = '$tim_van_ban'; SET @searchThoiGianBanHanh = '$thoiGianBanHanh'; SET @searchTenDanhMucTaiLieu = '$maDanhMucTaiLieu'; SELECT tl.maTaiLieu, tl.tenTaiLieu, tl.soHieuTL, dmtl.tenDanhMucTaiLieu, tl.moTa, tl.ngayTao, tl.ngayCapNhat, tl.duongDanTaiVe, tl.thoiGianBanHanh FROM TaiLieu tl LEFT JOIN DanhMucTaiLieu dmtl ON tl.maDanhMucTaiLieu = dmtl.maDanhMucTaiLieu WHERE ((tl.tenTaiLieu LIKE CONCAT('%', @searchKeyword, '%') COLLATE utf8mb4_unicode_ci OR tl.soHieuTL LIKE CONCAT('%', @searchKeyword, '%') COLLATE utf8mb4_unicode_ci) OR tl.thoiGianBanHanh LIKE CONCAT('%', @searchThoiGianBanHanh, '%') COLLATE utf8mb4_unicode_ci OR dmtl.tenDanhMucTaiLieu LIKE CONCAT('%', @searchTenDanhMucTaiLieu, '%') COLLATE utf8mb4_unicode_ci OR @searchKeyword IS NULL);";
        $logger->info($strSQl);
        return $this->executeQuery($strSQl);
    }

    //     public function tim_tailieu($tim_van_ban, $maDanhMucTaiLieu, $thoiGianBanHanh)
    // {
    //     $logger = service("logger");
    //     $strSQl = "select *, (select tenDanhMucTaiLieu from DanhMucTaiLieu where DanhMucTaiLieu.maDanhMucTaiLieu = TaiLieu.maDanhMucTaiLieu) as tenDanhMucTaiLieu , (select tenDangNhap from NguoiDung where NguoiDung.maNguoiDung = taiLieu.maNguoiDung) as tenNguoiDungTai, (select tenDangNhap from NguoiDung where NguoiDung.maNguoiDung = taiLieu.maNguoiDungCapNhatCuoi) as tenNguoiDungCapNhat from TaiLieu where soHieuTL like '%$tim_van_ban%' or maDanhMucTaiLieu = '%$maDanhMucTaiLieu%' or thoiGianBanHanh = '%$thoiGianBanHanh%' or tenTaiLieu like '%$tim_van_ban%';";
    //    
    //     return $this->executeQuery($strSQl);
    // }
    public function layDanhSachTaiLieu()
    {
        $strSQL = "select *, (select tenDanhMucTaiLieu from DanhMucTaiLieu where DanhMucTaiLieu.maDanhMucTaiLieu = TaiLieu.maDanhMucTaiLieu) as tenDanhMucTaiLieu , (select tenDangNhap from NguoiDung where NguoiDung.maNguoiDung = taiLieu.maNguoiDung) as tenNguoiDungTai, (select tenDangNhap from NguoiDung where NguoiDung.maNguoiDung = taiLieu.maNguoiDungCapNhatCuoi) as tenNguoiDungCapNhat from taiLieu";

        $result = $this->executeQuery($strSQL);
        return $result;
    }

    public function lay_tai_lieu_id($id)
    {
        $strSQL = "select *, (select tenDanhMucTaiLieu from DanhMucTaiLieu where DanhMucTaiLieu.maDanhMucTaiLieu = TaiLieu.maDanhMucTaiLieu) as tenDanhMucTaiLieu , (select tenDangNhap from NguoiDung where NguoiDung.maNguoiDung = taiLieu.maNguoiDung) as tenNguoiDungTai, (select tenDangNhap from NguoiDung where NguoiDung.maNguoiDung = taiLieu.maNguoiDungCapNhatCuoi) as tenNguoiDungCapNhat from taiLieu where maTaiLieu = '$id';";

        $result = $this->executeQuery($strSQL);
        return $result;
    }

    public function lay_duong_dan_file_tai_lieu_id($id)
    {
        $strSQL = "select duongDanTaiVe from TaiLieu where maTaiLieu = '$id';";

        $result = $this->executeQuery($strSQL);

        $duongDang = $result[0]['duongDanTaiVe'];

        return $duongDang;
    }

    public function luu_tai_lieu($maTaiLieu, $soHieuTL, $tenTaiLieu, $maDanhMucTaiLieu, $duongDanTaiVe, $moTa, $maNguoiDung, $thoiGianBanHanh)
    {
        $strSQL = "INSERT INTO TaiLieu (maTaiLieu,soHieuTL ,tenTaiLieu, maDanhMucTaiLieu, duongDanTaiVe, moTa, maNguoiDung, thoiGianBanHanh) VALUES ('$maTaiLieu', '$soHieuTL' ,'$tenTaiLieu', '$maDanhMucTaiLieu', '$duongDanTaiVe', '$moTa', '$maNguoiDung', '$thoiGianBanHanh')";
        return $this->executeQueryBoolean($strSQL);
    }

    public function cap_nhat_tai_lieu($maTaiLieu, $soHieuTL, $tenTaiLieu, $maDanhMucTaiLieu, $maNguoiDungCapNhat, $duongDanTaiVe, $moTa, $ngayCapNhat, $thoiGianBanHanh)
    {

        if ($duongDanTaiVe == "none") {
            $strSQL = "UPDATE TaiLieu SET tenTaiLieu = '$tenTaiLieu', soHieuTL = '$soHieuTL', maDanhMucTaiLieu = '$maDanhMucTaiLieu', maNguoiDungCapNhatCuoi = '$maNguoiDungCapNhat', moTa = '$moTa', ngayCapNhat = '$ngayCapNhat', thoiGianBanHanh = '$thoiGianBanHanh' WHERE maTaiLieu = '$maTaiLieu'";
            return $this->executeQueryBoolean($strSQL);
        } else {
            $strSQL = "UPDATE TaiLieu SET tenTaiLieu = '$tenTaiLieu', soHieuTL = '$soHieuTL', maDanhMucTaiLieu = '$maDanhMucTaiLieu', maNguoiDungCapNhatCuoi = '$maNguoiDungCapNhat', duongDanTaiVe = '$duongDanTaiVe',moTa = '$moTa', ngayCapNhat = '$ngayCapNhat', thoiGianBanHanh = '$thoiGianBanHanh' WHERE maTaiLieu = '$maTaiLieu'";
            return $this->executeQueryBoolean($strSQL);
        }
    }

    public function xoa_tai_lieu($maTaiLieu)
    {
        $strSQL = "DELETE FROM TaiLieu WHERE maTaiLieu = '$maTaiLieu'";
        return $this->executeQueryBoolean($strSQL);
    }



    // danh mục tài liệu
    public function layDanhSachDanhMuc()
    {
        $strSQL = "SELECT * FROM DanhMucTaiLieu;";
        $result = $this->executeQuery($strSQL);
        return $result;
    }

    public function lay_danh_muc_id($id)
    {
        $strSQL = "SELECT * FROM DanhMucTaiLieu where maDanhMucTaiLieu = '$id';";
        $result = $this->executeQuery($strSQL);
        return $result;
    }

    public function luu_danh_muc_tai_lieu($maDanhMucTaiLieu, $tenDanhMucTaiLieu)
    {
        $strSQL = "INSERT INTO DanhMucTaiLieu (maDanhMucTaiLieu, tenDanhMucTaiLieu) VALUES ('$maDanhMucTaiLieu', '$tenDanhMucTaiLieu')";
        return $this->executeQueryBoolean($strSQL);
    }

    public function sua_danh_muc_tai_lieu($maDanhMucTaiLieu, $tenDanhMucTaiLieu)
    {
        $strSQL = "UPDATE DanhMucTaiLieu SET tenDanhMucTaiLieu = '$tenDanhMucTaiLieu' WHERE maDanhMucTaiLieu = '$maDanhMucTaiLieu'";
        return $this->executeQueryBoolean($strSQL);
    }

    public function xoa_danh_muc_tai_lieu($maDanhMucTaiLieu)
    {
        $strSQL = "DELETE FROM DanhMucTaiLieu WHERE maDanhMucTaiLieu = '$maDanhMucTaiLieu'";
        return $this->executeQueryBoolean($strSQL);
    }
    public function kiem_tra_luc_dung_danh_muc_tai_lieu($maDanhMucTaiLieu)
    {
        $strSQL = "select count(*) dem from TaiLieu where maDanhMucTaiLieu = '$maDanhMucTaiLieu';";
        $result = $this->executeQuery($strSQL);
        return $result[0]['dem'];
    }
    public function check_ten_danh_muc_tai_lieu($tenDanhMucTaiLieu)
    {
        $strSQL = "SELECT COUNT(*) AS dem FROM DanhMucTaiLieu WHERE tenDanhMucTaiLieu = '$tenDanhMucTaiLieu'";
        $retrun = $this->executeQuery($strSQL);
        return $retrun[0]['dem'];
    }
}
