@php
    use App\Models\Brand;
    $brands = Brand::allBrands();
@endphp

@if($brands->count())
<section class="section wptb-partners" aria-label="Our brand partners">

    <div class="wptb-partners-bg" aria-hidden="true">
        <span class="wptb-orb wptb-orb-1"></span>
        <span class="wptb-orb wptb-orb-2"></span>
    </div>

    <div class="container">
        <div class="wptb-heading" style="text-align: center; margin-bottom: var(--space-4);">
            <p class="eyebrow" style="justify-content: center;">Trusted By</p>
            <h2 style="margin-bottom: 0;">Our Brand Partners</h2>
        </div>
    </div>

    <div class="wptb-partners-viewport" id="wptbPartnersViewport">
        <div class="wptb-partners-track" id="wptbPartnersTrack">
            @foreach($brands as $brand)
                <div class="wptb-partner-card">
                    <img src="{{ asset($brand->image) }}" alt="{{ $brand->name }}" draggable="false" loading="lazy">
                </div>
            @endforeach
            {{-- Duplicate set so the strip can loop seamlessly --}}
            @foreach($brands as $brand)
                <div class="wptb-partner-card" aria-hidden="true">
                    <img src="{{ asset($brand->image) }}" alt="" draggable="false" loading="lazy">
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .wptb-partners {
        position: relative;
        overflow: hidden;
        background: linear-gradient(180deg, var(--color-off-white) 0%, var(--color-white) 100%);
    }

    .wptb-partners-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        overflow: hidden;
    }

    .wptb-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(70px);
        opacity: 0.22;
    }

    .wptb-orb-1 {
        width: 340px;
        height: 340px;
        background: var(--color-primary-red);
        top: -120px;
        left: -80px;
    }

    .wptb-orb-2 {
        width: 300px;
        height: 300px;
        background: var(--color-navy);
        bottom: -140px;
        right: -60px;
    }

    .wptb-partners .container {
        position: relative;
        z-index: 1;
    }

    .wptb-partners-viewport {
        position: relative;
        z-index: 1;
        overflow: hidden;
        cursor: grab;
        touch-action: pan-y;
        padding: var(--space-2) 0 var(--space-5);
        -webkit-mask-image: linear-gradient(90deg, transparent 0, #000 6%, #000 94%, transparent 100%);
        mask-image: linear-gradient(90deg, transparent 0, #000 6%, #000 94%, transparent 100%);
    }

    .wptb-partners-viewport.is-dragging {
        cursor: grabbing;
    }

    .wptb-partners-track {
        display: flex;
        align-items: center;
        width: max-content;
        will-change: transform;
    }

    .wptb-partner-card {
        flex: 0 0 auto;
        width: 168px;
        height: 104px;
        margin: 0 var(--space-2);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: var(--space-2);
        background: rgba(255, 255, 255, 0.55);
        border: 1px solid rgba(255, 255, 255, 0.65);
        border-radius: var(--radius-card);
        backdrop-filter: blur(12px) saturate(160%);
        -webkit-backdrop-filter: blur(12px) saturate(160%);
        box-shadow: var(--shadow-card);
        transition: transform var(--transition-normal), box-shadow var(--transition-normal), border-color var(--transition-normal);
    }

    .wptb-partner-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-hover);
        border-color: var(--color-primary-red);
    }

    .wptb-partner-card img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        filter: none;
        -webkit-user-drag: none;
        user-select: none;
        pointer-events: none;
    }

    @media (max-width: 576px) {
        .wptb-partner-card {
            width: 128px;
            height: 84px;
            margin: 0 var(--space-1);
        }
    }
</style>

<script>
    (function () {
        var viewport = document.getElementById('wptbPartnersViewport');
        var track = document.getElementById('wptbPartnersTrack');
        if (!viewport || !track) return;

        var halfWidth = 0;
        var posX = 0;
        var isDragging = false;
        var isHovering = false;
        var dragStartX = 0;
        var dragStartPos = 0;
        var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        var baseSpeed = reduceMotion ? 0 : 0.6; // px per frame

        function measure() {
            halfWidth = track.scrollWidth / 2;
        }

        function wrap(x) {
            if (halfWidth <= 0) return x;
            x = x % halfWidth;
            if (x > 0) x -= halfWidth;
            return x;
        }

        function apply() {
            track.style.transform = 'translateX(' + posX + 'px)';
        }

        function tick() {
            if (!isDragging && !isHovering && baseSpeed > 0) {
                posX = wrap(posX - baseSpeed);
                apply();
            }
            requestAnimationFrame(tick);
        }

        function pointerDown(e) {
            isDragging = true;
            viewport.classList.add('is-dragging');
            dragStartX = (e.touches ? e.touches[0].clientX : e.clientX);
            dragStartPos = posX;
            if (e.pointerId !== undefined && viewport.setPointerCapture) {
                try { viewport.setPointerCapture(e.pointerId); } catch (err) {}
            }
        }

        function pointerMove(e) {
            if (!isDragging) return;
            var clientX = (e.touches ? e.touches[0].clientX : e.clientX);
            var delta = clientX - dragStartX;
            posX = wrap(dragStartPos + delta);
            apply();
        }

        function pointerUp() {
            isDragging = false;
            viewport.classList.remove('is-dragging');
        }

        viewport.addEventListener('mouseenter', function () { isHovering = true; });
        viewport.addEventListener('mouseleave', function () { isHovering = false; });

        viewport.addEventListener('pointerdown', pointerDown);
        window.addEventListener('pointermove', pointerMove);
        window.addEventListener('pointerup', pointerUp);
        window.addEventListener('pointercancel', pointerUp);

        // Touch fallback for browsers without full Pointer Events support
        viewport.addEventListener('touchstart', pointerDown, { passive: true });
        viewport.addEventListener('touchmove', pointerMove, { passive: true });
        viewport.addEventListener('touchend', pointerUp);

        window.addEventListener('resize', measure);
        window.addEventListener('load', measure);

        measure();
        requestAnimationFrame(tick);
    })();
</script>
@endif