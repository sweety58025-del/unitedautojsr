@php
use App\Models\Testimonial;
$testimonials = Testimonial::latestTestimonials();
@endphp

<section class="wptb-testimonial-one ua-testimonials-carousel"
style="background-image: url('{{ asset('front/assets/img/background/bg-3.jpg') }}');">

<div class="container">
    <div class="wptb-heading">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="wptb-item--inner">
                    <h6 class="wptb-item--subtitle">Clients Testimonial</h6>
                    <h1 class="wptb-item--title">What Our Clients Say About <span>United Auto</span></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="swiper-container swiper-testimonial ua-testimonials__viewport">
        <div class="swiper-wrapper">
            @foreach($testimonials as $testimonial)
                @php
                    $vehicleOrService = trim((string) ($testimonial->vehicle ?? ''));
                    if (!empty($testimonial->vehicle_brand)) {
                        $vehicleOrService = $testimonial->vehicle_brand . ($vehicleOrService !== '' ? ' • ' : '') . $vehicleOrService;
                    }
                    $customerName = $testimonial->customer_name ?: 'United Auto customer';
                    $initials = collect(explode(' ', trim($customerName)))
                        ->filter()
                        ->take(2)
                        ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
                        ->implode('');
                @endphp

                <div class="swiper-slide">
                    <div class="wptb-testimonial1">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--holder">
                                <div class="ua-testimonials__topline">
                                    <div class="ua-testimonials__reviewer">
                                        @if($testimonial->image)
                                            <img class="ua-testimonials__avatar" src="{{ asset($testimonial->image) }}" alt="{{ $customerName }}">
                                        @else
                                            <span class="ua-testimonials__avatar ua-testimonials__initials" aria-hidden="true">{{ $initials }}</span>
                                        @endif
                                        <div>
                                            <h4 class="wptb-item--title">{{ $customerName }}</h4>
                                            <span class="ua-testimonials__date">{{ optional($testimonial->created_at)->format('j F Y') }}</span>
                                        </div>
                                    </div>
                                    <span class="ua-google-mark" aria-label="Google review">G</span>
                                </div>

                                <div class="wptb-item--meta-rating" aria-label="{{ $testimonial->rating ?: 5 }} out of 5 stars">
                                    @for($star = 1; $star <= 5; $star++)
                                        <i class="bi {{ $star <= ($testimonial->rating ?: 5) ? 'bi-star-fill' : 'bi-star' }}" aria-hidden="true"></i>
                                    @endfor
                                    <span class="ua-rating-value">{{ number_format((float) ($testimonial->rating ?: 5), 1) }}</span>
                                </div>

                                <p class="wptb-item--description">“{{ $testimonial->review }}”</p>

                                @if($vehicleOrService !== '')
                                    <span class="testimonial-detail">{{ $vehicleOrService }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="ua-testimonials__controls" aria-label="Customer feedback navigation">
        <div class="ua-testimonials__pagination"></div>
    </div>
</div>
</section>