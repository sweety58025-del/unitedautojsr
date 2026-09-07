<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

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
        $request->validate([
            'username' => 'required|string|max:255',
            'feedback' => 'required|string|max:5000',
            'rating' => 'nullable|integer|min:1|max:5',
            'status' => 'nullable|in:yes,no',
        ]);

        Testimonial::create($request->only([
            'username', 'feedback', 'rating', 'status',
        ]));

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
        $request->validate([
            'username' => 'required|string|max:255',
            'feedback' => 'required|string|max:5000',
            'rating' => 'nullable|integer|min:1|max:5',
            'status' => 'nullable|in:yes,no',
        ]);

        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update($request->only([
            'username', 'feedback', 'rating', 'status',
        ]));

        return redirect()->route('testimonial.index')->with('success','Updated Successfully');
    }

    public function destroy($id)
    {
        Testimonial::destroy($id);

        return redirect()->back()->with('success','Deleted Successfully');
    }

}