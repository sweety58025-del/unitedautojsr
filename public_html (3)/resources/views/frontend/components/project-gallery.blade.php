@php
    $repairProjects = $repairProjects ?? collect();
@endphp

<section class="section work-section" id="our-work">
    <div class="container">

        <div class="work-header">
            <div class="work-header-main">
                <h2>Every panel here has been in our bay.</h2>
            </div>
            <div class="work-header-side">
                <p>No stock photography, no filters &mdash; drag any photo below to see the repair United Auto actually carried out.</p>
            </div>
        </div>

        <div class="work-tabs gallery-filter-container" role="toolbar" aria-label="Our work filters" aria-controls="galleryGrid">
            <button class="filter-btn active" type="button" data-filter="all" aria-pressed="true">All work</button>
            @if($repairProjects->isNotEmpty())
                <button class="filter-btn" type="button" data-filter="transformation" aria-pressed="false">Before &amp; after</button>
            @endif
            @if($repairProjects->contains(fn ($project) => $project->images->where('stage', 'during')->isNotEmpty()))
                <button class="filter-btn" type="button" data-filter="process" aria-pressed="false">In the workshop</button>
            @endif
            <span class="work-tabs-indicator" aria-hidden="true"></span>
        </div>

        <div id="galleryGrid" class="work-grid" aria-live="polite">

            {{-- Before / After interactive compare cards --}}
            @forelse($repairProjects as $index => $project)
                @php
                    $before = $project->images->where('stage', 'before')->values();
                    $during = $project->images->where('stage', 'during')->values();
                    $after = $project->images->where('stage', 'after')->values();
                    $beforeImage = $before->first();
                    $afterImage = $after->first();
                @endphp
                <article class="gallery-item compare-card {{ $index === 0 ? 'featured' : '' }}" data-category="transformation">
                    <h3 class="compare-caption">{{ $project->title }}</h3>
                    @if($beforeImage && $afterImage)
                    <div class="compare-frame">
                        <img class="compare-img" src="{{ asset($beforeImage->image) }}" alt="{{ $beforeImage->caption ?: $project->title . ' before repair' }}" loading="lazy">
                        <div class="compare-after-wrap">
                            <img class="compare-img" src="{{ asset($afterImage->image) }}" alt="{{ $afterImage->caption ?: $project->title . ' after repair' }}" loading="lazy">
                        </div>
                        <div class="compare-divider"></div>
                        <input type="range" class="compare-range" min="0" max="100" value="50" aria-label="Drag to reveal the before and after photo for {{ $project->title }}">
                        <span class="compare-tag compare-tag-before">Before</span>
                        <span class="compare-tag compare-tag-after">After</span>
                        <span class="frame-tick frame-tick-tl" aria-hidden="true"></span>
                        <span class="frame-tick frame-tick-tr" aria-hidden="true"></span>
                        <span class="frame-tick frame-tick-bl" aria-hidden="true"></span>
                        <span class="frame-tick frame-tick-br" aria-hidden="true"></span>
                        <a class="compare-expand" href="{{ asset($afterImage->image) }}" data-fancybox="united-auto-gallery" data-caption="{{ $afterImage->caption ?: $project->title }}" aria-label="View full-size photo">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M9 3H3V9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M15 3H21V9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 21H3V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M15 21H21V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </div>
                    @else
                        <div class="process-caption">Project images are being prepared.</div>
                    @endif
                    @if($during->isNotEmpty())
                        <div class="project-progress-gallery">
                            @foreach($during as $image)
                                <a class="process-frame" href="{{ asset($image->image) }}" data-fancybox="project-{{ $project->id }}" data-caption="{{ $image->caption ?: $project->title . ' during repair' }}">
                                    <img src="{{ asset($image->image) }}" alt="{{ $image->caption ?: $project->title . ' during repair' }}" loading="lazy">
                                </a>
                            @endforeach
                        </div>
                    @endif
                    @if($project->vehicle_name || $project->description)
                        <p class="process-caption">{{ trim($project->vehicle_name . ($project->description ? ' - ' . $project->description : '')) }}</p>
                    @endif
                </article>
            @empty
                <div class="col-12">
                    <p class="process-caption">Repair projects will appear here as soon as project images are added.</p>
                </div>
            @endforelse

        </div>
    </div>
</section>

