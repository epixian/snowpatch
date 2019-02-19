<div id="new-jobsite" class="modal">
	<div class="modal-background"></div>
	<div class="modal-content">
	<form method="POST" action="/organizations/{{ $organization->id }}/jobsite">
		<div class="columns is-multiline content">
		
			<div class="column is-full">
				<h2 class="title is-4">New Jobsite</h2>
				<h3 class="subtitle is-6">{{ $organization->name }}</h3>
			</div> <!-- title -->
			
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
				@csrf
				<input type="hidden" name="organization_id" value="{{ $organization->id }}">
				<div class="field">
					<label class="label" for="name">Jobsite Name</label>
					<div class="control">
						<input type="text" class="input {{ $errors->has('name') ? 'is-danger' : '' }}" name="name" placeholder="Jobsite name" value="{{ old('name') }}" required>
					</div>
				</div>
				<div class="field">
					<label class="label"" for="address">Address</label>
					<div class="control">
						<input type="text" class="input {{ $errors->has('address') ? 'is-danger' : '' }}" name="address" placeholder="Address" value="{{ old('address') }}" required>
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
			</div> {{-- end column 1 --}}

			
			<div class="column is-half is-full-mobile">
				<div class="field">
					<label class="label" for="country">Acreage</label>
					<div class="control">
						<input type="text" class="input {{ $errors->has('acreage') ? 'is-danger' : '' }}" name="acreage" placeholder="Acreage" value="{{ old('acreage') }}">
					</div>
				</div>
				<div class="field">
					<label class="label" for="linear_feet">Linear Feet</label>
					<div class="control">
						<input type="text" class="input {{ $errors->has('linear_feet') ? 'is-danger' : '' }}" name="linear_feet" placeholder="Linear feet" value="{{ old('linear_feet') }}">
					</div>
				</div>
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
			</div> {{-- end column 2 --}}
			
			<div class="column is-full">
				<div class="field">
					<div class="control">
						<button type="submit" class="button is-link">Save</button>
					</div>
				</div>
			</div> {{-- end save --}}
			
		</div>
	</form>			
	</div>
	<button class="modal-close is-large" aria-label="close"></button>
</div>