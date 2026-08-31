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

                                <a href="{{ route('testimonial.delete',$item->id) }}"
                                    onclick="return confirm('Delete this record?')"
                                    class="btn btn-sm btn-danger">
                                    Delete
                                </a>

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