<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\ChuyenMuc_Models;
use Laminas\Escaper\Exception\ExceptionInterface;


class UserController extends BaseController
{

    protected $UserModel;
    protected $ChuyenMuc_Models;

    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        $session = session();
        $username = $session->get('username');
        $infoUser =  $this->UserModel->layDuLieuCaNhan($username);
        $data['infoUser'] = $infoUser;
        //  echo print_r($data); exit();
        return $this->template_admin(view('admin_template/Page_welcome', $data));
    }

    public function ds_taikhoan()
{
    $dataDS = $this->UserModel->layDanhSachNguoiDung();
    $data['ds_user'] = $dataDS;
    $data['checkQuyen'] = $this->check_nhom_quyen('nhomQ6649b8ac3e6631.02886338');
    
    // Xóa hoặc bình luận dòng dưới đây để không hiển thị mảng dữ liệu trực tiếp
    // echo print_r($data); exit();
    
    return $this->template_admin(view('admin/user/ds_user', $data));
}


public function logout()
{
    $session = session();
    $session->destroy(); // Xóa session
    return redirect()->to('admin'); // Chuyển hướng về trang login
}



    public function login()
    {
        $request = service('request');
        if (!$request->getPost('username') || !$request->getPost('pass')) {
            return redirect()->to('admin')->with('error', 'Hãy nhập đủ thông tin đăng nhập');
        }
        $username = $request->getPost('username');
        $password = $request->getPost('pass');
        $checkLogin =  $this->UserModel->dangNhap($username,  $password);

        if ($checkLogin == "user_name_not_found") {
            return redirect()->to('admin')->with('error', "Không tìn thấy tên đăng nhập")->with('user', $username)->with('pass', $password);;
        } else if ($checkLogin == "pass_incorrect") {
            return redirect()->to('admin')->with('error', 'Sai mật khẩu')->with('user', $username)->with('pass', $password);
        } else {
            $session = session();
            $session->set('username', $username);
            //$session->set('user_id', $username);
            return redirect()->to('admin')->with('error', "Đăng nhập thành công");
        }
        // return view("admin_template/layout");
    }

    public function del_user()
    {
        try {
            $request = service('request');
            $maNguoiDung = $request->getPost('id');
            $trangThai = '0';
            $result = $this->UserModel->capNhatTrangThaiND($maNguoiDung, $trangThai);
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

    public function add_user()
    {
        $request = service('request');
        $encrypter = \Config\Services::encrypter();
        $new_password =  $request->getPost('new_password');
        $maNguoiDung = uniqid('user_', true);
        $matKhau =  bin2hex($encrypter->encrypt($new_password));
        $hoVaTen =  $request->getPost('new_hoten');
        $tenDangNhap =  $request->getPost('new_username');
        $maLoaiND =  $request->getPost('loaitaikhoan');

        $checkTenDN = $this->UserModel->demTen($tenDangNhap);
        if ($checkTenDN <= 0) {
            $checkSave =  $this->UserModel->createNguoiDung($maNguoiDung, $tenDangNhap, $hoVaTen, $matKhau, $maLoaiND);
            if ($checkSave) {
                $message = ['status' => 'success', 'content' => 'Thêm tài khoản thành công'];
            } else {
                $message = ['status' => 'error', 'content' => "Lỗi Thêm tài khoản"];
            }
        } else {
            $message = ['status' => 'error', 'content' => "Tên đăng nhập đã tồn tại"];
        }
        return json_encode($message);
    }



    public function ajax_laythongtincanhan()
    {
        $request = service('request');
    }

    public function ajax_laythongtincapnhat()
    {
        $request = service('request');
        $maNguoiDung = $request->getPost('id');
        $result_dsLoaiND = $this->UserModel->lay_ds_loai_nguoi_dung();
        $result_thongTinCN = $this->UserModel->layDuLieuCaNhanUser($maNguoiDung);
        $kq = ['status' => 'success', 'dsLoaiND' => $result_dsLoaiND, 'thongTinCN' => $result_thongTinCN];
        return json_encode($kq);
    }

    public function edit_user()
    {
        $request = service('request');
        $maNguoiDung = $request->getPost('id_nd');
        $hoVaTen =  $request->getPost('hoTen');
        $tenDangNhap =  $request->getPost('tentk');
        $maLoaiND =  $request->getPost('loaitaikhoan');
        $ngayCapNhat = date('Y-m-d H:i:s');

        $tenDNOld = $this->UserModel->layTenDNTheoMa($maNguoiDung);
        $checkTenDN = $tenDNOld == $tenDangNhap ? 0 : $this->UserModel->demTen($tenDangNhap);

        if ($checkTenDN <= 0) {
            $checkUpdate =  $this->UserModel->updateNguoiDung($maNguoiDung, $tenDangNhap, $ngayCapNhat, $hoVaTen, $maLoaiND);
            if ($checkUpdate) {
                $message = ['status' => 'success', 'content' => 'Cập nhật tài khoản thành công'];
            } else {
                $message = ['status' => 'error', 'content' => 'Lỗi cập nhật tài khoản'];
            }
        } else {
            $message = ['status' => 'error', 'content' => 'Tên đăng nhập đã tồn tại'];
        }
        return json_encode($message);
    }


    public function lock_user()
    {
        $request = service('request');
        $maNguoiDung = $request->getPost('id');
        if (!$maNguoiDung) {
            $message = ['status' => 'error', 'content' => 'ID người dùng không hợp lệ'];
            return json_encode($message);
        }
        $checkupdate = $this->UserModel->capNhatTrangThaiND($maNguoiDung, "-1");
        if ($checkupdate) {
            $message = ['status' => 'success', 'content' => 'Khóa người dùng thành công'];
        } else {
            $message = ['status' => 'error', 'content' => 'Lỗi khi khóa người dùng'];
        }
        return json_encode($message);
    }
    public function unlock_user()
    {
        $request = service('request');
        $maNguoiDung = $request->getPost('id');
        if (!$maNguoiDung) {
            $message = ['status' => 'error', 'content' => 'ID người dùng không hợp lệ'];
            return json_encode($message);
        }
        $checkupdate = $this->UserModel->capNhatTrangThaiND($maNguoiDung, "1");
        if ($checkupdate) {
            $message = ['status' => 'success', 'content' => 'mở khóa người dùng thành công'];
        } else {
            $message = ['status' => 'error', 'content' => 'Lỗi khi mở khóa người dùng'];
        }
        return json_encode($message);
    }

    public function change_pass_user()
    {
        $request = service('request');
        $username = $request->getPost('tenuser');
        $new_password = $request->getPost('new_password');
        $encrypter = \Config\Services::encrypter();;
        $matKhau =  bin2hex($encrypter->encrypt($new_password));
        $errors = [];
        if (strlen($new_password) < 6) {
            $errors[] = 'Mật khẩu cần ít nhất 6 ký tự.';
        }
        if (!preg_match("/[A-Z]/", $new_password)) {
            $errors[] = 'Mật khẩu cần ít nhất một ký tự viết hoa.';
        }
        if (!preg_match("/[a-z]/", $new_password)) {
            $errors[] = 'Mật khẩu cần ít nhất một ký tự thường.';
        }
        if (!preg_match("/[0-9]/", $new_password)) {
            $errors[] = 'Mật khẩu cần ít nhất một chữ số.';
        }
        $message = "";
        // Kiểm tra nếu có lỗi
        if (!empty($errors)) {
            $message = ['status' => 'error', 'content' => implode(' ', $errors)];
            return json_encode($message);
        } else {
            $checkChangePass = $this->UserModel->changePassword($username, $matKhau);
            if ($checkChangePass) {
                $message = ['status' => 'success', 'content' => 'Cập nhật mật khẩu thành công'];
            } else {
                $message = ['status' => 'error', 'content' => "Cập nhật mật khẩu thất bại, vui lòng kiểm tra lại", 'error'];
            }
        }

        return json_encode($message);
    }

    ////
    public function laydanhsachloaind()
    {
        $result_dsLoaiND = $this->UserModel->lay_ds_loai_nguoi_dung();
        $finalArray = [];

        foreach ($result_dsLoaiND as $loaiND) {
            $result_dsTacVuThuocND = $this->UserModel->layTacVuTheoLoaiND($loaiND['maLoaiND']);

            // Chuyển đổi mảng $loaiND thành đối tượng (object)
            $loaiND = (object)$loaiND;

            // Thêm thuộc tính list_tacvu vào đối tượng $loaiND
            $loaiND->list_tacvu = $result_dsTacVuThuocND;

            // Thêm đối tượng $loaiND vào mảng kết quả
            $finalArray[] = $loaiND;
        }



        $data['ds_loaiND'] = $finalArray;
        // echo print_r($this->UserModel->lay_ds_loai_nguoi_dung()); exit('');
        return $this->template_admin(view('admin/user/ds_loai_nguoi_dung', $data));
    }

    public function addloainguoidung()
    {

        $request = service('request');
        $maLoaiND = uniqid("lnd_", true);

        $tenLoaiNguoiDung = $request->getPost('tenLoaiND');

        $moTa = $request->getPost('tenLoaiND');
        $checkTen = $this->UserModel->check_ten_loai_nguoi_dung($tenLoaiNguoiDung);
        if ($checkTen <= 0) {
            $checkLuu = $this->UserModel->them_loai_nguoi_dung($maLoaiND, $tenLoaiNguoiDung, $moTa);
            if ($checkLuu) {
                $kq = ['status' => 'success', 'message' => 'Lưu thành công'];
            } else {
                $kq = ['status' => 'error', 'message' => 'Lưu không thành công'];
            }
        } else {
            $kq = ['status' => 'error', 'message' => 'Tên loại tài khoản này đã tồn tại'];
        }
        return json_encode($kq);
    }

    public function xoaloainguoidung()
    {
        // $logger = service('logger');
        $request = service('request');
        $maLoaiND = $request->getPost('id');
        $checkSD = $this->UserModel->check_codung_loai_nguoi_dung($maLoaiND);
        if ($checkSD <= 0) {
            $checkXoa = $this->UserModel->xoa_loai_nguoi_dung($maLoaiND);
            if ($checkXoa) {
                $kq = ['status' => 'success', 'message' => 'Xóa thành công'];
            } else {
                $kq = ['status' => 'error', 'message' => 'Xóa không thành công'];
            }
        } else {
            $kq = ['status' => 'error', 'message' => 'loại tài khoản đang được sử dụng không thể xóa'];
        }
        return json_encode($kq);
    }

    public function ajax_laythongtinloainguoidung()
    {
        $request = service('request');
        $maLoaiND = $request->getPost('id');
        $result = $this->UserModel->lay_loai_nguoi_dung($maLoaiND);
        $kq = ['status' => 'success', 'dataresult' => $result];
        return json_encode($kq);
    }

    public function ajax_laydsloainguoidung()
    {
        $result = $this->UserModel->lay_ds_loai_nguoi_dung();
        $kq = ['status' => 'success', 'dataresult' => $result];
        return json_encode($kq);
    }
    public function editloainguoidung()
    {
        $request = service('request');
        $maLoaiND =  $request->getPost('maloaindold');
        $tenLoaiNguoiDung = $request->getPost('tenLoaiND');

        $moTa = $request->getPost('mota');

        $tenold = $this->UserModel->lay_ten_loai_nguoi_dung($maLoaiND);
        if ($tenold != $tenLoaiNguoiDung) {
            $checkTen = $this->UserModel->check_ten_loai_nguoi_dung($tenLoaiNguoiDung);
        } else {
            $checkTen = 0;
        }
        if ($checkTen <= 0) {
            $checkLuu = $this->UserModel->cap_nhat_loai_nguoi_dung($maLoaiND, $tenLoaiNguoiDung, $moTa);
            if ($checkLuu) {
                $kq = ['status' => 'success', 'message' => 'Cập nhật thành công'];
            } else {
                $kq = ['status' => 'error', 'message' => 'Cập nhật không thành công'];
            }
        } else {
            $kq = ['status' => 'error', 'message' => 'Tên loại tài khoản này đã tồn tại'];
        }
        return json_encode($kq);
    }

    public function themtacvuchonloaind()
    {
        
        $request = service('request');
        $maLoaiND = $request->getPost('id_loaind');
        $selected_Values = $request->getPost('selected_Values');
        
        
        $this->UserModel->deleteQuyenTruyCap($maLoaiND);
        if (empty($maLoaiND) || empty($selected_Values)) {
            return json_encode(['status' => 'error', 'message' => 'Dữ liệu không hợp lệ']);
        }
        try {
            foreach ($selected_Values as $value) {
                // $maQuyenTC = uniqid('qtc_', true);
                // $this->UserModel->createQuyenTruyCap($maQuyenTC, $maLoaiND, $value);
                $this->UserModel->createQuyenTruyCap($maLoaiND, $value);
            }
            return json_encode(['status' => 'success', 'message' => 'Đã thêm thành công']);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => 'Đã có lỗi xảy ra']);
        }
    }
}
