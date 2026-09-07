@php
    use App\Models\Category;
    $services = Category::activeServices();
    $leftServices = $services->take(4);
    $rightServices = $services->slice(4, 4);
    $serviceIcons = [
        'bi-wrench-adjustable',
        'bi-gear-wide-connected',
        'bi-snow',
        'bi-droplet-half',
        'bi-upc-scan',
        'bi-car-front',
        'bi-speedometer2',
        'bi-shield-check'
    ];
    $showcaseDetails = [
        ['title' => 'Engine Overhaul', 'text' => 'Get 20% off on engine overhaul services (Spare parts charges extra).'],
        ['title' => 'Suspension Work', 'text' => 'Avail 20% off on suspension work (Spare parts charges extra).'],
        ['title' => 'AC Service', 'text' => 'Enjoy 20% off on AC service and checkup (Spare parts charges extra).'],
        ['title' => 'Car Washing', 'text' => 'Get FREE car washing service.'],
        ['title' => 'Service Discounts', 'text' => 'Get 50% off on labour for your 1st, 2nd, and 3rd service.'],
        ['title' => 'Car Scanning', 'text' => 'FREE car scanning service (Spare parts charges extra).'],
        ['title' => 'Throttle Body Cleaning', 'text' => 'FREE throttle body cleaning service.'],
        ['title' => 'Wax Polishing', 'text' => 'FREE car body wax polishing.']
    ];
@endphp

<section class="wptb-service-one z-index-2 bg-image-2 position-relative" style="background-image: url('{{ asset('front/assets/img/background/bg-1.png') }}');">
    <div class="wptb-item-layer wptb-item-layer-four slide-top-to-bottom">
        <img src="{{ asset('front/assets/img/more/object4.png') }}" alt="Decorative United Auto car service illustration">
    </div>
    <div class="container">
        <div class="wptb-heading">
            <div class="wptb-item--inner">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-7">
                        <h6 class="wptb-item--subtitle">Our Service List</h6>
                        <h1 class="wptb-item--title">Providing All Types of <br>Car <span>Maintenance</span> Services</h1>
                        <div class="wptb-item--divider"></div>
                    </div>
                    <div class="col-lg-5 col-md-5"></div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($services as $service)
                <div class="col-lg-4 col-sm-6">
                    <div class="wptb-image-box1 wow fadeInLeft">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--icon" aria-hidden="true">
                                <i class="bi bi-tools"></i>
                            </div>
                            <div class="wptb-item--holder">
                                <div class="wptb-item--image">
                                    <a href="{{ route('service.details', $service->slug) }}" class="wptb-item-link">
                                        <img src="{{ asset($service->category_image) }}" alt="{{ $service->name }}" loading="lazy">
                                    </a>
                                </div>
                                <div class="wptb-item--meta">
                                    <span class="wptb-item--label">{{ $service->name }}</span>
                                    <p class="wptb-item--description">{{ Str::limit(strip_tags($service->description), 90) }}</p>
                                    <a class="service-card-link" href="{{ route('service.details', $service->slug) }}">
                                        View Service <span aria-hidden="true">→</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="united-services" aria-labelledby="services-title">
    <div class="container">
        <header class="united-services-heading">
            <p class="united-services-eyebrow">Our Services</p>
            <h2 id="services-title">What We Provide</h2>
            <span class="united-services-rule" aria-hidden="true"></span>
            <p class="united-services-intro">Premium car care services to keep your vehicle running like new.</p>
        </header>

        <div class="united-services-layout">
            <div class="united-services-column united-services-column-left">
                @foreach(array_slice($showcaseDetails, 0, 4) as $index => $detail)
                    @php($service = $services->get($index))
                    <a class="united-service-card" href="{{ $service ? route('service.details', $service->slug) : route('book-appointment') }}">
                        <span class="united-service-icon" aria-hidden="true">
                            @if($index === 0)
                                <img src="{{ asset('images/services/engine-work.svg') }}" alt="">
                            @elseif($index === 1)
                                <img src="{{ asset('images/services/suspension-work.svg') }}" alt="">
                            @elseif($index === 2)
                                <img src="{{ asset('images/services/ac-service.svg') }}" alt="">
                            @elseif($index === 3)
                                <img src="{{ asset('images/services/car-washing.svg') }}" alt="">
                            @else
                                <i class="bi {{ $serviceIcons[$index] ?? 'bi-tools' }}"></i>
                            @endif
                        </span>
                        <span class="united-service-copy">
                            <strong>{{ $detail['title'] }}</strong>
                            <span>{{ $detail['text'] }}</span>
                        </span>
                        <i class="bi bi-arrow-right united-service-arrow" aria-hidden="true"></i>
                    </a>
                @endforeach
            </div>

            <div class="united-services-center" aria-hidden="true">
                <span class="united-services-dots"></span>
                <img src="{{ asset('front/assets/img/more/image.png') }}" alt="" loading="lazy">
            </div>

            <div class="united-services-column united-services-column-right">
                @foreach(array_slice($showcaseDetails, 4, 4) as $index => $detail)
                    @php($service = $services->get($index + 4))
                    <a class="united-service-card" href="{{ $service ? route('service.details', $service->slug) : route('book-appointment') }}">
                        <span class="united-service-icon" aria-hidden="true">
                            @if($index === 0)
                                <img src="{{ asset('images/services/discount.svg') }}" alt="">
                            @elseif($index === 1)
                                <img src="{{ asset('images/services/car-scan.svg') }}" alt="">
                            @elseif($index === 2)
                                <img src="{{ asset('images/services/throttle-body.svg') }}" alt="">
                            @elseif($index === 3)
                                <img src="{{ asset('images/services/car-polish.svg') }}" alt="">
                            @else
                                <i class="bi {{ $serviceIcons[$index + 4] ?? 'bi-tools' }}"></i>
                            @endif
                        </span>
                        <span class="united-service-copy">
                            <strong>{{ $detail['title'] }}</strong>
                            <span>{{ $detail['text'] }}</span>
                        </span>
                        <i class="bi bi-arrow-right united-service-arrow" aria-hidden="true"></i>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="united-services-footer">
            <span><i class="bi bi-check-circle-fill" aria-hidden="true"></i> Professional workshop care</span>
            <span><i class="bi bi-calendar-check-fill" aria-hidden="true"></i> <a href="{{ route('book-appointment') }}">Book your service appointment</a></span>
        </div>
    </div>
</section>
