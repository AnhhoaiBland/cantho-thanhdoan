<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TacVuModel;

class TacVuController extends BaseController
{
    protected $TacVuModel;

    public function __construct()
    {
        $this->TacVuModel = new TacVuModel();
    }
    public function index()
    {
        $data['ds_tacvu'] = $this->TacVuModel->getallChucNang();
        return $this->template_admin(view("admin/tacvu/ds_tacvu", $data));
    }
    public function ajax_ldstacvu()
    {
        $request = service("request");
        $result = $this->TacVuModel->getAllNhomChucNang();
        $maLoaiND =  $request->getPost("id");
        $nhom_quyen_hien_co = $this->UserModel->layDanhSachNhomChucNangTheoLoaiND($maLoaiND);
        $kq = ['status' => 'success', 'databstacvu' => $result, 'nhom_quyen_hien_co' => $nhom_quyen_hien_co];
        return json_encode($kq);
    }
    public function addtacvu()
    {
        $request = service("request");
        $maTacVu = uniqid("tacvu_", true);
        $tenTacVu = $request->getPost("tenTacVu");
        $urlTacVu = $this->loc_duong_dan($request->getPost("urlTacVu"));
        $checkTen = $this->TacVuModel->countTacVuTruyCapByTen($tenTacVu);
        if ($checkTen <= 0) {
            $resultSave = $this->TacVuModel->createTacVuTruyCap($maTacVu, $tenTacVu, $urlTacVu);
            if ($resultSave) {
                $kq = ['status' => 'success', 'message' => 'Lưu thành công'];
            } else {
                $kq = ['status' => 'error', 'message' => 'thêm tác vụ không thành công'];
            }
        } else {
            $kq = ['status' => 'error', 'message' => 'Tên loại tác vụ đã tồn tại'];
        }

        return json_encode($kq);
    }

    public function xoatacvu()
    {
        $request = service("request");
        $maTacVu = $request->getPost("id");
        $checkDungTV = $this->TacVuModel->countQuyenTruyCapByTacVu($maTacVu);
        if ($checkDungTV <= 0) {
            $resultXoa = $this->TacVuModel->deleteTacVuTruyCap($maTacVu);
            if ($resultXoa) {
                $kq = ['status' => 'success', 'message' => 'xóa thành công'];
            } else {
                $kq = ['status' => 'error', 'message' => 'xóa tác vụ không thành công'];
            }
        } else {
            $kq = ['status' => 'error', 'message' => 'Tác vụ đang còn được sử dụng không thể xóa'];
        }

        return json_encode($kq);
    }

    public function ajax_laythongtintacvu()
    {
        $request = service("request");
        $maTacVu = $request->getPost("id");
        $result = $this->TacVuModel->getTacVuTruyCapById($maTacVu);
        return json_encode($result);
    }

    public function capnhattacvu()
    {
        $request = service("request");
        $maTacVu = $request->getPost("id");
        $tenTacVu = $request->getPost("tenTacVu");
        $urlTacVu = $this->loc_duong_dan($request->getPost("urlTacVu"));
        $tenold = $this->TacVuModel->getTenTacVuTruyCapById($maTacVu);
        $checkTen = 0;
        if ($tenold == $tenTacVu) {
            $checkTen = 0;
        } else {
            $checkTen = $this->TacVuModel->countTacVuTruyCapByTen($tenTacVu);
        }
        if ($checkTen <= 0) {
            $resultSave = $this->TacVuModel->updateTacVuTruyCap($maTacVu, $tenTacVu, $urlTacVu);
            if ($resultSave) {
                $kq = ['status' => 'success', 'message' => 'cập nhật thành công'];
            } else {
                $kq = ['status' => 'error', 'message' => 'cập nhật tác vụ không thành công'];
            }
        } else {
            $kq = ['status' => 'error', 'message' => 'Tên loại tác vụ đã tồn tại'];
        }
        return json_encode($kq);
    }



