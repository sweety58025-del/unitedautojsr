@php
    use App\Models\Gallery;
    use Illuminate\Support\Str;

    $galleryItems = Gallery::allGalleries();
@endphp

<section class="section project-gallery-section">
    <div class="container">
        <div class="project-gallery-header">
            <p class="eyebrow">Our Work</p>
            <h2>Project Gallery</h2>
            <p>Check out some of the premium car services delivered by United Auto.</p>
        </div>

        <div class="gallery-filter-bar gallery-filter-container" role="toolbar" aria-label="Gallery filters" aria-controls="galleryGrid">
            <button class="filter-btn active" type="button" data-filter="all" aria-pressed="true">All</button>
            <button class="filter-btn" type="button" data-filter="before" aria-pressed="false">Before</button>
            <button class="filter-btn" type="button" data-filter="during" aria-pressed="false">During</button>
            <button class="filter-btn" type="button" data-filter="after" aria-pressed="false">After</button>
        </div>

        <div id="galleryGrid" class="project-gallery-grid" aria-live="polite">
            @foreach($galleryItems as $item)
                @php
                    $lowerName = strtolower($item->name);
                    $category = Str::contains($lowerName, 'before') ? 'before' : (Str::contains($lowerName, 'during') || Str::contains($lowerName, 'progress') ? 'during' : 'after');
                @endphp

                <div class="gallery-item" data-category="{{ $category }}">
                    <a href="{{ asset($item->image) }}" data-fancybox="united-auto-gallery" data-caption="{{ $item->name }}">
                        <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" loading="lazy">
                    </a>
                    <div class="gallery-caption">
                        <h4>{{ $item->name }}</h4>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .project-gallery-section {
        background: linear-gradient(180deg, rgba(var(--color-one-rgb), 0.04), rgba(var(--color-one-rgb), 0.01));
        padding: var(--space-5) 0;
    }

    .project-gallery-header {
        text-align: center;
        margin-bottom: var(--space-4);
    }

    .project-gallery-header h2 {
        margin: 0 0 var(--space-2);
    }

    .project-gallery-header p {
        margin: 0;
        color: var(--color-text-muted);
    }

    .gallery-filter-bar {
        display: flex;
        gap: var(--space-2);
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: var(--space-5);
    }

    .filter-btn {
        padding: 8px 20px;
        border: 2px solid var(--color-border);
        background: var(--color-white);
        color: var(--color-text-muted);
        border-radius: 20px;
        cursor: pointer;
        font-weight: var(--font-weight-medium);
        font-size: 14px;
        transition: all var(--transition-normal);
        text-transform: uppercase;
    }

    .filter-btn:hover {
        border-color: var(--color-one);
        color: var(--color-one);
    }

    .filter-btn:focus-visible {
        outline: 3px solid rgba(var(--color-one-rgb), 0.25);
        outline-offset: 2px;
    }

    .filter-btn.active {
        background: var(--color-one);
        color: var(--color-white);
        border-color: var(--color-one);
    }

    .project-gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: var(--space-4);
    }

    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: var(--radius-card);
        background: var(--color-white);
        border: 1px solid rgba(var(--color-one-rgb), 0.14);
        box-shadow: 0 14px 28px rgba(var(--color-one-rgb), 0.08);
        transition: transform var(--transition-normal), box-shadow var(--transition-normal);
    }

    .gallery-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 36px rgba(var(--color-one-rgb), 0.14);
    }

    .gallery-item[hidden] {
        display: none;
    }

    .gallery-item a {
        display: block;
        width: 100%;
        height: 100%;
    }

    .gallery-item img {
        width: 100%;
        height: 260px;
        aspect-ratio: 4 / 3;
        object-fit: cover;
        display: block;
    }

    .gallery-caption {
        padding: var(--space-3);
        background: linear-gradient(180deg, rgba(var(--color-one-rgb), 0.06), rgba(var(--color-one-rgb), 0.92));
        position: absolute;
        inset: auto 0 0 0;
    }

    .gallery-caption h4 {
        color: var(--color-white);
        margin: 0;
        font-size: 16px;
    }

    .gallery-item.hidden {
        display: none;
    }

    @media (max-width: 991px) {
        .project-gallery-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 576px) {
        .project-gallery-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .filter-btn,
        .gallery-item {
            transition: none;
        }
    }
</style>
