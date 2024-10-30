<div class="row">
    <div class="col-md-12">
        <h3>Thêm chức năng chon nhóm: <?= $thongTinNhom[0]['tenNhom'] ?></h3>
        <input type="hidden" name="maNhom" id="maNhom" value="<?= $thongTinNhom[0]['maNhom'] ?>">
    </div>
</div>
<div class="row ">

    <div class="col-md-3">
        <select name="chucNang" class="form-control" id="chucNang">
            <?php foreach ($danhS_chuc_nang as $chuc_nang_root) {
                $optionExist = false;
                foreach ($ds_chuc_nang as $key => $chuc_nang_check) {
                    if ($chuc_nang_root['maChucNang'] == $chuc_nang_check['maChucNang']) {
                        $optionExist = true;
                        break;
                    }
                }
                if (!$optionExist) { ?>
                    <option value="<?= $chuc_nang_root['maChucNang'] ?>"><?= $chuc_nang_root['tenChucNang'] ?></option>
            <?php }
            } ?>

        </select>
        <button class="mt-2 mb-2 btn btn-primary" id="them_vao_ban">Thêm chức năng trên vào nhóm</button>
    </div>
    <div class="col-md-12 bg-white p-2">

        <table class="table table-bordered" id="datatable">
            <thead>
                <td>Stt</td>
                <td>Tên nhóm quyền</td>
                <td>Mô tả</td>
                <td>Action</td>
            </thead>
            <tbody>
                <?php $stt = 1;
                foreach ($ds_chuc_nang as $chuc_nang) : ?>
                    <tr data-id="<?= $chuc_nang['maChucNang'] ?>" data-tt-id="<?= $chuc_nang['maChucNang'] ?>" <?php if (isset($category['CAT_PARENT_ID']) && $category['CAT_PARENT_ID'] != NULL) echo 'data-tt-parent-id="' . $category['CAT_PARENT_ID'] . '"' ?>>
                        <td> <?= $stt++ ?> </td>
                        <td> <?= $chuc_nang['tenChucNang'] ?> </td>
                        <td> <?= $chuc_nang['urlChucNang'] ?> </td>
                        <td class="text-right">
                            <button class="btn btn-danger btnXoa"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>
<?php echo view('admin/nhomquyen/add_chuc_nang_cho_nhomquyen'); ?>


<script>
    $(document).ready(function() {
        // $('#datatable').treetable({
        // 	expandable: true,
        // });
        // var table = $('#datatable').DataTable({
        // 	"language": {
        // 		"url": "assets/datatable/Vietnamese.json"
        // 	},
        // 	"iDisplayLength": 25,
        // });

        $(document).ready(function() {
            $('#them_vao_ban').click(function() {
                var selectedValue = $('#chucNang').val();
                var maNhomID = $("#maNhom").val();
                $.ajax({
                    url: 'admin/them_chuc_nang_vao_nhom',
                    type: 'POST',
                    data: {
                        maChucNang: selectedValue,
                        maNhom: maNhomID
                    },
                    dataType: 'JSON',
                    success: function(result) {
                        console.log(result);
                        if (result.status === 'success') {
                            Swal.fire(
                                'Đã thêm',
                                result.message,
                                result.status
                            );

                        } else {
                            Swal.fire(
                                'thêm không thành công',
                                result.message,
                                result.status
                            );
                        }

                        window.location.reload();
                    },
                    error: function(request, status, error) {
                        alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại. ");
                        // console.log(request.responseText, error);
                    }

                });
            });
        });

        $('.btnXoa').on('click', function() {
            node = $(this);
            var maNhomID = $("#maNhom").val();
            Swal.fire({
                title: 'Xác nhận xóa',
                text: "Bạn có chắc muốn xóa tác vụ này?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Không xóa',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: 'admin/xoa_chuc_nang_khoi_nhom',
                        type: 'POST',
                        data: {
                            maChucNang: $(node).parents('tr').attr('data-id'),
                            maNhom: maNhomID
                        },
                        dataType: 'JSON',
                        success: function(result) {
                            console.log(result);
                            if (result.status === 'success') {
                                Swal.fire(
                                    'Đã xóa',
                                    result.message,
                                    result.status
                                );
                                $(node).parents('tr').remove();
                            } else {
                                Swal.fire(
                                    'Xóa không thành công',
                                    result.message,
                                    result.status
                                );
                            }
                        },
                        error: function(request, status, error) {
                            alert("Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại. ");
                            // console.log(request.responseText, error);
                        }
                    });
                }
            });
        });


        $('.btnSua').click(function() {
            var row = $(this).parents('tr');
            var id = $(row).attr('data-id');
            $.ajax({
                url: 'admin/ajax_laythongtintacvu',
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(result) {

                    $('#txt_IdEdit').val(result[0].maChucNang);
                    $('#txt_TenEdit').val(result[0].tenChucNang);
                    $('#txt_AliasEdit').val(result[0].urlChucNang);

                    $('#modalEditTacvu').modal('show');
                }
            })
        });

        $('.btnSua').click(function() {
            var row = $(this).parents('tr');
            var id = $(row).attr('data-id');
            $.ajax({
                url: 'admin/ajax_laythongtintacvu',
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(result) {

                    $('#txt_IdEdit').val(result[0].maChucNang);
                    $('#txt_TenEdit').val(result[0].tenChucNang);
                    $('#txt_AliasEdit').val(result[0].urlChucNang);

                    $('#modalEditTacvu').modal('show');
                }
            })
        });
        $('#frmAdd').submit(function(e) {
            var formData = new FormData($('#frmAdd')[0]);
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData, //$(this).serialize(),
                dataType: 'JSON',
                processData: false,
                contentType: false,
                cache: false,
                success: function(result) {
                    console.log(result);
                    $('#modalAdd').modal('hide');
                    if (result.status == 'success') {
                        swal.fire('Thành công', result.message, result.status);

                    } else {
                        swal.fire('Thất bại', result.message, result.status);
                    }
                    window.location.reload();
                }
            });
        });

        $('#frmEditCategory').submit(function(e) {
            var formData = new FormData($('#frmEditCategory')[0]);
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData, //$(this).serialize(),
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(result) {
                    $('#modalEditTacvu').modal('hide');
                    if (result.status == 'success') {
                        swal.fire('Thành công', result.message, result.status);

                    } else {
                        console.log(result.error);
                        swal.fire('Thất bại', result.message, result.status);
                    }

                    window.location.reload();
                }
            });
        });




    });
</script>