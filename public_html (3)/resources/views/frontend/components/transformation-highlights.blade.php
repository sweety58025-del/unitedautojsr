@php
	$highlightProjects = ($repairProjects ?? collect())->where('is_featured', true)->take(3);
@endphp

@if($highlightProjects->isNotEmpty())
<section class="section transformation-highlights" aria-labelledby="transformation-highlights-title">
	<div class="container">
		<div class="work-header">
			<div class="work-header-main"><h2 id="transformation-highlights-title">Featured transformations</h2></div>
			<div class="work-header-side"><p>Explore selected vehicle projects from the United Auto workshop.</p></div>
		</div>
		<div class="row">
			@foreach($highlightProjects as $project)
				@php($cover = $project->images->where('stage', 'after')->first() ?: $project->images->first())
				<div class="col-lg-4 col-md-6 mb-4">
					<a class="gallery-item achievement-card d-block h-100" href="{{ route('gallery') }}#our-work">
						@if($cover)<img src="{{ asset($cover->image) }}" alt="{{ $cover->caption ?: $project->title }}" loading="lazy">@endif
						<div class="achievement-body"><p class="achievement-eyebrow">{{ $project->vehicle_name }}</p><h4>{{ $project->title }}</h4></div>
					</a>
				</div>
			@endforeach
		</div>
	</div>
</section>
@endif

