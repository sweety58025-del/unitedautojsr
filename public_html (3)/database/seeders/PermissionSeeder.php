<?php

namespace Database\Seeders;

use App\Models\PermissionCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        if (\Schema::hasTable('permission_categories')) {
            PermissionCategory::query()->delete();
        }

        $general = PermissionCategory::firstOrCreate([
            'name' => 'General',
            'slug' => 'general',
        ]);

        $permissions = [
            'view-dashboard',
            'manage-users',
            'show-category',
            'add-category',
            'edit-category',
            'delete-category',
            'show-service',
            'add-service',
            'edit-service',
            'delete-service',
            'show-subcategory',
            'add-subcategory',
            'edit-subcategory',
            'delete-subcategory',
            'View User',
            'Add User',
            'Edit User',
            'Delete User',
            'show-brand',
            'add-brand',
            'edit-brand',
            'delete-brand',
            'show-gallery',
            'add-gallery',
            'edit-gallery',
            'delete-gallery',
            'show-testimonial',
            'add-testimonial',
            'edit-testimonial',
            'delete-testimonial',
            'show-appointment',
            'edit-appointment',
            'delete-appointment',
            'show-repair-project',
            'add-repair-project',
            'edit-repair-project',
            'delete-repair-project',
        ];

        if (\Schema::hasTable('permissions')) {
            DB::table('permissions')->delete();

            foreach ($permissions as $permissionName) {
                Permission::firstOrCreate(
                    ['name' => $permissionName, 'guard_name' => 'web'],
                    ['permission_category_id' => $general->id]
                );
            }
        }

        if (\Schema::hasTable('roles')) {
            $adminRole = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
            $adminRole->syncPermissions($permissions);
        }
    }
}
