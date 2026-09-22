@extends('frontend.partials.master')
@section('title', 'Book a Car Service Appointment | United Auto')
@section('content')
@include('frontend.partials.breadcumbs')

<section class="booking-page-shell">
    <div class="container-fluid booking-dashboard-container">

        @if ($errors->any())
            <div class="alert alert-danger mr-bottom-30">
                <strong>Please check the following:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="booking-dashboard">
            <div class="booking-wizard-card">
                <div class="booking-dashboard-heading">
                    <div><i class="bi bi-calendar2-check" aria-hidden="true"></i><h1>Book a Service Appointment</h1></div>
                    <span>New Vehicle Service <i class="bi bi-chevron-down" aria-hidden="true"></i></span>
                </div>

            <!-- Step indicator -->
            <div class="booking-steps" role="list">
                <div class="booking-step is-active" data-step-indicator="1">
                    <span class="booking-step-circle" aria-current="step">1</span>
                    <span class="booking-step-label">Service</span>
                </div>
                <div class="booking-step-line"></div>
                <div class="booking-step" data-step-indicator="2">
                    <span class="booking-step-circle">2</span>
                    <span class="booking-step-label">Vehicle</span>
                </div>
                <div class="booking-step-line"></div>
                <div class="booking-step" data-step-indicator="3">
                    <span class="booking-step-circle">3</span>
                    <span class="booking-step-label">Date &amp; Time</span>
                </div>
                <div class="booking-step-line"></div>
                <div class="booking-step" data-step-indicator="4">
                    <span class="booking-step-circle">4</span>
                    <span class="booking-step-label">Customer Info</span>
                </div>
                <div class="booking-step-line"></div>
                <div class="booking-step" data-step-indicator="5">
                    <span class="booking-step-circle">5</span>
                    <span class="booking-step-label">Confirm</span>
                </div>
            </div>

            <form action="{{ route('book-appointment.store') }}" method="POST" id="bookingForm">
                @csrf

                <!-- STEP 1: Service -->
                <div class="booking-step-pane is-active" data-step-pane="1">
                    <h5 class="booking-pane-title">Select a Service</h5>
                    <div class="booking-service-stage">
                    <div class="booking-service-picker">
                        <button type="button" class="booking-service-trigger" aria-expanded="false" aria-controls="serviceOptions">
                            <span><i class="bi bi-car-front" aria-hidden="true"></i><span id="serviceTriggerName">Select a service</span></span>
                            <i class="bi bi-chevron-down" aria-hidden="true"></i>
                        </button>
                    <div class="booking-service-list" id="serviceOptions" role="menu">
                        @forelse ($services as $service)
                            <div>
                                <label class="service-option" data-name="{{ $service->name }}">
                                    <input
                                        type="radio"
                                        name="service_id"
                                        value="{{ $service->id }}"
                                        data-name="{{ $service->name }}"
                                        {{ old('service_id', $selectedServiceId ?: $services->first()?->id) == $service->id ? 'checked' : '' }}
                                        required
                                    >
                                    <span class="service-option-body">
                                        <span class="service-option-name">
                                            {{ $service->name }}
                                            @if ($service->category)
                                                <small class="d-block text-muted">{{ $service->category->name }}</small>
                                            @endif
                                        </span>
                                    </span>
                                </label>
                            </div>
                        @empty
                            <div>
                                <p class="text-muted">No services are available for booking right now. Please check back soon or contact us directly.</p>
                            </div>
                        @endforelse
                    </div>
                    </div>
                    <div class="booking-selected-service">
                        <div class="booking-service-icon"><i class="bi bi-car-front-fill" aria-hidden="true"></i></div>
                        <h3 id="selectedServiceTitle">Select a service</h3>
                        <p id="selectedServiceDescription">Choose a service to see its details here.</p>
                        <div class="booking-service-meta"><span><i class="bi bi-check-circle-fill" aria-hidden="true"></i> Routine Maintenance</span></div>
                    </div>
                    </div>
                    <div class="booking-pane-actions">
                        <button type="button" class="btn-two white booking-next-btn">
                            <span class="btn-wrap">
                                <span class="text-first">Continue</span>
                                <span class="text-second"><i class="bi bi-arrow-right"></i></span>
                            </span>
                        </button>
                    </div>
                </div>

                <!-- STEP 2: Vehicle -->
                <div class="booking-step-pane" data-step-pane="2">
                    <h5 class="booking-pane-title">Vehicle Details</h5>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="vehicle_make_model">Vehicle Make / Model*</label>
                                <input type="text" id="vehicle_make_model" name="vehicle_make_model" class="form-control" placeholder="e.g. Maruti Suzuki Swift" value="{{ old('vehicle_make_model') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="registration_number">Registration Number*</label>
                                <input type="text" id="registration_number" name="registration_number" class="form-control" placeholder="e.g. JH-01-AB-1234" value="{{ old('registration_number') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="booking-pane-actions booking-pane-actions-split">
                        <button type="button" class="btn-outline booking-back-btn">Back</button>
                        <button type="button" class="btn-two white booking-next-btn">
                            <span class="btn-wrap">
                                <span class="text-first">Continue</span>
                                <span class="text-second"><i class="bi bi-arrow-right"></i></span>
                            </span>
                        </button>
                    </div>
                </div>

                <!-- STEP 3: Date & Time -->
                <div class="booking-step-pane" data-step-pane="3">
                    <h5 class="booking-pane-title">Choose Date &amp; Time</h5>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="appointment_date">Preferred Date*</label>
                                <input type="date" id="appointment_date" name="appointment_date" class="form-control" min="{{ now()->format('Y-m-d') }}" value="{{ old('appointment_date') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="appointment_time">Preferred Time*</label>
                                <select id="appointment_time" name="appointment_time" class="form-control" required>
                                    <option value="" disabled {{ old('appointment_time') ? '' : 'selected' }}>Select a time slot</option>
                                    @foreach (['9:00 AM','9:30 AM','10:00 AM','10:30 AM','11:00 AM','11:30 AM','1:00 PM','1:30 PM','2:00 PM','2:30 PM','3:00 PM','3:30 PM','4:00 PM','4:30 PM'] as $slot)
                                        <option value="{{ $slot }}" {{ old('appointment_time') == $slot ? 'selected' : '' }}>{{ $slot }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="booking-pane-actions booking-pane-actions-split">
                        <button type="button" class="btn-outline booking-back-btn">Back</button>
                        <button type="button" class="btn-two white booking-next-btn">
                            <span class="btn-wrap">
                                <span class="text-first">Continue</span>
                                <span class="text-second"><i class="bi bi-arrow-right"></i></span>
                            </span>
                        </button>
                    </div>
                </div>

                <!-- STEP 4: Customer Info -->
                <div class="booking-step-pane" data-step-pane="4">
                    <h5 class="booking-pane-title">Your Details</h5>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="customer_name">Full Name*</label>
                                <input type="text" id="customer_name" name="customer_name" class="form-control" placeholder="Your name" value="{{ old('customer_name') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="customer_phone">Phone Number*</label>
                                <input type="text" id="customer_phone" name="customer_phone" class="form-control" placeholder="Phone number" value="{{ old('customer_phone') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="customer_email">Email (optional)</label>
                                <input type="email" id="customer_email" name="customer_email" class="form-control" placeholder="you@example.com" value="{{ old('customer_email') }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="preferred_contact_method">Preferred Contact Method*</label>
                                <select id="preferred_contact_method" name="preferred_contact_method" class="form-control" required>
                                    <option value="phone" {{ old('preferred_contact_method', 'phone') == 'phone' ? 'selected' : '' }}>Phone Call</option>
                                    <option value="sms" {{ old('preferred_contact_method') == 'sms' ? 'selected' : '' }}>SMS</option>
                                    <option value="email" {{ old('preferred_contact_method') == 'email' ? 'selected' : '' }}>Email</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="service_reason">Service Reason</label>
                                <input type="text" id="service_reason" name="service_reason" class="form-control" placeholder="Reason for service" value="{{ old('service_reason') }}">
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="form-group">
                                <label for="additional_issues">Additional Issues (Optional)</label>
                                <textarea id="additional_issues" name="additional_issues" class="form-control" placeholder="Describe any issues or symptoms">{{ old('additional_issues') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="booking-pane-actions booking-pane-actions-split">
                        <button type="button" class="btn-outline booking-back-btn">Back</button>
                        <button type="button" class="btn-two white booking-next-btn">
                            <span class="btn-wrap">
                                <span class="text-first">Review</span>
                                <span class="text-second"><i class="bi bi-arrow-right"></i></span>
                            </span>
                        </button>
                    </div>
                </div>

                <!-- STEP 5: Confirm -->
                <div class="booking-step-pane" data-step-pane="5">
                    <h5 class="booking-pane-title">Review &amp; Confirm</h5>
                    <div class="booking-summary" id="bookingSummary">
                        <div class="booking-summary-row"><span>Service</span><strong id="summaryService">-</strong></div>
                        <div class="booking-summary-row"><span>Vehicle</span><strong id="summaryVehicle">-</strong></div>
                        <div class="booking-summary-row"><span>Registration No.</span><strong id="summaryReg">-</strong></div>
                        <div class="booking-summary-row"><span>Date &amp; Time</span><strong id="summaryDateTime">-</strong></div>
                        <div class="booking-summary-row"><span>Name</span><strong id="summaryName">-</strong></div>
                        <div class="booking-summary-row"><span>Phone</span><strong id="summaryPhone">-</strong></div>
                        <div class="booking-summary-row"><span>Email</span><strong id="summaryEmail">-</strong></div>
                        <div class="booking-summary-row"><span>Contact Method</span><strong id="summaryContactMethod">-</strong></div>
                        <div class="booking-summary-row"><span>Service Reason</span><strong id="summaryReason">-</strong></div>
                        <div class="booking-summary-row"><span>Additional Issues</span><strong id="summaryIssues">-</strong></div>
                    </div>
                    <div class="booking-pane-actions booking-pane-actions-split">
                        <button type="button" class="btn-outline booking-back-btn">Back</button>
                        <button type="submit" class="btn-two white booking-submit-btn">
                            <span class="btn-wrap">
                                <span class="text-first">Continue Booking</span>
                                <span class="text-second"><i class="bi bi-check2"></i></span>
                            </span>
                        </button>
                    </div>
                </div>

            </form>
            </div>

            <aside class="booking-side-card booking-editor-card">
                <div class="booking-card-heading"><i class="bi bi-gear" aria-hidden="true"></i><strong>Service</strong><button type="button" aria-label="Close service panel"><i class="bi bi-x-lg" aria-hidden="true"></i></button></div>
                <label for="service_editor_name">Service</label>
                <div class="booking-editor-select"><i class="bi bi-car-front" aria-hidden="true"></i><span id="editorServiceName">Select a service</span><i class="bi bi-chevron-down" aria-hidden="true"></i></div>
                <button type="button" class="booking-red-button booking-save-button"><i class="bi bi-calendar-check" aria-hidden="true"></i> Save</button>
            </aside>
        </div>
    </div>
</section>

<style>
    .booking-wizard-card {
        max-width: 860px;
        background: var(--color-white);
        border: 1px solid var(--color-border);
        border-radius: var(--radius-card);
        box-shadow: var(--shadow-card);
        padding: var(--space-4);
    }

    .booking-steps {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: var(--space-4);
        flex-wrap: wrap;
    }

    .booking-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        min-width: 70px;
        opacity: 0.5;
    }

    .booking-step.is-active,
    .booking-step.is-complete {
        opacity: 1;
    }

    .booking-step-circle {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--color-gray-light);
        color: var(--color-text-dark);
        font-weight: var(--font-weight-bold);
        margin-bottom: 6px;
        transition: background var(--transition-fast), color var(--transition-fast);
    }

    .booking-step.is-active .booking-step-circle {
        background: var(--color-primary-red);
        color: var(--color-white);
    }

    .booking-step.is-complete .booking-step-circle {
        background: var(--color-navy);
        color: var(--color-white);
    }

    .booking-step-label {
        font-size: var(--font-size-small);
        color: var(--color-text-muted);
    }

    .booking-step-line {
        flex: 1;
        height: 2px;
        background: var(--color-border);
        margin: 0 8px;
        margin-bottom: 20px;
    }

    .booking-step-pane {
        display: none;
    }

    .booking-step-pane.is-active {
        display: block;
        animation: fadeIn 0.25s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .booking-pane-title {
        font-family: var(--font-heading);
        color: var(--color-navy);
        margin-bottom: var(--space-3);
    }

    .booking-pane-actions {
        margin-top: var(--space-3);
        display: flex;
        justify-content: flex-end;
    }

    .booking-pane-actions-split {
        justify-content: space-between;
    }

    .btn-outline {
        background: transparent;
        border: 1px solid var(--color-border);
        color: var(--color-text-dark);
        padding: 10px 24px;
        border-radius: var(--radius-btn);
        font-weight: var(--font-weight-medium);
        transition: border-color var(--transition-fast), color var(--transition-fast);
    }

    .btn-outline:hover {
        border-color: var(--color-primary-red);
        color: var(--color-primary-red);
    }

    .service-option {
        display: block;
        border: 1px solid var(--color-border);
        border-radius: var(--radius-sm);
        padding: 14px 16px;
        cursor: pointer;
        transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
        position: relative;
    }

    .service-option input {
        position: absolute;
        opacity: 0;
    }

    .service-option-body {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .service-option-name {
        font-weight: var(--font-weight-medium);
        color: var(--color-text-dark);
    }

    .service-option:has(input:checked) {
        border-color: var(--color-primary-red);
        box-shadow: 0 0 0 2px rgba(233, 28, 45, 0.15);
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

    .booking-summary-row strong {
        color: var(--color-navy);
        text-align: right;
        overflow-wrap: anywhere;
    }

    .booking-page-shell {
        padding: 42px 0 120px;
        background: #f7f9fc;
    }

    .booking-dashboard-container {
        max-width: 1500px;
        padding-left: 24px;
        padding-right: 24px;
    }

    .booking-dashboard {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 255px;
        align-items: start;
        gap: 20px;
        max-width: 1240px;
        margin: 0 auto;
    }

    .booking-side-card,
    .booking-wizard-card {
        background: #fff;
        border: 1px solid #e8edf3;
        border-radius: 14px;
        box-shadow: 0 12px 32px rgba(21, 42, 70, 0.08);
    }

    .booking-side-card {
        padding: 18px;
        min-width: 0;
    }

    .booking-wizard-card {
        max-width: none;
        width: 100%;
        min-width: 0;
        padding: 18px;
    }

    .booking-dashboard-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 4px 12px 18px;
        border-bottom: 1px solid #edf0f4;
    }

    .booking-dashboard-heading > div,
    .booking-card-heading {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .booking-dashboard-heading i,
    .booking-card-heading > i {
        color: #ef233c;
        font-size: 22px;
    }

    .booking-dashboard-heading h1 {
        margin: 0;
        color: #14233b;
        font-size: 23px;
        line-height: 1.2;
    }

    .booking-dashboard-heading > span {
        color: #40506a;
        font-size: 12px;
        font-weight: 600;
    }

    .booking-card-heading {
        justify-content: space-between;
        margin-bottom: 18px;
        color: #172842;
        font-size: 15px;
    }

    .booking-card-heading button {
        padding: 0;
        border: 0;
        background: transparent;
        color: #172842;
    }

    .booking-side-card label {
        display: block;
        margin: 15px 0 7px;
        color: #53627a;
        font-size: 11px;
        font-weight: 700;
    }

    .booking-editor-select {
        width: 100%;
        min-height: 40px;
        padding: 0 11px;
        border: 1px solid #dfe6ef;
        border-radius: 8px;
        background: #fbfcfe;
        color: #40506a;
        font-size: 12px;
    }

    .booking-editor-select {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .booking-editor-select i:first-child {
        color: #ef233c;
    }

    .booking-red-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        min-height: 40px;
        padding: 8px 12px;
        border: 0;
        border-radius: 8px;
        background: #ef233c;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
    }

    .booking-red-button:hover {
        background: #cf1830;
        color: #fff;
    }

    .booking-editor-card .booking-red-button {
        margin-top: 18px;
    }

    .booking-steps {
        margin: 18px 0 24px;
        padding: 0 8px 16px;
        border-bottom: 1px solid #edf0f4;
    }

    .booking-step-circle {
        width: 34px;
        height: 34px;
        border: 1px solid #dfe6ef;
        background: #fff;
        color: #40506a;
    }

    .booking-step-line {
        background: #dfe6ef;
        min-width: 0;
    }

    .booking-step.is-active .booking-step-circle,
    .booking-step.is-complete .booking-step-circle {
        width: 100%;
        background: #ef233c;
        border-color: #ef233c;
    }

    .booking-step-label {
        color: #40506a;
        font-size: 11px;
        font-weight: 600;
    }

    .booking-pane-title {
        margin: 0 0 12px;
        color: #172842;
        font-family: var(--font-family-heading);
        font-size: 17px;
    }

    .booking-service-stage {
        display: grid;
        grid-template-columns: minmax(0, 1.1fr) minmax(230px, .9fr);
        gap: 16px;
    }

    .booking-service-picker {
        position: relative;
        align-self: start;
        min-width: 0;
    }

    .booking-service-trigger {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        min-height: 48px;
        padding: 0 14px;
        border: 1px solid #dfe6ef;
        border-radius: 8px;
        background: #fff;
        color: #40506a;
        font-size: 12px;
        font-weight: 600;
        text-align: left;
    }

    .booking-service-trigger > span {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        min-width: 0;
    }

    .booking-service-trigger i:first-child {
        color: #ef233c;
        font-size: 18px;
    }

    .booking-service-trigger[aria-expanded="true"] {
        border-color: #ef233c;
        box-shadow: 0 0 0 3px rgba(239, 35, 60, .1);
    }

    .booking-service-list {
        display: none;
        position: absolute;
        top: calc(100% + 7px);
        left: 0;
        right: 0;
        z-index: 20;
        grid-template-columns: 1fr;
        gap: 5px;
        max-height: 280px;
        overflow-y: auto;
        padding: 8px;
        border: 1px solid #e3e8f0;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 16px 34px rgba(21, 42, 70, .16);
    }

    .booking-service-picker.is-open .booking-service-list {
        display: grid;
    }

    .booking-service-picker.opens-up .booking-service-list {
        top: auto;
        bottom: calc(100% + 7px);
    }

    .service-option {
        min-height: 42px;
        padding: 9px 12px;
        border-color: #e5eaf1;
        border-radius: 8px;
        background: #fff;
    }

    .service-option:hover {
        border-color: #ef233c;
        background: #fff7f8;
    }

    .service-option-body {
        font-size: 12px;
    }

    .service-option-name small {
        font-size: 9px;
    }

    .service-option:has(input:checked) {
        border-color: #ef233c;
        background: #fff7f8;
        box-shadow: 0 0 0 1px rgba(239, 35, 60, .12);
    }

    .booking-selected-service {
        padding: 24px;
        border-radius: 12px;
        background: linear-gradient(135deg, #fff4f5, #fffafb);
    }

    .booking-service-icon {
        display: grid;
        place-items: center;
        width: 52px;
        height: 52px;
        margin-bottom: 14px;
        border-radius: 50%;
        background: #ffe1e4;
        color: #ef233c;
        font-size: 25px;
    }

    .booking-selected-service h3 {
        display: inline-block;
        margin: 0 12px 8px 0;
        color: #172842;
        font-size: 18px;
    }

    .booking-selected-service > strong {
        color: #172842;
        font-size: 15px;
    }

    .booking-selected-service p {
        margin: 0 0 16px;
        color: #607089;
        font-size: 12px;
        line-height: 1.6;
    }

    .booking-service-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        color: #53627a;
        font-size: 10px;
    }

    .booking-service-meta i {
        color: #ef233c;
    }

    .booking-pane-actions {
        margin-top: 22px;
    }

    .booking-editor-card {
        min-height: 330px;
    }

    @media (max-width: 1199.9px) {
        .booking-dashboard {
            grid-template-columns: minmax(0, 1fr) 230px;
        }
    }

    @media (max-width: 767.9px) {
        .booking-page-shell {
            padding-top: 24px;
        }

        .booking-dashboard-container {
            padding-left: 14px;
            padding-right: 14px;
        }

        .booking-dashboard {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .booking-side-card,
        .booking-wizard-card {
            width: 100%;
            min-width: 0;
        }

        .booking-editor-card {
            order: 3;
        }

        .booking-dashboard-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .booking-dashboard-heading h1 {
            font-size: 19px;
        }

        .booking-service-stage {
            grid-template-columns: 1fr;
        }

        .booking-steps {
            gap: 8px 0;
        }

        .booking-step-line {
            min-width: 16px;
        }
    }
</style>

<script>
    (function () {
        const form = document.getElementById('bookingForm');
        const steps = Array.from(document.querySelectorAll('[data-step-pane]'));
        const indicators = Array.from(document.querySelectorAll('[data-step-indicator]'));
        let currentStep = 1;

        function showStep(step) {
            steps.forEach(function (pane) {
                pane.classList.toggle('is-active', Number(pane.dataset.stepPane) === step);
            });
            indicators.forEach(function (indicator) {
                const num = Number(indicator.dataset.stepIndicator);
                const circle = indicator.querySelector('.booking-step-circle');
                indicator.classList.toggle('is-active', num === step);
                indicator.classList.toggle('is-complete', num < step);
                if (circle) {
                    if (num === step) {
                        circle.setAttribute('aria-current', 'step');
                    } else {
                        circle.removeAttribute('aria-current');
                    }
                }
            });
            currentStep = step;
            if (step === steps.length) {
                window.requestAnimationFrame(updateSummary);
                window.setTimeout(updateSummary, 0);
            }
            window.scrollTo({ top: form.offsetTop - 120, behavior: 'smooth' });
        }

        function validateStep(step) {
            const pane = steps.find(function (p) { return Number(p.dataset.stepPane) === step; });
            const fields = pane.querySelectorAll('input[required], select[required]');
            const actionArea = pane.querySelector('.booking-pane-actions') || pane.querySelector('.booking-pane-actions-split');
            const nextButton = pane.querySelector('.booking-next-btn, .booking-submit-btn');
            const inlineMessage = pane.querySelector('.booking-inline-error') || document.createElement('div');
            let valid = true;

            inlineMessage.className = 'booking-inline-error';
            inlineMessage.setAttribute('role', 'alert');
            inlineMessage.setAttribute('aria-live', 'polite');
            inlineMessage.textContent = 'Please fill in all required fields before continuing.';
            inlineMessage.style.display = 'none';
            inlineMessage.style.marginBottom = '12px';
            inlineMessage.style.padding = '8px 12px';
            inlineMessage.style.borderRadius = '4px';
            inlineMessage.style.background = '#fdecec';
            inlineMessage.style.color = '#a11c1c';
            inlineMessage.style.border = '1px solid #f5b7b7';
            inlineMessage.style.fontSize = '14px';

            if (!inlineMessage.parentNode && actionArea) {
                actionArea.insertBefore(inlineMessage, nextButton || actionArea.firstChild);
            }

            function clearInvalidState(event) {
                const field = event.target;
                if (field) {
                    field.classList.remove('is-invalid');
                    field.setAttribute('aria-invalid', 'false');
                    if (field.value.trim()) {
                        field.classList.remove('is-invalid');
                        field.setAttribute('aria-invalid', 'false');
                    }
                }
                if (pane.querySelectorAll('.is-invalid').length === 0) {
                    inlineMessage.style.display = 'none';
                }
            }

            fields.forEach(function (field) {
                field.addEventListener('input', clearInvalidState);
                field.addEventListener('change', clearInvalidState);

                if (field.type === 'radio') {
                    const group = pane.querySelectorAll('input[name="' + field.name + '"]');
                    const checked = Array.from(group).some(function (r) { return r.checked; });
                    if (!checked) {
                        field.setAttribute('aria-invalid', 'true');
                        valid = false;
                    }
                } else if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    field.setAttribute('aria-invalid', 'true');
                    valid = false;
                } else {
                    field.classList.remove('is-invalid');
                    field.setAttribute('aria-invalid', 'false');
                }
            });

            if (!valid) {
                inlineMessage.style.display = 'block';
            } else {
                inlineMessage.style.display = 'none';
            }
            return valid;
        }

        document.querySelectorAll('.booking-next-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                if (!validateStep(currentStep)) return;
                if (currentStep < steps.length) showStep(currentStep + 1);
            });
        });

        document.querySelectorAll('.booking-back-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                if (currentStep > 1) showStep(currentStep - 1);
            });
        });

        form.addEventListener('submit', function () {
            const submitButton = form.querySelector('.booking-submit-btn');
            if (!submitButton) return;
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span><span>Booking...</span>';
        });

        function updateSummary() {
            const selectedService = form.querySelector('input[name="service_id"]:checked');
            const valueOf = function (name) {
                const field = form.elements.namedItem(name);
                const value = field && typeof field.value === 'string' ? field.value.trim() : '';
                return value || '-';
            };

            document.getElementById('summaryService').textContent = selectedService ? selectedService.dataset.name : '-';
            document.getElementById('summaryVehicle').textContent = valueOf('vehicle_make_model');
            document.getElementById('summaryReg').textContent = valueOf('registration_number');

            const dateField = form.elements.namedItem('appointment_date');
            const timeField = form.elements.namedItem('appointment_time');
            const date = dateField && typeof dateField.value === 'string' ? dateField.value.trim() : '';
            const time = timeField && typeof timeField.value === 'string' ? timeField.value.trim() : '';
            document.getElementById('summaryDateTime').textContent = date && time ? (date + ' · ' + time) : '-';

            document.getElementById('summaryName').textContent = valueOf('customer_name');
            document.getElementById('summaryPhone').textContent = valueOf('customer_phone');
            document.getElementById('summaryEmail').textContent = valueOf('customer_email');
            document.getElementById('summaryContactMethod').textContent = valueOf('preferred_contact_method');
            document.getElementById('summaryReason').textContent = valueOf('service_reason');
            document.getElementById('summaryIssues').textContent = valueOf('additional_issues');
        }

        form.addEventListener('input', function () {
            if (currentStep === steps.length) updateSummary();
        });

        form.addEventListener('change', function () {
            if (currentStep === steps.length) updateSummary();
        });

        function updateSelectedService() {
            const selectedService = form.querySelector('input[name="service_id"]:checked');
            const title = document.getElementById('selectedServiceTitle');
            const description = document.getElementById('selectedServiceDescription');
            const triggerName = document.getElementById('serviceTriggerName');
            const editorName = document.getElementById('editorServiceName');

            if (!selectedService) return;

            const serviceName = selectedService.dataset.name || 'Selected service';
            title.textContent = serviceName;
            triggerName.textContent = serviceName;
            description.textContent = 'Professional ' + serviceName.toLowerCase() + ' support from the United Auto workshop team.';
            editorName.textContent = serviceName;
        }

        form.querySelectorAll('input[name="service_id"]').forEach(function (serviceInput) {
            serviceInput.addEventListener('change', updateSelectedService);
        });

        const servicePicker = document.querySelector('.booking-service-picker');
        const serviceTrigger = document.querySelector('.booking-service-trigger');

        serviceTrigger.addEventListener('click', function () {
            const isOpen = servicePicker.classList.toggle('is-open');
            if (isOpen) {
                const triggerBottom = serviceTrigger.getBoundingClientRect().bottom;
                servicePicker.classList.toggle('opens-up', triggerBottom + 290 > window.innerHeight);
            } else {
                servicePicker.classList.remove('opens-up');
            }
            serviceTrigger.setAttribute('aria-expanded', String(isOpen));
        });

        servicePicker.querySelectorAll('.service-option').forEach(function (option) {
            option.addEventListener('click', function () {
                window.setTimeout(function () {
                    servicePicker.classList.remove('is-open');
                    servicePicker.classList.remove('opens-up');
                    serviceTrigger.setAttribute('aria-expanded', 'false');
                    updateSelectedService();
                }, 0);
            });
        });

        document.addEventListener('click', function (event) {
            if (!servicePicker.contains(event.target)) {
                servicePicker.classList.remove('is-open');
                servicePicker.classList.remove('opens-up');
                serviceTrigger.setAttribute('aria-expanded', 'false');
            }
        });

        updateSelectedService();
        showStep(1);
    })();
</script>

@endsection
