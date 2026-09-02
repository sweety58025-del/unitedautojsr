@php
    use App\Models\HeroBanner;

    $banner = HeroBanner::firstBanner();
    $preferredBannerFile = public_path('front/assets/img/banner/1.jpeg');
    $banner_image = file_exists($preferredBannerFile)
        ? 'front/assets/img/banner/1.jpeg'
        : ($banner?->banner_image ?? '');
@endphp

<!-- Slider Section -->
<section class="wptb-slider style3 pt-0">
    <div class="wptb-slider--item">
        <div class="wptb-slider--image" style="background-image: url('{{ asset($banner_image) }}');"></div>
        <div class="container">
            <div class="wptb-slider--inner">
                <div class="row">
                    <!-- Content Column -->
                    <div class="col-lg-8 col-md-12 offset-lg-2">
                        <div class="wptb-heading">
                            <div class="wptb-item--inner text-center">
                                <h6 class="wptb-item--subtitle"> <span class="text-one"> {{ $banner?->sub_title ?? '' }}</span> </h6>
                                <h1 class="wptb-item--title"> {{ $banner?->main_title ?? '' }}</h1>

                                <div class="hero-cta-row" aria-label="Hero actions">
                                    <a href="{{ route('book-appointment') }}" class="hero-cta hero-cta-primary">Book Appointment</a>
                                    <a href="{{ route('service-price') }}" class="hero-cta hero-cta-secondary">Explore Services</a>
                                </div>

                                <div class="hero-trust-strip" aria-label="Trust highlights">
                                    <div class="hero-trust-item"><i class="bi bi-check-circle-fill" aria-hidden="true"></i><span>Experienced Technicians</span></div>
                                    <div class="hero-trust-item"><i class="bi bi-check-circle-fill" aria-hidden="true"></i><span>Genuine Parts</span></div>
                                    <div class="hero-trust-item"><i class="bi bi-check-circle-fill" aria-hidden="true"></i><span>Transparent Pricing</span></div>
                                    <div class="hero-trust-item"><i class="bi bi-check-circle-fill" aria-hidden="true"></i><span>Customer Satisfaction</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wptb-image-single wow fadeInUp d-none d-sm-block">
            <div class="wptb-item--inner">
                <div class="wptb-item--image">
                    <img src="{{ asset('front/assets/img/slider/car-2.png') }}" alt="United Auto car service vehicle in the workshop" class="hero-vehicle">
                    <img src="{{ asset('front/assets/img/slider/car-light.png') }}" alt="Vehicle lighting detail in the United Auto workshop" class="hero-car-light car-light">
                </div>
            </div>
        </div>
    </div>
</section>