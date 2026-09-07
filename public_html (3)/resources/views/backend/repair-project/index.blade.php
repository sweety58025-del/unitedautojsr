@extends('backend.partial.master')
@section('main_title', 'Website Content')
@section('title', 'Repair Projects')
@section('backend-content')
<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header"><h4>{{ isset($project) ? 'Edit Repair Project' : 'Add Repair Project' }}</h4></div>
            <form method="POST" enctype="multipart/form-data" action="{{ isset($project) ? route('repair-projects.update', $project) : route('repair-projects.store') }}">
                @csrf
                @if(isset($project)) @method('PUT') @endif
                <div class="card-body">
                    @foreach(['title' => 'Project title', 'vehicle_name' => 'Vehicle name', 'vehicle_model' => 'Vehicle model'] as $field => $label)
                        <div class="mb-3"><label>{{ $label }}</label><input class="form-control" name="{{ $field }}" value="{{ old($field, $project->$field ?? '') }}" {{ $field !== 'vehicle_model' ? 'required' : '' }}></div>
                    @endforeach
                    <div class="mb-3"><label>Brand</label><select class="form-control" name="brand_id"><option value="">-- Select --</option>@foreach($brands as $brand)<option value="{{ $brand->id }}" @selected(old('brand_id', $project->brand_id ?? '') == $brand->id)>{{ $brand->name }}</option>@endforeach</select></div>
                    <div class="mb-3"><label>Description</label><textarea class="form-control" name="description" rows="4">{{ old('description', $project->description ?? '') }}</textarea></div>
                    <div class="row"><div class="col-6 mb-3"><label>Status</label><select class="form-control" name="status"><option value="yes" @selected(old('status', $project->status ?? 'yes') === 'yes')>Active</option><option value="no" @selected(old('status', $project->status ?? '') === 'no')>Inactive</option></select></div><div class="col-6 mb-3"><label>Sort order</label><input class="form-control" type="number" min="0" name="sort_order" value="{{ old('sort_order', $project->sort_order ?? 0) }}"></div></div>
                    <div class="form-check mb-3"><input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" @checked(old('is_featured', $project->is_featured ?? false))><label class="form-check-label" for="is_featured">Featured project</label></div>
                    @foreach(['before' => 'Before images', 'during' => 'During images', 'after' => 'After images'] as $stage => $label)
                        <div class="mb-3"><label>{{ $label }}</label><input class="form-control" type="file" name="images[{{ $stage }}][]" multiple accept="image/jpeg,image/png,image/webp"></div>
                    @endforeach
                </div>
                <div class="card-footer text-end"><button class="btn btn-primary">{{ isset($project) ? 'Update' : 'Save' }}</button>@if(isset($project)) <a class="btn btn-secondary" href="{{ route('repair-projects.index') }}">Cancel</a>@endif</div>
            </form>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card"><div class="card-header"><h4>Repair Project List</h4></div><div class="card-body table-responsive">
            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            <table class="table table-bordered"><thead><tr><th>Project</th><th>Stages</th><th>Status</th><th>Actions</th></tr></thead><tbody>
            @forelse($projects as $item)<tr><td><strong>{{ $item->title }}</strong><br><small>{{ $item->vehicle_name }}{{ $item->vehicle_model ? ' / '.$item->vehicle_model : '' }}</small></td><td>@foreach(['before','during','after'] as $stage)<span class="badge bg-light text-dark me-1">{{ ucfirst($stage) }}: {{ $item->images->where('stage', $stage)->count() }}</span>@endforeach</td><td>{{ $item->status === 'yes' ? 'Active' : 'Inactive' }}</td><td><a class="btn btn-sm btn-warning" href="{{ route('repair-projects.edit', $item) }}">Edit</a><form class="d-inline" method="POST" action="{{ route('repair-projects.destroy', $item) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-danger" onclick="return confirm('Delete this repair project and its images?')">Delete</button></form></td></tr>@empty<tr><td colspan="4" class="text-center text-muted">No repair projects found.</td></tr>@endforelse
            </tbody></table>
        </div></div>
        @if(isset($project))
            <div class="card"><div class="card-header"><h4>Project Images</h4></div><div class="card-body">
                @foreach(['before','during','after'] as $stage)<h5 class="mt-2">{{ ucfirst($stage) }}</h5><div class="row">@forelse($project->images->where('stage', $stage) as $image)<div class="col-md-4 mb-3"><img src="{{ $image->url }}" class="img-fluid mb-2" alt="{{ $image->caption ?: $project->title.' '.$stage }}"><form method="POST" action="{{ route('repair-project-images.reorder', $image) }}" class="mb-2">@csrf @method('PATCH')<label class="small">Order</label><div class="input-group"><input class="form-control form-control-sm" type="number" min="0" name="sort_order" value="{{ $image->sort_order }}"><button class="btn btn-sm btn-outline-secondary">Save</button></div></form><form method="POST" action="{{ route('repair-project-images.destroy', $image) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-danger" onclick="return confirm('Delete this image?')">Remove</button></form></div>@empty<p class="text-muted">No {{ $stage }} images.</p>@endforelse</div>@endforeach
            </div></div>
        @endif
    </div>
</div>
@endsection
