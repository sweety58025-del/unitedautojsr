@extends('frontend.partials.master')

@section('title', 'Brands We Service')

@section('content')
@include('frontend.partials.breadcumbs')

<section class="pd-bottom-300 pt-5">
    <div class="container">
        <div class="wptb-heading text-center mr-bottom-60">
            <div class="wptb-item--inner">
                <h6 class="wptb-item--subtitle">BRANDS WE SERVICE</h6>
                <h1 class="wptb-item--title">Trusted care for your vehicle</h1>
                <div class="wptb-item--divider mx-auto"></div>
            </div>
        </div>

        <div class="brands-grid">
            @forelse($brands as $brand)
                <article class="brand-card" id="{{ $brand->slug }}">
                    <div class="brand-card__topline">
                        <span class="brand-card__index"><i class="bi bi-car-front-fill" aria-hidden="true"></i> {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="brand-card__status">Supported brand</span>
                    </div>

                    <div class="brand-card__logo-stage">
                        @if($brand->image)
                            <img src="{{ asset($brand->image) }}" alt="{{ $brand->name }} logo" loading="lazy">
                        @else
                            <span class="brand-card__fallback">{{ str($brand->name)->substr(0, 1) }}</span>
                        @endif
                    </div>

                    <div class="brand-card__footer">
                        <div class="brand-card__name">
                            <span class="brand-card__eyebrow">We service</span>
                            <h2>{{ $brand->name }}</h2>
                        </div>
                        <span class="brand-card__signal" aria-hidden="true"><i class="bi bi-tools"></i></span>
                    </div>
                </article>
            @empty
                <div class="brands-empty"><p>No supported brands are available yet.</p></div>
            @endforelse
        </div>
    </div>
</section>
@endsection