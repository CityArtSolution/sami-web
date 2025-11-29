<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ language_direction() }}" class="theme-fs-sm">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>انضم لبرنامج التسويق | {{ app_name() }}</title>

    <link rel="stylesheet" href="{{ mix('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/backend.css') }}">
    @if (language_direction() == 'rtl')
        <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('custom-css/frontend.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #F8F8F8;
        }

        .container-page {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px 0;
        }

        .sub-container {
            position: relative;
            width: 1320px;
            display: flex;
            flex-wrap: wrap;
            background: #F8F8F8;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .sub-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.1);
        }

        .style-box {
            width: 50%;
            height: 58%;
            background: linear-gradient(135deg, #CF9233, #B67A24);
            position: absolute;
            left: -25%;
            top: -172px;
            rotate: 318deg;
            filter: brightness(1.1);
        }

        .content {
            width: 60%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .section {
            max-width: 700px;
            background: linear-gradient(145deg, #fff, #fdf6e3);
            padding: 35px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .section:hover {
            transform: translateY(-5px);
        }

        .section h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #c48b16;
        }

        .section ul {
            list-style: none;
            padding: 0;
            margin-bottom: 20px;
        }

        .section ul li {
            margin-bottom: 12px;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 10px;
        }

        .section ul li i {
            color: #CF9233;
            font-size: 18px;
            transition: transform 0.3s ease;
        }

        .section ul li:hover i {
            transform: scale(1.3);
        }

        .affiliate-link {
            display: inline-block;
            margin-top: 20px;
            color: #CF9233;
            font-weight: 600;
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .affiliate-link:hover {
            color: #b67a24;
            transform: translateX(5px);
        }

        .gold-btn {
            background: linear-gradient(135deg, #CF9233, #B67A24);
            border-radius: 50px;
            padding: 14px 25px;
            border: none;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 15px;
        }

        .gold-btn:hover {
            background: linear-gradient(135deg, #B67A24, #CF9233);
            color:#fff;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        @media (max-width: 992px) {
            .sub-container {
                flex-direction: column;
                text-align: center;
                width: 95%;
            }
            .style-box { display: none; }
            .content { width: 100%; }
            .section { padding: 25px; }
        }
    </style>
</head>

<body>
    @include('components.frontend.progress-bar')

    <div class="position-relative" style="height: 17vh;">
        @include('components.frontend.second-navbar')
    </div>

    <div class="container-page">
        <div class="sub-container">
            <div class="style-box"></div>

            <div class="content">
                <div class="section">
                    <h2>انضم لبرنامج التسويق بالعمولة</h2>
                    <p class="text-muted mb-4">اربح نسبة من كل عملية شراء تتم عبر رابطك الخاص</p>

                    <h2>مميزات الانضمام:</h2>
                    <ul>
                        <li><i class="fa fa-check"></i> عمولة على كل عملية شراء عبر رابطك</li>
                        <li><i class="fa fa-check"></i> لوحة تحكم خاصة لعرض الأرباح</li>
                        <li><i class="fa fa-check"></i> روابط تتبع خاصة بك</li>
                        <li><i class="fa fa-check"></i> إمكانية طلب سحب الأرباح بسهولة</li>
                    </ul>

                    <form action="{{ route('frontend.become.affiliate.submit') }}" method="POST">
                        @csrf
                        <button type="submit" class="gold-btn">
                            <i class="fa-solid fa-user-plus me-2"></i> تحويل حسابي لمسوق الآن
                        </button>
                    </form>

                    <a href="{{ route('frontend.become.affiliate') }}" class="affiliate-link">
                        <i class="fa-solid fa-handshake me-1"></i> انضم إلى برنامج الشركاء
                    </a>
                </div>
            </div>
        </div>
    </div>

    @include('components.frontend.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
