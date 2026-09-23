<?php

namespace App\Http\Controllers;

use App\Models\AboutWebsite;
use App\Models\Article;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CompanySetting;
use App\Models\Gallery;
use App\Models\RepairProject;
use App\Models\Service;
use App\Models\SubCategory;
use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.index', [
            'articles' => Schema::hasTable('articles') ? Article::published()->take(3)->get() : collect(),
            'repairProjects' => Schema::hasTable('repair_projects')
                ? RepairProject::publicQuery()->get()
                : collect(),
        ]);
    }

    public function aboutUs(){
        return view('frontend.pages.about-us',[
            'about_us' => AboutWebsite::firstRecord()
        ]);
    }
    public function servicePrice(){
        return view('frontend.pages.service-price');
    }

    public function contactUs(){
        return view('frontend.pages.contact-us',[
            'contact_us' => CompanySetting::firstRecord()
        ]);
    }

    public function gallery(){
        return view('frontend.pages.gallery',[
            'gallery' => Gallery::allGalleries(),
            'repairProjects' => Schema::hasTable('repair_projects')
                ? RepairProject::publicQuery()->get()
                : collect(),
        ]);
    }

    public function brands()
    {
        return view('frontend.pages.brands', [
            'brands' => Schema::hasTable('brands') ? Brand::query()
                ->where('status', 'yes')
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get() : collect(),
        ]);
    }

    public function offers()
    {
        return view('frontend.pages.offers', ['pageContent' => PageContent::forPage('offers')]);
    }

    public function insurance()
    {
        return view('frontend.pages.insurance', ['pageContent' => PageContent::forPage('insurance')]);
    }

    public function insuranceClaimPartners()
    {
        return view('frontend.pages.insurance-claim-partners', ['pageContent' => PageContent::forPage('insurance-claim-partners')]);
    }

    public function insuranceRenewal()
    {
        return view('frontend.pages.insurance-renewal', ['pageContent' => PageContent::forPage('insurance-renewal')]);
    }

    public function roadsideAssistance()
    {
        return view('frontend.pages.roadside-assistance', ['pageContent' => PageContent::forPage('roadside-assistance')]);
    }

    public function serviceDetails($slug){
        $service = Service::with('category')
            ->where('status', 'yes')
            ->get()
            ->first(fn ($item) => $item->slug === $slug || Str::slug($item->name) === $slug);

        if ($service) {
            return view('frontend.pages.service-details', [
                'service' => $service,
                'serviceCategory' => $service->category,
                'categoryServices' => collect(),
            ]);
        }

        $service = Category::with(['services' => fn ($query) => $query
            ->where('status', 'yes')
            ->orderBy('sort_order')
            ->orderBy('name')
        ])->where('slug', $slug)->firstOrFail();

        return view('frontend.pages.service-details',[
            'service' => $service,
            'serviceCategory' => $service,
            'categoryServices' => $service->services,
        ]);
    }

    public function serviceCategoryDetails($slug){
        return view('frontend.pages.service-category',[
            'service' => SubCategory::where('slug', $slug)->firstOrFail()
        ]);
    }

    public function serviceTopic($slug)
    {
        $service = Service::with(['category', 'subcategory'])
            ->where('status', 'yes')
            ->where(function ($query) use ($slug) {
                $query->where('slug', $slug)
                    ->orWhereRaw('LOWER(name) = ?', [strtolower(str_replace('-', ' ', $slug))]);
            })
            ->first();

        if ($service) {
            $topic = $service->name;

            return view('frontend.pages.service-topic', compact('topic', 'service'));
        }

        $topic = collect(config('service-catalog'))
            ->flatMap(fn ($group) => $group['items'])
            ->first(fn ($item) => (string) str($item)->slug() === $slug);

        abort_unless($topic, 404);

        $service = Service::with(['category', 'subcategory'])
            ->where('status', 'yes')
            ->where(function ($query) use ($slug, $topic) {
                $query->where('slug', $slug)
                    ->orWhereRaw('LOWER(name) = ?', [strtolower($topic)]);
            })
            ->first();

        return view('frontend.pages.service-topic', compact('topic', 'service'));
    }
}
