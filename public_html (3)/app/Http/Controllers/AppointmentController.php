<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    /**
     * Show the multi-step booking form.
     */
    public function create()
    {
        $catalogServiceNames = collect(config('service-catalog', []))
            ->flatMap(fn ($group) => $group['items'] ?? [])
            ->map(fn ($item) => (string) $item)
            ->values()
            ->all();

        $catalogServiceSlugs = array_map(fn ($name) => Str::slug($name), $catalogServiceNames);
        $catalogServiceOrder = array_flip(array_map('strtolower', $catalogServiceNames));

        $services = Service::with('category')
            ->where('status', 'yes')
            ->get()
            ->filter(function ($service) use ($catalogServiceNames, $catalogServiceSlugs) {
                $serviceName = trim((string) $service->name);
                $serviceSlug = (string) ($service->slug ?: Str::slug($serviceName));

                return in_array($serviceName, $catalogServiceNames, true)
                    || in_array($serviceSlug, $catalogServiceSlugs, true)
                    || in_array(Str::slug($serviceName), $catalogServiceSlugs, true)
                    || in_array(strtolower($serviceName), array_map('strtolower', $catalogServiceNames), true);
            })
            ->sortBy(function ($service) use ($catalogServiceOrder) {
                $key = strtolower(trim((string) $service->name));

                return $catalogServiceOrder[$key] ?? PHP_INT_MAX;
            })
            ->values();

        $selectedServiceId = request()->integer('service');
        $selectedServiceSlug = trim((string) request()->input('service'));

        if ((! $selectedServiceId || $selectedServiceId < 1) && $selectedServiceSlug !== '') {
            $matchingServices = $services->filter(function ($service) use ($selectedServiceSlug) {
                $serviceName = trim((string) $service->name);
                $serviceSlug = (string) ($service->slug ?: Str::slug($serviceName));

                return strtolower($serviceSlug) === strtolower($selectedServiceSlug)
                    || strtolower(Str::slug($serviceName)) === strtolower($selectedServiceSlug)
                    || strtolower($serviceName) === strtolower(str_replace('-', ' ', $selectedServiceSlug));
            })->values();

            $selectedService = $matchingServices->isNotEmpty() ? $matchingServices->sortByDesc('id')->first() : null;
            $selectedServiceId = $selectedService?->id ?? null;
        }

        return view('frontend.pages.book-appointment', [
            'services' => $services,
            'selectedServiceId' => $selectedServiceId,
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
            'service_id' => $validated['service_id'],
            'service_name'  => $service->name,
            'service_price' => $service->price,
            'vehicle_make_model' => $validated['vehicle_make_model'],
            'registration_number' => $validated['registration_number'],
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'] ?? null,
            'customer_phone' => $validated['customer_phone'],
            'service_reason' => $validated['service_reason'] ?? null,
            'preferred_contact_method' => $validated['preferred_contact_method'],
            'additional_issues' => $validated['additional_issues'] ?? null,
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
