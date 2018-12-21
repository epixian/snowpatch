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
				<a class="panel-block">
					<span class="panel-icon">
						<i class="{{ $jobsite->type == 'residential' ? 'fas fa-map' : 'far fa-building' }}" aria-hidden="true"></i>
					</span>
					{{ $jobsite->name }}
				</a>
				@endforeach
				
				@else
				<div class="panel-block">
					<a class="button is-success" href="/jobsites/create">New Jobsite</a>
				</div>
				@endif
				
			</section>