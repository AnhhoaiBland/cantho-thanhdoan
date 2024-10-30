<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BaiDangModel;
use App\Models\ChuyenMucModels;
use App\Models\UserModel;

class BaiDangController extends BaseController
{
    protected $BaiDangModel, $ChuyenMucModels, $UserModel;
    public function __construct()
    {
        $this->BaiDangModel = new BaiDangModel();
        $this->ChuyenMucModels = new ChuyenMucModels();
        $this->UserModel = new UserModel();
    }
    public function index()
    {
        //
        $data['ds_baidang'] = $this->BaiDangModel->layDanhSach();
        $data['checkQuyen'] = $this->check_nhom_quyen('nhomTV_01HXZQCRD5RQVPEMGEWPPJK23W');
        $data['chi_dang_bai'] = $this->check_nhom_quyen('nhomQ6649cb51286bb1.10957502');
        return $this->template_admin(view('admin\baidang\ds_baidang', $data));
    }

    public function add_baidang()
    {

        $data['ds_category'] = $this->ChuyenMucModels->getList();
        return $this->template_admin(view('admin\baidang\add_baidang', $data));
    }

    public function save_baidang()
    {
        $session = session();

        $username = $session->get('username');
        $maNguoiDung = $this->UserModel->lay_ma_user_qua_tenDN($username);
        $mabaidang = uniqid("baiDang_", true);
        $maChuyenMuc = $this->request->getPost('category');
        $tieuDe = $this->request->getPost('tieude');
        $noiDung = $this->request->getPost('noidung');
        $anhTieuDe = $this->request->getFile('AVATAR');
        $urlBaiDang =  $this->request->getPost('urlBaiDang');

        if ($anhTieuDe->isValid() && !$anhTieuDe->hasMoved()) {
            // Tạo tên mới cho file ảnh
            $newName = $anhTieuDe->getRandomName();
            $anhTieuDe->move(ROOTPATH . 'public/upload/media/images', $newName);

            $result_save = $this->BaiDangModel->luu($mabaidang, $maNguoiDung, $maChuyenMuc, $tieuDe, $newName, $noiDung, $urlBaiDang);
            if ($result_save) {
                return redirect()->to('/admin/ds_baidang');
            } else {
                return redirect()->to('/admin/ds_baidang')->with("err", "Lỗi khi lưu bài");
            }
        } else {
            // Xử lý khi có lỗi với việc tải lên ảnh
            return "Lỗi khi tải lên ảnh";
        }
    }

    public function edit_baidang($id)
    {
        $data['baiDangOld'] = $this->BaiDangModel->lay_bai_dang_id($id);
        $data['ds_category'] = $this->ChuyenMucModels->getList();
        return $this->template_admin(view('admin\baidang\edit_baidang', $data));
    }

    public function save_update_baidang($id)
    {
        $session = session();

        $username = $session->get('username');
        $maNguoiDungCapNhat = $this->UserModel->lay_ma_user_qua_tenDN($username);
        $maChuyenMuc = $this->request->getPost('category');
        $tieuDe = $this->request->getPost('tieude');
        $noiDung = $this->request->getPost('noidung');
        $anhTieuDe = $this->request->getFile('AVATAR');
        $urlBaiDang =  $this->request->getPost('urlBaiDang');
        $imageOld =  $this->request->getPost('imgaeBaiVietOld');
        $ngayCapNhat = date("Y-m-d H:i:s");

        // Kiểm tra xem người dùng có tải lên ảnh mới hay không
        if ($anhTieuDe->isValid() && !$anhTieuDe->hasMoved()) {
            // Kiểm tra và xóa ảnh cũ
            if (!empty($imageOld) && file_exists(ROOTPATH . 'public/upload/media/images/' . $imageOld)) {
                unlink(ROOTPATH . 'public/upload/media/images/' . $imageOld);
            }

            // Tạo tên mới cho file ảnh
            $newName = $anhTieuDe->getRandomName();
            $anhTieuDe->move(ROOTPATH . 'public/upload/media/images', $newName);

            $result_save = $this->BaiDangModel->cap_nhat_bai_dang($maChuyenMuc, $maNguoiDungCapNhat, $tieuDe,  $newName, $noiDung,  $ngayCapNhat,  $urlBaiDang,  $id);
        } else {
            // Không có ảnh mới, chỉ cần cập nhật bài đăng không có ảnh
            $result_save = $this->BaiDangModel->cap_nhat_bai_dang($maChuyenMuc, $maNguoiDungCapNhat, $tieuDe,  null, $noiDung,  $ngayCapNhat,  $urlBaiDang,  $id);
        }

        if ($result_save) {
            return redirect()->to('/admin/ds_baidang');
        } else {
            return redirect()->to('/admin/ds_baidang')->with("err", "Lỗi khi cập bài");
        }
    }

