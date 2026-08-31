<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class CategoryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:show-category', only: ['index']),
            new Middleware('permission:add-category', only: ['create']),
            new Middleware('permission:edit-category', only: ['edit']),
            new Middleware('permission:delete-category', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.category.index',[
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable',
            'category_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required',
        ]);

        try{
            $imageName = null;

            // 📸 Image upload
            if ($request->hasFile('category_image')) {
                $image = $request->file('category_image');
                $imageName = time() . '_' . Str::slug($validated['name']) . '.' . $image->getClientOriginalExtension();

                $image->move(public_path('assets/category'), $imageName);
            }
            
            // Insert Record
            Category::create([
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name']),
                'description' => $validated['description'],
                'category_image'       => $imageName,
                'status' => $validated['status'],
            ]);

            return redirect()
                ->route('category.index') // change if different route name
                ->with('message', '<div class="alert alert-success">Category created successfully!</div>');
        } catch (\Exception $e) {
            return redirect()
                ->route('category.index')
                ->with('message', '<div class="alert alert-danger">Error deleting category!</div>');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        return view('backend.category.edit',[
            'cat_id' => $id,
            'categories' => Category::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find category
        $category = Category::findOrFail($id);

        // Validation with unique except id
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable',
            'status' => 'required',
        ]);

        try {
            $imageName = $category->image; // keep old image by default
            if ($request->hasFile('category_image')) {
                // ❌ Delete old image
                if ($category->image && file_exists(public_path('assets/category/' . $category->image))) {
                    unlink(public_path('assets/category/' . $category->image));
                }

                // ✅ Upload new image
                $image = $request->file('category_image');
                $imageName = time() . '_' . Str::slug($validated['name']) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/category'), $imageName);
            }
            // Update record
            $category->update([
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name']),
                'description' => $validated['description'],
                'category_image'  => $imageName,
                'status' => $validated['status'],
            ]);

            return redirect()
                ->route('category.index')
                ->with('message', '<div class="alert alert-success">Category updated successfully!</div>');
        } catch (\Exception $e) {
            return redirect()
                ->route('category.index')
                ->with('message', '<div class="alert alert-danger">Error updating category!</div>');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $service_category)
    {
        try {
            $service_category->delete();

            return redirect()
                ->route('category.index')
                ->with('message', '<div class="alert alert-success">Category deleted successfully!</div>');
        } catch (\Exception $e) {
            return redirect()
                ->route('category.index')
                ->with('message', '<div class="alert alert-danger">Error deleting category!'. $e->getMessage().'</div>');
        }
    }


    

}
