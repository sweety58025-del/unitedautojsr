@extends('frontend.partials.master')

@section('title', $topic . ' Services in Jamshedpur | United Auto')
@section('meta_description', 'Learn about ' . $topic . ' service options from United Auto in Jamshedpur and book an appointment with the workshop team.')

@section('content')
@include('frontend.partials.breadcumbs')

<style>
    .service-topic-section { padding: 80px 0; }
    .service-topic-panel { background: #000; }
    .service-topic-panel .service-image img { width: 100%; height: auto; object-fit: cover; }
    .service-topic-panel .service-title { color: #fff; font-size: 32px; font-weight: 600; }
    .service-topic-panel .service-description { color: rgba(255, 255, 255, 0.78); font-size: 16px; line-height: 1.7; }
    .service-topic-category { color: rgba(255, 255, 255, 0.62); font-size: 14px; }
</style>

<section class="service-topic-section pt-5 pb-5">
    <div class="container">
        <div class="row align-items-center service-topic-panel">
            <div class="col-lg-6 col-md-6 mb-4 mb-lg-0">
                @if($service?->category?->category_image)
                    <div class="service-image">
                        <img src="{{ asset($service->category->category_image) }}" alt="{{ $topic }}" class="img-fluid rounded">
                    </div>
                @endif
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="service-content">
                    <h1 class="service-title mb-3">{{ $topic }}</h1>
                    @if($service)
                        <p class="service-description">{!! nl2br(e($service->description ?: $service->notes ?: 'Professional vehicle care from the United Auto workshop team.')) !!}</p>
                        @if($service->category)
                            <p class="service-topic-category">Category: {{ $service->category->name }}</p>
                        @endif
                    @else
                        <p class="service-description">Professional {{ strtolower($topic) }} support from the United Auto workshop team. Contact us to confirm availability and arrange your service.</p>
                    @endif
                    <a class="btn btn-primary mt-3" href="{{ route('book-appointment', ['service' => $service?->slug ?: Str::slug($topic)]) }}">Book This Service</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection