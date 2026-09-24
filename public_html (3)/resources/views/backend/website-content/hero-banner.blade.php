@extends('backend.partial.master')
@section('title', 'Dashboard')
@section('backend-content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><h4 class="m-0 card-title">Hero Banner</h4></div>
            <form action="{{ route('hero-banner.store') }}" method="post">
                @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Banner Image</label>
                    <p class="form-control-plaintext mb-0">Fixed asset: <code>public/front/assets/img/banner/1.png</code></p>
                    <img src="{{ asset('front/assets/img/banner/1.png') }}" alt="Current hero banner" class="mt-2" style="max-width: 200px;">
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
