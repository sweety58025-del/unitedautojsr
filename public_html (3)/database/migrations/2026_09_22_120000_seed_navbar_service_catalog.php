<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $catalog = [
            [
                'name' => 'Mechanical Job',
                'items' => [
                    'Periodic Maintenance Service',
                    'Engine Overhauling',
                    'Gearbox Overhauling',
                    'Clutch Overhauling',
                    'Suspension Overhauling',
                    'Brake Overhauling',
                    'Car Scanning',
                    'A/C Repairing',
                    'Electrical Repairing',
                    'DPF Cleaning',
                    'Breakdown Facility',
                ],
            ],
            [
                'name' => 'Body Repair',
                'items' => [
                    'Denting with Automated Tools',
                    'Painting in Heat Chamber',
                    'Accidental Repair',
                    'Insurance Claim with Cashless Facility',
                    'Towing Facility from Accidental Spot',
                    'Windshield Glass Change',
                    'Full Body Colour Change',
                ],
            ],
            [
                'name' => 'Value Added Service (VAS)',
                'items' => [
                    'Anti Rust Coating',
                    'Teflon Coating',
                    'Ceramic Coating',
                    'PPF Coating',
                    'Silencer Coating',
                    'Interior Cleaning',
                    'A/C Vent Cleaning',
                    'New Battery Fitting',
                    'New Tyre Fitting',
                    'LED Head Light Fitting',
                    'New Seat Cover Fitting',
                    'New Accessories Fitting',
                ],
            ],
        ];

        foreach ($catalog as $group) {
            $category = DB::table('categories')->where('name', $group['name'])->first();

            $categoryId = $category->id ?? DB::table('categories')->insertGetId([
                'name' => $group['name'],
                'slug' => Str::slug($group['name']),
                'description' => $group['name'] . ' service offerings.',
                'category_image' => null,
                'status' => 'yes',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($group['items'] as $itemName) {
                $service = DB::table('services')
                    ->where('category_id', $categoryId)
                    ->whereRaw('LOWER(name) = ?', [strtolower($itemName)])
                    ->first();

                if (! $service) {
                    DB::table('services')->insert([
                        'category_id' => $categoryId,
                        'sub_category_id' => null,
                        'name' => $itemName,
                        'slug' => Str::slug($itemName),
                        'description' => 'Professional ' . strtolower($itemName) . ' service from United Auto.',
                        'price' => 0,
                        'unit' => 'per vehicle',
                        'notes' => null,
                        'status' => 'yes',
                        'sort_order' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $catalog = [
            'Mechanical Job',
            'Body Repair',
            'Value Added Service (VAS)',
        ];

        foreach ($catalog as $categoryName) {
            $category = DB::table('categories')->where('name', $categoryName)->first();

            if ($category) {
                DB::table('services')->where('category_id', $category->id)->delete();
                DB::table('categories')->where('id', $category->id)->delete();
            }
        }
    }
};
