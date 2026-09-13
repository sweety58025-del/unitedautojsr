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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

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
        return view('frontend.pages.offers');
    }

    public function insurance()
    {
        return view('frontend.pages.insurance');
    }

    public function roadsideAssistance()
    {
        return view('frontend.pages.roadside-assistance');
    }

    public function serviceDetails($slug){
        $service = Category::with(['services' => fn ($query) => $query
            ->where('status', 'yes')
            ->orderBy('sort_order')
            ->orderBy('name')
        ])->where('slug', $slug)->firstOrFail();

        return view('frontend.pages.service-details',[
            'service' => $service
        ]);
    }

    public function serviceCategoryDetails($slug){
        return view('frontend.pages.service-category',[
            'service' => SubCategory::where('slug', $slug)->firstOrFail()
        ]);
    }

    public function serviceTopic($slug)
    {
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
