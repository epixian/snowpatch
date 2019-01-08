@extends('layout')

@php
	$module_name = 'organizations';
@endphp

@section('title', '{{ $organization->name }}')

@section('content')

<div class="content columns is-multiline">

	<div class="column is-full">
		<h2 class="title is-4">{{ $organization->name }}</h1>
	</div>
	
	<div class="column is-half">

		@include('layouts.cards.organization_address')
		
	</div> <!-- column 1 -->

	<div class="column is-half">

		@include ('layouts.panels.organization_jobsites')

	</div> <!-- column 2 -->
	
	@if ($organization->contacts->count())
	<div class="column is-half">
		<p class="title is-5">Organization Contacts</p>
	
		@foreach ($organization->contacts as $contact)
			@include('layouts.cards.contact_info')
		@endforeach
	</div>
	@endif
	
</div>

@endsection

