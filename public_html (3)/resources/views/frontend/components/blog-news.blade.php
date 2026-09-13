{{-- Blog & News Section --}}
<section class="section">
    <div class="container">
        <div style="margin-bottom: var(--space-5); text-align: center;">
            <p class="eyebrow" style="justify-content: center;">OUR BLOG</p>
            <h2 style="color: var(--color-white); font-weight: var(--font-weight-bold); letter-spacing: -0.02em;">Latest Blog & News</h2>
            <p style="max-width: 560px; margin: 0 auto; color: var(--color-text-muted);">Stay updated with the latest automotive tips and news from United Auto.</p>
        </div>

        <div class="grid grid-3">
            @forelse($articles as $article)
            <div class="card card-glass">
                <div class="blog-card-media">
                    <img src="{{ asset($article->image ?: 'images/blog/1.webp') }}" alt="{{ $article->title }}" loading="lazy">
                </div>
                <div class="card-body">
                    <div style="display: flex; align-items: center; gap: var(--space-1); margin-bottom: var(--space-2); font-size: 12px; color: var(--color-text-muted);">
                        <span>👤 Admin</span>
                        <span>•</span>
                        <span>📅 {{ optional($article->published_at)->format('d M Y') }}</span>
                    </div>
                    <h3 style="font-size: 19px; font-weight: var(--font-weight-bold); letter-spacing: -0.01em; margin-top: var(--space-1); margin-bottom: var(--space-2);">{{ $article->title }}</h3>
                    <p style="font-size: 14px; line-height: 1.6;">{{ $article->excerpt }}</p>
                    <a href="{{ route('articles.show', $article) }}" style="color: var(--color-primary-red); font-weight: var(--font-weight-bold); font-size: 14px;">Read More →</a>
                </div>
            </div>
            @empty
                <p>No articles are available yet.</p>
            @endforelse
        </div>

        <div style="text-align: center; margin-top: var(--space-5);">
            <a class="btn btn-primary" href="{{ route('articles.index') }}">View All Articles →</a>
        </div>
    </div>
</section>
