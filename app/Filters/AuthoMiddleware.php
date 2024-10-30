<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class AuthoMiddleware implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    protected $UserModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
    }
    public function before(RequestInterface $request, $arguments = null)
    {
        //
        $session = session(); 
        $logger = service('logger');
        if (!$session->has('username')) {
            return redirect()->to("/admin")->with("errrAutho", "Cần đăng nhập để truy cập tác vụ này");
        } else {
            $username = $session->get('username');
            $checkTrangThai =  $this->UserModel->layTrangThaiVoiTenDN($username);
            if ($checkTrangThai == '-1' || $checkTrangThai == '0') {
                return redirect()->to("/err/page_403");
            } else {
                $logger->info($username);
                $urlTV = $request->getUri()->getPath();
                $logger->info($urlTV);
                $maNguoiDung = $this->UserModel->lay_ma_user_qua_tenDN($username);
                $checkQuyen = $this->UserModel->checkQuyenTruyCapNDQuaTenDN($maNguoiDung, $urlTV);
                $logger->info($checkQuyen);
                if ($checkQuyen <= 0) {
                    return redirect()->to("/err/page_403");
                }
            }
        }
    }


    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
