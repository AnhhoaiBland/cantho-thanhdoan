<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DaPhuongTienModel;
use App\Models\UserModel;

class DaPhuongTienController extends BaseController
{
    protected $DaPhuongTienModel, $UserModel;
    public function __construct()
    {
        $this->DaPhuongTienModel = new DaPhuongTienModel();
        $this->UserModel = new UserModel();
    }
    public function index()
    {
        $result = $this->DaPhuongTienModel->LayAll();
        $data['ds_BoSuTap'] = $result;

        $data['checkQuyen'] = $this->check_nhom_quyen('nhomQ6649bf67619be7.31282121');
        $data['chi_dang_bai'] = $this->check_nhom_quyen('nhomQ6649cb5d360f68.84121542');
        return $this->template_admin(view("admin/daphuongtien/ds_danhMucDaPhuongTien", $data));
    }

    public function add_DaPhuongTien()
    {
        $session = session();
        $username = $session->get('username');
        $maNguoiDung = $this->UserModel->lay_ma_user_qua_tenDN($username);
        $request = service('request');
        $tenBoSuuTap = $request->getPost('tenBoSuuTap');
        $loai = $request->getPost('loai');
        $moTa = $request->getPost('moTa');
        $resultSave = $this->DaPhuongTienModel->Luu($tenBoSuuTap, $loai, $maNguoiDung, $moTa);
        if ($resultSave) {
            return redirect()->to('/admin/daphuongtien')->with('success', '');
        } else {
            return redirect()->to('/admin/daphuongtien')->with('errr', '');
        }
    }

    public function view_chiTietDaPT($id)
    {
        $result = $this->DaPhuongTienModel->LayChiTiet($id);
        $data['ds_chiTiet'] = $result;
        //  echo print_r($result); exit('');
        return $this->template_admin(view('admin/daphuongtien/view_chiTietDaPT', $data));
    }

    public function add_Item_DaPhuongTien()
    {

        $request = service('request');
        $id_boSuTap = $request->getPost('id');
        $imagesList = $request->getFiles('images[]');
        $loai = $this->DaPhuongTienModel->LayLoaiBST($id_boSuTap);
        // echo print_r($loai);
        // exit('');

        foreach ($imagesList['images'] as $image) {
            $imageNameNew = $image->getRandomName();
            $image->move(ROOTPATH . 'public/upload/media/' . ($loai == 'im' ? 'images' : 'videos'), $imageNameNew);
            $result = $this->DaPhuongTienModel->luuChiTiet(uniqid('chiTST_', false), $id_boSuTap, $imageNameNew);
        }

        return redirect()->to('/admin/view_chiTietDaPT/' . $id_boSuTap)->with('success', '');
    }

    public function ajax_xoaAnhChiTiet()
    {
        $request = service('request');
        $maChiTiet = $request->getPost('id');
        $image_name = $this->DaPhuongTienModel->layAnhChiTetByMaChiTiet($maChiTiet);
        $loaiBoSuuTap =  $request->getPost('loaiBoSuuTap');


        if ($loaiBoSuuTap == 'im') {
            if (!empty($image_name) && file_exists(ROOTPATH . 'public/upload/media/images/' . $image_name)) {
                unlink(ROOTPATH . 'public/upload/media/images/' . $image_name);
            }
        } else {
            if (!empty($image_name) && file_exists(ROOTPATH . 'public/upload/media/videos/' . $image_name)) {
                unlink(ROOTPATH . 'public/upload/media/videos/' . $image_name);
            }
        }

        $result = $this->DaPhuongTienModel->xoaChiTiet($maChiTiet);
        if ($result) {
            $kq = ['status' => 'success', 'message' => 'Xóa thành công'];
        } else {
            $kq = ['status' => 'error', 'message' => 'Xóa không thành công'];
        }

        return json_encode($kq);
    }

    public function ajax_xoaAllAnhChiTiet()
    {
        try {
            $request = service('request');
            $maBoSuuTap = $request->getPost('id');
            $ds_chiTiet = $this->DaPhuongTienModel->layDSChiTiet($maBoSuuTap);
            $loaiBoSuuTap =  $request->getPost('loaiBoSuuTap');

            foreach ($ds_chiTiet as $chiTiet) {

                if ($loaiBoSuuTap == 'im') {
                    if (!empty($chiTiet['urlFile']) && file_exists(ROOTPATH . 'public/upload/media/images/' . $chiTiet['urlFile'])) {
                        unlink(ROOTPATH . 'public/upload/media/images/' . $chiTiet['urlFile']);
                    }
                } else {
                    if (!empty($chiTiet['urlFile']) && file_exists(ROOTPATH . 'public/upload/media/videos/' . $chiTiet['urlFile'])) {
                        unlink(ROOTPATH . 'public/upload/media/videos/' . $chiTiet['urlFile']);
                    }
                }

                $result = $this->DaPhuongTienModel->xoaChiTiet($chiTiet['maChiTiet']);
            }
            $kq = ['status' => 'success', 'message' => 'Xóa thành công'];
        } catch (\Exception $e) {
            $kq = ['status' => 'error', 'message' => 'Xóa không thành công'];
        }

        return json_encode($kq);
    }

