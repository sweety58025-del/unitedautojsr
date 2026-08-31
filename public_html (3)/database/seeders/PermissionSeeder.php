<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermissionCategory;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        PermissionCategory::truncate();

        // Some installs use the Spatie permission package with table name 'permissions'.
        // Attempt to delete existing rows if that table exists; otherwise skip.
        try {
            if (\Schema::hasTable('permissions')) {
                DB::table('permissions')->delete();
            }
        } catch (\Throwable $e) {
            // ignore if table doesn't exist
        }

        $pc = PermissionCategory::create([
            'name' => 'General',
            'slug' => 'general'
        ]);

        // minimal permissions (if permissions table exists insert friendly defaults)
        try {
            if (\Schema::hasTable('permissions')) {
                DB::table('permissions')->insert([
                    ['name' => 'view-dashboard', 'guard_name' => 'web', 'permission_category_id' => $pc->id, 'created_at' => now(), 'updated_at' => now()],
                    ['name' => 'manage-users', 'guard_name' => 'web', 'permission_category_id' => $pc->id, 'created_at' => now(), 'updated_at' => now()],
                ]);
            }
        } catch (\Throwable $e) {
            // swallow errors if permissions table doesn't match expected schema
        }
    }
}
