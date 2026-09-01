@php
    use App\Models\HeroBanner;
    $banner = HeroBanner::first();
    $banner_image = $banner ? $banner->banner_image : "";
@endphp

<!-- Slider Section -->
<section class="wptb-slider style3 pt-0">
    <div class="wptb-slider--item">
        <div class="wptb-slider--image" style="background-image: url('{{ asset($banner_image) }}');"></div>
        <div class="container">
            <div class="wptb-slider--inner">
                <div class="row">
                    <!-- Content Column -->
                    <div class="col-lg-8 col-md-12 offset-lg-2">
                        <div class="wptb-heading">
                            <div class="wptb-item--inner text-center">
                                <h6 class="wptb-item--subtitle"> <span class="text-one"> {{ $banner->sub_title ?? '' }}</span> </h6>
                                <h1 class="wptb-item--title"> {{ $banner->main_title ?? '' }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wptb-image-single wow fadeInUp d-none d-sm-block">
            <div class="wptb-item--inner">
                <div class="wptb-item--image">
                    <img src="{{ asset('front/assets/img/slider/car-2.png') }}" alt="img" style="position:absolute;left:50%;transform:translateX(-50%);bottom:0;max-width:100%;height:auto;">
                    <img src="{{ asset('front/assets/img/slider/car-light.png') }}" alt="img" class="car-light" style="position:absolute;left:50%;transform:translateX(-50%);bottom:120px;max-width:100%;height:auto;">
                </div>
            </div>
        </div>
    </div>
</section>