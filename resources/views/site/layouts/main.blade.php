<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>الرئيسية</title>
    <link rel="stylesheet" href="{{ asset("assets/bootstrap/css/bootstrap.min.css") }}" />

    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />


    <style>

        body {
            background-color: #F8F6F6;
            font-family: 'Tajawal', sans-serif;
        }

        .nav-link {
            color: #333333;
        }

        .nav-link.active,
        .nav-link:hover {
            background-color: #60B5FF;
            border-radius: 10px;
            color: white !important;
            font-weight: bold;
        }

        .login-btn {
            background-color: #FF9149E5;
            color: white;
            font-weight: bold;
            border-radius: 10px;
        }

        .login-btn:hover {
            background-color: #e1b062;
            color: white;
        }

        .custom-shadow {
            box-shadow: 0 10px 15px #b9b9b940;
        }

        .user-views-box {
            display: flex;
            align-items: flex-start;
            justify-content: flex-end;
            gap: 10px;
        }

        .views-info {
            text-align: right;
        }

        .views-number {
            font-weight: bold;
            color: #60B5FF;
            font-size: 18px;
            margin: 0;
        }

        .user-images {
            display: flex;
            justify-content: flex-start;
            direction: ltr;
            margin-top: 5px;
        }

        .user-images img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            margin-left: -10px;
        }

        .views-label {
            font-size: 14px;
            margin: 5px 0 0 0;
            text-align: right;
        }

        .custom-img {
            width: 90%;
            height: 300px;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .place-wrapper {
            height: 350px;
            overflow: hidden;
            border-radius: 10px;
            position: relative;
        }

        .place-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .place-label {
            position: absolute;
            bottom: 35px;
            background-color:#60B5FF;
            color: #ffffff;
            padding: 5px 20px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 15px;
            z-index: 10;
        }

        .place-sub-label {
            position: absolute;
            bottom: 6px;
            background-color: rgba(255, 255, 255, 0.7);
            color: #000000e5;
            padding: 5px 12px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 10px;
            box-shadow: 0 2px 5px rgba(255, 255, 255, 0.1);
            z-index: 10;
        }

        footer ul {
            padding: 0;
        }

        footer ul li {
            margin-bottom: 6px;
        }
        .custom-bg {
            background-color: #F8F6F6;
        }

        .custom-bg::placeholder {
            color: #333333;
            opacity: 1; /* لتأكد من ظهور اللون بالكامل */
        }


        @media (max-width: 767px) {
            .user-views-box {
                flex-direction: column;
                align-items: center;
            }

            .user-images {
                justify-content: center;
            }

            .place-wrapper {
                height: 250px;
            }

            .place-label {
                font-size: 13px;
                padding: 4px 15px;
            }

            .place-sub-label {
                font-size: 9px;
                padding: 4px 10px;
            }
            .place-wrapper {
                height: 180px; /* كان 250px */
            }
            .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
            .col-md-4 {
                text-align: center !important;
            }

            .user-images {
                justify-content: center;
            }.col-md-7, .col-md-5 {
                 flex: 0 0 100%;
                 max-width: 100%;
                 text-align: center;
             }

            form {
                margin: auto;
                width: 100% !important;
            }

            .navbar .login-btn {
                width: 100%;
                margin-top: 10px;
            }
            .navbar .container {
                flex-wrap: wrap;
            }

            .navbar .login-btn {
                margin-top: 10px;
            }
            footer .col-md-3 {
                flex: 0 0 100% !important;
                max-width: 100% !important;
                text-align: center !important;
                margin-bottom: 20px;
            }
            .navbar-nav .nav-link {
                display: block;
                width: 100%;
                padding: 10px;
                margin-bottom: 5px;
                border-radius: 10px;
                text-align: center;
            }

            .navbar-nav .nav-link.active,
            .navbar-nav .nav-link:hover {
                background-color: #60B5FF;
                color: white;
                font-weight: bold;
            }
        }
        .login-btn {
            background-color: #FF9149E5;
            color: white;
            border-radius: 0.5rem;
        }
        .login-btn:hover {
            background-color: #60B5FF;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        @media (max-width: 767.98px) {
            .no-bullets-mobile {
                list-style: none;
                padding-left: 0;
                padding-right: 0;
            }
        }

        @media (min-width: 768px) {
            .no-bullets-mobile {
                list-style: disc;
                list-style-position: inside;
            }
        }
    </style>
</head>
<body>
            <!--begin::Header-->
    @include('site.layouts.header')
            <!--end::Header-->
            <!--begin::Landing hero-->
    @yield('content')

    <!--begin::Footer Section-->
    <!--begin::Footer-->
    @include('site.layouts.footer')

            <div class="custom-shadow border-bottom border-2 my-5 container"></div>

            <script src="{{ asset("assets/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
            <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>


            <script>
                const { createApp } = Vue;

                createApp({
                    data() {
                        return {
                            email: '',
                            message: '',
                            showAlert: false,
                        }
                    },
                    methods: {
                        sendFeedback() {
                            this.showAlert = true;
                            this.email = '';
                            this.message = '';

                            setTimeout(() => {
                                this.showAlert = false;
                            }, 3000);
                        }
                    }
                }).mount('#app');
            </script>
</body>
</html>
