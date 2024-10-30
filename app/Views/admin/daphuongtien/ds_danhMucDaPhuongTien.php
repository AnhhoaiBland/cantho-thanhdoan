<div class="row">
    <div class="col-md-12">
        <h3>Quản thư viện ảnh/ video</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12 bg-white p-2">
        <?php if ($checkQuyen == '1' || $chi_dang_bai == '1') { ?>
            <div class="form-group">
                <span id="them_bst" class="btn btn-success"><i class="fa fa-plus"></i>Thêm bộ sưu tập mới</span>
            </div>
        <?php } ?>


        <table class="table table-bordered" id="datatable">
            <thead>
                <td>STT</td>
                <td>Tên bộ sưu tập</td>
                <td>Loại bộ sưu tập</td>
                <td>Mô tả</td>
                <td>Ngày đăng</td>
                <td>Trạng thái</td>
                <td>Người duyệt bài</td>
                <td>Thời gian duyệt bài</td>
                <?php if ($checkQuyen == '1'  || $chi_dang_bai == '1') { ?>
                    <td>Action</td>
                <?php } ?>

            </thead>
            <tbody>
                <?php $stt = 1;
                foreach ($ds_BoSuTap as $boSuTap) { ?>
                    <tr data-id="<?= $boSuTap['maBoSuuTap'] ?>" data-tt-id="<?= $boSuTap['maBoSuuTap'] ?>">
                        <td><?= $stt++ ?></td>
                        <td><?= $boSuTap['tenBoSuuTap'] ?></td>
                        <td><?= $boSuTap['loai'] == 'im' ? "Ảnh" : "Video" ?></td>
                        <td><?= $boSuTap['moTa'] ?></td>
                        <td><?= date('d-m-Y', strtotime($boSuTap['ngayTao'])) ?></td>
                        <?php if ($boSuTap['trangThai'] == '1') { ?>
                            <td><a href="javascript:;" class="duyet text-danger">Đang chờ duyệt</a></td>
                        <?php } elseif ($boSuTap['trangThai'] == '3') { ?>
                            <td><a href="javascript:;" class="duyet text-success">Đã cập nhật, đang chờ duyệt</a></td>
                        <?php } else { ?>
                            <td><a href="javascript:;" class="huy-duyet">Đã duyệt, đang hiển thị</a></td>
                        <?php } ?>

                        <td><?= $boSuTap['tenNguoiDuyet'] ?></td>
                        <td><?= empty($boSuTap['ngayDuyet']) ? "" : date('d-m-Y', strtotime($boSuTap['ngayDuyet']))  ?></td>
                        <?php if ($checkQuyen == '1'  || $chi_dang_bai == '1') { ?>
                            <td class="text-right" style="min-width: 100px;">
                                <button class="btn btn-primary" onclick="window.location.href='<?= base_url() ?>admin/view_chiTietDaPT/<?= $boSuTap['maBoSuuTap'] ?>'" type="button"><i class="fa fa-eye"></i></button>
                                <button class="btn btn-warning btnSua" type="button"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btnXoa" type="button"><i class="fa fa-trash"></i></button>
                            </td>
                        <?php } ?>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php echo view('admin/daphuongtien/add_danhMucPT') ?>
        <?php echo view('admin/daphuongtien/edit_danhMucPT') ?>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#datatable').dataTable({
            language: {
                url: "assets/datatable/Vietnamese.json"
            },
            "iDisplayLength": 25,
            columnDefs: [{
                type: 'date-uk',
                targets: 4
            }]
        });

        $('#them_bst').click(function() {
            $('#modalAddBoSuTap').modal('show');
        })

        $('.btnSua').click(function() {
            var row = $(this).parents('tr');
            var idBST = $(row).attr('data-id');
            console.log(idBST)
            $('#maBST').val('id')
            $.ajax({
                url: 'admin/ajax_layinfoBST',
                type: 'POST',
                data: {
                    id: idBST
                },
                dataType: 'JSON',
                success: function(result) {
                    if (result.status == 'success') {
                        $('#maBST').val(idBST)
                        $('#tenBoSuuTapEdit').val(result.contents[0]['tenBoSuuTap']);
                        $('#loai').val(result.contents[0]['loai']);
                        $('#moTa').val(result.contents[0]['moTa'])
                    }
                },
                error: function(request, status, error) {
                    alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại.")
                    console.log(request.responseText, error);
                }
            })
            $('#modalEditBoSuTap').modal('show');
        })

        <?php if ($checkQuyen == '1') { ?>
            $('.duyet').click(function() {
                var row = $(this).parents('tr');
                var id = $(row).attr('data-id');
                Swal.fire({
                    title: 'Xác nhận duyệt bài',
                    text: "Bạn xác nhận duyệt, và cho phép hiển thị bộ sư tập này?",
                    icon: 'white',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    //cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Không đồng ý',
                }).then((result) => {
                    if (result.value) {
                        node = $(this);
                        $.ajax({
                            url: 'admin/ajax_duyetBST',
                            type: 'POST',
                            data: {
                                id: $(node).parents('tr').attr('data-id')
                            },
                            dataType: 'JSON',
                            success: function(result) {

                                if (result.status == 'success') {

                                    Swal.fire(
                                        'Duyệt thành công',
                                        result.content,
                                        result.status,
                                    );
                                    window.location.reload();
                                } else {
                                    Swal.fire(
                                        'Duyệt không thành công',
                                        result.content,
                                        result.status,
                                    );
                                }

                            },
                            error: function(request, status, error) {
                                alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại.")
                                console.log(request.responseText, error);
                            }
                        })

                    }
                })

            });

            $('.huy-duyet').click(function() {
                var row = $(this).parents('tr');
                var id = $(row).attr('data-id');
                Swal.fire({
                    title: 'Xác nhận hủy duyệt bộ sư tập này',
                    text: "Bạn xác nhận hủy duyệt, và không cho phép hiển thị bộ sư tập này?",
                    icon: 'white',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    //cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Không đồng ý',
                }).then((result) => {
                    if (result.value) {
                        node = $(this);
                        $.ajax({
                            url: 'admin/ajax_Huy_duyetBST',
                            type: 'POST',
                            data: {
                                id: $(node).parents('tr').attr('data-id')
                            },
                            dataType: 'JSON',
                            success: function(result) {

                                if (result.status == 'success') {
                                    $(node).parents('tr').remove();
                                    Swal.fire(
                                        'Duyệt thành công',
                                        result.content,
                                        result.status,
                                    );
                                    window.location.reload();
                                } else {
                                    Swal.fire(
                                        'Duyệt không thành công',
                                        result.content,
                                        result.status,
                                    );
                                }

                            },
                            error: function(request, status, error) {
                                alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại.")
                                console.log(request.responseText, error);
                            }
                        })

                    }
                })

            });
        <?php } ?>




    })
</script>