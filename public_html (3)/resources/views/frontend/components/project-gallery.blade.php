{{-- Project Gallery with Filters --}}
<section class="section" style="background-color: var(--color-off-white);">
    <div class="container">
        <div style="margin-bottom: var(--space-4); text-align: center;">
            <p class="eyebrow" style="justify-content: center;">OUR WORK</p>
            <h2>Project Gallery</h2>
            <p style="color: var(--color-text-muted);">Check out some of the amazing car services we provide at United Auto.</p>
        </div>

        <!-- Filter Buttons -->
        <div style="display: flex; gap: var(--space-2); justify-content: center; margin-bottom: var(--space-5); flex-wrap: wrap;">
            <button class="filter-btn active" onclick="filterGallery(event, 'all')">All</button>
            <button class="filter-btn" onclick="filterGallery(event, 'before')">Before</button>
            <button class="filter-btn" onclick="filterGallery(event, 'during')">During</button>
            <button class="filter-btn" onclick="filterGallery(event, 'after')">After</button>
        </div>

        <!-- Gallery Grid -->
        <div id="galleryGrid" class="grid grid-3">
            <!-- Gallery Item 1 -->
            <div class="gallery-item" data-category="before">
                <div style="height: 250px; background: linear-gradient(135deg, #9e9e9e 0%, #757575 100%); border-radius: var(--radius-card); overflow: hidden; cursor: pointer; position: relative;">
                    <div style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.3);">
                        <span style="font-size: 48px; color: white;">🚗</span>
                    </div>
                </div>
                <h4 style="color: var(--color-navy); margin-top: var(--space-2); font-size: 16px;">Before Detailing</h4>
            </div>

            <!-- Gallery Item 2 -->
            <div class="gallery-item" data-category="during">
                <div style="height: 250px; background: linear-gradient(135deg, #ffb347 0%, #ffa500 100%); border-radius: var(--radius-card); overflow: hidden; cursor: pointer; position: relative;">
                    <div style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.3);">
                        <span style="font-size: 48px; color: white;">🔧</span>
                    </div>
                </div>
                <h4 style="color: var(--color-navy); margin-top: var(--space-2); font-size: 16px;">During Service</h4>
            </div>

            <!-- Gallery Item 3 -->
            <div class="gallery-item" data-category="after">
                <div style="height: 250px; background: linear-gradient(135deg, #e91c2d 0%, #dd3443 100%); border-radius: var(--radius-card); overflow: hidden; cursor: pointer; position: relative;">
                    <div style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.3);">
                        <span style="font-size: 48px; color: white;">✨</span>
                    </div>
                </div>
                <h4 style="color: var(--color-navy); margin-top: var(--space-2); font-size: 16px;">After Transformation</h4>
            </div>

            <!-- Gallery Item 4 -->
            <div class="gallery-item" data-category="before">
                <div style="height: 250px; background: linear-gradient(135deg, #bdbdbd 0%, #9e9e9e 100%); border-radius: var(--radius-card); overflow: hidden; cursor: pointer; position: relative;">
                    <div style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.3);">
                        <span style="font-size: 48px; color: white;">📷</span>
                    </div>
                </div>
                <h4 style="color: var(--color-navy); margin-top: var(--space-2); font-size: 16px;">Vehicle Condition</h4>
            </div>

            <!-- Gallery Item 5 -->
            <div class="gallery-item" data-category="during">
                <div style="height: 250px; background: linear-gradient(135deg, #ffb347 0%, #ffa500 100%); border-radius: var(--radius-card); overflow: hidden; cursor: pointer; position: relative;">
                    <div style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.3);">
                        <span style="font-size: 48px; color: white;">🛠️</span>
                    </div>
                </div>
                <h4 style="color: var(--color-navy); margin-top: var(--space-2); font-size: 16px;">Work in Progress</h4>
            </div>

            <!-- Gallery Item 6 -->
            <div class="gallery-item" data-category="after">
                <div style="height: 250px; background: linear-gradient(135deg, #e91c2d 0%, #dd3443 100%); border-radius: var(--radius-card); overflow: hidden; cursor: pointer; position: relative;">
                    <div style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.3);">
                        <span style="font-size: 48px; color: white;">🎉</span>
                    </div>
                </div>
                <h4 style="color: var(--color-navy); margin-top: var(--space-2); font-size: 16px;">Final Result</h4>
            </div>
        </div>
    </div>
</section>

<style>
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
        border-color: var(--color-primary-red);
        color: var(--color-primary-red);
    }

    .filter-btn.active {
        background: var(--color-primary-red);
        color: var(--color-white);
        border-color: var(--color-primary-red);
    }

    .gallery-item {
        animation: fadeIn var(--transition-normal);
    }

    .gallery-item.hidden {
        display: none;
    }

    @media (max-width: 768px) {
        .grid.grid-3 {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .grid.grid-3 {
            grid-template-columns: 1fr;
        }

        .filter-btn {
            padding: 6px 16px;
            font-size: 12px;
        }
    }
</style>

<script>
function filterGallery(event, category) {
    const buttons = event.currentTarget.parentElement.querySelectorAll('.filter-btn');
    buttons.forEach(btn => btn.classList.remove('active'));
    event.currentTarget.classList.add('active');

    const items = document.querySelectorAll('.gallery-item');
    items.forEach(item => {
        if (category === 'all' || item.dataset.category === category) {
            item.classList.remove('hidden');
        } else {
            item.classList.add('hidden');
        }
    });
}
</script>
