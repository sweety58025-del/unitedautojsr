<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:show-subcategory', only: ['index']),
            new Middleware('permission:add-subcategory', only: ['create']),
            new Middleware('permission:edit-subcategory', only: ['edit']),
            new Middleware('permission:delete-subcategory', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = SubCategory::with('category')->get();
        return view('backend.subcategory.index',[
            'categories' => Category::all(),
            'subcategories' => $subcategories
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sub_categories')->where(function ($query) use ($request) {
                    return $query->where('category_id', $request->category_id);
                })
            ],
            'category_id' => 'required|exists:categories,id',
            'image_name' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content' => 'nullable|string'
        ]);

        try{

            $imageName = null;

            if($request->hasFile('image_name')){
                $imageName = time().'.'.$request->image_name->extension();
                $request->image_name->move(public_path('front/assets/img/subcategory'),$imageName);
            }

            SubCategory::create([
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name']),
                'category_id' => $validated['category_id'],
                'image_name' => $imageName,
                'content' => $request->content
            ]);

            return redirect()->route('subcategory.index')
            ->with('message','<div class="alert alert-success">Sub Category created successfully!</div>');

        }catch (\Exception $e){

            return redirect()->route('subcategory.index')
            ->with('message','<div class="alert alert-danger">Something went wrong!</div>');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subcategories = SubCategory::with('category')->findOrFail($id);
        return view('backend.subcategory.edit',[
            'cat_id' => $id,
            'categories' => Category::all(),
            'subcategories' => $subcategories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $subcategory = SubCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image_name' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content' => 'nullable|string'
        ]);

        $imageName = $subcategory->image_name;

        if($request->hasFile('image_name')){

            if($subcategory->image_name && file_exists(public_path('front/assets/img/subcategory/'.$subcategory->image_name))){
                unlink(public_path('front/assets/img/subcategory/'.$subcategory->image_name));
            }

            $imageName = time().'.'.$request->image_name->extension();
            $request->image_name->move(public_path('front/assets/img/subcategory'),$imageName);
        }

        $subcategory->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'category_id' => $validated['category_id'],
            'image_name' => $imageName,
            'content' => $request->content
        ]);

        return redirect()->route('subcategory.index')
            ->with('message','<div class="alert alert-success">Sub Category updated successfully!</div>');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $subcategory = SubCategory::findOrFail($id);

            $subcategory->delete();

            return redirect()
                ->route('subcategory.index')
                ->with('message', '<div class="alert alert-success">Sub Category deleted successfully!</div>');

        } catch (\Exception $e) {

            return redirect()
                ->route('subcategory.index')
                ->with('message', '<div class="alert alert-danger">Error deleting Sub Category!</div>');
        }
    }

    public function getSubcategoryByCategoory($id){
        $subcategories = SubCategory::where('category_id', $id)->get();
        return response()->json($subcategories);
    }

    public function fetch_subcategory($id){
        $subcategories = SubCategory::where('category_id', $id)->get();
        return response()->json($subcategories);
    }
}
