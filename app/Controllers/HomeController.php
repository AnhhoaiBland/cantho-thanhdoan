<?php

namespace App\Controllers;

use App\Models\ChuyenMucModels;
use App\Models\PanelModel;
use App\Models\BaiDangModel;

class HomeController extends BaseController
{
    // Khởi tạo instance của lớp UserModel
    protected $ChuyenMucModels, $PanelModel, $BaiDangModel;

    public function __construct()
    {
        $this->ChuyenMucModels = new ChuyenMucModels();
        $this->PanelModel = new PanelModel();
        $this->BaiDangModel = new BaiDangModel();
    }

    public function index()
    {
        // $data = $this->ChuyenMucModels->getList_chuyen_muc_cha();
        // return $this->template(view('Page_TrangChu'), $data);
        $baidangtop6new = $this->BaiDangModel->layDanhSachtop6new();
        $baiDangChuyenMucTinDiaPhuong = $this->BaiDangModel->lay_ds_bai_dang_by_url_ChuyenMuc_top("tin-hoat-dong-dia-phuong",9);
        $baiDangCHuyenMucChinhSachVanBan = $this->BaiDangModel->lay_ds_bai_dang_by_url_ChuyenMuc_top("thong-tin-chi-dao-dieu-hanh",9);
        $data['baidangtop6new'] = $baidangtop6new;
        $data['baiDangChuyenMucTinDiaPhuong'] = $baiDangChuyenMucTinDiaPhuong;
        $data['baiDangCHuyenMucChinhSachVanBan'] = $baiDangCHuyenMucChinhSachVanBan;

        return $this->template(view('Page_TrangChu', $data),null,'v1');
    }

    public function index_v2()
    {
        // $data = $this->ChuyenMucModels->getList_chuyen_muc_cha();
        // return $this->template(view('Page_TrangChu'), $data);
        $baidangtop6new = $this->BaiDangModel->layDanhSachtop6new();
        $baiDangChuyenMucTinDiaPhuong = $this->BaiDangModel->lay_ds_bai_dang_by_url_ChuyenMuc_top("tin-hoat-dong-dia-phuong",9);
        $baiDangCHuyenMucChinhSachVanBan = $this->BaiDangModel->lay_ds_bai_dang_by_url_ChuyenMuc_top("thong-tin-chi-dao-dieu-hanh",9);
        $data['baidangtop6new'] = $baidangtop6new;
        $data['baiDangChuyenMucTinDiaPhuong'] = $baiDangChuyenMucTinDiaPhuong;
        $data['baiDangCHuyenMucChinhSachVanBan'] = $baiDangCHuyenMucChinhSachVanBan;

        return $this->template(view('Page_TrangChu_v2', $data),null,'v2');
    }

    public function ajax_getpaneltop()
    {
        $logger = service('logger');
        $data = $this->PanelModel->lay_ds_panel_top();
        // $logger->info(json_encode($data));
        return json_encode($data);
    }

    public function show_top6_bai_view()
    {
        $baidangtop6new = $this->BaiDangModel->layDanhSachtop6new();
        $baiDangChuyenMucTinDiaPhuong = $this->BaiDangModel->lay_ds_bai_dang_by_url_ChuyenMuc_top("tin-hoat-dong-dia-phuong",9);
        $baiDangCHuyenMucChinhSachVanBan = $this->BaiDangModel->lay_ds_bai_dang_by_url_ChuyenMuc_top("van-ban",9);
        $data['baidangtop6new'] = $baidangtop6new;
        $data['baiDangChuyenMucTinDiaPhuong'] = $baiDangChuyenMucTinDiaPhuong;
        $data['baiDangCHuyenMucChinhSachVanBan'] = $baiDangCHuyenMucChinhSachVanBan;
    }

    public function sitemap() {
        $categoryTree = $this->getCategoryTree();
        $data['categoryTree'] = $categoryTree;
        return $this->template(view('Page_sileMap', $data));
    }
}
