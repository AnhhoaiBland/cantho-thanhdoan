<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ChuyenMucModels;
use App\Models\MenuModel;

class MenuThanhDoanController extends BaseController
{
    protected $chuyenMucModel;
    protected $db;
    protected $menuItems;
    protected $menuModel;
    public function __construct()
    {
        $this->chuyenMucModel = new ChuyenMucModels();
        $this->menuModel = new MenuModel();
        // Tạo đối tượng database
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        // Lấy tất cả danh sách menu từ bảng `menus`
        $menus = $this->db->table('menus')
            ->select('id, title, parent_id, enabled, created_at, updated_at, group')
            ->get()
            ->getResultArray();

        // Tổ chức dữ liệu theo cấu trúc cha-con và nhóm (group)
        $structuredMenus = [
            1 => [], // Menu ngang
            2 => [], // Menu dọc
            3 => [], // Menu footer
        ];

        // Đưa tất cả menu vào mảng theo group và parent_id
        foreach ($menus as $menu) {
            if (!isset($structuredMenus[$menu['group']])) {
                continue; // Nếu không phải nhóm 1, 2, 3 thì bỏ qua
            }

            // Nếu chưa có parent_id trong mảng, tạo mới mảng
            if (!isset($structuredMenus[$menu['group']][$menu['parent_id']])) {
                $structuredMenus[$menu['group']][$menu['parent_id']] = [];
            }

            // Thêm menu vào đúng mảng theo group và parent_id
            $structuredMenus[$menu['group']][$menu['parent_id']][] = $menu;
        }

        // Truyền dữ liệu qua view
        return $this->template_admin(view("admin/menuthanhdoan/index", [
            'structuredMenus' => $structuredMenus
        ]));
    }

