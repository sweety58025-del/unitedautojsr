@extends('backend.partial.master')
@section('main_title', 'Service')
@section('title', 'Service')
@section('backend-content')
    <div class="row">
        @can('add-category')
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h4>Add Service</h4>
                </div>
                <form class="form theme-form" method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @if (session('message'))
                            {!! session('message') !!}
                        @endif
                        <div class="form-group mb-3">
                            <label class="form-label">Name</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}"
                                placeholder="">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" type="text" name="description" rows="5">{{ old('description') }}</textarea>
                            <span class="text-danger">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Image</label>
                            <input class="form-control" type="file" name="category_image">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="yes" {{ old('status') == 'yes' ? 'selected' : '' }}>yes</option>
                                <option value="no"  {{ old('status') == 'no'  ? 'selected' : '' }}>no</option>
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
        @can('show-category')
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h4>Service List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-bordered dt-responsive nowrap"  id="responsive-datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <td>Image</td>
                                    <th scope="col">Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    @canany(['edit-category', 'delete-category'])
                                    <th scope="col" id="no-export">Action</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            @if($category->category_image)
                                                <img src="{{ asset('assets/category/' . $category->category_image) }}"
                                                    alt="{{ $category->name }}"
                                                    width="40"
                                                    class="img-thumbnail">
                                            @else
                                                <img src="{{ asset('assets/no_product.png') }}" alt="" width="40px">
                                            @endif
                                        </td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ \Illuminate\Support\Str::words($category->description, 5, '...') }}</td>
                                        <td>{{ $category->status }}</td>
                                        @canany(['edit-category', 'delete-category'])
                                        <td>
                                            @can('edit-category')
                                            <a href="{{ route('category.edit', $category->id) }}" 
                                            class="btn btn-icon btn-sm bg-primary-subtle me-1">
                                                <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                            </a>
                                            @endcan

                                            @can('delete-category')
                                            <form action="{{ route('category.destroy', $category->id) }}" 
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this category?')"
                                                    class="btn btn-icon btn-sm bg-danger-subtle">
                                                    <i class="mdi mdi-delete fs-14 text-danger"></i>
                                                </button>
                                            </form>
                                            @endcan
                                        </td>
                                       @endcanany

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
