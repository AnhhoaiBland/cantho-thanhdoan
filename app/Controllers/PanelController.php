<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PanelModel;

class PanelController extends BaseController
{
    protected $PanelModel;

    public function __construct()
    {
        $this->PanelModel = new PanelModel;
    }
    public function index()
    {
        //
        $data['ds_panel'] = $this->PanelModel->lay_ds_panel();
        $data['checkQuyen'] = $this->check_nhom_quyen('nhomQ6649c168c38c30.28904485');
        return $this->template_admin(view('admin/panel_chinh/ds_panel', $data));
    }


    public function add_panel()
    {
        $session = session();
        $tenNguoiDung = $session->get('username');
        $url_img = $this->request->getFile('url-img');
        $viTri = $this->request->getVar('viTri');
        $link = $this->request->getVar('link');

        if ($url_img->isValid() && !$url_img->hasMoved()) {
            // Tạo tên mới cho file ảnh
            $newName = $url_img->getRandomName();
            $url_img->move(ROOTPATH . 'public/upload/media/images', $newName);


            $result =  $this->PanelModel->them_moi_panel($tenNguoiDung, $newName, $link, $viTri);
            if ($result) {
                return redirect()->to('/admin/panel');
            } else {
                return redirect()->to('/admin/panel')->with("err", "Lỗi khi tạo panel");
            }
        } else {
            // Xử lý khi có lỗi với việc tải lên ảnh
            return "Lỗi khi tải lên ảnh";
        }
    }
    public function xoa_panel()
    {
        // $session = session();
        // $tenNguoiDung = $session->get('username');
        $request = service('request');
        $id_panel = $request->getGet('id');
        $result = $this->PanelModel->xoa($id_panel);
        if ($result) {
            $message = ['status' => 'success', 'content' => "Panel đã được xóa"];
            return json_encode($message);
        } else {
            $message = ['status' => 'error', 'content' => 'Xóa thất bại', 'error'];
            return json_encode($message);
        }
    }

    public function ajax_sua_panel()
    {
        $request = service('request');

        // $logger = service('logger');

        $id_panel = $request->getPost('id');
        $result = $this->PanelModel->lay_thong_tin_panel($id_panel);
        // $logger->info(json_encode($result));
        return json_encode($result);
    }

    public function sua_panel()
    {
        $logger = service('logger');
        $session = session();
        $tenNguoiDungCapNhat = $session->get('username');
        $maSlide = $this->request->getPost('id');
        $url_img = $this->request->getFile('url');
        $viTri = $this->request->getPost('viTri');
        $link = $this->request->getPost('link');
        $ngayCapNhat = date("Y-m-d H:i:s");

        // Lấy ảnh cũ từ cơ sở dữ liệu
        $image_old = $this->PanelModel->lay_anh_panel($maSlide);

        if ($url_img->isValid() && !$url_img->hasMoved()) {
            // Nếu có ảnh cũ, xóa ảnh cũ trước khi cập nhật ảnh mới
            if ($image_old) {
                unlink(ROOTPATH . 'public/upload/media/images/' . $image_old);
            }
            // Tạo tên mới cho file ảnh
            $newName = $url_img->getRandomName();
            $url_img->move(ROOTPATH . 'public/upload/media/images', $newName);

            $result =  $this->PanelModel->cap_nhat_panel($newName, $link, $viTri, $tenNguoiDungCapNhat, $maSlide,$ngayCapNhat);
            if ($result) {
                $message = ['status' => 'success', 'content' => "Cập nhật thành công"];
            } else {
                $message = ['status' => 'error', 'content' => 'Cập nhật thất bại, vui lòng kiểm tra lại', 'error'];
            }
        } else {
            // Kiểm tra nếu không có ảnh được tải lên
            if (!$url_img->isValid()) {
                // Thực hiện cập nhật với ảnh là 

                $result =  $this->PanelModel->cap_nhat_panel(null, $link, $viTri, $tenNguoiDungCapNhat, $maSlide,$ngayCapNhat);
                if ($result) {
                    $message = ['status' => 'success', 'content' => "Cập nhật thành công"];
                } else {
                    $message = ['status' => 'error', 'content' => 'Cập nhật thất bại, vui lòng kiểm tra lại', 'error'];
                }
            } else {
                $message = ['status' => 'error', 'content' => 'Lỗi khi tải lên ảnh'];
            }
        }

        return json_encode($message);
    }
}
