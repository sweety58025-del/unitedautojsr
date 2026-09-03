<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        Brand::truncate();
            $brands = [
                'Toyota', 'Hyundai', 'Suzuki', 'Tata', 'Mahindra', 'Ford',
                'Volkswagen', 'Kia', 'Renault', 'Chevrolet', 'Fiat', 'Mitsubishi',
                'Jeep', 'Mini', 'Land Rover', 'Jaguar', 'Volvo', 'BMW', 'Audi',
                'Mercedes-Benz', 'Eicher', 'Force', 'BharatBenz',
            ];
            foreach ($brands as $name) {
                $slug = strtolower(str_replace(' ', '-', $name));
            Brand::create([
                'name' => $name,
                    'image' => "images/logo-brands/{$slug}.png",
            ]);
        }
    }
}
