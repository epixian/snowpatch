<section class="panel">
	<p class="panel-heading">
		Jobsites
	</p>
	@if ($organization->jobsites->count())
	<p class="panel-tabs">
		<a class="is-active">all</a>
		<a>active</a>
		<a>inactive</a>
		<a>pending</a>
	</p>
	
	@foreach ($organization->jobsites as $jobsite)
	<a class="panel-block" href="/jobsites/{{ $jobsite->id }}">
		<span class="panel-icon">
		@switch($jobsite->type)
			@case(1)
				<i class="fas fa-home"></i>
				@break
			@case(2)
				<i class="far fa-building"></i>
				@break
			@case(3)
				<i class="fas fa-university"></i>
				@break
			@case(4)
				<i class="far fa-hospital"></i>
				@break
			@case(5)
				<i class="fas fa-place-of-worship"></i>
				@break
			@default
				<i class="far fa-question-circle"></i>
		@endswitch
		</span>
		{{ $jobsite->name }}
	</a>
	@endforeach
	
	@endif
	
	<div class="panel-block">
		<a class="button is-success" href="/jobsites/create?organization={{ $organization->id }}">New Jobsite</a>
	</div>
	
</section>