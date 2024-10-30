<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ThuGopYModel;

class ThuGopYController extends BaseController
{
    protected $ThuGopYModel;
    public function __construct()
    {
        $this->ThuGopYModel = new ThuGopYModel();
    }
    public function index()
    {
        //
        $dtJson =  $this->docthongtinweb();
        $data_template['showThuGopY'] = !empty($dtJson['showThuGopY']) ? $dtJson['showThuGopY'] : false;
        $ds_thu_gop_y =  $this->ThuGopYModel->lay_thu_da_phan_hoi();
        $data_template['ds_thu_gop_y'] = $ds_thu_gop_y;

        return $this->template(view("Page_ThuGopY", $data_template));
    }
    public function hopthu()
    {
        $result = $this->ThuGopYModel->getAllThuGopY();
        $data['ds_thu'] = $result;
        $data['checkQuyen'] = $this->check_nhom_quyen('nhomQ6649c3d3c29497.92935630');
        return $this->template_admin(view("admin/thugopy/ds_thugopy", $data));
    }
    public function ajax_layDanhSach()
    {
        $result = $this->ThuGopYModel->getAllThuGopYTrangThai('1');
        return json_encode($result);
    }

    public function add_gopy()
    {
        $request = service("request");
        $maThuGopY = uniqid("thu_", true);
        $hoten = $request->getPost("hoten");
        $dienThoai = $request->getPost("dienThoai");
        $emailgy = $request->getPost("emailgy");
        $tieuDe = $request->getPost("tieuDe");
        $noiDung = $request->getPost("noiDung");

        $resultSave = $this->ThuGopYModel->createThuGopY($maThuGopY, $hoten, $emailgy, $dienThoai, $tieuDe, $noiDung);
        if ($resultSave) {
            return redirect()->to("/")->with("success", "Đã ghi nhận thành công phản hồi, nhân viên sẽ phản hồi lại sớm nhất");
        } else {
            return redirect()->to("/")->with("error", "Gởi thư góp ý không thành công, hãy thử lại sao");
        }
    }

    public function del_thuGopy($id)
    {
        try {
            $maThuGopY = $id;
            $session = session();
            $username = $session->get('username');
            $manguoiduyet = $this->UserModel->lay_ma_user_qua_tenDN($username);
            $trangThai = '0';
            $result = $this->ThuGopYModel->cap_nhat_trang_thai($maThuGopY, $trangThai, $manguoiduyet);
            if ($result) {
                $kq = ['status' => 'success', 'message' => 'Xóa thành công'];
            } else {
                $kq = ['status' => 'error', 'message' => 'Xóa không thành công'];
            }
        } catch (\Exception $e) {
            $kq = ['status' => 'error', 'message' => 'Xóa không thành công'];
        }

        return json_encode($kq);
    }
    public function view_thugopy($id)
    {
        $result = $this->ThuGopYModel->getThuGopYID($id);
        $data['thu_gopY'] = $result;
        return $this->template_admin(view("admin/thugopy/trl_thu_gopY", $data));
    }

    public function ajax_duyet_show_thu()
    {
        try {
            $request = service('request');
            $maThuGopY = $request->getPost('id');
            $session = session();
            $username = $session->get('username');
            $manguoiduyet = $this->UserModel->lay_ma_user_qua_tenDN($username);
            $trangThai = '2';
            $result = $this->ThuGopYModel->cap_nhat_trang_thai($maThuGopY, $trangThai, $manguoiduyet);
            if ($result) {
                $kq = ['status' => 'success', 'message' => 'Duyệt thành công'];
            } else {
                $kq = ['status' => 'error', 'message' => 'Duyệt không thành công'];
            }
        } catch (\Exception $e) {
            $kq = ['status' => 'error', 'message' => 'Duyệt không thành công'];
        }

        return json_encode($kq);
    }

    public function ajax_Huy_duyet_thu_vien()
    {
        try {
            $request = service('request');
            $maThuGopY = $request->getPost('id');
            $session = session();
            $username = $session->get('username');
            $manguoiduyet = $this->UserModel->lay_ma_user_qua_tenDN($username);
            $trangThai = '3';
            $result = $this->ThuGopYModel->cap_nhat_trang_thai($maThuGopY, $trangThai, $manguoiduyet);

            if ($result) {
                $kq = ['status' => 'success', 'message' => 'Hủy duyệt thành công'];
            } else {
                $kq = ['status' => 'error', 'message' => 'Hủy duyệt không thành công'];
            }
        } catch (\Exception $e) {
            $kq = ['status' => 'error', 'message' => 'Hủy duyệt không thành công'];
        }

        return json_encode($kq);
    }


    public function add_phan_hoi_thugopy()
    {
        $request = service("request");
        $maThuGopY = $request->getPost('id');
        $hoten = $request->getPost('hoten');
        $sodt = $request->getPost('sodienthoai');
        $email = $request->getPost('email');
        $tieuDe = $request->getPost('tieuDe');
        $noidung = $request->getPost('noidung');
        $hinhThuc_tl = $request->getPost('hinhThuc_tl');
        $noidung_tl = $request->getPost('noidung_tl');

        $session = session();
        $username = $session->get('username');
        $maNguoiDung = $this->UserModel->lay_ma_user_qua_tenDN($username);

        $checkUpdate = $this->ThuGopYModel->updateThuGopY($maThuGopY, $hoten, $email, $sodt, $tieuDe, $noidung, "3", $noidung_tl, $maNguoiDung, $hinhThuc_tl);
        if ($checkUpdate) {
            return redirect()->to(base_url("admin/view_thugopy/$maThuGopY"));
        } else {
            return redirect()->to(base_url("admin/view_thugopy/$maThuGopY"))->with("errr", "không thể cập nhật");
        }
    }
}
