<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    /**
     * Show the multi-step booking form.
     */
    public function create()
    {
        $services = Service::with('category')
            ->where('status', 'yes')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('frontend.pages.book-appointment', [
            'services' => $services,
            'selectedServiceId' => request()->integer('service'),
        ]);
    }

    /**
     * Persist a new appointment booking.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id'               => ['required', Rule::exists('services', 'id')->where('status', 'yes')],
            'vehicle_make_model'       => ['required', 'string', 'max:255'],
            'registration_number'      => ['required', 'string', 'max:50'],
            'appointment_date'         => ['required', 'date', 'after_or_equal:today'],
            'appointment_time'         => ['required', Rule::in(['9:00 AM', '9:30 AM', '10:00 AM', '10:30 AM', '11:00 AM', '11:30 AM', '1:00 PM', '1:30 PM', '2:00 PM', '2:30 PM', '3:00 PM', '3:30 PM', '4:00 PM', '4:30 PM'])],
            'customer_name'            => ['required', 'string', 'max:255'],
            'customer_email'           => ['nullable', 'email', 'max:255'],
            'customer_phone'           => ['required', 'string', 'max:20'],
            'service_reason'           => ['nullable', 'string', 'max:255'],
            'preferred_contact_method' => ['required', Rule::in(['phone', 'email', 'sms'])],
            'additional_issues'        => ['nullable', 'string', 'max:1000'],
        ]);

        $service = Service::findOrFail($validated['service_id']);

        $appointment = Appointment::create([
            ...$validated,
            'service_name'  => $service->name,
            'service_price' => $service->price,
            'status'        => 'pending',
        ]);

        return redirect()
            ->route('book-appointment.confirmation', $appointment->id)
            ->with('success', 'Your appointment request has been received.')
            ->with('appointment_confirmation_id', $appointment->id);
    }

    /**
     * Show a confirmation summary after booking.
     */
    public function confirmation(Appointment $appointment)
    {
        abort_unless(session('appointment_confirmation_id') === $appointment->id, 403);

        return view('frontend.pages.book-appointment-confirmation', [
            'appointment' => $appointment,
        ]);
    }
}
