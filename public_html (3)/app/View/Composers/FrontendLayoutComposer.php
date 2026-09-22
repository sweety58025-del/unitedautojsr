<?php

namespace App\View\Composers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\CompanySetting;
use App\Models\Service;
use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class FrontendLayoutComposer
{
    public function compose(View $view): void
    {
        $hasCategories = Schema::hasTable('categories');
        $hasServices = Schema::hasTable('services');
        $hasBrands = Schema::hasTable('brands');
        $company = CompanySetting::firstRecord();

        if ($hasServices) {
            $serviceCatalog = Category::query()
                ->where('status', 'yes')
                ->with(['services' => fn ($query) => $query
                    ->where('status', 'yes')
                    ->orderBy('sort_order')
                    ->orderBy('name')
                ])
                ->orderBy('name')
                ->get()
                ->map(function ($category) {
                    $items = $category->services
                        ->map(fn ($service) => [
                            'name' => (string) $service->name,
                            'slug' => (string) ($service->slug ?: Str::slug($service->name)),
                        ])
                        ->values();

                    return [
                        'name' => (string) $category->name,
                        'items' => $items,
                    ];
                })
                ->filter(fn ($group) => ! empty($group['name']) && $group['items']->isNotEmpty())
                ->values();

            $ungroupedServices = Service::query()
                ->where('status', 'yes')
                ->whereNull('category_id')
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get()
                ->map(fn ($service) => [
                    'name' => (string) $service->name,
                    'slug' => (string) ($service->slug ?: Str::slug($service->name)),
                ])
                ->values();

            if ($ungroupedServices->isNotEmpty()) {
                $serviceCatalog->push([
                    'name' => 'General Services',
                    'items' => $ungroupedServices,
                ]);
            }
        } else {
            $serviceCatalog = collect(config('service-catalog', []))
                ->map(function ($group) {
                    $items = collect($group['items'] ?? [])
                        ->map(fn ($item) => [
                            'name' => (string) $item,
                            'slug' => Str::slug((string) $item),
                        ])
                        ->values();

                    return [
                        'name' => $group['name'] ?? '',
                        'items' => $items,
                    ];
                })
                ->filter(fn ($group) => ! empty($group['name']) && $group['items']->isNotEmpty())
                ->values();
        }

        $view->with([
            'serviceCatalog' => $serviceCatalog,
            'categories' => $hasCategories ? Category::query()
                ->with('subcategories')
                ->where('status', 'yes')
                ->orderBy('name')
                ->get() : collect(),
            'brands' => $hasBrands ? Brand::query()
                ->where('status', 'yes')
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get() : collect(),
            'company' => $company,
            'favicon_icon' => $company?->favicon_icon ?? 'favicon.png',
            'company_logo' => $company?->logo ?? 'logo.png',
            'company_name' => $company?->company_name ?? 'United Auto',
            'company_phone' => $company?->phone ?? '',
            'company_email' => $company?->email ?? '',
            'company_address' => $company?->address ?? '',
            'company_city' => $company?->city ?? '',
            'company_state' => $company?->state ?? '',
            'company_pincode' => $company?->pincode ?? '',
        ]);
    }
}