@extends('backend.partial.master')
@section('title', $pageLabel)
@section('backend-content')
<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header"><h5 class="m-0">Website Pages</h5></div>
            <div class="list-group list-group-flush">
                @foreach($pages as $key => $label)
                    <a class="list-group-item list-group-item-action {{ $page === $key ? 'active' : '' }}" href="{{ route('page-content.edit', $key) }}">{{ $label }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header"><h5 class="m-0">Edit {{ $pageLabel }}</h5></div>
            <form method="POST" enctype="multipart/form-data" action="{{ route('page-content.update', $page) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                    @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label">Eyebrow</label><input class="form-control" name="eyebrow" value="{{ old('eyebrow', $content->eyebrow) }}"></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Page title</label><input class="form-control" name="title" required value="{{ old('title', $content->title) }}"></div>
                        <div class="col-12 mb-3"><label class="form-label">Intro</label><textarea class="form-control" name="intro" rows="3">{{ old('intro', $content->intro) }}</textarea></div>
                        @if($page === 'home')
                            <div class="col-12"><hr><h6>Hero and homepage sections</h6><p class="text-muted mb-3">Update one item per line. Use <code>label|value</code> for two-part entries and <code>image|title|description</code> for showcase entries.</p></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Hero trust points</label><textarea class="form-control" name="trust_items" rows="5">{{ old('trust_items', implode("\n", $content->trust_items)) }}</textarea></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Hero statistics</label><textarea class="form-control" name="hero_stats" rows="5">{{ old('hero_stats', collect($content->hero_stats)->map(fn ($item) => implode('|', $item))->implode("\n")) }}</textarea></div>
                            <div class="col-12 mb-3"><label class="form-label">Frequently asked questions</label><textarea class="form-control" name="faq_items" rows="7">{{ old('faq_items', collect($content->faq_items)->map(fn ($item) => implode('|', $item))->implode("\n")) }}</textarea></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Why choose us cards</label><textarea class="form-control" name="why_choose_items" rows="7">{{ old('why_choose_items', collect($content->why_choose_items)->map(fn ($item) => implode('|', $item))->implode("\n")) }}</textarea></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Homepage showcase stories</label><textarea class="form-control" name="showcase_items" rows="7">{{ old('showcase_items', collect($content->showcase_items)->map(fn ($item) => implode('|', $item))->implode("\n")) }}</textarea></div>
                        @endif
                        <div class="col-12 mb-3"><label class="form-label">Main body</label><textarea class="form-control" name="body" rows="6">{{ old('body', $content->body) }}</textarea></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Section one title</label><input class="form-control" name="section_one_title" value="{{ old('section_one_title', $content->section_one_title) }}"></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Section two title</label><input class="form-control" name="section_two_title" value="{{ old('section_two_title', $content->section_two_title) }}"></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Section one body</label><textarea class="form-control" name="section_one_body" rows="5">{{ old('section_one_body', $content->section_one_body) }}</textarea></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Section two body</label><textarea class="form-control" name="section_two_body" rows="5">{{ old('section_two_body', $content->section_two_body) }}</textarea></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Section three title</label><input class="form-control" name="section_three_title" value="{{ old('section_three_title', $content->section_three_title) }}"></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Section four title</label><input class="form-control" name="section_four_title" value="{{ old('section_four_title', $content->section_four_title) }}"></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Section three items/body</label><textarea class="form-control" name="section_three_body" rows="5">{{ old('section_three_body', $content->section_three_body) }}</textarea></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Section four items/body</label><textarea class="form-control" name="section_four_body" rows="5">{{ old('section_four_body', $content->section_four_body) }}</textarea></div>
                        <div class="col-12 mb-3"><label class="form-label">List items</label><textarea class="form-control" name="list_items" rows="7">{{ old('list_items', implode("\n", $content->list_items)) }}</textarea><small class="text-muted">Enter one item per line.</small></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Working hours title</label><input class="form-control" name="hours_title" value="{{ old('hours_title', $content->hours_title) }}"><label class="form-label mt-2">Working hours</label><textarea class="form-control" name="hours_items" rows="4">{{ old('hours_items', implode("\n", $content->hours_items)) }}</textarea><small class="text-muted">One label|value per line.</small></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Pricing title</label><input class="form-control" name="pricing_title" value="{{ old('pricing_title', $content->pricing_title) }}"><label class="form-label mt-2">Pricing rows</label><textarea class="form-control" name="pricing_items" rows="4">{{ old('pricing_items', implode("\n", $content->pricing_items)) }}</textarea><small class="text-muted">One distance|charge per line.</small></div>
                        <div class="col-md-6 mb-3"><label class="form-label">SEO title</label><input class="form-control" name="meta_title" value="{{ old('meta_title', $content->meta_title) }}"></div>
                        <div class="col-md-6 mb-3"><label class="form-label">SEO description</label><textarea class="form-control" name="meta_description" rows="2">{{ old('meta_description', $content->meta_description) }}</textarea></div>
                        <div class="col-12 mb-3"><label class="form-label">Page image</label><input class="form-control" type="file" name="image" accept="image/jpeg,image/png,image/webp">@if($content->image)<img class="mt-2" src="{{ asset($content->image) }}" alt="" style="max-width:180px">@endif</div>
                    </div>
                </div>
                <div class="card-footer text-end"><button class="btn btn-primary">Save page content</button></div>
            </form>
        </div>
    </div>
</div>
@endsection