    public function ajax_duyetBST()
    {
        try {
            $request = service('request');
            $maBoSuuTap = $request->getPost('id');
            $session = session();
            $username = $session->get('username');
            $result = $this->DaPhuongTienModel->capNhatTrangThai($maBoSuuTap, '2', $username);
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

    public function ajax_Huy_duyetBST()
    {
        try {
            $request = service('request');
            $maBoSuuTap = $request->getPost('id');

            $session = session();
            $username = $session->get('username');
            $result = $this->DaPhuongTienModel->capNhatTrangThai($maBoSuuTap, '1', $username);

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

    public function ajax_layinfoBST()
    {
        try {
            $request = service('request');
            $maBoSuuTap = $request->getPost('id');

            $result = $this->DaPhuongTienModel->LayBST($maBoSuuTap);

            if (!empty($result)) {
                $kq = ['status' => 'success', 'message' => 'Hủy duyệt thành công', 'contents' => $result];
            } else {
                $kq = ['status' => 'error', 'message' => 'Hủy duyệt không thành công'];
            }
        } catch (\Exception $e) {
            $kq = ['status' => 'error', 'message' => 'Hủy duyệt không thành công'];
        }

        return json_encode($kq);
    }

    public function edit_DaPhuongTien()
    {
        $request = service('request');
        $maBoSuuTap = $request->getPost('maBST');
        // echo $maBoSuuTap; exit('');
        $tenBoSuuTap = $request->getPost('tenBoSuuTap');
        $loai = $request->getPost('loai');
        $moTa = $request->getPost('moTa');

        $resultSave = $this->DaPhuongTienModel->capNhat($maBoSuuTap, $tenBoSuuTap, $loai, $moTa);
        if ($resultSave) {
            return redirect()->to('/admin/daphuongtien')->with('success', '');
        } else {
            return redirect()->to('/admin/daphuongtien')->with('errr', '');
        }
    }


    public function thu_vien_anh()
    {
        $full_url = base_url($this->request->getUri()->getPath());

        // $result = $this->DaPhuongTienModel->LayAll();
        // $data['ds_BoSuTap'] = $result;

        //TÌM TỔNG SỐ dòng RECORDS
        $total_records = $this->DaPhuongTienModel->tongBoSuTap('im');

        // TÌM LIMIT VÀ số page hiện tại "current_page"
        $soPage = $this->request->getVar('page');
        $current_page = isset($soPage) ? $soPage : 1;
        $limit = 9;

        //TÍNH TOÁN TOTAL_PAGE VÀ START
        // tổng số trang
        $total_page = ceil($total_records / $limit);

        // Giới hạn current_page trong khoảng 1 đến total_page
        if ($current_page > $total_page) {
            $current_page = $total_page;
        } else if ($current_page < 1) {
            $current_page = 1;
        }

        // Tìm Start
        $start = ($current_page - 1) * $limit;


        $resultListBST = $this->DaPhuongTienModel->lay_ds_boST_loai_phanTrang('im', $start, $limit);
        $data['ds_BoSuTap'] =  $resultListBST;
        $data['current_page'] = $current_page;
        $data['total_page'] = $total_page;
        $data['full_url'] = $full_url;

        // echo print_r( $resultListBST); exit('');
        return $this->template(view('Page_thuVien', $data));
    }

    public function view_thu_vien_anh($id)
    {
        $result = $this->DaPhuongTienModel->ds_item_BST($id);
        $res_BST = $this->DaPhuongTienModel->LayBST($id);

        $data['item_bst'] = $result;
        $data['infor_bst'] = $res_BST;
        return $this->template(view('block/Show_image_list', $data));
    }

    public function view_thu_vien_video($id)
    {
        $result = $this->DaPhuongTienModel->ds_item_BST($id);
        $res_BST = $this->DaPhuongTienModel->LayBST($id);
    
        $data['item_bst'] = $result;
        $data['infor_bst'] = $res_BST;
        // echo print_r($res_BST); exit('');
        return $this->template(view('block/Show_image_list', $data));
    }

    public function thu_vien_video()
    {
        $full_url = base_url($this->request->getUri()->getPath());

        // $result = $this->DaPhuongTienModel->LayAll();
        // $data['ds_BoSuTap'] = $result;

        //TÌM TỔNG SỐ dòng RECORDS
        $total_records = $this->DaPhuongTienModel->tongBoSuTap('vi');

        // TÌM LIMIT VÀ số page hiện tại "current_page"
        $soPage = $this->request->getVar('page');
        $current_page = isset($soPage) ? $soPage : 1;
        $limit = 9;

        //TÍNH TOÁN TOTAL_PAGE VÀ START
        // tổng số trang
        $total_page = ceil($total_records / $limit);

        // Giới hạn current_page trong khoảng 1 đến total_page
        if ($current_page > $total_page) {
            $current_page = $total_page;
        } else if ($current_page < 1) {
            $current_page = 1;
        }

        // Tìm Start
        $start = ($current_page - 1) * $limit;


        $resultListBST = $this->DaPhuongTienModel->lay_ds_boST_loai_phanTrang('vi', $start, $limit);
        $data['ds_BoSuTap'] =  $resultListBST;
        $data['current_page'] = $current_page;
        $data['total_page'] = $total_page;
        $data['full_url'] = $full_url;

        // echo print_r( $resultListBST); exit('');
        return $this->template(view('Page_thuVien', $data));
    }
}
