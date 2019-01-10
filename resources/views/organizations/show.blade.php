@extends('layout')

@php
	$module_name = 'organizations';
@endphp

@section('title', '{{ $organization->name }}')

@section('content')

<div class="content columns is-multiline">

	<div class="column is-full">
		<div class="columns">
			<div class="column is-narrow">
				<h2 class="title is-4">{{ $organization->name }}</h2>
				<h3 class="subtitle is-6">{{ $organization->address_line_1 }}, {{ $organization->city }}, {{ $organization->state }} {{ $organization->postal_code }} {{ $organization->country }}</a></h3>
			</div>
			<div class="column">
				{{-- tags, extras? --}}
			</div>
		</div>		
	</div>
	
	<div class="column is-one-third is-full-mobile">

		@include ('layouts.panels.organization_jobsites')

	</div> <!-- column 1 -->

	<div class="column is-two-thirds is-full-mobile">

		@include('layouts.panels.organization_contacts')

	</div> <!-- column 2 -->

	<div class="column is-full">

	</div>
	
</div>

@endsection

