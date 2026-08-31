@extends('backend.partial.master')
@section('main_title', 'Product')
@section('title', 'Edit Category')
@section('backend-content')
    <div class="row">
        @can('edit-subcategory')
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h4>Edit Category</h4>
                </div>
                <form class="form theme-form" method="post" action="{{ route('subcategory.update',$cat_id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        @if (session('message'))
                            {!! session('message') !!}
                        @endif
                        <div class="form-group mb-3">
                            <label class="form-label">Name</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name',$subcategories->name ?? '') }}"
                                placeholder="">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-control" type="text" name="category_id">
                                <option value="">--Select--</option>
                            @foreach ($categories as $key => $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $subcategories->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                            </select>
                            <span class="text-danger">
                                @error('category_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Image</label>

                            <input class="form-control" type="file" name="image_name">

                            @if($subcategories->image_name)
                            <br>
                            <img src="{{ asset('front/assets/img/subcategory/'.$subcategories->image_name) }}" width="120">
                            @endif

                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Content</label>
                            <textarea class="form-control ckeditor" name="content" rows="4">
                                {{ old('content',$subcategories->content ?? '') }}
                            </textarea>
                        </div>
                    </div>
                    <div class="card-footer text-end py-2">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
        @endcan
    </div>
@endsection
