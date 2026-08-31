<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\HeroBanner;

class HeroBannerSeeder extends Seeder
{
    public function run(): void
    {
        HeroBanner::truncate();
        $banners = [
            ['banner_image' => 'images/background/1.webp', 'sub_title' => 'AFFORDABLE & RELIABLE', 'main_title' => 'Comprehensive Car Care Solutions', 'sort_paragraph' => 'Ensuring your car\'s performance and safety with premium services.'],
            ['banner_image' => 'images/background/2.webp', 'sub_title' => 'TRUSTED CAR CARE', 'main_title' => 'Multi-Brand Bosch Service Center', 'sort_paragraph' => 'Expert services for all vehicle maintenance and repairs.'],
            ['banner_image' => 'images/background/3.webp', 'sub_title' => 'QUALITY ASSURED', 'main_title' => 'Professional Auto Servicing', 'sort_paragraph' => 'Certified technicians providing top-quality maintenance services.'],
        ];
        foreach ($banners as $b) {
            HeroBanner::create($b);
        }
    }
}
