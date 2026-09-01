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
                                <form id="delete-appointment-form-{{ $appointment->id }}" method="POST" action="{{ route('appointment.delete', $appointment->id) }}">
                                    @csrf
                                </form>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAppointmentModal" data-delete-form-id="delete-appointment-form-{{ $appointment->id }}">Delete</button>
                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="8" class="text-center text-muted">No appointments have been booked yet.</td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

                {{ $appointments->links() }}

            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="deleteAppointmentModal" tabindex="-1" aria-labelledby="deleteAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAppointmentModalLabel">Delete Appointment?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteAppointmentBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('deleteAppointmentModal');
        const confirmDeleteButton = document.getElementById('confirmDeleteAppointmentBtn');
        let deleteFormId = null;

        if (modal) {
            modal.addEventListener('show.bs.modal', function (event) {
                const trigger = event.relatedTarget;
                deleteFormId = trigger ? trigger.getAttribute('data-delete-form-id') : null;
            });
        }

        if (confirmDeleteButton) {
            confirmDeleteButton.addEventListener('click', function () {
                if (!deleteFormId) return;
                const form = document.getElementById(deleteFormId);
                if (form) {
                    form.submit();
                }
            });
        }
    });
</script>

@endsection
