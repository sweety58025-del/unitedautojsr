@extends('backend.partial.master')
@section('title', 'Dashboard')
@section('backend-content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><h4 class="m-0 card-title">Hero Banner</h4></div>
            <form action="{{ route('hero-banner.store') }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="banner_image" class="form-label">Banner Image</label>
                    <input type="file" name="banner_image" class="form-control" id="banner_image">
                    @if($hero_banner && $hero_banner->banner_image)
                        <img src="{{ asset($hero_banner->banner_image) }}" alt="Current Banner" class="mt-2" style="max-width: 200px;">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="sub_title" class="form-label">Sub Title</label>
                    <input type="text" name="sub_title" class="form-control" id="sub_title" value="{{ $hero_banner ? $hero_banner->sub_title : '' }}">
                </div>
                <div class="mb-3">
                    <label for="main_title" class="form-label">Main Title</label>
                    <input type="text" name="main_title" class="form-control" id="main_title" value="{{ $hero_banner ? $hero_banner->main_title : '' }}">
                </div>
                <div class="mb-3">
                    <label for="sort_paragraph" class="form-label">Sort Paragraph</label>
                    <textarea name="sort_paragraph" id="sort_paragraph" rows="4" class="form-control">{{ $hero_banner ? $hero_banner->sort_paragraph : '' }}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
