@extends('frontend.partials.master')
@section('title', 'United Auto | Car Service & Detailing in Jamshedpur')
@section('meta_description', 'United Auto provides premium car servicing, detailing, paint protection, and maintenance in Jamshedpur with reliable repair and workshop solutions.')
@section('og_title', 'United Auto | Car Service & Detailing in Jamshedpur')
@section('content')

@include('frontend.components.banner')
@include('frontend.components.about')
@include('frontend.components.services')
@include('frontend.components.project-gallery')
@include('frontend.components.faq', ['faqItems' => $faqItems])
@include('frontend.components.blog-news')
@include('frontend.components.why-us')
@include('frontend.components.showcase-highlights')
@include('frontend.components.partners')
@include('frontend.components.testimonials')
@include('frontend.components.contact')

@php
    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => collect($faqItems)->map(fn (array $item) => [
            '@type' => 'Question',
            'name' => $item['question'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $item['answer']],
        ])->all(),
    ];
@endphp

<script type="application/ld+json">
{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}
</script>

@endsection