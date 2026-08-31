@extends('frontend.partials.master')

@section('title', 'Gallery')

@section('content')

@include('frontend.partials.breadcumbs')
<style>
    .wptb-gallery-section {
        padding: 80px 0;
    }

    .gallery-item {
        overflow: hidden;
        border-radius: 6px;
        background: #000;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .gallery-image img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .gallery-content {
        text-align: center;
        padding: 10px;
    }

    .gallery-content h5 {
        font-size: 16px;
        margin: 0;
    }
</style>
<section class="wptb-gallery-section pt-5 pb-5">

    <div class="container">

        <div class="row">

            @foreach($gallery as $item)

                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                    <div class="gallery-item">

                        <!-- Gallery Image -->
                        <div class="gallery-image">

                            <img 
                                src="{{ asset($item->image) }}" 
                                alt="{{ $item->name }}" 
                                class="img-fluid"
                            >

                        </div>

                        <!-- Gallery Title -->
                        <div class="gallery-content">

                            <h5>{{ $item->name }}</h5>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>
<br><br><br><br><br>
@endsection