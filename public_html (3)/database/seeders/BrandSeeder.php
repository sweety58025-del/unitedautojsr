<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Maruti', 'Hyundai', 'Tata Motors', 'Mahindra', 'Toyota', 'Ford',
            'Fiat', 'Jeep', 'Chevrolet', 'Honda', 'Skoda', 'Volkswagen',
            'Renault', 'Mercedes-Benz', 'Audi', 'BMW', 'Mitsubishi',
        ];

        foreach ($brands as $sortOrder => $name) {
                $slug = strtolower(str_replace(' ', '-', $name));
            Brand::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'image' => "images/logo-brands/{$slug}.png",
                    'sort_order' => $sortOrder,
                    'status' => 'yes',
                ]
            );
        }
    }
}
