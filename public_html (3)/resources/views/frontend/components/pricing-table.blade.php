{{-- Pricing Table Section - PASS A: Pixel-Perfect --}}
<section class="pricing-section">
    <div class="container">
        <div class="pricing-header">
            <h2 class="pricing-title">Car Services Pricing</h2>
            <p class="pricing-subtitle">Transparent pricing for all our professional services</p>
        </div>

        <div class="table-wrapper">
            <table class="pricing-table">
                <thead>
                    <tr>
                        <th class="col-service">Service</th>
                        <th>Small Car</th>
                        <th>Medium</th>
                        <th>SUV/MUV</th>
                        <th>Premium</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Dry Cleaning</strong></td>
                        <td>₹1500</td>
                        <td>₹2000</td>
                        <td>₹3000</td>
                        <td>₹3500</td>
                    </tr>
                    <tr>
                        <td><strong>Rubbing & Polishing</strong></td>
                        <td>₹2500</td>
                        <td>₹3000</td>
                        <td>₹4000</td>
                        <td>₹5000</td>
                    </tr>
                    <tr>
                        <td><strong>Teflon Coating</strong></td>
                        <td>₹2500</td>
                        <td>₹3500</td>
                        <td>₹4000</td>
                        <td>₹5000</td>
                    </tr>
                    <tr>
                        <td><strong>Ceramic Coating</strong></td>
                        <td>₹25000</td>
                        <td>₹30000</td>
                        <td>₹40000</td>
                        <td>₹50000</td>
                    </tr>
                    <tr>
                        <td><strong>Anti-Rust Coating</strong></td>
                        <td>₹2500</td>
                        <td>₹3000</td>
                        <td>₹4000</td>
                        <td>₹5000</td>
                    </tr>
                    <tr>
                        <td><strong>Silencer Coating</strong></td>
                        <td>₹800</td>
                        <td>₹1000</td>
                        <td>₹1200</td>
                        <td>₹1500</td>
                    </tr>
                    <tr>
                        <td><strong>PPF Coating</strong></td>
                        <td>₹125000</td>
                        <td>₹140000</td>
                        <td>₹160000</td>
                        <td>₹180000</td>
                    </tr>
                    <tr>
                        <td><strong>Car Washing</strong></td>
                        <td>₹350</td>
                        <td>₹400</td>
                        <td>₹450</td>
                        <td>₹500</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="pricing-discount">
            <p>★ <strong>25% Discount On Value Added Service</strong> ★</p>
        </div>
    </div>
</section>

<style>
    .pricing-section {
        background-color: var(--color-dark-bg);
        padding: var(--space-5) 0;
    }

    .pricing-header {
        text-align: center;
        margin-bottom: var(--space-5);
    }

    .pricing-title {
        color: var(--color-white);
        font-size: var(--font-size-h2);
        font-family: var(--font-heading);
        font-weight: var(--font-weight-bold);
        margin-bottom: var(--space-2);
    }

    .pricing-subtitle {
        color: rgba(255, 255, 255, 0.7);
        font-size: var(--font-size-body);
        margin: 0;
    }

    .table-wrapper {
        overflow-x: auto;
        border-radius: var(--radius-card);
        overflow: hidden;
    }

    .pricing-table {
        width: 100%;
        border-collapse: collapse;
        background-color: var(--color-dark-bg);
    }

    .pricing-table thead {
        background-color: var(--color-primary-red-dark);
    }

    .pricing-table th {
        padding: var(--space-3);
        text-align: center;
        font-weight: var(--font-weight-bold);
        color: var(--color-white);
        font-size: 13px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .pricing-table th.col-service {
        text-align: left;
    }

    .pricing-table td {
        padding: var(--space-3);
        text-align: center;
        color: rgba(255, 255, 255, 0.9);
        font-size: 14px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .pricing-table td:first-child {
        text-align: left;
        font-weight: var(--font-weight-medium);
    }

    .pricing-table tbody tr:hover {
        background-color: rgba(233, 28, 45, 0.05);
    }

    .pricing-discount {
        text-align: center;
        margin-top: var(--space-4);
        padding: var(--space-3);
    }

    .pricing-discount p {
        color: var(--color-primary-red);
        font-size: 14px;
        margin: 0;
    }

    @media (max-width: 768px) {
        .pricing-section {
            padding: var(--space-4) 0;
        }

        .pricing-title {
            font-size: 28px;
        }

        .pricing-table th,
        .pricing-table td {
            padding: var(--space-2);
            font-size: 12px;
        }

        .pricing-table th {
            font-size: 11px;
        }
    }

    @media (max-width: 480px) {
        .pricing-section {
            padding: var(--space-3) 0;
        }

        .pricing-title {
            font-size: 24px;
        }

        .pricing-table th,
        .pricing-table td {
            padding: 10px 8px;
            font-size: 11px;
        }

        .pricing-discount p {
            font-size: 12px;
        }
    }
</style>
