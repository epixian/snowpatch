@extends('layout')

@php
	$module_name = 'jobsites';
@endphp

@section('content')
	<h1 class="title">Edit Organization</h1>
	<form method="POST" action="/organizations/{{ $organization->id }}">
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
		<div class="field">
			<label class="label" for="name">Name</label>
			<div class="control">
				<input type="text" class="input" name="name" placeholder="Organization name" value="{{ $organization->name }}" required>
			</div>
		</div>
		<div class="field">
			<label class="label" for="address_line_1">Address</label>
			<div class="control">
				<input type="text" class="input" name="address_line_1" placeholder="Address" value="{{ $organization->address_line_1 }}" required>
			</div>
		</div>
		<div class="field">
			<label class="label" for="address_line_2">Address (cont.)</label>
			<div class="control">
				<input type="text" class="input" name="address_line_2" placeholder="Address (cont.)" value="{{ $organization->address_line_2 }}">
			</div>
		</div>
		<div class="field">
			<label class="label" for="city">City</label>
			<div class="control">
				<input type="text" class="input" name="city" placeholder="City" value="{{ $organization->city }}" required>
			</div>
		</div>
		<div class="field">
			<label class="label" for="state">State</label>
			<div class="control">
				<input type="text" class="input" name="state" placeholder="State" value="{{ $organization->state }}" required>
			</div>
		</div>
		<div class="field">
			<label class="label" for="postal_code">Postal Code</label>
			<div class="control">
				<input type="text" class="input" name="postal_code" placeholder="Postal Code" value="{{ $organization->postal_code }}" required>
			</div>
		</div>
		<div class="field">
			<label class="label" for="country">Country</label>
			<div class="control">
				<input type="text" class="input" name="country" placeholder="Country" value="{{ $organization->country }}" required>
			</div>
		</div>
		<div class="field">
			<div class="control">
				<button type="submit" class="button is-link">Update Organization</button>
			</div>
		</div>
	</form>	
	<form method="POST" action="/organizations/{{ $organization->id }}">
		@method('DELETE')
		@csrf
		<div class="field">
			<div class="control">
				<button type="submit" class="button">Delete Organization</button>
			</div>
		</div>
	</form>
@endsection

