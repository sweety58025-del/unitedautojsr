@extends('frontend.partials.master')
@section('title', 'United Auto | Car Service & Detailing in Jamshedpur')
@section('meta_description', 'United Auto provides premium car servicing, detailing, paint protection, and maintenance in Jamshedpur with reliable repair and workshop solutions.')
@section('og_title', 'United Auto | Car Service & Detailing in Jamshedpur')
@section('content')

@php
    $faqItems = [
        ['question' => 'What services do you offer for car maintenance?', 'answer' => 'We offer car dry cleaning, ceramic & Teflon coating, anti-rust treatment, paint protection film (PPF), interior detailing, and full body polishing. Our comprehensive services ensure your vehicle stays in peak condition.'],
        ['question' => 'How long does ceramic coating last on my car?', 'answer' => 'Premium ceramic coatings typically last 3-5 years depending on maintenance and environmental conditions. Proper care and regular washing will help extend the lifespan of the coating.'],
        ['question' => 'Is paint protection film (PPF) worth it?', 'answer' => "Yes, PPF is excellent protection against rock chips, scratches, and environmental damage. It preserves your car's paint and resale value, making it a worthwhile investment for new or high-value vehicles."],
        ['question' => 'How often should I get my car dry cleaned?', 'answer' => 'We recommend dry cleaning your car every 2-3 months, or more frequently if you drive in dusty or polluted areas. Regular dry cleaning maintains your vehicle\'s interior cleanliness and air quality.'],
    ];
@endphp

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