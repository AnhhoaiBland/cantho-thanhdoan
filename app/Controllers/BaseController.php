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
        $data_template = $this->initializeTemplateData($page);

        $this->demTruyCap();

        $data_template["luoc_truy_cap"] = $this->getTruyCapData();
        $data_template = array_merge($data_template, $this->getWebsiteInfo());

        $data_template['ds_thu_gop_y'] = $this->ThuGopYModel->lay_thu_da_phan_hoi();

        if (isset($page)) {
            return view($template_style == 'v2' ? "templates/Layout_v2" : "templates/Layout", $data_template);
        } else {
            return view("Page_404");
        }
    }

    private function initializeTemplateData($page)
    {
        $categoryTree = $this->getCategoryTree();
        $dataPanel = $this->PanelModel->lay_ds_panel_canh_ben();

        $data_template['page'] = $page;
        $data_template['ds_category'] = $categoryTree;
        $data_template['dataPanel'] = $dataPanel;
        $data_template['breadcrumb'] = $this->generateBreadcrumbs();

        return $data_template;
    }

    private function generateBreadcrumbs()
    {
        $request = service('request');
        $uriSegments = $request->getUri()->getSegments();
        $breadcrumbs = [];

        if (count($uriSegments) == 1) {
            $breadcrumbs = $this->getSingleSegmentBreadcrumbs($uriSegments[0]);
        } else {
            $breadcrumbs = $this->getMultiSegmentBreadcrumbs($uriSegments);
        }

        return $breadcrumbs;
    }

    private function getSingleSegmentBreadcrumbs($segment)
    {
        $breadcrumbs = [
            ['title' => "Trang chủ", 'url' => '/']
        ];

        switch ($segment) {
            case "tailieu_vanban":
                $breadcrumbs[] = ['title' => "Tài liệu - Văn bản", 'url' => '/tailieu_vanban'];
                break;
            case "gop-y":
                $breadcrumbs[] = ['title' => "Góp ý", 'url' => '/gop-y'];
                break;
            case "thu-vien-anh":
                $breadcrumbs[] = ['title' => "Thư viện ảnh", 'url' => '/thu-vien-anh'];
                break;
            case "thu-vien-video":
                $breadcrumbs[] = ['title' => "Thư viện video", 'url' => '/thu-vien-video'];
                break;
            case "sitemap":
                $breadcrumbs[] = ['title' => "Sơ đồ trang", 'url' => '/sitemap'];
                break;
        }

        return $breadcrumbs;
    }

    private function getMultiSegmentBreadcrumbs($uriSegments)
    {
        $breadcrumbs = [];
        $url = '';

        foreach ($uriSegments as $segment) {
            $title = $this->ChuyenMucModels->lay_ten_chuyen_muc_url($segment);
            $url .= '/' . $segment;
            $breadcrumbs[] = ['title' => $title, 'url' => $url];
        }

        $breadcrumbs[0] = ['title' => 'Trang chủ', 'url' => base_url()];

        foreach ($breadcrumbs as &$breadcrumb) {
            if ($breadcrumb['title'] == 'cate') {
                $breadcrumb['title'] = 'Bài viết';
            }
        }

        return $breadcrumbs;
    }

    private function getTruyCapData()
    {
        return [
            "sl_tc_ngay" => $this->UserModel->lay_sl_truy_cap_ngay_now(),
            "sl_tc_thang" => $this->UserModel->lay_sl_truy_cap_thang_now(),
            "sl_tc_nam" => $this->UserModel->lay_sl_truy_cap_nam_now(),
            "sl_tc_tong" => $this->UserModel->lay_sl_truy_cap_tong()
        ];
    }

    private function getWebsiteInfo()
    {
        $dtJson = $this->docthongtinweb();

        return [
            'Chu_chay' => $dtJson['pageHeading'] ?? '',
            'logo' => $dtJson['logo'] ?? '',
            'slogan' => $dtJson['slogan'] ?? '',
            'address' => $dtJson['address'] ?? '',
            'phoneNumber' => $dtJson['phoneNumber'] ?? '',
            'email' => $dtJson['email'] ?? '',
            'faxNumber' => $dtJson['faxNumber'] ?? '',
            'facebook' => $dtJson['facebook'] ?? '',
            'map' => $dtJson['map'] ?? '',
            'responsiblePerson' => $dtJson['responsiblePerson'] ?? '',
            'banLienKet' => !empty($dtJson['tableData']) ? $this->convertJsonToArray($dtJson['tableData']) : [],
            'showTVAnh' => $dtJson['showTVAnh'] ?? false,
            'showTVVideo' => $dtJson['showTVVideo'] ?? false,
            'showThuGopY' => $dtJson['showThuGopY'] ?? false
        ];
    }

    public function check_nhom_quyen($maNhom)
    {
        $session = session();
        $username = $session->get('username');
        $maNguoiDung = $this->UserModel->lay_ma_user_qua_tenDN($username);
        return $this->UserModel->check_nguoi_dung_co_nhom_quyen($maNguoiDung, $maNhom);
    }

    public function docthongtinweb()
    {
        helper('filesystem');
        $filePath = WRITEPATH . 'data/form_data.json';
        $jsonData = file_get_contents($filePath);

        return $jsonData !== false ? json_decode($jsonData, true) : null;
    }

    public function template_admin($page, $data = null)
    {
        $session = session();
        if ($session->has('username')) {
            $username = $session->get('username');
            $infoUser = $this->UserModel->layDuLieuCaNhan($username);
            $maNguoiDung = $this->UserModel->lay_ma_user_qua_tenDN($username);
            $danhSachChucNang = $this->UserModel->lay_danh_sach_quyen_maNguoiDung($maNguoiDung);

            $data_template['danhSachChucNang'] = $danhSachChucNang;
            $data_template['page'] = $page;
            $data_template['data'] = $data ?? $infoUser;

            $dtJson = $this->docthongtinweb();
            $data_template['logo'] = $dtJson['logo'] ?? '';

            return view("admin_template/layout", $data_template);
        } else {
            return view("Page_Login");
        }
    }

    function convertJsonToArray($jsonString)
    {
        if (empty($jsonString)) {
            return null;
        }

        $jsonString = str_replace(["\r", "\n", "\t"], '', $jsonString);
        $jsonString = trim($jsonString, '[]');
        $keyValuePairs = explode(',', $jsonString);

        $resultArray = [];
        foreach ($keyValuePairs as $pair) {
            list($key, $value) = explode(':', $pair, 2);
            $resultArray[trim($key, '"')] = trim($value, '"');
        }

        return $resultArray;
    }

    public function check_co_trong_chuoi($doiTuongCheck, $chuoiCheck)
    {
        return strpos($chuoiCheck, $doiTuongCheck) !== false;
    }

    public function show_menu_chuyen_muc()
    {
        return $this->getCategoryTree();
    }

    public function getCategoryTree()
    {
        $result = $this->ChuyenMucModels->getList_chuyen_muc_cha();
        $categories = [];

        if (!empty($result)) {
            foreach ($result as $row) {
                $categories[] = [
                    'maChuyenMuc' => $row['maChuyenMuc'],
                    'tenChuyenMuc' => $row['tenChuyenMuc'],
                    'urlChuenMuc' => $row['urlChuenMuc'],
                    'subcategories' => $this->getSubcategories($row['maChuyenMuc'])
                ];
            }
        }

        return $categories;
    }

    public function getSubcategories($parentCategory)
    {
        $result = $this->ChuyenMucModels->getList_chuyen_muc_con($parentCategory);
        $subcategories = [];

        if (!empty($result)) {
            foreach ($result as $row) {
                $subcategories[] = [
                    'maChuyenMuc' => $row['maChuyenMuc'],
                    'tenChuyenMuc' => $row['tenChuyenMuc'],
                    'urlChuenMuc' => $row['urlChuenMuc'],
                    'maChuyenMucCha' => $row['maChuyenMucCha'],
                    'subcategories' => $this->getSubcategories($row['maChuyenMuc'])
                ];
            }
        }

        return $subcategories;
    }

    public function show_file_anh($filename)
    {
        return $this->show_file('images', $filename);
    }

    public function show_file_videos($filename)
    {
        return $this->show_file('videos', $filename);
    }

    public function show_file_document($filename)
    {
        return $this->show_file('document', $filename);
    }

    private function show_file($type, $filename)
    {
        $filePath = ROOTPATH . "public/upload/media/{$type}/" . $filename;

        if (is_file($filePath)) {
            return $this->response->download($filePath, null)->setFileName($filename);
        } else {
            return $this->response->setStatusCode(404)->setBody('File not found');
        }
    }

    public function khongdau($str = null)
    {
        $str = preg_replace("/ /", '-', $str);
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
        return $parsed_url['path'] ?? '/';
    }
}