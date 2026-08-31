<?php

namespace App\Http\Controllers;

use App\Models\AboutWebsite;
use App\Models\Category;
use App\Models\CompanySetting;
use App\Models\Gallery;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function aboutUs(){
        return view('frontend.pages.about-us',[
            'about_us' => AboutWebsite::first()
        ]);
    }
    public function servicePrice(){
        return view('frontend.pages.service-price');
    }

    public function contactUs(){
        return view('frontend.pages.contact-us',[
            'contact_us' => CompanySetting::first()
        ]);
    }

    public function gallery(){
        return view('frontend.pages.gallery',[
            'gallery' => Gallery::latest()->get()
        ]);
    }

    public function serviceDetails($slug){
        return view('frontend.pages.service-details',[
            'service' => Category::where('slug', $slug)->firstOrFail()
        ]);
    }

    public function serviceCategoryDetails($slug){
        return view('frontend.pages.service-category',[
            'service' => SubCategory::where('slug', $slug)->firstOrFail()
        ]);
    }
}
