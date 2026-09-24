@php
    $homeContent = $homeContent ?? \App\Models\PageContent::forPage('home');
    $showcaseItems = collect($homeContent->showcase_items)->map(fn (array $item) => [
        'image' => $item[0] ?? '',
        'title' => $item[1] ?? '',
        'description' => $item[2] ?? '',
    ])->filter(fn (array $item) => $item['image'] !== '' && $item['title'] !== '')->values();
@endphp

@if(count($showcaseItems))
<section class="showcase-highlights" aria-labelledby="showcase-highlights-title">
    <div class="container">
        <div class="showcase-heading">
            <div>
                <span class="showcase-kicker"><i class="bi bi-stars" aria-hidden="true"></i> United Auto stories</span>
                <h2 id="showcase-highlights-title">Work that stays with you.</h2>
            </div>
            <p>Selected moments from our workshop, community work, and automotive journey.</p>
        </div>

        <div class="showcase-grid">
            @foreach($showcaseItems as $item)
                <article class="showcase-card">
                    <div class="showcase-card__media">
                        <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" loading="lazy">
                        <span class="showcase-card__number">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="showcase-card__type">United Auto</span>
                    </div>
                    <div class="showcase-card__body">
                        <span class="showcase-card__eyebrow">Featured story</span>
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['description'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
    .showcase-highlights { padding: 88px 0; background: #0c0e10; color: #fff; }
    .showcase-heading { display: flex; align-items: end; justify-content: space-between; gap: 32px; margin-bottom: 30px; }
    .showcase-heading h2 { max-width: 560px; margin: 8px 0 0; color: #fff; font-size: clamp(2rem, 4vw, 3.2rem); line-height: 1.05; }
    .showcase-heading p { max-width: 310px; margin: 0; color: rgba(255,255,255,.62); line-height: 1.6; }
    .showcase-kicker, .showcase-card__eyebrow { color: var(--color-primary-red); font-size: 11px; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; }
    .showcase-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 16px; }
    .showcase-card { overflow: hidden; border: 1px solid rgba(255,255,255,.12); border-radius: 8px; background: linear-gradient(145deg, #1a1d20, #0a0b0d); box-shadow: 0 14px 30px rgba(0,0,0,.2); transition: transform .28s ease, border-color .28s ease; }
    .showcase-card:hover { border-color: rgba(215,0,6,.7); transform: translateY(-6px); }
    .showcase-card__media { position: relative; aspect-ratio: 4 / 3; overflow: hidden; background: #17191b; }
    .showcase-card__media::after { position: absolute; inset: 0; content: ''; background: linear-gradient(to top, rgba(0,0,0,.56), transparent 52%); pointer-events: none; }
    .showcase-card__media img { display: block; width: 100%; height: 100%; object-fit: cover; transition: transform .45s ease; }
    .showcase-card:hover .showcase-card__media img { transform: scale(1.05); }
    .showcase-card__number, .showcase-card__type { position: absolute; z-index: 1; top: 12px; padding: 4px 7px; border-radius: 3px; font-size: 10px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; }
    .showcase-card__number { left: 12px; color: #fff; background: rgba(0,0,0,.5); }
    .showcase-card__type { right: 12px; color: #fff; background: var(--color-primary-red); }
    .showcase-card__body { padding: 18px 16px 20px; }
    .showcase-card__body h3 { margin: 7px 0 8px; color: #fff; font-size: 18px; line-height: 1.25; }
    .showcase-card__body p { margin: 0; color: rgba(255,255,255,.62); font-size: 13px; line-height: 1.55; }
    @media (max-width: 991px) { .showcase-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
    @media (max-width: 576px) { .showcase-highlights { padding: 64px 0; } .showcase-heading { display: block; } .showcase-heading p { margin-top: 16px; } .showcase-grid { grid-template-columns: 1fr; } }
</style>