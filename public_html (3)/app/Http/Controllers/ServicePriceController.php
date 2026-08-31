<?php

namespace App\Http\Controllers;

use App\Models\ServicePrice;
use Illuminate\Http\Request;

class ServicePriceController extends Controller
{
    public function index()
    {
        $services = ServicePrice::latest()->get();
        return view('backend.service_price.index',compact('services'));
    }


    public function create()
    {
        return view('backend.service_price.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'item' => 'required|string|max:255',
            'small_car_price' => 'nullable|numeric',
            'medium_price' => 'nullable|numeric',
            'suv_muv_price' => 'nullable|numeric',
            'premium_price' => 'nullable|numeric',
        ]);

        ServicePrice::create($request->all());

        return redirect()->route('service-price.index')
            ->with('success','Service Price Created Successfully');
    }


    public function edit($id)
    {
        $service = ServicePrice::findOrFail($id);
        return view('backend.service_price.edit',compact('service'));
    }


    public function update(Request $request,$id)
    {
        $request->validate([
            'item' => 'required|string|max:255',
            'small_car_price' => 'nullable|numeric',
            'medium_price' => 'nullable|numeric',
            'suv_muv_price' => 'nullable|numeric',
            'premium_price' => 'nullable|numeric',
        ]);

        $service = ServicePrice::findOrFail($id);
        $service->update($request->all());

        return redirect()->route('service-price.index')
            ->with('success','Service Price Updated Successfully');
    }


    public function destroy($id)
    {
        $service = ServicePrice::findOrFail($id);
        $service->delete();

        return back()->with('success','Service Price Deleted Successfully');
    }
}
