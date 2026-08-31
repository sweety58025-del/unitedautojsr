<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name'              => 'Admin User',
                'email'             => 'admin@example.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'),
                'phone'             => '9876543210',
                'profile_image'     => 'default.png',
                'city'              => 'Ranchi',
                'state'             => 'Jharkhand',
                'country'           => 'India',
                'pincode'           => '834001',
                'address'           => 'Bariatu Road, Ranchi',
                'is_active'         => 'yes',
                'user_type'         => 'admin',
                'remember_token'    => '',
            ]);
        }

        $this->call([
            PermissionSeeder::class,
            HeroBannerSeeder::class,
            AboutWebsiteSeeder::class,
            CategoryAndServiceSeeder::class,
            BrandSeeder::class,
            GallerySeeder::class,
            TestimonialSeeder::class,
            ServicePriceSeeder::class,
        ]);
    }
}
