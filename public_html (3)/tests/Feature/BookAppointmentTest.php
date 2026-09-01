<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookAppointmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_page_loads_with_available_services()
    {
        $category = Category::create([
            'name' => 'Maintenance',
            'slug' => 'maintenance',
            'status' => 'yes',
        ]);

        $service = Service::create([
            'category_id' => $category->id,
            'name' => 'Oil Change',
            'price' => 49.00,
            'unit' => 'each',
        ]);

        $response = $this->get(route('book-appointment'));

        $response->assertOk();
        $response->assertSee('Oil Change');
    }

    public function test_a_customer_can_submit_a_booking_and_reach_confirmation()
    {
        $category = Category::create([
            'name' => 'Maintenance',
            'slug' => 'maintenance',
            'status' => 'yes',
        ]);

        $service = Service::create([
            'category_id' => $category->id,
            'name' => 'Brake Inspection',
            'price' => 79.00,
            'unit' => 'each',
        ]);

        $payload = [
            'service_id' => $service->id,
            'vehicle_make_model' => 'Maruti Suzuki Swift',
            'registration_number' => 'JH-01-AB-1234',
            'appointment_date' => now()->addDay()->format('Y-m-d'),
            'appointment_time' => '10:30 AM',
            'customer_name' => 'Mike Johnson',
            'customer_email' => 'mike@example.com',
            'customer_phone' => '9876543210',
            'preferred_contact_method' => 'phone',
            'service_reason' => 'Routine check',
            'additional_issues' => null,
        ];

        $response = $this->post(route('book-appointment.store'), $payload);

        $this->assertDatabaseHas('appointments', [
            'customer_name' => 'Mike Johnson',
            'registration_number' => 'JH-01-AB-1234',
            'service_name' => 'Brake Inspection',
            'status' => 'pending',
        ]);

        $appointment = Appointment::first();
        $response->assertRedirect(route('book-appointment.confirmation', $appointment->id));

        $this->get(route('book-appointment.confirmation', $appointment->id))
            ->assertOk()
            ->assertSee('Mike Johnson')
            ->assertSee('Brake Inspection');
    }

    public function test_booking_requires_core_fields()
    {
        $response = $this->post(route('book-appointment.store'), []);

        $response->assertSessionHasErrors([
            'service_id',
            'vehicle_make_model',
            'registration_number',
            'appointment_date',
            'appointment_time',
            'customer_name',
            'customer_phone',
            'preferred_contact_method',
        ]);
    }

    public function test_booking_rejects_a_past_date()
    {
        $category = Category::create([
            'name' => 'Maintenance',
            'slug' => 'maintenance',
            'status' => 'yes',
        ]);

        $service = Service::create([
            'category_id' => $category->id,
            'name' => 'Tire Rotation',
            'price' => 39.00,
            'unit' => 'each',
        ]);

        $response = $this->post(route('book-appointment.store'), [
            'service_id' => $service->id,
            'vehicle_make_model' => 'Honda City',
            'registration_number' => 'JH-01-XY-9999',
            'appointment_date' => now()->subDay()->format('Y-m-d'),
            'appointment_time' => '9:00 AM',
            'customer_name' => 'Test User',
            'customer_phone' => '1234567890',
            'preferred_contact_method' => 'phone',
        ]);

        $response->assertSessionHasErrors(['appointment_date']);
    }
}
