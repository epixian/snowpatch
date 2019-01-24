@extends('layout')

@php
	$module_name = 'maps';
@endphp

@section('title')
	{{ $map->name }}
@endsection

@section('content')

<div class="content columns is-multiline">

	<div class="column is-full">
		<div class="columns">
			<div class="column is-narrow">
				<h2 class="title is-4">{{ $map->jobsite->name }}</h2>
				<h3 class="subtitle is-6"><a href="/organizations/{{ $map->jobsite->organization->id }}">{{ $map->jobsite->organization->name }}</a></h3>
			</div>
			<div class="column tags">
				@if($map->jobsite->acreage)
				<span class="tag is-warning">{{ $map->jobsite->acreage }} acres</span>
				@endif
				@if($map->jobsite->linear_feet)
				<span class="tag is-info">{{ $map->jobsite->linear_feet }} LF</span>
				@endif
			</div>
		</div>
	</div>
	
	<div class="column">
		<p class="title is-5">Map</p>
	
		@include('layouts.maps.editable')

	</div>
	
</div>

@endsection