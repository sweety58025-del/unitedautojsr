{{-- FAQ Section --}}
<section class="faq-section">
    <div class="container">
        <div class="faq-grid">
            <div class="faq-content">
                <p class="eyebrow faq-eyebrow">FAQ</p>
                <h2 class="faq-title">Frequently Asked Questions</h2>

                <div class="faq-accordion" id="faqAccordion">
                    @foreach ($faqItems as $faqItem)
                    <div class="faq-item{{ $loop->first ? ' open' : '' }}">
                        <button class="faq-header" type="button" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="faq-panel-{{ $loop->iteration }}">
                            <h4 class="faq-question">{{ $faqItem['question'] }}</h4>
                            <span class="faq-icon" aria-hidden="true">{{ $loop->first ? '−' : '+' }}</span>
                        </button>
                        <div id="faq-panel-{{ $loop->iteration }}" class="faq-answer" role="region"{{ $loop->first ? '' : ' hidden' }}>
                            <p>{{ $faqItem['answer'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="faq-image">
                <img src="{{ asset('images/services/MechanicalRepairs.jpg') }}" alt="United Auto service bay" loading="lazy">
            </div>
        </div>
    </div>
</section>
