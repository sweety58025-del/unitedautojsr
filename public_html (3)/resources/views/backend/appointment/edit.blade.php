@extends('backend.partial.master')
@section('main_title', 'Appointments')
@section('title', 'Edit Appointment')
@section('backend-content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Service Appointment</h5>
                <a href="{{ route('appointment.index') }}" class="btn btn-sm btn-outline-secondary">Back to appointments</a>
            </div>
            <form method="POST" action="{{ route('appointment.update', $appointment->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body row">
                    @if ($errors->any())
                        <div class="alert alert-danger col-12">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group col-md-6 mb-3">
                        <label class="form-label" for="service_id">Service</label>
                        <select class="form-control" id="service_id" name="service_id" required>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" @selected(old('service_id', $appointment->service_id) == $service->id)>
                                    {{ $service->name }} - ₹{{ number_format($service->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label class="form-label" for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            @foreach (['pending', 'confirmed', 'completed', 'cancelled'] as $status)
                                <option value="{{ $status }}" @selected(old('status', $appointment->status) === $status)>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label class="form-label" for="customer_name">Customer Name</label>
                        <input class="form-control" id="customer_name" name="customer_name" value="{{ old('customer_name', $appointment->customer_name) }}" required>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label class="form-label" for="customer_phone">Phone</label>
                        <input class="form-control" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', $appointment->customer_phone) }}" required>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label class="form-label" for="customer_email">Email</label>
                        <input type="email" class="form-control" id="customer_email" name="customer_email" value="{{ old('customer_email', $appointment->customer_email) }}">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label class="form-label" for="preferred_contact_method">Preferred Contact Method</label>
                        <select class="form-control" id="preferred_contact_method" name="preferred_contact_method" required>
                            @foreach (['phone', 'email', 'sms'] as $method)
                                <option value="{{ $method }}" @selected(old('preferred_contact_method', $appointment->preferred_contact_method) === $method)>{{ ucfirst($method) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label class="form-label" for="vehicle_make_model">Vehicle Make / Model</label>
                        <input class="form-control" id="vehicle_make_model" name="vehicle_make_model" value="{{ old('vehicle_make_model', $appointment->vehicle_make_model) }}" required>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label class="form-label" for="registration_number">Registration Number</label>
                        <input class="form-control" id="registration_number" name="registration_number" value="{{ old('registration_number', $appointment->registration_number) }}" required>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label class="form-label" for="appointment_date">Appointment Date</label>
                        <input type="date" class="form-control" id="appointment_date" name="appointment_date" value="{{ old('appointment_date', optional($appointment->appointment_date)->format('Y-m-d')) }}" required>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label class="form-label" for="appointment_time">Appointment Time</label>
                        <select class="form-control" id="appointment_time" name="appointment_time" required>
                            @foreach (['9:00 AM', '9:30 AM', '10:00 AM', '10:30 AM', '11:00 AM', '11:30 AM', '1:00 PM', '1:30 PM', '2:00 PM', '2:30 PM', '3:00 PM', '3:30 PM', '4:00 PM', '4:30 PM'] as $slot)
                                <option value="{{ $slot }}" @selected(old('appointment_time', $appointment->appointment_time) === $slot)>{{ $slot }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label class="form-label" for="service_reason">Service Reason</label>
                        <input class="form-control" id="service_reason" name="service_reason" value="{{ old('service_reason', $appointment->service_reason) }}">
                    </div>
                    <div class="form-group col-12 mb-3">
                        <label class="form-label" for="additional_issues">Additional Issues</label>
                        <textarea class="form-control" id="additional_issues" name="additional_issues" rows="4">{{ old('additional_issues', $appointment->additional_issues) }}</textarea>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
