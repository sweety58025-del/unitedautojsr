@php
    use App\Models\Brand;
    $brands = Brand::allBrands();
@endphp

<div class="container">

    <div class="wptb-heading">
        <div class="wptb-item--inner text-center">
            <h1 class="wptb-item--title">Our <span>Brands</span></h1>
            <div class="wptb-item--divider"></div>
        </div>
    </div>

    <div class="row g-4">

        @foreach($brands as $brand)

            <div class="col-lg-2-4 col-md-4 col-6">

                <div class="brand-box text-center">

                    <img 
                        src="{{ asset($brand->image) }}" 
                        alt="{{ $brand->name }}" 
                        class="img-fluid brand-logo">

                </div>

            </div>

        @endforeach

    </div>

</div>