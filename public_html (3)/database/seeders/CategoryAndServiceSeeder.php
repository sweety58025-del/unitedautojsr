<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Service;

class CategoryAndServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::truncate();
        SubCategory::truncate();
        Category::truncate();

        // ========== CATEGORY 1: CAR WASHING & CLEANING ==========
        $cat1 = Category::create([
            'name' => 'Car Washing & Cleaning', 'slug' => 'car-washing-cleaning',
            'description' => 'Professional car washing and cleaning services', 'status' => 'yes',
            'category_image' => 'images/services-2/1.webp'
        ]);
        $sub1a = SubCategory::create(['category_id' => $cat1->id, 'name' => 'Dry Cleaning', 'slug' => 'dry-cleaning']);
        $sub1b = SubCategory::create(['category_id' => $cat1->id, 'name' => 'Car Washing', 'slug' => 'car-washing']);
        $sub1c = SubCategory::create(['category_id' => $cat1->id, 'name' => 'Interior Cleaning', 'slug' => 'interior-cleaning']);
        
        Service::create(['category_id' => $cat1->id, 'sub_category_id' => $sub1a->id, 'name' => 'Dry Cleaning', 'price' => 1500, 'unit' => 'per vehicle', 'notes' => 'Professional interior vacuum and dust removal.']);
        Service::create(['category_id' => $cat1->id, 'sub_category_id' => $sub1b->id, 'name' => 'Car Washing', 'price' => 350, 'unit' => 'per vehicle', 'notes' => 'Water spray car wash with vacuum cleaning.']);

        // ========== CATEGORY 2: COATING & PROTECTION ==========
        $cat2 = Category::create([
            'name' => 'Coating & Protection', 'slug' => 'coating-protection',
            'description' => 'Paint and surface protection services', 'status' => 'yes',
            'category_image' => 'images/services-2/2.webp'
        ]);
        $sub2a = SubCategory::create(['category_id' => $cat2->id, 'name' => 'Polishing & Waxing', 'slug' => 'polishing-waxing']);
        $sub2b = SubCategory::create(['category_id' => $cat2->id, 'name' => 'Ceramic Coating', 'slug' => 'ceramic-coating']);
        $sub2c = SubCategory::create(['category_id' => $cat2->id, 'name' => 'Teflon Coating', 'slug' => 'teflon-coating']);
        $sub2d = SubCategory::create(['category_id' => $cat2->id, 'name' => 'PPF Coating', 'slug' => 'ppf-coating']);
        $sub2e = SubCategory::create(['category_id' => $cat2->id, 'name' => 'Anti-Rust Coating', 'slug' => 'anti-rust-coating']);
        
        Service::create(['category_id' => $cat2->id, 'sub_category_id' => $sub2a->id, 'name' => 'Rubbing & Polishing', 'price' => 2500, 'unit' => 'per vehicle', 'notes' => 'Professional polishing and rubbing service.']);
        Service::create(['category_id' => $cat2->id, 'sub_category_id' => $sub2a->id, 'name' => 'Wax Polishing', 'price' => 800, 'unit' => 'per vehicle', 'notes' => 'FREE car body wax polishing.']);
        Service::create(['category_id' => $cat2->id, 'sub_category_id' => $sub2b->id, 'name' => 'Ceramic Coating', 'price' => 25000, 'unit' => 'per vehicle', 'notes' => 'Premium ceramic protection for long-lasting shine.']);
        Service::create(['category_id' => $cat2->id, 'sub_category_id' => $sub2c->id, 'name' => 'Teflon Coating', 'price' => 2500, 'unit' => 'per vehicle', 'notes' => 'Advanced Teflon protection layer.']);
        Service::create(['category_id' => $cat2->id, 'sub_category_id' => $sub2d->id, 'name' => 'PPF Coating', 'price' => 125000, 'unit' => 'per vehicle', 'notes' => 'Paint Protection Film (PPF) for maximum protection.']);
        Service::create(['category_id' => $cat2->id, 'sub_category_id' => $sub2e->id, 'name' => 'Anti-Rust Coating', 'price' => 2500, 'unit' => 'per vehicle', 'notes' => 'Professional anti-rust treatment.']);

        // ========== CATEGORY 3: ENGINE & REPAIR SERVICES ==========
        $cat3 = Category::create([
            'name' => 'Engine & Repair Services', 'slug' => 'engine-repair-services',
            'description' => 'Engine maintenance and repair services', 'status' => 'yes',
            'category_image' => 'images/services-2/3.webp'
        ]);
        $sub3a = SubCategory::create(['category_id' => $cat3->id, 'name' => 'Engine Overhaul', 'slug' => 'engine-overhaul']);
        $sub3b = SubCategory::create(['category_id' => $cat3->id, 'name' => 'Brake Service', 'slug' => 'brake-service']);
        $sub3c = SubCategory::create(['category_id' => $cat3->id, 'name' => 'AC Service', 'slug' => 'ac-service']);
        $sub3d = SubCategory::create(['category_id' => $cat3->id, 'name' => 'Suspension Work', 'slug' => 'suspension-work']);
        $sub3e = SubCategory::create(['category_id' => $cat3->id, 'name' => 'Scanning & Diagnostics', 'slug' => 'scanning-diagnostics']);
        $sub3f = SubCategory::create(['category_id' => $cat3->id, 'name' => 'Throttle Body Cleaning', 'slug' => 'throttle-body-cleaning']);
        
        Service::create(['category_id' => $cat3->id, 'sub_category_id' => $sub3a->id, 'name' => 'Engine Overhaul', 'price' => 5000, 'unit' => 'per vehicle', 'notes' => 'Get 20% off (Spare parts charges extra).']);
        Service::create(['category_id' => $cat3->id, 'sub_category_id' => $sub3b->id, 'name' => 'Brake Service', 'price' => 2000, 'unit' => 'per vehicle', 'notes' => 'Professional brake inspection and service.']);
        Service::create(['category_id' => $cat3->id, 'sub_category_id' => $sub3c->id, 'name' => 'AC Service', 'price' => 3000, 'unit' => 'per vehicle', 'notes' => 'Get 20% off on AC service (Spare parts extra).']);
        Service::create(['category_id' => $cat3->id, 'sub_category_id' => $sub3d->id, 'name' => 'Suspension Work', 'price' => 4000, 'unit' => 'per vehicle', 'notes' => 'Get 20% off on suspension work (Spare parts extra).']);
        Service::create(['category_id' => $cat3->id, 'sub_category_id' => $sub3e->id, 'name' => 'Car Scanning', 'price' => 0, 'unit' => 'FREE', 'notes' => 'FREE car scanning service (Spare parts charges extra).']);
        Service::create(['category_id' => $cat3->id, 'sub_category_id' => $sub3f->id, 'name' => 'Throttle Body Cleaning', 'price' => 0, 'unit' => 'FREE', 'notes' => 'FREE throttle body cleaning service.']);
        
        // ========== CATEGORY 4: WHEEL & SUSPENSION MAINTENANCE ==========
        $cat4 = Category::create([
            'name' => 'Wheel & Suspension', 'slug' => 'wheel-suspension',
            'description' => 'Tire, wheel, and suspension services', 'status' => 'yes',
            'category_image' => 'images/services-2/4.webp'
        ]);
        $sub4a = SubCategory::create(['category_id' => $cat4->id, 'name' => 'Wheel Alignment', 'slug' => 'wheel-alignment']);
        $sub4b = SubCategory::create(['category_id' => $cat4->id, 'name' => 'Tire Service', 'slug' => 'tire-service']);
        
        Service::create(['category_id' => $cat4->id, 'sub_category_id' => $sub4a->id, 'name' => 'Wheel Alignment', 'price' => 2500, 'unit' => 'per vehicle', 'notes' => 'Precision alignment for optimal handling.']);
        Service::create(['category_id' => $cat4->id, 'sub_category_id' => $sub4b->id, 'name' => 'Tire Service', 'price' => 1500, 'unit' => 'per vehicle', 'notes' => 'Complete tire inspection and service.']);

        // ========== CATEGORY 5: SPECIALTY SERVICES ==========
        $cat5 = Category::create([
            'name' => 'Specialty Services', 'slug' => 'specialty-services',
            'description' => 'Specialized automotive services', 'status' => 'yes',
            'category_image' => 'images/services-2/5.webp'
        ]);
        $sub5a = SubCategory::create(['category_id' => $cat5->id, 'name' => 'Injector Cleaning', 'slug' => 'injector-cleaning']);
        $sub5b = SubCategory::create(['category_id' => $cat5->id, 'name' => 'Silencer Coating', 'slug' => 'silencer-coating']);
        
        Service::create(['category_id' => $cat5->id, 'sub_category_id' => $sub5a->id, 'name' => 'Injector & Brake Pad Cleaning', 'price' => 0, 'unit' => 'FREE', 'notes' => 'FREE cleaning service (Weight charges extra).']);
        Service::create(['category_id' => $cat5->id, 'sub_category_id' => $sub5b->id, 'name' => 'Silencer Coating', 'price' => 800, 'unit' => 'per vehicle', 'notes' => 'Professional silencer protection coating.']);
    }
}
