@extends('frontend.partials.master')

@section('title', $pageContent->meta_title ?: 'Vehicle Insurance Support | United Auto')
@section('meta_description', $pageContent->meta_description ?: 'Learn how United Auto supports vehicle repair workflows after an accident in Jamshedpur.')

@section('content')
@include('frontend.partials.breadcumbs')

<section class="pd-bottom-300 pt-5">
    <div class="container">
        <div class="wptb-heading text-center mr-bottom-60">
            <div class="wptb-item--inner">
                <h6 class="wptb-item--subtitle">{{ $pageContent->eyebrow }}</h6>
                <h1 class="wptb-item--title">{{ $pageContent->title }}</h1>
                <div class="wptb-item--divider mx-auto"></div>
                <p class="wptb-item--description">{{ $pageContent->intro }}</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="wptb-service-one p-5">
                    <h2>{{ $pageContent->section_one_title }}</h2>
                    <p class="mt-3">{{ $pageContent->section_one_body }}</p>
                    <a class="btn-two mt-3" href="{{ route('contact-us') }}"><span class="btn-wrap"><span class="text-first">Contact the workshop</span><span class="text-second"><i class="bi bi-arrow-right"></i></span></span></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection