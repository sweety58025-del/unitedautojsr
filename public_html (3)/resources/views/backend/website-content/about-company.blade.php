@extends('backend.partial.master')
@section('title', 'Dashboard')
@section('backend-content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><h4 class="card-title m-0">Website Content</h4></div>
            <form action="{{ route('about_website.store') }}" method="post" enctype="multipart/form-data"> @csrf
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="about_title">About Title</label>
                        <input type="text" class="form-control" name="about_title" id="about_title" value="{{ $about_website->about_title ?? '' }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="short_description">Short Description</label>
                        <textarea class="form-control" name="short_description" id="short_description">{{ $about_website->short_description ?? '' }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="description">Description</label>
                        <textarea class="form-control ckeditor" name="description" id="description">{{ $about_website->description ?? '' }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="about_image">About Image</label>
                        <input type="file" class="form-control" name="about_image" id="about_image">
                        @if ($about_website && $about_website->about_image)
                            <img src="{{ asset($about_website->about_image) }}" alt="" class="img-thumbnail mt-2" style="max-width: 200px;">
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="mission">Mission</label>
                        <textarea class="form-control" name="mission" id="mission">{{ $about_website->mission ?? '' }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="vision">Vision</label>
                        <textarea class="form-control" name="vision" id="vision">{{ $about_website->vision ?? '' }}</textarea>
                    </div>
                </div>

                <h4 class="text-danger my-4">Why Choose Us</h4>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title_1">Title 1</label>
                        <input type="text" class="form-control" name="why_choose_title_1" id="why_choose_title_1" value="{{ $about_website->why_choose_title_1 ?? '' }}">

                        <label for="why_choose_content_1">Content 1</label>
                        <textarea class="form-control" name="why_choose_content_1" id="why_choose_content_1">{{ $about_website->why_choose_content_1 ?? '' }}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="title_2">Title 2</label>
                        <input type="text" class="form-control" name="why_choose_title_2" id="why_choose_title_2" value="{{ $about_website->why_choose_title_2 ?? '' }}">

                        <label for="why_choose_content_2">Content 2</label>
                        <textarea class="form-control" name="why_choose_content_2" id="why_choose_content_2">{{ $about_website->why_choose_content_2 ?? '' }}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="title_3">Title 3</label>
                        <input type="text" class="form-control" name="why_choose_title_3" id="why_choose_title_3" value="{{ $about_website->why_choose_title_3 ?? '' }}">

                        <label for="why_choose_content_3">Content 3</label>
                        <textarea class="form-control" name="why_choose_content_3" id="why_choose_content_3">{{ $about_website->why_choose_content_3 ?? '' }}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="title_4">Title 4</label>
                        <input type="text" class="form-control" name="why_choose_title_4" id="why_choose_title_4" value="{{ $about_website->why_choose_title_4 ?? '' }}">

                        <label for="why_choose_content_4">Content 4</label>
                        <textarea class="form-control" name="why_choose_content_4" id="why_choose_content_4">{{ $about_website->why_choose_content_4 ?? '' }}</textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="service_terms">Service T&C</label>
                        <textarea class="form-control ckeditor" name="service_terms" id="service_terms">{{ $about_website->service_terms ?? '' }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
