<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        Testimonial::truncate();
        $items = [
            ['username' => 'Priya', 'feedback' => 'My car looks brand new after detailing!'],
            ['username' => 'Rahul', 'feedback' => 'Quick and honest service, highly recommend.'],
            ['username' => 'Ankit', 'feedback' => 'Fixed my engine issue same day, great work.'],
            ['username' => 'Sneha', 'feedback' => 'Friendly staff and fair prices every time.'],
        ];
        foreach ($items as $item) {
            Testimonial::create($item);
        }
    }
}
