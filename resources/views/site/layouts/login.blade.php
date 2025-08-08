<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" />
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet" />
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
        body {
            font-family: "Tajawal", sans-serif;
            min-height: 100vh;
            margin: 0;
            background-color: #f8f6f6;
        }
        .row.min-vh-100 {
            min-height: 100vh;
        }
        .full-height {
            height: 100%;
        }
        .login-box {
            padding: 40px;
            width: 100%;
        }
        input.form-control {
            background-color: #F8F6F6;
            color: #333;
            padding: 18px;
        }
        input.form-control::placeholder {
            color: #33333399;
        }
        .line-with-text {
            display: flex;
            align-items: center;
            text-align: center;
            color: black;
            margin: 20px 0;
        }
        .line-with-text::before,
        .line-with-text::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid black;
            margin: 0 10px;
        }
        .right-image-section {
            background-image: url('{{asset('assets/images/Rectangle 65.png')}}');
            background-size: cover;
            background-position: center;
            position: relative;
            height: 100%;
            min-height: 100vh;
        }
        .logo-wrapper {
            padding: 20px;
            text-align: right;
        }
        .logo-wrapper img {
            width: 100px;
            transition: width 0.3s ease;
        }
        .footer-text {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(2px);
            -webkit-backdrop-filter: blur(2px);
            padding: 25px 0;
        }
        .footer-text h6 {
            color: white;
            margin: 0;
            font-weight: bold;
        }
        .footer-text span {
            color: #60B5FF;
        }

        @media (max-width: 991.98px) {
            .login-box {
                padding: 30px 20px;
            }
            .logo-wrapper img {
                width: 100px;
            }
        }
        @media (max-width: 767.98px) {
            .login-box {
                padding: 20px 15px;
            }
            h2 {
                font-size: 1.5rem !important;
            }
            .logo-wrapper img {
                width: 80px;
            }
            input.form-control {
                padding: 14px;
            }
        }
    </style>
</head>
<body id="app">

            <!--begin::Landing hero-->
            @yield('content')

    <!--begin::Footer Section-->
    <!--begin::Footer-->
            <script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
            <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
            @yield('script')
</body>
</html>
