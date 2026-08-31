@extends('backend.partial.master')
@section('title', 'Dashboard')
@section('backend-content')

<div class="row">
    <div class="col-12">
        @if (session('message'))
            {!! session('message') !!}
        @endif
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">Company Setting</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.store-company') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-12 form-group">
                            <span>Logo<span class="text-danger">*</span></span>
                            <input type="file" class="form-control" name="logo">
                            <span class="text-danger">@error('logo') {{ $message }} @enderror</span>
                            {{-- Display Logo --}}
                            @if($company && $company->logo)
                                <div class="mb-3">
                                    <img src="{{ asset('assets/images/company/' . $company->logo) }}"
                                            alt="Company Logo"
                                            style="max-width: 150px;">
                                </div>
                            @endif
                        </div>

                        <div class="col-md-12 form-group">
                            <span>Favicon Icon<span class="text-danger">*</span></span>
                            <input type="file" class="form-control" name="favicon_icon">
                            <span class="text-danger">@error('favicon_icon') {{ $message }} @enderror</span>
                            {{-- Display Logo --}}
                            @if($company && $company->logo)
                                <div class="mb-3">
                                    <img src="{{ asset('assets/images/company/' . $company->favicon_icon) }}"
                                            alt="Company Logo"
                                            style="max-width: 80px;">
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 form-group mb-2">
                            <span>Company Name<span class="text-danger">*</span></span>
                            <input type="text" class="form-control" name="company_name" value="{{ old('company_name',$company->company_name ?? '') }}">
                            <span class="text-danger">@error('company_name') {{ $message }} @enderror</span>
                        </div>

                        <div class="col-md-6 form-group mb-2">
                            <span>Phone<span class="text-danger">*</span></span>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone',$company->phone ?? '') }}">
                            <span class="text-danger">@error('phone') {{ $message }} @enderror</span>
                        </div>

                        <div class="col-md-6 form-group mb-2">
                            <span>Email<span class="text-danger">*</span></span>
                            <input type="text" class="form-control" name="email" value="{{ old('email',$company->email ?? '') }}">
                            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                        </div>

                        <div class="col-md-6 form-group mb-2">
                            <span>City<span class="text-danger">*</span></span>
                            <input type="text" class="form-control" name="city" value="{{ old('city',$company->city ?? '') }}">
                            <span class="text-danger">@error('aadhar') {{ $message }} @enderror</span>
                        </div>

                        <div class="col-md-6 form-group mb-2">
                            <span>State<span class="text-danger">*</span></span>
                            <input type="text" class="form-control" name="state" value="{{ old('state',$company->state ?? '') }}">
                            <span class="text-danger">@error('state') {{ $message }} @enderror</span>
                        </div>

                        <div class="col-md-6 form-group mb-2">
                            <span>Pincode<span class="text-danger">*</span></span>
                            <input type="text" class="form-control" name="pincode" value="{{ old('pincode',$company->pincode ?? '') }}">
                            <span class="text-danger">@error('pincode') {{ $message }} @enderror</span>
                        </div>

                        <div class="col-md-12 form-group mb-2">
                            <span>Address<span class="text-danger">*</span></span>
                            <input type="text" class="form-control" name="address" value="{{ old('address',$company->address ?? '') }}">
                            <span class="text-danger">@error('address') {{ $message }} @enderror</span>
                        </div>

                        <div class="col-md-6 form-group mb-2">
                            <span>PAN<span class="text-danger">*</span></span>
                            <input type="text" class="form-control" name="pan" value="{{ old('pan',$company->pan ?? '') }}">
                            <span class="text-danger">@error('pan') {{ $message }} @enderror</span>
                        </div>

                        <div class="col-md-6 form-group mb-2">
                            <span>GST<span class="text-danger">*</span></span>
                            <input type="text" class="form-control" name="gst" value="{{ old('gst',$company->gst ?? '') }}">
                            <span class="text-danger">@error('gst') {{ $message }} @enderror</span>
                        </div>

                        <div class="col-md-12 mt-3 form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">Change Password</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.change-password') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="">New Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control">
                        </div>
                        <div class="col-12 form-group mt-3">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
