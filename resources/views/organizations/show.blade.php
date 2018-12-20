@extends('layout')

@section('module_name')
organizations
@endsection

@section('content')
	<h1 class="title">{{ $organization->name }}</h1>
	<div class="content columns">
		<div class="column">
			<div class="card">
				<div class="card-content">
					<p class="level-item">{{ $organization->address_line_1 }}</p>
					<p class="level-item">{{ $organization->address_line_2 }}</p>
					<p class="level-item">{{ $organization->city }}</p>
					<p class="level-item">{{ $organization->state}}</p>
					<p class="level-item">{{ $organization->postal_code}}</p>
					<p class="level-item">{{ $organization->country }}</p>
				</div>
				<footer class="card-footer">
					<p class="card-footer-item">
						<span>
							<a href="/organizations/{{ $organization->id }}/edit">Edit</a>
						</span<
					</p>
				</footer>
			</div>
		</div> <!-- level-left -->

		<div class="column">
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
		</div> <!-- level-right -->
	</div>

@endsection

