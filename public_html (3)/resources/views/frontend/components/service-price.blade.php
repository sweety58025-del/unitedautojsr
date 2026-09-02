@php
use App\Models\ServicePrice;
$servicePrices = ServicePrice::allPrices();
@endphp
<style>
    /* Table text color */
    .service-price-table{
    color:#ffffff;
    border:1px solid #444;
    }

    /* Header */

    .service-price-table thead{
    background:#D70006;
    color:#ffffff;
    }

    .service-price-table th,
    .service-price-table td{
    border:1px solid #444;
    padding:12px;
    text-align:center;
    }

    /* Hover effect */

    .service-price-table tbody tr:hover{
    background:#111;
    }

    /* First column align */

    .service-price-table td:first-child{
    text-align:left;
    font-weight:500;
    }
</style>
<div class="container my-5">

    <div class="wptb-heading">
        <div class="wptb-item--inner text-center">
            <h1 class="wptb-item--title">Our <span>Service Prices</span></h1>
            <div class="wptb-item--divider"></div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">

            <div class="table-responsive">

                <table class="table service-price-table">

                    <thead>
                        <tr>
                            <th>Service Item</th>
                            <th>Small Car</th>
                            <th>Medium Car</th>
                            <th>SUV / MUV</th>
                            <th>Premium Car</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($servicePrices as $price)

                        <tr>
                            <td>{{ $price->item }}</td>
                            <td>₹{{ $price->small_car_price }}</td>
                            <td>₹{{ $price->medium_price }}</td>
                            <td>₹{{ $price->suv_muv_price }}</td>
                            <td>₹{{ $price->premium_price }}</td>
                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>