<head>
    <!-- CSS Files -->
    <link href="<?= base_url('public/templates/summernote-0.8.18-dist/summernote-lite.min.css') ?>" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="<?= base_url('public/templates/summernote-0.8.18-dist/summernote-lite.min.js') ?>"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script> <!-- Google reCAPTCHA -->
    <style>
        /* Existing styles... */

        .form-control.custom-input {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 10px;
            font-size: 16px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075);
        }

        .form-control.custom-input:focus {
            border-color: #80bdff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .form-label {
            font-weight: bold;
            color: darkblue;
        }

        .file-upload {
            border: 1px solid #ced4da;
            border-radius: 8px;
            padding: 10px;
            font-size: 16px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .block_title-gop-y {
                font-size: 22px;
            }

            .form-control.custom-input {
                font-size: 14px;
            }
        }

        .block_title-gop-y {
            font-size: 24px;
            color: darkblue;
            text-transform: uppercase;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container p-4 bg-body">
        <div class="row">
            <div class="col-md-12 text-center">
                <span class="block_title-gop-y">THƯ GÓP Ý TRUNG TÂM CÔNG NGHỌ THÔNG TIN VÀ TRUYỀN THÔNG THÀNH PHỐ CẦN THƠ</span>
            </div>
            <div class="col-md-10 mt-5">
                <p class="text-body">Địa chỉ: <b>Số 29 đường Cách mạng tháng 8 - phường Thới Bình - quận Ninh Kiều - TP.Cần Thơ.</b></p>
                <p class="text-body">Số Điện thoại: <b>(0292) 3 690 888 - Fax: 080 72123</b></p>
                <p class="text-body">Email: <b>ctict@cantho.gov.vn</b></p>
                <i class="text-body">Vui lòng điền đủ thông tin bên dưới !</i>
            </div>
        </div>
        <form class="row" action="gop-y/add" method="post" enctype="multipart/form-data">
            <div class="col-md-5">
                <div class="mb-3">
                    <input type="text" class="form-control custom-input" name="hoten" id="hoTen" placeholder="Họ và tên">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control custom-input" name="dienThoai" required placeholder="Số điện thoại" id="dienThoai" onkeypress="return onlyNumbers(event)">
                    <p id="errorMessage" class="text-danger" style="display: none;"> Vui lòng nhập vào là số điện thoại</p>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control custom-input" name="emailgy" id="emailgy" placeholder="Email">
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control file-upload" name="fileUpload">
                </div>
            </div>
            <div class="col-md-7">
                <div class="mb-3">
                    <input type="text" class="form-control custom-input" name="tieuDe" id="tieuDe" required placeholder="Tiêu đề">
                </div>
                <div class="mb-3">
                    <label for="summernote" class="form-label">Nội dung</label>
                    <textarea id="summernote" name="noiDung"></textarea>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY"></div>
            </div>
            <div class="col-md-12 text-center mt-3">
                <button class="btn btn-success fw-bold" type="submit">Gửi thư góp ý</button>
            </div>
        </form>

        <?php if ($showThuGopY) { ?>
        <div class="row pt-3">
            <div class="col-md-12">
                <?php $dtthu['ds_thu_gop_y'] = $ds_thu_gop_y;
                echo view('block/Show_traLoi_thuGopY', $dtthu) ?>
            </div>
        </div>
        <?php } ?>
    </div>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
                minHeight: null,
                maxHeight: null,
                focus: true,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['fontname']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'video', 'table', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function(contents, $editable) {
                        $('#noiDung').val(contents);
                    }
                }
            });
        });
    </script>
</body>