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
            background: #F8F8F8;
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

        /* Gender Selection */
        .gender-selection {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin: 50px 0;
        }

        .gender-card {
            background: rgba(224, 247, 250, 0.5);
            border: 2px solid transparent;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 200px;
        }

        .gender-card:hover {
            border-color: #C8A882;
            transform: translateY(-5px);
        }

        .gender-card.selected {
            border-color: #C8A882;
            background: rgba(200, 168, 130, 0.1);
        }

        .gender-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
        }

        .gender-icon.male {
            background: linear-gradient(135deg, #4a90e2, #7b68ee);
        }

        .gender-icon.female {
            background: linear-gradient(135deg, #ff6b9d, #c44569);
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

        /* Staff Selection */
        .staff-grid {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 40px 0;
            flex-wrap: wrap;
        }

        .staff-card {
            background: rgba(224, 247, 250, 0.3);
            border: 2px solid transparent;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 200px;
        }

        .staff-card:hover {
            border-color: #C8A882;
            transform: translateY(-5px);
        }

        .staff-card.selected {
            border-color: #C8A882;
            background: rgba(200, 168, 130, 0.1);
        }

        .staff-avatar {
            width: 100px;
            height: 100px;
            margin: 0 auto 15px;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
            border: 4px solid white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .staff-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        /* Time Slots */
        .time-slots {
            margin-top: 30px;
        }

        .time-period {
            margin-bottom: 20px;
        }

        .time-period-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #666;
        }

        .time-grid {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .time-slot {
            padding: 8px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .time-slot:hover {
            border-color: #C8A882;
        }

        .time-slot.selected {
            background: #C8A882;
            color: white;
            border-color: #C8A882;
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
            border-color: #C8A882;
        }

        /* Navigation Buttons */
        .navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
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

            .gender-selection {
                flex-direction: column;
                gap: 20px;
                align-items: center;
            }

            .service-grid {
                grid-template-columns: 1fr;
            }

            .staff-grid {
                flex-direction: column;
                align-items: center;
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

        #staffGrid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .staff-card {
            background: #f1f1f1;
            border-radius: 8px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
        }

        .staff-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin: 0 auto 8px;
        }

        .branch-options input[type="radio"]:checked+img {
            border-color: #007bff;
            box-shadow: 0 0 5px #007bff;
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

        .logo a img {
            height: 60px;
            width: auto;
            border-radius: 12px;
            object-fit: contain;
        }

        .header-title h2 {
            font-size: 2.2rem;
            color: #a8834b;
            font-weight: bold;
            letter-spacing: 1.5px;
            margin: 0;
        }

        @media (max-width: 768px) {
            .logo a img {
                height: 30px;
            }

            .header-title h2 {
                font-size: 17px;
            }

            .massage-cards {
                grid-template-columns: none;
            }

            #staffGrid {
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
            border-radius: 14px;
        }
         .selected-card{
        border:2px solid #CF9233;
        }
        .calendar {
            width: 400px;
            background: white;
            padding: 13px;
            border-radius: 15px;
        }
        .calendar-header {
          display: flex;
          justify-content: space-between;
          align-items: center;
          margin-bottom: 40px;
        }

        .calendar-header button {
          color: black;
          border: none;
          padding: 4px 8px;
          border-radius: 4px;
          cursor: pointer;
        }

        .calendar-title {
          color: #cf9233;
          font-weight: bold;
        }
    
        .scroll-btn {
          color: black;
          border: none;
          padding: 4px 6px;
          border-radius: 4px;
          cursor: pointer;
          flex-shrink: 0;
        }
        .calendar-day {
            text-align: center;
            padding: 6px;
            font-size: 13px;
            border-radius: 9px;
            overflow: auto;
            height: 52px;
            flex-direction: column;
        }
        
        .calendar-day.selected {
            background: #cf9233;
            color:white;
            font-weight: bold;
        }

        .calendar-day.disabled {
          background: #e0e0e0;
          color: #aaa;
          cursor: not-allowed;
        }
        .calendar-days{
            display: flex;
            width: fit-content;
            gap: 6px;
            cursor: pointer;
        }
        .calen , .times{
            width: 50%;
        }
        .sub-label{
            margin-bottom: 30px;
            color: black;
            font-size: 18px;
        }
        .time-toggle {
          display: flex;
          border: 1px solid #ccc;
          border-radius: 25px;
          overflow: hidden;
          margin-bottom: 10px;
          width: 50%;
          background: #D9D9D9;
        }
        
        .time-toggle button {
          flex: 1;
          padding: 5px 0;
          border: none;
          background: #f0f0f0;
          cursor: pointer;
        }
        
        .time-toggle button.active {
          white-space: nowrap;
          padding: 9px;
          border-radius: 19px;
          background: #fff;
          font-weight: bold;
        }
        
        .times button {
          margin: 5px;
          padding: 5px 10px;
          background: #D9D9D9;
          cursor: pointer;
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
            }
            .summary-card {
                border: 1px solid #CF9233;
            }
            .sub-label {
                display: none;
            }
            .Date-Time-Mob {
                flex-direction: column;
            }
            .calen, .times {
                width: 100%;
            }
            .calendar {
                width: 100%;
            }
            .time-toggle {
                width: 100%;
            }
            .btn-filled {
                width: fit-content;
            }
            .btn-outline {
                width: fit-content;
            }
            .two-btn {
                width: 108%;
            }
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
                    <img style="width: 29px;" src="{{asset('images/icons/home.png')}}">
                </div>
                <div class="line"></div>
                <div class="progress-step" data-progress-step="2">
                    <i class="bi bi-list-ul"></i>
                </div>
                <div class="line"></div>
                <div class="progress-step" data-progress-step="3">
                    <i class="bi bi-person"></i>
                </div>
                <div class="line"></div>
                <div class="progress-step" data-progress-step="4">
                    <i class="bi bi-calendar"></i>
                </div>
                <div class="line"></div>
                <div class="progress-step" data-progress-step="5">
                    <i class="bi bi-credit-card"></i>
                </div>
            </div>
            <!-- Step 1: Location -->
            <div id="step1" class="step-content">
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
            <!-- Step 2: Service & massage -->
            <div id="step2" class="step-content hidden">
                <label class="top-label" style="width: 58%;margin: auto;"> {{ __('messagess.select_service_to_book') }} </label>
                <br>
                <div class="service-grid">

                </div>
                <div class="massage-cards">

                </div>
                <div class="sammary-steps"></div>
            </div>
            <!-- Step 3: Staff Selection -->
            <div id="step3" class="step-content hidden">
                <label class="top-label" style="width: 58%;margin: auto;"> {{ __('messagess.select_service_provider') }} </label>
                <br>
                <div class="sammary-steps"></div>
                <div id="staffGrid" class="staff-grid">

                </div>
            </div>
            <!-- Step 4: Date & Time Selection -->
            <div id="step4" class="step-content hidden">
                <label class="top-label" style="width: 58%;margin: auto;"> {{ __('messagess.select_time_and_date_for_services') }} </label>
                <div class="sammary-steps" style="margin: 40px 0;"></div>
                <div class="Date-Time-Mob" style="display: flex;justify-content: space-between;">
                    <div class="calen">
                        <label class="sub-label"> {{ __('messagess.select_preferred_day') }} </label>
                        <div class="calendar">
                            <div class="calendar-header">
                                <button class="calendar-nav" id="prevMonth">‹</button>
                                <div class="calendar-title" id="calendarTitle">{{ __('messagess.month_title') }}</div>
                                <button class="calendar-nav" id="nextMonth">›</button>
                            </div>
                            <div style="overflow: auto;">
                                <div class="calendar-days" id="calendarDays">
                                    <!-- Calendar days will be generated by JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="times">
                        <label class="sub-label"> {{ __('messagess.select_preferred_time') }} </label>
                        <div class="time-slots">
                            <div class="time-period">
                                <div class="time-toggle">
                                  <button id="morningBtn" class="active">{{ __('messagess.morning') }}</button>
                                  <button id="eveningBtn">{{ __('messagess.afternoon') }}</button>
                                </div>
                                {{-- قبل الظهر --}}
                                <div class="time-section" id="morning-section">
                                    <div class="time-grid" id="morning-grid"></div>
                                </div>
    
                                {{-- بعد الظهر --}}
                                <div class="time-section mt-4" id="afternoon-section">
                                    <div class="time-grid" id="afternoon-grid"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Step 5:  Payment Selection -->
            <div id="step5" class="step-content hidden">
                <div class="booking-payment">
                    
                </div>
            </div>
            
            <div class="step-content hidden2" id="summaryCard" style="height: 800px;">

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
    <script>
        const translations = { next: "{{ __('messagess.next') }}", complete: "{{ __('messagess.complete') }}"};
        
        // Application State
        let currentStep = 1;
        let maxSteps = 5; 
        
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
        let activeSubId = null;
        let activeStaffId = null;

        // Initialize Calendar
        let currentDate = new Date();
        let selectedDate = null;
        
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

        const morningBtn = document.getElementById('morningBtn');
        const eveningBtn = document.getElementById('eveningBtn');
        const morningTimes = document.getElementById('morning-grid');
        const eveningTimes = document.getElementById('afternoon-grid');
        
        morningBtn.addEventListener('click', () => {
          morningBtn.classList.add('active');
          eveningBtn.classList.remove('active');
          morningTimes.style.display = 'block';
          eveningTimes.style.display = 'none';
        });
        
        eveningBtn.addEventListener('click', () => {
          eveningBtn.classList.add('active');
          morningBtn.classList.remove('active');
          eveningTimes.style.display = 'block';
          morningTimes.style.display = 'none';
        });

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
                        console.log(branch)
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
                                if (currentStep === 1 && validateCurrentStep()) {
                                    currentStep = 2;
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
                                    updateSummarySteps();
                                    fanaltotal = selectedData.services.reduce((sum, service) => {
                                        const subTotal = service.subServices.reduce((subSum, sub) => subSum + sub.price, 0);
                                        return sum + subTotal;
                                    }, 0);
                                }
                                console.log(fanaltotal)
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

        function fetchStaffMembers(branchId , subserve) {
            showLoader();
            fetch(`/staff?branch_id=${branchId}&service_id=${subserve}`)
                .then(response => response.json())
                .then(data => {
                    const staffGrid = document.getElementById('staffGrid');
                    if (!staffGrid) {
                        console.error('ما في عنصر بالـ id = "staffGrid"');
                        return;
                    }
                    staffGrid.innerHTML = '';

                    if (data.length === 0) {
                        const noStaffMessage = document.createElement('div');
                        noStaffMessage.className = 'no-staff-message';
                        noStaffMessage.innerText = 'لا يوجد موظفين متاحين لهذه الخدمة';
                        staffGrid.appendChild(noStaffMessage);
                        hideLoader();
                        return;
                    }


                    data.forEach(staff => {
                        const card = document.createElement('div');
                        card.className = 'staff-card';
                        card.dataset.staff = staff.id;
                        card.dataset.subserve = subserve;
                        const fullName = staff.full_name || `${staff.first_name || ''} ${staff.last_name || ''}`;
                        const initials = fullName.trim().split(' ').map(word => word[0]).join('').substring(0, 2).toUpperCase();

                        card.innerHTML = `
                            <div class="staff-avatar" style="background: linear-gradient(45deg, ${staff.color1 || '#4a90e2'}, ${staff.color2 || '#7b68ee'}); display: flex; align-items: center; justify-content: center; color: white; font-size: 24px;">
                                ${initials}
                            </div>
                            <div class="staff-name">${fullName}</div>
                        `;

                        card.addEventListener('click', () => {
                            document.querySelectorAll('.staff-card').forEach(c => c.classList.remove('selected'));
                            card.classList.add('selected');
                            let parentService = selectedData.services.find(s => 
                                s.subServices.some(subSrv => subSrv.id === subserve)
                            );
                        
                            if (parentService) {
                                let currentSub = parentService.subServices.find(subSrv => subSrv.id === subserve);
                                if (currentSub) {
                                    currentSub.staffId = staff.id;
                                    currentSub.staffName = fullName;
                                    updateSummarySteps()
                                }
                            }
                        });

                        staffGrid.appendChild(card);
                    });
                    hideLoader();
                })
                .catch(error => {
                    console.error('Error fetching staff:', error);
                    hideLoader();
                });
        }

        function generateCalendar(subserve = null , staffId = null) {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();
        
            // Update calendar title
            const months = [
                '{{ __("messagess.january") }}',
                '{{ __("messagess.february") }}',
                '{{ __("messagess.march") }}',
                '{{ __("messagess.april") }}',
                '{{ __("messagess.may") }}',
                '{{ __("messagess.june") }}',
                '{{ __("messagess.july") }}',
                '{{ __("messagess.august") }}',
                '{{ __("messagess.september") }}',
                '{{ __("messagess.october") }}',
                '{{ __("messagess.november") }}',
                '{{ __("messagess.december") }}'
            ];
            document.getElementById('calendarTitle').textContent = `${months[month]} ${year}`;
        
            // Days of week names
            const weekDays = [
                '{{ __("messagess.sunday") }}',
                '{{ __("messagess.monday") }}',
                '{{ __("messagess.tuesday") }}',
                '{{ __("messagess.wednesday") }}',
                '{{ __("messagess.thursday") }}',
                '{{ __("messagess.friday") }}',
                '{{ __("messagess.saturday") }}'
            ];
        
            // Generate calendar days
            const daysContainer = document.getElementById('calendarDays');
            daysContainer.innerHTML = '';
        
            const firstDay = new Date(year, month, 1);           // أول يوم
            const lastDay = new Date(year, month + 1, 0);        // آخر يوم
        
            for (let d = firstDay.getDate(); d <= lastDay.getDate(); d++) { 
                const date = new Date(year, month, d); 
        
                const dayElement = document.createElement('div');
                dayElement.className = 'calendar-day';
        
                // اسم اليوم
                const dayName = document.createElement('div');
                dayName.className = 'calendar-day-name';
                dayName.textContent = weekDays[date.getDay()];
                dayElement.appendChild(dayName);
        
                // رقم اليوم
                const dayNumber = document.createElement('div');
                dayNumber.className = 'calendar-day-number';
                dayNumber.textContent = d;
                dayElement.appendChild(dayNumber);
        
                const today = new Date(); // 4/10/2025
                today.setHours(0, 0, 0, 0);
                if (date < today) {
                    dayElement.classList.add('disabled');
                } else {
                    dayElement.addEventListener('click', () => {
                        document.querySelectorAll('.calendar-day').forEach(d => d.classList.remove('selected'));
                        dayElement.classList.add('selected');
                    
                        const selectedDateFormatted = `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2,'0')}-${String(date.getDate()).padStart(2,'0')}`;
                        selectedDate = new Date(date);

                        if (selectedData.services) {
                            selectedData.services.forEach(service => {
                                service.subServices.forEach(sub => {
                                    if (sub.id == subserve) {
                                        sub.date = selectedDateFormatted;
                                        updateSummarySteps()
                                        fetchAvailableTimes(selectedDateFormatted, staffId , subserve);
                                    }
                                });
                            });
                        }
                    
                        console.log(selectedData);
                        console.log("date selected:", selectedDateFormatted);
                    });

                }
        
                if (selectedDate && date.toDateString() === selectedDate.toDateString()) {
                    dayElement.classList.add('selected');
                }
        
                daysContainer.appendChild(dayElement);
            }
        }
        
        //   document.getElementById('scrollLeft').addEventListener('click', () => {
        //     document.getElementById('calendarDays').scrollBy({ left: -100, behavior: 'smooth' });
        //   });
        //   document.getElementById('scrollRight').addEventListener('click', () => {
        //     document.getElementById('calendarDays').scrollBy({ left: 100, behavior: 'smooth' });
        //   });

        function fetchAvailableTimes(date , staffId , subserve) {
            showLoader();
            fetch(`/available/${date}/${staffId}`)
                .then(response => response.json())
                .then(data => {

                    const morningGrid = document.querySelector('#morning-grid');
                    const afternoonGrid = document.querySelector('#afternoon-grid');

                    if (!morningGrid || !afternoonGrid) {
                        console.error('❌ عناصر الوقت غير موجودة في الصفحة.');
                        return;
                    }

                    morningGrid.innerHTML = '';
                    afternoonGrid.innerHTML = '';

                    if (data.length === 0) {
                        morningGrid.innerHTML = '<p>لا توجد مواعيد متاحة لهذا اليوم.</p>';
                        afternoonGrid.innerHTML = '<p>لا توجد مواعيد متاحة لهذا اليوم.</p>';
                        hideLoader();
                        return;
                    }

                    data.forEach(time => {
                        const hour = parseInt(time.split(':')[0], 10);
                        const slot = document.createElement('div');
                        slot.className = 'time-slot';
                        slot.textContent = time;
                        slot.dataset.time = time;
            
                        slot.addEventListener('click', () => {
                            document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
                            slot.classList.add('selected');
                                selectedData.services.forEach(service => {
                                    service.subServices.forEach(sub => {
                                        if (sub.id == subserve) {
                                            sub.time = time;
                                            updateSummarySteps()
                                        }
                                    });
                                });

                        });
            
                        if (hour < 12) {
                            morningGrid.appendChild(slot);
                        } else {
                            afternoonGrid.appendChild(slot);
                        }
                    });
                    hideLoader();
                })
                .catch(err => {
                    console.error('❌ خطأ أثناء جلب المواعيد:', err);
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
                            card.style.cssText = `border-radius:10px;padding:20px;background:#fff;cursor:pointer;transition:0.2s ease-in-out;
                            `;
                            
                            card.onmouseenter = () => card.style.boxShadow = "0 4px 10px rgba(0,0,0,0.1)";
                            card.onmouseleave = () => card.style.boxShadow = "none";
                            
                            const header = `
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                                    <div>
                                        <strong style="font-size:16px; color:#444;">${service.name}</strong>
                                        <p style="margin:5px 0 0; font-size:14px; color:#666;">${sub.name}</p>
                                    </div>
                                    <img src="${service.image || 'https://via.placeholder.com/60'}" 
                                         alt="${service.name}" 
                                         style="width:60px; height:60px; border-radius:8px; object-fit:cover;">
                                </div>
                            `;
        
                            const details = `
                                <div style="margin-top:10px;">
                                    <label style="font-size:13px; color:#666;">الموظف:</label>
                                    <input type="text" value="${sub.staffName || ''}"  disabled placeholder="الموظف" 
                                           style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:6px;">
                                    
                                    <div style="display:flex; flex-direction:row-reverse; justify-content:flex-end; gap:6px;">
                                        <input type="date" value="${sub.date || ''}" disabled 
                                               style="flex:1; padding:8px; border:1px solid #ccc; border-radius:6px;">
                                        <input type="time"  value="${sub.time || ''}" disabled 
                                               style="flex:1; padding:8px; border:1px solid #ccc; border-radius:6px;">
                                    </div>
        
                                    <div style="text-align:right; font-weight:bold; color:#a36b2c; margin-top:8px;">
                                        السعر: ${sub.price || 0} ريال
                                    </div>
                                </div>
                            `;
        
                            card.innerHTML = header + details;
        
                            card.addEventListener('click', () => {
                                if (currentStep === 3) {
                                    document.querySelectorAll('.summary-card').forEach(c => c.classList.remove('selected-card'));
                                    card.classList.add('selected-card');
                                    fetchStaffMembers(selectedData.branch, sub.id);
                                } else if(currentStep === 4) {
                                    document.querySelectorAll('.summary-card').forEach(c => c.classList.remove('selected-card'));
                                    card.classList.add('selected-card');
                                    activeSubId = sub.id;
                                    activeStaffId = sub.staffId;
                                    generateCalendar(sub.id , sub.staffId);
                                }
                            });
        
                            summaryContainer.appendChild(card);
                        });
                    }
                });
            });
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
                    const selectedBranch = document.querySelector('input[name="branch"]:checked');
                    if (!selectedBranch) {
                        alert('{{ __("messagess.please_select_branch") }}');
                        return false;
                    }
                    break;
                case 2:
                    if (!selectedData.services || selectedData.services.length === 0) {
                        alert('Please select at least one service');
                        return false;
                    }
                    break;
                case 3:
                    let allHaveStaff = selectedData.services.every(service => 
                      service.subServices.every(sub => sub.staffId)
                    );
                    
                    if (!allHaveStaff) {
                      alert("من فضلك اختر موظف لكل خدمة فرعية");
                      return false;
                    }
                    console.log(selectedData)
                    break;
                case 4:
                let allHavetimes = selectedData.services.every(service =>
                  service.subServices.every(sub => sub.time)
                );
                    if (!allHavetimes) {
                        alert('يرجى اختيار وقت');
                        return false;
                    }else{
                        currentStep = 4;
                        showBookingSummary();
                    }
                    nextBtn.textContent = translations.complete;
                    break;
            }
            return true;
        }

        function showBookingSummary() {
            const lang = typeof currentLang !== 'undefined' ? currentLang : 'en';
            summaryCard.classList.remove('hidden');
            summaryCard.classList.add('show');
            summaryCard.innerHTML = `
                <div id="nad-sun" style="z-index: 999;width: 100%;min-height: 1500px;background: #0000008a;position: absolute;top: 84%;left: 50%;transform: translate(-50%, -50%);">
                    <div class="w-100-mob" style="border-radius: 15px;width: 76%;min-height: 900px;background: white;position: absolute;top: 57%;left: 50%;transform: translate(-50%, -50%);padding: 45px;">
                        <div style="text-align: center;margin: 0 0 30px 0px;">
                            <label style="color: black;font-size: 20px;font-weight: bold;">
                                ${lang === 'ar' ? 'ملخص حجز الخدمات من عناية سامي' : 'Summary of service booking from Enaya Sami'} 
                            </label>
                        </div>
                        <div class="sammary-steps"></div>
                        <div class="total-sunmary">
                            ${lang === 'ar' ? 'اجمالي المبلغ المالي :' : 'Total amount of money:'}      <span class="sub-sammary-total">${fanaltotal} {{ __('messages.currency') }}</span>
                        </div>
                            <div class="ti">
                                <label style="text-align: center;font-size: 18px;font-weight: 600;color: #979797;">{{ __('messagess.products_you_may_like') }}</label>
                            </div>
                            @if(isset($suggest) && $suggest->count() > 0)
                            <div class="row g-4">
                                @foreach($suggest as $index => $product)
                                    <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                        @include('components.frontend.products-card', [
                                            'image' => $product->av2,
                                            'name' => $product->name,
                                            'des' => $product->short_description,
                                            'product_id' => $product->id,
                                            'categories' => $product->categories,
                                            'min_price' => $product->min_price,
                                            'max_price' => $product->max_price,
                                        ])
                                    </div>
                                @endforeach
                            </div>
                            @endif
                            <div class="two-btn">
                            
                                <button class=" dis-btn btn-e btn-filled" onclick="completeBooking('payment')">
                                     ${lang === 'ar' ? 'ادفع الآن' : 'Pay now :'}      
                                     <img src="{{asset('images/icons/vesa.png')}}">
                                </button>
                                <button class=" dis-btn btn-e btn-outline" onclick="completeBooking('cart')">
                                    <img class="mdi-lightcart" src="{{ asset('images/icons/mdi-light-cart.svg') }}" alt="mdi-light:cart">
                                     ${lang === 'ar' ? 'اضافة للسلة' : 'Add to cart'}      
                                </button>
                                
                            </div>
                    </div>
                </div>
                `;
                updateSummarySteps()
        }
                
        function completeBooking(btn) {

            const payload = {
                ...selectedData, 
                btn_value: btn
            };
            fetch(`/cart`, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json', 
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content 
              },
              body: JSON.stringify(payload)
            })
            .then(response => response.json())
            .then(data => {
                document.querySelectorAll('.dis-btn').forEach(btn => {
                    btn.disabled = true;
                    btn.style.opacity = '0.6';
                    btn.style.cursor = 'not-allowed';
                });
                if(btn == 'cart'){
                    createNotify({ title: 'تمت العملية بنجاح', desc: data.message  });
                      setTimeout(() => {
                        window.location.href = '/cart'; 
                      }, 3000);
                }
                if(btn == 'payment'){
                      setTimeout(() => {
                        window.location.href = '/payment?ids=1'; 
                      }, 1500);
                }
            
            })
            .catch(error => {
              console.error('❌ خطأ أثناء الإرسال:', error);
            });
        }
        // Initialize the application
        document.addEventListener('DOMContentLoaded', initializeApp);
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>

</html>
