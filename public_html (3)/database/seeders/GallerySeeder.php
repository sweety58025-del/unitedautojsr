<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        Gallery::truncate();
        $items = [
            ['name' => 'Before - 1', 'image' => 'images/gallery/Before1.jpg'],
            ['name' => 'After - 1', 'image' => 'images/gallery/After1.jpg'],
            ['name' => 'Before - 2', 'image' => 'images/gallery/Before2.jpg'],
            ['name' => 'After - 2', 'image' => 'images/gallery/After2.jpg'],
            ['name' => 'Before - 3', 'image' => 'images/gallery/Before3.jpg'],
            ['name' => 'After - 3', 'image' => 'images/gallery/After3.jpg'],
            ['name' => 'Before - 4', 'image' => 'images/gallery/Before4.jpg'],
            ['name' => 'After - 4', 'image' => 'images/gallery/After4.jpg'],
            ['name' => 'In Progress - 1', 'image' => 'images/gallery/During1.jpg'],
            ['name' => 'In Progress - 2', 'image' => 'images/gallery/During2.jpg'],
            ['name' => 'In Progress - 3', 'image' => 'images/gallery/During3.jpg'],
            ['name' => 'In Progress - 4', 'image' => 'images/gallery/During4.jpg'],
            ['name' => 'Free Multi-Brand Car Checkup Camp - 1', 'image' => 'images/gallery-events/car-checkup-camp-1.jpg'],
            ['name' => 'Free Multi-Brand Car Checkup Camp - 2', 'image' => 'images/gallery-events/car-checkup-camp-2.jpg'],
            ['name' => 'Free Multi-Brand Car Checkup Camp - 3', 'image' => 'images/gallery-events/car-checkup-camp-3.jpg'],
        ];
        foreach ($items as $item) {
            Gallery::create($item);
        }
    }
}
