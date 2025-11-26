    {{-- <style>

        a svg{
            color:white;
        }
        .h5{
            font-size:15.6px;
        }
    </style>
</head>
<body>
    </div>

    @include('components.frontend.footer')
</body>
</html>
 --}}




<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ language_direction() }}" class="theme-fs-sm">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>@yield('title') | {{ app_name() }}</title>

    <link rel="stylesheet" href="{{ mix('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/backend.css') }}">
    @if (language_direction() == 'rtl')
        <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('custom-css/frontend.css') }}">

    @stack('after-styles')
<link href="https://fonts.cdnfonts.com/css/lama-sans" rel="stylesheet">
   <style>
        body{
    font-family: 'Lama Sans', sans-serif;
    font-style: {{ app()->getLocale() == 'ar' ? 'italic !important' : 'normal !important' }};
        }
   </style>
</head>
<body class="bg-white">
    <!-- Lightning Progress Bar --> 
    @include('components.frontend.progress-bar')

    <!-- Hero Section (30% of screen) -->
    <div class="position-relative" style="height: 200px;">
        <img src="{{ asset('images/frontend/slider1.webp') }}" alt="Contact Hero" class="w-100 " style="object-fit: cover;height: 145%;">
        <div class="position-absolute top-0 start-0 w-100" style="background: rgba(0,0,0,0.35);height:290.797px"></div>

        <!-- First Navbar -->
        @include('components.frontend.navbar')

        <!-- Second Navbar -->
        @include('components.frontend.second-navbar')
    </div>

    <!-- Page Content -->
    <div style="height: 100vh;">
        
    </div>

    <!-- Footer -->
    @include('components.frontend.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
