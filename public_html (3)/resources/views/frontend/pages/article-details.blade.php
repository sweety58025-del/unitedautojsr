@extends('frontend.partials.master')
@section('title', $article->title)
@section('meta_description', $article->excerpt ?: $article->title)
@section('content')
@include('frontend.partials.breadcumbs')
<article class="section">
    <div class="container" style="max-width: 900px;">
        @if($article->image)
            <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" style="width: 100%; max-height: 460px; object-fit: cover; border-radius: 8px; margin-bottom: var(--space-4);">
        @endif
        <p class="eyebrow">{{ optional($article->published_at)->format('d M Y') }}</p>
        <h1 style="color: var(--color-white);">{{ $article->title }}</h1>
        @if($article->excerpt)<p style="font-size: 18px;">{{ $article->excerpt }}</p>@endif
        <div style="white-space: pre-line; line-height: 1.8; color: var(--color-text-muted);">{{ $article->content }}</div>
    </div>
</article>
@endsection