<?php

namespace App\Models;

use CodeIgniter\Model;

class ThuGopYModel extends BaseModel
{
    // public function getAllThuGopY()
    // {
    //     $sql = "SELECT maThuGopY, hoTen, email, soDienThoai, tieuDe, ngayTao, trangThai,(select tenDangNhap from NguoiDung where maNguoiDung = (select maNguoiDung from PhanHoi where maThuGopY= PhanHoi.maThuGopY = ThuGopY.maThuGopY) ) as tenNguoiDungPhanHoi, (select thoiGianPhanHoi from PhanHoi where PhanHoi.maThuGopY= PhanHoi.maThuGopY = ThuGopY.maThuGopY) as thoiGianPhanHoi, case when (select trangThai from PhanHoi where PhanHoi.maThuGopY = ThuGopY.maThuGopY) is null then 0 else 1 end as trangThaiDaPhanHoi FROM ThuGopY";
    //     return $this->executeQuery($sql);
    // }
    public function getAllThuGopY()
    {
        $sql = "SELECT maThuGopY, hoTen, dangPhanHoi, email, soDienThoai, tieuDe, ngayTao, trangThai, thoiGianPhanHoi, maNguoiDungPhanHoi,thoiGianDuyet, (select tenDangNhap from NguoiDung where ThuGopY.maNguoiDungPhanHoi = NguoiDung.maNguoiDung) as tenNguoiDungPhanHoi,  (select tenDangNhap from NguoiDung where ThuGopY.maNguoiDuyet = NguoiDung.maNguoiDung) as tenNguoiDungDuyet from ThuGopY where trangThai != '0';";
        return $this->executeQuery($sql);
    }

    public function lay_thu_da_phan_hoi()
    {
        $sql = "select maThuGopY, tieuDe, noiDung, ngayTao, noiDungTraLoiGopY, thoiGianPhanHoi from ThuGopY where trangThai = '2';";
        return $this->executeQuery($sql);
    }


    public function getThuGopYID($maThuGopY)
    {
        $sql = "SELECT *,(select tenDangNhap from NguoiDung where ThuGopY.maNguoiDungPhanHoi = NguoiDung.maNguoiDung) as tenNguoiDungPhanHoi FROM ThuGopY WHERE maThuGopY = '$maThuGopY'";
        return $this->executeQuery($sql);
    }
    public function getAllThuGopYTrangThai($trangThai = '1')
    {
        $sql = "SELECT * FROM ThuGopY ORDER BY ngayCapNhat DESC and trangThai = '$trangThai'";
        return $this->executeQuery($sql);
    }

    public function createThuGopY($maThuGopY, $hoTen, $email, $soDienThoai, $tieuDe, $noiDung)
    {
        $sql = "INSERT INTO ThuGopY (maThuGopY, hoTen, email, soDienThoai, tieuDe, noiDung) VALUES ('$maThuGopY', '$hoTen', '$email', '$soDienThoai', '$tieuDe', '$noiDung')";
        return $this->executeQueryBoolean($sql);
    }

    public function updateThuGopY($maThuGopY, $hoten, $email, $sodt, $tieuDe, $noidung, $trangThai, $noidung_tl, $manguoidungPhanHoi, $dangPhanHoi)
    {
        $sql = "UPDATE ThuGopY SET hoTen = '$hoten', email = '$email', soDienThoai = '$sodt', tieuDe = '$tieuDe', noiDung = '$noidung', trangThai = '$trangThai', noiDungTraLoiGopY = '$noidung_tl', thoiGianPhanHoi = curdate(), maNguoiDungPhanHoi = '$manguoidungPhanHoi', dangPhanHoi = '$dangPhanHoi' WHERE (maThuGopY = '$maThuGopY');";

        return $this->executeQueryBoolean($sql);
    }

    public function deactivateThuGopY($maThuGopY)
    {
        $sql = "UPDATE ThuGopY SET trangThai = '0' WHERE maThuGopY = '$maThuGopY'";
        return $this->executeQueryBoolean($sql);
    }

    public function updateStatusAndDate($maThuGopY, $ngayCapNhat, $trangThai)
    {
        $sql = "UPDATE ThuGopY SET ngayCapNhat = '$ngayCapNhat', trangThai = '$trangThai' WHERE maThuGopY = '$maThuGopY'";
        return $this->executeQueryBoolean($sql);
    }

    public function cap_nhat_trang_thai($maThuGopY, $trangThai, $manguoiduyet)
    {
        $sql = "UPDATE ThuGopY SET maNguoiDuyet = '$manguoiduyet',trangThai = '$trangThai', thoiGianDuyet = CURRENT_DATE WHERE (maThuGopY = '$maThuGopY');";
        return $this->executeQueryBoolean($sql);
    }
}
