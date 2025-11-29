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
        /* CSS Variables for Global Styling */
        :root {
            --primary-gold: #CF9233;
            --dark-gold: #B67A24;
            --background-color: #F8F8F8;
            --card-background: #FFFFFF;
            --shadow-light: rgba(0, 0, 0, 0.05);
            --shadow-medium: rgba(0, 0, 0, 0.1);
            --transition-speed: 0.4s;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--background-color);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #333; /* لون نص أساسي داكن */
        }

        .container-page {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 15px;
        }

        /* --- Global Card Styling --- */
        .sub-container {
            position: relative;
            max-width: 900px; /* جعل الحاوية أصغر وأكثر تركيزاً */
            width: 100%;
            background: var(--card-background);
            border-radius: 25px; /* حواف أكثر دائرية */
            overflow: hidden;
            box-shadow: 0 15px 45px var(--shadow-light); /* ظل ناعم كأنه يطفو */
            transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
            display: flex;
            flex-direction: column; /* ليكون المحتوى داخله عموديًا */
        }

        .sub-container:hover {
            transform: translateY(-10px); /* تأثير الطفو أقوى */
            box-shadow: 0 25px 60px var(--shadow-medium);
        }

        /* --- Header/Style Box Enhancement --- */
        .style-header {
            width: 100%;
            padding: 40px 30px;
            background: linear-gradient(150deg, var(--primary-gold) 0%, var(--dark-gold) 100%);
            color: #fff;
            text-align: center;
            border-bottom: 5px solid rgba(255, 255, 255, 0.2); /* فاصل جمالي */
        }

        .style-header h2 {
            font-size: 36px;
            font-weight: 900;
            margin-bottom: 5px;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .style-header p {
            font-size: 18px;
            opacity: 0.9;
        }


        /* --- Content Area --- */
        .content {
            padding: 40px 30px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .section {
            max-width: 600px; /* لتركيز المحتوى في المنتصف */
            width: 100%;
            text-align: right;
        }

        .section h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--dark-gold);
            border-bottom: 2px solid var(--primary-gold);
            padding-bottom: 10px;
            display: inline-block;
        }

        .section ul {
            list-style: none;
            padding: 0;
            margin-bottom: 35px;
        }

        .section ul li {
            margin-bottom: 15px;
            font-size: 17px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.2s ease;
            padding: 5px 10px;
            border-radius: 8px;
            color: #555;
        }

        .section ul li:hover {
            background-color: #fff7e6; /* خلفية خفيفة عند التمرير */
            transform: translateX(-5px);
        }


        .section ul li i {
            color: var(--primary-gold);
            font-size: 22px;
            min-width: 25px;
        }

        /* --- Button Styling --- */
        .gold-btn {
            background: linear-gradient(45deg, var(--primary-gold), var(--dark-gold));
            border-radius: 12px; /* جعل الحواف أقل دائرية لتكون عصرية */
            padding: 16px 30px;
            border: none;
            color: #fff;
            font-size: 20px;
            font-weight: 700;
            transition: all var(--transition-speed) cubic-bezier(0.165, 0.84, 0.44, 1);
            width: 100%;
            margin-top: 20px;
            box-shadow: 0 10px 20px rgba(191, 147, 51, 0.3);
            text-transform: uppercase;
        }

        .gold-btn:hover {
            background: linear-gradient(45deg, var(--dark-gold), var(--primary-gold));
            color:#fff;
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 15px 30px rgba(191, 147, 51, 0.5);
            cursor: pointer;
        }

        /* --- Secondary Link Styling --- */
        .affiliate-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 25px;
            color: var(--dark-gold);
            font-weight: 600;
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .affiliate-link:hover {
            color: var(--primary-gold);
            transform: scale(1.05);
        }

        /* --- Mobile Adjustments --- */
        @media (max-width: 768px) {
            .sub-container {
                border-radius: 15px;
                max-width: 95%;
            }
            .style-header h2 { font-size: 30px; }
            .style-header p { font-size: 16px; }
            .content { padding: 30px 20px; }
            .section h3 { font-size: 22px; }
            .section ul li { font-size: 16px; }
            .gold-btn { font-size: 18px; padding: 14px 25px; }
        }
    </style>
</head>

<body>
    @include('components.frontend.progress-bar')

    <header>
        <div class="position-relative" style="height: 17vh;">
            @include('components.frontend.second-navbar')
        </div>
    </header>

    <main class="container-page">
        <div class="sub-container">
            <div class="style-header">
                <h2>انضم لبرنامج التسويق بالعمولة</h2>
                <p>اربح عمولة تصل إلى 20% على كل عملية شراء تتم عبر رابطك الخاص</p>
            </div>

            <div class="content">
                <div class="section">
                    <h3>💎 مميزات الانضمام إلى شركائنا:</h3>
                    <ul>
                        <li><i class="fa fa-chart-line"></i> **عمولة تنافسية:** احصل على أعلى نسبة عمولة في السوق مقابل كل تحويل ناجح.</li>
                        <li><i class="fa fa-user-shield"></i> **دعم متواصل:** فريق مخصص لمساعدتك في الترويج والإجابة على استفساراتك.</li>
                        <li><i class="fa fa-tachometer-alt"></i> **لوحة تحكم احترافية:** تتبع نقراتك، مبيعاتك، وأرباحك لحظة بلحظة وبكل شفافية.</li>
                        <li><i class="fa fa-money-check-alt"></i> **مدفوعات سريعة:** إمكانية طلب وسحب الأرباح بسهولة ومرونة فائقة.</li>
                        <li><i class="fa fa-bullhorn"></i> **مواد تسويقية جاهزة:** وفرنا لك كل الأدوات والبانرات اللازمة للبدء فوراً.</li>
                    </ul>

                    <form action="{{ route('frontend.become.affiliate.submit') }}" method="POST">
                        @csrf
                        <button type="submit" class="gold-btn">
                            <i class="fa-solid fa-rocket me-2"></i> تفعيل حساب التسويق بالعمولة الآن
                        </button>
                    </form>

                    <div class="text-center">
                        <a href="{{ route('frontend.become.affiliate') }}" class="affiliate-link">
                            <i class="fa-solid fa-handshake-angle"></i> هل أنت شركة أو مؤثر كبير؟ انضم إلى برنامج الشركاء.
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('components.frontend.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
