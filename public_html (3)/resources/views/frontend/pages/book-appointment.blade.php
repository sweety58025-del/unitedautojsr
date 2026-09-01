@extends('frontend.partials.master')
@section('title', 'Book a Service Appointment')
@section('content')
@include('frontend.partials.breadcumbs')

<section class="pd-bottom-300">
    <div class="container">

        <div class="wptb-heading text-center mr-bottom-60">
            <div class="wptb-item--inner">
                <h6 class="wptb-item--subtitle">BOOK ONLINE</h6>
                <h1 class="wptb-item--title">Book a Service Appointment</h1>
                <div class="wptb-item--divider mx-auto"></div>
                <div class="wptb-item--description">
                    Reserve your slot in a few clicks. Choose a service, tell us about your vehicle, and pick a time that works for you.
                </div>
            </div>
        </div>

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

        <div class="booking-wizard-card mx-auto">

            <!-- Step indicator -->
            <div class="booking-steps">
                <div class="booking-step is-active" data-step-indicator="1">
                    <span class="booking-step-circle">1</span>
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
                    <div class="row" id="serviceOptions">
                        @forelse ($services as $service)
                            <div class="col-md-6 mb-3">
                                <label class="service-option" data-price="{{ $service->price }}" data-name="{{ $service->name }}">
                                    <input
                                        type="radio"
                                        name="service_id"
                                        value="{{ $service->id }}"
                                        data-price="{{ $service->price }}"
                                        data-name="{{ $service->name }}"
                                        {{ old('service_id') == $service->id ? 'checked' : '' }}
                                        required
                                    >
                                    <span class="service-option-body">
                                        <span class="service-option-name">
                                            {{ $service->name }}
                                            @if ($service->category)
                                                <small class="d-block text-muted">{{ $service->category->name }}</small>
                                            @endif
                                        </span>
                                        <span class="service-option-price">₹{{ number_format($service->price, 2) }}</span>
                                    </span>
                                </label>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-muted">No services are available for booking right now. Please check back soon or contact us directly.</p>
                            </div>
                        @endforelse
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
                        <div class="booking-summary-row"><span>Price</span><strong id="summaryPrice">-</strong></div>
                        <div class="booking-summary-row"><span>Vehicle</span><strong id="summaryVehicle">-</strong></div>
                        <div class="booking-summary-row"><span>Registration No.</span><strong id="summaryReg">-</strong></div>
                        <div class="booking-summary-row"><span>Date &amp; Time</span><strong id="summaryDateTime">-</strong></div>
                        <div class="booking-summary-row"><span>Name</span><strong id="summaryName">-</strong></div>
                        <div class="booking-summary-row"><span>Phone</span><strong id="summaryPhone">-</strong></div>
                    </div>
                    <div class="booking-pane-actions booking-pane-actions-split">
                        <button type="button" class="btn-outline booking-back-btn">Back</button>
                        <button type="submit" class="btn-two white">
                            <span class="btn-wrap">
                                <span class="text-first">Continue Booking</span>
                                <span class="text-second"><i class="bi bi-check2"></i></span>
                            </span>
                        </button>
                    </div>
                </div>

            </form>
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

    .service-option-price {
        color: var(--color-primary-red);
        font-weight: var(--font-weight-bold);
        white-space: nowrap;
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
                indicator.classList.toggle('is-active', num === step);
                indicator.classList.toggle('is-complete', num < step);
            });
            currentStep = step;
            window.scrollTo({ top: form.offsetTop - 120, behavior: 'smooth' });
        }

        function validateStep(step) {
            const pane = steps.find(function (p) { return Number(p.dataset.stepPane) === step; });
            const fields = pane.querySelectorAll('input[required], select[required]');
            let valid = true;

            fields.forEach(function (field) {
                if (field.type === 'radio') {
                    const group = pane.querySelectorAll('input[name="' + field.name + '"]');
                    const checked = Array.from(group).some(function (r) { return r.checked; });
                    if (!checked) valid = false;
                } else if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    valid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            if (!valid) {
                alert('Please fill in all required fields before continuing.');
            }
            return valid;
        }

        document.querySelectorAll('.booking-next-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                if (!validateStep(currentStep)) return;
                if (currentStep === 4) updateSummary();
                if (currentStep < steps.length) showStep(currentStep + 1);
            });
        });

        document.querySelectorAll('.booking-back-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                if (currentStep > 1) showStep(currentStep - 1);
            });
        });

        function updateSummary() {
            const selectedService = form.querySelector('input[name="service_id"]:checked');
            document.getElementById('summaryService').textContent = selectedService ? selectedService.dataset.name : '-';
            document.getElementById('summaryPrice').textContent = selectedService ? '₹' + Number(selectedService.dataset.price).toFixed(2) : '-';
            document.getElementById('summaryVehicle').textContent = document.getElementById('vehicle_make_model').value || '-';
            document.getElementById('summaryReg').textContent = document.getElementById('registration_number').value || '-';

            const date = document.getElementById('appointment_date').value;
            const time = document.getElementById('appointment_time').value;
            document.getElementById('summaryDateTime').textContent = (date && time) ? (date + ' · ' + time) : '-';

            document.getElementById('summaryName').textContent = document.getElementById('customer_name').value || '-';
            document.getElementById('summaryPhone').textContent = document.getElementById('customer_phone').value || '-';
        }

        showStep(1);
    })();
</script>

@endsection
