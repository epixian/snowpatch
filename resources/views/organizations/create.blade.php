@extends('layout')

@section('module_name')
organizations
@endsection

@section('content')
	<h1 class="title">Create Organization</h1>
	<form method="POST" action="/organizations">
		@if ($errors->any())	
		<div class="notification is-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		{{ csrf_field() }}
		<div class="field">
			<label class="label" for="name">Name</label>
			<div class="control">
				<input type="text" class="input {{ $errors->has('name') ? 'is-danger' : '' }}" name="name" placeholder="Organization name" value="{{ old('name') }}" required>
			</div>
		</div>
		<div class="field">
			<label class="label"" for="address_line_1">Address</label>
			<div class="control">
				<input type="text" class="input {{ $errors->has('address_line_1') ? 'is-danger' : '' }}" name="address_line_1" placeholder="Address" value="{{ old('address_line_1') }}" required>
			</div>
		</div>
		<div class="field">
			<label class="label" for="address_line_2">Address (cont.)</label>
			<div class="control">
				<input type="text" class="input {{ $errors->has('address_line_2') ? 'is-danger' : '' }}" name="address_line_2" placeholder="Address (cont.)" value="{{ old('address_line_2') }}">
			</div>
		</div>
		<div class="field">
			<label class="label" for="city">City</label>
			<div class="control">
				<input type="text" class="input {{ $errors->has('city') ? 'is-danger' : '' }}" name="city" placeholder="City" value="{{ old('city') }}" required>
			</div>
		</div>
		<div class="field">
			<label class="label" for="state">State</label>
			<div class="control">
				<input type="text" class="input {{ $errors->has('state') ? 'is-danger' : '' }}" name="state" placeholder="State" value="{{ old('state') }}" required>
			</div>
		</div>
		<div class="field">
			<label class="label" for="postal_code">Postal Code</label>
			<div class="control">
				<input type="text" class="input {{ $errors->has('postal_code') ? 'is-danger' : '' }}" name="postal_code" placeholder="Postal Code" value="{{ old('postal_code') }}" required>
			</div>
		</div>
		<div class="field">
			<label class="label" for="country">Country</label>
			<div class="control">
				<input type="text" class="input {{ $errors->has('country') ? 'is-danger' : '' }}" name="country" placeholder="Country" value="{{ old('country') }}" required>
			</div>
		</div>
		<div class="field">
			<div class="control">
				<button type="submit" class="button is-link">Create Organization</button>
			</div>
		</div>

	</form>	
@endsection

