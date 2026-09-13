@extends('backend.partial.master')
@section('main_title', 'Website Content')
@section('title', 'Articles')
@section('backend-content')
<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header"><h4>{{ isset($article) ? 'Edit Article' : 'Add Article' }}</h4></div>
            <form method="POST" enctype="multipart/form-data" action="{{ isset($article) ? route('articles.admin.update', $article) : route('articles.admin.store') }}">
                @csrf
                @if(isset($article)) @method('PUT') @endif
                <div class="card-body">
                    <div class="mb-3"><label>Title</label><input class="form-control" name="title" required value="{{ old('title', $article->title ?? '') }}"></div>
                    <div class="mb-3"><label>Excerpt</label><textarea class="form-control" name="excerpt" rows="3">{{ old('excerpt', $article->excerpt ?? '') }}</textarea></div>
                    <div class="mb-3"><label>Article content</label><textarea class="form-control" name="content" rows="9" required>{{ old('content', $article->content ?? '') }}</textarea></div>
                    <div class="mb-3"><label>Featured image</label><input class="form-control" type="file" name="image" accept="image/jpeg,image/png,image/webp">@if(isset($article) && $article->image)<small class="text-muted">Current image: {{ $article->image }}</small>@endif</div>
                    <div class="row"><div class="col-md-6 mb-3"><label>Status</label><select class="form-control" name="status"><option value="yes" @selected(old('status', $article->status ?? 'yes') === 'yes')>Published</option><option value="no" @selected(old('status', $article->status ?? '') === 'no')>Draft</option></select></div><div class="col-md-6 mb-3"><label>Publish date</label><input class="form-control" type="date" name="published_at" value="{{ old('published_at', isset($article) && $article->published_at ? $article->published_at->format('Y-m-d') : now()->format('Y-m-d')) }}"></div></div>
                </div>
                <div class="card-footer text-end"><button class="btn btn-primary">{{ isset($article) ? 'Update' : 'Save' }}</button>@if(isset($article)) <a class="btn btn-secondary" href="{{ route('articles.admin.index') }}">Cancel</a>@endif</div>
            </form>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card"><div class="card-header"><h4>Article List</h4></div><div class="card-body table-responsive">
            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            @if($errors->any())<div class="alert alert-danger">Please correct the highlighted article fields.</div>@endif
            <table class="table table-bordered"><thead><tr><th>Article</th><th>Status</th><th>Actions</th></tr></thead><tbody>
            @forelse($articles as $item)<tr><td><strong>{{ $item->title }}</strong><br><small>{{ $item->published_at?->format('d M Y') }}</small></td><td>{{ $item->status === 'yes' ? 'Published' : 'Draft' }}</td><td><a class="btn btn-sm btn-info" target="_blank" href="{{ route('articles.show', $item) }}">View</a> <a class="btn btn-sm btn-warning" href="{{ route('articles.admin.edit', $item) }}">Edit</a> <form class="d-inline" method="POST" action="{{ route('articles.admin.destroy', $item) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-danger" onclick="return confirm('Delete this article?')">Delete</button></form></td></tr>@empty<tr><td colspan="3" class="text-center text-muted">No articles found.</td></tr>@endforelse
            </tbody></table>
        </div></div>
    </div>
</div>
@endsection