<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:show-appointment', only: ['index']),
            new Middleware('permission:edit-appointment', only: ['updateStatus']),
            new Middleware('permission:edit-appointment', only: ['edit', 'update']),
            new Middleware('permission:delete-appointment', only: ['destroy']),
        ];
    }
    public function index()
    {
        $appointments = Appointment::latest()->paginate(20);

        return view('backend.appointment.index', compact('appointments'));
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $services = Service::orderBy('sort_order')->orderBy('name')->get();

        return view('backend.appointment.edit', compact('appointment', 'services'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'service_id'               => ['required', 'exists:services,id'],
            'vehicle_make_model'       => ['required', 'string', 'max:255'],
            'registration_number'      => ['required', 'string', 'max:50'],
            'appointment_date'         => ['required', 'date'],
            'appointment_time'         => ['required', Rule::in(['9:00 AM', '9:30 AM', '10:00 AM', '10:30 AM', '11:00 AM', '11:30 AM', '1:00 PM', '1:30 PM', '2:00 PM', '2:30 PM', '3:00 PM', '3:30 PM', '4:00 PM', '4:30 PM'])],
            'customer_name'            => ['required', 'string', 'max:255'],
            'customer_email'           => ['nullable', 'email', 'max:255'],
            'customer_phone'           => ['required', 'string', 'max:20'],
            'service_reason'           => ['nullable', 'string', 'max:255'],
            'preferred_contact_method' => ['required', Rule::in(['phone', 'email', 'sms'])],
            'additional_issues'        => ['nullable', 'string', 'max:1000'],
            'status'                   => ['required', Rule::in(['pending', 'confirmed', 'completed', 'cancelled'])],
        ]);

        $appointment = Appointment::findOrFail($id);
        $service = Service::findOrFail($validated['service_id']);
        $appointment->update([
            ...$validated,
            'service_name' => $service->name,
            'service_price' => $service->price,
        ]);

        return redirect()->route('appointment.index')->with('success', 'Appointment updated.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', Rule::in(['pending', 'confirmed', 'completed', 'cancelled'])],
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => $request->status]);

        return redirect()->route('appointment.index')->with('success', 'Appointment status updated.');
    }

    public function destroy($id)
    {
        Appointment::destroy($id);

        return redirect()->route('appointment.index')->with('success', 'Appointment deleted.');
    }
}
