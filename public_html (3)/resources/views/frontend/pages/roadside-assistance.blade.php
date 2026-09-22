@extends('frontend.partials.master')

@section('title', 'Roadside Assistance in Jamshedpur | United Auto')
@section('meta_description', 'Review United Auto roadside assistance information, booking steps, coverage details, and service conditions.')

@section('content')
@include('frontend.partials.breadcumbs')

<style>
    .roadside-terms {
        padding: 32px 0 120px;
    }

    .roadside-terms__intro {
        max-width: 780px;
        margin: 0 auto 42px;
        text-align: center;
    }

    .roadside-terms__intro p {
        max-width: 680px;
        margin: 18px auto 0;
        color: #666e85;
        font-size: 18px;
        line-height: 1.75;
    }

    .roadside-terms__grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
        max-width: 1080px;
        margin: 0 auto;
    }

    .roadside-terms__card {
        padding: 30px;
        border: 1px solid #e5e5e5;
        border-top: 4px solid #d70006;
        background: #fff;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
    }

    .roadside-terms__card--wide {
        grid-column: 1 / -1;
    }

    .roadside-terms__card h2 {
        margin-bottom: 16px;
        font-size: 26px;
    }

    .roadside-terms__card p,
    .roadside-terms__card li {
        color: #333;
        font-size: 17px;
        line-height: 1.7;
    }

    .roadside-terms__card ul {
        margin: 0;
        padding-left: 22px;
    }

    .roadside-terms__hours {
        display: grid;
        gap: 12px;
        margin: 0;
    }

    .roadside-terms__hours div {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #edf0f4;
    }

    .roadside-terms__hours dt {
        color: #666e85;
        font-weight: 600;
    }

    .roadside-terms__hours dd {
        margin: 0;
        color: #d70006;
        font-weight: 700;
        text-align: right;
    }

    .roadside-terms__pricing {
        width: 100%;
        border-collapse: collapse;
        font-size: 17px;
    }

    .roadside-terms__pricing th,
    .roadside-terms__pricing td {
        padding: 12px 10px;
        border-bottom: 1px solid #edf0f4;
        text-align: left;
    }

    .roadside-terms__pricing th:last-child,
    .roadside-terms__pricing td:last-child {
        color: #d70006;
        font-weight: 700;
        text-align: right;
    }

    .roadside-terms__actions {
        margin-top: 32px;
        text-align: center;
    }

    @media (max-width: 767px) {
        .roadside-terms {
            padding: 16px 0 80px;
        }

        .roadside-terms__intro p {
            font-size: 17px;
        }

        .roadside-terms__grid {
            grid-template-columns: 1fr;
        }

        .roadside-terms__card,
        .roadside-terms__card--wide {
            grid-column: auto;
            padding: 24px 20px;
        }

        .roadside-terms__card p,
        .roadside-terms__card li,
        .roadside-terms__pricing {
            font-size: 16px;
        }

        .roadside-terms__hours div {
            display: block;
        }

        .roadside-terms__hours dd {
            margin-top: 4px;
            text-align: left;
        }
    }
</style>

<section class="roadside-terms">
    <div class="container">
        <div class="wptb-heading roadside-terms__intro">
            <div class="wptb-item--inner">
                <h6 class="wptb-item--subtitle">ROAD SERVICE ASSISTANCE</h6>
                <h1 class="wptb-item--title">Roadside Assistance Terms</h1>
                <div class="wptb-item--divider mx-auto"></div>
                <p class="wptb-item--description">Please review the service hours, charges, coverage, and booking conditions before requesting roadside assistance.</p>
            </div>
        </div>

        <div class="roadside-terms__grid">
            <section class="roadside-terms__card" aria-labelledby="roadside-hours-title">
                <h2 id="roadside-hours-title">Working hours</h2>
                <dl class="roadside-terms__hours">
                    <div>
                        <dt>Road Service Assistance</dt>
                        <dd>9:00 am to 9:00 pm</dd>
                    </div>
                    <div>
                        <dt>Emergency Service</dt>
                        <dd>9:00 pm to 9:00 am</dd>
                    </div>
                    <div>
                        <dt>Emergency contact</dt>
                        <dd>{{ $company?->phone ?? 'Contact the workshop' }}</dd>
                    </div>
                </dl>
            </section>

            <section class="roadside-terms__card" aria-labelledby="roadside-charges-title">
                <h2 id="roadside-charges-title">Service charges</h2>
                <table class="roadside-terms__pricing">
                    <thead>
                        <tr>
                            <th scope="col">Distance</th>
                            <th scope="col">Charge</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>5 km</td><td>Rs. 500</td></tr>
                        <tr><td>7 km</td><td>Rs. 700</td></tr>
                        <tr><td>15 km</td><td>Rs. 1,000</td></tr>
                        <tr><td>25 km</td><td>Rs. 1,500</td></tr>
                    </tbody>
                </table>
            </section>

            <section class="roadside-terms__card roadside-terms__card--wide" aria-labelledby="roadside-process-title">
                <h2 id="roadside-process-title">Booking and technician dispatch</h2>
                <p>The technician will start after successful completion of the booking formality and will reach as fast as possible according to the distance.</p>
            </section>

            <section class="roadside-terms__card" aria-labelledby="minor-breakdown-title">
                <h2 id="minor-breakdown-title">Minor breakdown cover</h2>
                <ul>
                    <li>Battery jump start</li>
                    <li>Flattened tyre replacement</li>
                    <li>Fuel supply up to Rs. 500 extra</li>
                    <li>Minor electrical and mechanical problems according to standard tools and tackles available for breakdown assistance</li>
                </ul>
            </section>

            <section class="roadside-terms__card" aria-labelledby="major-breakdown-title">
                <h2 id="major-breakdown-title">Major breakdown cover</h2>
                <ul>
                    <li>Towing of the vehicle to the workshop, with charges extra</li>
                    <li>Passenger drop to the destination by private car, with charges extra</li>
                </ul>
            </section>

            <section class="roadside-terms__card roadside-terms__card--wide" aria-labelledby="roadside-benefits-title">
                <h2 id="roadside-benefits-title">Additional benefits</h2>
                <ul>
                    <li>Estimate will be provided to the customer free of cost.</li>
                    <li>All service charges will be removed from the final bill if the work is done by United Auto.</li>
                    <li>Discount on labour charges is available if enrolled for our Service Card.</li>
                    <li>References will attract one extra value-added service on the next visit within the listed options.</li>
                </ul>
                <div class="roadside-terms__actions">
                    <a class="btn-two" href="{{ route('book-appointment') }}"><span class="btn-wrap"><span class="text-first">Book assistance</span><span class="text-second"><i class="bi bi-arrow-right"></i></span></span></a>
                    <a class="btn-outline ms-2" href="{{ route('contact-us') }}">Workshop location</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection