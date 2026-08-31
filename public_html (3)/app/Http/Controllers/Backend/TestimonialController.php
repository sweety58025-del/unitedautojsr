<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{

    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('backend.testimonial.index', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'feedback' => 'required'
        ]);

        Testimonial::create($request->all());

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
            'username' => 'required',
            'feedback' => 'required'
        ]);

        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update($request->all());

        return redirect()->route('testimonial.index')->with('success','Updated Successfully');
    }

    public function destroy($id)
    {
        Testimonial::destroy($id);

        return redirect()->back()->with('success','Deleted Successfully');
    }

}