<head>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1800px;
            margin: 0 auto;
            padding: 10px;
        }

        /* Header Section */
        .block_title-gioi-thieu {
            font-size: 2.5rem;
            font-weight: bold;
            color: #005baf; /* Matching the CTICT blue logo color */
            text-transform: uppercase;
        }

        h1.block_title-gioi-thieu {
            margin-top: 0;
        }

        h3.block_title-gioi-thieu {
            font-size: 1.8rem;
            color: #333;
        }

        /* Contact Info */
        p {
            font-size: 16px;
            line-height: 1.6;
            margin: 10px 0;
        }

        p a {
            color: #005baf;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

        /* Content Section */
        .heading-title {
            font-size: 22px;
            font-weight: bold;
            margin-top: 30px;
            color: #005baf; /* Using the same color theme */
        }

        .introduction-text {
            font-size: 16px;
            line-height: 1.8;
            color: #333;
        }

        /* Image Styles */
        .gioithieu {
            max-width: 100%;
            height: auto;
            border: 3px solid #005baf; /* Adding blue border */
            border-radius: 3px; /* Optional: rounded corners */
            transition: transform 0.3s ease; /* Transition for hover effect */
        }

        .gioithieu:hover {
            transform: scale(1.05); /* Zoom in effect on hover */
        }
    </style>
</head>

<body>
<div class="container p-4 bg-body">
    <!-- Header Section -->
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="block_title-gioi-thieu mt-3">SỞ THÔNG TIN VÀ TRUYỀN THÔNG THÀNH PHỐ CẦN THƠ</h1> <br>
            <h3 class="block_title-gioi-thieu">TRUNG TÂM CÔNG NGHỆ THÔNG TIN VÀ TRUYỀN THÔNG THÀNH PHỐ CẦN THƠ</h3>
            <hr style="border: 1px solid #0000; width: 80%; margin: 0 auto;">
            <p>Trụ sở chính: Số 29 Cách Mạng Tháng 8, Phường Thới Bình, Quận Ninh Kiều, TPCT</p>
            <p>ĐT: 0292 3 690 888 | Fax: 08 07 12 13 | Website: <a href="http://ctict.cantho.gov.vn">http://ctict.cantho.gov.vn</a> | Email: <a href="mailto:ctict@cantho.gov.vn">ctict@cantho.gov.vn</a></p>
        </div>
    </div>

    <!-- Image Section -->
    <div class="row mt-2">
    <h2 class="heading-title">Giới thiệu chung</h2>
        <div class="col-md-12 text-center">
            <img class="gioithieu" src="<?= base_url('public/upload/media/images/ctict_2024_resize.png') ?>" alt="CTICT Building" class="img-fluid">
            <!-- Assuming the image is stored in the public/images directory -->
        </div>
    </div>

    <!-- Description Section -->
    <div class="row mt-5">
    <div class="col-md-12" style="text-align: justify;">
            <p>
            Trung tâm Công nghệ thông tin và Truyền thông là đơn vị sự nghiệp trực thuộc Sở Thông tin và Truyền thông, có chức năng giúp Giám đốc Sở thực hiện các nhiệm vụ sự nghiệp phục vụ cho công tác quản lý nhà nước về công nghệ thông tin và truyền thông trên địa bàn thành phố; trực tiếp quản lý, vận hành trung tâm dữ liệu, hạ tầng kỹ thuật công nghệ thông tin các ứng dụng và cơ sở dữ liệu dùng chung của Ủy ban nhân dân thành phố thành phố phục vụ cho việc xây dựng Chính quyền điện tử thành phố và phát triển đô thị thông minh; thực hiện các nhiệm vụ về đảm bảo an toàn và an ninh thông tin mạng, ứng cứu sự cố máy tính trong các cơ quan nhà nước; tổ chức nghiên cứu, thiết kế, xây dựng chương trình, đề án, dự án và ứng dụng các tiến bộ khoa học, kỹ thuật, công nghệ về lĩnh vực thông tin, truyền thông, xuất bản và báo chí theo đúng mục tiêu, nhiệm vụ, tiến độ đã được cơ quan thẩm quyền phê duyệt; tổ chức đào tạo, bồi dưỡng kiến thức, kỹ năng về lĩnh vực công nghệ thông tin và truyền thông; cung cấp các dịch vụ trong lĩnh vực thông tin và truyền thông cho các tổ chức, cá nhân có nhu cầu.            </p>
            <p>
            Trung tâm Công nghệ thông tin và Truyền thông (sau đây gọi tắt là Trung tâm) là đơn vị sự nghiệp có thu, được ngân sách đảm bảo một phần chi phí hoạt động thường xuyên, có tư cách pháp nhân, được phép sử dụng con dấu và tài khoản riêng.            </p>
        </div>
    </div>

    <!-- Mission and Vision Section -->
    <div class="row mt-4">
        <div class="col-md-12">
            <h2 class="heading-title">Tầm nhìn và Sứ mệnh</h2>
            <p class="introduction-text">
                Trung tâm Công nghệ Thông tin và Truyền thông thành phố Cần Thơ là một đơn vị chủ chốt trong việc
                thúc đẩy sự phát triển và ứng dụng công nghệ thông tin vào quản lý và sản xuất, góp phần xây dựng
                thành phố thông minh, phát triển bền vững.
            </p>
        </div>
    </div>

    <!-- Footer or Contact Information -->
    <div class="row mt-4">
        <div class="col-md-12 text-left">
            <p><b>Tên giao dịch:</b> Trung tâm Công nghệ thông tin và Truyền thông Cần Thơ</p>
            <p><b>Tên giao dịch quốc tế:</b> Cantho Information and Communication Technology Center (CTICT)</p>
        </div>
    </div>
</div>

</body>
