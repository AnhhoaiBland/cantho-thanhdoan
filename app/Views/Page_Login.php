<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link rel="stylesheet" href="public/bootstrap513/bootstrap.min.css" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Source Sans Pro', sans-serif;
            background: url('https://wallpapers.com/images/featured/technology-w65hwkhmusntb0j9.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            position: relative;
        }

        .title {
            font-size: 2em;
            font-weight: 700;
            color: #333;
            text-transform: uppercase;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
            text-decoration: none;
        }

        .login-card-body {
            padding: 20px;
        }

        .input-group-text {
            margin-left: 3px;
            height: 45px;
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            width: 100%;
            padding: 10px;
            border-radius: 25px;
            font-size: 1.2em;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .forgot-password {
            display: block;
            margin-top: 10px;
            font-size: 0.9em;
            color: #007bff;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            font-size: 0.85em;
        }

        .background-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.2);
            animation: move 20s linear infinite;
            opacity: 0.7;
        }

        @keyframes move {
            0% {
                transform: translate(0, 0) scale(1);
                opacity: 1;
            }
            100% {
                transform: translate(100vw, -100vh) scale(2); /* Dịch chuyển từ trái qua phải và lên trên */
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <div class="login-box">
        <div class="login-logo">
            <a class="title">Đăng nhập</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Trang quản trị website <br><?= WEB_TITLE?></p>

                <form action="login" method="post">
                    <div class="input-group mb-3">
                        <input name="username" class="form-control" value="<?= isset($user) ? $user : ''; ?>" placeholder="Tên đăng nhập">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <span id="usernameError" class="error-message"></span>

                    <div class="input-group mb-3">
                        <input type="password" id="pass" name="pass" value="<?= isset($pass) ? $pass : '' ?>" class="form-control" placeholder="Mật khẩu">
                        <div class="input-group-append">
                            <div style="cursor: pointer;" id="showPass" class="input-group-text">
                                <span id="eyePass" class="fas fa-eye"></span>
                            </div>
                        </div>
                    </div>
                    <span id="passwordError" class="error-message"></span>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Đăng nhập</button>
                        </div>
                    </div>
                    
                    <div class="row mt-2">
                        <div class="col-12 text-center">
                            <a href="forgot-password" class="forgot-password">Quên mật khẩu?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="background-animation">
        <div class="circle" style="width: 100px; height: 100px; top: 20%; left: 30%;"></div>
        <div class="circle" style="width: 150px; height: 150px; top: 50%; left: 60%;"></div>
        <div class="circle" style="width: 80px; height: 80px; top: 80%; left: 10%;"></div>
    </div>

    <!-- jQuery -->
    <script src="public/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        const form = document.querySelector('form');
        const usernameInput = document.querySelector('input[name="username"]');
        const passwordInput = document.querySelector('input[name="pass"]');
        const usernameError = document.getElementById('usernameError');
        const passwordError = document.getElementById('passwordError');

        form.addEventListener('submit', function (e) {
            let valid = true;

            // Reset error messages
            usernameError.textContent = '';
            passwordError.textContent = '';

            // Kiểm tra username
            if (usernameInput.value.trim() === '') {
                usernameError.textContent = 'Vui lòng nhập tên đăng nhập.';
                valid = false;
            }

            // Kiểm tra password
            if (passwordInput.value.trim() === '') {
                passwordError.textContent = 'Vui lòng nhập mật khẩu.';
                valid = false;
            }

            // Ngăn form submit nếu có lỗi
            if (!valid) {
                e.preventDefault();
            }
        });

        // Toggle Password Visibility
        const showPass = document.getElementById('showPass');
        const eyePass = document.getElementById('eyePass');
        const pass = document.getElementById('pass');
        let showP = false;
        showPass.addEventListener('click', () => {
            showP = !showP;
            if (showP) {
                eyePass.classList.remove('fa-eye');
                eyePass.classList.add('fa-eye-slash');
                pass.setAttribute('type', 'text');
            } else {
                eyePass.classList.remove('fa-eye-slash');
                eyePass.classList.add('fa-eye');
                pass.setAttribute('type', 'password');
            }
        });

        function createCircle() {
            const backgroundAnimation = document.querySelector('.background-animation');
            const circle = document.createElement('div');
            const size = Math.random() * 100 + 50;
            const duration = Math.random() * 20 + 10;
            const positionX = Math.random() * 100;
            const positionY = Math.random() * 100;

            circle.classList.add('circle');
            circle.style.width = `${size}px`;
            circle.style.height = `${size}px`;
            circle.style.top = `${positionY}%`;
            circle.style.left = `${positionX}%`;
            circle.style.animationDuration = `${duration}s`;

            backgroundAnimation.appendChild(circle);

            setTimeout(() => {
                backgroundAnimation.removeChild(circle);
            }, duration * 1000);
        }

        setInterval(createCircle, 2000);
    </script>
</body>

</html>
