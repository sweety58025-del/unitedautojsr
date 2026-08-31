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
            ['name' => 'Detailing Work - 1', 'image' => 'images/gallery/l1.webp'],
            ['name' => 'Detailing Work - 2', 'image' => 'images/gallery/l2.webp'],
            ['name' => 'Detailing Work - 3', 'image' => 'images/gallery/l3.webp'],
            ['name' => 'Detailing Work - 4', 'image' => 'images/gallery/l4.webp'],
        ];
        foreach ($items as $item) {
            Gallery::create($item);
        }
    }
}
