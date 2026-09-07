@extends('backend.partial.master')
@section('main_title', 'Website Content')
@section('title', 'Testimonial')
@section('backend-content')

<div class="row">

    {{-- Form --}}
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>{{ isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial' }}</h5>
            </div>

            <div class="card-body">

                <form method="POST"
                    action="{{ isset($testimonial) ? route('testimonial.update',$testimonial->id) : route('testimonial.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label>User Name</label>
                        <input type="text" name="username" class="form-control"
                            value="{{ $testimonial->username ?? old('username') }}">
                    </div>

                    <div class="mb-3">
                        <label>Feedback</label>
                        <textarea name="feedback" class="form-control" rows="4">{{ $testimonial->feedback ?? old('feedback') }}</textarea>
                    </div>

                    <div class="mb-3"><label>Customer name (public)</label><input type="text" name="customer_name" class="form-control" value="{{ $testimonial->customer_name ?? old('customer_name') }}"></div>
                    <div class="mb-3"><label>Vehicle</label><input type="text" name="vehicle" class="form-control" value="{{ $testimonial->vehicle ?? old('vehicle') }}"></div>
                    <div class="mb-3"><label>Vehicle brand</label><input type="text" name="vehicle_brand" class="form-control" value="{{ $testimonial->vehicle_brand ?? old('vehicle_brand') }}"></div>
                    <div class="mb-3"><label>Public review</label><textarea name="review" class="form-control" rows="3">{{ $testimonial->review ?? old('review') }}</textarea></div>
                    <div class="row"><div class="col-4 mb-3"><label>Rating</label><input type="number" min="1" max="5" name="rating" class="form-control" value="{{ $testimonial->rating ?? old('rating') }}"></div><div class="col-4 mb-3"><label>Status</label><select name="status" class="form-control"><option value="yes" @selected(old('status', $testimonial->status ?? 'yes') === 'yes')>Active</option><option value="no" @selected(old('status', $testimonial->status ?? '') === 'no')>Inactive</option></select></div><div class="col-4 mb-3"><label>Sort order</label><input type="number" min="0" name="sort_order" class="form-control" value="{{ $testimonial->sort_order ?? old('sort_order', 0) }}"></div></div>
                    <div class="mb-3"><label>Customer image</label><input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">@if(!empty($testimonial?->image))<img src="{{ asset($testimonial->image) }}" alt="Customer" width="70" class="mt-2">@endif</div>

                    <button class="btn btn-primary">
                        {{ isset($testimonial) ? 'Update' : 'Submit' }}
                    </button>

                </form>

            </div>
        </div>
    </div>


    {{-- Data Table --}}
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Testimonial List</h5>
            </div>

            <div class="card-body table-responsive">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>Feedback</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($testimonials as $key => $item)

                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->feedback }}</td>

                            <td>

                                <a href="{{ route('testimonial.edit',$item->id) }}"
                                    class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('testimonial.delete',$item->id) }}" class="d-inline" onsubmit="return confirm('Delete this record?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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