@extends('layout')

@php
	$module_name = 'jobsites';
@endphp

@section('title')
	{{ $jobsite->name }}
@endsection

@section('content')

<div class="content columns is-multiline">

	<div class="column is-full">
		<div class="columns">
			<div class="column is-narrow">
				<h2 class="title is-4">{{ $jobsite->name }}</h2>
				<h3 class="subtitle is-6"><a href="/organizations/{{ $jobsite->organization->id }}">{{ $jobsite->organization->name }}</a></h3>
			</div>
			<div class="column tags">
				@if($jobsite->acreage)
				<span class="tag is-warning">{{ $jobsite->acreage }} acres</span>
				@endif
				@if($jobsite->linear_feet)
				<span class="tag is-info">{{ $jobsite->linear_feet }} LF</span>
				@endif
			</div>
		</div>
	</div>
	
	<div class="column is-one-third is-full-mobile">
	
		<p class="title is-5">Services</p>
	
		@include('layouts.cards.services')

	</div>

	<div class="column is-two-thirds is-full-mobile">
		<p class="title is-5">
			Map
			<span class="is-size-6 is-uppercase has-text-weight-normal"><a href="/jobsites/{{ $jobsite->id }}/map/edit">Edit</a></span>
		</p>
		@if($jobsite->map)
			@php
			$map = $jobsite->map;
			@endphp
			@include('layouts.maps.readonly')
		@else
			<div class="content">
				Create a map
			</div>
		@endif

	</div>
	
</div>

@endsection

