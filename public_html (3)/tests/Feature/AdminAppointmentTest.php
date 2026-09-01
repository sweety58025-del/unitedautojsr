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
