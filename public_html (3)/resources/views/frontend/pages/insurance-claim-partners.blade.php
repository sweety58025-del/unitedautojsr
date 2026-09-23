@extends('frontend.partials.master')

@section('title', $pageContent->meta_title ?: 'Insurance Claim Support | United Auto')
@section('meta_description', $pageContent->meta_description ?: 'Learn how United Auto supports vehicle insurance claim repair coordination through its workshop in Jamshedpur.')

@section('content')
@include('frontend.partials.breadcumbs')
@include('frontend.components.insurance-directory-styles')

<section class="insurance-directory">
    <div class="container">
        <div class="wptb-heading insurance-directory__intro">
            <div class="wptb-item--inner">
                <h6 class="wptb-item--subtitle">{{ $pageContent->eyebrow }}</h6>
                <h1 class="wptb-item--title">{{ $pageContent->title }}</h1>
                <div class="wptb-item--divider mx-auto"></div>
                <p>{{ $pageContent->intro }}</p>
            </div>
        </div>

        <div class="insurance-directory__panel">
            <h2>{{ $pageContent->section_one_title }}</h2>
            <ul class="insurance-directory__list">
                @foreach($pageContent->list_items as $item)<li>{{ $item }}</li>@endforeach
            </ul>
            <div class="insurance-directory__action">
                <a class="btn-two" href="{{ route('contact-us') }}"><span class="btn-wrap"><span class="text-first">Discuss a claim</span><span class="text-second"><i class="bi bi-arrow-right"></i></span></span></a>
            </div>
        </div>
    </div>
</section>
@endsection
