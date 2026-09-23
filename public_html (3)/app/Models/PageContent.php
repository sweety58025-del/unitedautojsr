<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PageContent extends Model
{
    protected $fillable = [
        'page_key',
        'eyebrow',
        'title',
        'intro',
        'body',
        'section_one_title',
        'section_one_body',
        'section_two_title',
        'section_two_body',
        'section_three_title',
        'section_three_body',
        'section_four_title',
        'section_four_body',
        'list_items',
        'hours_title',
        'hours_items',
        'pricing_title',
        'pricing_items',
        'meta_title',
        'meta_description',
        'image',
    ];

    protected $casts = [
        'list_items' => 'array',
        'hours_items' => 'array',
        'pricing_items' => 'array',
    ];

    public function getListItemsAttribute($value): array
    {
        if (is_array($value)) {
            return $value;
        }

        $decoded = json_decode((string) $value, true);

        return is_array($decoded) ? $decoded : [];
    }

    public static function forPage(string $pageKey): self
    {
        $content = static::query()->firstOrNew(['page_key' => $pageKey]);
        $defaults = static::defaults($pageKey);

        foreach ($defaults as $field => $value) {
            if (blank($content->getAttribute($field))) {
                $content->setAttribute($field, $value);
            }
        }

        return $content;
    }

    public static function defaults(string $pageKey): array
    {
        return [
            'offers' => [
                'eyebrow' => 'UNITED AUTO OFFERS',
                'title' => 'Offers for your next visit',
                'intro' => 'Explore the current service-card and roadside assistance offers available from United Auto.',
                'section_one_title' => 'Service Card Offer',
                'section_one_body' => 'Enjoy service benefits and discounts through the United Auto VIP Membership card. Ask our team about eligibility, included services, and applicable terms.',
                'section_two_title' => '25 km Road Assistance',
                'section_two_body' => 'Road Assistance for break down to any customer within a range of 25 km from our workshop.',
            ],
            'insurance' => [
                'eyebrow' => 'INSURANCE ASSISTANCE',
                'title' => 'Repair support after an accident',
                'intro' => 'United Auto can support the repair workflow for your vehicle.',
                'section_one_title' => 'Insurance repair workflow',
                'section_one_body' => 'Bring your vehicle and policy information to the workshop so the team can review the repair requirements and guide the next steps.',
            ],
            'insurance-claim-partners' => [
                'eyebrow' => 'CLAIM SUPPORT',
                'title' => 'Insurance Claim Partner',
                'intro' => 'Find the insurance companies supported for accident repair and claim-related assistance at United Auto.',
                'section_one_title' => 'Our insurance claim partners',
                'list_items' => ['SBI General', 'Royal Sundaram', 'Liberty', 'Go Digit', 'National Insurance', 'Kotak', 'Future', 'Reliance', 'Universal Sompo', 'HDFC Ergo', 'Oriental', 'Chola MS', 'Magma', 'Bharti', 'ACCO', 'Bajaj Alliance', 'New India', 'Tata AIG'],
            ],
            'insurance-renewal' => [
                'eyebrow' => 'RENEWAL SUPPORT',
                'title' => 'Insurance Renewal',
                'intro' => 'Connect with the workshop for renewal guidance through the providers listed below.',
                'section_one_title' => 'Insurance renewal providers',
                'list_items' => ['Tata AIG', 'SBI General'],
            ],
            'roadside-assistance' => [
                'eyebrow' => 'ROAD SERVICE ASSISTANCE',
                'title' => 'Roadside Assistance Terms',
                'intro' => 'Please review the service hours, charges, coverage, and booking conditions before requesting roadside assistance.',
                'section_one_title' => 'Booking and technician dispatch',
                'section_one_body' => 'The technician will start after successful completion of the booking formality and will reach as fast as possible according to the distance.',
                'section_two_title' => 'Minor breakdown cover',
                'list_items' => ['Battery jump start', 'Flattened tyre replacement', 'Fuel supply up to Rs. 500 extra', 'Minor electrical and mechanical problems according to standard tools and tackles available for breakdown assistance'],
                'section_three_title' => 'Major breakdown cover',
                'section_three_body' => "Towing of the vehicle to the workshop, with charges extra\nPassenger drop to the destination by private car, with charges extra",
                'section_four_title' => 'Additional benefits',
                'section_four_body' => "Estimate will be provided to the customer free of cost.\nAll service charges will be removed from the final bill if the work is done by United Auto.\nDiscount on labour charges is available if enrolled for our Service Card.\nReferences will attract one extra value-added service on the next visit within the listed options.",
                'hours_title' => 'Working hours',
                'hours_items' => ['Road Service Assistance|9:00 am to 9:00 pm', 'Emergency Service|9:00 pm to 9:00 am'],
                'pricing_title' => 'Service charges',
                'pricing_items' => ['5 km|Rs. 500', '7 km|Rs. 700', '15 km|Rs. 1,000', '25 km|Rs. 1,500'],
            ],
        ][$pageKey] ?? [];
    }
}
