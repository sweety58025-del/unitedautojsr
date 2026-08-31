@extends('backend.partial.master')
@section('main_title', 'Service')
@section('title', 'Brands')

@section('backend-content')

<div class="row">

<div class="col-md-4">

<div class="card">
<div class="card-header">
<h4>{{ isset($editBrand) ? 'Update Brand' : 'Add Brand' }}</h4>
</div>

<div class="card-body">

<form action="{{ isset($editBrand) ? route('brands.update',$editBrand->id) : route('brands.store') }}" 
method="POST" enctype="multipart/form-data">

@csrf

<div class="mb-3">
<label>Brand Name</label>

<input type="text" name="name" class="form-control"
value="{{ old('name', $editBrand->name ?? '') }}">

@error('name')
<span class="text-danger">{{ $message }}</span>
@enderror

</div>


<div class="mb-3">
<label>Brand Image</label>

<input type="file" name="image" class="form-control">

@if(isset($editBrand->image))
<br>
<img src="{{ asset($editBrand->image) }}" width="80">
@endif

</div>

<button class="btn btn-success">
{{ isset($editBrand) ? 'Update' : 'Save' }}
</button>

@if(isset($editBrand))
<a href="{{ route('brands.index') }}" class="btn btn-secondary">Cancel</a>
@endif

</form>

</div>
</div>

</div>


<div class="col-md-8">

<div class="card">
<div class="card-header">
<h4>Brand List</h4>
</div>

<div class="card-body">

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<table class="table table-bordered">

<thead>
<tr>
<th>#</th>
<th>Image</th>
<th>Name</th>
<th width="120">Action</th>
</tr>
</thead>

<tbody>

@foreach($brands as $key => $brand)

<tr>

<td>{{ $key+1 }}</td>

<td>
@if($brand->image)
<img src="{{ asset($brand->image) }}" width="60">
@endif
</td>

<td>{{ $brand->name }}</td>

<td>

<a href="{{ route('brands.edit',$brand->id) }}"
class="btn btn-warning btn-sm">Edit</a>

<form action="{{ route('brands.delete',$brand->id) }}"
method="POST" style="display:inline">

@csrf
@method('DELETE')

<button onclick="return confirm('Delete this brand?')"
class="btn btn-danger btn-sm">
Delete
</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>
</div>

</div>

</div>

@endsection