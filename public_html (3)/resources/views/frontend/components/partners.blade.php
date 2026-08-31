@php
    use App\Models\Brand;
    $brands = Brand::all();
@endphp

<style>
    /* ===== 5 Columns for Large Screen ===== */

    .col-lg-2-4{
        flex: 0 0 20%;
        max-width: 20%;
    }


    /* ===== 3 Columns for Tablet ===== */

    @media (max-width: 991px){

    .col-lg-2-4{
        flex: 0 0 33.33%;
        max-width: 33.33%;
    }

    }


    /* ===== 2 Columns for Mobile ===== */

    @media (max-width: 576px){

    .col-lg-2-4{
        flex: 0 0 50%;
        max-width: 50%;
    }

    }


    /* ===== Brand Box Design ===== */

    .brand-box{
        background:#f8f9fa;
        border:2px solid #000;
        padding:25px;
        height:120px;

        display:flex;
        align-items:center;
        justify-content:center;

        transition:all 0.3s ease;
    }


    /* ===== Logo Size ===== */

    .brand-logo{
        max-height:60px;
        object-fit:contain;
    }


    /* ===== Hover Effect ===== */

    .brand-box:hover{
        background:#ffffff;
        transform:scale(1.05);
    }
</style>

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