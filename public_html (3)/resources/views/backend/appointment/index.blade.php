@extends('backend.partial.master')
@section('main_title', 'Website Content')
@section('title', 'Service Appointments')
@section('backend-content')

<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Service Appointments</h5>
            </div>

            <div class="card-body table-responsive">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Contact</th>
                            <th>Service</th>
                            <th>Vehicle</th>
                            <th>Date &amp; Time</th>
                            <th width="160">Status</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($appointments as $key => $appointment)

                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $appointment->customer_name }}</td>
                            <td>
                                {{ $appointment->customer_phone }}
                                @if ($appointment->customer_email)
                                    <br><small class="text-muted">{{ $appointment->customer_email }}</small>
                                @endif
                            </td>
                            <td>
                                {{ $appointment->service_name }}
                                <br><small class="text-muted">₹{{ number_format($appointment->service_price, 2) }}</small>
                            </td>
                            <td>
                                {{ $appointment->vehicle_make_model }}
                                <br><small class="text-muted">{{ $appointment->registration_number }}</small>
                            </td>
                            <td>{{ $appointment->appointment_date->format('j M Y') }}<br>{{ $appointment->appointment_time }}</td>
                            <td>
                                <form method="POST" action="{{ route('appointment.status', $appointment->id) }}">
                                    @csrf
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                        @foreach (['pending','confirmed','completed','cancelled'] as $status)
                                            <option value="{{ $status }}" {{ $appointment->status === $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('appointment.delete', $appointment->id) }}"
                                    onsubmit="return confirm('Delete this appointment? This cannot be undone.');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="8" class="text-center text-muted">No appointments have been booked yet.</td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>
    </div>

</div>

@endsection
