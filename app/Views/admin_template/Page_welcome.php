<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
    .main-content {
        flex-grow: 1;
        padding: 20px;
        position: relative;
        z-index: 1;
        color: #fff;
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    header input {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .content-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .card i {
        font-size: 40px;
        color: #6c63ff;
        margin-bottom: 10px;
    }

    .card h3 {
        margin-bottom: 10px;
        font-size: 20px;
        font-weight: bold;
    }
    .card h2 {
        color: #333;
        margin-top: 10px;
        font-size: 20px;
        font-weight: bold;
    }
    .card p {
        font-size: 18px;
        color: #333;
    }

    /* Biểu đồ nằm giữa */
    .chart-container {
        width: 100%;
        max-width: 80rem;
        margin: 50px auto;
        align-items: center;
    }
    </style>
</head>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>

    <div class="main-content">
        <header>
            <input type="text" placeholder="Tìm kiếm...">
        </header>

        <div class="content-grid">
            <div class="card">
                <i class="fas fa-users"></i>
                <h2>Người dùng</h2> <!-- Tiêu đề cho số người dùng -->
                <p>1,200</p>
            </div>
            <div class="card">
                <i class="fas fa-chart-line"></i>
                <h2>Truy Cập</h2> <!-- Tiêu đề cho doanh số -->
                <p>$34,500</p>
            </div>
            <div class="card">
                <i class="fas fa-tasks"></i>
                <h2>Bài Đăng</h2> <!-- Tiêu đề cho công việc -->
                <p>75%</p>
            </div>
            <div class="card">
                <i class="fas fa-envelope"></i>
                <h2>Góp Ý</h2> <!-- Tiêu đề cho tin nhắn -->
                <p>42</p>
            </div>
        </div>


        <!-- Container chứa biểu đồ -->
        <div class="chart-container">
            <canvas id="lineChart"></canvas>
        </div>
    </div>

</body>

<script>
// Lấy tháng hiện tại bằng JavaScript
const currentDate = new Date();
const currentMonth = currentDate.getMonth(); // Lấy tháng hiện tại (0 - 11)

// Biểu đồ đường hiển thị lượt truy cập website
const ctx = document.getElementById('lineChart').getContext('2d');
const lineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8',
            'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
        ], // Tháng hiển thị trên trục X
        datasets: [{
                label: 'Lượt truy cập hàng ngày', // Đường biểu thị lượt truy cập hàng ngày
                data: [300, 400, 350, 600, 800, 900, 1200, 1300, 1400, 1500, 1600,
                1700], // Dữ liệu lượt truy cập hàng ngày
                borderColor: 'rgba(255, 99, 132, 1)', // Màu đỏ
                backgroundColor: 'rgba(255, 99, 132, 0.2)', // Màu nền trong suốt
                fill: true,
                borderWidth: 2
            },
            {
                label: 'Lượt truy cập hàng tháng', // Đường biểu thị lượt truy cập hàng tháng
                data: [1200, 1500, 1700, 1800, 2000, 2200, 2400, 2500, 2600, 2700, 2800,
                2900], // Dữ liệu lượt truy cập hàng tháng
                borderColor: 'rgba(54, 162, 235, 1)', // Màu xanh
                backgroundColor: 'rgba(54, 162, 235, 0.2)', // Màu nền trong suốt
                fill: true,
                borderWidth: 2
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true, // Hiển thị chú thích
                position: 'top' // Vị trí của chú thích
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Tháng' // Tiêu đề trục X
                },
                ticks: {
                    color: function(context) {
                        // Nếu tháng hiện tại, đổi màu tick (nhãn tháng)
                        return context.index === currentMonth ? 'red' : 'black';
                    },
                    font: function(context) {
                        // Nếu tháng hiện tại, đổi font weight để làm nổi bật
                        return context.index === currentMonth ? {
                            weight: 'bold'
                        } : {};
                    }
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Số lượt truy cập' // Tiêu đề trục Y
                },
                beginAtZero: true // Bắt đầu từ 0
            }
        }
    }
});


// Hiệu ứng di chuột với JavaScript
const cards = document.querySelectorAll('.card');

cards.forEach(card => {
    card.addEventListener('mouseover', () => {
        card.style.transform = 'scale(1.1)';
    });

    card.addEventListener('mouseout', () => {
        card.style.transform = 'scale(1)';
    });
});
</script>