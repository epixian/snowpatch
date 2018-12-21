@extends('layout')

@section('module_name')
organizations
@endsection

@section('content')
	<h1 class="title">{{ $organization->name }}</h1>
	<div class="content columns">
		<div class="column">
		
			@include('layouts.cards.organization_address')
			
			@if ($organization->contacts->count())
			<section class="container">
				@foreach ($organization->contacts as $contact)
				@include('layouts.cards.contact_info')
				@endforeach
			</section> <!-- contact list -->
			@endif
			
		</div> <!-- column 1 -->

		<div class="column">
		
			@include ('layouts.panels.organization_jobsites')
			
		</div> <!-- column 2 -->
	</div>

@endsection

