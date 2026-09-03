<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutWebsite;

class AboutWebsiteSeeder extends Seeder
{
    public function run(): void
    {
        AboutWebsite::truncate();

        AboutWebsite::create([
            'about_title' => 'Premium Car Service & Maintenance',
            'short_description' => 'We specialize in top-quality car repair and maintenance services to keep your vehicle running smoothly and safely.',
            'description' => '<p>United Auto is a multi-brand Bosch car service center providing expert services for all vehicle maintenance and repairs. Our expert team ensures comprehensive solutions with the latest technology, providing trusted and affordable car care.</p>',
            'about_image' => 'images/about/united-auto-storefront.jpg',
            'mission' => 'Deliver outstanding automotive service and customer satisfaction at affordable prices.',
            'vision' => 'To be the most trusted multi-brand Bosch car service center for comprehensive vehicle care.',
            'why_choose_title_1' => 'Advanced Diagnostic & Repair Services',
            'why_choose_content_1' => 'Latest technology and diagnostic equipment for accurate problem identification and repair.',
            'why_choose_title_2' => 'Affordable Packages & Discounts',
            'why_choose_content_2' => 'Competitive pricing with special discounts for first-time customers and bulk services.',
            'why_choose_title_3' => 'Skilled Professionals & Genuine Parts',
            'why_choose_content_3' => 'Certified technicians using only genuine and high-quality spare parts.',
            'why_choose_title_4' => 'Fast Turnaround',
            'why_choose_content_4' => 'Quick and reliable service without compromising quality. Mon–Sat: 9:00 AM – 6:00 PM.',
            'service_terms' => 'Customer can use only three coupons in a day.'
        ]);
    }
}
