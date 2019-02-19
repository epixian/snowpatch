<div id="map"></div>
<script>
@if ($map->hasFeatures()) 
var imported = {!! $map->featuresAsGeoJson() !!};
@else 
var imported = {
  type: "FeatureCollection",
  features: [
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          {{ $map->getCenter()->lat }}, 
          {{ $map->getCenter()->lng }},
        ],
      },
      properties: {
        activity: "Entry",
      }
    },
  ]
};
@endif
var center = { lat: {{ $map->getCenter()->lat }}, lng: {{ $map->getCenter()->lng }} };
var zoom = {{ $map->getZoom() }};
var map;
var features = {
  polygons: [],
  lines: [],
  markers: [],
  area: 0,
  length: 0
};
var win;
var styles = {
  polygon: {
    fillColor: '#00ff80',
    fillOpacity: 0.3,
    strokeColor: '#008840',
    strokeWeight: 1,
    clickable: true,
    editable: true,
    zIndex: 1
  },
  polyline: {
    strokeColor: '#ffff00',
    strokeWeight: 3,
    clickable: true,
    editable: true,
    zIndex: 2
  },
  marker: {
    clickable: true,
    draggable: true,
    zIndex: 3
  }
}

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: center,
    zoom: zoom,
    noClear: true,
    mapTypeId: 'satellite',
    navigationControl: true,
    mapTypeControl: false,
    streetViewControl: false,
    tilt: 0
  });

  // initialize info windows
  win = new google.maps.InfoWindow({
    pixelOffset: new google.maps.Size(0, -40)
  });

  // for adding future edit event handlers
  map.data.addListener('addfeature', featureAdded);

  // load map features from geojson
  map.data.addGeoJson(imported);

  calculateArea();
  calculateLength();

  // initialize drawing tools
  var drawingManager = new google.maps.drawing.DrawingManager({
    // drawingMode: 'marker',
    drawingControl: true,
    drawingControlOptions: {
      position: google.maps.ControlPosition.TOP_CENTER,
      drawingModes: ['polygon', 'polyline', 'marker']
    },
    polygonOptions: styles.polygon,
    polylineOptions: styles.polyline,
    markerOptions: styles.marker
  });
  drawingManager.setMap(map);
  drawingManager.addListener('polygoncomplete', function(polygon) {
    if (polygon.getPath().getLength() < 3) {
      alert('Polygons must have 3 or more points.');
      polygon.getPath().clear();
    } else {
      addFeature('Polygon', polygon.getPath());
      polygon.setMap(null);
      calculateArea();
    }
  });
  drawingManager.addListener('polylinecomplete', function(line) {
    if (line.getPath().getLength() < 2) {
      alert('Lines must have 2 or more points.');
      line.getPath().clear();
      // line.setMap(null);
    } else {
      addFeature('Polyline', line.getPath());
      line.setMap(null);
      calculateLength();
    }
  });
  drawingManager.addListener('markercomplete', function(marker) {
    addFeature('Point', marker.getPosition());
    marker.setMap(null);
    updateGeoJSON();
  });

  map.addListener('center_changed', updateViewport);
  map.addListener('zoom_changed', updateViewport);

  function updateViewport() {
    document.getElementById('center').value = map.getCenter();
    document.getElementById('zoom').value = map.getZoom();
  }

  updateViewport();
}

function featureAdded(e) {
  switch(e.feature.getGeometry().getType()) {
    case 'Polygon':
      addFeature('Polygon', e.feature.getGeometry().getAt(0).getArray());
      break;
    case 'LineString':
      addFeature('Polyline', e.feature.getGeometry().getArray());
      break;
    case 'Point':
      addFeature('Point', e.feature.getGeometry().get());
  }
  map.data.remove(e.feature);
}

