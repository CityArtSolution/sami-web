<!DOCTYPE html>
<html dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messagess.booking_system') }}</title>
    <link href="https://fonts.cdnfonts.com/css/lama-sans" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/backend.css') }}">
    @if (language_direction() == 'rtl')
        <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
    @endif
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lemonada:wght@300;400;500;600;700&display=swap" rel="stylesheet"> 
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: white;
            color: #333;
        }
        
        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
            display: flex;
            gap: 30px;
        }
        /* Content Area */
        .content {
            flex: 1;
            background: #212121;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Progress Bar */
        .progress-bar {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            margin-bottom: 40px;
            gap: 10px;
        }

        @media (max-width: 768px) {
            .progress-bar {
                flex-wrap: wrap;
            }
        }

        .progress-step {
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            border: 3px solid white;
            color: #979797;
            background: white;
            width: 50px;
            height: 50px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .progress-step.active {
            background: #CF9233;
            /* Green for active step */
            color: white;
        }

        .progress-step.completed {
            background: #CF9233;
            /* Green for completed step */
            color: white;
        }

        /* Optional: Hover effect for clickable steps */
        .progress-step:hover:not(.active):not(.completed) {
            background: #cf923329;
        }

        /* Disable hover and cursor for future steps */
        .progress-step:not(.active):not(.completed) {
            cursor: not-allowed;
        }

        /* Service Grid */
        .service-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 16px;
            padding: 10px;
        }

        .service-card {
            position: relative;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            height: 139px;
        }

        .service-card.selected {
            border: 4px solid #cf9233;
        }

        .service-card h4 {
            font-size: 15px;
            margin: 6px 0 0;
            line-height: 1.3;
        }

        .service-card:hover {
            border: 4px solid #cf9233;
            transform: translateY(-5px);
        }
        .service-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
        }

        .service-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .service-description {
            font-size: 14px;
            color: #666;
            line-height: 1.4;
        }


        /* Service Detail */
        .service-detail {
            display: flex;
            gap: 30px;
            align-items: center;
            margin: 40px 0;
        }

        .service-image {
            width: 300px;
            height: 200px;
            border-radius: 15px;
            background-size: cover;
            background-position: center;
        }

        .service-info {
            flex: 1;
        }

        .service-info h3 {
            font-size: 24px;
            color: #333;
            margin-bottom: 15px;
        }

        .service-info p {
            color: #666;
            line-height: 1.6;
            font-size: 16px;
        }

        /* Location Form */
        .location-form {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            flex: 1;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        .form-group input,
        .form-group select {
            width: 38%;
            font-family: 'Lemonada', sans-serif;
            padding: 8px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
            color:#979797;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #CF9233;
        }

        /* Navigation Buttons */
        .navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            padding-top: 20px;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #CF9233;
            color: white;
        }

        .btn-primary:hover {
            background: #CF9233;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                gap: 20px;
            }


            .service-grid {
                grid-template-columns: 1fr;
            }


            .service-detail {
                flex-direction: column;
            }

            .service-image {
                width: 100%;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }

        /* Hidden class */
        .hidden {
            display: none !important;
        }
        
        .hidden2 {
            display: none ;
        }
        .show {
            display: block !important;
        }

        /* Special styling for massage service cards */
        .massage-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin: 30px 0;
        }

        .massage-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .massage-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(200, 168, 130, 0.2);
        }

        .massage-card.selected {
            box-shadow: gray 0px 0px 13px;
        }

        .massage-name {
            font-size: 18px;
            font-weight: bold;
            color: #CF9233;
            margin-bottom: 10px;
        }

        .massage-location {
            font-size: 14px;
            color: #666;
        }

        .massage-duration {
            font-weight: bold;
            margin-bottom: 10px;
            color: #979797;
            text-align: right;
        }
        
        .massage-price {
            font-size: 16px;
            color: #979797;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: right;
        }
        .most-wanted {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ffc107;
            color: #333;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 10px;
            font-weight: bold;
            transform: rotate(15deg);
        }

        label {
            font-size: 1.08rem;
            color: #bc9a69;
            margin-bottom: 8px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        @media (max-width: 700px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }

            #step1 {
                padding: 18px 6px;
            }
        }

        @media (max-width: 768px) {
            .massage-cards {
                grid-template-columns: none;
            }

        }
        #serviceSearch{
            margin-top: 40px;
            border: 1.5px solid #e2c89c;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 1.1rem;
            margin-bottom: 6px;
            background: #faf8f5;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-shadow: 0 1px 4px #bc9a6920;
        }
        .tooltip-label {
          position: relative;
          cursor: pointer;
        }
        
        .tooltip-text {
          visibility: hidden;
          width: 532px;
          background-color: #333;
          color: #fff;
          text-align: center;
          padding: 5px 8px;
          border-radius: 4px;
          position: absolute;
          bottom: 100%; /* فوق العنصر */
          left: 50%;
          transform: translateX(-50%);
          margin-bottom: 6px;
          opacity: 0;
          transition: opacity 0.3s;
          z-index: 10;
        }
        
        .tooltip-label:hover .tooltip-text {
          visibility: visible;
          opacity: 1;
        }
        h5, .h5 {
            font-size: 15.6px;
        }
        .gap-4 {
            gap: 19.5px !important;
        }
        .line {
            flex: 0.1;
            height: 2px;
            background: #ccc;
        }
        .top-label{
            font-weight: bold;
            font-size: 21px;
            display: block;
            color: black;
            text-align: center;
            background: white;
            padding: 12px;
            box-shadow: gray 0px 1px 9px;
        }
        .sammary-steps{
            width: 100%;
            height: fit-content;
            background: white;
            color:#CF9233;
            gap: 30px;
            padding: 35px;
            border-radius: 14px;
        }
         .selected-card{
        border:2px solid #CF9233;
        }

    
        .scroll-btn {
          color: black;
          border: none;
          padding: 4px 6px;
          border-radius: 4px;
          cursor: pointer;
          flex-shrink: 0;
        }

        .sub-label{
            margin-bottom: 30px;
            color: black;
            font-size: 18px;
        }
        #wifi-loader {
          --background: #62abff;
          --front-color: #cf9233;
          --back-color: #c3c8de;
          --text-color: #414856;
          width: 64px;
          height: 64px;
          border-radius: 50px;
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          z-index: 999999;
          display: flex;
          justify-content: center;
          align-items: center;
        }
        
        #wifi-loader svg {
          position: absolute;
          display: flex;
          justify-content: center;
          align-items: center;
        }
        
        #wifi-loader svg circle {
          position: absolute;
          fill: none;
          stroke-width: 6px;
          stroke-linecap: round;
          stroke-linejoin: round;
          transform: rotate(-100deg);
          transform-origin: center;
        }
        
        #wifi-loader svg circle.back {
          stroke: var(--back-color);
        }
        
        #wifi-loader svg circle.front {
          stroke: var(--front-color);
        }
        
        #wifi-loader svg.circle-outer {
          height: 86px;
          width: 86px;
        }
        
        #wifi-loader svg.circle-outer circle {
          stroke-dasharray: 62.75 188.25;
        }
        
        #wifi-loader svg.circle-outer circle.back {
          animation: circle-outer135 1.8s ease infinite 0.3s;
        }
        
        #wifi-loader svg.circle-outer circle.front {
          animation: circle-outer135 1.8s ease infinite 0.15s;
        }
        
        #wifi-loader svg.circle-middle {
          height: 60px;
          width: 60px;
        }
        
        #wifi-loader svg.circle-middle circle {
          stroke-dasharray: 42.5 127.5;
        }
        
        #wifi-loader svg.circle-middle circle.back {
          animation: circle-middle6123 1.8s ease infinite 0.25s;
        }
        
        #wifi-loader svg.circle-middle circle.front {
          animation: circle-middle6123 1.8s ease infinite 0.1s;
        }
        
        #wifi-loader svg.circle-inner {
          height: 34px;
          width: 34px;
        }
        
        #wifi-loader svg.circle-inner circle {
          stroke-dasharray: 22 66;
        }
        
        #wifi-loader svg.circle-inner circle.back {
          animation: circle-inner162 1.8s ease infinite 0.2s;
        }
        
        #wifi-loader svg.circle-inner circle.front {
          animation: circle-inner162 1.8s ease infinite 0.05s;
        }
        
        #wifi-loader .text {
          position: absolute;
          bottom: -40px;
          display: flex;
          justify-content: center;
          align-items: center;
          text-transform: lowercase;
          font-weight: 500;
          font-size: 14px;
          letter-spacing: 0.2px;
        }
        
        #wifi-loader .text::before, #wifi-loader .text::after {
          content: attr(data-text);
        }
        
        #wifi-loader .text::before {
          color: var(--text-color);
        }
        
        #wifi-loader .text::after {
          color: var(--front-color);
          animation: text-animation76 3.6s ease infinite;
          position: absolute;
          left: 0;
        }
        
        @keyframes circle-outer135 {
          0% {
            stroke-dashoffset: 25;
          }
        
          25% {
            stroke-dashoffset: 0;
          }
        
          65% {
            stroke-dashoffset: 301;
          }
        
          80% {
            stroke-dashoffset: 276;
          }
        
          100% {
            stroke-dashoffset: 276;
          }
        }
        
        @keyframes circle-middle6123 {
          0% {
            stroke-dashoffset: 17;
          }
        
          25% {
            stroke-dashoffset: 0;
          }
        
          65% {
            stroke-dashoffset: 204;
          }
        
          80% {
            stroke-dashoffset: 187;
          }
        
          100% {
            stroke-dashoffset: 187;
          }
        }
        
        @keyframes circle-inner162 {
          0% {
            stroke-dashoffset: 9;
          }
        
          25% {
            stroke-dashoffset: 0;
          }
        
          65% {
            stroke-dashoffset: 106;
          }
        
          80% {
            stroke-dashoffset: 97;
          }
        
          100% {
            stroke-dashoffset: 97;
          }
        }
        
        @keyframes text-animation76 {
          0% {
            clip-path: inset(0 100% 0 0);
          }
        
          50% {
            clip-path: inset(0);
          }
        
          100% {
            clip-path: inset(0 0 0 100%);
          }
        }
        .btn-e {
          display: inline-flex;
          align-items: center;
          justify-content: center;
          gap: 8px;
          padding: 10px 35px;
          font-size: 16px;
          border-radius: 50px;
          border: 2px solid #cc902b;
          cursor: pointer;
          transition: all 0.3s ease;
        }
    
        .btn-outline {
          background: transparent;
          color: #cc902b;
          width: 28%;
          overflow: hidden;
        }
    
        .btn-outline img {
          transition: transform 1s ease;
        }
        
        .btn-outline:hover img {
          transform: translateX(140px);
        }
    
        .btn-filled {
          background: #cc902b;
          color: black;
          width: 28%;
        }
    
        .btn-filled:hover {
          background: #b1791f;
        }
    
        .btn-e i {
          font-style: normal;
        }
        .ti {
            font-size: 27px;
            margin: 30px 0;
            font-weight: bold;
            color: black;
        }
        .total-sunmary{
            width: 100%;
            border: 1px solid #D9D9D9;
            margin: 28px 0;
            padding: 25px;
            display: flex;
            justify-content: space-between;
            font-weight: 600;
            color: #979797;
        }
        .sub-sammary-total{
            color: #CF9233;
        }
        .two-btn{
            display: flex;
            justify-content: space-around;
            margin: 50px 0 0px 0;
        }
        .branch-cards {
          display: grid;
          grid-template-columns: repeat(4, 1fr);
          gap: 20px;
          margin-top: 60px;
        }
        .branch-card {
          background: #fff;
          border-radius: 12px;
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
          overflow: hidden;
          transition: transform 0.3s ease;
          cursor: pointer;
          text-align: center;
          width: 250px; /* تقدر تعدلها */
        }
        
        .branch-card:hover {
          transform: translateY(-5px);
        }
        
        .branch-option input:checked + .branch-image img {
          border: 2px solid #f7931e; /* لون مميز عند التحديد */
        }
        
        .branch-image img {
          width: 100%;
          height: 150px;
          object-fit: cover;
          cursor: pointer;
        }
        
        .branch-info {
          padding: 10px 15px;
        }
        
        .branch-name {
          color: #CF9233;
          font-weight: bold;
          margin-bottom: 5px;
          font-size: 18px;
        }
        
        .branch-address {
          color: #555;
          font-size: 14px;
        }
        .content-form{
            color: white;
            width: 70%;
            margin: auto;
        }
        #recipient_name ,#recipient_mobile{
            height: 40px;
            border-radius: 9px;
            border: none;
        }
        .form-textarea::placeholder {
          color: #CF9233;
        }
        @media (max-width: 576px) {
            .w-100-mob {
                width: 100% !important;
            }
            .branch-cards {
                grid-template-columns: repeat(1, 1fr);
                justify-items: center;
            }
            .sammary-steps {
                grid-template-columns: repeat(1, minmax(250px, 1fr)) !important;
                padding: 0;
                background: #212121;
            }
            .summary-card {
                border: 1px solid #CF9233;
            }
            .content-form {
                width: 100%;
                margin: 0;
            }
            .column-mob{
                flex-direction: column;
            }
        }
        </style>
    <style>
        :root{
          --duration: 3s;               /* مدة الظهور قبل الاختفاء */
          --banner-height: 84px;
          --accent-1: #7C3AED;         /* بنفسجي */
          --accent-2: #06B6D4;         /* سماوي */
          --bg-glass: rgba(255,255,255,0.06);
          --text: #fff;
          --shadow: 0 10px 30px rgba(12,12,30,0.55);
        }
        /* الحاوية: fixed top center */
        .notify-wrap{
          position:fixed;
          inset: 20px auto auto 20px; /* fallback for RTL */
          right: 20px;
          top: 20px;
          z-index:9999;
          display:flex;flex-direction:column;gap:12px;
          pointer-events:none; /* اجعل النقر يمر ما عدا عناصر داخلها */
        }
    
        /* البطاقة الرئيسية */
        .notify{
          --progress: 0%;
          width: min(420px, calc(100% - 40px));
          height: var(--banner-height);
          display:flex;align-items:center;gap:14px;
          padding:14px 16px;
          border-radius:14px;
          background: linear-gradient(135deg, rgba(124,58,237,0.16), rgba(6,182,212,0.08));
          backdrop-filter: blur(8px) saturate(1.1);
          box-shadow: var(--shadow);
          color:var(--text);
          pointer-events:auto;
          overflow:hidden;
          transform-origin: right center;
          /* دخول اسطوري */
          animation: popIn 700ms cubic-bezier(.16,1,.3,1) forwards;
        }
    
        @keyframes popIn{
          0% { transform: translateX(24px) scale(.96) rotateZ(-4deg); opacity:0; filter: blur(6px) }
          60% { transform: translateX(-8px) scale(1.02) rotateZ(2deg); opacity:1; filter: blur(0) }
          100% { transform: translateX(0) scale(1) rotateZ(0); opacity:1; filter: blur(0) }
        }
    
        /* أيقونة */
        .notify .icon{
          min-width:56px;min-height:56px;border-radius:12px;
          display:grid;place-items:center;font-weight:700;
          background: linear-gradient(135deg,var(--accent-1),var(--accent-2));
          box-shadow: 0 6px 18px rgba(6,182,212,0.12), inset 0 -6px 18px rgba(0,0,0,0.12);
          flex-shrink:0;
          transform: translateZ(0);
        }
        .notify .icon svg{width:28px;height:28px;filter:drop-shadow(0 2px 6px rgba(0,0,0,0.12))}
    
        /* النص */
        .notify .content11{
          display:flex;flex-direction:column;gap:4px;flex:1;min-width:0;
        }
        .notify .title11{
          font-size:15px;font-weight:700;letter-spacing:0.2px;
          line-height:1;
        }
        .notify .desc11{
          font-size:13px;opacity:0.92;color:rgba(255,255,255,0.92);
          white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
        }
    
        /* زر الغلق */
        .notify .close{
          margin-inline-start:12px;background:transparent;border:0;color:inherit;
          cursor:pointer;padding:8px;border-radius:10px;flex-shrink:0;
          display:grid;place-items:center;
          opacity:0.95;
        }
        .notify .close:active{transform:scale(.96)}
    
        /* شريط التقدم السفلي */
        .notify .progress{
          position:absolute;left:0;right:0;bottom:0;height:4px;border-radius:0 0 12px 12px;
          overflow:hidden;background:linear-gradient(90deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02));
        }
        .notify .progress > i{
          display:block;height:100%;width:0%;
          background: linear-gradient(90deg,var(--accent-2),var(--accent-1));
          transform-origin:left center;
          /* نستخدم متغير CSS لتشغيل */
          animation: fill var(--duration) linear forwards;
        }
        @keyframes fill{
          from{width:0%}
          to{width:100%}
        }
    
        /* مؤثرات بصرية: جزيئات صغيرة (pseudo elements) */
        .notify::before,
        .notify::after{
          content:"";
          position:absolute;pointer-events:none;
          filter:blur(18px) saturate(1.2);
          mix-blend-mode: screen;opacity:0.9;
        }
        .notify::before{
          width:180px;height:120px;right:-40px;top:-50px;border-radius:40%;
          background: radial-gradient(circle at 30% 30%, rgba(124,58,237,0.9), transparent 30%),
                      radial-gradient(circle at 70% 70%, rgba(6,182,212,0.8), transparent 30%);
          transform: rotate(20deg);
          animation: floatB 6s ease-in-out infinite;
          opacity:0.65;
        }
        .notify::after{
          width:120px;height:70px;left:-30px;bottom:-12px;border-radius:40%;
          background: radial-gradient(circle at 20% 20%, rgba(255,255,255,0.06), transparent 30%);
          animation: floatA 5s ease-in-out infinite;
          opacity:0.28;
        }
        @keyframes floatA{ 0%{transform:translateY(0)}50%{transform:translateY(-8px)}100%{transform:translateY(0)} }
        @keyframes floatB{ 0%{transform:translateY(0) rotate(20deg)}50%{transform:translateY(-10px) rotate(18deg)}100%{transform:translateY(0) rotate(20deg)} }
    
        /* اختفاء سلس بعد انتهاء المدة أو عند الضغط على الغلق */
        .notify.closing{
          animation: popOut 420ms cubic-bezier(.2,.8,.2,1) forwards;
        }
        @keyframes popOut{
          0% { transform: translateY(0) scale(1); opacity:1; filter: blur(0) }
          100% { transform: translateY(-18px) scale(.98); opacity:0; filter: blur(6px) }
        }
    
        /* وضع reduced-motion */
        @media (prefers-reduced-motion: reduce){
          .notify, .notify::before, .notify::after, .notify .progress > i { animation: none !important; transition: none !important; }
        }
    
        /* responsive صغير */
        @media (max-width:420px){
          .notify{ height:76px; border-radius:12px; padding:12px 12px; gap:10px }
          .notify .icon{ min-width:48px; min-height:48px; border-radius:10px }
          .notify .title11{ font-size:14px }
          .notify .desc11{ font-size:12px }
        }
    </style>
