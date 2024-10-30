<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class GioiThieuController extends BaseController
{
    public function index()
    {
        // Lấy thông tin cấu hình từ file JSON
        $dtJson =  $this->docthongtinweb();

        // Chuẩn bị dữ liệu cho trang giới thiệu
        $data_template['title'] = 'Giới thiệu về chúng tôi';
        $data_template['content'] = !empty($dtJson['aboutContent']) ? $dtJson['aboutContent'] : 'Chúng tôi là tổ chức hàng đầu trong lĩnh vực XYZ. Với sứ mệnh mang đến những sản phẩm chất lượng cao và dịch vụ vượt trội, chúng tôi luôn nỗ lực không ngừng để cải thiện chất lượng cuộc sống cho mọi người.';
        $data_template['address'] = !empty($dtJson['address']) ? $dtJson['address'] : '';
        $data_template['phoneNumber'] = !empty($dtJson['phoneNumber']) ? $dtJson['phoneNumber'] : '';
        $data_template['email'] = !empty($dtJson['email']) ? $dtJson['email'] : '';
        $data_template['logo'] = !empty($dtJson['logo']) ? $dtJson['logo'] : '';
        $data_template['facebook'] = !empty($dtJson['facebook']) ? $dtJson['facebook'] : '';

        // Thống kê lượt truy cập
        $this->demTruyCap();
        $ls_TruyCapNgay = $this->UserModel->lay_sl_truy_cap_ngay_now();
        $ls_TruyCapThang = $this->UserModel->lay_sl_truy_cap_thang_now();
        $ls_TruyCapNam = $this->UserModel->lay_sl_truy_cap_nam_now();
        $ls_TruyCapToanBo = $this->UserModel->lay_sl_truy_cap_tong();
        $data_template['luoc_truy_cap'] = [
            "sl_tc_ngay" => $ls_TruyCapNgay,
            "sl_tc_thang" => $ls_TruyCapThang,
            "sl_tc_nam" => $ls_TruyCapNam,
            "sl_tc_tong" => $ls_TruyCapToanBo
        ];

        // Render trang giới thiệu với dữ liệu đã chuẩn bị
        return $this->template(view("Page_GioiThieu", $data_template));
       
    }

    public function ChucNangNV()
    {
        // Lấy thông tin cấu hình từ file JSON
        $dtJson =  $this->docthongtinweb();

        // Chuẩn bị dữ liệu cho trang giới thiệu
        $data_template['title'] = 'Giới thiệu về chúng tôi';
        $data_template['content'] = !empty($dtJson['aboutContent']) ? $dtJson['aboutContent'] : 'Chúng tôi là tổ chức hàng đầu trong lĩnh vực XYZ. Với sứ mệnh mang đến những sản phẩm chất lượng cao và dịch vụ vượt trội, chúng tôi luôn nỗ lực không ngừng để cải thiện chất lượng cuộc sống cho mọi người.';
        $data_template['address'] = !empty($dtJson['address']) ? $dtJson['address'] : '';
        $data_template['phoneNumber'] = !empty($dtJson['phoneNumber']) ? $dtJson['phoneNumber'] : '';
        $data_template['email'] = !empty($dtJson['email']) ? $dtJson['email'] : '';
        $data_template['logo'] = !empty($dtJson['logo']) ? $dtJson['logo'] : '';
        $data_template['facebook'] = !empty($dtJson['facebook']) ? $dtJson['facebook'] : '';

        // Thống kê lượt truy cập
        $this->demTruyCap();
        $ls_TruyCapNgay = $this->UserModel->lay_sl_truy_cap_ngay_now();
        $ls_TruyCapThang = $this->UserModel->lay_sl_truy_cap_thang_now();
        $ls_TruyCapNam = $this->UserModel->lay_sl_truy_cap_nam_now();
        $ls_TruyCapToanBo = $this->UserModel->lay_sl_truy_cap_tong();
        $data_template['luoc_truy_cap'] = [
            "sl_tc_ngay" => $ls_TruyCapNgay,
            "sl_tc_thang" => $ls_TruyCapThang,
            "sl_tc_nam" => $ls_TruyCapNam,
            "sl_tc_tong" => $ls_TruyCapToanBo
        ];

        // Render trang giới thiệu với dữ liệu đã chuẩn bị
        
        return $this->template(view("Page_ChucNangNhiemVu", $data_template));
    }

    public function CoCauToChuc()
    {
        // Lấy thông tin cấu hình từ file JSON
        $dtJson =  $this->docthongtinweb();

        // Chuẩn bị dữ liệu cho trang giới thiệu
        $data_template['title'] = 'Giới thiệu về chúng tôi';
        $data_template['content'] = !empty($dtJson['aboutContent']) ? $dtJson['aboutContent'] : 'Chúng tôi là tổ chức hàng đầu trong lĩnh vực XYZ. Với sứ mệnh mang đến những sản phẩm chất lượng cao và dịch vụ vượt trội, chúng tôi luôn nỗ lực không ngừng để cải thiện chất lượng cuộc sống cho mọi người.';
        $data_template['address'] = !empty($dtJson['address']) ? $dtJson['address'] : '';
        $data_template['phoneNumber'] = !empty($dtJson['phoneNumber']) ? $dtJson['phoneNumber'] : '';
        $data_template['email'] = !empty($dtJson['email']) ? $dtJson['email'] : '';
        $data_template['logo'] = !empty($dtJson['logo']) ? $dtJson['logo'] : '';
        $data_template['facebook'] = !empty($dtJson['facebook']) ? $dtJson['facebook'] : '';

        // Thống kê lượt truy cập
        $this->demTruyCap();
        $ls_TruyCapNgay = $this->UserModel->lay_sl_truy_cap_ngay_now();
        $ls_TruyCapThang = $this->UserModel->lay_sl_truy_cap_thang_now();
        $ls_TruyCapNam = $this->UserModel->lay_sl_truy_cap_nam_now();
        $ls_TruyCapToanBo = $this->UserModel->lay_sl_truy_cap_tong();
        $data_template['luoc_truy_cap'] = [
            "sl_tc_ngay" => $ls_TruyCapNgay,
            "sl_tc_thang" => $ls_TruyCapThang,
            "sl_tc_nam" => $ls_TruyCapNam,
            "sl_tc_tong" => $ls_TruyCapToanBo
        ];

        // Render trang giới thiệu với dữ liệu đã chuẩn bị
        
        return $this->template(view("Page_CoCauToChuc", $data_template));
    }

    public function LinhVucHD()
    {
        // Lấy thông tin cấu hình từ file JSON
        $dtJson =  $this->docthongtinweb();

        // Chuẩn bị dữ liệu cho trang giới thiệu
        $data_template['title'] = 'Giới thiệu về chúng tôi';
        $data_template['content'] = !empty($dtJson['aboutContent']) ? $dtJson['aboutContent'] : 'Chúng tôi là tổ chức hàng đầu trong lĩnh vực XYZ. Với sứ mệnh mang đến những sản phẩm chất lượng cao và dịch vụ vượt trội, chúng tôi luôn nỗ lực không ngừng để cải thiện chất lượng cuộc sống cho mọi người.';
        $data_template['address'] = !empty($dtJson['address']) ? $dtJson['address'] : '';
        $data_template['phoneNumber'] = !empty($dtJson['phoneNumber']) ? $dtJson['phoneNumber'] : '';
        $data_template['email'] = !empty($dtJson['email']) ? $dtJson['email'] : '';
        $data_template['logo'] = !empty($dtJson['logo']) ? $dtJson['logo'] : '';
        $data_template['facebook'] = !empty($dtJson['facebook']) ? $dtJson['facebook'] : '';

        // Thống kê lượt truy cập
        $this->demTruyCap();
        $ls_TruyCapNgay = $this->UserModel->lay_sl_truy_cap_ngay_now();
        $ls_TruyCapThang = $this->UserModel->lay_sl_truy_cap_thang_now();
        $ls_TruyCapNam = $this->UserModel->lay_sl_truy_cap_nam_now();
        $ls_TruyCapToanBo = $this->UserModel->lay_sl_truy_cap_tong();
        $data_template['luoc_truy_cap'] = [
            "sl_tc_ngay" => $ls_TruyCapNgay,
            "sl_tc_thang" => $ls_TruyCapThang,
            "sl_tc_nam" => $ls_TruyCapNam,
            "sl_tc_tong" => $ls_TruyCapToanBo
        ];

        // Render trang giới thiệu với dữ liệu đã chuẩn bị
        
        return $this->template(view("Page_LinhVucHoatDong", $data_template));
    }

   
}
