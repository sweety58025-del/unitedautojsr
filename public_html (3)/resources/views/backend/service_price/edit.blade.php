@extends('backend.partial.master')
@section('main_title', 'Product')
@section('title', 'Edit Service Price')

@section('backend-content')

<div class="card">
<div class="card-header">
<h4>Edit Service Price</h4>
</div>

<div class="card-body">

<form action="{{ route('service-price.update',$service->id) }}" method="POST">

@csrf
@method('PUT')

<div class="row">

<div class="col-md-6 mb-3">
<label>Item</label>
<input type="text" name="item" class="form-control"
value="{{ old('item',$service->item) }}">
@error('item') <span class="text-danger">{{ $message }}</span> @enderror
</div>

<div class="col-md-3 mb-3">
<label>Small Car Price</label>
<input type="text" name="small_car_price" class="form-control"
value="{{ old('small_car_price',$service->small_car_price) }}">
</div>

<div class="col-md-3 mb-3">
<label>Medium Price</label>
<input type="text" name="medium_price" class="form-control"
value="{{ old('medium_price',$service->medium_price) }}">
</div>

<div class="col-md-3 mb-3">
<label>SUV / MUV Price</label>
<input type="text" name="suv_muv_price" class="form-control"
value="{{ old('suv_muv_price',$service->suv_muv_price) }}">
</div>

<div class="col-md-3 mb-3">
<label>Premium Price</label>
<input type="text" name="premium_price" class="form-control"
value="{{ old('premium_price',$service->premium_price) }}">
</div>

</div>

<button class="btn btn-primary">Update</button>
<a href="{{ route('service-price.index') }}" class="btn btn-secondary">Back</a>

</form>

</div>
</div>

@endsection