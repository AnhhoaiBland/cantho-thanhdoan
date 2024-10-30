<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends BaseModel
{
    public function dangNhap($tenDN, $pass)
    {
        // Kiểm tra xem tên đăng nhập có tồn tại không
        $resultCheckName = $this->executeQuery("SELECT COUNT(*) AS checkName FROM NguoiDung WHERE trangThai = '1' AND tenDangNhap = '$tenDN';");
        $checkNameLogin = $resultCheckName[0]['checkName'];
    
        if ($checkNameLogin == 0) {
            return "Người dùng không tồn tại";
        } else {
            // Lấy mật khẩu từ cơ sở dữ liệu
            $resultPass = $this->executeQuery("SELECT matKhau FROM NguoiDung WHERE trangThai = '1' AND tenDangNhap = '$tenDN'");
            
            // Nếu không tìm thấy mật khẩu
            if (empty($resultPass)) {
                return "Mật khẩu không chính xác";
            }
    
            $passDB = $resultPass[0]['matKhau'];
            
            // Sử dụng password_verify để so sánh mật khẩu
            if (!password_verify($pass, $passDB)) {
                return "Mật khẩu không chính xác";
            } else {
                return true; // Hoặc trả về thông tin người dùng nếu cần
            }
        }
    }
    

    public function layDuLieuCaNhan($userName)
    {
        $strSQL = "SELECT * FROM NguoiDung where tenDangNhap = '$userName';";
        $result = $this->executeQuery($strSQL);
        return $result;
    }

    public function layDuLieuCaNhanUser($maNguoiDung)
    {
        $logger = service("logger");
        $strSQL = "SELECT *, (select tenLoaiNguoiDung from  LoaiNguoiDung where LoaiNguoiDung.maLoaiND = NguoiDung.maLoaiND) as tenLoaiND FROM NguoiDung where maNguoiDung = '$maNguoiDung';";
        $logger->info($strSQL);
        $result = $this->executeQuery($strSQL);
        return $result;
    }

    public function lay_ma_user_qua_tenDN($userName)
    {
        $strSql = "SELECT maNguoiDung FROM NguoiDung WHERE tenDangNhap = '$userName';";
        $result = $this->executeQuery($strSql);
        return $result[0]['maNguoiDung'];
    }

    public function updatePass($passNew)
    {
        $this->executeQueryBoolean("update NguoiDung set matKhau = '$passNew' where maNguoiDung = 'admin';");
    }

    public function layDanhSachNguoiDung()
    {
        $strSQL = "SELECT *, (select tenLoaiNguoiDung from  LoaiNguoiDung where LoaiNguoiDung.maLoaiND = NguoiDung.maLoaiND) as tenLoaiNguoiDung FROM NguoiDung where trangThai != '0';";
        $result = $this->executeQuery($strSQL);
        return $result;
    }


    public function createNguoiDung($maNguoiDung, $tenDangNhap, $hoVaTen, $matKhau, $maLoaiND)
    {
        $sql = "INSERT INTO NguoiDung (maNguoiDung, tenDangNhap, hoVaTen, matKhau, maLoaiND) VALUES ('$maNguoiDung', '$tenDangNhap', '$hoVaTen', '$matKhau', '$maLoaiND')";
        return $this->executeQueryBoolean($sql);
    }

    public function updateNguoiDung($maNguoiDung, $tenDangNhap, $ngayCapNhat, $hoVaTen, $maLoaiND)
    {
        $sql = "UPDATE NguoiDung SET tenDangNhap = '$tenDangNhap', ngayCapNhat = '$ngayCapNhat', hoVaTen = '$hoVaTen', maLoaiND = '$maLoaiND' WHERE (maNguoiDung = '$maNguoiDung')";
        return $this->executeQueryBoolean($sql);
    }

    public function layTrangThaiVoiTenDN($tenDangNhap)
    {
        $str = "  select trangThai from NguoiDung where tenDangNhap = '$tenDangNhap' ;";
        $result = $this->executeQuery($str);
        return $result[0]['trangThai'];
    }

    public function changePassword($tenDangNhap, $matKhau)
    {

        $tenDangNhapTrim = trim($tenDangNhap);
        $sql = "UPDATE NguoiDung SET matKhau = '$matKhau' WHERE (tenDangNhap = '$tenDangNhapTrim')";
 
        return $this->executeQueryBoolean($sql);
    }

    public function capNhatTrangThaiND($maNguoiDung, $trangthai)
    {
        $sql = "UPDATE NguoiDung SET trangThai = '$trangthai' WHERE (maNguoiDung = '$maNguoiDung')";
        return $this->executeQueryBoolean($sql);
    }
    public function demTen($tenDangNhap)
    {
        $strSQL = "select count(*) as dem from NguoiDung where tenDangNhap = '$tenDangNhap';";
        $result = $this->executeQuery($strSQL);
        return $result[0]['dem'];
    }
    public function layTenDNTheoMa($maNguoiDung)
    {
        $strSQL = "SELECT tenDangNhap FROM NguoiDung where maNguoiDung = '$maNguoiDung';";
        $result = $this->executeQuery($strSQL);
        return $result[0]['tenDangNhap'];
    }
    public function deleteUser($maNguoiDung)
    {
        $sql = "DELETE FROM NguoiDung WHERE (maNguoiDung = '$maNguoiDung')";
        return $this->executeQueryBoolean($sql);
    }

    public function getMaLoaiNDByMaNguoiDung($maNguoiDung)
    {
        $sql = "SELECT maLoaiND FROM NguoiDung WHERE maNguoiDung = '$maNguoiDung'";
        $result = $this->executeQuery($sql);
        return $result[0]['maLoaiND'];
    }

    // loại người dùng


    public function lay_ds_loai_nguoi_dung()
    {
        $strSQL = "SELECT * FROM LoaiNguoiDung";
        $result = $this->executeQuery($strSQL);
        return $result;
    }

    public function lay_loai_nguoi_dung($maLoaiND)
    {
        $strSQL = "SELECT * FROM LoaiNguoiDung where maLoaiND = '$maLoaiND'";
        $result = $this->executeQuery($strSQL);
        return $result;
    }

    public function them_loai_nguoi_dung($maLoaiND, $tenLoaiNguoiDung, $moTa)
    {
        $sql = "INSERT INTO LoaiNguoiDung (maLoaiND, tenLoaiNguoiDung, moTa) VALUES ('$maLoaiND', '$tenLoaiNguoiDung', '$moTa')";
        return $this->executeQueryBoolean($sql);
    }

    public function cap_nhat_loai_nguoi_dung($maLoaiND, $tenLoaiNguoiDung, $moTa)
    {
        $sql = "UPDATE LoaiNguoiDung SET tenLoaiNguoiDung = '$tenLoaiNguoiDung', moTa = '$moTa' WHERE (maLoaiND = '$maLoaiND')";
        return $this->executeQueryBoolean($sql);
    }

    public function lay_ten_loai_nguoi_dung($maLoaiND)
    {
        $strSQL = "SELECT tenLoaiNguoiDung FROM LoaiNguoiDung where maLoaiND = '$maLoaiND'";
        $result = $this->executeQuery($strSQL);
        return $result[0]['tenLoaiNguoiDung'];
    }

    public function xoa_loai_nguoi_dung($maLoaiND)
    {
        $sql = "DELETE FROM LoaiNguoiDung WHERE (maLoaiND = '$maLoaiND')";
        return $this->executeQueryBoolean($sql);
    }

    public function check_codung_loai_nguoi_dung($maLoaiND)
    {
        $sql = "select count(*) as dem from NguoiDung where maLoaiND = '$maLoaiND';";
        $result = $this->executeQuery($sql);
        return $result[0]['dem'];
    }
    public function check_ten_loai_nguoi_dung($tenLoaiNguoiDung)
    {
        $sql = "select count(*) as dem from LoaiNguoiDung where tenLoaiNguoiDung = '$tenLoaiNguoiDung';";
        $result = $this->executeQuery($sql);
        return $result[0]['dem'];
    }


    // quyền hạng truy cập
    public function lay_ds_quyen_thuoc_loai_nd($maLoaiND)
    {
        $strSQL = "SELECT * FROM QuyenTruyCap where maLoaiND = '$maLoaiND';";
        $result = $this->executeQuery($strSQL);
        return $result;
    }

    // public function createQuyenTruyCap($maQuyenTC, $maLoaiND, $maTacVu) {
    //     $sql = "INSERT INTO QuyenTruyCap (maQuyenTC, maLoaiND, maTacVu) VALUES ('$maQuyenTC', '$maLoaiND', '$maTacVu')";
    //     return $this->executeQueryBoolean($sql);
    // }
    public function createQuyenTruyCap($maLoaiND, $maNhom)
    {
        $sql = "INSERT INTO LoaiNguoiDung_NhomChucNang (maLoaiND, maNhom) VALUES ('$maLoaiND', '$maNhom');";
        return $this->executeQueryBoolean($sql);
    }

    public function updateQuyenTruyCap($maQuyenTC, $maLoaiND, $maTacVu)
    {
        $sql = "UPDATE QuyenTruyCap SET maLoaiND = '$maLoaiND', maTacVu = '$maTacVu' WHERE maQuyenTC = '$maQuyenTC'";
        return $this->executeQuery($sql);
    }

    public function deleteQuyenTruyCap($maLoaiND)
    {
        $sql = "DELETE FROM LoaiNguoiDung_NhomChucNang WHERE maLoaiND = '$maLoaiND'";
        return $this->executeQueryBoolean($sql);
    }

    public function countQuyenTruyCapByMaLoaiND($maLoaiND)
    {
        $sql = "SELECT COUNT(*) AS dem FROM QuyenTruyCap WHERE maLoaiND = '$maLoaiND'";
        return $this->executeQuery($sql);
    }

    public function countQuyenTruyCapByMaTacVu($maTacVu)
    {
        $sql = "SELECT COUNT(*) AS dem FROM QuyenTruyCap WHERE maTacVu = '$maTacVu'";
        return $this->executeQuery($sql);
    }

    public function countQuyenTruyCapByTenTacVu($tenTacVu)
    {
        $sql = "SELECT COUNT(*) AS dem FROM QuyenTruyCap WHERE maTacVu IN (SELECT maTacVu FROM TacVuTruyCap WHERE tenTacVu = '$tenTacVu')";
        return $this->executeQuery($sql);
    }

    public function layDanhSachNhomChucNangTheoLoaiND($maLoaiND)
    {
        $sql = "SELECT nt.maNhom, nt.tenNhom, nt.moTa FROM LoaiNguoiDung_NhomChucNang AS lntv INNER JOIN NhomChucNang AS nt ON lntv.maNhom = nt.maNhom WHERE lntv.maLoaiND = '$maLoaiND';";
        return $this->executeQuery($sql);
    }

    public function layTacVuTheoLoaiND($maLoaiND)
    {
        $sql = "SELECT DISTINCT nt.maNhom, nt.tenNhom as tenChucNang, nt.moTa FROM LoaiNguoiDung_NhomChucNang AS lntv INNER JOIN NhomChucNang AS nt ON lntv.maNhom = nt.maNhom WHERE lntv.maLoaiND = '$maLoaiND' ORDER BY nt.tenNhom;";
        return $this->executeQuery($sql);
    }

    public function checkQuyenTruyCapCuaLoaiNDQuaMaTacVu($ma_loai_nd, $ma_tac_vu)
    {
        $sql = "SELECT CASE WHEN EXISTS ( SELECT 1 FROM QuyenTruyCap qt JOIN TacVuTruyCap tv ON qt.maTacVu = tv.maTacVu WHERE qt.maLoaiND = '$ma_loai_nd' AND tv.maTacVu = $ma_tac_vu ) THEN 1 ELSE 0 END AS coQuyenTruyCap;";
        $result = $this->executeQuery($sql);
        return $result[0]['coQuyenTruyCap'];
    }

    public function lay_danh_sach_quyen_maNguoiDung($maNguoiDung)
    {
        $sql = "SELECT cn.urlChucNang FROM NguoiDung AS nd INNER JOIN LoaiNguoiDung AS lnd ON nd.maLoaiND = lnd.maLoaiND INNER JOIN LoaiNguoiDung_NhomChucNang AS lntv ON lnd.maLoaiND = lntv.maLoaiND INNER JOIN NhomChucNang AS nt ON lntv.maNhom = nt.maNhom INNER JOIN NhomChucNang_ChucNang AS ncnc ON nt.maNhom = ncnc.maNhom INNER JOIN ChucNangTruyCap AS cn ON ncnc.maChucNang = cn.maChucNang WHERE nd.maNguoiDung = '$maNguoiDung';";
        $result = $this->executeQuery($sql);
        return  $result;
    }

    public function checkQuyenTruyCapCuaLoaiNDQuaUrl($ma_loai_nd, $urlTacVu)
    {
        $sql = "SELECT CASE WHEN EXISTS ( SELECT 1 FROM QuyenTruyCap qt JOIN TacVuTruyCap tv ON qt.maTacVu = tv.maTacVu WHERE qt.maLoaiND = '$ma_loai_nd' AND tv.urlTacVu = '$urlTacVu' ) THEN 1 ELSE 0 END AS coQuyenTruyCap;";
        $result = $this->executeQuery($sql);
        return $result[0]['coQuyenTruyCap'];
    }

    public function checkQuyenTruyCapNDQuaTenDN($maNguoiDung, $urlChucNang)
    {
        $sql = "SELECT CASE WHEN COUNT(*) > 0 THEN 1 ELSE 0 END AS coQuyenTruyCap FROM NguoiDung AS nd INNER JOIN LoaiNguoiDung AS lnd ON nd.maLoaiND = lnd.maLoaiND INNER JOIN LoaiNguoiDung_NhomChucNang AS lntv ON lnd.maLoaiND = lntv.maLoaiND INNER JOIN NhomChucNang AS nt ON lntv.maNhom = nt.maNhom INNER JOIN NhomChucNang_ChucNang AS ncnc ON nt.maNhom = ncnc.maNhom INNER JOIN ChucNangTruyCap AS cn ON ncnc.maChucNang = cn.maChucNang WHERE nd.maNguoiDung = '$maNguoiDung' AND cn.urlChucNang = '$urlChucNang';";
        $result = $this->executeQuery($sql);
        return $result[0]['coQuyenTruyCap'];
    }

    public function check_nguoi_dung_co_nhom_quyen($maNguoiDung, $maNhom)
    {
        $sql = "SELECT COUNT(*) AS is_member FROM NguoiDung AS nd INNER JOIN LoaiNguoiDung AS lnd ON nd.maLoaiND = lnd.maLoaiND INNER JOIN LoaiNguoiDung_NhomChucNang AS lnd_ncn ON lnd.maLoaiND = lnd_ncn.maLoaiND WHERE nd.maNguoiDung = '$maNguoiDung' AND lnd_ncn.maNhom = '$maNhom';";
        $result = $this->executeQuery($sql);
        return $result[0]['is_member'];
    }

    public function dem_truy_cao($thoiGian)
    {
        $sql = "INSERT INTO DemTruyCap (thoiGian) VALUES ('$thoiGian') ON DUPLICATE KEY UPDATE idDem = idDem + 1;";
        // $sql = "INSERT INTO DemTruyCap (thoiGian) VALUES ('$thoiGian');";
        return $this->executeQueryBoolean($sql);
    }

    public function lay_sl_truy_cap_ngay_now()
    {
        $sql = "SELECT COUNT(*) AS SoLuongTruyCap FROM DemTruyCap WHERE thoiGian = CURDATE();";
        $result = $this->executeQuery($sql);
        return $result[0]['SoLuongTruyCap'];
    }

    public function lay_sl_truy_cap_thang_now()
    {
        $sql = "SELECT COUNT(*) AS SoLuongTruyCap FROM DemTruyCap WHERE MONTH(thoiGian) = MONTH(CURDATE()) AND YEAR(thoiGian) = YEAR(CURDATE());";
        $result = $this->executeQuery($sql);
        return $result[0]['SoLuongTruyCap'];
    }

    public function lay_sl_truy_cap_nam_now()
    {
        $sql = "SELECT COUNT(*) AS SoLuongTruyCap FROM DemTruyCap WHERE YEAR(thoiGian) = YEAR(CURDATE());";
        $result = $this->executeQuery($sql);
        return $result[0]['SoLuongTruyCap'];
    }

    public function lay_sl_truy_cap_tong()
    {
        $sql = "SELECT COUNT(*) AS SoLuongTruyCap FROM DemTruyCap;";
        $result = $this->executeQuery($sql);
        return $result[0]['SoLuongTruyCap'];
    }
}
