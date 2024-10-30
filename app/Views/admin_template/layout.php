<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Trang quản trị</title>
	<base href="<?= base_url(); ?>">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicon -->
	<?php if (!empty($logo)) : ?>
		<link rel="shortcut icon" href="<?= base_url() . "upload/media/images/" . $logo ?>" type="image/x-icon">
	<?php endif; ?>

	<!-- <link rel="icon" href="favicon.ico" type="image/x-icon"> -->
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url('public/assets/admin_template/plugins/fontawesome-free/css/all.min.css'); ?>">

	<link rel="stylesheet" href="public/assets/font-awesome/css/font-awesome.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bbootstrap 4 -->
	<link rel="stylesheet" href="public/assets/admin_template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="public/assets/admin_template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<!-- <link rel="stylesheet" href="public/assets/admin_template/plugins/jqvmap/jqvmap.min.css"> -->
	<link rel="stylesheet" href="public/assets/datatable/datatables.css">
	<link rel="stylesheet" href="public/assets/sweetalert2/dist/sweetalert2.css">
	<link rel="stylesheet" href="public/assets/select2/dist/css/select2.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="public/assets/admin_template/dist/css/adminlte.css">
	<link rel="stylesheet" href="public/assets/admin_template/dist/css/custom.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="public/assets/admin_template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="public/assets/admin_template/plugins/daterangepicker/daterangepicker.css">
	<!-- summernote -->
	<link rel="stylesheet" href="public/assets/admin_template/plugins/summernote/summernote-bs4.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<!-- Styles -->

	<link rel="stylesheet" href="public/assets/muliselectlib/select2.min.css" />
	<link rel="stylesheet" href="public/assets/muliselectlib/select2-bootstrap-5-theme.min.css" />

	<!-- Scripts -->


	<!-- jQuery -->
	<script src="public/assets/admin_template/plugins/jquery/jquery.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="public/assets/admin_template/plugins/jquery-ui/jquery-ui.min.js"></script>


	<script src="public/node_modules/ckeditor4/ckeditor.js"></script>
	<script src="public/node_modules/ckfinder/ckfinder.js"></script>

	<link rel="stylesheet" href="public/node_modules/treetable/css/jquery.treetable.css">
	<link rel="stylesheet" href="public/node_modules/treetable/css/jquery.treetable.theme.default.css">
	<script src="public/node_modules/treetable/jquery.treetable.js"></script>
	<script src="public/script/libPhen.js"></script>
	<link rel="stylesheet" href=<?= base_url("public/plugins/toastr/toastr.min.css") ?>>
	<link rel="stylesheet" href="public/assets/vanilla-js-tabs/vanilla-js-tabs.css">

	<style>
		/* Tổng quát */
		.wrapper {
			font-family: 'Poppins', sans-serif;
			/* Font chữ hiện đại */
		}

		/* Navbar */
		.main-header {
			background-color: #343a40;
			/* Màu nền tối cho navbar */
			color: white;
		}

		.main-header .navbar-nav .nav-link {
			color: white;
			/* Màu chữ trắng */
		}

		.main-header .navbar-nav .nav-link:hover {
			background-color: rgba(255, 255, 255, 0.2);
			/* Hiệu ứng hover */
		}

		/* Sidebar */
		.main-sidebar {
			background-color: #212529;
			/* Màu nền tối cho sidebar */
			height: 100%;
			/* Chiều cao sidebar */
		}

		.main-sidebar .brand-link {
			color: #ffffff;
			/* Màu chữ cho brand */
			text-align: center;
			/* Căn giữa brand */
		}

		.main-sidebar .nav-link {
			color: #b8c7ce;
			/* Màu chữ cho sidebar */
		}

		.main-sidebar .nav-link:hover {
			background-color: rgba(255, 255, 255, 0.1);
			/* Hiệu ứng hover */
			color: white;
			/* Màu chữ khi hover */
		}

		.main-sidebar .nav-icon {
			color: #ffffff;
			/* Màu icon */
		}

		/* User Panel */
		.user-panel {
			background-color: rgba(255, 255, 255, 0.1);
			/* Nền mờ cho user panel */
			border-radius: 5px;
			/* Bo góc cho user panel */
			margin-bottom: 15px;
			/* Khoảng cách dưới user panel */
		}

		.user-panel .info {
			color: white;
			/* Màu chữ cho thông tin người dùng */
		}

		.user-panel .info a {
			color: #ff5b5b;
			/* Màu chữ cho link đăng xuất */
		}

		/* Content Wrapper */
		.content-wrapper {
			background-color: #ffffff;
			/* Màu nền trắng cho nội dung */
			border-radius: 10px;
			/* Bo góc */
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
			/* Hiệu ứng đổ bóng */
			padding: 20px;
			/* Padding cho nội dung */
			margin: 20px;
			/* Khoảng cách với các thành phần khác */
		}

		/* Footer */
		.main-footer {
			background-color: #343a40;
			/* Màu nền tối cho footer */
			color: white;
			text-align: center;
			/* Căn giữa chữ */
		}

		.main-footer a {
			color: #ffcc00;
			/* Màu chữ cho link trong footer */
		}

		/* Hiệu ứng khi sidebar thu nhỏ */
		.sidebar-collapse .nav-link {
			font-size: 0.9em;
			/* Giảm kích thước chữ khi thu nhỏ */
		}

		/* Responsive */
		@media (max-width: 768px) {
			.main-header .navbar-nav {
				flex-direction: column;
				/* Đổi chiều navbar khi trên thiết bị nhỏ */
			}
		}

		.user-panel {
			background-color: rgba(255, 255, 255, 0.1);
			/* Nền mờ cho user panel */
			border-radius: 5px;
			/* Bo góc cho user panel */
			margin-bottom: 15px;
			/* Khoảng cách dưới user panel */
			display: flex;
			/* Sử dụng flex để căn giữa */
			align-items: center;
			/* Căn giữa theo chiều dọc */
			padding: 10px;
			/* Padding cho user panel */
		}

		.user-panel .image {
			margin-right: 10px;
			/* Khoảng cách giữa ảnh và thông tin */
		}

		.user-panel .image img {
			width: 50px;
			/* Đặt kích thước ảnh */
			height: 50px;
			/* Đặt kích thước ảnh */
		}

		.user-panel .info {
			color: white;
			/* Màu chữ cho thông tin người dùng */
			flex-grow: 1;
			/* Cho phép chiếm không gian còn lại */
		}

		.user-panel .info a {
			color: #ff5b5b;
			/* Màu chữ cho link đăng xuất */
			text-decoration: none;
			/* Bỏ gạch chân */
		}

		.user-panel .info a:hover {
			text-decoration: underline;
			/* Gạch chân khi hover */
		}
	</style>




