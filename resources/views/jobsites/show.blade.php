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
			<div class="column">
				@if($jobsite->acreage)
				<span class="tag is-warning">{{ $jobsite->acreage }} acres</span>
				@endif
				@if($jobsite->linear_feet)
				<span class="tag is-info">{{ $jobsite->linear_feet }} LF</span>
				@endif
			</div>
		</div>
	</div>
	
	<div class="column is-half is-full-mobile">
	
		<p class="title is-5">Services</p>
	
		@include('layouts.cards.services')

	</div>

	<div class="column is-half is-full-mobile">
		<p class="title is-5">Map</p>
	
		@include('layouts.cards.map')

	</div>
	
</div>

@endsection

