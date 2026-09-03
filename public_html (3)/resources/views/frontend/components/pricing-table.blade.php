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
        .pricing-table th,
        .pricing-table td {
            padding: 12px 10px;
            font-size: 12px;
        }
    }
</style>
