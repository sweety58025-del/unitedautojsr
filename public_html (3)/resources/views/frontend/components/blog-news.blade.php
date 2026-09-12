{{-- Blog & News Section --}}
<section class="section">
    <div class="container">
        <div style="margin-bottom: var(--space-5); text-align: center;">
            <p class="eyebrow" style="justify-content: center;">OUR BLOG</p>
            <h2 style="color: var(--color-white); font-weight: var(--font-weight-bold); letter-spacing: -0.02em;">Latest Blog & News</h2>
            <p style="max-width: 560px; margin: 0 auto; color: var(--color-text-muted);">Stay updated with the latest automotive tips and news from United Auto.</p>
        </div>

        <div class="grid grid-3">
            <!-- Blog Card 1 -->
            <div class="card card-glass" onclick="location.href='/blog-details';" style="cursor: pointer;">
                <div class="blog-card-media">
                    <img src="{{ asset('images/blog/1.webp') }}" alt="Top 5 Car Maintenance Tips for Summer" loading="lazy">
                </div>
                <div class="card-body">
                    <div style="display: flex; align-items: center; gap: var(--space-1); margin-bottom: var(--space-2); font-size: 12px; color: var(--color-text-muted);">
                        <span>👤 Admin</span>
                        <span>•</span>
                        <span>📅 24th August 2026</span>
                    </div>
                    <h3 style="font-size: 19px; font-weight: var(--font-weight-bold); letter-spacing: -0.01em; margin-top: var(--space-1); margin-bottom: var(--space-2);">Top 5 Car Maintenance Tips for Summer</h3>
                    <p style="font-size: 14px; line-height: 1.6;">Keep your vehicle running smoothly during hot summer months with our expert maintenance tips and advice...</p>
                    <a href="/blog-details" style="color: var(--color-primary-red); font-weight: var(--font-weight-bold); font-size: 14px;">Read More →</a>
                </div>
            </div>

            <!-- Blog Card 2 -->
            <div class="card card-glass" onclick="location.href='/blog-details';" style="cursor: pointer;">
                <div class="blog-card-media">
                    <img src="{{ asset('images/blog/2.webp') }}" alt="Understanding Paint Protection Film" loading="lazy">
                </div>
                <div class="card-body">
                    <div style="display: flex; align-items: center; gap: var(--space-1); margin-bottom: var(--space-2); font-size: 12px; color: var(--color-text-muted);">
                        <span>👤 Admin</span>
                        <span>•</span>
                        <span>📅 20th August 2026</span>
                    </div>
                    <h3 style="font-size: 19px; font-weight: var(--font-weight-bold); letter-spacing: -0.01em; margin-top: var(--space-1); margin-bottom: var(--space-2);">Understanding Paint Protection Film (PPF)</h3>
                    <p style="font-size: 14px; line-height: 1.6;">Learn why PPF is essential for preserving your car's paint and protecting against scratches and damage...</p>
                    <a href="/blog-details" style="color: var(--color-primary-red); font-weight: var(--font-weight-bold); font-size: 14px;">Read More →</a>
                </div>
            </div>

            <!-- Blog Card 3 -->
            <div class="card card-glass" onclick="location.href='/blog-details';" style="cursor: pointer;">
                <div class="blog-card-media">
                    <img src="{{ asset('images/blog/3.webp') }}" alt="Ceramic Coating Investment Guide" loading="lazy">
                </div>
                <div class="card-body">
                    <div style="display: flex; align-items: center; gap: var(--space-1); margin-bottom: var(--space-2); font-size: 12px; color: var(--color-text-muted);">
                        <span>👤 Admin</span>
                        <span>•</span>
                        <span>📅 18th August 2026</span>
                    </div>
                    <h3 style="font-size: 19px; font-weight: var(--font-weight-bold); letter-spacing: -0.01em; margin-top: var(--space-1); margin-bottom: var(--space-2);">Ceramic Coating: Is It Worth the Investment?</h3>
                    <p style="font-size: 14px; line-height: 1.6;">Explore the benefits of ceramic coating and how it provides long-lasting protection for your vehicle's paint...</p>
                    <a href="/blog-details" style="color: var(--color-primary-red); font-weight: var(--font-weight-bold); font-size: 14px;">Read More →</a>
                </div>
            </div>
        </div>

        <div style="text-align: center; margin-top: var(--space-5);">
            <button class="btn btn-primary">View All Articles →</button>
        </div>
    </div>
</section>
