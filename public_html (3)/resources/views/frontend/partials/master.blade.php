@php
    use App\Models\CompanySetting;
    $company = CompanySetting::firstRecord();
    $favicon_icon = $company?->favicon_icon ?? 'favicon.png';
    $logo_image = "";
@endphp
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta Tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="@yield('meta_description', 'United Auto provides premium car servicing, detailing, paint protection, and maintenance in Jamshedpur.')">
        <meta name="author" content="United Auto">
        <meta name="robots" content="index, follow">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="United Auto">
        <meta property="og:title" content="@yield('og_title', 'United Auto | Car Service & Detailing in Jamshedpur')">
        <meta property="og:description" content="@yield('meta_description', 'United Auto provides premium car servicing, detailing, paint protection, and maintenance in Jamshedpur.')">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:image" content="{{ asset('assets/images/company/' . ($company->logo ?? 'logo.png')) }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="@yield('og_title', 'United Auto | Car Service & Detailing in Jamshedpur')">
        <meta name="twitter:description" content="@yield('meta_description', 'United Auto provides premium car servicing, detailing, paint protection, and maintenance in Jamshedpur.')">
        <meta name="twitter:image" content="{{ asset('assets/images/company/' . ($company->logo ?? 'logo.png')) }}">

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

        <!-- Lenis smooth scrolling -->
        <link rel="stylesheet" href="https://unpkg.com/lenis@1.3.26/dist/lenis.css">
        
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
        <link rel="stylesheet" href="{{ asset('css/hero-parallax.css') }}">
        <style>
            .viswakarma-popup {
                position: fixed;
                inset: 0;
                z-index: 10000;
                display: grid;
                place-items: center;
                padding: 24px;
                background: rgba(8, 18, 32, 0.72);
                opacity: 0;
                visibility: hidden;
                transition: opacity 220ms ease, visibility 220ms ease;
            }

            .viswakarma-popup.is-open {
                opacity: 1;
                visibility: visible;
            }

            .viswakarma-popup__dialog {
                position: relative;
                max-width: min(92vw, 768px);
                max-height: 92vh;
                transform: translateY(18px) scale(.97);
                transition: transform 260ms cubic-bezier(.2, .8, .2, 1);
            }

            .viswakarma-popup.is-open .viswakarma-popup__dialog {
                transform: translateY(0) scale(1);
            }

            .viswakarma-popup__image {
                display: block;
                width: auto;
                max-width: 92vw;
                max-height: 92vh;
                height: auto;
                object-fit: contain;
                border-radius: 8px;
                box-shadow: 0 24px 70px rgba(0, 0, 0, .28);
            }

            .viswakarma-popup__close {
                position: absolute;
                top: -14px;
                right: -14px;
                display: grid;
                width: 38px;
                height: 38px;
                place-items: center;
                border: 2px solid #fff;
                border-radius: 50%;
                background: #ef233c;
                color: #fff;
                font-size: 25px;
                line-height: 1;
                cursor: pointer;
                box-shadow: 0 8px 20px rgba(0, 0, 0, .2);
            }

            .viswakarma-popup__close:hover,
            .viswakarma-popup__close:focus-visible {
                background: #c9182f;
                outline: 3px solid rgba(255, 255, 255, .7);
                outline-offset: 2px;
            }

            @media (max-width: 575px) {
                .viswakarma-popup {
                    padding: 18px;
                }

                .viswakarma-popup__dialog,
                .viswakarma-popup__image {
                    max-width: calc(100vw - 36px);
                    max-height: 88vh;
                }

                .viswakarma-popup__close {
                    top: -10px;
                    right: -10px;
                    width: 34px;
                    height: 34px;
                    font-size: 22px;
                }
            }
        </style>
    </head>
    <body>

        @if (request()->routeIs('home'))
            <div class="viswakarma-popup is-open" id="viswakarmaPopup" role="dialog" aria-modal="true" aria-label="Viswakarma Puja greeting">
                <div class="viswakarma-popup__dialog">
                    <button class="viswakarma-popup__close" type="button" id="viswakarmaPopupClose" aria-label="Close poster">&times;</button>
                    <img class="viswakarma-popup__image" src="{{ asset('images/viswakarma-puja-poster.png') }}" alt="United Auto Viswakarma Puja greeting poster">
                </div>
            </div>
        @endif

        @include('frontend.partials.header')

        <main class="wrapper">
            @yield('content')
        </main>

        @include('frontend.partials.footer')

        @if (request()->routeIs('home'))
            <script>
                (function () {
                    const popup = document.getElementById('viswakarmaPopup');
                    const closeButton = document.getElementById('viswakarmaPopupClose');
                    if (!popup || !closeButton) return;

                    function closePopup() {
                        popup.classList.remove('is-open');
                        window.setTimeout(function () {
                            popup.hidden = true;
                        }, 240);
                    }

                    closeButton.addEventListener('click', closePopup);
                    popup.addEventListener('click', function (event) {
                        if (event.target === popup) closePopup();
                    });
                    document.addEventListener('keydown', function (event) {
                        if (event.key === 'Escape' && !popup.hidden) closePopup();
                    });
                })();
            </script>
        @endif

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

        <!-- Hero Parallax: layered tunnel/car background -->
        <script src="{{ asset('js/hero-parallax.js') }}"></script>

        <!-- PASS D: FAQ Accordion -->

        <!-- PASS E: Tabs & Gallery Filter -->
        <script src="{{ asset('js/tabs-gallery-filter.js') }}"></script>

        <!-- Lenis smooth scrolling -->
        <script src="https://unpkg.com/lenis@1.3.26/dist/lenis.min.js"></script>
        <script>
            const lenis = new Lenis({
                duration: 1.35,
                easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                smoothWheel: true,
                wheelMultiplier: 0.9,
                touchMultiplier: 1.5,
                anchors: true,
            });

            window.lenis = lenis;

            function raf(time) {
                lenis.raf(time);
                requestAnimationFrame(raf);
            }
            requestAnimationFrame(raf);

            // If GSAP ScrollTrigger is already used on this site, sync it.
            if (window.gsap && window.ScrollTrigger) {
                lenis.on('scroll', ScrollTrigger.update);
                gsap.ticker.add((time) => lenis.raf(time * 1000));
                gsap.ticker.lagSmoothing(0);
            }
        </script>
    </body>
</html>