@extends('backend.partial.master')
@section('title', 'Dashboard')
@section('backend-content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('assets/images/company/' . ($company?->logo ?: 'logo.png')) }}" alt="{{ $company?->company_name ?? 'United Auto' }}" height="34">
                    <div>
                        <h4 class="mb-1">Welcome Back, {{ $user->name }}</h4>
                        <span>{{ $company?->company_name ?? 'United Auto' }} admin overview</span>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="border rounded p-3 h-100">
                            <span class="text-muted d-block">All appointments</span>
                            <strong class="fs-24">{{ $appointmentStats['total'] }}</strong>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 h-100">
                            <span class="text-muted d-block">Pending requests</span>
                            <strong class="fs-24 text-warning">{{ $appointmentStats['pending'] }}</strong>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 h-100">
                            <span class="text-muted d-block">Confirmed visits</span>
                            <strong class="fs-24 text-success">{{ $appointmentStats['confirmed'] }}</strong>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h5 class="mb-1">Upcoming service appointments</h5>
                        <span class="text-muted">The latest customer schedule from the live booking system.</span>
                    </div>
                    <a href="{{ route('appointment.index') }}" class="btn btn-primary btn-sm">View all</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Service</th>
                                <th>Vehicle</th>
                                <th>Schedule</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($appointments as $appointment)
                                <tr>
                                    <td>
                                        <strong>{{ $appointment->customer_name }}</strong>
                                        <small class="d-block text-muted">{{ $appointment->customer_phone }}</small>
                                    </td>
                                    <td>{{ $appointment->service_name }}</td>
                                    <td>{{ $appointment->vehicle_make_model }}</td>
                                    <td>{{ $appointment->appointment_date->format('j M Y') }}<small class="d-block text-muted">{{ $appointment->appointment_time }}</small></td>
                                    <td><span class="badge bg-{{ $appointment->status === 'confirmed' ? 'success' : ($appointment->status === 'cancelled' ? 'danger' : 'warning') }}">{{ ucfirst($appointment->status) }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No upcoming appointments have been booked.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
