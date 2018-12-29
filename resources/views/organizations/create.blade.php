@extends('layout')

@section('module_name', 'organizations')

@section('content')
<form method="POST" action="/organizations">
	<div class="columns is-multiline content">
		<div class="column is-full">
			<h2 class="title is-4">New Organization</h2>
		</div>
		<div class="column is-half is-full-mobile">
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
		</div>
		
		<div class="column is-half is-full-mobile">
			<div class="field">
				<label class="label" for="type">Type</label>
				<div class="control">
					<input type="text" class="input {{ $errors->has('type') ? 'is-danger' : '' }}" name="type" placeholder="Type" value="{{ old('type') }}">
				</div>
			</div>
			<div class="field">
				<label class="label" for="status">Status</label>
				<div class="control">
					<input type="text" class="input {{ $errors->has('status') ? 'is-danger' : '' }}" name="status" placeholder="Status" value="{{ old('status') }}">
				</div>
			</div>
		</div>
		
		<div class="column is-full">
			<div class="field">
				<div class="control">
					<button type="submit" class="button is-link">Save</button>
				</div>
			</div>
		</div>
		
	</div>
</form>	
@endsection

