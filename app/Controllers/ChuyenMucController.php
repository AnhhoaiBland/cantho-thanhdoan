<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ChuyenMucModels;

class ChuyenMucController extends BaseController
{

    protected $ChuyenMucModels;

    public function __construct()
    {
        $this->ChuyenMucModels = new ChuyenMucModels();
    }

    public function index()
    {

        
        $data['ds_category'] = $this->ChuyenMucModels->getList();

        $data['checkQuyen'] = $this->check_nhom_quyen('nhomQ6649bd04085a49.73929492');
        return $this->template_admin(view('admin/category/ds_category', $data));
    }
    public function add_category()
    {

        $request = service('request');
        $tenCM = $request->getPost('ten');
        $maCMCha = $request->getPost('category_cha');
        $maAlias = $request->getPost('alias');
        $isDuplicateUrl = $this->ChuyenMucModels->kiem_tra_da_ton_tai_url($maAlias);
        if ($isDuplicateUrl == false) {
            return redirect()->to('admin/ds_category')->with('error', 'Lỗi khi tạo mới danh mục, đường dẫn đã tồn tại.');
        } else {
            if ($maCMCha !== "non") {
                $result =  $this->ChuyenMucModels->save_cate($tenCM, $maCMCha, $maAlias);
            } else {

                $result =  $this->ChuyenMucModels->save_cate($tenCM, null, $maAlias);
            }
            if ($result) {
                return redirect()->to('admin/ds_category');
            } else {
                return 'không thành công';
            }
        }
    }


    public function ajax_sua_category()
    {

        // Lấy dữ liệu đầu vào từ request
        $request = service('request');
        // $logger = service('logger');

        $id_ct = $request->getPost('id');
        $category = $this->ChuyenMucModels->getCategoryById($id_ct);

        if ($category) {

            // Nếu dữ liệu tồn tại, trả về dưới dạng JSON
            return json_encode($category);
        } else {
            // Nếu không tìm thấy dữ liệu, trả về một thông báo lỗi
            return json_encode(['error' => 'Category not found']);
        }
    }

    public function sua_category()
    {
        $logger = service('logger');
        $request = service('request');
        $id_ct = $request->getPost('id');
        $tenCM = $request->getPost('ten');
        $maCMCha = $request->getPost('category_cha');
        $maAlias = $request->getPost('alias');
        $logger->info('This is an info message.');
        if ($maCMCha == '') $maCMCha = NULL;
        $date = date('Y-m-d H:i:s');
        $resulr =  $this->ChuyenMucModels->update_cate($id_ct, $maCMCha, $tenCM, $date, $maAlias);
        if ($resulr == true) {
            $message = ['status' => 'success', 'content' => "Thêm thành công"];
        } else {
            $message = ['status' => 'error', 'content' => 'thêm thất bại', 'error'];
        }
        return json_encode($message);
    }

    public function xoa_category()
    {
        $request = service('request');


        $id_ct = $request->getGet('id');

        // Get the number of articles in the category
        $value_sl_baiviet_cm = $this->ChuyenMucModels->lay_sl_bai_biet_cate($id_ct);
        $sl = 0;
        foreach ($value_sl_baiviet_cm as $value) {
            $sl = $value['soLuong'];
        }

        // Get the number of child categories
        $value_sl_cm_cha = $this->ChuyenMucModels->lay_sl_chuyen_muc_con($id_ct);
        $sl_cmc = 0;
        foreach ($value_sl_cm_cha as $value_cha) {
            $sl_cmc = $value_cha['soLuong'];
        }

        // Check if the category is being used
        if ($sl > 0 || $sl_cmc > 0) {
            return json_encode(['status' => 'error', 'message' => 'Chuyên mục đang được sử dụng và không thể xóa']);
        } else {
            // Attempt to delete the category
            $result = $this->ChuyenMucModels->xoa_chuyen_muc($id_ct);
            if ($result) {
                return json_encode(['status' => 'success', 'message' => 'Xóa chuyên mục thành công']);
            } else {
                return json_encode(['status' => 'error', 'message' => 'Có lỗi khi xóa chuyên mục']);
            }
        }
    }
}
