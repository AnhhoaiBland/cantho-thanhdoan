    


<head>
    <style>
        .heading-title {
            font-size: 22px;
            font-weight: bold;
            margin-top: 10px;
            color: #005baf;
            position: relative;
            z-index: 2; /* Ensures heading is above video */
        }

        /* Container for the video and content */
        .container {
            position: relative;
        }

        /* Style for the video background */
        .video-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%; /* Make the video stretch across the entire width */
            height: 22.8vh; /* Full viewport height */
            object-fit: cover; /* Ensure the video covers the background area */
            z-index: 0; /* Background video should be the lowest */
        }

        /* Ensure the container content is above the video */
        .content {
            position: relative;
            z-index: 2; /* Content above video */
            background-color: rgba(255, 255, 255, 0.8); /* Optional: Make content background slightly transparent */
            padding: 30px;
            margin-top: 150px; 
        }

        /* Ensure body and html take up full height */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        ul.custom-list {
            list-style: none; /* Remove default list bullets */
            padding-left: 20px; /* Add left padding */
        }

        ul.custom-list li {
            position: relative;
            padding-left: 20px; /* Ensure spacing between bullet and content */
            margin-bottom: 10px; /* Spacing between list items */
        }

        ul.custom-list li::before {
            content: "•"; /* Custom bullet */
            position: absolute;
            left: 0;
            color: #005baf; /* Bullet color */
            font-size: 20px; /* Bullet size */
            line-height: 1; /* Center bullet vertically */
        }
    </style>
</head>

<body>
    <!-- Content with heading and other content -->
    <div class="container p-4 bg-body">
        <!-- Video Background -->
        <video autoplay muted loop class="video-bg">
            <source src="/public/upload/media/videos/bg-demo.mp4" type="video/mp4">
            
        </video>

        <div class="content">
            <h2 class="heading-title">Lĩnh vực hoạt động</h2>
            <p style="text-align: justify;">Trung tâm Công nghệ Thông tin và Truyền thông Cần Thơ có chức năng giúp Giám đốc Sở quản lý, vận hành ổn định hạ tầng kỹ thuật ứng dụng công nghệ thông tin, các phần mềm ứng dụng công nghệ thông tin dùng chung trong các cơ quan Nhà nước thuộc UBND thành phố; quản trị, vận hành kỹ thuật Cổng Thông tin Điện tử thành phố (Cantho Portal); tổ chức thực hiện các nhiệm vụ sự nghiệp nhằm hỗ trợ ứng dụng và phát triển lĩnh vực thông tin và truyền thông; cung cấp các dịch vụ trong lĩnh vực thông tin và truyền thông cho các tổ chức, cá nhân có nhu cầu dựa trên nguồn lực sẵn có.</p>
            <h5 class="heading-title">Các hoạt động dịch vụ sự nghiệp:</h5>
            <ul class="custom-list">
                <li>Tư vấn, thiết kế, giám sát và thi công các dự án Công Nghệ Thông Tin - Truyền Thông</li>
                <li>Thiết kế phần mềm, website, quản trị Website</li>
                <li>Bảo trì, nâng cấp hệ thống Công Nghệ Thông Tin - Truyền Thông</li>
                <li>Tư vấn, thi công, vận hành hệ thống hội nghị truyền hình</li>
                <li>Đào tạo, liên kết đào tạo nguồn nhân lực Công Nghệ Thông Tin - Truyền Thông cho CBCC, VC thành phố</li>
                <li>Tổ chức các sự kiện thông tin truyền thông</li>
                <li>Hợp tác quốc tế, trong nước trong lĩnh vực ứng dụng và phát triển Công Nghệ Thông Tin - Truyền Thông</li>
            </ul>
        </div>
    </div>
</body>