</head>

<body dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="{{ app()->getLocale() }}">
    <div class="position-relative" style="height: 17vh;">
        @include('components.frontend.second-navbar')
    </div>
    <!-- Main Container -->
    <div class="container">
          <!-- الحاوية الثابتة -->
        <div class="notify-wrap" aria-live="polite" aria-atomic="true"></div>
        <div id="wifi-loader" style="display:none;">
            <svg class="circle-outer" viewBox="0 0 86 86">
                <circle class="back" cx="43" cy="43" r="40"></circle>
                <circle class="front" cx="43" cy="43" r="40"></circle>
                <circle class="new" cx="43" cy="43" r="40"></circle>
            </svg>
            <svg class="circle-middle" viewBox="0 0 60 60">
                <circle class="back" cx="30" cy="30" r="27"></circle>
                <circle class="front" cx="30" cy="30" r="27"></circle>
            </svg>
            <svg class="circle-inner" viewBox="0 0 34 34">
                <circle class="back" cx="17" cy="17" r="14"></circle>
                <circle class="front" cx="17" cy="17" r="14"></circle>
            </svg>
            <div class="text" data-text="Loading"></div>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Progress Bar -->
            <div class="progress-bar">
                <div class="progress-step active" data-progress-step="1">
                    <i class="fa-solid fa-file-lines"></i>
                </div>
                <div class="line"></div>
                <div class="progress-step " data-progress-step="2">
                    <img style="width: 29px;" src="{{asset('images/icons/home.png')}}">
                </div>
                <div class="line"></div>
                <div class="progress-step" data-progress-step="3">
                    <i class="bi bi-list-ul"></i>
                </div>
                <div class="line"></div>
                <div class="progress-step" data-progress-step="4">
                    <i class="bi bi-credit-card"></i>
                </div>
            </div>
            <!-- Step 1: Form Data -->
            <div id="step1" class="step-content">
                
                <div class="content-form">
                    
                    <div class="column-mob" style="display: flex;gap: 34px;">
                        <div class="d-flex w-100-mob" style="flex-direction: column;gap: 12px;width: 47%;">
                            <lable>{{ __('messagess.recipient_name') }}:</lable>
                            <input id="recipient_name" type="text">
                        </div>
                        <div class="d-flex w-100-mob" style="flex-direction: column;gap: 12px;width: 47%;">
                            <lable>{{ __('messagess.recipient_mobile') }} </lable>
                            <input id="recipient_mobile" type="text">
                        </div>
                    </div>
                    
                    <div>
                        <div class="d-flex" style="flex-direction: column;gap: 12px;width: 100%;">
                            <lable style="margin-top: 15px;">{{ __('messagess.gift_message_from_sender') }}</lable>
                            <textarea id="message" style="height: 140px;" maxlength="500" placeholder="{{ __('messagess.friend_greeting') }}"></textarea>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            <!-- Step 2: Location -->
            <div id="step2" class="step-content">
                <div class="location-form">
                    <div class="form-group">
                        <label class="top-label"> {{ __('messagess.select_branch') }} </label>
                        <br>
                        <select class="w-100-mob" name="State">
                            @foreach($States as $State)
                            <option value="{{$State->id}}">{{$State->name}}</option>
                            @endforeach
                        </select>
                        <div class="branch-cards">
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- Step 3: Service & massage -->
            <div id="step3" class="step-content hidden">
                <label class="top-label" style="width: 58%;margin: auto;"> {{ __('messagess.select_service_to_book') }} </label>
                <br>
                <div class="service-grid">

                </div>
                <div class="massage-cards">

                </div>
                <div class="sammary-steps"></div>
            </div>
            <!-- Step 4:  Payment Selection -->
            <div id="step4" class="step-content hidden">
                <div class="booking-payment">
                    <x-frontend.payment 
                        :items-count="1" 
                        :total-price="-1"
                        page-name="gift"
                    />
                </div>
            </div>
            
            <div class="step-content hidden2" id="summaryCard">

            </div>
            <!-- Navigation -->
            <div class="navigation">
                <button class="btn btn-secondary" id="prevBtn" disabled>{{ __('messagess.previous') }}</button>
                <button class="btn btn-primary" id="nextBtn">{{ __('messagess.next') }}</button>
            </div>
        </div>
    </div>
    <div class="position-relative" style="height: 17vh;"></div>
    <!-- Footer -->
    @include('components.frontend.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        const translations = { next: "{{ __('messagess.next') }}", complete: "{{ __('messagess.complete') }}"};
        
        // Application State
        let currentStep = 1;
        let maxSteps = 4; 
        
        let selectedData = {
            branch: null,
            branchName: null,
            services: []    
        };
        
        let fanaltotal = 0; 
        
        const summaryCard = document.getElementById('summaryCard');

        // DOM Elements
        const steps = document.querySelectorAll('.step');
        const stepContents = document.querySelectorAll('.step-content');
        const progressSteps = document.querySelectorAll('.progress-step');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const currentLang = "{{ app()->getLocale() }}";


        function initializeApp() {
            updateUI();
            setupEventListeners();
            setupAutoNavigation();
        }

        function updateUI() {
            // Update progress bar
            progressSteps.forEach((step, index) => {
                const stepNumber = parseInt(step.dataset.progressStep);
                step.classList.remove('active', 'completed');

                if (stepNumber < currentStep) {
                    step.classList.add('completed');
                } else if (stepNumber === currentStep) {
                    step.classList.add('active');
                }
            });

            // Update step content
            stepContents.forEach((content, index) => {
                content.classList.toggle('hidden', index + 1 !== currentStep);
            });

            // Update navigation buttons
            prevBtn.disabled = currentStep === 1;
            nextBtn.textContent = currentStep === maxSteps ? translations.complete : translations.next;
        }

        // Add this to your setupEventListeners() function
        document.querySelectorAll('.progress-step').forEach((step, index) => {
            step.addEventListener('click', () => {
                if (index + 1 <= currentStep || index === 0) {
                    currentStep = index + 1;
                    updateUI();
                }
            });
        });

        function setupEventListeners() {
            // Navigation buttons
            prevBtn.addEventListener('click', () => {
                if (currentStep > 1) {
                    currentStep--;
                    updateUI();
                }
            });

            nextBtn.addEventListener('click', () => {
                if (validateCurrentStep()) {
                    if (currentStep < maxSteps) {
                        currentStep++;
                        updateUI();
                    } else {
                        // completeBooking();
                    }
                }
            });
        }
        
        function showLoader() {
            document.getElementById("wifi-loader").style.display = "flex";
        }
        
        function hideLoader() {
            document.getElementById("wifi-loader").style.display = "none";
        }

        function fetchbranch(cityId) {
            showLoader();
            fetch(`/branchs/${cityId}`)
                .then(response => response.json())
                .then(data => {
                    const branchsContainer = document.querySelector('.branch-cards');
                    branchsContainer.innerHTML = '';

                    const lang = typeof currentLang !== 'undefined' ? currentLang : 'en';

                    const homeServiceCard = document.createElement('div');
                    homeServiceCard.className = "branch-card";
                    homeServiceCard.innerHTML = `
                        <label class="branch-option">
                            <input type="radio" name="branch" value="0" hidden>
        
                            <div class="branch-image">
                                <img src="img/default.png" alt="${lang === 'ar' ? 'الخدمات المنزلية' : 'Home Servies'} " /> 
                            </div>
                                                
                            <div class="branch-info">
                                <h5 class="branch-name">${lang === 'ar' ? 'الخدمات المنزلية' : 'Home Servies'} </h5>
                            </div>
                        </label>
                    `;
        
                    homeServiceCard.addEventListener('click', () => {
                        document.querySelectorAll('.branch-card').forEach(c => c.classList.remove('selected'));
                        homeServiceCard.classList.add('selected');
                        selectedData = {
                            branch: null,
                            branchName: null,
                            services: []    
                        };
                        selectedData.branch = 0;
                        selectedData.branchName = lang === "ar" ? "الخدمات المنزلية" : "Home Servies";
                        setTimeout(() => {
                            if (currentStep === 1 && validateCurrentStep()) {
                                currentStep = 2;
                                updateUI();
                                fetchServiceGroups();
                            }
                        }, 300);
                    });
        
                    branchsContainer.appendChild(homeServiceCard);

                    data.forEach(branch => {
                        const card = document.createElement('div');
                        card.className = "branch-card";
                        
                        card.innerHTML = `
                          <label class="branch-option">
                            <input type="radio" name="branch" value="${branch.id}" hidden>
                        
                            <div class="branch-image">
                              <img src="images/pages/0816429f6ddfdf5ca93506cd2d847214ae465b20.jpg" alt="فرع" />
                            </div>
                        
                            <div class="branch-info">
                              <h5 class="branch-name">${branch.name[lang]}</h5>
                              <p style="font-size: 11px;margin-top: 15px;font-weight: 600;">${branch.description}</p>
                            </div>
                          </label>
                        `;
                            
                        card.addEventListener('click', (e) => {
                            document.querySelectorAll('.branch-card').forEach(c => c.classList.remove('selected'));
                            card.classList.add('selected');
                            selectedData = {
                                branch: null,
                                branchName: null,
                                services: []    
                            };
                            selectedData.branch = branch.id;
                            selectedData.branchName = branch.name[lang];
                            setTimeout(() => {
                                if (currentStep === 2 && validateCurrentStep()) {
                                    currentStep = 3;
                                    updateUI();
                                    fetchServiceGroups();
                                }
                            }, 300);
                        });
                        branchsContainer.appendChild(card);
                    });
                    hideLoader()
                })
                .catch(error => {
                    console.error('Error fetching services:', error);
                       hideLoader()
                });
        }
        
        function fetchServiceGroups() {
            showLoader();
            fetch(`/service-groups`)
                .then(response => response.json())
                .then(data => {
                    const serviceGrid = document.querySelector('.service-grid');
                    serviceGrid.innerHTML = '';
                    const lang = typeof currentLang !== 'undefined' ? currentLang : 'en';

                    data.forEach(service => {
                        let serviceName = '';
                        try {
                            const parsedName = JSON.parse(service.name);
                            serviceName = parsedName[lang] || parsedName['en'];
                        } catch (e) {
                            serviceName = service.name;
                        }

                        const card = document.createElement('div');
                        const serch = document.createElement('div');
                        card.className = 'service-card';
                        card.dataset.service = service.id;
                        card.innerHTML = `
                            <img src="${service.av2}" alt="${serviceName}" style="position: absolute;width: 100%;height: 100%;border-radius: 6px;"">
                            <h4>${serviceName}</h4>`;
                            
                        card.addEventListener('click', () => {
                        document.querySelectorAll('.service-card').forEach(c => c.classList.remove('selected'));
                        card.classList.add('selected');
                        const exists = selectedData.services.some(s => s.id === service.id);
                        if (!exists) {
                            selectedData.services.push({
                                id: service.id,
                                name: serviceName,
                                image: service.av2
                            });
                        }
                        fetchServicesByGroup(service.id);
                    });
                        serviceGrid.appendChild(card);
                    });
                    hideLoader();
                })
                .catch(error => {
                    console.error('Error fetching services:', error);
                    hideLoader();
                });
        }

        function fetchServicesByGroup(serviceGroupId) {
            showLoader();
            fetch(`/services/${serviceGroupId}/${selectedData.branch}/bookings`)
                .then(response => response.json())
                .then(data => {
                    const massageContainer = document.querySelector('.massage-cards');
                    massageContainer.innerHTML = '';
                    const lang = typeof currentLang !== 'undefined' ? currentLang : 'en';

                    if (!document.querySelector('#serviceSearch')) {
                        const searchWrapper = document.createElement('div');
                        searchWrapper.className = 'search-box';
        
                        const searchInput = document.createElement('input');
                        searchInput.type = 'text';
                        searchInput.id = 'serviceSearch';
                        searchInput.placeholder = lang === 'ar' ? 'ابحث عن الخدمة...' : 'Search service...';
        
                        searchWrapper.appendChild(searchInput);
                        massageContainer.parentNode.insertBefore(searchWrapper, massageContainer);
        
                        // حدث البحث
                        searchInput.addEventListener('input', function () {
                            const query = this.value.toLowerCase();
                            document.querySelectorAll('.massage-card').forEach(card => {
                                const name = card.querySelector('.massage-name').textContent.toLowerCase();
                                card.style.display = name.includes(query) ? 'block' : 'none';
                            });
                        });
                    }
            
                    data.forEach(service => {
                        let serviceName = '';
                        let serviceLocation = '';
                        
                        if (typeof service.name === 'object') {
                            serviceName = service.name[lang] || service.name['en'];
                        } else {
                            try {
                                const parsedName = JSON.parse(service.name);
                                serviceName = parsedName[lang] || parsedName['en'];
                            } catch (e) {
                                serviceName = service.name;
                            }
                        }

                        try {
                            const parsedLocation = JSON.parse(service.location);
                            serviceLocation = parsedLocation[lang] || parsedLocation['en'];
                        } catch (e) {
                            serviceLocation = service.location;
                        }

                        const card = document.createElement('div');
                        card.className = 'massage-card';
                        card.dataset.massage = service.id;
                        card.dataset.main = serviceGroupId;

                        card.innerHTML = `
                            ${service.mostWanted ? `<div class="most-wanted">MOST WANTED</div>` : ''}
                            <div class="massage-name">${serviceName}</div>
                            ${service.description[lang] ? `
                                <div class="massage-location">
                                    <label style="font-size:16px;color: gray;line-height: 1.5;font-style: normal;" class="tooltip-label">
                                        ${lang === 'ar' ? 'الوصف' : 'Description'} 
                                        <i class="fas fa-question-circle"></i>
                                        <span class="tooltip-text">${service.description[lang]}</span>
                                    </label>
                                </div>` : ""}
                            <div class="massage-duration"> <span style="font-weight: 200;"> ${lang === 'ar' ? 'مدة الجلسة :' : 'Session Duration:'} </span> ${service.duration_min} ${lang === 'ar' ? 'دقائق' : 'Minutes'}</div>
                            <div class="massage-price"> <span style="font-weight: 200;"> ${lang === 'ar' ? 'السعر :' : 'price :'} </span>${parseInt(service.default_price)} ${lang === 'ar' ? 'ريال' : 'SAR'}</div>
                        `;
                        card.addEventListener('click', (e) => {
                            if (e.target.classList.contains('massage-book-btn')) return;
                            card.classList.toggle('selected');
                            let parentGroup = selectedData.services.find(s => s.id == serviceGroupId);
                            if (parentGroup) {
                                if (!parentGroup.subServices) {
                                    parentGroup.subServices = [];
                                }
                                const exists = parentGroup.subServices.find(sub => sub.id == service.id);
                                if (exists) {
                                    parentGroup.subServices = parentGroup.subServices.filter(sub => sub.id != service.id);
                                    updateSummarySteps();
                                    console.log(selectedData)
                                    fanaltotal = selectedData.services.reduce((sum, service) => {
                                        const subTotal = service.subServices.reduce((subSum, sub) => subSum + sub.price, 0);
                                        return sum + subTotal;
                                    }, 0);
                                } else {
                                    parentGroup.subServices.push({
                                        id: service.id,
                                        name: serviceName,
                                        duration: service.duration_min,
                                        price: parseInt(service.default_price)
                                    });
                                    
                                    fanaltotal = selectedData.services.reduce((sum, service) => {
                                        const subTotal = service.subServices.reduce((subSum, sub) => subSum + sub.price, 0);
                                        return sum + subTotal;
                                    }, 0);
                                    updateSummarySteps();
                                }
                            }
                        });
                        massageContainer.appendChild(card);
                    });
                    hideLoader();
                })
                .catch(error => {
                    console.error('Error fetching services:', error);
                    hideLoader();
                });
        }

        function updateSummarySteps() {
            const summaryContainers = document.querySelectorAll('.sammary-steps');
            summaryContainers.forEach(summaryContainer => {
                summaryContainer.innerHTML = '';
            
                summaryContainer.style.display = "grid";
                summaryContainer.style.gridTemplateColumns = "repeat(3, minmax(250px, 1fr))";
                summaryContainer.style.gap = "15px";
        
                if (!selectedData.services || selectedData.services.length === 0) {
                    summaryContainer.innerHTML = '<p style="color: gray;">لم يتم اختيار أي خدمات بعد</p>';
                    return;
                }
        
                selectedData.services.forEach(service => {
                    if (service.subServices && service.subServices.length > 0) {
                        service.subServices.forEach(sub => {
                            const card = document.createElement('div');
                            card.className = 'summary-card';
                            card.style.cssText = `border-radius:10px;padding:20px;background:#fff;cursor:pointer;transition:0.2s ease-in-out;background: #212121;
                            `;
                            
                            card.onmouseenter = () => card.style.boxShadow = "0 4px 10px rgba(0,0,0,0.1)";
                            card.onmouseleave = () => card.style.boxShadow = "none";
                            
                            const header = `
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                                    <div>
                                        <strong style="font-size:16px;">${service.name}</strong>
                                        <p style="margin:5px 0 0; font-size:14px;">${sub.name}</p>
                                    </div>
                                    <img src="${service.image || 'https://via.placeholder.com/60'}" 
                                         alt="${service.name}" 
                                         style="width:60px; height:60px; border-radius:8px; object-fit:cover;">
                                </div>
                            `;
        
                            const details = `
                                <div style="margin-top:10px;">
                                    <label style="font-size:13px;">الموظف:</label>
                                    <input class="form-textarea" type="text" value="${sub.staffName || ''}"  disabled placeholder="الموظف" 
                                           style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:6px;">
                                    
                                    <div style="display:flex; flex-direction:row-reverse; justify-content:flex-end; gap:6px;">
                                        <input type="date" value="${sub.date || ''}" disabled 
                                               style="flex:1; padding:8px; border:1px solid #ccc; border-radius:6px;color: #CF9233;">
                                        <input type="time"  value="${sub.time || ''}" disabled 
                                               style="flex:1; padding:8px; border:1px solid #ccc; border-radius:6px;color: #CF9233;">
                                    </div>
        
                                    <div style="text-align:right; font-weight:bold; color:#a36b2c; margin-top:8px;">
                                        السعر: ${sub.price || 0} ريال
                                    </div>
                                </div>
                            `;
        
                            card.innerHTML = header + details;
    
                            summaryContainer.appendChild(card);
                        });
                    }
                });
            });
        }
        
        function completeBooking() {
            createNotify({ title: 'ملحوظة', desc: "سيختار مستلم الهدية الوقت والتاريخ المناسبين له بعد اختيار الموظف المراد ان يؤدي الخدمات "  });
            // upadate varables
            
        }


        function setupAutoNavigation() {
        document.querySelectorAll('.progress-step').forEach(step => {
                step.addEventListener('click', () => {
                    const targetStep = parseInt(step.dataset.progressStep);
                    if (targetStep <= currentStep || targetStep === 1) {
                        currentStep = targetStep;
                        updateUI();
                    }
                });
            });

        // عند اختيار المدينة
        document.querySelectorAll('select[name="State"]').forEach(radio => {
                radio.addEventListener('change', (e) => {
                    const stateId = e.target.value;
                    fetchbranch(stateId);
                });
            });
        }
        
        function validateCurrentStep() {
            switch (currentStep) {
                case 1:
                    const recipient_name = document.getElementById('recipient_name').value;
                    const recipient_mobile = document.getElementById('recipient_mobile').value;
                    const message = document.getElementById('message').value;
    
                    if (!recipient_name || !recipient_mobile || !message) {
                        alert('Please fill in all Form details');
                        return false;
                    }
                    selectedData.location = { recipient_name, recipient_mobile, message };
                    break;
                case 2:
                    const selectedBranch = document.querySelector('input[name="branch"]:checked');
                    if (!selectedBranch) {
                        alert('{{ __("messagess.please_select_branch") }}');
                        return false;
                    }
                    console.log(selectedData);
                    break;
                case 3:
                    if (!selectedData.services || selectedData.services.length === 0) {
                        alert('Please select at least one service');
                        return false;
                    }
                    completeBooking()
                    document.querySelector('.content').style.background = "white";
                    break;
                case 4:
                    nextBtn.textContent = translations.complete;
                    break;
            }
            return true;
        }
        // Initialize the application
        document.addEventListener('DOMContentLoaded', initializeApp);

        // About Payment
            function checkInvoiceCoupon(button) {
            const input = document.getElementById('invoiceCouponInput');
            const couponCode = input.value.trim();
            
            if (!couponCode) {
                toastr.error("{{ __('messagess.enter_coupon_code') }}");
                return;
            }
            
            const url = `/validate-invoice-coupon?coupon_code=${encodeURIComponent(couponCode)}`;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.valid) {
                        toastr.success("{{ __('messagess.coupon_applied') }}: " + couponCode);
                        let totalBeforeDiscount = "500";
                        let discount = parseFloat(data.discount_amount) || 0;
    
                        totalBeforeDiscount -= discount;
                        if (totalBeforeDiscount < 0) totalBeforeDiscount = 0;
                        const totalEl = document.getElementById('totalPrice').innerHTML = totalBeforeDiscount +  " {{ __('messagess.SR') }}" ;
            
                        input.disabled = true;
                        button.disabled = true;
                        button.classList.add('disabled');
                        
                        // const summary = document.querySelector('.summary-section');
                        // const discountInfo = document.createElement('div');
                        // discountInfo.className = 'invoice-discount mt-2 text-success fw-bold';
                        // discountInfo.innerText = `- ${discount} SR {{ __('messagess.discount') }}`;
                        // summary.appendChild(discountInfo);
                    } else {
                        toastr.error("{{ __('messagess.invalid_coupon') }}");
                    }
                })
                .catch(() => { toastr.error("{{ __('messagess.error_occurred') }}"); });
        }
    </script>
    <script>
    const DURATION_MS = 5000;
    const wrap = document.querySelector('.notify-wrap');

    function createNotify({ title = '', desc = '', autoplay = true } = {}) {
      // العنصر
      const el = document.createElement('div');
      el.className = 'notify';
      el.setAttribute('role','status');
      el.innerHTML = `
        <div class="icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" style="width:28px;height:28px">
            <path d="M20 6L9 17l-5-5"></path>
          </svg>
        </div>
        <div class="content11">
          <div class="title11">${escapeHtml(title)}</div>
          <div class="desc11">${escapeHtml(desc)}</div>
        </div>
        <button class="close" aria-label="إغلاق الإشعار">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6L6 18M6 6l12 12"/>
          </svg>
        </button>
        <div class="progress"><i></i></div>
      `;

      wrap.appendChild(el);

      const closeBtn = el.querySelector('.close');
      let closed = false;
      closeBtn.addEventListener('click', () => hide(el));

      let timer = null;
      if (autoplay) {
        const bar = el.querySelector('.progress > i');
        bar.style.animation = 'none';
        void bar.offsetWidth;
        bar.style.animation = `fill ${DURATION_MS}ms linear forwards`;

        timer = setTimeout(() => hide(el), DURATION_MS);
      }

      function hide(target){
        if (closed) return;
        closed = true;
        target.classList.add('closing');
        setTimeout(() => {
          if (wrap.contains(target)) wrap.removeChild(target);
        }, 480);
        if (timer) clearTimeout(timer);
      }

      return { el, hide: () => hide(el) };
    }

    function escapeHtml(str) {
      if (typeof str !== 'string') return '';
      return str.replace(/[&<>"'`=\/]/g, function(s) {
        return ({
          '&': '&amp;',
          '<': '&lt;',
          '>': '&gt;',
          '"': '&quot;',
          "'": '&#39;',
          '/': '&#x2F;',
          '`': '&#x60;',
          '=': '&#x3D;'
        })[s];
      });
    }
    
    function shownav(){
        createNotify({ title: 'تنبية', desc: 'يرجي تسجيل الدخول للاستفادة من هذه الميزة' });
    }
</script>

</body>

</html>
