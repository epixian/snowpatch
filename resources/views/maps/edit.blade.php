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

			</div>
		</div>
	</div>
	
	<div class="column is-full">
		<form method="POST" action="/jobsites/{{ $map->jobsite->id }}/map">
			@if ($errors->any())	
			<div class="notification is-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			@method('PATCH')
			@csrf	

			@include('layouts.maps.editable')

		</form>	

	</div>
	
</div>

@endsection