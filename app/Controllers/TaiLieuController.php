<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TaiLieuModel;
use App\Models\UserModel;

class TaiLieuController extends BaseController
{
    protected $TaiLieuModel, $UserModel;
    public function __construct()
    {
        $this->TaiLieuModel = new TaiLieuModel();
        $this->UserModel = new UserModel();
    }

    public function tailieu_vanban()
    {
        $result = $this->TaiLieuModel->layDanhSachDanhMuc();
        $data['ds_loaiTL'] = $result;
        return $this->template(view("Page_vanBan_taiLieu", $data ));
    }

    public function index()
    {

        $result = $this->TaiLieuModel->layDanhSachTaiLieu();

        $data['ds_vanban'] = $result;
        $data['ds_loai'] = [];
        $data['ds_cap'] = [];
        $data['checkQuyen'] = $this->check_nhom_quyen('nhomQ6649c25768d651.32732656');
        return $this->template_admin(view("admin/tailieu/ds_tailieu", $data));
    }

    public function timTaiLieu()
    {
        $request = service('request');
        $logger = service('logger');
        $tim_van_ban = $request->getPost('tim_van_ban');
        $maDanhMucTaiLieu = $request->getPost('maDanhMucTaiLieu');
        $thoiGianBanHanh = $request->getPost('thoiGianBanHanh');


        $result = $this->TaiLieuModel->tim_tailieu($tim_van_ban, $maDanhMucTaiLieu, $thoiGianBanHanh);
        $kq = ['status' => 'success', 'message' => 'Lưu thành công', 'datalist' => $result];
        return json_encode($kq);

    }

    public function addloaitailieu()
    {
        $request = service('request');
        $maDanhMucTaiLieu = uniqid("loaitl_", true);
        $loaiTaiLieu = $request->getPost('loaiTaiLieu');
        $checkTen = $this->TaiLieuModel->check_ten_danh_muc_tai_lieu($loaiTaiLieu);

        if ($checkTen <= 0) {
            $checkSave = $this->TaiLieuModel->luu_danh_muc_tai_lieu($maDanhMucTaiLieu, $loaiTaiLieu);

            if ($checkSave) {
                $kq = ['status' => 'success', 'message' => 'Lưu thành công'];
            } else {
                $kq = ['status' => 'error', 'message' => 'Lưu không thành công'];
            }
        } else {
            $kq = ['status' => 'error', 'message' => 'Tên loại văn bản đã tồn tại'];
        }

        return json_encode($kq);
    }


    public function editloaitailieu()
    {
        $request = service('request');
        $maDanhMucTaiLieu = $request->getPost('maDanhMucTaiLieuUpdate');
        $loaiTaiLieu = $request->getPost('loaiTaiLieuUpdate');

        $checkTen = $this->TaiLieuModel->check_ten_danh_muc_tai_lieu($loaiTaiLieu);
        if ($checkTen <= 0) {
            $checkSave = $this->TaiLieuModel->sua_danh_muc_tai_lieu($maDanhMucTaiLieu, $loaiTaiLieu);
            if ($checkSave) {
                $kq = ['status' => 'success', 'message' => 'Cập nhật thành công'];
            } else {
                $kq = ['status' => 'error', 'message' => 'Cập nhật không thành công'];
            }
        } else {
            $kq = ['status' => 'error', 'message' => 'Tên loại văn bản đã tồn tại'];
        }

        return json_encode($kq);
    }

    public function xoaloaitailieu()
    {
        $request = service('request');
        //$session = session();

        $maDanhMucTaiLieu = $request->getPost('id');

        $checkLucSDLoaiTaiLieu = $this->TaiLieuModel->kiem_tra_luc_dung_danh_muc_tai_lieu($maDanhMucTaiLieu);

        if ($checkLucSDLoaiTaiLieu <= 0) {
            // được xóa
            $checkDelete = $this->TaiLieuModel->xoa_danh_muc_tai_lieu($maDanhMucTaiLieu);
            if ($checkDelete) {
                $kq = ['status' => 'success', 'message' => 'xóa thành công'];
            } else {
                $kq = ['status' => 'error', 'message' => 'xóa không thành công'];
            }
        } else {
            // không được xóa, trả thông báo lỗi danh mục đang được dùng ở tài liệu không thẻ xóa
            $kq = ['status' => 'error', 'message' => 'danh mục đang được dùng ở tài liệu không thẻ xóa'];
        }

        return $this->response->setJSON($kq);
    }

    public function ajax_laydsloaitl()
    {
        $result = $this->TaiLieuModel->layDanhSachDanhMuc();
        return json_encode($result);
    }

    public function ajax_laythongtintailieucapnhat()
    {

        $id = $this->request->getPost('id');
        $resultLoaiTaiLieu = $this->TaiLieuModel->layDanhSachDanhMuc();
        $result = $this->TaiLieuModel->lay_tai_lieu_id($id);
        return  json_encode(['status' => 'success', 'content' => $result, 'loaitailieu' => $resultLoaiTaiLieu]);
    }

