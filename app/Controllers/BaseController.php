<?php

namespace App\Controllers;

use App\Models\PanelModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\UserModel;
use App\Models\ChuyenMucModels;
use App\Models\ThuGopYModel;
/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    protected $UserModel, $ChuyenMucModels, $PanelModel, $ThuGopYModel;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->UserModel = new UserModel();
        $this->ChuyenMucModels = new ChuyenMucModels();
        $this->PanelModel = new PanelModel();
        $this->ThuGopYModel = new ThuGopYModel();
        // E.g.: $this->session = \Config\Services::session();
    }

    // public function template($page, $data = null)
    // {

    //     $categoryTree = $this->getCategoryTree();
    //     // echo print_r($categoryTree);
    //     // exit('');

    //     $dataPanel = $this->PanelModel->lay_ds_panel_canh_ben();
    //     $dataCT = $this->ChuyenMucModels->getList_chuyen_muc_cha();

    //     $data_template['page'] = $page;
    //     $data_template['ds_category'] = $categoryTree;
    //     $data_template['dataPanel'] = $dataPanel;

    //     if (isset($page)) {
    //         return view("templates/Layout", $data_template);
    //     } else {
    //         return view("Page_404");
    //     }
    // }

    public function demTruyCap()
    {
        $session = session();

        if (!$session->has('truy_cap_da_dem')) {
            $dt = date('Y-m-d');
            $this->UserModel->dem_truy_cao($dt);
            $session->set('truy_cap_da_dem', true);
            $session->set('last_visit_time', time());
        } else {
            $last_visit_time = $session->get('last_visit_time');
            $current_time = time();

            if ($current_time - $last_visit_time > 1800) {
                $dt = date('Y-m-d');
                $this->UserModel->dem_truy_cao($dt);
                $session->set('last_visit_time', $current_time);
            }
        }
    }

    public function template($page, $data = null, $template_style = 'v1')
    {
        // Lấy dữ liệu cần thiết
        $categoryTree = $this->getCategoryTree();
        $dataPanel = $this->PanelModel->lay_ds_panel_canh_ben();


        // Khởi tạo dữ liệu template
        $data_template['page'] = $page;
        $data_template['ds_category'] = $categoryTree;
        $data_template['dataPanel'] = $dataPanel;


        // Lấy URL hiện tại
        $request = service('request');
        $url = $request->getUri()->getPath();
        $uriSegments = $request->getUri()->getSegments();

        $breadcrumbs = [];
        if (count($uriSegments) == 1 and $uriSegments[0] == "tailieu_vanban") {
            $breadcrumbs[] = [
                'title' =>  "Trang chủ",
                'url' => '/',
            ];
            $breadcrumbs[] = [
                'title' =>  "Tài liệu - Văn bản",
                'url' => '/tailieu_vanban',
            ];
        } elseif (count($uriSegments) == 1 and $uriSegments[0] == "gop-y") {
            $breadcrumbs[] = [
                'title' =>  "Trang chủ",
                'url' => '/',
            ];
            $breadcrumbs[] = [
                'title' =>  "Góp ý",
                'url' => '/gop-y',
            ];
        } elseif (count($uriSegments) == 1 and $uriSegments[0] == "thu-vien-anh") {
            $breadcrumbs[] = [
                'title' =>  "Trang chủ",
                'url' => '/',
            ];
            $breadcrumbs[] = [
                'title' =>  "Thư viện ảnh",
                'url' => '/thu-vien-anh',
            ];
        } elseif (count($uriSegments) == 1 and $uriSegments[0] == "thu-vien-video") {
            $breadcrumbs[] = [
                'title' =>  "Thư viện video",
                'url' => '/',
            ];
            $breadcrumbs[] = [
                'title' =>  "Thư viện video",
                'url' => '/thu-vien-video',
            ];
        } elseif (count($uriSegments) == 1 and $uriSegments[0] == "sitemap") {
            $breadcrumbs[] = [
                'title' =>  "Trang chủ",
                'url' => '/',
            ];
            $breadcrumbs[] = [
                'title' =>  "Sơ đồ trang",
                'url' => '/sitemap',
            ];
        } else {

            $breadcrumbs = [];
            $url = '';
            foreach ($uriSegments as $segment) {

                $title = $this->ChuyenMucModels->lay_ten_chuyen_muc_url($segment);
                $url .= '/' .  $segment;
                $breadcrumbs[] = [
                    'title' =>  $title,
                    'url' => $url,
                ];
            }
            $breadcrumbs[0] = [
                'title' =>  'Trang chủ',
                'url' => base_url(),
            ];
            $dem = count($breadcrumbs);
            for ($i = 0; $i < $dem; $i++) {
                if ($breadcrumbs[$i]['title'] == 'cate') $breadcrumbs[$i]['title'] = 'Bài viết';
            }
        }

        $data_template['breadcrumb'] = $breadcrumbs;
        // echo print_r( $breadcrumbs); exit('');

        $this->demTruyCap();

        // lấy truy cập ngày
        $ls_TruyCapNgay = $this->UserModel->lay_sl_truy_cap_ngay_now();
        $ls_TruyCapThang = $this->UserModel->lay_sl_truy_cap_thang_now();
        $ls_TruyCapNam = $this->UserModel->lay_sl_truy_cap_nam_now();
        $ls_TruyCapToanBo = $this->UserModel->lay_sl_truy_cap_tong();

        $demThoiGian = ["sl_tc_ngay" => $ls_TruyCapNgay, "sl_tc_thang" => $ls_TruyCapThang, "sl_tc_nam" => $ls_TruyCapNam,  "sl_tc_tong" => $ls_TruyCapToanBo];

        $data_template["luoc_truy_cap"] = $demThoiGian;



        $dtJson =  $this->docthongtinweb();
        // $data['thong_tin_web'] = $dtJson;
        // Kiểm tra và gán dữ liệu vào mảng $data
        $data_template['Chu_chay'] = !empty($dtJson['pageHeading']) ? $dtJson['pageHeading'] : '';
        $data_template['logo'] = !empty($dtJson['logo']) ? $dtJson['logo'] : '';
        $data_template['slogan'] = !empty($dtJson['slogan']) ? $dtJson['slogan'] : '';
        $data_template['address'] = !empty($dtJson['address']) ? $dtJson['address'] : '';
        $data_template['phoneNumber'] = !empty($dtJson['phoneNumber']) ? $dtJson['phoneNumber'] : '';
        $data_template['email'] = !empty($dtJson['email']) ? $dtJson['email'] : '';
        $data_template['faxNumber'] = !empty($dtJson['faxNumber']) ? $dtJson['faxNumber'] : '';
        $data_template['facebook'] = !empty($dtJson['facebook']) ? $dtJson['facebook'] : '';
        $data_template['map'] = !empty($dtJson['map']) ? $dtJson['map'] : '';
        $data_template['responsiblePerson'] = !empty($dtJson['responsiblePerson']) ? $dtJson['responsiblePerson'] : '';
        $data_template['banLienKet'] = !empty($dtJson['tableData']) ? $this->convertJsonToArray($dtJson['tableData']) : [];

        $data_template['showTVAnh'] =   !empty($dtJson['showTVAnh']) ? $dtJson['showTVAnh'] : false;
        $data_template['showTVVideo'] = !empty($dtJson['showTVVideo']) ? $dtJson['showTVVideo'] : false;
        $data_template['showThuGopY'] = !empty($dtJson['showThuGopY']) ? $dtJson['showThuGopY'] : false;

        $ds_thu_gop_y =  $this->ThuGopYModel->lay_thu_da_phan_hoi();
        $data_template['ds_thu_gop_y'] = $ds_thu_gop_y;
       // echo print_r($ds_thu_gop_y); exit('');
        if (isset($page)) {
            if($template_style == 'v2'){
                return view("templates/Layout_v2", $data_template);
            }else{
                 return view("templates/Layout", $data_template);
            }
            
        } else {
            return view("Page_404");
        }
    }

    public function check_nhom_quyen($maNhom){
        $session = session(); 
        $username = $session->get('username');
        $maNguoiDung = $this->UserModel->lay_ma_user_qua_tenDN($username);
        $checkQuyen = $this->UserModel->check_nguoi_dung_co_nhom_quyen($maNguoiDung, $maNhom);
        return $checkQuyen;
    }


    public function docthongtinweb()
    {
        helper('filesystem');
        $filePath = WRITEPATH . 'data/form_data.json';
        $jsonData = file_get_contents($filePath);


        if ($jsonData !== false) {

            $formData = json_decode($jsonData, true);
            return $formData;
        } else {

            return null;
        }
    }

    public function template_admin($page, $data = null)
    {

        $session = session();
        if ($session->has('username')) {

            $username = $session->get('username');
            $infoUser =  $this->UserModel->layDuLieuCaNhan($username);
            $maNguoiDung = $this->UserModel->lay_ma_user_qua_tenDN($username);
            $danhSachChucNang = $this->UserModel->lay_danh_sach_quyen_maNguoiDung($maNguoiDung);
            // echo print_r($danhSachChucNang); exit();

            $data_template['danhSachChucNang'] = $danhSachChucNang;
            $data_template['page'] = $page;
            if (!isset($data)) {

                $data_template['data'] = $infoUser;
            } else {
                $data_template['data'] = $data;
            }

            // echo var_dump($data); exit();
            $dtJson =  $this->docthongtinweb();
            // $data['thong_tin_web'] = $dtJson;
            $data_template['logo'] = !empty($dtJson['logo']) ? $dtJson['logo'] : '';


            return view("admin_template/layout", $data_template);
        } else {
            return view("Page_Login");
        }
    }
    // public function template(){

    //     return view("templates/Layout");
    // }

    function convertJsonToArray($jsonString)
    {
        // Kiểm tra nếu chuỗi JSON rỗng
        if (empty($jsonString)) {
            return null;
        }

        // Loại bỏ khoảng trắng và ký tự xuống dòng
        $jsonString = str_replace(["\r", "\n", "\t"], '', $jsonString);

        // Loại bỏ dấu ngoặc vuông ở đầu và cuối chuỗi
        $jsonString = trim($jsonString, '[]');

        // Tách chuỗi thành các cặp khóa-giá trị bằng dấu phẩy làm dấu phân cách
        $keyValuePairs = explode(',', $jsonString);

        // Khởi tạo mảng kết quả
        $resultArray = [];

        // Duyệt qua từng cặp khóa-giá trị và đưa chúng vào mảng kết quả
        foreach ($keyValuePairs as $pair) {
            // Tách khóa và giá trị từ cặp khóa-giá trị
            list($key, $value) = explode(':', $pair, 2); // Sử dụng limit 2 để không phân tách dấu : bên trong giá trị

            // Loại bỏ dấu ngoặc kép ở đầu và cuối khóa và giá trị
            $key = trim($key, '"');
            $value = trim($value, '"');

            // Đưa khóa và giá trị vào mảng kết quả
            $resultArray[$key] = $value;
        }

        // Trả về mảng kết quả
        return $resultArray;
    }




    public function check_co_trong_chuoi($doiTuongCheck, $chuoiCheck)
    {
        if (strpos($chuoiCheck, $doiTuongCheck) !== false) {
            return true;
        } else {
            return false;
        }
    }

    public function show_menu_chuyen_muc()
    {
        $categoryTree = $this->getCategoryTree();
        return  $categoryTree;
    }
    public function getCategoryTree()
    {
        $result = $this->ChuyenMucModels->getList_chuyen_muc_cha();
        $categories = array();

        if (!empty($result)) { // Sử dụng empty() để kiểm tra xem mảng $result có rỗng hay không
            foreach ($result as $row) { // Duyệt mảng $result thay vì sử dụng fetch_assoc()
                $category = array(
                    'maChuyenMuc' => $row['maChuyenMuc'],
                    'tenChuyenMuc' => $row['tenChuyenMuc'],
                    'urlChuenMuc' => $row['urlChuenMuc'],
                    'subcategories' => $this->getSubcategories($row['maChuyenMuc']) // Fetch subcategories recursively
                );
                array_push($categories, $category);
            }
        }

        return $categories;
    }

    public function getSubcategories($parentCategory)
    {
        $subcategories = array();
        $result = $this->ChuyenMucModels->getList_chuyen_muc_con($parentCategory);
        if (!empty($result)) { // Sử dụng empty() để kiểm tra xem mảng $result có rỗng hay không
            foreach ($result as $row) { // Duyệt mảng $result thay vì sử dụng fetch_assoc()
                $subcategory = array(
                    'maChuyenMuc' => $row['maChuyenMuc'],
                    'tenChuyenMuc' => $row['tenChuyenMuc'],
                    'urlChuenMuc' => $row['urlChuenMuc'],
                    'maChuyenMucCha' => $row['maChuyenMucCha'], // Add parent category ID
                    'subcategories' => $this->getSubcategories($row['maChuyenMuc']) // Recursive call to fetch subcategories
                );
                array_push($subcategories, $subcategory);
            }
        }

        return $subcategories;
    }


    public function show_file_anh($filename)
    {

        $imagePath = ROOTPATH . 'public/upload/media/images/' . $filename;

        // Kiểm tra xem tệp tin tồn tại
        if (is_file($imagePath)) {
            // Trả về phản hồi file để hiển thị ảnh cho người dùng
            return $this->response->download($imagePath, null)->setFileName($filename);
        } else {
            // Trả về một phản hồi lỗi nếu tệp tin không tồn tại
            return $this->response->setStatusCode(404)->setBody('File not found');
        }
    }

    public function show_file_videos($filename)
    {

        $imagePath = ROOTPATH . 'public/upload/media/videos/' . $filename;

        // Kiểm tra xem tệp tin tồn tại
        if (is_file($imagePath)) {
            // Trả về phản hồi file để hiển thị ảnh cho người dùng
            return $this->response->download($imagePath, null)->setFileName($filename);
        } else {
            // Trả về một phản hồi lỗi nếu tệp tin không tồn tại
            return $this->response->setStatusCode(404)->setBody('File not found');
        }
    }


    public function show_file_document($filename)
    {

        $imagePath = ROOTPATH . 'public/upload/document/' . $filename;

        // Kiểm tra xem tệp tin tồn tại
        if (is_file($imagePath)) {
            // Trả về phản hồi file để hiển thị ảnh cho người dùng
            return $this->response->download($imagePath, null)->setFileName($filename);
        } else {
            // Trả về một phản hồi lỗi nếu tệp tin không tồn tại
            return $this->response->setStatusCode(404)->setBody('File not found');
        }
    }


    public function khongdau($str = null)
    {
        $str = preg_replace("/ /", '-', $str);
        // $str = preg_replace("/-/", '_', $str);
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        return $str;
    }
    function loc_duong_dan($url)
    {
        if (empty($url)) {
            return "";
        }
        $parsed_url = parse_url($url);
        if (isset($parsed_url['path'])) {
            return $parsed_url['path'];
        } else {
            return '/';
        }
    }
}
