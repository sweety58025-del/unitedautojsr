@extends('backend.partial.master')
@section('main_title', 'Product')
@section('title', 'Category')
@section('backend-content')
    <div class="row">
        @can('add-subcategory')
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h4>Add Category</h4>
                </div>
                <form class="form theme-form" method="post" action="{{ route('subcategory.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @if (session('message'))
                            {!! session('message') !!}
                        @endif
                        <div class="form-group mb-3">
                            <label class="form-label">Name</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
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
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Content</label>
                            <textarea class="form-control ckeditor" name="content" rows="4">{{ old('content') }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer text-end py-2">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        @endcan
        @can('show-subcategory')
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h4>Category List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-bordered dt-responsive nowrap"  id="responsive-datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Category Name</th>
                                    <th>Subcategory Name</th>
                                    <th>Content</th>
                                    @canany(['edit-subcategory','delete-subcategory'])
                                    <th>Action</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $key => $sub)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            @if($sub->image_name)
                                            <img src="{{ asset('front/assets/img/subcategory/'.$sub->image_name) }}" width="60">
                                            @endif
                                        </td>
                                        <td>{{ $sub->category->name ?? 'N/A' }}</td>
                                        <td>{{ $sub->name }}</td>
                                        <td>{!! $sub->content !!}</td>
                                        @canany(['edit-subcategory','delete-subcategory'])
                                        <td>
                                            @can('edit-subcategory')
                                            <a href="{{ route('subcategory.edit', $sub->id) }}" 
                                            class="btn btn-icon btn-sm bg-primary-subtle me-1">
                                                <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                            </a>
                                            @endcan

                                            @can('delete-subcategory')
                                            <form action="{{ route('subcategory.destroy', $sub->id) }}" 
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this data?')"
                                                    class="btn btn-icon btn-sm bg-danger-subtle">
                                                    <i class="mdi mdi-delete fs-14 text-danger"></i>
                                                </button>
                                            </form>
                                            @endcan
                                        </td>
                                        
                                        @endcanany
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>
@endsection
