<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use function PHPSTORM_META\type;

class ThongTinWebController extends BaseController
{
    public function __construct()
    {
    }


    public function index()
    {
        $dtJson =  $this->docthongtinweb();
        // $data['thong_tin_web'] = $dtJson;
        // Kiểm tra và gán dữ liệu vào mảng $data
        $data['Chu_chay'] = !empty($dtJson['pageHeading']) ? $dtJson['pageHeading'] : '';
        $data['logo'] = !empty($dtJson['logo']) ? $dtJson['logo'] : '';
        $data['slogan'] = !empty($dtJson['slogan']) ? $dtJson['slogan'] : '';
        $data['address'] = !empty($dtJson['address']) ? $dtJson['address'] : '';
        $data['phoneNumber'] = !empty($dtJson['phoneNumber']) ? $dtJson['phoneNumber'] : '';
        $data['email'] = !empty($dtJson['email']) ? $dtJson['email'] : '';
        $data['faxNumber'] = !empty($dtJson['faxNumber']) ? $dtJson['faxNumber'] : '';
        $data['facebook'] = !empty($dtJson['facebook']) ? $dtJson['facebook'] : '';
        $data['map'] = !empty($dtJson['map']) ? $dtJson['map'] : '';
        $data['responsiblePerson'] = !empty($dtJson['responsiblePerson']) ? $dtJson['responsiblePerson'] : '';
        $data['banLienKet'] = !empty($dtJson['tableData']) ? $this->convertJsonToArray($dtJson['tableData']) : [];

        $data['showTVAnh'] =   !empty($dtJson['showTVAnh']) ? $dtJson['showTVAnh'] : false;
        $data['showTVVideo'] = !empty($dtJson['showTVVideo']) ? $dtJson['showTVVideo'] : false;
        $data['showThuGopY'] = !empty($dtJson['showThuGopY']) ? $dtJson['showThuGopY'] : false;
        //echo print_r($data); exit('');
        $data['checkQuyen'] = $this->check_nhom_quyen('nhomQ6649c4b2badea3.52812977');
        return $this->template_admin(view("admin/cauhinhthongtinweb/thongtinweb", $data));
    }

    public function luuthongtinweb()
    {
        helper('filesystem');
        $dtJson = $this->docthongtinweb();
        $logoFile = $this->request->getFile('logo_img');
        if ($logoFile && $logoFile->isValid()) {
            $logoFileOld = isset($dtJson['logo']) ? $dtJson['logo'] : null;
            if (!empty($logoFileOld) && file_exists(ROOTPATH . 'public/upload/media/images/' . $logoFileOld)) {
                unlink(ROOTPATH . 'public/upload/media/images/' . $logoFileOld);
            }
            $newLogoName = $logoFile->getRandomName();
            $logoFile->move(ROOTPATH . 'public/upload/media/images', $newLogoName);

            $formData['logo'] = $newLogoName;
        } else {
            $formData['logo'] = $dtJson['logo'];
        }

        $formData['pageHeading'] = $this->request->getPost('pageHeading');
        $formData['slogan'] = $this->request->getPost('slogan');
        $formData['address'] = $this->request->getPost('address');
        $formData['phoneNumber'] = $this->request->getPost('phoneNumber');
        $formData['email'] = $this->request->getPost('email');
        $formData['faxNumber'] = $this->request->getPost('faxNumber');
        $formData['facebook'] = $this->request->getPost('facebook');
        $formData['map'] = $this->request->getPost('map');
        $formData['responsiblePerson'] = $this->request->getPost('responsiblePerson');
        $formData['tableData'] = $this->request->getPost('tableData');

        $showTV  = $this->request->getPost('showTVAnh');
        $showVI = $this->request->getPost('showTVVideo');
        $showGY  = $this->request->getPost('showThuGopY');
        $formData['showTVAnh'] = isset($showTV)?true: false;
        $formData['showTVVideo'] = isset($showVI)?true: false;
        $formData['showThuGopY'] = isset($showGY)?true: false;

        // Encode form data to JSON
        $jsonData = json_encode($formData);

        // Write JSON data to file
        $filePath = WRITEPATH . 'data/form_data.json';
        if (write_file($filePath, $jsonData)) {
            return redirect()->to('/admin/thongtinweb');
        } else {
            return redirect()->to('/admin/thongtinweb')->with('error', 'Failed to write data!');
        }
    }
}
