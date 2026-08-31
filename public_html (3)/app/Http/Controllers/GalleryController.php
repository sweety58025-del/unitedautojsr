<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{

    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('backend.gallery.index', compact('galleries'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $file = $request->file('image');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('front/assets/img/gallery'), $filename);

        $imagePath = 'front/assets/img/gallery/'.$filename;

        Gallery::create([
            'name' => $request->name,
            'image' => $imagePath
        ]);

        return back()->with('success','Gallery Image Added Successfully');
    }


    public function edit($id)
    {
        $editGallery = Gallery::findOrFail($id);
        $galleries = Gallery::latest()->get();

        return view('backend.gallery.index', compact('galleries','editGallery'));
    }


    public function update(Request $request,$id)
    {

        $request->validate([
            'name' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $gallery = Gallery::findOrFail($id);

        $imagePath = $gallery->image;

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('front/assets/img/gallery'), $filename);

            $imagePath = 'front/assets/img/gallery/'.$filename;
        }

        $gallery->update([
            'name' => $request->name,
            'image' => $imagePath
        ]);

        return redirect()->route('gallery.index')
            ->with('success','Gallery Updated Successfully');
    }


    public function destroy($id)
    {
        Gallery::findOrFail($id)->delete();

        return back()->with('success','Gallery Deleted Successfully');
    }

}
