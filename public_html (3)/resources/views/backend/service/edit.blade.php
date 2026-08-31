@extends('backend.partial.master')
@section('main_title', 'Services')
@section('title', 'Edit')
@section('backend-content')
    <div class="row">
        @can('edit-service')
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h4>Edit Service</h4>
                </div>
                <form class="form theme-form" method="post" action="{{ route('services.update',$service->id) }}">
                    @csrf
                    @method('put')
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
                                   {{ old('category_id', $service->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                                @foreach ($subcategories as $subcat)
                                    <option value="{{ $subcat->id }}"
                                        {{ old('subcategory_id', $service->sub_category_id ?? '') == $subcat->id ? 'selected' : '' }}>
                                        {{ $subcat->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                @error('subcategory_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label class="form-label">Name<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" value="{{ old('name',$service->name ?? '') }}">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-6 mb-3">
                            <label class="form-label">Price<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="price" value="{{ old('price',$service->price ?? '') }}">
                            <span class="text-danger">
                                @error('price')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-12 mb-3">
                            <label class="form-label">Description</label>
                            
                            <textarea class="form-control ckeditor" name="notes" rows="5">{{ old('notes',$service->notes) }}</textarea>

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
    </div>

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
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
