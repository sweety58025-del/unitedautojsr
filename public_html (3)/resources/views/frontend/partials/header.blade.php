@php
    use App\Models\CompanySetting;
    $company = CompanySetting::first();
    $logo_image = "";
@endphp
@if ($company)
    @php
        $logo_image = $company->logo;
    @endphp
@endif
<!-- Main Header -->
<header class="header">
    <!-- Top Bar -->
    <div class="header-top">
        <div class="container-fluid pe-4">
            <div class="header-top--inner d-none d-xl-flex justify-content-between align-items-center flex-wrap">
                <!-- Left Box -->
                <div class="left-box d-flex align-items-center">
                    <ul class="info-list">
                        <li><a href="mailto:{{ $company->email ?? '' }}"><span class="icon bi bi-envelope-fill"></span>{{ $company->email ?? '' }}</a></li>
                        <li><a href="#"><span class="icon bi bi-geo-alt-fill"></span>{{ $company->address ?? '' }}</a></li>
                    </ul>
                </div>
                
                <!-- Right Box -->
                <div class="right-box d-flex align-items-center">
                    <!-- Social Box -->
                    <div class="social-box">
                        <ul>
                            <li><a href="https://www.facebook.com/" class="bi bi-facebook"></a></li>
                            <li><a href="https://www.instagram.com/" class="bi bi-instagram"></a></li>
                            <li><a href="https://www.twitter.com/" class="bi bi-twitter-x"></a></li>
                            <li><a href="https://www.linkedin.com/" class="bi bi-linkedin"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lower Bar -->
    <div class="header-inner">
        <div class="container-fluid pe-0">
            <div class="d-flex align-items-center justify-content-between">
                <!-- Left Part -->
                <div class="header_left_part d-flex align-items-center">
                    <div class="logo">
                        <a href="{{ url('/') }}" class="light_logo"><img src="{{ asset('assets/images/company/'.$logo_image) }}" style="height: 50px;" alt="logo"></a>
                    </div>
                </div>

                <!-- Right Part -->
                <div class="header_right_part d-flex align-items-center">
                    <div class="mainnav d-none d-xl-block">
                        <ul class="main-menu">
                            <li class="menu-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="menu-item"><a href="{{ route('about-us') }}">About</a></li>

                            <li class="menu-item menu-item-has-children">
                                <a href="#">Services</a>

                                <ul class="sub-menu">
                                    @foreach($categories as $category)

                                        <li class="menu-item {{ $category->subcategories->count() ? 'menu-item-has-children' : '' }}">

                                            <a href="{{ route('service.details', $category->slug) }}">
                                                {{ $category->name }}
                                            </a>

                                            @if($category->subcategories->count())
                                                <ul class="sub-menu">
                                                    @foreach($category->subcategories as $sub)
                                                        <li class="menu-item">
                                                            <a href="{{ route('service-category.details', $sub->slug) }}">
                                                                {{ $sub->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                        </li>

                                    @endforeach
                                </ul>
                            </li>
                            <li class="menu-item"><a href="{{ route('service-price') }}">Service Prices</a></li>
                            <li class="menu-item"><a href="{{ route('gallery') }}">Gallery</a></li>
                            <li class="menu-item"><a href="{{ route('contact-us') }}">Contact</a></li>

                        </ul>
                    </div>

                    <div class="wptb-icon-box1 live-chat d-none d-md-block">
                        <div class="wptb-item--inner flex-start">
                            <div class="wptb-item--icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="35" viewBox="0 0 36 35" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M22.9268 20.5991C22.0141 19.6831 20.5336 19.6823 19.6201 20.5991L19.6172 20.602C19.143 21.0779 18.3743 21.0784 17.9003 20.6027C17.0858 19.7854 16.0287 18.7244 15.2142 17.907C14.7402 17.4313 14.7407 16.6599 15.215 16.1839L15.2179 16.181C16.1313 15.2643 16.1306 13.7785 15.2179 12.8625C14.8047 12.4478 14.34 11.9815 13.9055 11.5454C13.379 11.0159 12.6635 10.719 11.9183 10.7189C11.1726 10.7193 10.4578 11.0162 9.93062 11.5452L9.0091 12.4701C7.85245 13.6309 7.53171 15.3883 8.20291 16.8846L8.20482 16.8899C10.2592 21.2294 14.4347 25.4234 18.9171 27.5713L18.9197 27.5729C20.4104 28.2635 22.167 27.9506 23.3269 26.7907C23.6323 26.5134 23.9421 26.2035 24.2394 25.9053C24.7665 25.3762 25.0623 24.6589 25.0628 23.9105C25.0626 23.1626 24.7668 22.4445 24.2392 21.9161C23.8047 21.4801 23.34 21.0137 22.9268 20.5991ZM22.1323 21.3964L23.4447 22.7135C23.7612 23.0311 23.9383 23.4616 23.9382 23.9103C23.9386 24.3596 23.7603 24.7899 23.4441 25.1072C23.1573 25.3951 22.8583 25.6962 22.558 25.9683L22.5374 25.988C21.7113 26.817 20.4586 27.0414 19.3974 26.551C15.1422 24.511 11.1759 20.5317 9.22594 16.417C8.74891 15.3487 8.97887 14.0955 9.80433 13.2682L10.7259 12.3433C11.042 12.026 11.4708 11.8471 11.9185 11.8475C12.3656 11.8474 12.7945 12.0251 13.111 12.3428L14.4234 13.6599C14.8974 14.1356 14.8969 14.907 14.4226 15.383L14.4197 15.3858C13.5063 16.3026 13.5065 17.789 14.4197 18.7044L17.1058 21.4001C18.0179 22.3166 19.499 22.3168 20.4125 21.4001L20.4154 21.3972C20.8896 20.9212 21.6577 20.9213 22.1323 21.3964Z" fill="white"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.5625 15.8068C19.494 15.8068 20.25 16.5655 20.25 17.5003C20.25 17.8119 20.502 18.0648 20.8125 18.0648C21.123 18.0648 21.375 17.8119 21.375 17.5003C21.375 15.9423 20.115 14.6777 18.5625 14.6777C18.252 14.6777 18 14.9306 18 15.2423C18 15.5539 18.252 15.8068 18.5625 15.8068Z" fill="white"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.5625 12.4196C21.357 12.4196 23.625 14.6957 23.625 17.5002C23.625 17.8118 23.877 18.0647 24.1875 18.0647C24.498 18.0647 24.75 17.8118 24.75 17.5002C24.75 14.0725 21.978 11.2905 18.5625 11.2905C18.252 11.2905 18 11.5434 18 11.855C18 12.1667 18.252 12.4196 18.5625 12.4196Z" fill="white"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.5625 9.03235C23.2189 9.03235 27 12.827 27 17.5001C27 17.8117 27.252 18.0646 27.5625 18.0646C27.873 18.0646 28.125 17.8117 28.125 17.5001C28.125 12.2038 23.8399 7.90332 18.5625 7.90332C18.252 7.90332 18 8.15622 18 8.46784C18 8.77945 18.252 9.03235 18.5625 9.03235Z" fill="white"/>
                                </svg>
                            </div>
                            <div class="wptb-item--holder">
                                <p class="wptb-item--description">Need Help</p>
                                <h5 class="wptb-item--title"> <a href="tel:+91-{{ $company->phone ?? '' }}">+91-{{ $company->phone ?? '' }}</a></h5>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="aside_open d-none d-xl-block">
                        <div class="aside-open--inner">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div> --}}

                    <button type="button" class="mr_menu_toggle d-xl-none">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End Main Header -->			

<!-- Mobile Responsive Menu -->
<div class="mr_menu">
    <button type="button" class="mr_menu_close"><i class="bi bi-x-lg"></i></button>
    <div class="logo"></div> <!-- Keep this div empty. Logo will come here by JavaScript -->
    <div class="mr_navmenu"></div> <!-- Keep this div empty. Menu will come here by JavaScript -->
</div>
