@extends('backend.partial.master')
@section('main_title', 'Dashboard')
@section('title', 'Services')
@section('backend-content')
    
    <div class="row">
        @can('add-service')
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h4>Add Service</h4>
                </div>
                <form class="form theme-form" method="post" action="{{ route('services.store') }}">
                    @csrf
                    <div class="card-body row">
                        @if (session('message'))
                            {!! session('message') !!}
                        @endif
                        
                        <div class="form-group col-6 mb-3">
                            <label class="form-label">Category<span class="text-danger">*</span></label>
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

                        <div class="form-group col-6 mb-3">
                            <label class="form-label">Sub Category</label>
                            <select class="form-control" type="text" name="subcategory_id">
                                <option value="">--Select--</option>
                            </select>
                            <span class="text-danger">
                                @error('subcategory_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label class="form-label">Name<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-6 mb-3">
                            <label class="form-label">Price<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="price" value="{{ old('price') }}">
                            <span class="text-danger">
                                @error('price')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-12 mb-3">
                            <label class="form-label">Description</label>
                            
                            <textarea class="form-control ckeditor" name="notes" rows="5">{{ old('notes') }}</textarea>

                            <span class="text-danger">
                                @error('notes')
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
        @can('show-service')
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
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Subcategory Name</th>
                                    <th>Service Name</th>
                                    <th>Price</th>
                                    <th>Notes</th>
                                    @canany(['edit-service','delete-service'])
                                    <th>Action</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($services as $key => $service)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $service->category->name ?? '-' }}</td>
                                    <td>{{ $service->subcategory->name ?? '-' }}</td>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->price }}</td>
                                    <td>{!! $service->notes ?? '-' !!}</td>
                                    @canany(['edit-service','delete-service'])
                                    <td>
                                        <a href="{{ route('services.edit', $service->id) }}" 
                                        class="btn btn-icon btn-sm bg-primary-subtle me-1">
                                            <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                        </a>
                                        <form action="{{ route('services.destroy', $service->id) }}" 
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this service?')"
                                                class="btn btn-icon btn-sm bg-danger-subtle">
                                                <i class="mdi mdi-delete fs-14 text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                    @endcanany
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No Data Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>

<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script>
$(document).ready(function () {

    $('select[name="category_id"]').on('change', function () {

        let categoryId = $(this).val();

        // Clear old options
        $('select[name="subcategory_id"]').html('<option value="">--Select--</option>');

        if (categoryId) {
            $.ajax({
                url: "{{ url('/fetch-subcategory') }}/" + categoryId,
                type: 'GET',
                beforeSend: function () {
                    $('select[name="subcategory_id"]').html(
                        '<option value="">Please wait...</option>'
                    );
                },
                success: function (data) {
                    $('select[name="subcategory_id"]').html('<option value="">--Select--</option>');
                    $.each(data, function (key, subcat) {
                        $('select[name="subcategory_id"]').append(
                            '<option value="' + subcat.id + '">' + subcat.name + '</option>'
                        );
                    });
                }
            });
        }

    });

});
</script>
@endsection
