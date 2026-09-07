<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        $brands = [
            'Maruti', 'Hyundai', 'Tata Motors', 'Mahindra', 'Toyota', 'Ford',
            'Fiat', 'Jeep', 'Chevrolet', 'Honda', 'Skoda', 'Volkswagen',
            'Renault', 'Mercedes-Benz', 'Audi', 'BMW', 'Mitsubishi',
        ];

        foreach ($brands as $sortOrder => $name) {
            $slug = Str::slug($name);
            DB::table('brands')->updateOrInsert(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'image' => "images/logo-brands/{$slug}.png",
                    'sort_order' => $sortOrder,
                    'status' => 'yes',
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }

    public function down(): void
    {
        DB::table('brands')->whereIn('slug', [
            'maruti', 'hyundai', 'tata-motors', 'mahindra', 'toyota', 'ford',
            'fiat', 'jeep', 'chevrolet', 'honda', 'skoda', 'volkswagen',
            'renault', 'mercedes-benz', 'audi', 'bmw', 'mitsubishi',
        ])->delete();
    }
};
