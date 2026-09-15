<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Category;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAppointmentTest extends TestCase
{
    use RefreshDatabase;

    protected function makeAdmin(): User
    {
        return User::factory()->create([
            'user_type' => 'admin',
            'is_active' => 'yes',
        ]);
    }

    protected function makeAppointment(): Appointment
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

        return Appointment::create([
            'service_id' => $service->id,
            'service_name' => $service->name,
            'service_price' => $service->price,
            'vehicle_make_model' => 'Maruti Suzuki Swift',
            'registration_number' => 'JH-01-AB-1234',
            'appointment_date' => now()->addDay()->format('Y-m-d'),
            'appointment_time' => '10:30 AM',
            'customer_name' => 'Mike Johnson',
            'customer_phone' => '9876543210',
            'preferred_contact_method' => 'phone',
            'status' => 'pending',
        ]);
    }

    public function test_admin_can_view_appointment_list()
    {
        $admin = $this->makeAdmin();
        $appointment = $this->makeAppointment();

        $response = $this->actingAs($admin)->get(route('appointment.index'));

        $response->assertOk();
        $response->assertSee('Mike Johnson');
        $response->assertSee('Oil Change');
    }

    public function test_guest_cannot_view_appointment_list()
    {
        $this->makeAppointment();

        $response = $this->get(route('appointment.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_admin_can_update_appointment_status()
    {
        $admin = $this->makeAdmin();
        $appointment = $this->makeAppointment();

        $response = $this->actingAs($admin)
            ->post(route('appointment.status', $appointment->id), ['status' => 'confirmed']);

        $response->assertRedirect(route('appointment.index'));
        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'status' => 'confirmed',
        ]);
    }

    public function test_admin_can_edit_appointment_details()
    {
        $admin = $this->makeAdmin();
        $appointment = $this->makeAppointment();
        $replacementService = Service::create([
            'category_id' => $appointment->service->category_id,
            'name' => 'Brake Inspection',
            'price' => 79.00,
            'unit' => 'each',
        ]);

        $response = $this->actingAs($admin)->put(route('appointment.update', $appointment->id), [
            'service_id' => $replacementService->id,
            'vehicle_make_model' => 'Honda City',
            'registration_number' => 'JH-01-CD-5678',
            'appointment_date' => now()->addDays(2)->format('Y-m-d'),
            'appointment_time' => '2:00 PM',
            'customer_name' => 'Alex Johnson',
            'customer_email' => 'alex@example.com',
            'customer_phone' => '9876543211',
            'service_reason' => 'Brake noise',
            'preferred_contact_method' => 'email',
            'additional_issues' => 'Please inspect the front brakes.',
            'status' => 'confirmed',
        ]);

        $response->assertRedirect(route('appointment.index'));
        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'service_id' => $replacementService->id,
            'service_name' => 'Brake Inspection',
            'customer_name' => 'Alex Johnson',
            'vehicle_make_model' => 'Honda City',
            'appointment_time' => '2:00 PM',
            'status' => 'confirmed',
        ]);
    }

    public function test_admin_can_delete_appointment()
    {
        $admin = $this->makeAdmin();
        $appointment = $this->makeAppointment();

        $response = $this->actingAs($admin)
            ->post(route('appointment.delete', $appointment->id));

        $response->assertRedirect(route('appointment.index'));
        $this->assertDatabaseMissing('appointments', ['id' => $appointment->id]);
    }
}
