<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        Brand::truncate();
        $names = ['Toyota','Honda','Ford','Hyundai','Suzuki','Tata','Mahindra','Kia','Volkswagen','Skoda','Renault','Nissan','Chevrolet','BMW','Audi','Mercedes-Benz'];
        foreach ($names as $i => $name) {
            $num = $i + 1;
            Brand::create([
                'name' => $name,
                'image' => "images/logo-brands/{$num}.webp",
            ]);
        }
    }
}
