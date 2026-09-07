<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class TestimonialController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:show-testimonial', only: ['index']),
            new Middleware('permission:add-testimonial', only: ['store']),
            new Middleware('permission:edit-testimonial', only: ['edit', 'update']),
            new Middleware('permission:delete-testimonial', only: ['destroy']),
        ];
    }

    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('backend.testimonial.index', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'feedback' => 'required|string|max:5000',
            'customer_name' => 'nullable|string|max:255',
            'vehicle' => 'nullable|string|max:255',
            'vehicle_brand' => 'nullable|string|max:255',
            'review' => 'nullable|string|max:5000',
            'rating' => 'nullable|integer|min:1|max:5',
            'status' => 'nullable|in:yes,no',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        Testimonial::create($this->attributes($request, $validated));

        return redirect()->back()->with('success','Testimonial Added Successfully');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonials = Testimonial::latest()->get();

        return view('backend.testimonial.index', compact('testimonial','testimonials'));
    }

    public function update(Request $request,$id)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'feedback' => 'required|string|max:5000',
            'customer_name' => 'nullable|string|max:255',
            'vehicle' => 'nullable|string|max:255',
            'vehicle_brand' => 'nullable|string|max:255',
            'review' => 'nullable|string|max:5000',
            'rating' => 'nullable|integer|min:1|max:5',
            'status' => 'nullable|in:yes,no',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $testimonial = Testimonial::findOrFail($id);
        $attributes = $this->attributes($request, $validated);
        if (! $request->hasFile('image')) {
            unset($attributes['image']);
        } else {
            $this->deleteImageFile($testimonial->image);
        }
        $testimonial->update($attributes);

        return redirect()->route('testimonial.index')->with('success','Updated Successfully');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $this->deleteImageFile($testimonial->image);
        $testimonial->delete();

        return redirect()->back()->with('success','Deleted Successfully');
    }

    private function attributes(Request $request, array $validated): array
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $directory = public_path('front/assets/img/testimonials');
            if (! is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
            $filename = Str::uuid()->toString().'.'.$request->file('image')->extension();
            $request->file('image')->move($directory, $filename);
            $imagePath = 'front/assets/img/testimonials/'.$filename;
        }

        return [
            'username' => $validated['username'],
            'feedback' => $validated['feedback'],
            'customer_name' => $validated['customer_name'] ?? null,
            'vehicle' => $validated['vehicle'] ?? null,
            'vehicle_brand' => $validated['vehicle_brand'] ?? null,
            'review' => $validated['review'] ?? null,
            'rating' => $validated['rating'] ?? null,
            'status' => $validated['status'] ?? 'yes',
            'sort_order' => $validated['sort_order'] ?? 0,
            'image' => $imagePath,
        ];
    }

    private function deleteImageFile(?string $path): void
    {
        if (! $path || ! Str::startsWith($path, 'front/assets/img/testimonials/')) {
            return;
        }

        $fullPath = public_path($path);
        if (is_file($fullPath)) {
            unlink($fullPath);
        }
    }

}