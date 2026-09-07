@extends('frontend.partials.master')

@section('title', 'Offers')

@section('content')
@include('frontend.partials.breadcumbs')

<section class="pd-bottom-300 pt-5">
    <div class="container">
        <div class="wptb-heading text-center mr-bottom-60">
            <div class="wptb-item--inner">
                <h6 class="wptb-item--subtitle">UNITED AUTO OFFERS</h6>
                <h1 class="wptb-item--title">Benefits for your next visit</h1>
                <div class="wptb-item--divider mx-auto"></div>
                <p class="wptb-item--description">Promotional card artwork and approved offer terms will be published here when the final business content is available.</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="wptb-service-one p-5">
                    <h2>Service card benefits</h2>
                    <p class="mt-3">The approved service-card artwork and promotion details are not currently available as structured repository data.</p>
                    <a class="btn-two mt-3" href="{{ route('book-appointment') }}"><span class="btn-wrap"><span class="text-first">Book an appointment</span><span class="text-second"><i class="bi bi-arrow-right"></i></span></span></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection