<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ServiceController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:show-service', only: ['index']),
            new Middleware('permission:add-service', only: ['store']),
            new Middleware('permission:edit-service', only: ['edit']),
            new Middleware('permission:delete-service', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::with(['category', 'subcategory'])->orderBy('category_id','asc')->get();
        return view('backend.service.index',[
            'categories' => Category::all(),
            'services' => $services
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
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
            'notes' => 'nullable|string|max:500',
        ]);

        try {

            // Store record
            Service::create([
                'category_id' => $validated['category_id'],
                'sub_category_id' => $validated['subcategory_id'] ?? null,
                'name' => $validated['name'],
                'price' => $validated['price'],
                'notes' => $validated['notes'] ?? null,
            ]);

            return redirect()
                ->route('services.index')
                ->with('message', '<div class="alert alert-success">Service added successfully!</div>');

        } catch (\Exception $e) {

            return redirect()
                ->route('services.index')
                ->with('message', '<div class="alert alert-danger">Error while adding service!</div>');
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
        $service = Service::findOrFail($id);
        $categories = Category::all();
        $subcategories = SubCategory::where('category_id', $service->category_id)->get();

        return view('backend.service.edit', compact('service', 'categories', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
            'notes' => 'nullable|string|max:500',
        ]);

        try {
            $service->update([
                'category_id' => $validated['category_id'],
                'sub_category_id' => $validated['subcategory_id'] ?? null,
                'name' => $validated['name'],
                'price' => $validated['price'],
                'notes' => $validated['notes'] ?? null,
            ]);

            return redirect()
                ->route('services.index')
                ->with('message', '<div class="alert alert-success">Service added successfully!</div>');

        } catch (\Exception $e) {

            return redirect()
                ->route('services.index')
                ->with('message', '<div class="alert alert-danger">Error while adding service!</div>');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $service = Service::findOrFail($id);

            $service->delete();

            return redirect()
                ->route('services.index')
                ->with('message', '<div class="alert alert-success">Services deleted successfully!</div>');

        } catch (\Exception $e) {

            return redirect()
                ->route('services.index')
                ->with('message', '<div class="alert alert-danger">Error deleting Service!</div>');
        }
    }
}
