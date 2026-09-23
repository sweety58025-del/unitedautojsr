@extends('frontend.partials.master')

@section('title', 'United Auto Workshop Gallery | Jamshedpur')
@section('meta_description', 'View United Auto vehicle repair, detailing, paint protection, and workshop project photos from Jamshedpur.')

@section('content')
@include('frontend.partials.breadcumbs')

@php
    $galleryItems = $gallery ?? collect();
    $repairProjects = $repairProjects ?? collect();
    $featuredItems = $galleryItems->filter(fn ($item) => filled($item->image))->values();
@endphp

<style>
    .ua-gallery-page {
        --gallery-ink: var(--color-navy, #101b31);
        --gallery-red: var(--color-primary-red, #d70006);
        --gallery-paper: var(--color-off-white, #f6f7f9);
        --gallery-line: var(--color-border, #e3e7ed);
        padding: 42px 0 110px;
        background: var(--gallery-paper);
    }

    .ua-gallery-heading {
        display: grid;
        grid-template-columns: minmax(0, 1.15fr) minmax(260px, .85fr);
        gap: 32px;
        align-items: end;
        margin-bottom: 32px;
    }

    .ua-gallery-heading h1 {
        margin: 0;
        color: var(--gallery-ink);
        font-size: clamp(2.4rem, 5vw, 4.8rem);
        line-height: .98;
    }

    .ua-gallery-heading p {
        margin: 0;
        color: #5d6878;
        font-size: 1.08rem;
        line-height: 1.7;
    }

    .ua-gallery-hero {
        position: relative;
        overflow: hidden;
        min-height: 480px;
        background: #111927;
        box-shadow: 0 22px 55px rgba(16, 27, 49, .18);
    }

    .ua-gallery-slide {
        position: absolute;
        inset: 0;
        display: grid;
        grid-template-columns: minmax(0, 1.5fr) minmax(260px, .8fr);
        opacity: 0;
        pointer-events: none;
        transition: opacity .45s ease;
    }

    .ua-gallery-slide.is-active {
        position: relative;
        opacity: 1;
        pointer-events: auto;
    }

    .ua-gallery-slide img {
        width: 100%;
        height: 100%;
        min-height: 480px;
        object-fit: cover;
    }

    .ua-gallery-slide-copy {
        display: flex;
        flex-direction: column;
        justify-content: end;
        padding: 38px;
        color: #fff;
        background: linear-gradient(145deg, #17243a, #0e1420);
    }

    .ua-gallery-kicker {
        margin-bottom: 12px;
        color: #ff5a5e;
        font-size: .76rem;
        font-weight: 800;
        letter-spacing: .16em;
        text-transform: uppercase;
    }

    .ua-gallery-slide-copy h2 {
        margin: 0 0 12px;
        color: #fff;
        font-size: clamp(1.8rem, 3vw, 3rem);
        line-height: 1.05;
    }

    .ua-gallery-slide-copy p {
        margin: 0;
        color: rgba(255, 255, 255, .72);
        line-height: 1.7;
    }

    .ua-gallery-controls {
        position: absolute;
        right: 28px;
        bottom: 24px;
        z-index: 2;
        display: flex;
        gap: 8px;
    }

    .ua-gallery-control {
        display: grid;
        width: 42px;
        height: 42px;
        place-items: center;
        border: 1px solid rgba(255,255,255,.35);
        border-radius: 50%;
        background: rgba(10, 17, 29, .55);
        color: #fff;
        cursor: pointer;
    }

    .ua-gallery-control:hover,
    .ua-gallery-control:focus-visible {
        border-color: #fff;
        background: var(--gallery-red);
    }

    .ua-gallery-dots {
        position: absolute;
        right: 134px;
        bottom: 39px;
        z-index: 2;
        display: flex;
        gap: 7px;
    }

    .ua-gallery-dot {
        width: 7px;
        height: 7px;
        padding: 0;
        border: 0;
        border-radius: 50%;
        background: rgba(255,255,255,.45);
        cursor: pointer;
    }

    .ua-gallery-dot.is-active { background: #fff; transform: scale(1.35); }

    .ua-gallery-section-head {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        align-items: end;
        margin: 72px 0 24px;
    }

    .ua-gallery-section-head h2 {
        margin: 0;
        color: var(--gallery-ink);
        font-size: clamp(1.8rem, 3vw, 2.8rem);
    }

    .ua-gallery-section-head p { max-width: 520px; margin: 0; color: #667085; line-height: 1.65; }

    .ua-gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px;
    }

    .ua-gallery-card {
        overflow: hidden;
        background: #fff;
        border: 1px solid var(--gallery-line);
        box-shadow: 0 12px 30px rgba(16, 27, 49, .07);
    }

    .ua-gallery-card-media { position: relative; aspect-ratio: 4 / 3; overflow: hidden; background: #dfe4eb; }
    .ua-gallery-card-media img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s ease; }
    .ua-gallery-card:hover img { transform: scale(1.05); }
    .ua-gallery-card-body { padding: 20px 20px 22px; }
    .ua-gallery-card-body h3 { margin: 0 0 7px; color: var(--gallery-ink); font-size: 1.2rem; }
    .ua-gallery-card-body p { margin: 0; color: #6b7280; line-height: 1.55; }
    .ua-gallery-card-tag { display: block; margin-bottom: 8px; color: var(--gallery-red); font-size: .72rem; font-weight: 800; letter-spacing: .12em; text-transform: uppercase; }

    .ua-gallery-projects { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 20px; }
    .ua-gallery-project { padding: 0; overflow: hidden; background: #fff; border: 1px solid var(--gallery-line); }
    .ua-gallery-project-images { display: grid; grid-template-columns: repeat(2, 1fr); aspect-ratio: 16 / 10; background: #dfe4eb; }
    .ua-gallery-project-images img { width: 100%; height: 100%; min-height: 0; object-fit: cover; }
    .ua-gallery-project-images img:first-child { border-right: 2px solid #fff; }
    .ua-gallery-project-body { padding: 18px 20px 22px; }
    .ua-gallery-project-body h3 { margin: 0 0 6px; color: var(--gallery-ink); font-size: 1.15rem; }
    .ua-gallery-project-body p { margin: 0; color: #687386; line-height: 1.5; }

    .ua-gallery-empty { padding: 48px 24px; text-align: center; color: #667085; background: #fff; border: 1px dashed var(--gallery-line); }

    @media (max-width: 900px) {
        .ua-gallery-heading, .ua-gallery-slide { grid-template-columns: 1fr; }
        .ua-gallery-slide img { min-height: 330px; max-height: 430px; }
        .ua-gallery-slide-copy { min-height: 230px; padding: 28px; }
        .ua-gallery-grid, .ua-gallery-projects { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }

    @media (max-width: 600px) {
        .ua-gallery-page { padding: 20px 0 70px; }
        .ua-gallery-heading { display: block; }
        .ua-gallery-heading p { margin-top: 18px; }
        .ua-gallery-hero { min-height: 580px; }
        .ua-gallery-slide img { min-height: 270px; }
        .ua-gallery-slide-copy { min-height: 280px; padding: 24px; }
        .ua-gallery-grid, .ua-gallery-projects { grid-template-columns: 1fr; }
        .ua-gallery-section-head { display: block; margin-top: 52px; }
        .ua-gallery-section-head p { margin-top: 12px; }
        .ua-gallery-controls { right: 20px; bottom: 20px; }
        .ua-gallery-dots { left: 24px; right: auto; bottom: 39px; }
    }
</style>

<main class="ua-gallery-page">
    <div class="container">
        <header class="ua-gallery-heading">
            <div>
                <span class="ua-gallery-kicker">United Auto workshop journal</span>
                <h1>Work that speaks<br>for itself.</h1>
            </div>
            <p>Explore real workshop images uploaded from the United Auto admin panel, from detailing and protection work to finished repair projects in Jamshedpur.</p>
        </header>

        @if($featuredItems->isNotEmpty())
            <section class="ua-gallery-hero" data-gallery-carousel aria-label="Featured workshop images">
                @foreach($featuredItems->take(6) as $index => $item)
                    <article class="ua-gallery-slide {{ $index === 0 ? 'is-active' : '' }}" data-gallery-slide>
                        <img src="{{ asset($item->image) }}" alt="{{ $item->name ?: 'United Auto workshop image' }}" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
                        <div class="ua-gallery-slide-copy">
                            <span class="ua-gallery-kicker">Featured image {{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                            <h2>{{ $item->name ?: 'United Auto workshop work' }}</h2>
                            <p>Real work from our workshop, carefully documented for the next United Auto visit.</p>
                        </div>
                    </article>
                @endforeach
                @if($featuredItems->count() > 1)
                    <div class="ua-gallery-dots" aria-label="Choose featured image">
                        @foreach($featuredItems->take(6) as $index => $item)
                            <button class="ua-gallery-dot {{ $index === 0 ? 'is-active' : '' }}" type="button" data-gallery-dot="{{ $index }}" aria-label="Show featured image {{ $index + 1 }}" aria-pressed="{{ $index === 0 ? 'true' : 'false' }}"></button>
                        @endforeach
                    </div>
                    <div class="ua-gallery-controls">
                        <button class="ua-gallery-control" type="button" data-gallery-prev aria-label="Previous image"><i class="bi bi-arrow-left"></i></button>
                        <button class="ua-gallery-control" type="button" data-gallery-next aria-label="Next image"><i class="bi bi-arrow-right"></i></button>
                    </div>
                @endif
            </section>
        @else
            <div class="ua-gallery-empty">Gallery images will appear here after they are uploaded from the admin panel.</div>
        @endif

        <section aria-labelledby="gallery-images-title">
            <div class="ua-gallery-section-head">
                <div><span class="ua-gallery-kicker">Workshop archive</span><h2 id="gallery-images-title">Gallery images</h2></div>
                <p>Browse the latest images uploaded through Website Content &gt; Gallery Images.</p>
            </div>
            @if($galleryItems->isNotEmpty())
                <div class="ua-gallery-grid">
                    @foreach($galleryItems as $item)
                        <article class="ua-gallery-card">
                            <a class="ua-gallery-card-media" href="{{ asset($item->image) }}" data-fancybox="united-auto-gallery" data-caption="{{ $item->name ?: 'United Auto workshop image' }}">
                                <img src="{{ asset($item->image) }}" alt="{{ $item->name ?: 'United Auto workshop image' }}" loading="lazy">
                            </a>
                            <div class="ua-gallery-card-body">
                                <span class="ua-gallery-card-tag">United Auto archive</span>
                                <h3>{{ $item->name ?: 'Workshop image' }}</h3>
                                <p>Vehicle care and workshop service from Jamshedpur.</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="ua-gallery-empty">No gallery images have been uploaded yet.</div>
            @endif
        </section>

        @if($repairProjects->isNotEmpty())
            <section aria-labelledby="gallery-projects-title">
                <div class="ua-gallery-section-head">
                    <div><span class="ua-gallery-kicker">Before to finished</span><h2 id="gallery-projects-title">Repair projects</h2></div>
                    <p>Compare real project progress managed from the Repair Projects section in Admin.</p>
                </div>
                <div class="ua-gallery-projects">
                    @foreach($repairProjects->take(6) as $project)
                        @php
                            $before = $project->images->firstWhere('stage', 'before');
                            $after = $project->images->firstWhere('stage', 'after');
                            $fallback = $project->images->first();
                        @endphp
                        <article class="ua-gallery-project">
                            <div class="ua-gallery-project-images">
                                @if($before)<img src="{{ asset($before->image) }}" alt="{{ $project->title }} before repair" loading="lazy">@endif
                                @if($after)<img src="{{ asset($after->image) }}" alt="{{ $project->title }} after repair" loading="lazy">@elseif($fallback)<img src="{{ asset($fallback->image) }}" alt="{{ $project->title }} workshop image" loading="lazy">@endif
                            </div>
                            <div class="ua-gallery-project-body">
                                <h3>{{ $project->title }}</h3>
                                <p>{{ $project->brand?->name ?: 'United Auto' }}{{ $project->vehicle_name ? ' · ' . $project->vehicle_name : '' }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</main>

@if($featuredItems->count() > 1)
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const carousel = document.querySelector('[data-gallery-carousel]');
        if (!carousel) return;
        const slides = Array.from(carousel.querySelectorAll('[data-gallery-slide]'));
        const dots = Array.from(carousel.querySelectorAll('[data-gallery-dot]'));
        let activeIndex = 0;

        function showSlide(index) {
            activeIndex = (index + slides.length) % slides.length;
            slides.forEach((slide, slideIndex) => slide.classList.toggle('is-active', slideIndex === activeIndex));
            dots.forEach((dot, dotIndex) => {
                const active = dotIndex === activeIndex;
                dot.classList.toggle('is-active', active);
                dot.setAttribute('aria-pressed', active ? 'true' : 'false');
            });
        }

        carousel.querySelector('[data-gallery-prev]').addEventListener('click', () => showSlide(activeIndex - 1));
        carousel.querySelector('[data-gallery-next]').addEventListener('click', () => showSlide(activeIndex + 1));
        dots.forEach((dot) => dot.addEventListener('click', () => showSlide(Number(dot.dataset.galleryDot))));
    });
</script>
@endif
@endsection
