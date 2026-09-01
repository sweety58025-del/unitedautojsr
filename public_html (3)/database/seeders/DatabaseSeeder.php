<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
        ]);

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'              => 'Admin User',
                'email_verified_at' => now(),
                'password'          => Hash::make(env('SEED_ADMIN_PASSWORD', Str::random(16))),
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
            ]
        );

        if (! $admin->hasRole('Super Admin')) {
            $admin->assignRole('Super Admin');
        }

        $this->call([
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
