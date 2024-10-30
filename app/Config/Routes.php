<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public Routes
$routes->get('/', 'HomeController::index');
$routes->post('/login', 'UserController::login');
$routes->get('/index_v2', 'HomeController::index_v2');
$routes->get('/home/ajax_getpaneltop', 'HomeController::ajax_getpaneltop');
$routes->get('upload/media/images/(:segment)', 'FileController::show_anh/$1');
$routes->get('upload/media/videos/(:segment)', 'FileController::show_videos/$1');
$routes->get('upload/document/(:segment)', 'FileController::show_file/$1');
$routes->post('/file/timTaiLieu', 'TaiLieuController::timTaiLieu');
$routes->get('/bv/(:any)', 'BaiDangController::show_bai_dang_id/$1');
$routes->get('/cate/(:any)', 'BaiDangController::show_blog_danh_mucPlus/$1');
$routes->get('/cate_v2/(:any)', 'BaiDangController::show_blog_danh_mucPlus_v2/$1');
$routes->get('/thu-vien-anh', 'DaPhuongTienController::thu_vien_anh');
$routes->get('/view/(:any)', 'DaPhuongTienController::view_thu_vien_anh/$1');
$routes->get('/thu-vien-video', 'DaPhuongTienController::thu_vien_video');
$routes->get('/video/(:any)', 'DaPhuongTienController::view_thu_vien_video/$1');
$routes->get('/tailieu_vanban', 'TaiLieuController::tailieu_vanban');
$routes->get('/gop-y', 'ThuGopYController::index');
$routes->get('/sitemap', 'HomeController::sitemap');
$routes->get('/gioi-thieu', 'GioiThieuController::index');
$routes->get('/chuc-nang-nhiem-vu', 'GioiThieuController::ChucNangNV');
$routes->get('/co-cau-to-chuc', 'GioiThieuController::CoCauToChuc');
$routes->get('/linh-vuc-hoat-dong', 'GioiThieuController::LinhVucHD');
$routes->get('/tai-lieu', 'TaiLieuThamKhaoController::indexGD');  // Shows folders only



$routes->get('/err/page_403', (function () {
    return view('Page_403');
}));
$routes->set404Override(function () {
    echo view('Page_404');
});

// AJAX Routes
$routes->get('/ajax_laydsthugopy', 'ThuGopYController::ajax_laydsthugopy');
$routes->post('/gop-y/add', 'ThuGopYController::add_gopy');
$routes->post('/admin/ajax_duyet_show_thu', 'ThuGopYController::ajax_duyet_show_thu');
$routes->post('/admin/ajax_Huy_duyet_thu_vien', 'ThuGopYController::ajax_Huy_duyet_thu_vien');
$routes->post('/admin/add_phan_hoi_thugopy', 'ThuGopYController::add_phan_hoi_thugopy');
$routes->post('/admin/ajax_ldstacvu', 'TacVuController::ajax_ldstacvu');
$routes->post('/admin/ajax_laythongtintacvu', 'TacVuController::ajax_laythongtintacvu');
$routes->post('/admin/ajax_ldschucNang', 'TacVuController::ajax_ldschucNang');
$routes->post('/admin/ajax_laythongtincanhan', 'UserController::ajax_laythongtincanhan');
$routes->post('/admin/ajax_laythongtincapnhat', 'UserController::ajax_laythongtincapnhat');
$routes->post('/admin/ajax_laydsloainguoidung', 'UserController::ajax_laydsloainguoidung');
$routes->post('/admin/ajax_laythongtinloainguoidung', 'UserController::ajax_laythongtinloainguoidung');
$routes->post('/admin/ajax_laythongtintailieucapnhat', 'TaiLieuController::ajax_laythongtintailieucapnhat');
$routes->post('/admin/ajax_xoaAnhChiTiet', 'DaPhuongTienController::ajax_xoaAnhChiTiet');
$routes->post('/admin/ajax_xoaAllAnhChiTiet', 'DaPhuongTienController::ajax_xoaAllAnhChiTiet');
$routes->post('/admin/ajax_duyetBST', 'DaPhuongTienController::ajax_duyetBST');
$routes->post('/admin/ajax_Huy_duyetBST', 'DaPhuongTienController::ajax_Huy_duyetBST');
$routes->post('/admin/ajax_layinfoBST', 'DaPhuongTienController::ajax_layinfoBST');
$routes->post('/admin/ajax_sua_category', 'ChuyenMucController::ajax_sua_category');
$routes->post('/admin/ajax_duyetBaiDang', 'BaiDangController::ajax_duyetBaiDang');
$routes->post('/admin/ajax_Huy_duyetBaiDang', 'BaiDangController::ajax_Huy_duyetBaiDang');




