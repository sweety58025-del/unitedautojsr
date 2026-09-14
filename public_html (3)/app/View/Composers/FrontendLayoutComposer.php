<?php

namespace App\View\Composers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\CompanySetting;
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
        $serviceCatalog = $hasCategories && $hasServices
            ? Category::query()
                ->with(['services' => fn ($query) => $query
                    ->where('status', 'yes')
                    ->orderBy('sort_order')
                    ->orderBy('name')
                ])
                ->where('status', 'yes')
                ->orderBy('name')
                ->get()
                ->map(fn ($category) => [
                    'name' => $category->name,
                    'items' => $category->services->map(fn ($service) => [
                        'name' => $service->name,
                        'slug' => $service->slug ?: Str::slug($service->name),
                    ])->values(),
                ])
                ->filter(fn ($category) => $category['items']->isNotEmpty())
                ->values()
            : collect();

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