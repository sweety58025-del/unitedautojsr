{{-- Transformation Highlights Section --}}
<section class="section" style="background-color: var(--color-off-white);">
    <div class="container">
        <div style="margin-bottom: var(--space-5);">
            <p class="eyebrow">Success Stories</p>
            <h2>Transformation Highlights</h2>
            <p style="font-size: 16px; color: var(--color-text-muted);">Full Body Paint at Paint Booth</p>
        </div>

        <!-- Story Cards -->
        <div class="grid grid-4" style="margin-bottom: var(--space-5);">
            <div class="card">
                <div style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white;">
                    <span style="font-size: 48px;">🚗</span>
                </div>
                <div class="card-body">
                    <h4 style="color: var(--color-navy); margin-bottom: var(--space-1);">Heritage Car Renovation</h4>
                    <p style="font-size: 14px; margin: 0;">Tata Steel vintage car restored to glory</p>
                </div>
            </div>

            <div class="card">
                <div style="height: 200px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); display: flex; align-items: center; justify-content: center; color: white;">
                    <span style="font-size: 48px;">🪑</span>
                </div>
                <div class="card-body">
                    <h4 style="color: var(--color-navy); margin-bottom: var(--space-1);">Interior Restoration</h4>
                    <p style="font-size: 14px; margin: 0;">All wooden interior expertly repaired</p>
                </div>
            </div>

            <div class="card">
                <div style="height: 200px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); display: flex; align-items: center; justify-content: center; color: white;">
                    <span style="font-size: 48px;">🏆</span>
                </div>
                <div class="card-body">
                    <h4 style="color: var(--color-navy); margin-bottom: var(--space-1);">Award Ceremony</h4>
                    <p style="font-size: 14px; margin: 0;">Vintage & Classic Car Rally winner</p>
                </div>
            </div>

            <div class="card">
                <div style="height: 200px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); display: flex; align-items: center; justify-content: center; color: white;">
                    <span style="font-size: 48px;">⭐</span>
                </div>
                <div class="card-body">
                    <h4 style="color: var(--color-navy); margin-bottom: var(--space-1);">Achievement</h4>
                    <p style="font-size: 14px; margin: 0;">Vendor of Jusco – Great recognition</p>
                </div>
            </div>
        </div>

        <!-- Tabs for Before/During/After -->
        <div style="background: var(--color-white); padding: var(--space-4); border-radius: var(--radius-card); box-shadow: var(--shadow-card);">
            <div class="tabs">
                <button class="tab-button active" onclick="showTab(event, 'before')">Before</button>
                <button class="tab-button" onclick="showTab(event, 'during')">During</button>
                <button class="tab-button" onclick="showTab(event, 'after')">After</button>
            </div>

            <!-- Before Tab Content -->
            <div id="before" class="tab-content active">
                <div class="grid grid-4" style="margin-bottom: var(--space-3);">
                    <div style="height: 200px; background: linear-gradient(135deg, #bdbdbd 0%, #9e9e9e 100%); border-radius: var(--radius-card); display: flex; align-items: center; justify-content: center; color: white;">
                        <span style="font-size: 36px;">📷</span>
                    </div>
                    <div style="height: 200px; background: linear-gradient(135deg, #bdbdbd 0%, #9e9e9e 100%); border-radius: var(--radius-card); display: flex; align-items: center; justify-content: center; color: white;">
                        <span style="font-size: 36px;">📷</span>
                    </div>
                    <div style="height: 200px; background: linear-gradient(135deg, #bdbdbd 0%, #9e9e9e 100%); border-radius: var(--radius-card); display: flex; align-items: center; justify-content: center; color: white;">
                        <span style="font-size: 36px;">📷</span>
                    </div>
                    <div style="height: 200px; background: linear-gradient(135deg, #bdbdbd 0%, #9e9e9e 100%); border-radius: var(--radius-card); display: flex; align-items: center; justify-content: center; color: white;">
                        <span style="font-size: 36px;">📷</span>
                    </div>
                </div>
                <p style="color: var(--color-text-muted); font-style: italic;">Before: The vehicle had faded, scratched, and patchy paint. Interior was worn and dusty.</p>
            </div>

            <!-- During Tab Content -->
            <div id="during" class="tab-content">
                <div class="grid grid-4" style="margin-bottom: var(--space-3);">
                    <div style="height: 200px; background: linear-gradient(135deg, #ffb347 0%, #ffa500 100%); border-radius: var(--radius-card); display: flex; align-items: center; justify-content: center; color: white;">
                        <span style="font-size: 36px;">🔧</span>
                    </div>
                    <div style="height: 200px; background: linear-gradient(135deg, #ffb347 0%, #ffa500 100%); border-radius: var(--radius-card); display: flex; align-items: center; justify-content: center; color: white;">
                        <span style="font-size: 36px;">🔧</span>
                    </div>
                    <div style="height: 200px; background: linear-gradient(135deg, #ffb347 0%, #ffa500 100%); border-radius: var(--radius-card); display: flex; align-items: center; justify-content: center; color: white;">
                        <span style="font-size: 36px;">🔧</span>
                    </div>
                    <div style="height: 200px; background: linear-gradient(135deg, #ffb347 0%, #ffa500 100%); border-radius: var(--radius-card); display: flex; align-items: center; justify-content: center; color: white;">
                        <span style="font-size: 36px;">🔧</span>
                    </div>
                </div>
                <p style="color: var(--color-text-muted); font-style: italic;">During: Expert paint booth work, interior restoration, and detailing in progress. Professional craftsmanship at every step.</p>
            </div>

            <!-- After Tab Content -->
            <div id="after" class="tab-content">
                <div class="grid grid-4" style="margin-bottom: var(--space-3);">
                    <div style="height: 200px; background: linear-gradient(135deg, #e91c2d 0%, #dd3443 100%); border-radius: var(--radius-card); display: flex; align-items: center; justify-content: center; color: white;">
                        <span style="font-size: 36px;">✨</span>
                    </div>
                    <div style="height: 200px; background: linear-gradient(135deg, #e91c2d 0%, #dd3443 100%); border-radius: var(--radius-card); display: flex; align-items: center; justify-content: center; color: white;">
                        <span style="font-size: 36px;">✨</span>
                    </div>
                    <div style="height: 200px; background: linear-gradient(135deg, #e91c2d 0%, #dd3443 100%); border-radius: var(--radius-card); display: flex; align-items: center; justify-content: center; color: white;">
                        <span style="font-size: 36px;">✨</span>
                    </div>
                    <div style="height: 200px; background: linear-gradient(135deg, #e91c2d 0%, #dd3443 100%); border-radius: var(--radius-card); display: flex; align-items: center; justify-content: center; color: white;">
                        <span style="font-size: 36px;">✨</span>
                    </div>
                </div>
                <p style="color: var(--color-text-muted); font-style: italic;">After: Stunning transformation complete! Flawless paint finish, pristine interior, and showroom-ready perfection achieved.</p>
            </div>
        </div>
    </div>
</section>

<script>
function showTab(event, tabName) {
    // Hide all tabs
    const contents = document.querySelectorAll('.tab-content');
    contents.forEach(content => {
        content.classList.remove('active');
    });

    // Remove active class from all buttons
    const buttons = event.currentTarget.parentElement.querySelectorAll('.tab-button');
    buttons.forEach(btn => {
        btn.classList.remove('active');
    });

    // Show the selected tab
    document.getElementById(tabName).classList.add('active');
    event.currentTarget.classList.add('active');
}
</script>
