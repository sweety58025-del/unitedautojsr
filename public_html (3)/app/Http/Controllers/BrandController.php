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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => 'sometimes|integer|min:0',
            'status' => 'sometimes|in:yes,no',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            if (! is_dir(public_path('front/assets/img/brand'))) {
                mkdir(public_path('front/assets/img/brand'), 0755, true);
            }
            $file = $request->file('image');
            $filename = Str::uuid()->toString().'.'.$file->extension();
            $file->move(public_path('front/assets/img/brand'), $filename);

            $imagePath = 'front/assets/img/brand/'.$filename;
        }

        Brand::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $imagePath,
            'sort_order' => $request->input('sort_order', 0),
            'status' => $request->input('status', 'yes'),
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => 'sometimes|integer|min:0',
            'status' => 'sometimes|in:yes,no',
        ]);

        $brand = Brand::findOrFail($id);

        $imagePath = $brand->image;

        if ($request->hasFile('image')) {
            if (! is_dir(public_path('front/assets/img/brand'))) {
                mkdir(public_path('front/assets/img/brand'), 0755, true);
            }
            $this->deleteImageFile($brand->image);
            $file = $request->file('image');
            $filename = Str::uuid()->toString().'.'.$file->extension();
            $file->move(public_path('front/assets/img/brand'), $filename);

            $imagePath = 'front/assets/img/brand/'.$filename;
        }

        $brand->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $imagePath,
            'sort_order' => $request->input('sort_order', $brand->sort_order),
            'status' => $request->input('status', $brand->status),
        ]);

        return redirect()->route('brands.index')
            ->with('success','Brand Updated Successfully');
    }


    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $this->deleteImageFile($brand->image);
        $brand->delete();

        return back()->with('success','Brand Deleted Successfully');
    }

    private function deleteImageFile(?string $path): void
    {
        if (! $path || ! Str::startsWith($path, 'front/assets/img/brand/')) {
            return;
        }

        $fullPath = public_path($path);
        if (is_file($fullPath)) {
            unlink($fullPath);
        }
    }

}