@php
    use App\Models\CompanySetting;
    $company = CompanySetting::first();
    $favicon_icon = $company?->favicon_icon ?? 'favicon.png';
    $logo_image = "";
@endphp
<!DOCTYPE html>
<html lang="zxx">
    <head>
        <!-- Meta Tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="description" content="Auto JSR">
        <meta name="author" content="">

        <!-- Favicon and touch Icons -->
        <link href="{{ asset('assets/images/company/'.$favicon_icon) }}" rel="shortcut icon" type="image/png">
        <link href="{{ asset('assets/images/company/'.$favicon_icon) }}" rel="apple-touch-icon">
        <link href="{{ asset('assets/images/company/'.$favicon_icon) }}" rel="apple-touch-icon" sizes="72x72">
        <link href="{{ asset('assets/images/company/'.$favicon_icon) }}" rel="apple-touch-icon" sizes="114x114">
        <link href="{{ asset('assets/images/company/'.$favicon_icon) }}" rel="apple-touch-icon" sizes="144x144">

        <!-- Page Title -->
        <title>@yield('title', 'United Auto')</title>    
        
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:wght@400;600;700&family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
        
        <!-- Bootstrap Icons -->
        <link href="{{ asset('front/assets/fonts/bootstrap-icons-1.1/font/bootstrap-icons.css') }}" rel="stylesheet">
        
        <!-- Plugin CSS -->
        <link rel="stylesheet" href="{{ asset('front/plugins/jquery_ui/style.css') }}">
        <link rel="stylesheet" href="{{ asset('front/plugins/wow/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('front/plugins/swiper/swiper-bundle.min.css') }}">
        <link rel="stylesheet" href="{{ asset('front/plugins/odometer/odometer-theme-default.css') }}">
        <link rel="stylesheet" href="{{ asset('front/plugins/fancybox/jquery.fancybox.css') }}">
        <link rel="stylesheet" href="{{ asset('front/plugins/fullcalendar/fullcalendar.min.css') }}">
        <link rel="stylesheet" href="{{ asset('front/plugins/flatpickr/flatpickr.css') }}">
        <link rel="stylesheet" href="{{ asset('front/plugins/nice-select/nice-select.css') }}">
        
        <!-- Core Styles -->
        <link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/design-tokens.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/global.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/header.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/preloader.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/shop.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/components.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/contact.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/blog.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/sidebar.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/portfolio.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/light.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/animation.css') }}">
        
    </head>
    <body>

        @include('frontend.partials.header')

        <main class="wrapper">
            @yield('content')
        </main>

        @include('frontend.partials.footer')

    <!-- Core JS -->
        <script src="{{ asset('front/assets/js/jquery-3.6.0.min.js') }}"></script>

        <!-- Framework -->
        <script src="{{ asset('front/assets/js/bootstrap.min.js') }}"></script>
        
        <!-- WOW Scroll Effect -->
        <script src="{{ asset('front/plugins/wow/wow.min.js') }}"></script>

        <!-- Swiper Slider -->
        <script src="{{ asset('front/plugins/swiper/swiper-bundle.min.js') }}"></script>

        <!-- Odometer Counter -->
        <script src="{{ asset('front/plugins/odometer/appear.js') }}"></script>
        <script src="{{ asset('front/plugins/odometer/odometer.js') }}"></script>

        <!-- Fancybox -->
        <script src="{{ asset('front/plugins/fancybox/jquery.fancybox.min.js') }}"></script>

        <!-- Flatpickr -->
        <script src="{{ asset('front/plugins/flatpickr/flatpickr.min.js') }}"></script>

        <!-- Nice Select -->
        <script src="{{ asset('front/plugins/nice-select/jquery.nice-select.min.js') }}"></script>

        <!-- Theme Custom JS -->
        <script src="{{ asset('front/assets/js/theme.js') }}"></script>
        <script src="{{ asset('front/assets/js/pricetable-toggler.js') }}"></script>

        <!-- PASS C: Hero Slider -->
        <script src="{{ asset('js/hero-slider.js') }}"></script>

        <!-- PASS E: Tabs & Gallery Filter -->
        <script src="{{ asset('js/tabs-gallery-filter.js') }}"></script>
    </body>
</html>