    // nhomChucNang_dsNhomCN


    public function them_chuc_nang_vao_nhom()
    {
        $maNhom = $this->request->getPost('maNhom');
        $maChucNang = $this->request->getPost('maChucNang');
        $resultSave = $this->TacVuModel->luu_chuc_nang_vao_nhom($maNhom, $maChucNang);
        if ($resultSave) {
            $kq = ['status' => 'success', 'message' => 'cập nhật thành công'];
        } else {
            $kq = ['status' => 'error', 'message' => 'cập nhật không thành công'];
        }
        return json_encode($kq);
    }

    public function xoa_chuc_nang_khoi_nhom()
    {
        $maNhom = $this->request->getPost('maNhom');
        $maChucNang = $this->request->getPost('maChucNang');
        $resultSave = $this->TacVuModel->xoa_chuc_nang_khoi_nhomCN($maNhom, $maChucNang);
        if ($resultSave) {
            $kq = ['status' => 'success', 'message' => 'xóa nhật thành công'];
        } else {
            $kq = ['status' => 'error', 'message' => 'xóa nhật không thành công'];
        }
        return json_encode($kq);
    }


    public function them_quyen_cho_nhom($id)
    {
        $result = $this->TacVuModel->lay_ds_chucNang_maNhom($id);
        $thongTinNhom = $this->TacVuModel->layThongTinNhomQuyen($id);
        $danhS_chuc_nang = $this->TacVuModel->getallChucNang();
        $data['ds_chuc_nang'] = $result;
        $data['id'] = $id;
        $data['thongTinNhom'] = $thongTinNhom;
        $data['danhS_chuc_nang'] = $danhS_chuc_nang;

        return $this->template_admin(view("admin/nhomquyen/them_quyen_cho_nhom", $data));
    }

    public function nhomChucNang_dsNhomCN()
    {
        $data['ds_tacvu'] = $this->TacVuModel->getAllNhomChucNang();
        return $this->template_admin(view("admin/nhomquyen/ds_nhomQuyen", $data));
    }

    public function them_moi_nhom_quyen()
    {
        $ten_NhomQ = $this->request->getPost("ten_NhomQ");
        $mo_TaQ = $this->request->getPost("mo_TaQ");
        $resultSave = $this->TacVuModel->them_moi_nhomQuyen($ten_NhomQ, $mo_TaQ);
        if ($resultSave) {
            $kq = ['status' => 'success', 'message' => 'cập nhật thành công'];
        } else {
            $kq = ['status' => 'error', 'message' => 'cập nhật không thành công'];
        }
        return json_encode($kq);
    }


    public function capNhat_nhom_quyen()
    {
        $maNhom = $this->request->getPost('ma_Nhom');
        $tenNhom = $this->request->getPost('ten_NhomQ');
        $moTa =  $this->request->getPost('mo_TaQ');
        $resultSave = $this->TacVuModel->capNhat_nhomQuyen($maNhom, $tenNhom, $moTa);
        if ($resultSave) {
            $kq = ['status' => 'success', 'message' => 'cập nhật thành công'];
        } else {
            $kq = ['status' => 'error', 'message' => 'cập nhật không thành công'];
        }
        return json_encode($kq);
    }

    public function xoa_nhom_quyen()
    {
        $request = service("request");
        $maQuyen = $request->getPost("id");
        $checkDungTV = $this->TacVuModel->dem_dung_nhom_quyen($maQuyen);
        if ($checkDungTV <= 0) {
            $resultXoa = $this->TacVuModel->delete_nhom_quyen($maQuyen);
            if ($resultXoa) {
                $kq = ['status' => 'success', 'message' => 'xóa thành công'];
            } else {
                $kq = ['status' => 'error', 'message' => 'xóa không thành công'];
            }
        } else {
            $kq = ['status' => 'error', 'message' => 'Nhóm này đang đang còn được sử dụng không thể xóa'];
        }

        return json_encode($kq);
    }
}
