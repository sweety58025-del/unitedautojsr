@extends('frontend.partials.master')

@section('title', 'Car Insurance Renewal Support | United Auto')
@section('meta_description', 'Get information about vehicle insurance renewal support from United Auto in Jamshedpur.')

@section('content')
@include('frontend.partials.breadcumbs')
@include('frontend.components.insurance-directory-styles')

<section class="insurance-directory">
    <div class="container">
        <div class="wptb-heading insurance-directory__intro">
            <div class="wptb-item--inner">
                <h6 class="wptb-item--subtitle">RENEWAL SUPPORT</h6>
                <h1 class="wptb-item--title">Insurance Renewal</h1>
                <div class="wptb-item--divider mx-auto"></div>
                <p>Connect with the workshop for renewal guidance through the providers listed below.</p>
            </div>
        </div>

        <div class="insurance-directory__panel">
            <h2>Insurance renewal providers</h2>
            <ul class="insurance-directory__list">
                        <li>Tata AIG</li>
                        <li>SBI General</li>
            </ul>
            <div class="insurance-directory__action">
                <a class="btn-two" href="{{ route('contact-us') }}"><span class="btn-wrap"><span class="text-first">Ask about renewal</span><span class="text-second"><i class="bi bi-arrow-right"></i></span></span></a>
            </div>
        </div>
    </div>
</section>
@endsection
