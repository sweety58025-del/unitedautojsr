<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            DB::table('users')
                ->where('email', 'admin@example.com')
                ->update([
                    'name' => 'Amit Mukherjee',
                    'profile_image' => 'user-13.jpg',
                    'updated_at' => now(),
                ]);
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('users')) {
            DB::table('users')
                ->where('email', 'admin@example.com')
                ->update([
                    'name' => 'Admin User',
                    'profile_image' => 'default.png',
                    'updated_at' => now(),
                ]);
        }
    }
};