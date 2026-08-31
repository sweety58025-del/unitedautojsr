<?php

namespace App\Http\Controllers;

use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('backend.index', compact('user'));
    }

    public function setting(){
        $company = CompanySetting::first();
        return view('backend.setting', compact('company'));
    }

    public function storeCompany(Request $request)
    {
        $data = CompanySetting::first() ?? new CompanySetting();
    
        $request->validate([
            'company_name' => 'required',
            'phone'        => 'required',
            'email'        => 'required|email',
            'city'         => 'required',
            'state'        => 'required',
            'pincode'      => 'required',
            'address'      => 'required',
            'pan'          => 'required',
            'gst'          => 'required',
            'logo'         => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'favicon_icon' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);
    
        if ($request->hasFile('logo')) {
    
            $path = public_path('assets/images/company/');
    
            // delete old file
            if (!empty($data->logo) && file_exists($path . $data->logo)) {
                unlink($path . $data->logo);
            }
    
            // create folder if not exist
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
    
            // upload new file
            $filename = time() . '_' . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move($path, $filename);
    
            $data->logo = $filename;
        }

        if ($request->hasFile('favicon_icon')) {
    
            $favicon_path = public_path('assets/images/company/');
    
            // delete old file
            if (!empty($data->favicon_icon) && file_exists($favicon_path . $data->favicon_icon)) {
                unlink($favicon_path . $data->favicon_icon);
            }
    
            // create folder if not exist
            if (!file_exists($favicon_path)) {
                mkdir($favicon_path, 0777, true);
            }
    
            // upload new file
            $faviconfilename = time() . '_' . $request->file('favicon_icon')->getClientOriginalName();
            $request->file('favicon_icon')->move($favicon_path, $faviconfilename);
    
            $data->favicon_icon = $faviconfilename;
        }
    
        // Save fields
        $data->company_name = $request->company_name;
        $data->phone        = $request->phone;
        $data->email        = $request->email;
        $data->city         = $request->city;
        $data->state        = $request->state;
        $data->pincode      = $request->pincode;
        $data->address      = $request->address;
        $data->pan          = $request->pan;
        $data->gst          = $request->gst;
    
        $data->save();
    
        return back()->with('message', '<div class="alert alert-success">Company details saved successfully!</div>');
    }

    public function changePassword(Request $request)
    {
        // VALIDATION
        $request->validate([
            'password'          => 'required|min:6',
            'confirm_password'  => 'required|same:password',
        ],[
            'confirm_password.same' => 'Confirm password does not match.'
        ]);

        // GET AUTH USER
        $user = Auth::user();

        // UPDATE PASSWORD
        $user->password = $request->password;
        $user->save();

        return back()->with('message', '<div class="alert alert-success">Password changed successfully!</div>');
    }
}
