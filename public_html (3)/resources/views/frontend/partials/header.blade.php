@php
    use App\Models\CompanySetting;

    $company = CompanySetting::firstRecord();
    $logo_image = $company?->logo ?: 'logo.png';
    $defaultAddress = 'Nagesh Tower, Near Goods Shed Road, Burma Mines, Jamshedpur - 831007';
    $companyAddress = $company?->address ?: $defaultAddress;
    $mapsUrl = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($companyAddress);

    $socialLinks = [
        'facebook' => env('UNITED_AUTO_FACEBOOK_URL'),
        'instagram' => env('UNITED_AUTO_INSTAGRAM_URL'),
        'x' => env('UNITED_AUTO_X_URL'),
        'linkedin' => env('UNITED_AUTO_LINKEDIN_URL'),
    ];
@endphp
<!-- Main Header -->
<header class="header">
    <div class="header-top">
        <div class="container-fluid">
            <div class="header-top-row">
                <div class="promo-text">
                    <span class="promo-icon"><i class="bi bi-bell-fill"></i></span>
                    <span>Get 50% Discount for UnitedAuto New Member</span>
                </div>

                <div class="header-top-contacts">
                    <a href="tel:+91{{ preg_replace('/\D+/', '', (string) ($company->phone ?? '')) }}">
                        <span class="icon bi bi-telephone-fill"></span>
                        <span>Call us: {{ $company->phone ?? '079922 78199' }}</span>
                    </a>
                    <a href="mailto:{{ $company->email ?? 'unitedautojsr@gmail.com' }}">
                        <span class="icon bi bi-envelope-fill"></span>
                        <span>Message us: {{ $company->email ?? 'unitedautojsr@gmail.com' }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="header-inner">
        <div class="container-fluid">
            <div class="header-main-row">
                <div class="header_left_part">
                    <div class="logo">
                        <a href="{{ url('/') }}" class="light_logo">
                            <img src="{{ asset('assets/images/company/'.$logo_image) }}" alt="United Auto logo">
                        </a>
                    </div>
                </div>

                <div class="header_right_part d-flex align-items-center">
                    <div class="mainnav d-none d-xl-block">
                        <ul class="main-menu">
                            <li class="menu-item menu-item-has-children">
                                <a href="{{ route('brands') }}">Brands We Service</a>
                                <ul class="sub-menu">
                                    @forelse($brands as $brand)
                                        <li class="menu-item"><a href="{{ route('brands') }}#{{ $brand->slug }}">{{ $brand->name }}</a></li>
                                    @empty
                                        <li class="menu-item"><a href="{{ route('brands') }}">View supported brands</a></li>
                                    @endforelse
                                </ul>
                            </li>
                            <li class="menu-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="menu-item"><a href="{{ route('about-us') }}">About</a></li>

                            <li class="menu-item menu-item-has-children">
                                <a href="#">Services</a>
                                <ul class="sub-menu">
                                    @foreach($categories as $category)
                                        <li class="menu-item {{ $category->subcategories->count() ? 'menu-item-has-children' : '' }}">
                                            <a href="{{ route('service.details', $category->slug) }}">{{ $category->name }}</a>
                                            @if($category->subcategories->count())
                                                <ul class="sub-menu">
                                                    @foreach($category->subcategories as $sub)
                                                        <li class="menu-item"><a href="{{ route('service-category.details', $sub->slug) }}">{{ $sub->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </li>

                            <li class="menu-item"><a href="{{ route('service-price') }}">Pricing</a></li>
                            <li class="menu-item"><a href="{{ route('offers') }}">Offers</a></li>
                            <li class="menu-item"><a href="{{ route('insurance') }}">Insurance</a></li>
                            <li class="menu-item"><a href="{{ route('gallery') }}">Gallery</a></li>
                            <li class="menu-item"><a href="{{ route('contact-us') }}">Contact</a></li>
                            <li class="menu-item header-book-cta">
                                <a href="{{ route('book-appointment') }}" class="header-book-button">Book Appointment</a>
                            </li>
                        </ul>
                    </div>

                    <button type="button" class="mr_menu_toggle d-xl-none" aria-label="Open navigation" aria-expanded="false" aria-controls="mobile-menu-panel">
                        <i class="bi bi-list" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End Main Header -->

<!-- Mobile Responsive Menu -->
<div class="mobile-menu-backdrop" aria-hidden="true"></div>
<div id="mobile-menu-panel" class="mr_menu" aria-hidden="true">
    <button type="button" class="mr_menu_close" aria-label="Close navigation">
        <i class="bi bi-x-lg" aria-hidden="true"></i>
    </button>

    <div class="logo">
        <a href="{{ url('/') }}" aria-label="United Auto home">
            <img src="{{ asset('assets/images/company/'.$logo_image) }}" alt="United Auto logo">
        </a>
    </div>

    <nav class="mr_navmenu" aria-label="Mobile navigation">
        <ul class="main-menu">
            <li class="menu-item menu-item-has-children">
                <a href="{{ route('brands') }}" aria-expanded="false">Brands We Service</a>
                <ul class="sub-menu">
                    @forelse($brands as $brand)
                        <li class="menu-item"><a href="{{ route('brands') }}#{{ $brand->slug }}">{{ $brand->name }}</a></li>
                    @empty
                        <li class="menu-item"><a href="{{ route('brands') }}">View supported brands</a></li>
                    @endforelse
                </ul>
            </li>
            <li class="menu-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="menu-item"><a href="{{ route('about-us') }}">About</a></li>

            <li class="menu-item menu-item-has-children">
                <a href="#" aria-expanded="false">Services</a>
                <ul class="sub-menu">
                    @foreach($categories as $category)
                        <li class="menu-item {{ $category->subcategories->count() ? 'menu-item-has-children' : '' }}">
                            <a href="{{ route('service.details', $category->slug) }}">{{ $category->name }}</a>
                            @if($category->subcategories->count())
                                <ul class="sub-menu">
                                    @foreach($category->subcategories as $sub)
                                        <li class="menu-item"><a href="{{ route('service-category.details', $sub->slug) }}">{{ $sub->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </li>

            <li class="menu-item"><a href="{{ route('service-price') }}">Pricing</a></li>
            <li class="menu-item"><a href="{{ route('offers') }}">Offers</a></li>
            <li class="menu-item"><a href="{{ route('insurance') }}">Insurance</a></li>
            <li class="menu-item"><a href="{{ route('gallery') }}">Gallery</a></li>
            <li class="menu-item"><a href="{{ route('contact-us') }}">Contact</a></li>
            <li class="menu-item mobile-book-item"><a href="{{ route('book-appointment') }}" class="mobile-book-button">Book Appointment</a></li>
        </ul>
    </nav>

    <div class="mr_menu_cta">
        <a href="tel:+91{{ $company->phone ?? '' }}" class="mobile-phone-cta">Call {{ $company->phone ?? 'Us' }}</a>
        <a href="{{ route('book-appointment') }}" class="mobile-book-button">Book Appointment</a>
    </div>

    <div class="mr_menu_social" aria-label="United Auto social media links">
        @foreach($socialLinks as $key => $url)
            @if($url)
                @php
                    $socialIcon = [
                        'facebook' => 'bi bi-facebook',
                        'instagram' => 'bi bi-instagram',
                        'x' => 'bi bi-twitter-x',
                        'linkedin' => 'bi bi-linkedin',
                    ][$key] ?? 'bi bi-link-45deg';
                @endphp
                <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" aria-label="Follow United Auto on {{ ucfirst($key) }}" class="{{ $socialIcon }}"></a>
            @endif
        @endforeach
    </div>
</div>