    public function createMenu()
    {
        $chuyenMucModel = new \App\Models\ChuyenMucModels();

        $laymenucha = $chuyenMucModel->lay_menu_cha();
        // Truyền dữ liệu qua view
        return $this->template_admin(view("/admin/menuthanhdoan/add", ['laymenucha' => $laymenucha]));
    }
    public function addMenu()
    {
        // Lấy dữ liệu từ form
        $title = $this->request->getPost('title');
        $url = $this->request->getPost('url');
        $parent_id = $this->request->getPost('parent_id');
        $enabled = $this->request->getPost('enabled');
        $menu_group = $this->request->getPost('menu_group'); // Group của menu sẽ được lấy từ menu cha nếu có

        // Kiểm tra và validate dữ liệu
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required|max_length[255]',
            'url' => 'required|max_length[255]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Nếu validate không thành công, trả về thông báo lỗi
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Nếu có parent_id, lấy group của menu cha
        if ($parent_id) {
            $parentMenu = $this->db->table('menus')->select('group')->where('id', $parent_id)->get()->getRow();
            if ($parentMenu) {
                $menu_group = $parentMenu->group; // Gán group của menu con bằng group của menu cha
            }

            // Nếu parent_id khác 0, order sẽ để trống
            $order = null; // Đặt order là null nếu parent_id khác 0
        } else {
            // Nếu không có parent_id (menu cha), lấy số thứ tự lớn nhất của các menu cha
            $maxOrder = $this->db->table('menus')
                ->where('parent_id', 0)  // Chỉ lấy menu cha
                ->selectMax('order')  // Lấy số thứ tự lớn nhất
                ->get()
                ->getRow();

            $order = ($maxOrder && $maxOrder->order) ? $maxOrder->order + 1 : 1; // Nếu có menu cha, tăng số thứ tự, nếu không thì bắt đầu từ 1
        }

        // Lưu menu vào cơ sở dữ liệu
        $this->db->table('menus')->insert([
            'title' => $title,
            'url' => $url,
            'parent_id' => $parent_id,
            'enabled' => $enabled ? 1 : 0, // Giả sử enabled là kiểu boolean
            'order' => $order, // order có thể là null nếu parent_id khác 0
            'group' => $menu_group,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Chuyển hướng lại hoặc thông báo thành công
        return redirect()->to('/admin/menuthanhdoan');
    }

    public function editMenu($id)
    {
        // hiển thị thông tin chỉnh sửa ra form
        $menuItem = $this->menuModel->find($id); // Lấy menu cần sửa
        $menucon = $this->menuModel->getList_menu_con($id); // Lấy các menu con
        $parentMenus = $this->menuModel->lay_menu_cha(); // Lấy menu cha

        return $this->template_admin(view('admin/menuthanhdoan/edit', [
            'menuItem'   => $menuItem,
            'parentMenus' => $parentMenus,
            'menucon' => $menucon,
        ]));
    }


    public function updateMenu($id)
    {
        // Bắt đầu Transaction để đảm bảo tính nhất quán của dữ liệu
        $this->db->transBegin();

        try {
            // Lấy dữ liệu hiện tại của Menu Cha
            $menu = $this->menuModel->find($id);
            if (!$menu) {
                throw new \Exception('Menu không tồn tại.');
            }

            // Lấy dữ liệu từ form cho Menu Cha
            $title      = $this->request->getPost('title') ?: $menu['title'];
            $url        = $this->request->getPost('url') ?: $menu['url'];
            $order      = $this->request->getPost('order') ?: $menu['order'];
            $menu_group = $this->request->getPost('menu_group') !== null ? $this->request->getPost('menu_group') : $menu['menu_group'];

            // Kiểm tra tính hợp lệ của dữ liệu Menu Cha
            if (!$title || !$url || (!$menu_group && $menu_group !== '0')) {
                throw new \Exception('Vui lòng điền đầy đủ thông tin cho Menu Cha.');
            }

            // Chuẩn bị dữ liệu để cập nhật Menu Cha
            $parentData = [
                'title'      => $title,
                'url'        => $url,
                'order'      => (int) $order,
                'menu_group' => (int) $menu_group,
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            // Cập nhật Menu Cha
            $updatedParent = $this->menuModel->update($id, $parentData);
            if (!$updatedParent) {
                throw new \Exception('Cập nhật Menu Cha thất bại.');
            }

            // Xử lý cập nhật Menu Con nếu có
            $child_ids    = $this->request->getPost('child_ids'); // ID của các Menu Con
            $child_titles = $this->request->getPost('child_titles'); // Tiêu Đề của Menu Con
            $child_urls   = $this->request->getPost('child_urls'); // URL của Menu Con

            // Kiểm tra và cập nhật từng Menu Con
            if ($child_ids && is_array($child_ids)) {
                foreach ($child_ids as $index => $child_id) {
                    // Lấy dữ liệu Menu Con tương ứng
                    $child_title = isset($child_titles[$index]) ? trim($child_titles[$index]) : '';
                    $child_url   = isset($child_urls[$index]) ? trim($child_urls[$index]) : '';

                    // Kiểm tra tính hợp lệ của Menu Con
                    if ($child_title && $child_url) {
                        // Chuẩn bị dữ liệu để cập nhật Menu Con
                        $childData = [
                            'title'      => $child_title,
                            'url'        => $child_url,
                            'updated_at' => date('Y-m-d H:i:s'),
                        ];

                        // Cập nhật Menu Con
                        $updatedChild = $this->menuModel->update($child_id, $childData);
                        if (!$updatedChild) {
                            throw new \Exception("Cập nhật Menu Con (ID: {$child_id}) thất bại.");
                        }
                    } else {
                        throw new \Exception("Thông tin Menu Con tại vị trí thứ " . ($index + 1) . " không hợp lệ.");
                    }
                }
            }

            // Nếu tất cả đều thành công, commit transaction
            if ($this->db->transStatus() === FALSE) {
                throw new \Exception('Có lỗi xảy ra trong quá trình cập nhật.');
            }

            $this->db->transCommit();
            return redirect()->to('/admin/menuthanhdoan')->with('success', 'Cập nhật menu thành công.');
        } catch (\Exception $e) {
            // Rollback Transaction nếu có lỗi
            $this->db->transRollback();

            // Ghi log lỗi
            log_message('error', 'Update Menu Error: ' . $e->getMessage());

            // Chuyển hướng lại với thông báo lỗi
            return redirect()->back()->with('error', $e->getMessage());
        }
    }




    public function getSubcategories($parentId)
    {
        $chuyenMucModel = new \App\Models\ChuyenMucModels();
        // Lấy danh mục con của danh mục cha
        $subCategories = $chuyenMucModel->getList_chuyen_muc_con($parentId);

        // Trả về dữ liệu dưới dạng JSON
        return $this->response->setJSON($subCategories);
    }
    // Xóa menu
    public function deleteMenu()
    {
        // Lấy ID menu cần xóa từ POST request
        $menuId = $this->request->getPost('id');

        // Kiểm tra nếu ID có hợp lệ
        if ($menuId) {
            $menuModel = new MenuModel();

            // Xóa menu khỏi database
            if ($menuModel->delete($menuId)) {
                // Trả về phản hồi thành công
                return $this->response->setJSON(['success' => true]);
            }
        }

        // Trả về phản hồi thất bại nếu có lỗi
        return $this->response->setJSON(['success' => false]);
    }
}
