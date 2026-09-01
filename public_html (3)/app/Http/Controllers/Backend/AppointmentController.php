<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::latest()->paginate(20);

        return view('backend.appointment.index', compact('appointments'));
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
