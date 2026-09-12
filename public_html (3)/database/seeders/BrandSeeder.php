<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Maruti', 'image' => 'images/logo-brands/suzuki.png'],
            ['name' => 'Hyundai', 'image' => 'images/logo-brands/hyundai.png'],
            ['name' => 'Tata Motors', 'image' => 'images/logo-brands/tata.png'],
            ['name' => 'Mahindra', 'image' => 'images/logo-brands/mahindra.png'],
            ['name' => 'Toyota', 'image' => 'images/logo-brands/toyota.png'],
            ['name' => 'Ford', 'image' => 'images/logo-brands/ford.png'],
            ['name' => 'Fiat', 'image' => 'images/logo-brands/fiat.png'],
            ['name' => 'Jeep', 'image' => 'images/logo-brands/jeep.png'],
            ['name' => 'Chevrolet', 'image' => 'images/logo-brands/chevrolet.png'],
            ['name' => 'Volkswagen', 'image' => 'images/logo-brands/volkswagen.png'],
            ['name' => 'Renault', 'image' => 'images/logo-brands/renault.png'],
            ['name' => 'Mercedes-Benz', 'image' => 'images/logo-brands/mercedes-benz.png'],
            ['name' => 'Audi', 'image' => 'images/logo-brands/audi.png'],
            ['name' => 'BMW', 'image' => 'images/logo-brands/bmw.png'],
            ['name' => 'Mitsubishi', 'image' => 'images/logo-brands/mitsubishi.png'],
        ];

        foreach ($brands as $sortOrder => $brand) {
                $slug = strtolower(str_replace(' ', '-', $brand['name']));
            Brand::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $brand['name'],
                    'image' => $brand['image'],
                    'sort_order' => $sortOrder,
                    'status' => 'yes',
                ]
            );
        }

        Brand::whereIn('slug', ['honda', 'skoda'])->update(['status' => 'no']);
    }
}