// User Management
$routes->get('admin', 'UserController::index');
$routes->get('user/logout', 'UserController::logout');
$routes->post('admin/add_user', 'UserController::add_user');
$routes->post('admin/edit_user', 'UserController::edit_user');
$routes->post('admin/change_pass_user', 'UserController::change_pass_user');
$routes->post('admin/lock_user', 'UserController::lock_user');
$routes->post('admin/unlock_user', 'UserController::unlock_user');
$routes->post('admin/del_user', 'UserController::del_user');

// Web Information
$routes->get('admin/thongtinweb', 'ThongTinWebController::index');
$routes->post('admin/luuthongtinweb', 'ThongTinWebController::luuthongtinweb');

// Task Management
$routes->get('admin/dstacvu', 'TacVuController::index');
$routes->get('admin/ds_taikhoan', 'UserController::ds_taikhoan');
$routes->post('admin/addtacvu', 'TacVuController::addtacvu');
$routes->post('admin/xoatacvu', 'TacVuController::xoatacvu');
$routes->post('admin/capnhattacvu', 'TacVuController::capnhattacvu');
$routes->get('admin/them_quyen_cho_nhom/(:any)', 'TacVuController::them_quyen_cho_nhom/$1');
$routes->post('admin/them_chuc_nang_vao_nhom', 'TacVuController::them_chuc_nang_vao_nhom');
$routes->post('admin/xoa_chuc_nang_khoi_nhom', 'TacVuController::xoa_chuc_nang_khoi_nhom');
$routes->post('admin/them_moi_nhom_quyen', 'TacVuController::them_moi_nhom_quyen');
$routes->get('admin/nhomChucNang', 'TacVuController::nhomChucNang_dsNhomCN');
$routes->post('admin/xoa_nhom_quyen', 'TacVuController::xoa_nhom_quyen');
$routes->post('admin/capNhat_nhom_quyen', 'TacVuController::capNhat_nhom_quyen');

// User Role Management
$routes->get('admin/ds_loainguoidung', 'UserController::laydanhsachloaind');
$routes->post('admin/addloainguoidung', 'UserController::addloainguoidung');
$routes->post('admin/xoaloainguoidung', 'UserController::xoaloainguoidung');
$routes->post('admin/editloainguoidung', 'UserController::editloainguoidung');
$routes->post('admin/themtacvuchonloaind', 'UserController::themtacvuchonloaind');

// Document Management
$routes->get('admin/vanban', 'TaiLieuController::index');
$routes->get('admin/ajax_laydsloaitl', 'TaiLieuController::ajax_laydsloaitl');
$routes->post('admin/addloaitailieu', 'TaiLieuController::addloaitailieu');
$routes->post('admin/editloaitailieu', 'TaiLieuController::editloaitailieu');
$routes->post('admin/xoaloaitailieu', 'TaiLieuController::xoaloaitailieu');
$routes->post('admin/themmoitailieu', 'TaiLieuController::themmoitailieu');
$routes->post('admin/capnhattailieu', 'TaiLieuController::capnhattailieu');
$routes->post('admin/xoatailieu', 'TaiLieuController::xoatailieu');

// Panel Management
$routes->get('admin/panel', 'PanelController::index');
$routes->post('admin/add_panel', 'PanelController::add_panel');
$routes->get('admin/xoa_panel', 'PanelController::xoa_panel');
$routes->post('admin/sua_panel', 'PanelController::sua_panel');

// Category Management
$routes->get('admin/ds_category', 'ChuyenMucController::index');
$routes->post('admin/add_category', 'ChuyenMucController::add_category');
$routes->post('admin/sua_category', 'ChuyenMucController::sua_category');
$routes->get('admin/xoa_category', 'ChuyenMucController::xoa_category');

// Post Management
$routes->get('admin/ds_baidang', 'BaiDangController::index');
$routes->get('admin/add_baidang', 'BaiDangController::add_baidang');
$routes->post('admin/save_baidang', 'BaiDangController::save_baidang');
$routes->get('admin/edit_baidang/(:any)', 'BaiDangController::edit_baidang/$1');
$routes->post('admin/save_update_baidang/(:any)', 'BaiDangController::save_update_baidang/$1');
$routes->get('admin/delete_baidang/(:any)', 'BaiDangController::delete_baidang/$1');
$routes->post('admin/duyet_baidang', 'BaiDangController::duyet_baidang');
$routes->post('admin/huy_duyet_baidang', 'BaiDangController::huy_duyet_baidang');

