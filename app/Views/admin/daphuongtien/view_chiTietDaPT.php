<style>
    .thumbnail-img {
        max-width: 250px;
        max-height: 250px;
        width: auto;
        height: auto;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <h3>Quản lý Chi tiết thư viện</h3>

        <?php if (!empty($ds_chiTiet)) { ?>
            <input type="hidden" id="maBoSuuTap" value=<?= $ds_chiTiet[0]['maBoSuuTap'] ?>>
            <input type="hidden" id="loaiBoSuuTap" value=<?= $ds_chiTiet[0]['loai'] ?>>
        <?php } ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12 bg-white p-2">
        <div class="form-group">
            <span class="btn btn-success them_item_bst_cc"><i class="fa fa-plus "></i>Thêm mới item</span>
        </div>

        <table class="table table-bordered" id="datatable">
            <thead>
                <td style="width: 5%;">STT</td>
                <?php if (!empty($ds_chiTiet)) { ?>
                    <?php if ($ds_chiTiet[0]['loai'] == 'im') { ?>
                        <td style="width: 30%;">Ảnh</td>
                    <?php } else {  ?>
                        <td style="width: 30%;">Video</td>
                    <?php } ?>
                <?php } ?>


                <td style="width: 10%;">Action</td>
            </thead>
            <tbody>
                <?php if (!empty($ds_chiTiet)) { ?>
                    <?php $stt = 1;
                    foreach ($ds_chiTiet as $value) { ?>
                        <tr data-id="<?= $value['maChiTiet'] ?>" data-tt-id="<?= $value['maChiTiet'] ?>">
                            <td><?= $stt++ ?></td>
                            <?php if ($ds_chiTiet[0]['loai'] == 'im') { ?>
                                <td><img class="thumbnail-img" src="<?= base_url() . 'upload/media/images/' . $value['urlFile'] ?>" alt=""></td>
                            <?php } else {  ?>
                                <td><video class="thumbnail-img" src="<?= base_url() . 'upload/media/videos/' . $value['urlFile'] ?>" alt=""> </video></td>
                            <?php } ?>

                            <td>
                                <span class="btn btn-danger btn_xoa_chi_anh_chi_tiet"><i class="fa fa-trash"></i></span>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>


            </tbody>
        </table>
        <?php if (!empty($ds_chiTiet)) { ?>
            <span class="btn btn-danger btn_xoa_all_chi_anh_chi_tiet">Xóa tất cả</span>
        <?php } ?>
    </div>
    <?php echo view('admin/daphuongtien/add_ItemPT') ?>
</div>



<script>
    $(document).ready(function() {
        // $('#datatable').dataTable({
        //     language: {
        //         url: "assets/datatable/Vietnamese.json"
        //     },
        //     "iDisplayLength": 25,
        //     columnDefs: [{
        //         type: 'date-uk',
        //         targets: 4
        //     }]
        // });

        $('.them_item_bst_cc').click(function() {
            $('#modalAddItemBoSuTap').modal('show');
        })

        $('.btn_xoa_chi_anh_chi_tiet').click(function() {
            var row = $(this).parents('tr');
            var id = $(row).attr('data-id');
            Swal.fire({
                title: 'Xác nhận xóa ảnh',
                text: "Bạn xác nhận xóa ảnh này?",
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
                        url: 'admin/ajax_xoaAnhChiTiet',
                        type: 'POST',
                        data: {
                            id: $(node).parents('tr').attr('data-id'),
                            loaiBoSuuTap: $('#loaiBoSuuTap').val()
                        },
                        dataType: 'JSON',
                        success: function(result) {
                            if (result.status == 'success') {
                                $(node).parents('tr').remove();
                                Swal.fire(
                                    'Xóa thành công',
                                    result.content,
                                    result.status,
                                );
                            } else {
                                Swal.fire(
                                    'Xóa không thành công',
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

        $('.btn_xoa_all_chi_anh_chi_tiet').click(function() {
            var row = $(this).parents('tr');
            var id = $(row).attr('data-id');
            Swal.fire({
                title: 'Xác nhận xóa tất cả ảnh',
                text: "Bạn xác nhận xóa tất cả ảnh của thư viện ảnh này?",
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
                        url: 'admin/ajax_xoaAllAnhChiTiet',
                        type: 'POST',
                        data: {
                            id: $('#maBoSuuTap').val(),
                            loaiBoSuuTap: $('#loaiBoSuuTap').val()
                        },
                        dataType: 'JSON',
                        success: function(result) {
                            if (result.status == 'success') {
                                $(node).parents('tr').remove();
                                Swal.fire(
                                    'Xóa thành công',
                                    result.content,
                                    result.status,
                                );
                                window.location.reload();
                            } else {
                                Swal.fire(
                                    'Xóa không thành công',
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
    })
</script>