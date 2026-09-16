@extends('frontend.partials.master')

@section('title', 'Roadside Assistance')

@section('content')
@include('frontend.partials.breadcumbs')

<section class="pd-bottom-300 pt-5">
    <div class="container">
        <div class="wptb-heading text-center mr-bottom-60">
            <div class="wptb-item--inner">
                <h6 class="wptb-item--subtitle">ROAD SERVICE ASSISTANCE</h6>
                <h1 class="wptb-item--title">Help when your vehicle needs it</h1>
                <div class="wptb-item--divider mx-auto"></div>
                <p class="wptb-item--description">Road service assistance is available from 9:00 AM to 9:00 PM. Emergency service is available from 9:00 PM to 9:00 AM.</p>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-lg-9">
                <div class="wptb-service-one p-5">
                    <h2>Available assistance</h2>
                    <p class="mt-3">Technician dispatch after booking completion, battery jump start, flattened tyre replacement, fuel supply subject to applicable additional cost, and minor electrical or mechanical assistance based on available tools.</p>
                    <p>Towing for major breakdowns, passenger drop assistance, and other applicable charges are handled according to the business rules for the service.</p>
                    <p>Free estimates, service-charge removal from the final bill where applicable, labour discounts for service-card customers, and referral benefits remain subject to eligibility and approved terms.</p>
                    <div class="mt-4">
                        <a class="btn-two" href="{{ route('book-appointment') }}"><span class="btn-wrap"><span class="text-first">Book assistance</span><span class="text-second"><i class="bi bi-arrow-right"></i></span></span></a>
                        <a class="btn-outline ms-2" href="{{ route('contact-us') }}">Workshop location</a>
                    </div>
                    <p class="mt-4 mb-0"><strong>Terms and conditions:</strong> Additional charges and availability depend on the vehicle, location, tools, and assistance required.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection