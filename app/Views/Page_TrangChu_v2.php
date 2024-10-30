
<?= $this->section('templates/slide') ?>
<?= $this->include('templates/slide') ?>
<?= $this->endSection() ?>



<!-- bài viết mới -->
<?php
 $databaidangtop6new['title'] = "BÀI VIẾT MỚI";
 $databaidangtop6new['ds_baiDang'] =  $baidangtop6new;
 $databaidangtop6new['url_cate'] = '';
 echo view('block/block_chuyenMuc',$databaidangtop6new);
 ?>

<?php
 $data_baiDangCHuyenMucChinhSachVanBan['title'] = "CHÍNH SÁCH PHÁP LUẬT";
 $data_baiDangCHuyenMucChinhSachVanBan['ds_baiDang'] =  $baiDangCHuyenMucChinhSachVanBan;
 $data_baiDangCHuyenMucChinhSachVanBan['url_cate'] = '/cate_v2/thong-tin-chi-dao-dieu-hanh';
 echo view('block/block_chuyenMuc',$data_baiDangCHuyenMucChinhSachVanBan);
 ?>

<?php
 $data_baiDangChuyenMucTinDiaPhuong['title'] = "TIN HOẠT ĐỘNG ĐỊA PHƯƠNG";
 $data_baiDangChuyenMucTinDiaPhuong['ds_baiDang'] =  $baiDangChuyenMucTinDiaPhuong;
 $data_baiDangChuyenMucTinDiaPhuong['url_cate'] = '/cate_v2/tin-tuc-su-kien/tin-hoat-dong-dia-phuong';
 echo view('block/block_chuyenMuc',$data_baiDangChuyenMucTinDiaPhuong);
 ?>

<?php
 $data_baiDangCHuyenMucChinhSachVanBan['title'] = "TRUNG TÂM GIÁO DỤC NGHỀ NGHIỆP PHỤ NỮ CẦN THƠ";
 $data_baiDangCHuyenMucChinhSachVanBan['ds_baiDang'] =  $baiDangCHuyenMucChinhSachVanBan;
 $data_baiDangCHuyenMucChinhSachVanBan['url_cate'] = '/cate_v2/trung-tam-giao-duc-nghe-nghiep-phu-nu';
 echo view('block/block_chuyenMuc',$data_baiDangCHuyenMucChinhSachVanBan);
 ?>

<?php
 $data_baiDangCHuyenMucChinhSachVanBan['title'] = "BÌNH ĐẲNG GIỚI";
 $data_baiDangCHuyenMucChinhSachVanBan['ds_baiDang'] =  $baiDangCHuyenMucChinhSachVanBan;
 $data_baiDangCHuyenMucChinhSachVanBan['url_cate'] = '/cate_v2/binh-dang-gioi';
 echo view('block/block_chuyenMuc',$data_baiDangCHuyenMucChinhSachVanBan);
 ?>
