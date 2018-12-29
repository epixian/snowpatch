<div class="card">
	<div class="content card-content">
		<div id="map"></div>
		<script>
var geocoder;
var map;

//var address = "529 E Mt. Pleasant Ave, Philadelphia, PA 19119";
var address = "{{ $jobsite->address }}, {{ $jobsite->city }}, {{ $jobsite->state }} {{ $jobsite->postal_code }}";

function initMap() {
	
	geocoder = new google.maps.Geocoder();
	
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 18,
		center: new google.maps.LatLng(40, -75.1),
		mapTypeId: 'satellite',
		navigationControl: true,
		mapTypeControl: false,
		streetViewControl: false,
		tilt: 0
	});
	
	if (geocoder) {
		geocoder.geocode({ 
			'address': address 
		}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
					
					map.setCenter(results[0].geometry.location);
					var infowindow = new google.maps.InfoWindow({
						content: '<b>' + address + '</b>',
						size: new google.maps.Size(150, 50)
					});
					var marker = new google.maps.Marker({
						position: results[0].geometry.location,
						map: map,
						title: address
					});
					google.maps.event.addListener(marker, 'click', function() {
						infowindow.open(map, marker);
					});

				} else {
					alert("No results found");
				}
			} else {
				alert("Geocoding failed: " + status);
			}
		});
	}
}
		</script>

		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmWDiERR6qBULC6C9QcmllcbSjUlOhUZA&callback=initMap"></script>
		
	</div> <!-- card content -->

</div> <!-- card -->