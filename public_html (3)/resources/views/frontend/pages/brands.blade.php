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

        <div class="row">
            @forelse($brands as $brand)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4" id="{{ $brand->slug }}">
                    <div class="wptb-image-box1 h-100">
                        <div class="wptb-item--inner">
                            @if($brand->image)
                                <div class="wptb-item--image">
                                    <img src="{{ asset($brand->image) }}" alt="{{ $brand->name }} logo" loading="lazy">
                                </div>
                            @endif
                            <div class="wptb-item--meta">
                                <span class="wptb-item--label">{{ $brand->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center"><p>No supported brands are available yet.</p></div>
            @endforelse
        </div>
    </div>
</section>
@endsection