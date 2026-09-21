@extends('frontend.partials.master')
@section('title', 'United Auto | Car Service & Detailing in Jamshedpur')
@section('meta_description', 'United Auto provides premium car servicing, detailing, paint protection, and maintenance in Jamshedpur with reliable repair and workshop solutions.')
@section('og_title', 'United Auto | Car Service & Detailing in Jamshedpur')
@php
    $homeCompany = \App\Models\CompanySetting::firstRecord();
    $homePhone = $homeCompany?->phone ?: '7992278199 / 6201161384';
    $homeAddress = trim(($homeCompany?->address ?: 'Nagesh Tower, Near Goods Shed Road, Burma Mines, Jamshedpur - 831007') . ', ' . ($homeCompany?->city ?: 'Jamshedpur') . ', ' . ($homeCompany?->state ?: 'Jharkhand') . ' - ' . ($homeCompany?->pincode ?: '831007'));
    $homeAddress = preg_replace('/,\s*,/', ',', $homeAddress);
@endphp

@section('content')

@include('frontend.components.banner')
@include('frontend.components.about')
@include('frontend.components.services')
@include('frontend.components.project-gallery')
@include('frontend.components.faq')
@include('frontend.components.blog-news')
@include('frontend.components.why-us')
@include('frontend.components.showcase-highlights')
@include('frontend.components.partners')
@include('frontend.components.testimonials')
@include('frontend.components.contact')

@php
    $schemaJson = [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => 'United Auto',
        'image' => asset('assets/images/company/' . ($homeCompany?->logo ?? 'logo.png')),
        'description' => 'United Auto provides premium car servicing, detailing, paint protection, and maintenance in Jamshedpur.',
        'telephone' => '+91' . preg_replace('/\D+/', '', (string) ($homePhone ?? '')), 
        'email' => $homeCompany?->email ?? 'hello@unitedauto.in',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $homeCompany?->address ?? 'Nagesh Tower, Near Goods Shed Road, Burma Mines',
            'addressLocality' => $homeCompany?->city ?? 'Jamshedpur',
            'addressRegion' => $homeCompany?->state ?? 'Jharkhand',
            'postalCode' => $homeCompany?->pincode ?? '831007',
            'addressCountry' => 'IN',
        ],
        'areaServed' => 'Jamshedpur',
        'openingHours' => 'Mo-Sa 09:00-18:00',
        'sameAs' => [],
        'makesOffer' => [
            '@type' => 'Offer',
            'itemOffered' => [
                '@type' => 'Service',
                'name' => 'Car servicing, detailing, paint protection and maintenance',
                'areaServed' => 'Jamshedpur',
            ],
        ],
    ];
    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'What services do you offer for car maintenance?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'United Auto offers car dry cleaning, ceramic and Teflon coating, anti-rust treatment, paint protection film, interior detailing, and full body polishing.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'How long does ceramic coating last on my car?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Premium ceramic coatings typically last 3 to 5 years depending on maintenance and environmental conditions.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'Is paint protection film worth it?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Paint protection film helps protect a vehicle from rock chips, scratches, and environmental damage.',
                ],
            ],
        ],
    ];
@endphp

<script type="application/ld+json">
{!! json_encode($schemaJson, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
<script type="application/ld+json">
{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

@endsection