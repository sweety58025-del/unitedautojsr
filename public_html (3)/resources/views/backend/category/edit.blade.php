@extends('backend.partial.master')
@section('main_title', 'Product')
@section('title', 'Edit Service')
@section('backend-content')
    <div class="row">
        @can('edit-category')
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h4>Edit Service</h4>
                </div>
                <form class="form theme-form" method="POST" action="{{ route('category.update', $cat_id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @if (session('message'))
                            {!! session('message') !!}
                        @endif
                        <div class="form-group mb-3">
                            <label class="form-label">Name</label>
                            <input class="form-control" type="text" name="name"
                                value="{{ old('name', $categories->name ?? '') }}" placeholder="">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" type="text" name="description" rows="5">{{ old('description', $categories->description ?? '') }}</textarea>
                            <span class="text-danger">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Image</label>
                            <input class="form-control" type="file" name="category_image">
                             @if($categories->category_image)
                                <img src="{{ asset('assets/category/' . $categories->category_image) }}"
                                    alt="{{ $categories->name }}"
                                    width="40"
                                    class="img-thumbnail">
                            @else
                                <img src="{{ asset('assets/no_product.png') }}" alt="" width="40px">
                            @endif
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="yes" {{ old('status', $categories->status ?? '') == 'yes' ? 'selected' : '' }}>yes</option>
                                <option value="no" {{ old('status', $categories->status ?? '') == 'no' ? 'selected' : '' }}>no</option>
                            </select>
                            <span class="text-danger">
                                @error('status')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="card-footer text-end py-2">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        @endcan
    </div>
@endsection
