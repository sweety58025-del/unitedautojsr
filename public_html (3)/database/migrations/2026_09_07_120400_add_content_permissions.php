<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    public function up(): void
    {
        foreach ([
            'show-brand', 'add-brand', 'edit-brand', 'delete-brand',
            'show-gallery', 'add-gallery', 'edit-gallery', 'delete-gallery',
            'show-testimonial', 'add-testimonial', 'edit-testimonial', 'delete-testimonial',
            'show-appointment', 'edit-appointment', 'delete-appointment',
            'show-repair-project', 'add-repair-project', 'edit-repair-project', 'delete-repair-project',
        ] as $name) {
            Permission::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
        }
    }

    public function down(): void
    {
        Permission::whereIn('name', [
            'show-brand', 'add-brand', 'edit-brand', 'delete-brand',
            'show-gallery', 'add-gallery', 'edit-gallery', 'delete-gallery',
            'show-testimonial', 'add-testimonial', 'edit-testimonial', 'delete-testimonial',
            'show-appointment', 'edit-appointment', 'delete-appointment',
            'show-repair-project', 'add-repair-project', 'edit-repair-project', 'delete-repair-project',
        ])->where('guard_name', 'web')->delete();
    }
};
