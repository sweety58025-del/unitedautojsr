<?php

namespace App\View\Composers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\CompanySetting;
use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;

class FrontendLayoutComposer
{
    public function compose(View $view): void
    {
        $hasCategories = Schema::hasTable('categories');
        $hasBrands = Schema::hasTable('brands');
        $company = CompanySetting::firstRecord();

        $view->with([
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