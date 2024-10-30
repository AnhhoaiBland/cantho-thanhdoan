<?php
// Mảng chứa tên dịch vụ, đường dẫn, icon và hình ảnh tương ứng
$services = [
    ['name' => 'Bảo trì, nâng cấp hệ thống <br> Công nghệ thông tin - Truyền Thông', 'url' => '#', 'image' => 'https://ntsgroup.com.vn/wp-content/uploads/2021/03/Picture1.png', 'description' => '
Hệ thống, trang thiết bị CNTT đóng vai trò hết sức quan trọng trong hoạt động của các cơ quan quản lý nhà nước, tộ chức, Doanh nghiệp, nhằm phục công tác chỉ đạo, điều hành cũng như phục vụ người dân và doanh nghiệp đạt hiệu quả cao, tiết kiệm được thời gian, tiền bạc; góp phần xây dựng Chính phủ điện tử, cải cách nền hành chính công.<br>
Nếu hệ thống bị trục trặc sẽ ảnh hưởng rất lớn đến công việc; vì vậy việc bảo trì, bảo dưỡng hệ thống cần phải được đặc biệt quan tâm, thực hiện thường xuyên.<br>
<b>CTICT cung cấp dịch vụ bảo trì, bảo dưỡng hệ thống công nghệ thông tin với các nội dung sau:</b><br>
- Xử lý các vấn đề mạng máy tính: kiểm tra, theo dõi hệ thống, các phương án khắc phục sự cố, quản lý việc truy xuất, bảo mật,…<br>
- Bảo trì định kỳ hệ thống mạng tại các cơ quan, doanh nghiệp.<br>
- Bảo trì webiste các tộ chức, doanh nghiệp.<br>
- Xây dựng và triển khai các giải pháp an toàn, an ninh thông tin trên mạng. <br>
<b>TRUNG TÂM CÔNG NGHỆ THÔNG TIN VÀ TRUYỀN THÔNG CẦN THƠ</b><br>
Địa chỉ: 3B Nguyễn Trãi, Phượng An Hội, Quận Ninh Kiều, TP.Cần Thơ<br>
Điện thoại: 07103 690 888    <br>                 Fax: 08 07 12 13
Website: www.ctict.cantho.gv.vn      <br>      Email: ctict@cantho.gov.vn'],
    ['name' => 'Đào tạo nguồn nhân lực  <br> Công nghệ thông tin - Truyền Thông', 'url' => '#', 'image' => 'https://fbu.edu.vn/wp-content/uploads/2023/02/hoc-nganh-cong-nghe-thong-tin-uy-tin-hinh1.png'],
    ['name' => 'Tư vấn, thiết kế, giám sát và thi công', 'url' => '#', 'image' => 'https://its.huit.edu.vn/ttcntt/images/news/465ab41d65e897b6cef9.jpg'],
    ['name' => 'Cho thuê hosting', 'url' => '#', 'image' => 'https://cdn.hostingviet.vn/upload/2023/08/Web-Hosting-la-gi.jpg'],
    ['name' => 'Thiết kế, quản trị Website', 'url' => '#', 'image' => 'https://i.pinimg.com/564x/41/23/05/41230590a0ff35dd78f8856bd993affb.jpg'],
    ['name' => 'Hội nghị truyền hình', 'url' => '#', 'image' => 'https://i.pinimg.com/564x/43/83/c6/4383c6d19bbc6408c227d2d0ead57b1b.jpg'],
    ['name' => 'Tổ chức sự kiện', 'url' => '#', 'image' => 'https://i.pinimg.com/564x/f8/22/08/f82208e20f2a9eaea33e9565bd2b0c49.jpg'],
    ['name' => 'Tổ chức sự kiện', 'url' => '#', 'image' => 'https://i.pinimg.com/564x/8d/37/99/8d3799e24be55bdfddb7a4fd8e4100d0.jpg'],
    ['name' => 'Tổ chức sự kiện', 'url' => '#', 'image' => 'https://i.pinimg.com/564x/8d/37/99/8d3799e24be55bdfddb7a4fd8e4100d0.jpg'],
];
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">

    <style>
    /* CSS cho danh sách dịch vụ */
    .service-item {
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 10px;
        transition: background-color 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        height: 350px;
    }

    .service-item:hover {
        background-color: #e9ecef;
    }

    .service-imagedv {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .service-title {
        margin-top: 20px;
        text-transform: uppercase;
        font-family: 'Open Sans', sans-serif;
        font-size: 17px;
        font-weight: 900;
        text-align: left;
    }

    .title-dv {
        margin: 20px 0;
        background-color: #033e8c;
        color: white;
        border-radius: 8px;
        padding: 10px;
        text-align: center;
        font-size: larger;
        font-weight: 700;
    }

    .service-column {
        margin-bottom: 20px;
    }

    .carousel-inner {
        width: 100%;
    }

    .carousel-item {
        display: flex;
        justify-content: center;
    }

    .load-more {
        margin: 20px 0;
        text-align: center;
        cursor: pointer;
    }

    .carousel-control-prev,
    .carousel-control-next {
        margin-top: 11rem;
        display: flex;
        width: 50px;
        height: 50px;
        top: 50%;
        transform: translateY(-50%);
    }

    .carousel-control-prev {
        left: -60px;
    }

    .carousel-control-next {
        right: -60px;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        padding: 10px;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        background-color: rgba(0, 0, 0, 0.7);
    }

    .service-icon {
        float: left;
        margin-top: 10px;
    }

    .modal-dialog {
        max-width: 800px;
        margin: 1.75rem auto;
    }

    .modal-body {
        font-size: 18px;
        line-height: 1.5;
        text-align: justify;
    }

    .modal-header {
        background-color: #033e8c;
        color: white;
    }
    h4{
        text-align: center;
    }
    </style>
</head>

<body>
    <div>
        <h3 class="title-dv">CÁC DỊCH VỤ</h3>

        <!-- Slider -->
        <div id="serviceCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php for ($i = 0; $i < count($services); $i += 3): ?>
                <!-- Hiển thị 3 dịch vụ mỗi slide -->
                <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                    <div class="row">
                        <?php for ($j = 0; $j < 3 && $i + $j < count($services); $j++): ?>
                        <div class="col-md-4 service-column">
                            <!-- Mỗi cột chiếm 4 cột -->
                            <div class="service-item text-center">
                                <img class="service-imagedv" src="<?= $services[$i + $j]['image'] ?>"
                                    alt="<?= $services[$i + $j]['name'] ?>" style="height: 200px;" /> <!-- Hình ảnh -->

                                <div class="service-title">
                                    <a href="<?= $services[$i + $j]['url'] ?>">
                                        <?= $services[$i + $j]['name'] ?>
                                    </a>
                                </div>
                                <div class="service-icon">
                                    <button class="btn btn-info"
                                        onclick="showServiceDetail(<?= htmlspecialchars(json_encode($services[$i + $j])) ?>)">
                                        <i class="fa-solid fa-arrow-right"></i> <!-- Icon thông tin -->
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endfor; ?>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#serviceCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#serviceCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Modal Dialog chi tiết dịch vụ -->
    <div class="modal fade" id="serviceDetailModal" tabindex="-1" aria-labelledby="serviceDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceDetailModalLabel">Chi tiết dịch vụ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="serviceDetailContent">
                    <!-- Nội dung chi tiết sẽ được tải động -->
                </div>
            </div>
        </div>
    </div>

    <script>
    function showServiceDetail(service) {
        // Đổi tượng thành HTML chi tiết dịch vụ
        const content = `
            <h4>${service.name}</h4>
            <img src="${service.image}" alt="${service.name}" style="width: 100%; height: auto; margin-bottom: 20px;" />
            <p>${service.description ? service.description : "Không có thông tin chi tiết."}</p>
        `;

        // Điền nội dung vào modal
        document.getElementById('serviceDetailContent').innerHTML = content;

        // Hiển thị modal
        const serviceDetailModal = new bootstrap.Modal(document.getElementById('serviceDetailModal'));
        serviceDetailModal.show();
    }
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>