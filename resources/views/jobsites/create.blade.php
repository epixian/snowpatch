@extends('layout')

@php
	$module_name = 'jobsites';
@endphp

@section('content')
	@empty($organization)
		<div class="notification is-danger">
			Jobsites must be associated with an Organization.
		</div>
	@endempty
	@isset($organization)
		@include('layouts.forms.jobsite')
	@endisset
@endsection

