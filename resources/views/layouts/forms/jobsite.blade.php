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
					<input type="text" class="input {{ $errors->has('address') ? 'is-danger' : '' }}" name="address" placeholder="Address" value="{{ old('address') }}" id="address" onFocus="geolocate()" required>
				</div>
			</div>
			<div class="field">
				<label class="label" for="city">City</label>
				<div class="control">
					<input type="text" class="input {{ $errors->has('city') ? 'is-danger' : '' }}" name="city" placeholder="City" value="{{ old('city') }}" id="city" required>
				</div>
			</div>
			<div class="field">
				<label class="label" for="state">State</label>
				<div class="control">
					<input type="text" class="input {{ $errors->has('city') ? 'is-danger' : '' }}" name="city" placeholder="City" value="{{ old('city') }}" id="state" required>
				</div>
			</div>
			<div class="field">
				<label class="label" for="postal_code">Postal Code</label>
				<div class="control">
					<input type="text" class="input {{ $errors->has('postal_code') ? 'is-danger' : '' }}" name="postal_code" placeholder="Postal Code" value="{{ old('postal_code') }}" id="postal_code" required>
				</div>
			</div>
			<div class="field">
				<label class="label" for="country">Country</label>
				<div class="control">
					<input type="text" class="input {{ $errors->has('country') ? 'is-danger' : '' }}" name="country" placeholder="Country" value="{{ old('country') }}" id="country" required>
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
			<div class="box">
				<div class="columns">
					<div class="field column">
						<label class="label" for="lat">Latitude</label>
						<div class="control">
							<input type="text" class="input {{ $errors->has('lat') ? 'is-danger' : '' }}" name="lat" placeholder="Latitude" value="{{ old('lat') }}">
						</div>
					</div>
					<div class="field column">
						<label class="label" for="long">Longitude</label>
						<div class="control">
							<input type="text" class="input {{ $errors->has('long') ? 'is-danger' : '' }}" name="long" placeholder="Longitude" value="{{ old('long') }}">
						</div>
					</div>
				</div>
				<div class="field">
					<div class="control">
						<button onClick="" class="button is-link">Update Lat/Long</button>
					</div>
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
<script>
  // This example displays an address form, using the autocomplete feature
  // of the Google Places API to help users fill in the information.

  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

	var placeSearch, autocomplete;
	var componentForm = {
		street_number: 'short_name',
		route: 'long_name',
		locality: 'long_name',
		administrative_area_level_1: 'short_name',
		country: 'short_name',
		postal_code: 'short_name'
	};
	var addressResult = {};

	function initAutocomplete() {
		// Create the autocomplete object, restricting the search to geographical
		// location types.
		autocomplete = new google.maps.places.Autocomplete(
		    /** @type {!HTMLInputElement} */(document.getElementById('address')),
		    {types: ['geocode']});

		// When the user selects an address from the dropdown, populate the address
		// fields in the form.
		autocomplete.addListener('place_changed', fillInAddress);
	}

	function fillInAddress() {
	    // Get the place details from the autocomplete object.
	    var place = autocomplete.getPlace();

	    // for (var component in componentForm) {
	    //   document.getElementById(component).value = '';
	    //   document.getElementById(component).disabled = false;
	    // }

	    // Get each component of the address from the place details
	    // and fill the corresponding field on the form.
	    for (var i = 0; i < place.address_components.length; i++) {
			var addressType = place.address_components[i].types[0];
			if (componentForm[addressType]) {
      			addressResult[addressType] = place.address_components[i][componentForm[addressType]];
      			//document.getElementById(addressType).value = val;
			}
	    }
	    document.getElementById('address').value = addressResult['street_number'] + ' ' + addressResult['route'];
	    document.getElementById('city').value = addressResult['locality'];
	    document.getElementById('state').value = addressResult['administrative_area_level_1'];
	    document.getElementById('postal_code').value = addressResult['postal_code'];
	    document.getElementById('country').value = addressResult['country'];
	}

  // Bias the autocomplete object to the user's geographical location,
  // as supplied by the browser's 'navigator.geolocation' object.
  function geolocate() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        var circle = new google.maps.Circle({
          center: geolocation,
          radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
      });
    }
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps.key') }}&libraries=places&callback=initAutocomplete"
    async defer></script>