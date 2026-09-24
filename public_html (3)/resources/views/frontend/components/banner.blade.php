@php
    use App\Models\HeroBanner;

    $banner = HeroBanner::firstBanner();
    $homeContent = $homeContent ?? \App\Models\PageContent::forPage('home');
    $banner_image = 'front/assets/img/banner/1.png';
    $banner_subtitle = $banner?->sub_title ?: $homeContent->eyebrow;
    $banner_title = $banner?->main_title ?: $homeContent->title;
    $banner_paragraph = $banner?->sort_paragraph ?: $homeContent->intro;
    $trustItems = $homeContent->trust_items;
    $heroStats = $homeContent->hero_stats;
    $heroStatIcons = ['bi-briefcase-fill', 'bi-hand-thumbs-up-fill', 'bi-people-fill', 'bi-award-fill'];
@endphp

<!-- Slider Section -->
<section class="wptb-slider style3 pt-0">
    <div class="wptb-slider--item">
        <div class="wptb-slider--image" style="background-image: url('{{ asset($banner_image) }}');"></div>
        <div class="container">
            <div class="wptb-slider--inner">
                <div class="hero-content-column">
                    <div class="wptb-heading">
                        <div class="wptb-item--inner">
                            <h6 class="wptb-item--subtitle"><span class="text-one">{{ $banner_subtitle }}</span></h6>
                            <h1 class="wptb-item--title">{!! nl2br(e($banner_title)) !!}</h1>
                                <p class="hero-description">{{ $banner_paragraph }}</p>

                            <div class="hero-cta-row" aria-label="Hero actions">
                                <a href="{{ route('book-appointment') }}" class="hero-cta hero-cta-primary">Book Appointment</a>
                                <a href="{{ route('service-price') }}" class="hero-cta hero-cta-secondary">Explore Services</a>
                            </div>

                            <div class="hero-trust-strip" aria-label="Trust highlights">
                                @foreach($trustItems as $trustItem)
                                    <div class="hero-trust-item"><i class="bi bi-check-circle-fill" aria-hidden="true"></i><span>{{ $trustItem }}</span></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Parallax Hero: cockpit/tunnel background + floating car + count-up stats -->
<section class="hero-parallax" aria-label="United Auto highlights">
    <div class="hero-parallax__layer hero-parallax__tunnel" aria-hidden="true"></div>

    <div class="hero-parallax__stats">
        @foreach($heroStats as $heroIndex => $heroStat)
        <div class="hero-parallax__stat">
            <div class="hero-parallax__stat-icon"><i class="bi {{ $heroStatIcons[$heroIndex] ?? 'bi-bar-chart-fill' }}" aria-hidden="true"></i></div>
            <div class="hero-parallax__stat-value" data-count="{{ $heroStat[1] ?? 0 }}">0+</div>
            <div class="hero-parallax__stat-label">{{ $heroStat[0] ?? '' }}</div>
        </div>
        @endforeach
    </div>

    <div class="hero-parallax__car">
        <img src="{{ asset('front/assets/img/slider/car-2.png') }}" alt="United Auto - premium car detailing" loading="eager">
        <img class="hero-parallax__headlights" src="{{ asset('front/assets/img/slider/car-light.png') }}" alt="" aria-hidden="true">
    </div>
</section>