    public function themmoitailieu()
    {
        $request = service('request');
        $session = session();

        $tenNguoiDung = $session->get('username');
        $maNguoiDung = $this->UserModel->lay_ma_user_qua_tenDN($tenNguoiDung);
        $tenTaiLieu = $request->getPost('tenTaiLieu');
        $soHieuTL = $request->getPost('soHieuTL');
        $maDanhMucTaiLieu = $request->getPost('maDanhMucTaiLieu');
        $moTa = $request->getPost('moTa');
        $thoiGianBanHanh = $request->getPost('thoiGianBanHanh');
        $maTaiLieu = uniqid('taiLieu_', true);
        $duongDanTaiVe = $request->getFile('duongDanTaiVe');

        // Kiểm tra xem tệp đã được tải lên thành công hay chưa
        if ($duongDanTaiVe->isValid() && !$duongDanTaiVe->hasMoved()) {
            $newName = $this->khongdau($duongDanTaiVe->getName());

            // Di chuyển tệp đã tải lên đến thư mục đích
            $duongDanTaiVe->move(ROOTPATH . 'public/upload/document', $newName);

            // Lưu thông tin tài liệu vào cơ sở dữ liệu
            $checkSave = $this->TaiLieuModel->luu_tai_lieu($maTaiLieu, $soHieuTL, $tenTaiLieu, $maDanhMucTaiLieu, $newName, $moTa, $maNguoiDung, $thoiGianBanHanh);

            if ($checkSave) {
                $kq = ['status' => 'success', 'message' => 'Cập nhật thành công'];
            } else {
                $kq = ['status' => 'error', 'message' => 'Cập nhật không thành công'];
            }
        } else {
            // Xử lý lỗi khi tệp không được tải lên thành công
            $kq = ['status' => 'error', 'message' => 'Tải lên tệp không thành công'];
        }

        return json_encode($kq);
    }

    public function capnhattailieu()
    {
        $request = service('request');
        $session = session();

        $tenNguoiDungCapNhat = $session->get('username');
        $ngayCapNhat = date('Y-m-d H:i:s');
        $maTaiLieu = $request->getPost('idtailieu');
        $maNguoiDungCapNhat = $this->UserModel->lay_ma_user_qua_tenDN($tenNguoiDungCapNhat);

        $tenTaiLieu = $request->getPost('tenTaiLieu');
        $soHieuTL = $request->getPost('soHieuTL');
        $maDanhMucTaiLieu = $request->getPost('maDanhMucTaiLieu');
        $moTa = $request->getPost('moTa');
        $thoiGianBanHanh = $request->getPost('thoiGianBanHanh');
        $duongDanTaiVe = $request->getFile('duongDanTaiVe');
        $checkUpdate = false;

        $fileold = $request->getPost('fileold');

        if ($duongDanTaiVe->isValid() && !$duongDanTaiVe->hasMoved()) {
            // Nếu có tệp mới được tải lên, xóa tệp cũ trước
            if (!empty($fileold) && $fileold !== "none") {
                $oldFilePath = ROOTPATH . 'public/upload/document/' . $fileold;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            $newName = $this->khongdau($duongDanTaiVe->getName());
            $duongDanTaiVe->move(ROOTPATH . 'public/upload/document', $newName);
            $tenTaiVe = $newName;
        } else {
            $tenTaiVe = "none";
        }

        $checkUpdate = $this->TaiLieuModel->cap_nhat_tai_lieu($maTaiLieu, $soHieuTL, $tenTaiLieu, $maDanhMucTaiLieu, $maNguoiDungCapNhat, $tenTaiVe, $moTa, $ngayCapNhat, $thoiGianBanHanh);

        if ($checkUpdate) {
            $kq = ['status' => 'success', 'message' => 'Cập nhật thành công'];
        } else {
            $kq = ['status' => 'error', 'message' => 'Cập nhật không thành công'];
        }

        return $this->response->setJSON($kq);
    }

    public function xoatailieu()
    {
        $request = service('request');
        //$session = session();

        $maTaiLieu = $request->getPost('id');

        $taiLieu =  $this->TaiLieuModel->lay_tai_lieu_id($maTaiLieu);

        $filexoa = $taiLieu[0]['duongDanTaiVe'];
        $oldFilePath = ROOTPATH . 'public/upload/document/' . $filexoa;
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath);
        }

        $checkUpdate = $this->TaiLieuModel->xoa_tai_lieu($maTaiLieu);
        if ($checkUpdate) {
            $kq = ['status' => 'success', 'message' => 'xóa thành công'];
        } else {
            $kq = ['status' => 'error', 'message' => 'xóa không thành công'];
        }

        return $this->response->setJSON($kq);
    }
}
