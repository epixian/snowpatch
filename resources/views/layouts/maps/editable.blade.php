<div id="map"></div>
<script>
  var map;
  var stats = {
    points: 0,
    lines: 0,
    length: 0,
    polygons: 0,
    area: 0
  };
  var data = {
    type: "FeatureCollection",
    features: []
  };

  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: { 
        lat: {{ $map->center->lat }}, 
        lng: {{ $map->center->lng }}
      },
      zoom: {{ $map->zoom }},
      noClear: true,
      mapTypeId: 'satellite',
      navigationControl: true,
      mapTypeControl: false,
      streetViewControl: false,
      tilt: 0
    });

    var entryMarker = new google.maps.Marker({
      position: { 
        lat: {{ $map->center->lat }}, 
        lng: {{ $map->center->lng }}
      },
      map: map
    });

    var drawingManager = new google.maps.drawing.DrawingManager({
      drawingMode: 'marker',
      drawingControl: true,
      drawingControlOptions: {
        position: google.maps.ControlPosition.TOP_CENTER,
        drawingModes: ['marker', 'polygon', 'polyline']
      },
      markerOptions: {
        // icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
      },
      polygonOptions: {
        fillColor: '#00ff80',
        fillOpacity: 0.3,
        strokeWeight: 1,
        clickable: false,
        editable: true,
        zIndex: 1
      },
      polylineOptions: {
        strokeColor: '#ffff00',
        strokeWeight: 4,
        clickable: true,
        editable: true,
        zIndex: 2
      }
    });
    drawingManager.setMap(map);

    var infoWindow = new google.maps.InfoWindow();

    // var controls = document.getElementById('controls');

    var actions = {
      'data-save': {
        click: function() {
          //use this method to store the data somewhere,
          //e.g. send it to a server
          map.data.toGeoJson(function(json) {
            data = json;
          });

        }
      },
      'data-show': {
        click: function() {

          alert('you may send this JSON-string to a server and store it there:\n\n' +
            JSON.stringify(data))
        }
      },
      'data-load': {
        click: function() {
          //use this method to load the data from somwhere
          //e.g. from a server via loadGeoJson

          map.data.forEach(function(f) {
            map.data.remove(f);
          });
          map.data.addGeoJson(data)
        },
        init: true
      },
      'data-clear': {
        click: function() {
          //use this method to clear the data
          //when you also want to remove the data on the server 
          //send a geoJSON with empty features-array to the server

          map.data.forEach(function(f) {
            map.data.remove(f);
          });
          data = {
            type: "FeatureCollection",
            features: []
          };
        }
      }
    };

    // for (var action in fx) {
    //   var o = ctrl.querySelector('input[id=' + action + ']');
    //   google.maps.event.addDomListener(o, 'click', fx[action].click);
    //   if (fx[action].init) {
    //     google.maps.event.trigger(o, 'click');
    //   }
    // }

    google.maps.event.addListener(map.data, 'mouseover', function(e) {
      var f = e.feature.getGeometry();
      if (f.getType() === 'LineString') {
        win.setOptions({
          content: 'Linear Feet: ' + calculateLength(f),
          pixelOffset: new google.maps.Size(0, -40),
          map: map,
          position: e.feature.getGeometry().get()
        });
      }
      if (f.getType() === 'Polygon') {
        win.setOptions({
          content: 'Acres: ' + calculateArea(f),
          pixelOffset: new google.maps.Size(0, -40),
          map: map,
          position: e.feature.getGeometry().get()
        });
      }
      if (f.getType() === 'Marker') {
        win.setOptions({
          content: 'Entrance',
          pixelOffset: new google.maps.Size(0, -40),
          map: map,
          position: e.feature.getGeometry().get()
        });
      }
    });

    google.maps.event.addListener(drawingManager, 'polylinecomplete', function(line) {
        calculateLength(line);
      google.maps.event.addListener(line.getPath(), 'insert_at', function(index, obj) {
        calculateLength(line);
      });
      google.maps.event.addListener(line.getPath(), 'set_at', function(index, obj) {
        calculateLength(line);
      });
      google.maps.event.addListener(line.getPath(), 'remove_at', function(index, obj) {
        calculateLength(line);
      });
      google.maps.event.addListener(line.getPath(), 'dragend', function(index, obj) {
        calculateLength(line);
      });
    });

    google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
        calculateArea(polygon);
      google.maps.event.addListener(polygon.getPath(), 'insert_at', function(index, obj) {
        calculateArea(polygon);
      });
      google.maps.event.addListener(polygon.getPath(), 'set_at', function(index, obj) {
        calculateArea(polygon);
      });
      google.maps.event.addListener(polygon.getPath(), 'remove_at', function(index, obj) {
        calculateArea(polygon);
      });
      google.maps.event.addListener(polygon.getPath(), 'dragend', function(index, obj) {
        calculateArea(polygon);
      });
    }); 
  }

  function refreshData() {
    map.data.toGeoJson(function(json) {
      data = json;
    });
    for (var i = 0; i < data.features.length; i++) {
      console.log(data.feature[i]);
      parseGeometry(f.getGeometry());
    }
  }

  function parseGeometry(g) {
    switch(g.getType()) {
      case 'LineString':
        stats.lines++;
        break;
      case 'MultiLineString':
        for (var i = 0; i < g.getLength(); i++ ) {
          parseGeometry(g.getAt(i));
        }
        break;
      case 'Polygon':
        stats.polygons++;
        break;
      case 'MultiPolygon':
        for (var i = 0; i < g.getLength(); i++ ) {
          parseGeometry(g.getAt(i));
        }
        break;
      case 'GeometryCollection':
        for (var i = 0; i < g.getLength(); i++ ) {
          parseGeometry(g.getAt(i));
        }
        break;
      case 'Point':
        stats.points++;
        break;
    }
    console.log(stats);
  }

  function calculateLength(f) {
    var metersPerFeet = 0.3048;
    var len = google.maps.geometry.spherical.computeLength(f.getPath());
    len = len / metersPerFeet;                                 // convert to feet
    len = Math.round(len);                                     // round to nearest foot
    document.getElementById('linear_feet').value = len;
    return len;
  }

  function calculateArea(f) {
    var squareMetersPerAcre = 4046.86;
    var area = google.maps.geometry.spherical.computeArea(f.getPath());
    area = area / squareMetersPerAcre;                         // convert to acres
    area = Math.round(area * 100) / 100;                       // round to nearest .01 acre
    document.getElementById('acreage').value = area;
    return area;
  }

  // function placeMarker(location) {
  //   var feature = new google.maps.Data.Feature({
  //     geometry: location
  //   });
  //   map.data.add(feature);
  // }
  // google.maps.event.addListener(map, 'click', function(event) {
  //   placeMarker(event.latLng);
  // });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps.key') }}&libraries=drawing&callback=initMap"
     async defer></script>
<div class="field">
  <label class="label" for="linear_feet">Linear Feet</label>
  <div class="control">
    <input type="text" class="input" id="linear_feet" name="linear_feet" placeholder="Linear Feet">
  </div>
</div>
<div class="field">
  <label class="label" for="acreage">Acreage</label>
  <div class="control">
    <input type="text" class="input" id="acreage" name="acreage" placeholder="Acreage">
  </div>
</div>