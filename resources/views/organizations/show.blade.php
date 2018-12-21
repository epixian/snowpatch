@extends('layout')

@section('module_name', 'organizations')

@section('content')
	<h1 class="title">{{ $organization->name }}</h1>
	<div class="content columns">
		<div class="column">
			<div class="section">
			@include('layouts.cards.organization_address')
			</div>
			
			@if ($organization->contacts->count())
			<div class="section">
				<p class="title is-4">Organization Contacts</p>
			
				@foreach ($organization->contacts as $contact)
					@include('layouts.cards.contact_info')
				@endforeach
			</div>
			@endif
			
		</div> <!-- column 1 -->

		<div class="column">
			<div class="section">
			@include ('layouts.panels.organization_jobsites')
			</div>
		</div> <!-- column 2 -->
	</div>

@endsection