</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<!-- -->
		<!-- /.navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light text-right">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>

			</ul>

			<!-- right div -->
			<div class="pull-right">
				<a href="<?= base_url() ?>" target="_blank">Website</a>
			</div>
		</nav>
		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="admin" class="brand-link">
				<img src="<?= !empty($logo) ? base_url("upload/media/images/$logo") : '' ?>" alt="Logo website" class="brand-image img-circle elevation-3">

				<span class="brand-text font-weight">TRANG QUẢN TRỊ</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="public/assets/admin_template/dist/img/user8-128x128.jpg" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<span class="d-block text-white" id="view_infor" style="cursor: pointer;"><?php $tenDangNhap = $data[0]['tenDangNhap'];
																									echo $tenDangNhap ?></span>
						<br>
						<a href="<?= site_url('user/logout') ?>">Đăng xuất</a>

					</div>
				</div>


				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<!-- Add icons to the links using the .nav-icon class
							 with font-awesome or any other icon font library -->
						<?php foreach ($danhSachChucNang as $ChucNang) {
							if ($ChucNang['urlChucNang'] == '/admin/ds_taikhoan') { ?>
								<li class="nav-item has-treeview">
									<a href="admin/ds_taikhoan" class="nav-link">
										<i class="nav-icon 	far fa-address-card"></i>
										<p>
											Tài khoản
										</p>
									</a>

								</li>
							<?php break;
							} ?>
						<?php } ?>

						<?php foreach ($danhSachChucNang as $ChucNang) {
							if ($ChucNang['urlChucNang'] == '/admin/thongtinweb') { ?>
								<li class="nav-item has-treeview">
									<a href="admin/thongtinweb" class="nav-link">
										<i class="nav-icon fa fa-gear"></i>
										<p>
											Cấu hình thông tin web
										</p>
									</a>

								</li>
							<?php break;
							} ?>
						<?php } ?>

						<?php foreach ($danhSachChucNang as $ChucNang) {
							if ($ChucNang['urlChucNang'] == '/admin/ds_loainguoidung') { ?>
								<li class="nav-item has-treeview">
									<a href="admin/ds_loainguoidung" class="nav-link">
										<i class="nav-icon fas fa-user-edit"></i>
										<p>
											Quản lý loại tài khoản

										</p>
									</a>

								</li>
							<?php break;
							} ?>
						<?php } ?>


						<?php foreach ($danhSachChucNang as $ChucNang) {
							if ($ChucNang['urlChucNang'] == '/admin/dstacvu') { ?>
								<!-- <li class="nav-item has-treeview">
									<a href="admin/dstacvu" class="nav-link">
										<i class="nav-icon fas fa-dungeon"></i>
										<p>
											Quản lý chức năng

										</p>
									</a>
								</li> -->
							<?php break;
							} ?>
						<?php } ?>


						<?php foreach ($danhSachChucNang as $ChucNang) {
							if ($ChucNang['urlChucNang'] == '/admin/dstacvu') { ?>
								<!-- <li class="nav-item has-treeview">
									<a href="admin/dstacvu" class="nav-link">
										<i class="nav-icon fas fa-dungeon"></i>
										<p>
											Quản lý nhóm quyền

										</p>
									</a>
								</li> -->
							<?php break;
							} ?>
						<?php } ?>

						<!-- <li class="nav-item has-treeview">
							<a href="admin/ds_loainguoidung" class="nav-link">
								<i class="nav-icon fas fa-user-edit"></i>
								<p>
									Quản lý loại tài khoản

								</p>
							</a>

						</li> -->
						<!-- <li class="nav-item has-treeview">
							<a href="admin/dstacvu" class="nav-link">
								<i class="nav-icon fas fa-dungeon"></i>
								<p>
									Quản lý chức năng

								</p>
							</a>
							</li>

							<li class="nav-item has-treeview">
								<a href="admin/nhomChucNang" class="nav-link">
									<i class="nav-icon fas fa-dungeon"></i>
									<p>
										Quản lý nhóm quyền

									</p>
								</a>
							</li> -->

						<!--li class="nav-item has-treeview">
						<a href="admin/ds_nguoidung" class="nav-link">
							<i class="nav-icon fas fa-user"></i>
							<p>
								Người dùng
								
							</p>
						</a>
						
					</li>
					<li class="nav-item has-treeview">
						<a href="admin/ds_cauhoi" class="nav-link">
							<i class="nav-icon fas fa-edit"></i>
							<p>
								Câu hỏi
							</p>
						</a>
						
					</li-->

						<?php foreach ($danhSachChucNang as $ChucNang) {
							if ($ChucNang['urlChucNang'] == '/admin/ds_category') { ?>

								<li class="nav-item has-treeview">
									<a href="admin/ds_category" class="nav-link">
										<i class="nav-icon fa fa-list-alt"></i>
										<p>
											Chuyên mục
										</p>
									</a>

								</li>
							<?php break;
							} ?>
						<?php } ?>


						<?php foreach ($danhSachChucNang as $ChucNang) {
							if ($ChucNang['urlChucNang'] == '/admin/ds_baidang') { ?>
								<li class="nav-item has-treeview">
									<a href="admin/ds_baidang" class="nav-link">
										<i class="nav-icon fa fa-file-text-o"></i>
										<p>
											Bài đăng
										</p>
									</a>

								</li>
							<?php break;
							} ?>
						<?php } ?>

						<!-- <li class="nav-item has-treeview">
							<a href="admin/ds_baiviet_theo_thang" class="nav-link">
								<i class="nav-icon fa fa-check"></i>
								<p>
									Duyệt bài đăng
								</p>
							</a>

						</li> -->

						<?php foreach ($danhSachChucNang as $ChucNang) {
							if ($ChucNang['urlChucNang'] == '/admin/vanban') { ?>
								<li class="nav-item has-treeview">
									<a href="admin/vanban/" class="nav-link">
										<i class="nav-icon fa fa-file-o "></i>
										<p>
											Văn bản liên quan
										</p>
									</a>
								</li>
							<?php	} ?>
						<?php } ?>


						<?php foreach ($danhSachChucNang as $ChucNang) {
							if ($ChucNang['urlChucNang'] == '/admin/tke_theo_category') { ?>

								<li class="nav-item has-treeview">
									<a href="admin/tke_theo_category" class="nav-link">
										<i class="nav-icon fa fa-pie-chart"></i>
										<p>
											T.kê theo chuyên mục
										</p>
									</a>

								</li>
							<?php	} ?>
						<?php } ?>

						<?php foreach ($danhSachChucNang as $ChucNang) {
							if ($ChucNang['urlChucNang'] == '/admin/panel') { ?>
								<li class="nav-item has-treeview">
									<a href="admin/panel" class="nav-link">
										<i class="nav-icon fa fa-photo"></i>
										<p>
											QL panel chính
										</p>
									</a>

								</li>
							<?php	} ?>
						<?php } ?>


						<?php foreach ($danhSachChucNang as $ChucNang) {
							if ($ChucNang['urlChucNang'] == '/admin/hopthu') { ?>
								<li class="nav-item has-treeview">
									<a href="admin/thu_gopy" class="nav-link">
										<i class="nav-icon fa fa-envelope"></i>
										<p>
											Hộp thư góp ý
										</p>
									</a>

								</li>
							<?php	} ?>
						<?php } ?>

						<?php foreach ($danhSachChucNang as $ChucNang) {
							if ($ChucNang['urlChucNang'] == '/admin/danh_sach_tai_lieu_tham_khao') { ?>

								<li class="nav-item has-treeview">
									<a href="/admin/danh_sach_tai_lieu_tham_khao" class="nav-link">
										<i class="nav-icon fa fa-archive"></i>
										<p>
											Tài Liệu Tham Khảo
										</p>
									</a>

								</li>
							<?php break;
							} ?>
						<?php } ?>

						<?php foreach ($danhSachChucNang as $ChucNang) {
							if ($ChucNang['urlChucNang'] == '/admin/daphuongtien') { ?>
								<li class="nav-item has-treeview">
									<a href="admin/daphuongtien" class="nav-link">
										<i class="nav-icon fa fa-image"></i>
										<p>
											Quản lý thư viện ảnh/ videos
										</p>
									</a>

								</li>
							<?php break;
							} ?>
						<?php } ?>


					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper p-3">
			<?php echo $page ?>
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<strong></strong>

			<div class="float-right ">
				<?php $nam = getdate()['year']  ?>
				@<?php echo $nam ?> - Do <a href="http://ctict.cantho.gov.vn" target="_blank">CTICT</a> xây dựng và thiết kế
			</div>
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->


	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>

	<script src="public/assets/vanilla-js-tabs/vanilla-js-tabs.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="public/assets/muliselectlib/select2.full.min.js"></script>

	<script src="public/assets/admin_template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="public/assets/datatable/datatables.js"></script>
	<script src="public/assets/datatable/sort/date-uk.js"></script>
	<script src="public/assets/sweetalert2/dist/sweetalert2.js"></script>
	<script src="public/assets/sweetalert2/dist/sweetalert2.all.js"></script>
	<script src="public/assets/select2/dist/js/select2.js"></script>
	<!-- ChartJS -->
	<script src="public/assets/admin_template/plugins/chart.js/Chart.min.js"></script>
	<!-- Sparkline -->
	<script src="public/assets/admin_template/plugins/sparklines/sparkline.js"></script>
	<!-- JQVMap -->
	<!-- <script src="public/assets/admin_template/plugins/jqvmap/jquery.vmap.min.js"></script> -->
	<!-- <script src="public/assets/admin_template/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
	<!-- jQuery Knob Chart -->
	<script src="public/assets/admin_template/plugins/jquery-knob/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="public/assets/admin_template/plugins/moment/moment.min.js"></script>
	<script src="public/assets/admin_template/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="public/assets/admin_template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Summernote -->
	<script src="public/assets/admin_template/plugins/summernote/summernote-bs4.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="public/assets/admin_template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- AdminLTE App -->
	<script src="public/assets/admin_template/dist/js/adminlte.js"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="public/assets/admin_template/dist/js/pages/dashboard.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="public/assets/admin_template/dist/js/demo.js"></script>

	<script>
		$('#multiple-select-field').select2({
			theme: "bootstrap-5",
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			closeOnSelect: false,
		});
	</script>
</body>

</html>