    public function del_baidang()
    {
        $logger = service("logger");
        $idBaiDang = $this->request->getPost('id');
        $result_delete = $this->BaiDangModel->xoa($idBaiDang);
        $logger->info($idBaiDang);

        if ($result_delete) {
            $message = ['status' => 'success', 'content' => "bài đăng đã được xóa"];
            return json_encode($message);
        } else {
            $message = ['status' => 'error', 'content' => 'Xóa thất bại', 'error'];
            return json_encode($message);
        }
    }

    public function show_bai_dang_id($id)
    {
        $check = $this->check_co_trong_chuoi("baiDang_", $id);
        if ($check == true) {
            $baiDang =  $this->BaiDangModel->lay_bai_dang_id($id);
            if (isset($baiDang[0]['maBaiDang'])) {
                $dataBaiDang['baiDang'] = $baiDang;
                return $this->template(view('show_baiviet', $dataBaiDang));
            } else {
                return view("page_404");
            }
        } else if ($check == false) {
            $baiDang =  $this->BaiDangModel->lay_bai_dang_url($id);
            if (isset($baiDang[0]['maBaiDang'])) {
                $dataBaiDang['baiDang'] = $baiDang;
                return $this->template(view('show_baiviet', $dataBaiDang));
            } else {
                return view("page_404");
            }
        } else {
            return view("page_404");
        }
    }

    public function show_bai_dang_url($url)
    {
        $dataBaiDang['baiDang'] = $this->BaiDangModel->lay_bai_dang_url($url);
        return $this->template(view('show_baiviet', $dataBaiDang));
    }

    public function show_blog_danh_muc($id)
    {
        $request = service('request');
        $url = $request->getUri()->getPath();
        $url_new = str_replace('/cate/', '', $url);
        $mang_url = explode('/', $url_new);
        $giaTriCuoiCung = end($mang_url);
        //echo print_r($giaTriCuoiCung); exit('');


        $chuyenMuc = $this->ChuyenMucModels->lay_chuyen_muc_byurl_chuyenMuc($giaTriCuoiCung);
        $dataList['chuyenMuc'] = $chuyenMuc;
        $check = $this->check_co_trong_chuoi("cate_", $giaTriCuoiCung);

        if ($check == true) {
            // lấy theo id
            $result = $this->BaiDangModel->lay_ds_bai_dang_by_id_ChuyenMuc($giaTriCuoiCung);

            if (isset($result[0]['maBaiDang'])) {
                $dataList['ds_baiDang'] = $result;

                return $this->template(view('block/show_baiviet_theo_category', $dataList));
            } else {
                $dataList['ds_baiDang'] = [];
                return $this->template(view('block/show_baiviet_theo_category', $dataList));
            }
        } else if ($check == false) {
            $result = $this->BaiDangModel->lay_ds_bai_dang_by_url_ChuyenMuc($giaTriCuoiCung);
            // echo print_r($result); exit();
            if (isset($result[0]['maBaiDang'])) {
                $dataList['ds_baiDang'] = $result;
                return $this->template(view('block/show_baiviet_theo_category', $dataList));
            } else {
                $dataList['ds_baiDang'] = [];
                return $this->template(view('block/show_baiviet_theo_category', $dataList));
            }
        } else {
            // lấy theo url

            return view("page_404");
        }
    }

