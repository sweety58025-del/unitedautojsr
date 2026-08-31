<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ServicePrice;

class ServicePriceSeeder extends Seeder
{
    public function run(): void
    {
        ServicePrice::truncate();
        $items = [
            ['item' => 'Oil Change', 'small_car_price' => 499, 'medium_price' => 699, 'suv_muv_price' => 899, 'premium_price' => 1299],
            ['item' => 'Interior Shampoo', 'small_car_price' => 1299, 'medium_price' => 1499, 'suv_muv_price' => 1799, 'premium_price' => 2299],
            ['item' => 'Ceramic Coating', 'small_car_price' => 3999, 'medium_price' => 4999, 'suv_muv_price' => 5999, 'premium_price' => 7999],
            ['item' => 'Wheel Alignment', 'small_car_price' => 699, 'medium_price' => 799, 'suv_muv_price' => 999, 'premium_price' => 1299],
            ['item' => 'Brake Pad Replacement', 'small_car_price' => 1099, 'medium_price' => 1299, 'suv_muv_price' => 1599, 'premium_price' => 1999],
        ];
        foreach ($items as $item) {
            ServicePrice::create($item);
        }
    }
}
