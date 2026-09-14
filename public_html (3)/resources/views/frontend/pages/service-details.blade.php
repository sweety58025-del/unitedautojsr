@extends('frontend.partials.master')

@section('title', 'Service Details')

@section('content')

@include('frontend.partials.breadcumbs')

<style>
    .service-details-section{
        padding:80px 0;
    }

    .service-image img{
        width:100%;
        height:auto;
        object-fit:cover;
    }

    .service-title{
        font-size:32px;
        font-weight:600;
    }

    .service-description{
        font-size:16px;
        line-height:1.7;
    }
</style>

<section class="service-details-section pt-5 pb-5">

    <div class="container">

        <div class="row align-items-center" style="background: #000">

            <!-- Left Side Image -->
            <div class="col-lg-6 col-md-6 mb-4">

                <div class="service-image">

                    <img 
                        src="{{ asset($serviceCategory?->category_image ?? 'front/assets/img/more/image.png') }}"
                        alt="{{ $service->name }}"
                        class="img-fluid rounded">

                </div>

            </div>

            <!-- Right Side Content -->
            <div class="col-lg-6 col-md-6">

                <div class="service-content">

                    <h2 class="service-title mb-3">
                        {{ $service->name }}
                    </h2>

                    <p class="service-description">
                        {!! nl2br(e($service->description ?: 'Professional vehicle care from the United Auto workshop team.')) !!}
                    </p>

                    @if($categoryServices->isNotEmpty())
                        <div class="service-description mt-4">
                            <h3>Services in this category</h3>
                            <ul>
                                @foreach($categoryServices as $item)
                                    <li>{{ $item->name }}@if($item->description) - {{ $item->description }}@endif</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>

            </div>

        </div>

    </div>

</section>

<br><br><br><br><br>

@endsection