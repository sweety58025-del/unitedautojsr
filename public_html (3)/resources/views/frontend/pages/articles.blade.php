@extends('frontend.partials.master')
@section('title', 'Car Care Articles | United Auto')
@section('meta_description', 'Automotive care tips, maintenance guidance, and vehicle protection articles from United Auto.')
@section('content')
@include('frontend.partials.breadcumbs')
<section class="section">
    <div class="container">
        <div style="margin-bottom: var(--space-5); text-align: center;">
            <p class="eyebrow" style="justify-content: center;">OUR BLOG</p>
            <h1 style="color: var(--color-white);">Latest Articles</h1>
        </div>
        <div class="grid grid-3">
            @forelse($articles as $article)
                <article class="card card-glass">
                    <div class="blog-card-media"><img src="{{ asset($article->image ?: 'images/blog/1.webp') }}" alt="{{ $article->title }}" loading="lazy"></div>
                    <div class="card-body">
                        <p>{{ optional($article->published_at)->format('d M Y') }}</p>
                        <h2 style="font-size: 22px;">{{ $article->title }}</h2>
                        <p>{{ $article->excerpt }}</p>
                        <a href="{{ route('articles.show', $article) }}" class="btn btn-primary">Read Article</a>
                    </div>
                </article>
            @empty
                <p>No articles are available yet.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection