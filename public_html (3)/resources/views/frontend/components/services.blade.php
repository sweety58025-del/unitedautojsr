@php
    use App\Models\Service;
    use Illuminate\Support\Facades\Schema;
    $services = Schema::hasTable((new Service)->getTable())
        ? Service::with('category')
            ->where('status', 'yes')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
        : collect();
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
@endphp

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
                @foreach($services->take(4) as $index => $service)
                    <a class="united-service-card" href="{{ $service ? route('service.details', $service->slug ?: Str::slug($service->name)) : route('book-appointment') }}">
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
                            <strong>{{ $service->name }}</strong>
                            <span>{{ Str::limit(strip_tags($service->description ?: $service->notes ?: $service->category?->description ?: 'Professional vehicle care from the United Auto workshop team.'), 110) }}</span>
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
                @foreach($services->slice(4, 4) as $index => $service)
                    <a class="united-service-card" href="{{ $service ? route('service.details', $service->slug ?: Str::slug($service->name)) : route('book-appointment') }}">
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
                            <strong>{{ $service->name }}</strong>
                            <span>{{ Str::limit(strip_tags($service->description ?: $service->notes ?: $service->category?->description ?: 'Professional vehicle care from the United Auto workshop team.'), 110) }}</span>
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
