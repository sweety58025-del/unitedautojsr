@extends('frontend.partials.master')
@section('title', 'Home Page')
@section('meta_description', 'United Auto provides premium car servicing, detailing, paint protection, and maintenance in Jamshedpur with reliable repair and workshop solutions.')
@section('og_title', 'United Auto | Car Service & Detailing in Jamshedpur')
@php
    $homeCompany = \App\Models\CompanySetting::firstRecord();
    $homePhone = $homeCompany?->phone ?: '9876543210';
    $homeAddress = trim(($homeCompany?->address ?: 'Nagesh Tower, Near Goods Shed Road, Burma Mines, Jamshedpur - 831007') . ', ' . ($homeCompany?->city ?: 'Jamshedpur') . ', ' . ($homeCompany?->state ?: 'Jharkhand') . ' - ' . ($homeCompany?->pincode ?: '831007'));
    $homeAddress = preg_replace('/,\s*,/', ',', $homeAddress);
@endphp

@section('content')

@include('frontend.components.banner')
@include('frontend.components.about')
@include('frontend.components.services')
@include('frontend.components.offers-discounts')
@include('frontend.components.transformation-highlights')
@include('frontend.components.project-gallery')
@include('frontend.components.faq')
@include('frontend.components.blog-news')
@include('frontend.components.facts-counter')
@include('frontend.components.why-us')
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
        'priceRange' => '₹₹',
        'sameAs' => [],
    ];
@endphp

<script type="application/ld+json">
{!! json_encode($schemaJson, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

@endsection