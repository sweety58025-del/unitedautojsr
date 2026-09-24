@extends('backend.partial.master')
@section('title', 'Homepage Popup')
@section('backend-content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header"><h5 class="m-0">Homepage Popup Image</h5></div>
            <form action="{{ route('website_content.popup.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @if(session('message')){!! session('message') !!}@endif
                    @if($errors->any())
                        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
                    @endif
                    <p class="text-muted">Upload a new image to replace the popup shown on the homepage. Delete it to hide the popup.</p>
                    @if($popupImage)
                        <div class="mb-3">
                            <img src="{{ asset($popupImage) }}" alt="Current homepage popup" style="max-width: 320px; max-height: 320px; object-fit: contain;">
                        </div>
                        <label class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="delete_popup_image" value="1">
                            <span class="form-check-label">Delete current popup image</span>
                        </label>
                    @else
                        <div class="alert alert-secondary">No popup image is currently active.</div>
                    @endif
                    <label for="popup_image" class="form-label">Popup image</label>
                    <input type="file" class="form-control" name="popup_image" id="popup_image" accept="image/jpeg,image/png,image/webp">
                    <small class="text-muted">JPG, PNG, or WebP, maximum 4 MB.</small>
                </div>
                <div class="card-footer"><button type="submit" class="btn btn-primary">Save Popup Image</button></div>
            </form>
        </div>
    </div>
</div>
@endsection
