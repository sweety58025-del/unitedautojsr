@extends('frontend.partials.master')

@section('title', 'Insurance Claim Partner')

@section('content')
@include('frontend.partials.breadcumbs')
@include('frontend.components.insurance-directory-styles')

<section class="insurance-directory">
    <div class="container">
        <div class="wptb-heading insurance-directory__intro">
            <div class="wptb-item--inner">
                <h6 class="wptb-item--subtitle">INSURANCE SERVICE</h6>
                <h1 class="wptb-item--title">Insurance Claim Partner</h1>
                <div class="wptb-item--divider mx-auto"></div>
                <p>United Auto works with the following insurance providers to support your vehicle claim journey.</p>
            </div>
        </div>

        <div class="insurance-directory__panel">
            <h2>Our insurance claim partners</h2>
            <ul class="insurance-directory__list">
                        <li>SBI General</li>
                        <li>Royal Sundaram</li>
                        <li>Liberty</li>
                        <li>Go Digit</li>
                        <li>National Insurance</li>
                        <li>Kotak</li>
                        <li>Future</li>
                        <li>Reliance</li>
                        <li>Universal Sompo</li>
                        <li>HDFC Ergo</li>
                        <li>Oriental</li>
                        <li>Chola MS</li>
                        <li>Magma</li>
                        <li>Bharti</li>
                        <li>ACCO</li>
                        <li>Bajaj Alliance</li>
                        <li>New India</li>
                        <li>Tata AIG</li>
            </ul>
            <div class="insurance-directory__action">
                <a class="btn-two" href="{{ route('contact-us') }}"><span class="btn-wrap"><span class="text-first">Contact the workshop</span><span class="text-second"><i class="bi bi-arrow-right"></i></span></span></a>
            </div>
        </div>
    </div>
</section>
@endsection
