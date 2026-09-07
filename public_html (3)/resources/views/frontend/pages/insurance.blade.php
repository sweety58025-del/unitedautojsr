@extends('frontend.partials.master')

@section('title', 'Insurance')

@section('content')
@include('frontend.partials.breadcumbs')

<section class="pd-bottom-300 pt-5">
    <div class="container">
        <div class="wptb-heading text-center mr-bottom-60">
            <div class="wptb-item--inner">
                <h6 class="wptb-item--subtitle">INSURANCE ASSISTANCE</h6>
                <h1 class="wptb-item--title">Repair support after an accident</h1>
                <div class="wptb-item--divider mx-auto"></div>
                <p class="wptb-item--description">United Auto can support the repair workflow for your vehicle. The approved insurance pricing chart is not currently available as structured repository data.</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="wptb-service-one p-5">
                    <h2>Insurance repair workflow</h2>
                    <p class="mt-3">Bring your vehicle and policy information to the workshop so the team can review the repair requirements and guide the next steps.</p>
                    <a class="btn-two mt-3" href="{{ route('contact-us') }}"><span class="btn-wrap"><span class="text-first">Contact the workshop</span><span class="text-second"><i class="bi bi-arrow-right"></i></span></span></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection