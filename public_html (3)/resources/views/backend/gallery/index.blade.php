@extends('backend.partial.master')
@section('main_title', 'Product')
@section('title', 'Gallery')

@section('backend-content')

<div class="row">

<div class="col-md-4">

<div class="card">
<div class="card-header">
<h4>{{ isset($editGallery) ? 'Update Image' : 'Add Image' }}</h4>
</div>

<div class="card-body">

<form action="{{ isset($editGallery) ? route('gallery.update',$editGallery->id) : route('gallery.store') }}" 
method="POST" enctype="multipart/form-data">

@csrf

<div class="mb-3">
<label>Name</label>

<input type="text" name="name" class="form-control"
value="{{ old('name',$editGallery->name ?? '') }}">

@error('name')
<span class="text-danger">{{ $message }}</span>
@enderror

</div>


<div class="mb-3">
<label>Image</label>

<input type="file" name="image" class="form-control">

@if(isset($editGallery->image))
<br>
<img src="{{ asset($editGallery->image) }}" width="100">
@endif

@error('image')
<span class="text-danger">{{ $message }}</span>
@enderror

</div>

<button class="btn btn-success">
{{ isset($editGallery) ? 'Update' : 'Save' }}
</button>

@if(isset($editGallery))
<a href="{{ route('gallery.index') }}" class="btn btn-secondary">Cancel</a>
@endif

</form>

</div>
</div>

</div>



<div class="col-md-8">

<div class="card">
<div class="card-header">
<h4>Gallery List</h4>
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

@foreach($galleries as $key => $gallery)

<tr>

<td>{{ $key+1 }}</td>

<td>
<img src="{{ asset($gallery->image) }}" width="80">
</td>

<td>{{ $gallery->name }}</td>

<td>

<a href="{{ route('gallery.edit',$gallery->id) }}"
class="btn btn-warning btn-sm">
Edit
</a>

<form action="{{ route('gallery.delete',$gallery->id) }}"
method="POST" style="display:inline">

@csrf
@method('DELETE')

<button onclick="return confirm('Delete this image?')"
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