<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = CompanySetting::firstRecord();
        $appointments = Appointment::query()
            ->whereDate('appointment_date', '>=', today())
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->limit(8)
            ->get();
        $appointmentStats = [
            'total' => Appointment::count(),
            'pending' => Appointment::where('status', 'pending')->count(),
            'confirmed' => Appointment::where('status', 'confirmed')->count(),
        ];

        return view('backend.index', compact('user', 'company', 'appointments', 'appointmentStats'));
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
            'favicon_icon' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
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
            $filename = Str::uuid()->toString() . '.' . $request->file('logo')->extension();
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
            $faviconfilename = Str::uuid()->toString() . '.' . $request->file('favicon_icon')->extension();
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

    public function popup()
    {
        return view('backend.website-content.popup', [
            'popupImage' => CompanySetting::firstRecord()?->popup_image,
        ]);
    }

    public function storePopup(Request $request)
    {
        $request->validate([
            'popup_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'delete_popup_image' => 'nullable|boolean',
        ]);

        $data = CompanySetting::first() ?? new CompanySetting();
        $popupPath = public_path('front/assets/img/popup');

        if ($request->boolean('delete_popup_image')) {
            $this->deleteManagedPopup($data->popup_image);
            $data->popup_image = null;
        }

        if ($request->hasFile('popup_image')) {
            if (! is_dir($popupPath)) {
                mkdir($popupPath, 0777, true);
            }

            $this->deleteManagedPopup($data->popup_image);
            $popupFilename = Str::uuid()->toString() . '.' . $request->file('popup_image')->extension();
            $request->file('popup_image')->move($popupPath, $popupFilename);
            $data->popup_image = 'front/assets/img/popup/' . $popupFilename;
        }

        $data->save();

        return back()->with('message', '<div class="alert alert-success">Homepage popup image updated successfully!</div>');
    }

    private function deleteManagedPopup(?string $path): void
    {
        if ($path && str_starts_with($path, 'front/assets/img/popup/')) {
            $file = public_path($path);
            if (is_file($file)) {
                unlink($file);
            }
        }
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
