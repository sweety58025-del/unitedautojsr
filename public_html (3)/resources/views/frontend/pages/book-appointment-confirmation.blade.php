@extends('frontend.partials.master')
@section('title', 'Appointment Confirmed')
@section('content')
@include('frontend.partials.breadcumbs')

<section class="pd-bottom-300">
    <div class="container">
        <div class="booking-confirm-card mx-auto text-center">
            <div class="booking-confirm-icon">
                <i class="bi bi-check2-circle"></i>
            </div>
            <h2 class="mr-top-20">Appointment Request Received</h2>
            <p class="text-muted">
                Thank you, {{ $appointment->customer_name }}. We've received your request and will confirm your slot shortly via {{ $appointment->preferred_contact_method }}.
            </p>

            <div class="booking-summary text-start mr-top-30">
                <div class="booking-summary-row"><span>Service</span><strong>{{ $appointment->service_name }}</strong></div>
                <div class="booking-summary-row"><span>Vehicle</span><strong>{{ $appointment->vehicle_make_model }}</strong></div>
                <div class="booking-summary-row"><span>Registration No.</span><strong>{{ $appointment->registration_number }}</strong></div>
                <div class="booking-summary-row"><span>Date &amp; Time</span><strong>{{ $appointment->appointment_date->format('j M Y') }} · {{ $appointment->appointment_time }}</strong></div>
                <div class="booking-summary-row"><span>Phone</span><strong>{{ $appointment->customer_phone }}</strong></div>
                <div class="booking-summary-row"><span>Status</span><strong class="text-capitalize">{{ $appointment->status }}</strong></div>
            </div>

            <a href="{{ url('/') }}" class="btn-two white mr-top-30">
                <span class="btn-wrap">
                    <span class="text-first">Back to Home</span>
                    <span class="text-second"><i class="bi bi-arrow-right"></i></span>
                </span>
            </a>
        </div>
    </div>
</section>

<style>
    .booking-confirm-card {
        max-width: 640px;
        background: var(--color-white);
        border: 1px solid var(--color-border);
        border-radius: var(--radius-card);
        box-shadow: var(--shadow-card);
        padding: var(--space-5) var(--space-4);
    }

    .booking-confirm-icon {
        font-size: 56px;
        color: var(--color-primary-red);
    }

    .booking-summary {
        border: 1px solid var(--color-border);
        border-radius: var(--radius-sm);
        padding: var(--space-3);
    }

    .booking-summary-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid var(--color-border);
        font-size: var(--font-size-small);
    }

    .booking-summary-row:last-child {
        border-bottom: none;
    }

    .booking-summary-row span {
        color: var(--color-text-muted);
    }
</style>
@endsection