function addFeature(type, path) {
  switch(type) {
    case 'Polygon':
      var polygon = new google.maps.Polygon(styles.polygon);
      polygon.setPath(path);
      // polygon.addListener('mouseover', infoWinPolygon);
      // polygon.addListener('mouseout', infoWinClose);
      polygon.getPath().addListener('insert_at', calculateArea)
      polygon.getPath().addListener('set_at', calculateArea);
      polygon.getPath().addListener('remove_at', calculateArea);
      polygon.getPath().addListener('dragend', calculateArea);
      polygon.addListener('rightclick', function(e) {
        if (e.vertex == undefined) return;
        if (polygon.getPath().getLength() == 3) {
          polygon.setMap(null);
          features.polygons = features.polygons.filter(isValid);
          // console.log('polygon removed');
        }
        else {
          polygon.getPath().removeAt(e.vertex);
        }
        calculateArea();
      });   
      features.polygons.push(polygon);
      polygon.setMap(map);
      break;

    case 'Polyline':
      var line = new google.maps.Polyline(styles.polyline);
      line.setPath(path);
      // line.addListener('mouseover', infoWinLine);
      // line.addListener('mouseout', infoWinClose);
      line.getPath().addListener('insert_at', calculateLength);
      line.getPath().addListener('set_at', calculateLength);
      line.getPath().addListener('remove_at', calculateLength);
      line.getPath().addListener('dragend', calculateLength);
      line.addListener('rightclick', function(e) {
        if (e.vertex == undefined) return;
        if (line.getPath().getLength() == 2) {
          line.setMap(null);
          features.lines = features.lines.filter(isValid);
          // console.log('line removed');
        }
        else {
          line.getPath().removeAt(e.vertex);
        }
        calculateLength();
      }); 
      features.lines.push(line);
      line.setMap(map);
      break;

    case 'Point':
      var marker = new google.maps.Marker(styles.marker);
      marker.setPosition(path);
      marker.setAnimation(google.maps.Animation.DROP);
      // marker.addListener('mouseover', infoWinMarker);
      // marker.addListener('mouseout', infoWinClose);
      marker.addListener('drag', function(e) {
        marker.setAnimation(google.maps.Animation.BOUNCE);
      });
      marker.addListener('dragend', function(e) {
        marker.setAnimation(null);
      })
      marker.addListener('rightclick', function(e) {  
        marker.setMap(null);
        features.markers = features.markers.filter(isValid); 
        // console.log('marker removed');
        updateGeoJSON();
      });
      features.markers.push(marker);
      marker.setMap(map);
      break;
  }
}
function isValid(f) {
  return f.getMap() != null;
}

function calculateArea() {
  var squareMetersPerAcre = 4046.86;
  var area = 0;
  var polygon;
  for (var i = 0; i < features.polygons.length; i++) {
    polygon = features.polygons[i];
    area += google.maps.geometry.spherical.computeArea(polygon.getPath());
  } 
  area = area / squareMetersPerAcre;                         // convert to acres
  area = Math.round(area * 100) / 100;                       // round to nearest .01 acre
  document.getElementById('acreage').value = features.area = area;
  updateGeoJSON();
  return area;
}

function calculateLength() {
  var metersPerFeet = 0.3048;
  var len = 0;
  var line;
  for (var i = 0; i < features.lines.length; i++) {
    line = features.lines[i];
    len += google.maps.geometry.spherical.computeLength(line.getPath());
  } 
  len = len / metersPerFeet;                                 // convert to feet
  len = Math.round(len);                                     // round to nearest foot
  document.getElementById('linear_feet').value = features.length = len;
  updateGeoJSON();
  return len;
}

function updateGeoJSON() {
  // console.log('generating GeoJSON')
  var data = new google.maps.Data;
  features.polygons.forEach(function(polygon, i) {
    // console.log('polygon: ' + polygon.getPath().getArray());
    data.add({geometry: new google.maps.Data.Polygon([polygon.getPath().getArray()]), properties: { description: 'Plowing' }});
  });
  features.lines.forEach(function(line, i) {
    // console.log('polyline: ' + line.getPath().getArray());
    data.add({geometry: new google.maps.Data.LineString(line.getPath().getArray()), properties: { description: 'Shoveling' }});
  });
  features.markers.forEach(function(marker, i) {
    // console.log('marker: ' + marker.getPosition());
    data.add({geometry: new google.maps.Data.Point(marker.getPosition()), properties: { description: 'Entrance' }});
  });
  data.toGeoJson(function(json) {
    document.getElementById('geojson').value = JSON.stringify(json);
  });
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps.key') }}&libraries=geometry,drawing&callback=initMap" async defer></script>
<input type="hidden" class="input" id="geojson" name="geojson" placeholder="GeoJSON">
<input type="hidden" class="input" id="zoom" name="zoom" placeholder="Zoom">
<input type="hidden" class="input" id="center" name="center" placeholder="Center">
<div class="columns is-multiline">
  <div class="column is-half">
    <div class="field">
      <label class="label" for="linear_feet">Linear Feet</label>
      <div class="control">
        <input type="text" class="input" id="linear_feet" name="linear_feet" placeholder="Linear Feet">
      </div>
    </div>
  </div>
  <div class="column is-half">
    <div class="field">
      <label class="label" for="acreage">Acreage</label>
      <div class="control">
        <input type="text" class="input" id="acreage" name="acreage" placeholder="Acreage">
      </div>
    </div>
  </div>
  <div class="column is-full">
    <button type="submit" class="button is-link">Save</button>
  </div>
</div>