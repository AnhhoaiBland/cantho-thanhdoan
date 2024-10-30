<style>
    footer {
        background-color: #373737;
        color: white;
        padding-top: 0.5rem;
        padding-bottom: 2rem;
    }

    footer h4 {
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    footer p,
    footer a {
        font-size: 0.875rem;
        line-height: 1.5;
    }

    footer a {
        color: #dcdcdc;
        text-decoration: none;
    }

    footer a:hover {
        color: #ffffff;
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .footer-col {
            margin-bottom: 1rem;
        }
    }

    iframe {
        width: 100%;
        height: 200px;
        border-radius: 10px;
        border: none;
    }

    .counter {
        background: rgba(255, 255, 255, 0.1);
        padding: 0.5rem 1rem;
        border-radius: 5px;
        margin-bottom: 1rem;
    }

    .btn-ctici {
        background-color: transparent;
        color: #dcdcdc;
        border: none;
        padding: 0;
    }

    .btn-ctici:hover {
        color: #ffffff;
    }

    footer p,
    footer a {
        font-size: 1rem;
    }

    .footer-stats {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }
</style>
<footer>
    <div class="container-fluid">
        <div class="row ms-lg-5">
            <div class="col-lg-6 col-md-6 footer-col ps-lg-5">
                <h4 style="color: #df34cd;">TRANG THÔNG TIN HỘI LIÊN HIỆP PHỤ NỮ THÀNH PHỐ CẦN THƠ</h4>
                <P style="color: white;">Đơn vị quản lý: Hội liên hiệp phụ nữ Thành phố Cần Thơ</P>
                <p style="color: white;">Chịu trách nhiệm nội dung: <?= $responsiblePerson ?></p>
                <p style="color: white;">Địa chỉ: <?= $address ?> </p>
                <p style="color: white;">Điện thoại: <?= $phoneNumber ?> - Số fax: <?= $faxNumber ?></p>
                <p style="color: white;">Email: <?= $email ?></p>
                <p style="color: white;">Facebook: <?= $facebook ?></p>

                <br>
                <p style="color: white;">Ghi rõ nguồn "Hội liên hiệp phụ nữ Thành phố Cần Thơ" khi phát hành lại thông tin</p>
            </div>
            <div class="col-lg-3 col-md-6 footer-col">
                <h4>Bản đồ</h4>
                <?= $map ?>
            </div>
            <div class="col-lg-3 footer-mg-lg  col-md-6 footer-col">
                <div class="footer-stats ms-lg-4">
                    <h4>THỐNG KÊ TRUY CẬP</h4>
                    <p style="color: white;">Tổng số lượt truy cập: <?= $luoc_truy_cap['sl_tc_tong'] ?></p>
                    <p style="color: white;">Hôm nay: <?= $luoc_truy_cap['sl_tc_ngay'] ?></p>
                    <p style="color: white;">Tháng này: <?= $luoc_truy_cap['sl_tc_thang'] ?></p>
                    <p style="color: white;">Trong năm nay: <?= $luoc_truy_cap['sl_tc_nam'] ?></p>
                    <br>
                    <p style="color: rgb(178, 171, 171);">Xây dựng và thiết kế bởi <a href="https://ctict.cantho.gov.vn/index.php">CTICT</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>