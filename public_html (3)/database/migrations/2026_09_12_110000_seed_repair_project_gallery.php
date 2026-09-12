<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $projects = [
            [
                'title' => 'Front panel repair',
                'vehicle_name' => 'Customer vehicle',
                'description' => 'Panel repair and finish restoration.',
                'images' => [
                    ['stage' => 'before', 'image' => 'images/gallery/Before1.jpg', 'caption' => 'Front panel before repair'],
                    ['stage' => 'during', 'image' => 'images/gallery/During1.jpg', 'caption' => 'Front panel during repair'],
                    ['stage' => 'after', 'image' => 'images/gallery/After1.jpg', 'caption' => 'Front panel after repair'],
                ],
            ],
            [
                'title' => 'Door panel refinishing',
                'vehicle_name' => 'Customer vehicle',
                'description' => 'Surface preparation and paint refinishing.',
                'images' => [
                    ['stage' => 'before', 'image' => 'images/gallery/Before2.jpg', 'caption' => 'Door panel before repair'],
                    ['stage' => 'during', 'image' => 'images/gallery/During2.jpg', 'caption' => 'Door panel during repair'],
                    ['stage' => 'after', 'image' => 'images/gallery/After2.jpg', 'caption' => 'Door panel after repair'],
                ],
            ],
            [
                'title' => 'Bodywork and paint correction',
                'vehicle_name' => 'Customer vehicle',
                'description' => 'Bodywork completed with a clean paint finish.',
                'images' => [
                    ['stage' => 'before', 'image' => 'images/gallery/Before3.jpg', 'caption' => 'Bodywork before repair'],
                    ['stage' => 'during', 'image' => 'images/gallery/During3.jpg', 'caption' => 'Bodywork during repair'],
                    ['stage' => 'after', 'image' => 'images/gallery/After3.jpg', 'caption' => 'Bodywork after repair'],
                ],
            ],
            [
                'title' => 'Exterior restoration',
                'vehicle_name' => 'Customer vehicle',
                'description' => 'Exterior repair brought back to a finished condition.',
                'images' => [
                    ['stage' => 'before', 'image' => 'images/gallery/Before4.jpg', 'caption' => 'Exterior before repair'],
                    ['stage' => 'during', 'image' => 'images/gallery/During4.jpg', 'caption' => 'Exterior during repair'],
                    ['stage' => 'after', 'image' => 'images/gallery/After4.jpg', 'caption' => 'Exterior after repair'],
                ],
            ],
        ];

        foreach ($projects as $sortOrder => $project) {
            $now = now();
            $projectId = DB::table('repair_projects')->insertGetId([
                'title' => $project['title'],
                'vehicle_name' => $project['vehicle_name'],
                'description' => $project['description'],
                'status' => 'yes',
                'sort_order' => $sortOrder,
                'is_featured' => $sortOrder === 0,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach ($project['images'] as $imageSortOrder => $image) {
                DB::table('repair_project_images')->insert([
                    'repair_project_id' => $projectId,
                    'stage' => $image['stage'],
                    'image' => $image['image'],
                    'caption' => $image['caption'],
                    'sort_order' => $imageSortOrder,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }

    public function down(): void
    {
        $projectIds = DB::table('repair_projects')
            ->whereIn('title', [
                'Front panel repair',
                'Door panel refinishing',
                'Bodywork and paint correction',
                'Exterior restoration',
            ])
            ->pluck('id');

        DB::table('repair_project_images')->whereIn('repair_project_id', $projectIds)->delete();
        DB::table('repair_projects')->whereIn('id', $projectIds)->delete();
    }
};