// Feedback Management
$routes->get('admin/thu_gopy', 'ThuGopYController::hopthu');
$routes->post('admin/delete_gopy', 'ThuGopYController::delete_gopy');
$routes->post('admin/duyet_gopy', 'ThuGopYController::duyet_gopy');
$routes->post('admin/huy_duyet_gopy', 'ThuGopYController::huy_duyet_gopy');
$routes->post('admin/them_phan_hoi', 'ThuGopYController::them_phan_hoi');

// Statistics
$routes->get('admin/thong_ke', 'ThongKeController::index');
$routes->post('admin/ajax_thongke', 'ThongKeController::ajax_thongke');

// Banner Management
$routes->get('admin/banner', 'BannerController::index');
$routes->post('admin/add_banner', 'BannerController::add_banner');
$routes->post('admin/edit_banner', 'BannerController::edit_banner');
$routes->post('admin/delete_banner', 'BannerController::delete_banner');

// Resource Management
$routes->get('admin/thu-vien', 'DaPhuongTienController::index');
$routes->post('admin/upload_anh', 'DaPhuongTienController::upload_anh');
$routes->post('admin/upload_video', 'DaPhuongTienController::upload_video');
$routes->post('admin/upload_file', 'DaPhuongTienController::upload_file');
$routes->post('admin/xoa_anh', 'DaPhuongTienController::xoa_anh');
$routes->post('admin/xoa_all_anh', 'DaPhuongTienController::xoa_all_anh');
$routes->post('admin/duyet_anh', 'DaPhuongTienController::duyet_anh');
$routes->post('admin/huy_duyet_anh', 'DaPhuongTienController::huy_duyet_anh');

// List Management
$routes->get('admin/danh_sach', 'DanhSachController::index');
$routes->post('admin/add_danh_sach', 'DanhSachController::add_danh_sach');
$routes->post('admin/edit_danh_sach', 'DanhSachController::edit_danh_sach');
$routes->post('admin/delete_danh_sach', 'DanhSachController::delete_danh_sach');

// List Quản Lý Thư Mục Và File
$routes->get('admin/danh_sach_tai_lieu_tham_khao', 'TaiLieuThamKhaoController::index');
$routes->post('admin/danh_sach_tai_lieu_tham_khao/addFolder', 'TaiLieuThamKhaoController::addFolder');
$routes->post('/admin/danh_sach_tai_lieu_tham_khao/editFolder', 'TaiLieuThamKhaoController::editFolder');
$routes->get('/admin/danh_sach_tai_lieu_tham_khao/deleteFolder/(:num)', 'TaiLieuThamKhaoController::deleteFolder/$1');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$routes->post('admin/danh_sach_tai_lieu_tham_khao/editFile', 'TaiLieuThamKhaoController::editFile');
$routes->post('admin/danh_sach_tai_lieu_tham_khao/addFile', 'TaiLieuThamKhaoController::addFile');
$routes->get('/admin/danh_sach_tai_lieu_tham_khao/deleteFile/(:num)', 'TaiLieuThamKhaoController::deleteFile/$1');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$routes->get('admin/trash', 'TaiLieuThamKhaoController::trash');
$routes->get('admin/tai_lieu_tham_khao/deleteFile/(:num)', 'TaiLieuThamKhaoController::deleteFile/$1');
$routes->get('admin/tai_lieu_tham_khao/deleteFolder/(:num)', 'TaiLieuThamKhaoController::deleteFolder/$1');
$routes->get('admin/tai_lieu_tham_khao/restoreFile/(:num)', 'TaiLieuThamKhaoController::restoreFile/$1');
$routes->get('admin/tai_lieu_tham_khao/restoreFolder/(:num)', 'TaiLieuThamKhaoController::restoreFolder/$1');
$routes->get('admin/tai_lieu_tham_khao/permanentlyDeleteFile/(:num)', 'TaiLieuThamKhaoController::permanentlyDeleteFile/$1');
$routes->get('admin/tai_lieu_tham_khao/permanentlyDeleteFolder/(:num)', 'TaiLieuThamKhaoController::permanentlyDeleteFolder/$1');

