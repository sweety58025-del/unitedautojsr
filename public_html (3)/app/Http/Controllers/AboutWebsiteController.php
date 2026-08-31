<?php

namespace App\Http\Controllers;

use App\Models\AboutWebsite;
use App\Models\HeroBanner;
use Illuminate\Http\Request;

class AboutWebsiteController extends Controller
{
    public function index(){
        return view('backend.website-content.about-company', [
            'about_website' => AboutWebsite::first()
        ]);
    }

    public function storeOrUpdate(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'about_title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'about_image' => 'nullable|image|mimes:jpg,jpeg,png,PNG,webp|max:2048',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',

            'why_choose_title_1' => 'nullable|string|max:255',
            'why_choose_title_2' => 'nullable|string|max:255',
            'why_choose_title_3' => 'nullable|string|max:255',
            'why_choose_title_4' => 'nullable|string|max:255',

            'why_choose_content_1' => ['nullable', function ($attribute, $value, $fail) {
                if (str_word_count($value) > 30) {
                    $fail('Why Choose Us Content 1 must not exceed 30 words.');
                }
            }],
            'why_choose_content_2' => ['nullable', function ($attribute, $value, $fail) {
                if (str_word_count($value) > 30) {
                    $fail('Why Choose Us Content 2 must not exceed 30 words.');
                }
            }],
            'why_choose_content_3' => ['nullable', function ($attribute, $value, $fail) {
                if (str_word_count($value) > 30) {
                    $fail('Why Choose Us Content 3 must not exceed 30 words.');
                }
            }],
            'why_choose_content_4' => ['nullable', function ($attribute, $value, $fail) {
                if (str_word_count($value) > 30) {
                    $fail('Why Choose Us Content 4 must not exceed 30 words.');
                }
            }],
        ]);

        $about = AboutWebsite::first();

        $imagePath = $about->about_image ?? null;

        if ($request->hasFile('about_image')) {

            $file = $request->file('about_image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('front/assets/img/about'), $filename);

            $imagePath = 'front/assets/img/about/'.$filename;
        }

        $data = [
            'about_title' => $request->about_title,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'about_image' => $imagePath,
            'mission' => $request->mission,
            'vision' => $request->vision,

            'why_choose_title_1' => $request->why_choose_title_1,
            'why_choose_content_1' => $request->why_choose_content_1,

            'why_choose_title_2' => $request->why_choose_title_2,
            'why_choose_content_2' => $request->why_choose_content_2,

            'why_choose_title_3' => $request->why_choose_title_3,
            'why_choose_content_3' => $request->why_choose_content_3,

            'why_choose_title_4' => $request->why_choose_title_4,
            'why_choose_content_4' => $request->why_choose_content_4,
            'service_terms' => $request->service_terms,
        ];

        if ($about) {
            $about->update($data);
        } else {
            AboutWebsite::create($data);
        }

        return back()->with('success','About Website Saved Successfully');
    }

    public function hero_banner(){
        return view('backend.website-content.hero-banner', [
            'hero_banner' => HeroBanner::first()
        ]);
    }

    public function heroBannerStore(Request $request)
    {
        $request->validate([
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sub_title' => 'nullable|string|max:255',
            'main_title' => 'required|string|max:255',
            'sort_paragraph' => 'nullable|string|max:500'
        ]);

        $banner = HeroBanner::first();

        $imagePath = $banner->banner_image ?? null;

        if ($request->hasFile('banner_image')) {

            $file = $request->file('banner_image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('front/assets/img/banner'), $filename);

            $imagePath = 'front/assets/img/banner/'.$filename;
        }

        $data = [
            'banner_image' => $imagePath,
            'sub_title' => $request->sub_title,
            'main_title' => $request->main_title,
            'sort_paragraph' => $request->sort_paragraph,
        ];

        if ($banner) {
            $banner->update($data);
        } else {
            HeroBanner::create($data);
        }

        return back()->with('success','Hero Banner Saved Successfully');
    }

}
