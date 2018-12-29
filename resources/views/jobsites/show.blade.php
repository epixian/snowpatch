@extends('layout')

@section('module_name', 'jobsites')

@section('title')
	{{ $jobsite->name }}
@endsection

@section('content')

<div class="content columns is-multiline">

	<div class="column is-full">
		<h2 class="title is-4">{{ $jobsite->name }}</h2>
		<h3 class="subtitle is-6"><a href="/organizations/{{ $jobsite->organization->id }}">{{ $jobsite->organization->name }}</a></h3>
	</div>
	
	<div class="column is-one-third is-full-mobile">
	
		<p class="title is-5">Jobsite</p>
	
		@include('layouts.cards.jobsite_info')
		
		<p class="title is-5">Services</p>
	
		@include('layouts.cards.services')

	</div>

	<div class="column is-two-thirds is-full-mobile">
		<p class="title is-5">Map</p>
	
		@include('layouts.cards.map')

	</div>
	
</div>

@endsection

