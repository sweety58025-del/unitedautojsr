@php
use App\Models\Testimonial;
$testimonials = Testimonial::latestTestimonials();
@endphp

<section class="wptb-testimonial-one bg-image"
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

    <div class="swiper-container swiper-testimonial">
        <div class="swiper-wrapper">
            @foreach($testimonials as $testimonial)
                @php
                    $vehicleOrService = trim((string) ($testimonial->vehicle ?? ''));
                    if (!empty($testimonial->service)) {
                        $vehicleOrService .= ($vehicleOrService !== '' ? ' • ' : '') . $testimonial->service;
                    }
                @endphp

                <div class="swiper-slide">
                    <div class="wptb-testimonial1">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--icon mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="57" height="45" viewBox="0 0 57 45" fill="none">
                                    <path d="M51.5137 38.5537C56.8209 32.7938 56.2866 25.3969 56.2697 25.3125V2.8125C56.2697 2.06658 55.9734 1.35121 55.4459 0.823763C54.9185 0.296317 54.2031 0 53.4572 0H36.5822C33.48 0 30.9572 2.52281 30.9572 5.625V25.3125C30.9572 26.0584 31.2535 26.7738 31.781 27.3012C32.3084 27.8287 33.0238 28.125 33.7697 28.125H42.4266C42.3671 29.5155 41.9517 30.8674 41.22 32.0513C39.7913 34.3041 37.0997 35.8425 33.2156 36.6188L30.9572 37.0688V45H33.7697C41.5969 45 47.5678 42.8316 51.5137 38.5537Z" fill="#D70006"/>
                                </svg>
                            </div>

                            <div class="wptb-item--holder">
                                <div class="wptb-item--meta-rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>

                                <div class="testimonial-badge">Verified Customer</div>

                                <p class="wptb-item--description">“{{ $testimonial->feedback }}”</p>

                                <div class="wptb-item--meta">
                                    <div class="wptb-item--meta-left">
                                        <h4 class="wptb-item--title">{{ $testimonial->username }}</h4>
                                        @if($vehicleOrService !== '')
                                            <span class="testimonial-detail">{{ $vehicleOrService }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</section>

<style>
    .wptb-testimonial1 .wptb-item--inner {
        background: rgba(17, 17, 17, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 18px;
        padding: 28px 24px;
        height: 100%;
    }

    .wptb-item--meta-rating {
        display: inline-flex;
        gap: 6px;
        color: #f5c451;
        margin-bottom: 16px;
    }

    .testimonial-badge {
        display: inline-flex;
        align-items: center;
        width: fit-content;
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(215, 0, 6, 0.12);
        color: var(--color-one);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin-bottom: 14px;
    }

    .wptb-item--description {
        margin-bottom: 20px;
        color: rgba(255,255,255,0.82);
        font-size: 15px;
        line-height: 1.8;
    }

    .wptb-item--meta-left {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .wptb-item--meta-left .wptb-item--title {
        margin: 0;
        color: var(--color-white);
        font-size: 22px;
    }

    .testimonial-detail {
        color: rgba(255,255,255,0.64);
        font-size: 12px;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }
</style>