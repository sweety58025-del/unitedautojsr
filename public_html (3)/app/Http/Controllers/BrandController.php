<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;
use App\Models\Brand;

class BrandController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:show-brand', only: ['index']),
            new Middleware('permission:add-brand', only: ['store']),
            new Middleware('permission:edit-brand', only: ['edit', 'update']),
            new Middleware('permission:delete-brand', only: ['destroy']),
        ];
    }

    public function index()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.index', compact('brands'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('front/assets/img/brand'), $filename);

            $imagePath = 'front/assets/img/brand/'.$filename;
        }

        Brand::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $imagePath
        ]);

        return back()->with('success','Brand Added Successfully');
    }


    public function edit($id)
    {
        $editBrand = Brand::findOrFail($id);
        $brands = Brand::latest()->get();

        return view('backend.brand.index', compact('brands','editBrand'));
    }


    public function update(Request $request,$id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $brand = Brand::findOrFail($id);

        $imagePath = $brand->image;

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('front/assets/img/brand'), $filename);

            $imagePath = 'front/assets/img/brand/'.$filename;
        }

        $brand->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $imagePath
        ]);

        return redirect()->route('brands.index')
            ->with('success','Brand Updated Successfully');
    }


    public function destroy($id)
    {
        Brand::findOrFail($id)->delete();

        return back()->with('success','Brand Deleted Successfully');
    }

}