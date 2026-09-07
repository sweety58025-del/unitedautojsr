<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecurityBehaviorTest extends TestCase
{
    use RefreshDatabase;

    public function test_inactive_services_cannot_be_booked_by_direct_request(): void
    {
        $category = Category::create([
            'name' => 'Maintenance',
            'slug' => 'maintenance',
            'status' => 'yes',
        ]);
        $service = Service::create([
            'category_id' => $category->id,
            'name' => 'Hidden Service',
            'price' => 49,
            'status' => 'no',
        ]);

        $response = $this->post(route('book-appointment.store'), [
            'service_id' => $service->id,
            'vehicle_make_model' => 'Honda City',
            'registration_number' => 'JH-01-AB-1234',
            'appointment_date' => now()->addDay()->format('Y-m-d'),
            'appointment_time' => '10:00 AM',
            'customer_name' => 'Test User',
            'customer_phone' => '9876543210',
            'preferred_contact_method' => 'phone',
        ]);

        $response->assertSessionHasErrors('service_id');
        $this->assertDatabaseMissing('appointments', ['service_id' => $service->id]);
    }

    public function test_appointment_confirmation_requires_the_booking_session(): void
    {
        $appointment = Appointment::create([
            'service_name' => 'Oil Change',
            'vehicle_make_model' => 'Honda City',
            'registration_number' => 'JH-01-AB-1234',
            'appointment_date' => now()->addDay()->format('Y-m-d'),
            'appointment_time' => '10:00 AM',
            'customer_name' => 'Private Customer',
            'customer_phone' => '9876543210',
            'preferred_contact_method' => 'phone',
            'status' => 'pending',
        ]);

        $this->get(route('book-appointment.confirmation', $appointment))
            ->assertForbidden();
    }
}
