<div class="content card">
	<div class="card-content tags">
		@if($jobsite->acreage)
		<span class="tag is-warning">{{ $jobsite->acreage }} acres</span>
		@endif
		@if($jobsite->linear_feet)
		<span class="tag is-info">{{ $jobsite->linear_feet }} LF</span>
		@endif
	</div> <!-- card content -->
</div> <!-- card -->