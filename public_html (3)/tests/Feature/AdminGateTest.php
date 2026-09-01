<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class AdminGateTest extends TestCase
{
    use RefreshDatabase;
    public function test_admin_users_are_allowed_by_default_gate()
    {
        $user = User::factory()->create([
            'email' => 'admin-gate@example.com',
            'user_type' => 'admin',
            'is_active' => 'yes',
        ]);

        $this->assertTrue(Gate::forUser($user)->allows('view-dashboard'));
        $this->assertTrue(Gate::forUser($user)->allows('show-category'));
    }
}
