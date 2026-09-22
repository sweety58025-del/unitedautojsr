@extends('frontend.partials.master')

@section('title', $service->name . ' in Jamshedpur | United Auto')
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($service->content ?: $service->description ?: 'United Auto provides vehicle service and repair support in Jamshedpur.'), 155))

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

                    <h1 class="service-title mb-3">
                        {{ $service->name }}
                    </h1>

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

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    'name' => $service->name,
    'description' => strip_tags($service->content ?: $service->description ?: ''),
    'provider' => ['@id' => $businessId],
    'areaServed' => ['@type' => 'City', 'name' => $company?->city ?: 'Jamshedpur'],
    'url' => $canonicalUrl,
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}
</script>

<br><br><br><br><br>

@endsection