{{-- FAQ Section - PASS A: Pixel-Perfect --}}
<section class="faq-section">
    <div class="container">
        <div class="faq-grid">
            <!-- Left Column - FAQ -->
            <div class="faq-content">
                <p class="eyebrow faq-eyebrow">FAQ</p>
                <h2 class="faq-title">Frequently Asked Questions</h2>

                <div class="faq-accordion" id="faqAccordion">
                    <!-- FAQ Item 1 - Open by default -->
                    <div class="faq-item open">
                        <button class="faq-header" type="button" aria-expanded="true">
                            <h4 class="faq-question">What services do you offer for car maintenance?</h4>
                            <span class="faq-icon" aria-hidden="true">▼</span>
                        </button>
                        <div class="faq-answer">
                            <p>We offer car dry cleaning, ceramic & Teflon coating, anti-rust treatment, paint protection film (PPF), interior detailing, and full body polishing. Our comprehensive services ensure your vehicle stays in peak condition.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="faq-item">
                        <button class="faq-header" type="button" aria-expanded="false">
                            <h4 class="faq-question">How long does ceramic coating last on my car?</h4>
                            <span class="faq-icon" aria-hidden="true">▼</span>
                        </button>
                        <div class="faq-answer">
                            <p>Premium ceramic coatings typically last 3-5 years depending on maintenance and environmental conditions. Proper care and regular washing will help extend the lifespan of the coating.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="faq-item">
                        <button class="faq-header" type="button" aria-expanded="false">
                            <h4 class="faq-question">Is paint protection film (PPF) worth it?</h4>
                            <span class="faq-icon" aria-hidden="true">▼</span>
                        </button>
                        <div class="faq-answer">
                            <p>Yes, PPF is excellent protection against rock chips, scratches, and environmental damage. It preserves your car's paint and resale value, making it a worthwhile investment for new or high-value vehicles.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div class="faq-item">
                        <button class="faq-header" type="button" aria-expanded="false">
                            <h4 class="faq-question">How often should I get my car dry cleaned?</h4>
                            <span class="faq-icon" aria-hidden="true">▼</span>
                        </button>
                        <div class="faq-answer">
                            <p>We recommend dry cleaning your car every 2-3 months, or more frequently if you drive in dusty or polluted areas. Regular dry cleaning maintains your vehicle's interior cleanliness and air quality.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Image -->
            <div class="faq-image"></div>
        </div>
    </div>
</section>

<style>
    .faq-section {
        background-color: var(--color-navy);
        padding: var(--space-5) 0;
        color: var(--color-white);
    }

    .faq-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.1fr) minmax(0, 0.9fr);
        gap: var(--space-5);
        align-items: stretch;
        min-width: 0;
    }

    .faq-content {
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .faq-eyebrow {
        color: var(--color-primary-red) !important;
        margin-bottom: var(--space-2);
    }

    .faq-eyebrow::before {
        background-color: var(--color-primary-red);
    }

    .faq-title {
        color: var(--color-white);
        font-size: clamp(1.75rem, 2vw + 1rem, 2.25rem);
        font-family: var(--font-heading);
        font-weight: var(--font-weight-bold);
        margin-bottom: var(--space-4);
        line-height: 1.2;
    }

    .faq-accordion {
        display: flex;
        flex-direction: column;
        gap: var(--space-2);
    }

    .faq-item {
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--radius-card);
        overflow: hidden;
        transition: all var(--transition-normal);
    }

    .faq-item:hover {
        background-color: rgba(255, 255, 255, 0.15);
        border-color: rgba(233, 28, 45, 0.3);
    }

    .faq-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding: var(--space-3);
        background-color: transparent;
        border: none;
        cursor: pointer;
        transition: background-color var(--transition-fast);
        text-align: left;
        gap: var(--space-2);
    }

    .faq-header:hover {
        background-color: rgba(233, 28, 45, 0.1);
    }

    .faq-header:focus {
        outline: 2px solid var(--color-primary-red);
        outline-offset: 2px;
    }

    .faq-question {
        color: var(--color-white);
        margin: 0;
        font-size: clamp(0.9375rem, 1vw + 0.35rem, 1rem);
        font-weight: var(--font-weight-medium);
        font-family: var(--font-body);
        line-height: 1.5;
        min-width: 0;
        word-break: break-word;
    }

    .faq-icon {
        color: var(--color-primary-red);
        font-size: 14px;
        flex-shrink: 0;
        margin-left: var(--space-2);
        transition: transform var(--transition-normal);
    }

    .faq-item.open .faq-icon {
        transform: rotate(180deg);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height var(--transition-normal), padding var(--transition-normal);
    }

    .faq-item.open .faq-answer {
        max-height: 500px;
        padding: 0 var(--space-3) var(--space-3);
    }

    .faq-answer p {
        color: rgba(255, 255, 255, 0.85);
        font-size: 14px;
        line-height: 1.7;
        margin: 0;
        word-break: break-word;
    }

    .faq-image {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: var(--radius-card);
        overflow: hidden;
        min-height: 500px;
        background-size: cover;
        background-position: center;
        min-width: 0;
    }

    @media (max-width: 1024px) {
        .faq-grid {
            grid-template-columns: 1fr;
            gap: var(--space-4);
        }

        .faq-image {
            min-height: 300px;
        }
    }

    @media (max-width: 768px) {
        .faq-section {
            padding: var(--space-4) 0;
        }

        .faq-title {
            font-size: clamp(1.5rem, 4vw, 2rem);
        }

        .faq-header {
            padding: var(--space-2) var(--space-3);
        }

        .faq-question {
            font-size: 0.95rem;
        }

        .faq-image {
            min-height: 250px;
        }
    }

    @media (max-width: 480px) {
        .faq-section {
            padding: var(--space-3) 0;
        }

        .faq-title {
            font-size: 1.5rem;
        }

        .faq-grid {
            gap: var(--space-3);
        }

        .faq-header {
            padding: var(--space-2);
        }

        .faq-question {
            font-size: 0.875rem;
        }

        .faq-image {
            min-height: 200px;
        }
    }
</style>
