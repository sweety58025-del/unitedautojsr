@php
    use App\Models\Category;
    use App\Models\Service;
    use Illuminate\Support\Facades\Schema;

    $serviceTableExists = Schema::hasTable((new Service)->getTable());
    $categoryTableExists = Schema::hasTable((new Category)->getTable());

    $pricingServices = collect();
    $pricingCategories = collect();

    if ($serviceTableExists && $categoryTableExists) {
        $pricingServices = Service::with('category')->get()->map(function ($service) {
            $categoryName = $service->category?->name ?? 'General';
            $estimatedDuration = match ($categoryName) {
                'Car Washing & Cleaning' => '45-90 min',
                'Coating & Protection' => '2-4 hrs',
                'Engine & Repair Services' => '2-5 hrs',
                'Wheel & Suspension' => '1-3 hrs',
                'Specialty Services' => '1-2 hrs',
                default => '1-3 hrs',
            };

            return [
                'name' => $service->name,
                'category_name' => $categoryName,
                'category_slug' => $service->category?->slug ?? 'general',
                'description' => $service->notes ?: 'Professional care and finish for your vehicle.',
                'duration' => $estimatedDuration,
                'price' => (float) $service->price,
            ];
        })->values();

        $pricingCategories = Category::activeServices()->map(function ($category) {
            return [
                'name' => $category->name,
                'slug' => $category->slug,
            ];
        })->values();
    }
@endphp

<section class="pricing-section">
    <div class="container">
        <div class="pricing-header">
            <h2 class="pricing-title">Car Services Pricing</h2>
            <p class="pricing-subtitle">Transparent pricing for all our professional services</p>
        </div>

        <div class="pricing-filter-bar" role="toolbar" aria-label="Service pricing filters">
            <button class="pricing-filter-btn active" type="button" data-filter="all" aria-pressed="true">All</button>
            @foreach($pricingCategories as $category)
                <button class="pricing-filter-btn" type="button" data-filter="{{ $category['slug'] }}" aria-pressed="false">
                    {{ $category['name'] }}
                </button>
            @endforeach
        </div>

        <div class="table-wrapper">
            <table class="pricing-table">
                <thead>
                    <tr>
                        <th class="col-service">Service</th>
                        <th>What's included</th>
                        <th>Estimated duration</th>
                        <th>Price</th>
                        <th>Book</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pricingServices as $service)
                        <tr data-category="{{ $service['category_slug'] }}">
                            <td class="pricing-service-name">
                                <strong>{{ $service['name'] }}</strong>
                                <span>{{ $service['category_name'] }}</span>
                            </td>
                            <td>{{ $service['description'] }}</td>
                            <td>{{ $service['duration'] }}</td>
                            <td>₹{{ number_format($service['price'], 0) }}</td>
                            <td>
                                <a class="pricing-book-link" href="{{ route('book-appointment') }}?service={{ urlencode($service['name']) }}">
                                    Book
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterButtons = document.querySelectorAll('.pricing-filter-btn');
        const tableRows = document.querySelectorAll('.pricing-table tbody tr');

        filterButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const filter = button.dataset.filter;

                filterButtons.forEach(function (btn) {
                    const isActive = btn === button;
                    btn.classList.toggle('active', isActive);
                    btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
                });

                tableRows.forEach(function (row) {
                    const visible = filter === 'all' || row.dataset.category === filter;
                    row.hidden = !visible;
                });
            });
        });
    });
</script>

<style>
    .pricing-section {
        background-color: var(--color-dark-bg);
        padding: var(--space-5) 0;
    }

    .pricing-header {
        text-align: center;
        margin-bottom: var(--space-4);
    }

    .pricing-title {
        color: var(--color-white);
        font-size: var(--font-size-h2);
        font-family: var(--font-heading);
        font-weight: var(--font-weight-bold);
        margin-bottom: var(--space-2);
    }

    .pricing-subtitle {
        color: rgba(255, 255, 255, 0.72);
        font-size: var(--font-size-body);
        margin: 0;
    }

    .pricing-filter-bar {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 24px;
    }

    .pricing-filter-btn {
        border: 1px solid rgba(255,255,255,0.16);
        background: rgba(255,255,255,0.04);
        color: var(--color-white);
        border-radius: 999px;
        padding: 9px 16px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        cursor: pointer;
        transition: var(--transition-normal);
    }

    .pricing-filter-btn.active,
    .pricing-filter-btn:hover {
        background-color: var(--color-primary-red);
        border-color: var(--color-primary-red);
        color: var(--color-white);
    }

    .table-wrapper {
        overflow-x: auto;
        border-radius: var(--radius-card);
        border: 1px solid rgba(255,255,255,0.08);
        background: rgba(17, 17, 17, 0.78);
    }

    .pricing-table {
        width: 100%;
        border-collapse: collapse;
        background-color: rgba(17, 17, 17, 0.96);
    }

    .pricing-table thead {
        background-color: var(--color-primary-red-dark);
    }

    .pricing-table th,
    .pricing-table td {
        padding: 16px 18px;
        text-align: left;
        vertical-align: top;
        border-bottom: 1px solid rgba(255,255,255,0.08);
        color: rgba(255,255,255,0.9);
        font-size: 14px;
        line-height: 1.6;
    }

    .pricing-table th {
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.08em;
        font-weight: 700;
        color: var(--color-white);
    }

    .pricing-service-name {
        min-width: 180px;
    }

    .pricing-service-name strong,
    .pricing-service-name span {
        display: block;
    }

    .pricing-service-name span {
        color: rgba(255,255,255,0.6);
        font-size: 12px;
        margin-top: 4px;
    }

    .pricing-table tbody tr:hover {
        background-color: rgba(215, 0, 6, 0.05);
    }

    .pricing-book-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 84px;
        padding: 9px 14px;
        border-radius: 999px;
        background: var(--color-primary-red);
        color: var(--color-white);
        text-decoration: none;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .pricing-book-link:hover {
        color: var(--color-white);
        background: #b80008;
    }

    @media (max-width: 768px) {
        .pricing-section {
            padding: var(--space-4) 0;
        }

        .pricing-filter-bar {
            gap: 8px;
        }

        .pricing-filter-btn {
            padding: 8px 12px;
            font-size: 11px;
        }

        .pricing-table th,
        .pricing-table td {
            padding: 12px 10px;
            font-size: 12px;
        }
    }
</style>
