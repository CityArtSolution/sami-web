<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ language_direction() }}" class="theme-fs-sm">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ app_name() }}</title>

    <link rel="stylesheet" href="{{ mix('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/backend.css') }}">
    @if (language_direction() == 'rtl')
        <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('custom-css/frontend.css') }}">

    @stack('after-styles')
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    <style>
        body {
          font-family: 'Almarai', sans-serif !important;
        }
    </style>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
</head>

<body class="{{ auth()->user()->user_setting['theme_scheme'] ?? '' }}">

    <!-- Lightning Progress Bar -->
    <x-frontend.progress-bar />

    <header class="shadow">
            <x-frontend.second-navbar />
    </header>

    <main>
        @yield('content')
    </main>

    <x-frontend.footer />


    <!-- ملفات JS -->
    <script src="{{ mix('js/backend.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('after-scripts')
    <script>
    document.addEventListener('DOMContentLoaded', () => {
          fetch('/finalize-booking', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            credentials: 'include',
          })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
              alert('تم تحويل الحجز المؤقت إلى حجز نهائي');
              window.location.href = `/cart`;
            }
            else if (data.error) {
            }
          })
          .catch(err => console.error('خطأ في تحويل الحجز:', err));
    });

</script>
</body>

</html>