    public function ajax_duyetBaiDang()
    {
        try {
            $request = service('request');
            $maBaiDang = $request->getPost('id');
            $session = session();
            $username = $session->get('username');
            $maUS = $this->UserModel->lay_ma_user_qua_tenDN($username);
            $result = $this->BaiDangModel->cap_nhat_trang_thai($maBaiDang, '2',  $maUS);
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

    public function ajax_Huy_duyetBaiDang()
    {
        try {
            $request = service('request');
            $maBaiDang = $request->getPost('id');
            $session = session();
            $username = $session->get('username');
            $maUS = $this->UserModel->lay_ma_user_qua_tenDN($username);
            $result = $this->BaiDangModel->cap_nhat_trang_thai($maBaiDang, '1',  $maUS);
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

    public function show_blog_danh_mucPlus($id1)
    {
        $request_url = $this->request->getUri()->getSegments();
        $urlBV = end($request_url);
        $full_url = base_url($this->request->getUri()->getPath());


        //TÌM TỔNG SỐ dòng RECORDS
        $total_records = $this->BaiDangModel->layTongSoDongBaiViet($urlBV);

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


        if ($total_records != '0') {
            //TRUY VẤN LẤY DANH SÁCH TIN TỨC
            // Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
            $result = $this->BaiDangModel->layDanhSachBaiViet_ChuyenMuc_PhanTrang($urlBV, $start, $limit);

            $chuyenMuc = $this->ChuyenMucModels->lay_chuyen_muc_byurl_chuyenMuc($urlBV);
            $dataList['chuyenMuc'] = $chuyenMuc;

            $dataList['ds_baiDang'] = $result;
            $dataList['current_page'] = $current_page;
            $dataList['total_page'] = $total_page;
            $dataList['full_url'] = $full_url;

            return $this->template(view('block/show_baiviet_theo_category', $dataList));
        } else {

            $chuyenMuc = $this->ChuyenMucModels->lay_chuyen_muc_byurl_chuyenMuc($urlBV);
            $dataList['chuyenMuc'] = $chuyenMuc;

            $dataList['ds_baiDang'] = [];
            $dataList['current_page'] = 0;
            $dataList['total_page'] = 0;
            $dataList['full_url'] = $full_url;

            return $this->template(view('block/show_baiviet_theo_category', $dataList));
        }
    }

    public function show_blog_danh_mucPlus_v2($id1)
    {
        $request_url = $this->request->getUri()->getSegments();
        $urlBV = end($request_url);
        $full_url = base_url($this->request->getUri()->getPath());


        //TÌM TỔNG SỐ dòng RECORDS
        $total_records = $this->BaiDangModel->layTongSoDongBaiViet($urlBV);

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


        if ($total_records != '0') {
            //TRUY VẤN LẤY DANH SÁCH TIN TỨC
            // Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
            $result = $this->BaiDangModel->layDanhSachBaiViet_ChuyenMuc_PhanTrang($urlBV, $start, $limit);

            $chuyenMuc = $this->ChuyenMucModels->lay_chuyen_muc_byurl_chuyenMuc($urlBV);
            $dataList['chuyenMuc'] = $chuyenMuc;

            $dataList['ds_baiDang'] = $result;
            $dataList['current_page'] = $current_page;
            $dataList['total_page'] = $total_page;
            $dataList['full_url'] = $full_url;

            return $this->template(view('block/show_baiviet_theo_category_v2', $dataList), null,'v2');
        } else {

            $chuyenMuc = $this->ChuyenMucModels->lay_chuyen_muc_byurl_chuyenMuc($urlBV);
            $dataList['chuyenMuc'] = $chuyenMuc;

            $dataList['ds_baiDang'] = [];
            $dataList['current_page'] = 0;
            $dataList['total_page'] = 0;
            $dataList['full_url'] = $full_url;

            return $this->template(view('block/show_baiviet_theo_category_v2', $dataList),null,'v2');
        }
    }
}
