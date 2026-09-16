<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('company_settings')) {
            DB::table('company_settings')->update([
                'phone' => '7992278199 / 6201161384',
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('company_settings')) {
            DB::table('company_settings')->update([
                'phone' => '9876543210',
                'updated_at' => now(),
            ]);
        }
    }
};