<style>
    .work-section {
        --work-ink: var(--color-navy);
        --work-red: var(--color-primary-red);
        --work-paper: var(--color-off-white);
        --work-steel: var(--color-border);
        --work-steel-dark: var(--color-text-muted);
        --work-muted: var(--color-text-muted);

        background: var(--work-paper);
        padding: 5.5rem 0;
        opacity: 1;
    }

    /* Header — asymmetric, not centered eyebrow/heading/subtext */
    .work-header {
        display: grid;
        grid-template-columns: 1.4fr 1fr;
        gap: 2.5rem;
        align-items: end;
        margin-bottom: 2.75rem;
        padding-bottom: 2.25rem;
        border-bottom: 1px solid var(--work-steel);
    }

    .work-header h2 {
        margin: 0;
        color: var(--work-ink);
        font-family: var(--font-family-heading);
        font-weight: var(--font-weight-semibold, 600);
        font-size: clamp(2rem, 4vw, 2.9rem);
        line-height: 1.12;
        letter-spacing: -0.01em;
    }

    .work-header-side p {
        margin: 0;
        color: var(--work-muted);
        font-size: 0.98rem;
        line-height: 1.6;
        max-width: 34ch;
    }

    /* Sliding-tab filter bar — replaces generic pill buttons */
    .work-tabs {
        position: relative;
        display: flex;
        gap: 1.75rem;
        margin-bottom: 3rem;
        border-bottom: 1px solid var(--work-steel);
    }

    .work-tabs .filter-btn {
        position: relative;
        padding: 0 0 0.85rem;
        border: none;
        background: none;
        color: var(--work-muted);
        font-family: var(--font-family-base);
        font-weight: var(--font-weight-medium, 500);
        font-size: 0.94rem;
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .work-tabs .filter-btn:hover {
        color: var(--work-ink);
    }

    .work-tabs .filter-btn.active {
        color: var(--work-red);
    }

    .work-tabs .filter-btn:focus-visible {
        outline: 2px solid var(--work-red);
        outline-offset: 3px;
    }

    .work-tabs-indicator {
        position: absolute;
        bottom: -1px;
        height: 2px;
        background: var(--work-red);
        transition: left 0.25s ease, width 0.25s ease;
    }

    /* Bento grid: mixed spans, not one repeated card size */
    .work-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 1.5rem;
    }

    .gallery-item[hidden] {
        display: none;
    }

    .compare-card { grid-column: span 6; }
    .compare-card.featured { grid-column: span 12; }
    .process-card { grid-column: span 4; }
    .achievement-card { grid-column: span 6; }

    /* Before/After compare card — squared frame with corner ticks,
       instead of a rounded card + soft grey shadow. */
    .compare-frame {
        position: relative;
        width: 100%;
        aspect-ratio: 16 / 10;
        overflow: hidden;
        background: var(--work-ink);
        user-select: none;
        border-radius: 6px;
    }

    .compare-card.featured .compare-frame {
        aspect-ratio: 21 / 9;
    }

    .compare-img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        pointer-events: none;
    }

    .compare-after-wrap {
        position: absolute;
        inset: 0;
        width: 50%;
        overflow: hidden;
    }

    .compare-after-wrap .compare-img {
        width: var(--frame-width, 100%);
        max-width: none;
    }

    .compare-divider {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50%;
        width: 2px;
        background: var(--color-white);
        transform: translateX(-1px);
        pointer-events: none;
    }

    .compare-divider::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: var(--color-white);
        transform: translate(-50%, -50%);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .compare-divider::before {
        content: '\2194';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: var(--work-red);
        font-size: 15px;
        z-index: 1;
        line-height: 1;
    }

    .compare-range {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        margin: 0;
        opacity: 0;
        cursor: ew-resize;
        appearance: none;
        -webkit-appearance: none;
    }

    .compare-range::-webkit-slider-thumb {
        appearance: none;
        -webkit-appearance: none;
        width: 100%;
        height: 100%;
    }

    .compare-tag {
        position: absolute;
        top: 14px;
        z-index: 2;
        padding: 3px 10px;
        font-size: 0.72rem;
        font-weight: var(--font-weight-medium, 500);
        color: var(--color-white);
        pointer-events: none;
        background: rgba(17, 14, 16, 0.55);
        backdrop-filter: blur(3px);
    }

    .compare-tag-before { left: 14px; }
    .compare-tag-after { right: 14px; background: var(--work-red); }

    /* Corner ticks — a diagnostic-scan frame, grounded in a mechanic's
       inspection/viewfinder marks rather than decorative rounding. */
    .frame-tick {
        position: absolute;
        width: 16px;
        height: 16px;
        z-index: 2;
        pointer-events: none;
        opacity: 0.85;
    }

    .frame-tick-tl { top: 8px; left: 8px; border-top: 2px solid var(--work-red); border-left: 2px solid var(--work-red); }
    .frame-tick-tr { top: 8px; right: 8px; border-top: 2px solid var(--work-red); border-right: 2px solid var(--work-red); }
    .frame-tick-bl { bottom: 8px; left: 8px; border-bottom: 2px solid var(--work-red); border-left: 2px solid var(--work-red); }
    .frame-tick-br { bottom: 8px; right: 8px; border-bottom: 2px solid var(--work-red); border-right: 2px solid var(--work-red); }

    .compare-expand {
        position: absolute;
        bottom: 14px;
        right: 14px;
        z-index: 2;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.92);
        color: var(--work-ink);
        transition: background 0.2s ease, color 0.2s ease;
    }

    .compare-expand:hover {
        background: var(--color-white);
        color: var(--work-red);
    }

    .compare-caption {
        margin: 0.85rem 0 0;
        color: var(--work-ink);
        font-size: 0.95rem;
        font-weight: var(--font-weight-medium, 500);
    }

    /* Workshop filmstrip cards — quiet, small, no badges */
    .process-frame {
        display: block;
        aspect-ratio: 4 / 3;
        overflow: hidden;
        border: 1px solid var(--work-steel);
        background: var(--color-white);
    }

    .process-frame img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }

    .process-card:hover .process-frame img {
        transform: scale(1.04);
    }

    .process-caption {
        margin: 0.75rem 0 0;
        color: var(--work-muted);
        font-size: 0.86rem;
    }

    /* Achievement / community cards — "ticket stub" layout */
    .achievement-card {
        display: flex;
        background: var(--color-white);
        border: 1px solid var(--work-steel);
        min-height: 180px;
    }

    .achievement-photo {
        display: block;
        width: 42%;
        flex-shrink: 0;
        overflow: hidden;
    }

    .achievement-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .achievement-stub {
        width: 0;
        border-left: 2px dashed var(--work-steel-dark);
        margin: 14px 0;
    }

    .achievement-body {
        padding: 1.25rem 1.4rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .achievement-eyebrow {
        margin: 0 0 0.35rem;
        color: var(--work-red);
        font-size: 0.78rem;
        font-weight: var(--font-weight-medium, 500);
    }

    .achievement-body h4 {
        margin: 0;
        color: var(--work-ink);
        font-size: 1.05rem;
        font-weight: var(--font-weight-semibold, 600);
        line-height: 1.35;
    }

    /* One orchestrated reveal for the whole section, not per-card fades */
    .work-section.is-visible .work-header,
    .work-section.is-visible .work-tabs,
    .work-section.is-visible .work-grid {
        animation: work-rise 0.6s ease both;
    }

    .work-section.is-visible .work-tabs { animation-delay: 0.08s; }
    .work-section.is-visible .work-grid { animation-delay: 0.14s; }

    @keyframes work-rise {
        from { opacity: 0; transform: translateY(14px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 991px) {
        .work-header {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .work-header-side p {
            max-width: none;
        }

        .compare-card, .compare-card.featured { grid-column: span 12; }
        .process-card { grid-column: span 6; }
        .achievement-card { grid-column: span 12; }
    }

    @media (max-width: 576px) {
        .work-grid { gap: 1.1rem; }
        .process-card { grid-column: span 12; }
        .achievement-card { flex-direction: column; }
        .achievement-photo { width: 100%; height: 200px; }
        .achievement-stub { display: none; }
        .work-tabs { gap: 1.1rem; overflow-x: auto; }
    }

    @media (prefers-reduced-motion: reduce) {
        .work-tabs-indicator,
        .process-frame img,
        .work-section.is-visible .work-header,
        .work-section.is-visible .work-tabs,
        .work-section.is-visible .work-grid {
            animation: none;
            transition: none;
        }
    }
</style>

<script>
    (function () {
        function initCompareCards(root) {
            root.querySelectorAll('.compare-card').forEach(function (card) {
                var range = card.querySelector('.compare-range');
                var afterWrap = card.querySelector('.compare-after-wrap');
                var divider = card.querySelector('.compare-divider');
                var frame = card.querySelector('.compare-frame');
                if (!range || !afterWrap || !divider || !frame) return;

                function update(value) {
                    afterWrap.style.width = value + '%';
                    divider.style.left = value + '%';
                    afterWrap.style.setProperty('--frame-width', frame.offsetWidth + 'px');
                }

                update(range.value);
                range.addEventListener('input', function () { update(this.value); });
                window.addEventListener('resize', function () { update(range.value); });

                card.__updateCompare = update;
            });
        }

        function nudgeHero(root) {
            var hero = root.querySelector('.compare-card.featured .compare-range');
            if (!hero) return;
            var steps = [50, 38, 62, 50];
            var i = 0;
            var timer = setInterval(function () {
                hero.value = steps[i];
                hero.dispatchEvent(new Event('input'));
                i++;
                if (i >= steps.length) clearInterval(timer);
            }, 260);
        }

        function initTabIndicator(root) {
            var bar = root.querySelector('.work-tabs');
            var indicator = root.querySelector('.work-tabs-indicator');
            if (!bar || !indicator) return;

            function place(btn) {
                if (!btn) return;
                indicator.style.left = btn.offsetLeft + 'px';
                indicator.style.width = btn.offsetWidth + 'px';
            }

            place(bar.querySelector('.filter-btn.active'));
            bar.querySelectorAll('.filter-btn').forEach(function (btn) {
                btn.addEventListener('click', function () { place(btn); });
            });
            window.addEventListener('resize', function () {
                place(bar.querySelector('.filter-btn.active'));
            });
        }

        function initReveal(section) {
            if (!('IntersectionObserver' in window)) {
                section.classList.add('is-visible');
                return;
            }
            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        section.classList.add('is-visible');
                        observer.disconnect();
                    }
                });
            }, { threshold: 0.2 });
            observer.observe(section);
        }

        function init() {
            var section = document.getElementById('our-work');
            if (!section) return;
            initCompareCards(section);
            initTabIndicator(section);
            initReveal(section);
            setTimeout(function () { nudgeHero(section); }, 500);
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
    })();
</script>
