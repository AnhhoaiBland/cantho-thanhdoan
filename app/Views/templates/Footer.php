

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="./public/footer/fonts/icomoon/style.css">
    <link rel="stylesheet" href="./public/footer/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/footer/css/style.css">
    <style>
    /* CSS cho danh sách dịch vụ */
    .footer-32892 {
        padding: 0 0px;
        /* Giảm padding để làm footer nhỏ lại */
        background-color: #ffffff;
        margin-top: 10px;
    }

    .footer-32892 h3 {
        color: #000000;
        margin-bottom: 5px;
        font-family: 'Arial', sans-serif;
        font-size: 24px;
        font-weight: bold;
        color: #333;
        /* Màu sắc của font */
    }

    .footer-32892 h2 {
        color: #0056b3;
        font-size: 28px;
        text-transform: uppercase;
        text-align: left;
        font-weight: 800;
    }

    .footer-32892 .quick-info li a {
        color: #000000;
    }

    .footer-32892 hr {
        border: 0;
        height: 5px;
        width: auto;
        /* Giảm độ dày của đường ngang */
        background-color: #152238;
        /* Thay đổi margin để giảm khoảng cách */
    }

    .footer-32892 .logo {
        padding: 0;
        margin-bottom: 10px;
        /* Giảm khoảng cách dưới logo */
    }

    .quick-info {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        /* Giữ căn lề trái */
        padding: 0;
        margin: 0;
    }

    .quick-info li {
        transition: background-color 0.3s ease;
        width: 100%;
    }

    .quick-info li:hover {
        background-color: #d0e0f0;
    }

    .quick-info li a {
        color: #000000;
        text-decoration: none;
        display: flex;
        align-items: center;
        padding: 6px;
        /* Giảm padding cho các liên kết */
        width: 100%;
        box-sizing: border-box;
    }

    .quick-info li a:hover {
        color: #0056b3;
    }

    .custom-margin {
        padding: 0 15px;
        /* Giảm padding cho phần tử có lớp custom-margin */
    }

    .subscribe input[type="text"] {
        padding: 6px;
        /* Giảm padding cho ô nhập liệu */
    }

    .subscribe input[type="submit"] {
        padding: 6px 12px;
        /* Giảm padding cho nút gửi */
    }

    .map-container {
        position: relative;
        width: 100%;
        height: 300px;
        /* Giảm chiều cao của phần chứa bản đồ */
        border: 1px solid #ddd;
        /* Giảm độ dày của đường viền */
        border-radius: 6px;
        /* Giảm độ bo góc */
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        /* Giảm độ đổ bóng */
        overflow: hidden;
    }

    .map-container iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    /* Căn giữa logo và tăng kích thước */
    .logo img {
        max-width: 300px;
        /* Thay đổi kích thước logo */
        margin-left: auto;
        /* Căn giữa logo */
        margin-right: 0;
        /* Căn giữa logo */
    }

    .col-md-2 {
        text-align: right;
        /* Đặt căn chỉnh sang bên phải cho cột chứa logo */
    }
    h1.footer{
        font-size: 45px;
        color: #0056b3;
        text-align: center;
        font-family: 'Times New Roman', Times, serif;
        font-weight: 800;
    }
   

   
    </style>
</head>


    <footer class="footer-32892 pb-0">
        <hr>
        <div class="site-section">
            <div class="container-fluid custom-margin">
                <div class="row">
                    <div class="col-md-2 text-right logo">
                        <img src="<?= base_url("public/icons/logo-footer.png") ?>" alt="Logo" class="img-fluid">
                        <h1 class="footer">CTICT</h1>
                    </div>
                    <div class="col-md pr-md-5 mb-4 mb-md-0">
                        <h2 class="name">Trung tâm Công nghệ Thông tin và Truyền thông tp. Cần Thơ</h2>
                        <p></p>
                        <br>
                        <ul class="list-unstyled quick-info mb-4">
                            <li><a href="#" class="d-flex align-items-center"><span class="bi bi-geo-alt mr-3"></span>Số
                                    29 đường Cách mạng tháng 8 - phường Thới Bình - quận Ninh Kiều - TP.Cần Thơ.</a>
                            </li>
                            <li><a href="#" class="d-flex align-items-center"><span
                                        class="bi bi-telephone mr-3"></span>(0292) 3 690 888 - Fax: 080 72123</a></li>
                            <li><a href="#" class="d-flex align-items-center"><span
                                        class="bi bi-envelope mr-3"></span>ctict@cantho.gov.vn</a></li>
                        </ul>
                        <form action="#" class="subscribe">
                            <input type="text" class="form-control" placeholder="Nhập email để được hỗ trợ!">
                            <button type="submit" class="btn btn-submit"
                                style="background-color: #007bff; color: #ffffff; border: none;">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>

                    </div>
                    <div class="col-md mb-6 mb-md-0">
                        <h3 class="map">Bản đồ</h3>
                        <div class="map-container">
                            <!-- Thay thế đường link dưới đây bằng đường link của bản đồ của bạn -->
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m19!1m8!1m3!1d125714.36043140934!2d105.6910632!3d10.0519873!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x317529355ce4f133%3A0x2a0b5c0e18ce6635!2zMDEgxJAuIEPDoWNoIE3huqFuZyBUaMOhbmcgOCwgVMOibiBBbiwgTmluaCBLaeG7gXUsIEPhuqduIFRoxqE!3m2!1d10.051997499999999!2d105.7734651!5e0!3m2!1sen!2s!4v1726133734920!5m2!1sen!2s"
                                width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 mb-md-0">
                        <h3 class="chungchi">Chứng chỉ</h3>
                        <div class="row gallery">
                            <div class="col-6">
                                <a href="https://tinnhiemmang.vn/danh-ba-tin-nhiem/ctictcanthogovvn-1636960835"
                                    target="_blank">
                                    <img src="./public/footer/images/handle_cert.png" alt="Image" class="img-fluid">
                                </a>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>
                    </div>

                    <p></p>
                </div>
            </div>
        </div>
    </footer>
    <script src="./public/footer/js/jquery-3.3.1.min.js"></script>
    <script src="./public/footer/js/popper.min.js"></script>
    <script src="./public/footer/js/bootstrap.min.js"></script>


