<style>
    .pricing-page {
        padding: 32px 0 120px;
    }

    .pricing-page__intro {
        max-width: 760px;
        margin: 0 auto 42px;
        text-align: center;
    }

    .pricing-page__intro p {
        max-width: 650px;
        margin: 18px auto 0;
        color: #666e85;
        font-size: 18px;
        line-height: 1.75;
    }

    .pricing-page__grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
        max-width: 900px;
        margin: 0 auto;
    }

    .pricing-page__card {
        padding: 32px;
        border: 1px solid #e5e5e5;
        border-top: 4px solid #d70006;
        background: #fff;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
    }

    .pricing-page__card-label {
        display: block;
        margin-bottom: 10px;
        color: #d70006;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }

    .pricing-page__card h2 {
        margin-bottom: 12px;
        font-size: 25px;
    }

    .pricing-page__card p,
    .pricing-page__card a {
        font-size: 17px;
        line-height: 1.7;
    }

    .pricing-page__card a {
        color: #d70006;
        font-weight: 600;
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    .pricing-page__note {
        max-width: 900px;
        margin: 24px auto 0;
        color: #666e85;
        font-size: 16px;
        line-height: 1.7;
        text-align: center;
    }

    @media (max-width: 767px) {
        .pricing-page {
            padding: 16px 0 80px;
        }

        .pricing-page__intro p {
            font-size: 17px;
        }

        .pricing-page__grid {
            grid-template-columns: 1fr;
        }

        .pricing-page__card {
            padding: 26px 22px;
        }
    }
</style>

<div class="container pricing-page">

    <div class="wptb-heading pricing-page__intro">
        <div class="wptb-item--inner text-center">
            <h6 class="wptb-item--subtitle">UNITED AUTO SERVICES</h6>
            <h1 class="wptb-item--title">Service Pricing</h1>
            <div class="wptb-item--divider"></div>
            <p>Tell us what your vehicle needs and we will help you understand the expected service cost before work begins.</p>
        </div>
    </div>

    <div class="pricing-page__grid">
        <div class="pricing-page__card">
            <span class="pricing-page__card-label">Email us</span>
            <h2>Request a written estimate</h2>
            <p>Share your vehicle details and the work you are considering so we can prepare an estimate.</p>
            <a href="mailto:unitedautojsr@gmmail.com">unitedautojsr@gmmail.com</a>
        </div>
        <div class="pricing-page__card">
            <span class="pricing-page__card-label">WhatsApp</span>
            <h2>Talk to the workshop</h2>
            <p>Send a quick message to discuss your requirement and receive pricing guidance.</p>
            <a href="https://wa.me/917992278199" target="_blank" rel="noopener">WhatsApp: 7992278199</a>
        </div>
    </div>
    <p class="pricing-page__note">Estimates may vary with the vehicle condition, parts, and final work required. We confirm the details with you before proceeding.</p>
</div>