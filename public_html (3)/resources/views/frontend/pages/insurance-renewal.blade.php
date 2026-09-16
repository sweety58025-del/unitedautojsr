@extends('frontend.partials.master')

@section('title', 'Insurance Renewal')

@section('content')
@include('frontend.partials.breadcumbs')
@include('frontend.components.insurance-directory-styles')

<section class="insurance-directory">
    <div class="container">
        <div class="wptb-heading insurance-directory__intro">
            <div class="wptb-item--inner">
                <h6 class="wptb-item--subtitle">INSURANCE SERVICE</h6>
                <h1 class="wptb-item--title">Insurance Renewal</h1>
                <div class="wptb-item--divider mx-auto"></div>
                <p>Get guidance for renewing your vehicle insurance through these supported providers.</p>
            </div>
        </div>

        <div class="insurance-directory__panel">
            <h2>Insurance renewal providers</h2>
            <ul class="insurance-directory__list">
                        <li>Tata AIG</li>
                        <li>SBI General</li>
            </ul>
            <div class="insurance-directory__action">
                <a class="btn-two" href="{{ route('contact-us') }}"><span class="btn-wrap"><span class="text-first">Contact the workshop</span><span class="text-second"><i class="bi bi-arrow-right"></i></span></span></a>
            </div>
        </div>
    </div>
</section>
@endsection
