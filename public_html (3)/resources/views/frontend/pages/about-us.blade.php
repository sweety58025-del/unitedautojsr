@extends('frontend.partials.master')
@section('title', 'About Us')
@section('meta_description', 'Learn about United Auto, our workshop expertise, quality service standards, and trusted car care in Jamshedpur.')
@section('og_title', 'About United Auto | Trusted Car Service in Jamshedpur')

@section('content')

@include('frontend.partials.breadcumbs')

<section class="wptb-intro-one pd-bottom-50 about-section">

<div class="container">

@if($about_us)

    <div class="row">
        <div class="col-md-5">
            <!-- About Image -->
            <div class="wptb-image-single mb-4 d-inline-block wow fadeInUp">

                <div class="wptb-item--inner">

                    <div class="wptb-item--image">

                        <img src="{{ asset($about_us->about_image) }}" 
                        alt="about-image" 
                        class="img-fluid">

                    </div>

                </div>

            </div>
        </div>
        <div class="col-md-7">
            <!-- Title -->
            <h1 class="wptb-item--title text-white ">
                {{ $about_us->about_title }}
            </h1>
            <br><br>

            <!-- Short Description -->
            <p class="wptb-item--description text-white">
                {{ $about_us->short_description }}
            </p>
        </div>
    </div>
    


    <!-- About Content -->
    <div class="wptb-heading mb-0 mt-3">

        <div class="wptb-item--inner">

            <!-- Full Description -->
            <p class="wptb-item--description text-white">
                {!! $about_us->short_description !!}
            </p>
            <p class="wptb-item--description text-white">
                {!! $about_us->description !!}
            </p>

        </div>

    </div>


    <!-- Mission & Vision -->
    <div class="row mt-5">

        <!-- Mission -->
        <div class="col-md-6">

            <div class="mission-box" style="background: #202020; padding: 20px;">

                <h3 class="text-white">Our Mission</h3>

                <p class="text-white">
                    {{ $about_us->mission }}
                </p>

            </div>

        </div>


        <!-- Vision -->
        <div class="col-md-6">

            <div class="vision-box" style="background: #202020; padding: 20px;">

                <h3 class="text-white">Our Vision</h3>

                <p class="text-white">
                    {{ $about_us->vision }}
                </p>

            </div>

        </div>

    </div>

@else
    <div class="row">
        <div class="col-12">
            <h1 class="wptb-item--title text-white">About United Auto</h1>
            <p class="wptb-item--description text-white">Our about information will be available soon.</p>
        </div>
    </div>
@endif

</div>

</section>

<br><br><br><br>

@endsection