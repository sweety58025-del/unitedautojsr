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
        $services = Service::with('category')->orderBy('name')->get();

        return view('frontend.pages.book-appointment', [
            'services' => $services,
        ]);
    }

    /**
     * Persist a new appointment booking.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id'               => ['required', Rule::exists('services', 'id')],
            'vehicle_make_model'       => ['required', 'string', 'max:255'],
            'registration_number'      => ['required', 'string', 'max:50'],
            'appointment_date'         => ['required', 'date', 'after_or_equal:today'],
            'appointment_time'         => ['required', 'string', 'max:20'],
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
            ->with('success', 'Your appointment request has been received.');
    }

    /**
     * Show a confirmation summary after booking.
     */
    public function confirmation(Appointment $appointment)
    {
        return view('frontend.pages.book-appointment-confirmation', [
            'appointment' => $appointment,
        ]);
    }
}
