<?php

namespace App\Models;

use CodeIgniter\Model;

class PanelModel extends BaseModel
{

    public function lay_ds_panel()
    {
        $strSQL = "SELECT maSlide,(SELECT tenDangNhap FROM  NguoiDung WHERE NguoiDung.maNguoiDung = SlideBanner.maNguoiDung) as tenNguoiDung, (SELECT tenDangNhap FROM  NguoiDung WHERE NguoiDung.maNguoiDung = SlideBanner.nguoiDungCapNhat) as tenNguoiDungCapNhat,imageURL,urlBaiViet,ngayTao,ngayCapNhat,viTri FROM SlideBanner;";
        $result = $this->executeQuery($strSQL);
        return $result;
    }

    public function lay_ds_panel_top()
    {
        return $this->executeQuery("SELECT maSlide, imageURL,urlBaiViet, viTri FROM SlideBanner WHERE  viTri = '1';");
    }

    public function lay_ds_panel_canh_ben()
    {
        return $this->executeQuery("SELECT maSlide, imageURL,urlBaiViet, viTri FROM SlideBanner WHERE viTri = '2';");
    }

    public function them_moi_panel($tenNguoiDung, $imageUrl, $urlBaiViet, $vitri)
    {
        $id_panel = uniqid("panel_", true);
        $strSQL = "";
        if (isset($urlBaiViet)) {
            $strSQL = "insert into SlideBanner ( maSlide, maNguoiDung, imageURL, urlBaiViet, viTri ) values ( '$id_panel', '$tenNguoiDung', '$imageUrl', '$urlBaiViet', '$vitri' );";
        } else {
            $strSQL = "insert into SlideBanner ( maSlide, maNguoiDung, imageURL, urlBaiViet, viTri ) values ( '$id_panel', '$tenNguoiDung', '$imageUrl',null, '$vitri' );";
        }
        $result = $this->executeQueryBoolean($strSQL);
        return $result;
    }
    public function xoa($maSlide)
    {
        $strSQL = "delete from SlideBanner where maSlide = '$maSlide'";
        return $this->executeQueryBoolean($strSQL);
    }
    public function lay_thong_tin_panel($masl)
    {
        $strSQL = "SELECT maSlide,(SELECT tenDangNhap FROM  NguoiDung WHERE NguoiDung.maNguoiDung = SlideBanner.maNguoiDung) as tenNguoiDung,imageURL,urlBaiViet,ngayTao,ngayCapNhat,viTri FROM SlideBanner WHERE maSlide = '$masl';";

        return $this->executeQuery($strSQL);
    }
    public function cap_nhat_panel($imageURL, $urlBaiViet, $viTri, $nguoiDungCapNhat, $maSlide,$ngayCapNhat)
    {
        $logger = service('logger');
        $strSQL = "";
        if (isset($imageURL)) {
            $strSQL = "update  SlideBanner  set imageURL = '$imageURL', urlBaiViet = '$urlBaiViet', viTri = '$viTri', nguoiDungCapNhat = '$nguoiDungCapNhat', ngayCapNhat = '$ngayCapNhat' where maSlide = '$maSlide';";
        } else {
            $strSQL = "update  SlideBanner set urlBaiViet = '$urlBaiViet', viTri = '$viTri', nguoiDungCapNhat = '$nguoiDungCapNhat', ngayCapNhat = '$ngayCapNhat' where maSlide = '$maSlide';";
        }

        $logger->info($strSQL);
        $result = $this->executeQueryBoolean($strSQL);
        return $result;
    }

    public function lay_anh_panel($id)
    {
        $logger = service('logger');
        $strSQL = "SELECT imageURL FROM SlideBanner WHERE maSlide = '$id'";

        $result = $this->executeQuery($strSQL);
        $img_old = "";
        foreach ($result as $row) {
            $img_old = $row["imageURL"];
        }


        return $img_old;
    }
}
