@php
use App\Models\ServicePrice;
$servicePrices = ServicePrice::allPrices();
@endphp
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